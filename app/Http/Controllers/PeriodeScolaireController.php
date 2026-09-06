<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\PeriodeScolaire;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PeriodeScolaireController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $anneeScolaireId = $request->input('annee_scolaire_id');

        $periodesScolaires = PeriodeScolaire::with('anneeScolaire.organisation')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nom', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        ->orWhereHas('anneeScolaire', function ($annee) use ($search) {
                            $annee->where('libelle', 'like', '%' . $search . '%');
                        });
                });
            })
            ->when($anneeScolaireId, function ($query, $anneeScolaireId) {
                $query->where('annee_scolaire_id', $anneeScolaireId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $anneesScolaires = AnneeScolaire::with('organisation')
            ->where('active', true)
            ->orderBy('libelle', 'desc')
            ->get();

        return view('periodes_scolaires.index', compact(
            'periodesScolaires',
            'anneesScolaires',
            'search'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'annee_scolaire_id' => [
                'required',
                'exists:annees_scolaires,id',
            ],

            'nom' => [
                'required',
                'string',
                'max:100',
            ],

            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('periodes_scolaires', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'annee_scolaire_id',
                            $request->annee_scolaire_id
                        );
                    }),
            ],

            'date_debut' => [
                'required',
                'date',
            ],

            'date_fin' => [
                'required',
                'date',
                'after:date_debut',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ]);

        // Récupération de l'année scolaire
        $anneeScolaire = AnneeScolaire::findOrFail(
            $request->annee_scolaire_id
        );

        // Vérification des dates par rapport à l'année scolaire
        if (
            $request->date_debut < $anneeScolaire->date_debut ||
            $request->date_fin > $anneeScolaire->date_fin
        ) {
            return back()
                ->withInput()
                ->with('error', 'Les dates de la période doivent être comprises dans les dates de l’année scolaire.');
        }

        $validated['active'] = $request->has('active');

        PeriodeScolaire::create($validated);

        return redirect()
            ->route('periodes-scolaires.index')
            ->with('success', 'Période scolaire ajoutée avec succès.');
    }

    public function show(PeriodeScolaire $periodeScolaire)
    {
        $periodeScolaire->load('anneeScolaire.organisation');

        return view(
            'periodes_scolaires.show',
            compact('periodeScolaire')
        );
    }

    public function update(
        Request $request,
        PeriodeScolaire $periodeScolaire
    ) {
        $validated = $request->validate([
            'annee_scolaire_id' => [
                'required',
                'exists:annees_scolaires,id',
            ],

            'nom' => [
                'required',
                'string',
                'max:100',
            ],

            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('periodes_scolaires', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'annee_scolaire_id',
                            $request->annee_scolaire_id
                        );
                    })
                    ->ignore($periodeScolaire->id),
            ],

            'date_debut' => [
                'required',
                'date',
            ],

            'date_fin' => [
                'required',
                'date',
                'after:date_debut',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ]);

        // Récupération de l'année scolaire
        $anneeScolaire = AnneeScolaire::findOrFail(
            $request->annee_scolaire_id
        );

        // Vérification des dates
        if (
            $request->date_debut < $anneeScolaire->date_debut ||
            $request->date_fin > $anneeScolaire->date_fin
        ) {
            return back()
                ->withInput()
                ->with('error', 'Les dates de la période doivent être comprises dans les dates de l’année scolaire.');
        }

        $validated['active'] = $request->has('active');

        $periodeScolaire->update($validated);

        return redirect()
            ->route('periodes-scolaires.index')
            ->with('success', 'Période scolaire modifiée avec succès.');
    }

    public function destroy(PeriodeScolaire $periodeScolaire)
    {
        try {

            /*
         * Plus tard, nous ajouterons ici les vérifications
         * des données qui dépendent de cette période.
         */

            $periodeScolaire->delete();

            return redirect()
                ->route('periodes-scolaires.index')
                ->with(
                    'success',
                    'Période scolaire supprimée avec succès.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('periodes-scolaires.index')
                ->with(
                    'error',
                    'Impossible de supprimer cette période scolaire.'
                );
        }
    }
}
