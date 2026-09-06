<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CycleController extends Controller
{
    /**
     * Liste des cycles
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $organisationId = $request->input('organisation_id');

        $cycles = Cycle::with('organisation')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nom', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        ->orWhereHas('organisation', function ($organisation) use ($search) {
                            $organisation->where(
                                'nom',
                                'like',
                                '%' . $search . '%'
                            );
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

        return view('cycles.index', compact(
            'cycles',
            'organisations',
            'search'
        ));
    }


    /**
     * Enregistrer un nouveau cycle
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'organisation_id' => [
                'required',
                'exists:organisations,id',
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

                Rule::unique('cycles', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'organisation_id',
                            $request->organisation_id
                        );
                    }),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'statut' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['statut'] = $request->has('statut');

        Cycle::create($validated);

        return redirect()
            ->route('cycles.index')
            ->with('success', 'Cycle ajouté avec succès.');
    }


    /**
     * Afficher un cycle
     */
    public function show(Cycle $cycle)
    {
        $cycle->load('organisation');

        return view('cycles.show', compact('cycle'));
    }


    /**
     * Modifier un cycle
     */
    public function update(Request $request, Cycle $cycle)
    {
        $validated = $request->validate([

            'organisation_id' => [
                'required',
                'exists:organisations,id',
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

                Rule::unique('cycles', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'organisation_id',
                            $request->organisation_id
                        );
                    })
                    ->ignore($cycle->id),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'statut' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['statut'] = $request->has('statut');

        $cycle->update($validated);

        return redirect()
            ->route('cycles.index')
            ->with('success', 'Cycle modifié avec succès.');
    }


    /**
     * Supprimer un cycle
     */
    public function destroy(Cycle $cycle)
    {
        if ($cycle->niveaux()->exists()) {
            return redirect()
                ->route('cycles.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce cycle car il contient encore des niveaux.'
                );
        }

        $cycle->delete();

        return redirect()
            ->route('cycles.index')
            ->with(
                'success',
                'Cycle supprimé avec succès.'
            );
    }
}
