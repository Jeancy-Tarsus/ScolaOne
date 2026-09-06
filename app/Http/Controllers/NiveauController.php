<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NiveauController extends Controller
{
    /**
     * Liste des niveaux
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $cycleId = $request->input('cycle_id');

        $niveaux = Niveau::with('cycle.organisation')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {

                    $q->where('nom', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        ->orWhereHas('cycle', function ($cycle) use ($search) {

                            $cycle->where('nom', 'like', '%' . $search . '%');
                        });
                });
            })
            ->when($cycleId, function ($query, $cycleId) {
                $query->where('cycle_id', $cycleId);
            })
            ->orderBy('cycle_id')
            ->orderBy('ordre')
            ->paginate(10)
            ->withQueryString();

        $cycles = Cycle::with('organisation')
            ->where('statut', true)
            ->whereHas('organisation', function ($query) {
                $query->where('statut', true);
            })
            ->orderBy('nom')
            ->get();

        return view('niveaux.index', compact(
            'niveaux',
            'cycles',
            'search'
        ));
    }


    /**
     * Enregistrer un niveau
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'cycle_id' => [
                'required',
                'exists:cycles,id',
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

                Rule::unique('niveaux', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'cycle_id',
                            $request->cycle_id
                        );
                    }),
            ],

            'ordre' => [
                'required',
                'integer',
                'min:1',
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

        Niveau::create($validated);

        return redirect()
            ->route('niveaux.index')
            ->with(
                'success',
                'Niveau ajouté avec succès.'
            );
    }


    /**
     * Afficher un niveau
     */
    public function show(Niveau $niveau)
    {
        $niveau->load('cycle.organisation');

        return view(
            'niveaux.show',
            compact('niveau')
        );
    }


    /**
     * Modifier un niveau
     */
    public function update(
        Request $request,
        Niveau $niveau
    ) {
        $validated = $request->validate([

            'cycle_id' => [
                'required',
                'exists:cycles,id',
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

                Rule::unique('niveaux', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'cycle_id',
                            $request->cycle_id
                        );
                    })
                    ->ignore($niveau->id),
            ],

            'ordre' => [
                'required',
                'integer',
                'min:1',
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

        $niveau->update($validated);

        return redirect()
            ->route('niveaux.index')
            ->with(
                'success',
                'Niveau modifié avec succès.'
            );
    }


    /**
     * Supprimer un niveau
     */
    public function destroy(Niveau $niveau)
    {
        try {

            if ($niveau->groupes()->exists()) {
                return redirect()
                    ->route('niveaux.index')
                    ->with(
                        'error',
                        'Impossible de supprimer ce niveau car il contient encore des groupes.'
                    );
            }

            $niveau->delete();

            return redirect()
                ->route('niveaux.index')
                ->with(
                    'success',
                    'Niveau supprimé avec succès.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('niveaux.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce niveau.'
                );
        }
    }
}
