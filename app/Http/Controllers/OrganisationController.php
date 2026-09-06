<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganisationController extends Controller
{
    /**
     * Afficher la liste des organisations.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $organisations = Organisation::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', '%' . $search . '%')
                        ->orWhere('nom', 'like', '%' . $search . '%');
                });
            })->latest()
            ->paginate(10)
            ->withQueryString();

        return view('organisations.index', compact(
            'organisations',
            'search'
        ));
    }


    /**
     * Enregistrer une nouvelle organisation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'code' => [
                'required',
                'string',
                'max:255',
                'unique:organisations,code',
            ],

            'nom' => [
                'required',
                'string',
                'max:255',
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

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
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


        /*
         * Gestion du logo
         */
        if ($request->hasFile('logo')) {

            $validated['logo'] = $request
                ->file('logo')
                ->store('organisations', 'public');
        }


        /*
         * Statut
         */
        $validated['statut'] = $request->has('statut');


        /*
         * Création de l'organisation
         */
        Organisation::create($validated);


        return redirect()
            ->route('organisations.index')
            ->with(
                'success',
                'Organisation ajoutée avec succès.'
            );
    }


    /**
     * Mettre à jour une organisation.
     */
    public function update(Request $request, Organisation $organisation)
    {
        $validated = $request->validate([

            'code' => [
                'required',
                'string',
                'max:255',
                'unique:organisations,code,' . $organisation->id,
            ],

            'nom' => [
                'required',
                'string',
                'max:255',
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

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
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


        /*
         * Gestion du nouveau logo
         */
        if ($request->hasFile('logo')) {

            /*
             * Supprimer l'ancien logo
             */
            if (
                $organisation->logo &&
                Storage::disk('public')->exists($organisation->logo)
            ) {

                Storage::disk('public')->delete(
                    $organisation->logo
                );
            }


            /*
             * Enregistrer le nouveau logo
             */
            $validated['logo'] = $request
                ->file('logo')
                ->store('organisations', 'public');
        }


        /*
         * Statut
         */
        $validated['statut'] = $request->has('statut');


        /*
         * Mise à jour
         */
        $organisation->update($validated);


        return redirect()
            ->route('organisations.index')
            ->with(
                'success',
                'Organisation modifiée avec succès.'
            );
    }


    /**
     * Supprimer une organisation.
     */
    public function destroy(Organisation $organisation)
    {
        try {

            /*
         * Vérifier si l'organisation possède encore des sites
         */
            if ($organisation->sites()->exists()) {
                return redirect()
                    ->route('organisations.index')
                    ->with(
                        'error',
                        'Impossible de supprimer cette organisation car elle possède encore des sites.'
                    );
            }

            /*
         * Vérifier si l'organisation possède encore des cycles
         */
            if ($organisation->cycles()->exists()) {
                return redirect()
                    ->route('organisations.index')
                    ->with(
                        'error',
                        'Impossible de supprimer cette organisation car elle possède encore des cycles.'
                    );
            }

            /*
         * Vérifier si l'organisation possède encore des années scolaires
         */
            if ($organisation->anneesScolaires()->exists()) {
                return redirect()
                    ->route('organisations.index')
                    ->with(
                        'error',
                        'Impossible de supprimer cette organisation car elle possède encore des années scolaires.'
                    );
            }

            /*
         * Suppression du logo
         */
            if ($organisation->logo) {

                if (
                    Storage::disk('public')->exists(
                        $organisation->logo
                    )
                ) {
                    Storage::disk('public')->delete(
                        $organisation->logo
                    );
                }
            }

            /*
         * Suppression de l'organisation
         */
            $organisation->delete();

            return redirect()
                ->route('organisations.index')
                ->with(
                    'success',
                    'Organisation supprimée avec succès.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('organisations.index')
                ->with(
                    'error',
                    'Impossible de supprimer cette organisation.'
                );
        }
    }
}
