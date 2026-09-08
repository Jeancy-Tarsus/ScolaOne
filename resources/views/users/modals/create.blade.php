{{-- ============================================================
     MODAL : AJOUTER UN UTILISATEUR
     ============================================================ --}}

<div
    class="modal fade"
    id="modalAjouterUtilisateur"
    tabindex="-1"
    aria-labelledby="modalAjouterUtilisateurLabel"
    aria-hidden="true"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- EN-TÊTE --}}
            <div class="modal-header">

                <h5
                    class="modal-title"
                    id="modalAjouterUtilisateurLabel"
                >

                    <i class="bi bi-person-plus-fill text-primary me-2"></i>

                    Nouvel utilisateur

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fermer"
                ></button>

            </div>


            {{-- FORMULAIRE --}}
            <form
                action="{{ route('users.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-body">

                    <div class="row g-3">


                        {{-- ==================================================
                             NOM
                             ================================================== --}}

                        <div class="col-md-6">

                            <label
                                for="create_name"
                                class="form-label"
                            >

                                Nom complet
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="name"
                                id="create_name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="Ex : Jean Dupont"
                                required
                            >

                            @error('name')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- ==================================================
                             EMAIL
                             ================================================== --}}

                        <div class="col-md-6">

                            <label
                                for="create_email"
                                class="form-label"
                            >

                                Adresse email
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="email"
                                name="email"
                                id="create_email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="Ex : jean@ecole.com"
                                required
                            >

                            @error('email')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- ==================================================
                             MOT DE PASSE
                             ================================================== --}}

                        <div class="col-md-6">

                            <label
                                for="create_password"
                                class="form-label"
                            >

                                Mot de passe
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="password"
                                name="password"
                                id="create_password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Mot de passe"
                                required
                            >

                            @error('password')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- ==================================================
                             CONFIRMATION MOT DE PASSE
                             ================================================== --}}

                        <div class="col-md-6">

                            <label
                                for="create_password_confirmation"
                                class="form-label"
                            >

                                Confirmer le mot de passe
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="create_password_confirmation"
                                class="form-control"
                                placeholder="Confirmer le mot de passe"
                                required
                            >

                        </div>


                        {{-- ==================================================
                             ORGANISATION
                             ================================================== --}}

                        <div class="col-md-6">

                            <label
                                for="create_organisation_id"
                                class="form-label"
                            >

                                Organisation
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="organisation_id"
                                id="create_organisation_id"
                                class="form-select @error('organisation_id') is-invalid @enderror"
                                required
                            >

                                <option value="">
                                    Sélectionner une organisation
                                </option>

                                @foreach($organisations as $organisation)

                                    <option
                                        value="{{ $organisation->id }}"
                                        {{ old('organisation_id') == $organisation->id ? 'selected' : '' }}
                                    >

                                        {{ $organisation->nom }}

                                    </option>

                                @endforeach

                            </select>

                            @error('organisation_id')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- ==================================================
                             SITE
                             ================================================== --}}

                        <div class="col-md-6">

                            <label
                                for="create_site_id"
                                class="form-label"
                            >

                                Site

                            </label>

                            <select
                                name="site_id"
                                id="create_site_id"
                                class="form-select @error('site_id') is-invalid @enderror"
                            >

                                <option value="">
                                    Sélectionner d'abord une organisation
                                </option>

                                @foreach($sites as $site)

                                    <option
                                        value="{{ $site->id }}"
                                        data-organisation="{{ $site->organisation_id }}"
                                        {{ old('site_id') == $site->id ? 'selected' : '' }}
                                    >

                                        {{ $site->nom }}

                                    </option>

                                @endforeach

                            </select>

                            @error('site_id')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- ==================================================
                             RÔLE
                             ================================================== --}}

                        <div class="col-md-6">

                            <label
                                for="create_role"
                                class="form-label"
                            >

                                Rôle
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="role"
                                id="create_role"
                                class="form-select @error('role') is-invalid @enderror"
                                required
                            >

                                <option value="">
                                    Sélectionner un rôle
                                </option>

                                @foreach($roles as $role)

                                    <option
                                        value="{{ $role->name }}"
                                        {{ old('role') == $role->name ? 'selected' : '' }}
                                    >

                                        {{ $role->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('role')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- ==================================================
                             STATUT
                             ================================================== --}}

                        <div class="col-md-6">

                            <label
                                for="create_statut"
                                class="form-label"
                            >

                                Statut

                            </label>

                            <select
                                name="statut"
                                id="create_statut"
                                class="form-select @error('statut') is-invalid @enderror"
                            >

                                <option
                                    value="1"
                                    {{ old('statut', '1') == '1' ? 'selected' : '' }}
                                >
                                    Actif
                                </option>

                                <option
                                    value="0"
                                    {{ old('statut') === '0' ? 'selected' : '' }}
                                >
                                    Inactif
                                </option>

                            </select>

                            @error('statut')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                    </div>


                    {{-- ==================================================
                         INFORMATION
                         ================================================== --}}

                    <div class="alert alert-info mt-4 mb-0">

                        <i class="bi bi-info-circle me-2"></i>

                        Les champs marqués d'un
                        <span class="text-danger">*</span>
                        sont obligatoires.

                    </div>

                </div>


                {{-- ==================================================
                     PIED DU MODAL
                     ================================================== --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >

                        <i class="bi bi-x-lg me-1"></i>

                        Annuler

                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-check-lg me-1"></i>

                        Créer l'utilisateur

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ============================================================
     FILTRAGE DES SITES SELON L'ORGANISATION
     ============================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const organisationSelect =
        document.getElementById('create_organisation_id');

    const siteSelect =
        document.getElementById('create_site_id');


    if (!organisationSelect || !siteSelect) {
        return;
    }


    function filtrerSites() {

        const organisationId = organisationSelect.value;

        const options = siteSelect.querySelectorAll('option[data-organisation]');

        let siteVisible = false;


        options.forEach(function (option) {

            if (
                organisationId !== '' &&
                option.dataset.organisation === organisationId
            ) {

                option.hidden = false;

                siteVisible = true;

            } else {

                option.hidden = true;

            }

        });


        siteSelect.value = '';


        if (organisationId === '') {

            siteSelect.options[0].textContent =
                'Sélectionner d’abord une organisation';

        } else if (!siteVisible) {

            siteSelect.options[0].textContent =
                'Aucun site disponible';

        } else {

            siteSelect.options[0].textContent =
                'Sélectionner un site';

        }

    }


    organisationSelect.addEventListener(
        'change',
        filtrerSites
    );


    filtrerSites();

});

</script>
