<div
    class="modal fade"
    id="modalModifierClasse{{ $classe->id }}"
    tabindex="-1"
    aria-hidden="true"
    data-bs-backdrop="static"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form
                action="{{ route('classes.update', $classe) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square me-2 text-warning"></i>
                        Modifier la classe
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
                        Le site détermine les années, groupes et salles disponibles.
                    </div>


                    <div class="row g-3">

                        {{-- SITE --}}
                        <div class="col-md-12">

                            <label class="form-label fw-semibold">
                                Site <span class="text-danger">*</span>
                            </label>

                            <select
                                name="site_id"
                                id="edit_site_id_{{ $classe->id }}"
                                class="form-select"
                                required
                            >

                                @foreach($sites as $site)

                                    <option
                                        value="{{ $site->id }}"
                                        {{ $classe->site_id == $site->id ? 'selected' : '' }}
                                    >

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
                                id="edit_annee_{{ $classe->id }}"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Chargement...
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
                                id="edit_groupe_{{ $classe->id }}"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Chargement...
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
                                id="edit_salle_{{ $classe->id }}"
                                class="form-select"
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
                                value="{{ $classe->nom }}"
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
                                value="{{ $classe->code }}"
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
                                class="form-control"
                                min="1"
                                max="5000"
                                value="{{ $classe->effectif_max }}"
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

                                <option
                                    value="ouverte"
                                    {{ $classe->statut === 'ouverte' ? 'selected' : '' }}
                                >
                                    Ouverte
                                </option>

                                <option
                                    value="fermee"
                                    {{ $classe->statut === 'fermee' ? 'selected' : '' }}
                                >
                                    Fermée
                                </option>

                                <option
                                    value="suspendue"
                                    {{ $classe->statut === 'suspendue' ? 'selected' : '' }}
                                >
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
                            >{{ $classe->description }}</textarea>

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
                        class="btn btn-warning"
                    >
                        <i class="bi bi-check-lg me-1"></i>
                        Enregistrer les modifications
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const site = document.getElementById(
        'edit_site_id_{{ $classe->id }}'
    );

    const annee = document.getElementById(
        'edit_annee_{{ $classe->id }}'
    );

    const groupe = document.getElementById(
        'edit_groupe_{{ $classe->id }}'
    );

    const salle = document.getElementById(
        'edit_salle_{{ $classe->id }}'
    );


    const ancienneAnnee =
        "{{ $classe->annee_scolaire_id }}";

    const ancienGroupe =
        "{{ $classe->groupe_id }}";

    const ancienneSalle =
        "{{ $classe->salle_id }}";


    function chargerDonnees() {

        const siteId = site.value;

        if (!siteId) {
            return;
        }


        fetch(
            "{{ url('/classes/site-data') }}/" + siteId
        )
        .then(response => response.json())
        .then(data => {


            // Années
            annee.innerHTML =
                '<option value="">Sélectionner une année</option>';

            data.annees_scolaires.forEach(function(item) {

                const selected =
                    item.id == ancienneAnnee
                        ? 'selected'
                        : '';

                annee.innerHTML += `
                    <option
                        value="${item.id}"
                        ${selected}
                    >
                        ${item.libelle}
                    </option>
                `;

            });


            // Groupes
            groupe.innerHTML =
                '<option value="">Sélectionner un groupe</option>';

            data.groupes.forEach(function(item) {

                const selected =
                    item.id == ancienGroupe
                        ? 'selected'
                        : '';

                groupe.innerHTML += `
                    <option
                        value="${item.id}"
                        ${selected}
                    >
                        ${item.nom} — ${item.niveau}
                    </option>
                `;

            });


            // Salles
            salle.innerHTML =
                '<option value="">Aucune salle</option>';

            data.salles.forEach(function(item) {

                const selected =
                    item.id == ancienneSalle
                        ? 'selected'
                        : '';

                salle.innerHTML += `
                    <option
                        value="${item.id}"
                        data-capacite="${item.capacite}"
                        ${selected}
                    >
                        ${item.nom} — ${item.code}
                        (${item.capacite} places)
                    </option>
                `;

            });

        })
        .catch(function(error) {

            console.error(
                'Erreur chargement données :',
                error
            );

        });

    }


    // Charger automatiquement à l'ouverture
    const modal =
        document.getElementById(
            'modalModifierClasse{{ $classe->id }}'
        );

    modal.addEventListener(
        'shown.bs.modal',
        function () {
            chargerDonnees();
        }
    );


    // Si le site change
    site.addEventListener(
        'change',
        function () {

            // Pour un nouveau site,
            // on ne garde plus les anciennes valeurs.

            annee.innerHTML =
                '<option value="">Chargement...</option>';

            groupe.innerHTML =
                '<option value="">Chargement...</option>';

            salle.innerHTML =
                '<option value="">Chargement...</option>';


            fetch(
                "{{ url('/classes/site-data') }}/" + this.value
            )
            .then(response => response.json())
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
                            ${item.nom} — ${item.code}
                            (${item.capacite} places)
                        </option>
                    `;

                });

            });

        }
    );

});

</script>
