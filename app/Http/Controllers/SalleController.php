<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $siteId = $request->input('site_id');

        $salles = Salle::with('site.organisation')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {

                    $q->where('nom', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        ->orWhere('type', 'like', '%' . $search . '%')
                        ->orWhere('batiment', 'like', '%' . $search . '%')
                        ->orWhereHas('site', function ($site) use ($search) {
                            $site->where(
                                'nom',
                                'like',
                                '%' . $search . '%'
                            );
                        });

                });
            })
            ->when($siteId, function ($query, $siteId) {
                $query->where('site_id', $siteId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $sites = Site::with('organisation')
            ->where('statut', true)
            ->whereHas('organisation', function ($query) {
                $query->where('statut', true);
            })
            ->orderBy('nom')
            ->get();

        return view('salles.index', compact(
            'salles',
            'sites',
            'search'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_id' => [
                'required',
                'exists:sites,id',
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

                Rule::unique('salles', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'site_id',
                            $request->site_id
                        );
                    }),
            ],

            'capacite' => [
                'required',
                'integer',
                'min:1',
                'max:5000',
            ],

            'type' => [
                'nullable',
                'string',
                'max:100',
            ],

            'batiment' => [
                'nullable',
                'string',
                'max:100',
            ],

            'etage' => [
                'nullable',
                'string',
                'max:50',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'statut' => [
                'required',
                'in:disponible,maintenance,indisponible',
            ],
        ]);

        Salle::create($validated);

        return redirect()
            ->route('salles.index')
            ->with(
                'success',
                'Salle ajoutée avec succès.'
            );
    }

    public function show(Salle $salle)
    {
        $salle->load('site.organisation');

        return view(
            'salles.show',
            compact('salle')
        );
    }

    public function update(Request $request, Salle $salle)
    {
        $validated = $request->validate([
            'site_id' => [
                'required',
                'exists:sites,id',
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

                Rule::unique('salles', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'site_id',
                            $request->site_id
                        );
                    })
                    ->ignore($salle->id),
            ],

            'capacite' => [
                'required',
                'integer',
                'min:1',
                'max:5000',
            ],

            'type' => [
                'nullable',
                'string',
                'max:100',
            ],

            'batiment' => [
                'nullable',
                'string',
                'max:100',
            ],

            'etage' => [
                'nullable',
                'string',
                'max:50',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'statut' => [
                'required',
                'in:disponible,maintenance,indisponible',
            ],
        ]);

        $salle->update($validated);

        return redirect()
            ->route('salles.index')
            ->with(
                'success',
                'Salle modifiée avec succès.'
            );
    }

    public function destroy(Salle $salle)
    {
        try {

            $salle->delete();

            return redirect()
                ->route('salles.index')
                ->with(
                    'success',
                    'Salle supprimée avec succès.'
                );

        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()
                ->route('salles.index')
                ->with(
                    'error',
                    'Impossible de supprimer cette salle car elle est utilisée par d’autres données.'
                );

        } catch (\Exception $e) {

            return redirect()
                ->route('salles.index')
                ->with(
                    'error',
                    'Impossible de supprimer cette salle.'
                );
        }
    }
}
