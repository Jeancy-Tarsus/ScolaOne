<div
    class="modal fade"
    id="modalAjouterClasse"
    tabindex="-1"
    aria-hidden="true"
    data-bs-backdrop="static"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form
                action="{{ route('classes.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        <i class="bi bi-plus-circle me-2 text-primary"></i>
                        Nouvelle classe
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body">

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-1"></i>
                        Sélectionnez d'abord le site. Les années scolaires,
                        groupes et salles seront automatiquement filtrés.
                    </div>


                    <div class="row g-3">

                        {{-- SITE --}}
                        <div class="col-md-12">

                            <label class="form-label fw-semibold">
                                Site <span class="text-danger">*</span>
                            </label>

                            <select
                                name="site_id"
                                id="create_site_id"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Sélectionner un site
                                </option>

                                @foreach($sites as $site)

                                    <option value="{{ $site->id }}">

                                        {{ $site->nom }}
                                        — {{ $site->organisation->nom }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- ANNEE --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Année scolaire
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="annee_scolaire_id"
                                id="create_annee_scolaire_id"
                                class="form-select"
                                required
                                disabled
                            >

                                <option value="">
                                    Sélectionner d'abord un site
                                </option>

                            </select>

                        </div>


                        {{-- GROUPE --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Groupe
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="groupe_id"
                                id="create_groupe_id"
                                class="form-select"
                                required
                                disabled
                            >

                                <option value="">
                                    Sélectionner d'abord un site
                                </option>

                            </select>

                        </div>


                        {{-- SALLE --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Salle
                            </label>

                            <select
                                name="salle_id"
                                id="create_salle_id"
                                class="form-select"
                                disabled
                            >

                                <option value="">
                                    Aucune salle
                                </option>

                            </select>

                        </div>


                        {{-- NOM --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Nom de la classe
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="nom"
                                class="form-control"
                                placeholder="Ex : CP1 A"
                                required
                            >

                        </div>


                        {{-- CODE --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Code
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="code"
                                class="form-control"
                                placeholder="Ex : CP1-A-2627"
                                required
                            >

                        </div>


                        {{-- EFFECTIF --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Effectif maximal
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                name="effectif_max"
                                id="create_effectif_max"
                                class="form-control"
                                min="1"
                                max="5000"
                                value="40"
                                required
                            >

                        </div>


                        {{-- STATUT --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Statut
                            </label>

                            <select
                                name="statut"
                                class="form-select"
                            >

                                <option value="ouverte">
                                    Ouverte
                                </option>

                                <option value="fermee">
                                    Fermée
                                </option>

                                <option value="suspendue">
                                    Suspendue
                                </option>

                            </select>

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="col-md-12">

                            <label class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="3"
                                placeholder="Description de la classe..."
                            ></textarea>

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Annuler
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-check-lg me-1"></i>
                        Enregistrer
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const site = document.getElementById('create_site_id');

    const annee = document.getElementById(
        'create_annee_scolaire_id'
    );

    const groupe = document.getElementById(
        'create_groupe_id'
    );

    const salle = document.getElementById(
        'create_salle_id'
    );


    site.addEventListener('change', function () {

        const siteId = this.value;


        annee.innerHTML =
            '<option value="">Chargement...</option>';

        groupe.innerHTML =
            '<option value="">Chargement...</option>';

        salle.innerHTML =
            '<option value="">Chargement...</option>';


        annee.disabled = true;
        groupe.disabled = true;
        salle.disabled = true;


        if (!siteId) {

            annee.innerHTML =
                '<option value="">Sélectionner d’abord un site</option>';

            groupe.innerHTML =
                '<option value="">Sélectionner d’abord un site</option>';

            salle.innerHTML =
                '<option value="">Aucune salle</option>';

            return;
        }


        fetch(
            "{{ url('/classes/site-data') }}/" + siteId
        )
        .then(response => {

            if (!response.ok) {
                throw new Error('Erreur serveur');
            }

            return response.json();

        })
        .then(data => {

            annee.innerHTML =
                '<option value="">Sélectionner une année</option>';

            data.annees_scolaires.forEach(function(item) {

                annee.innerHTML += `
                    <option value="${item.id}">
                        ${item.libelle}
                    </option>
                `;

            });


            groupe.innerHTML =
                '<option value="">Sélectionner un groupe</option>';

            data.groupes.forEach(function(item) {

                groupe.innerHTML += `
                    <option value="${item.id}">
                        ${item.nom} — ${item.niveau}
                    </option>
                `;

            });


            salle.innerHTML =
                '<option value="">Aucune salle</option>';

            data.salles.forEach(function(item) {

                salle.innerHTML += `
                    <option
                        value="${item.id}"
                        data-capacite="${item.capacite}"
                    >
                        ${item.nom} — ${item.code} (${item.capacite} places)
                    </option>
                `;

            });


            annee.disabled = false;
            groupe.disabled = false;
            salle.disabled = false;

        })
        .catch(function(error) {

            console.error(error);

            annee.innerHTML =
                '<option value="">Erreur de chargement</option>';

            groupe.innerHTML =
                '<option value="">Erreur de chargement</option>';

            salle.innerHTML =
                '<option value="">Erreur de chargement</option>';

        });

    });


    salle.addEventListener('change', function () {

        const selected =
            this.options[this.selectedIndex];

        const capacite =
            selected.dataset.capacite;

        if (capacite) {

            document.getElementById(
                'create_effectif_max'
            ).max = capacite;

        } else {

            document.getElementById(
                'create_effectif_max'
            ).max = 5000;

        }

    });

});

</script>
