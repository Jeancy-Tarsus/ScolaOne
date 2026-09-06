<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnneeScolaireController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $organisationId = $request->input('organisation_id');

        $anneesScolaires = AnneeScolaire::with('organisation')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('libelle', 'like', '%' . $search . '%')
                        ->orWhereHas('organisation', function ($organisation) use ($search) {
                            $organisation->where('nom', 'like', '%' . $search . '%');
                        });
                });
            })
            ->when($organisationId, function ($query, $organisationId) {
                $query->where('organisation_id', $organisationId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $organisations = Organisation::where('statut', true)
            ->orderBy('nom')
            ->get();

        return view('annees_scolaires.index', compact(
            'anneesScolaires',
            'organisations',
            'search'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'organisation_id' => ['required', 'exists:organisations,id'],
            'libelle' => [
                'required',
                'string',
                'max:100',
                Rule::unique('annees_scolaires', 'libelle')
                    ->where(
                        fn($query) =>
                        $query->where('organisation_id', $request->organisation_id)
                    ),
            ],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'after:date_debut'],
            'active' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string'],
        ]);

        $validated['active'] = $request->has('active');

        AnneeScolaire::create($validated);

        return redirect()
            ->route('annees-scolaires.index')
            ->with('success', 'Année scolaire ajoutée avec succès.');
    }

    public function show(AnneeScolaire $anneeScolaire)
    {
        $anneeScolaire->load('organisation');

        return view('annees_scolaires.show', compact('anneeScolaire'));
    }

    public function update(Request $request, AnneeScolaire $anneeScolaire)
    {
        $validated = $request->validate([
            'organisation_id' => ['required', 'exists:organisations,id'],
            'libelle' => [
                'required',
                'string',
                'max:100',
                Rule::unique('annees_scolaires', 'libelle')
                    ->where(
                        fn($query) =>
                        $query->where('organisation_id', $request->organisation_id)
                    )
                    ->ignore($anneeScolaire->id),
            ],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'after:date_debut'],
            'active' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string'],
        ]);

        $validated['active'] = $request->has('active');

        $anneeScolaire->update($validated);

        return redirect()
            ->route('annees-scolaires.index')
            ->with('success', 'Année scolaire modifiée avec succès.');
    }

    public function destroy(AnneeScolaire $anneeScolaire)
    {
        try {

            if ($anneeScolaire->periodesScolaires()->exists()) {
                return redirect()
                    ->route('annees-scolaires.index')
                    ->with(
                        'error',
                        'Impossible de supprimer cette année scolaire car elle contient encore des périodes scolaires.'
                    );
            }

            $anneeScolaire->delete();

            return redirect()
                ->route('annees-scolaires.index')
                ->with(
                    'success',
                    'Année scolaire supprimée avec succès.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('annees-scolaires.index')
                ->with(
                    'error',
                    'Impossible de supprimer cette année scolaire.'
                );
        }
    }
    
}
