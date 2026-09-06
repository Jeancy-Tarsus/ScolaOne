<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\AnneeScolaire;
use App\Models\Groupe;
use App\Models\Salle;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class ClasseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $anneeScolaireId = $request->input('annee_scolaire_id');

        $classes = Classe::with([
            'site.organisation',
            'anneeScolaire.organisation',
            'groupe.niveau.cycle.organisation',
            'salle.site.organisation',
        ])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {

                    $q->where('nom', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')

                        ->orWhereHas('groupe', function ($groupe) use ($search) {
                            $groupe->where('nom', 'like', '%' . $search . '%')
                                ->orWhere('code', 'like', '%' . $search . '%');
                        })

                        ->orWhereHas('site', function ($site) use ($search) {
                            $site->where('nom', 'like', '%' . $search . '%')
                                ->orWhere('code', 'like', '%' . $search . '%');
                        })

                        ->orWhereHas('salle', function ($salle) use ($search) {
                            $salle->where('nom', 'like', '%' . $search . '%')
                                ->orWhere('code', 'like', '%' . $search . '%');
                        });
                });
            })
            ->when($anneeScolaireId, function ($query, $anneeScolaireId) {
                $query->where(
                    'annee_scolaire_id',
                    $anneeScolaireId
                );
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $sites = Site::with('organisation')
            ->where('statut', true)
            ->orderBy('nom')
            ->get();

        $anneesScolaires = AnneeScolaire::with('organisation')
            ->orderByDesc('date_debut')
            ->get();

        $groupes = Groupe::with('niveau.cycle.organisation')
            ->where('statut', true)
            ->orderBy('nom')
            ->get();

        $salles = Salle::with('site.organisation')
            ->where('statut', 'disponible')
            ->orderBy('nom')
            ->get();

        return view('classes.index', compact(
            'classes',
            'sites',
            'anneesScolaires',
            'groupes',
            'salles',
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

            'annee_scolaire_id' => [
                'required',
                'exists:annees_scolaires,id',
            ],

            'groupe_id' => [
                'required',
                'exists:groupes,id',
            ],

            'salle_id' => [
                'nullable',
                'exists:salles,id',
            ],

            'nom' => [
                'required',
                'string',
                'max:100',
            ],

            'code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('classes', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'annee_scolaire_id',
                            $request->annee_scolaire_id
                        );
                    }),
            ],

            'effectif_max' => [
                'required',
                'integer',
                'min:1',
                'max:5000',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'statut' => [
                'required',
                'in:ouverte,fermee,suspendue',
            ],
        ]);


        // Vérifier le site
        $site = Site::findOrFail($request->site_id);

        if (!$site->statut) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Le site sélectionné est désactivé.'
                );
        }


        // Vérifier que l'année appartient à l'organisation du site
        $annee = AnneeScolaire::findOrFail(
            $request->annee_scolaire_id
        );

        if ($annee->organisation_id != $site->organisation_id) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Cette année scolaire ne correspond pas au site sélectionné.'
                );
        }


        // Vérifier que le groupe appartient à la même organisation
        $groupe = Groupe::with('niveau.cycle')
            ->findOrFail($request->groupe_id);

        if (
            $groupe->niveau->cycle->organisation_id
            != $site->organisation_id
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ce groupe ne correspond pas au site sélectionné.'
                );
        }


        // Un groupe ne peut avoir qu'une classe pour une année
        $classeExiste = Classe::where(
            'annee_scolaire_id',
            $request->annee_scolaire_id
        )
            ->where(
                'groupe_id',
                $request->groupe_id
            )
            ->exists();

        if ($classeExiste) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ce groupe possède déjà une classe pour cette année scolaire.'
                );
        }


        // Vérifier la salle
        if ($request->filled('salle_id')) {

            $salle = Salle::findOrFail(
                $request->salle_id
            );

            if ($salle->site_id != $site->id) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'La salle sélectionnée n’appartient pas à ce site.'
                    );
            }

            if ($salle->statut !== 'disponible') {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'La salle sélectionnée n’est pas disponible.'
                    );
            }

            if ($request->effectif_max > $salle->capacite) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'L’effectif maximal dépasse la capacité de la salle.'
                    );
            }
        }


        Classe::create($validated);

        return redirect()
            ->route('classes.index')
            ->with(
                'success',
                'Classe ajoutée avec succès.'
            );
    }


    public function show(Classe $classe)
    {
        $classe->load([
            'site.organisation',
            'anneeScolaire.organisation',
            'groupe.niveau.cycle.organisation',
            'salle.site.organisation',
        ]);

        return view(
            'classes.show',
            compact('classe')
        );
    }


    public function update(
        Request $request,
        Classe $classe
    ) {
        $validated = $request->validate([
            'site_id' => [
                'required',
                'exists:sites,id',
            ],

            'annee_scolaire_id' => [
                'required',
                'exists:annees_scolaires,id',
            ],

            'groupe_id' => [
                'required',
                'exists:groupes,id',
            ],

            'salle_id' => [
                'nullable',
                'exists:salles,id',
            ],

            'nom' => [
                'required',
                'string',
                'max:100',
            ],

            'code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('classes', 'code')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'annee_scolaire_id',
                            $request->annee_scolaire_id
                        );
                    })
                    ->ignore($classe->id),
            ],

            'effectif_max' => [
                'required',
                'integer',
                'min:1',
                'max:5000',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'statut' => [
                'required',
                'in:ouverte,fermee,suspendue',
            ],
        ]);


        // Vérifier le site
        $site = Site::findOrFail($request->site_id);

        if (!$site->statut) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Le site sélectionné est désactivé.'
                );
        }


        // Vérifier l'année
        $annee = AnneeScolaire::findOrFail(
            $request->annee_scolaire_id
        );

        if ($annee->organisation_id != $site->organisation_id) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Cette année scolaire ne correspond pas au site sélectionné.'
                );
        }


        // Vérifier le groupe
        $groupe = Groupe::with('niveau.cycle')
            ->findOrFail($request->groupe_id);

        if (
            $groupe->niveau->cycle->organisation_id
            != $site->organisation_id
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ce groupe ne correspond pas au site sélectionné.'
                );
        }


        // Vérifier l'unicité groupe + année
        $classeExiste = Classe::where(
            'annee_scolaire_id',
            $request->annee_scolaire_id
        )
            ->where(
                'groupe_id',
                $request->groupe_id
            )
            ->where(
                'id',
                '!=',
                $classe->id
            )
            ->exists();

        if ($classeExiste) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ce groupe possède déjà une classe pour cette année scolaire.'
                );
        }


        // Vérifier la salle
        if ($request->filled('salle_id')) {

            $salle = Salle::findOrFail(
                $request->salle_id
            );

            if ($salle->site_id != $site->id) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'La salle sélectionnée n’appartient pas à ce site.'
                    );
            }

            if ($salle->statut !== 'disponible') {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'La salle sélectionnée n’est pas disponible.'
                    );
            }

            if ($request->effectif_max > $salle->capacite) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'L’effectif maximal dépasse la capacité de la salle.'
                    );
            }
        }


        $classe->update($validated);

        return redirect()
            ->route('classes.index')
            ->with(
                'success',
                'Classe modifiée avec succès.'
            );
    }


    public function destroy(Classe $classe)
    {
        try {

            $classe->delete();

            return redirect()
                ->route('classes.index')
                ->with(
                    'success',
                    'Classe supprimée avec succès.'
                );

        } catch (QueryException $e) {

            return redirect()
                ->route('classes.index')
                ->with(
                    'error',
                    'Impossible de supprimer cette classe car elle est utilisée par d’autres données.'
                );

        } catch (\Exception $e) {

            return redirect()
                ->route('classes.index')
                ->with(
                    'error',
                    'Impossible de supprimer cette classe.'
                );
        }
    }


    /**
     * Données liées au site sélectionné
     */
    public function siteData(Site $site)
    {
        $anneesScolaires = AnneeScolaire::where(
            'organisation_id',
            $site->organisation_id
        )
            ->orderByDesc('date_debut')
            ->get([
                'id',
                'libelle',
                'date_debut',
                'date_fin',
            ]);


        $groupes = Groupe::with([
            'niveau',
            'niveau.cycle',
        ])
            ->whereHas(
                'niveau.cycle',
                function ($query) use ($site) {

                    $query->where(
                        'organisation_id',
                        $site->organisation_id
                    );
                }
            )
            ->where(
                'statut',
                true
            )
            ->orderBy('nom')
            ->get();


        $salles = Salle::where(
            'site_id',
            $site->id
        )
            ->where(
                'statut',
                'disponible'
            )
            ->orderBy('nom')
            ->get([
                'id',
                'nom',
                'code',
                'capacite',
                'type',
            ]);


        return response()->json([

            'annees_scolaires' => $anneesScolaires->map(
                function ($annee) {

                    return [
                        'id' => $annee->id,
                        'libelle' => $annee->libelle,
                    ];
                }
            ),

            'groupes' => $groupes->map(
                function ($groupe) {

                    return [
                        'id' => $groupe->id,
                        'nom' => $groupe->nom,
                        'code' => $groupe->code,
                        'niveau' => $groupe->niveau->nom,
                    ];
                }
            ),

            'salles' => $salles->map(
                function ($salle) {

                    return [
                        'id' => $salle->id,
                        'nom' => $salle->nom,
                        'code' => $salle->code,
                        'capacite' => $salle->capacite,
                        'type' => $salle->type,
                    ];
                }
            ),
        ]);
    }
}
