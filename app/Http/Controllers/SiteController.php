<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Afficher la liste des sites.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $organisationId = $request->input('organisation_id');

        $sites = Site::with('organisation')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', '%' . $search . '%')
                        ->orWhere('nom', 'like', '%' . $search . '%')
                        ->orWhere('ville', 'like', '%' . $search . '%');
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

        return view('sites.index', compact(
            'sites',
            'organisations',
            'search'
        ));
    }


    /**
     * Enregistrer un nouveau site.
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
                'max:255',
            ],

            'code' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'adresse' => [
                'nullable',
                'string',
            ],

            'ville' => [
                'nullable',
                'string',
                'max:100',
            ],

            'pays' => [
                'nullable',
                'string',
                'max:100',
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

        Site::create($validated);

        return redirect()
            ->route('sites.index')
            ->with('success', 'Site ajouté avec succès.');
    }


    /**
     * Afficher un site.
     */
    public function show(Site $site)
    {
        $site->load('organisation');

        return view('sites.show', compact('site'));
    }


    /**
     * Modifier un site.
     */
    public function update(Request $request, Site $site)
    {
        $validated = $request->validate([
            'organisation_id' => [
                'required',
                'exists:organisations,id',
            ],

            'nom' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'adresse' => [
                'nullable',
                'string',
            ],

            'ville' => [
                'nullable',
                'string',
                'max:100',
            ],

            'pays' => [
                'nullable',
                'string',
                'max:100',
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

        $site->update($validated);

        return redirect()
            ->route('sites.index')
            ->with('success', 'Site modifié avec succès.');
    }


    /**
     * Supprimer un site.
     */
    public function destroy(Site $site)
    {
        try {

            /*
         * Plus tard, vérifier ici les données
         * qui dépendent de ce site.
         */

            $site->delete();

            return redirect()
                ->route('sites.index')
                ->with(
                    'success',
                    'Site supprimé avec succès.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('sites.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce site.'
                );
        }
    }
}
