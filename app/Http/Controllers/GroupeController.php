<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GroupeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $niveauId = $request->input('niveau_id');

        $groupes = Groupe::with('niveau.cycle.organisation')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {

                    $q->where('nom', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        ->orWhereHas('niveau', function ($niveau) use ($search) {
                            $niveau->where(
                                'nom',
                                'like',
                                '%' . $search . '%'
                            );
                        });
                });
            })
            ->when($niveauId, function ($query, $niveauId) {
                $query->where('niveau_id', $niveauId);
            })
            ->orderBy('niveau_id')
            ->orderBy('ordre')
            ->paginate(10)
            ->withQueryString();

        $niveaux = Niveau::with('cycle.organisation')
            ->where('statut', true)
            ->whereHas('cycle', function ($query) {
                $query->where('statut', true);
            })
            ->whereHas('cycle.organisation', function ($query) {
                $query->where('statut', true);
            })
            ->orderBy('nom')
            ->get();

        return view('groupes.index', compact(
            'groupes',
            'niveaux',
            'search'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'niveau_id' => [
                'required',
                'exists:niveaux,id',
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

                Rule::unique('groupes', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'niveau_id',
                            $request->niveau_id
                        );
                    }),
            ],

            'ordre' => [
                'required',
                'integer',
                'min:1',
            ],

            'capacite' => [
                'required',
                'integer',
                'min:1',
                'max:1000',
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

        Groupe::create($validated);

        return redirect()
            ->route('groupes.index')
            ->with(
                'success',
                'Groupe ajouté avec succès.'
            );
    }

    public function show(Groupe $groupe)
    {
        $groupe->load('niveau.cycle.organisation');

        return view(
            'groupes.show',
            compact('groupe')
        );
    }

    public function update(
        Request $request,
        Groupe $groupe
    ) {
        $validated = $request->validate([
            'niveau_id' => [
                'required',
                'exists:niveaux,id',
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

                Rule::unique('groupes', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'niveau_id',
                            $request->niveau_id
                        );
                    })
                    ->ignore($groupe->id),
            ],

            'ordre' => [
                'required',
                'integer',
                'min:1',
            ],

            'capacite' => [
                'required',
                'integer',
                'min:1',
                'max:1000',
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

        $groupe->update($validated);

        return redirect()
            ->route('groupes.index')
            ->with(
                'success',
                'Groupe modifié avec succès.'
            );
    }

    public function destroy(Groupe $groupe)
    {
        try {

            $groupe->delete();

            return redirect()
                ->route('groupes.index')
                ->with(
                    'success',
                    'Groupe supprimé avec succès.'
                );
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()
                ->route('groupes.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce groupe car il est utilisé par d’autres données.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('groupes.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce groupe.'
                );
        }
    }
}
