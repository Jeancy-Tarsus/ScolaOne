<div class="modal fade"
     id="modalModifierOrganisation{{ $organisation->id }}"
     tabindex="-1"
     aria-labelledby="modalModifierOrganisationLabel{{ $organisation->id }}"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">

            {{-- ================= HEADER ================= --}}
            <div class="modal-header bg-warning px-4 py-3 border-0">

                <div>
                    <h5 class="modal-title fw-semibold mb-1"
                        id="modalModifierOrganisationLabel{{ $organisation->id }}">

                        Modifier l'organisation

                    </h5>

                    <small class="text-dark opacity-75">
                        Modifier les informations de cette organisation
                    </small>
                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- ================= FORMULAIRE ================= --}}
            <form action="{{ route('organisations.update', $organisation->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')


                {{-- ================= BODY ================= --}}
                <div class="modal-body px-4 py-4">


                    {{-- ================= IDENTITE ================= --}}
                    <div class="text-center mb-4">

                        {{-- LOGO --}}
                        <div class="mb-3">

                            @if($organisation->logo)

                                <div class="d-inline-flex align-items-center justify-content-center border rounded-4 bg-light p-2"
                                     style="width:130px;height:130px;">

                                    <img src="{{ asset('storage/' . $organisation->logo) }}"
                                         alt="Logo de {{ $organisation->nom }}"
                                         class="img-fluid"
                                         style="width:100%;height:100%;object-fit:contain;border-radius:12px;">

                                </div>

                            @else

                                <div class="d-flex align-items-center justify-content-center mx-auto border rounded-4 bg-light"
                                     style="width:130px;height:130px;">

                                    <div>

                                        <i class="bi bi-image text-secondary"
                                           style="font-size:38px;">
                                        </i>

                                        <div class="small text-muted mt-1">
                                            Aucun logo
                                        </div>

                                    </div>

                                </div>

                            @endif

                        </div>


                        {{-- NOM --}}
                        <h5 class="fw-bold mb-1">

                            {{ $organisation->nom }}

                        </h5>


                        {{-- CODE --}}
                        <span class="badge text-bg-secondary">

                            {{ $organisation->code }}

                        </span>

                    </div>


                    {{-- ================= INFORMATIONS ================= --}}
                    <div class="pt-3 border-top">

                        <div class="d-flex align-items-center mb-3">

                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-2">

                                <i class="bi bi-info-circle"></i>

                            </div>

                            <div>

                                <h6 class="fw-bold mb-0">
                                    Informations générales
                                </h6>

                                <small class="text-muted">
                                    Coordonnées de l'organisation
                                </small>

                            </div>

                        </div>


                        <div class="row">

                            {{-- CODE --}}
                            <div class="col-md-4 mb-3">

                                <label for="code_{{ $organisation->id }}"
                                       class="form-label fw-semibold">

                                    Code
                                    <span class="text-danger">*</span>

                                </label>

                                <input type="text"
                                       name="code"
                                       id="code_{{ $organisation->id }}"
                                       class="form-control @error('code') is-invalid @enderror"
                                       value="{{ old('code', $organisation->code) }}"
                                       placeholder="Ex : GS001"
                                       required>

                                @error('code')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- NOM --}}
                            <div class="col-md-8 mb-3">

                                <label for="nom_{{ $organisation->id }}"
                                       class="form-label fw-semibold">

                                    Nom de l'organisation
                                    <span class="text-danger">*</span>

                                </label>

                                <input type="text"
                                       name="nom"
                                       id="nom_{{ $organisation->id }}"
                                       class="form-control @error('nom') is-invalid @enderror"
                                       value="{{ old('nom', $organisation->nom) }}"
                                       placeholder="Ex : Groupe Scolaire La Réussite"
                                       required>

                                @error('nom')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- EMAIL --}}
                            <div class="col-md-6 mb-3">

                                <label for="email_{{ $organisation->id }}"
                                       class="form-label fw-semibold">

                                    Email

                                </label>

                                <input type="email"
                                       name="email"
                                       id="email_{{ $organisation->id }}"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $organisation->email) }}"
                                       placeholder="contact@ecole.com">

                                @error('email')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- TELEPHONE --}}
                            <div class="col-md-6 mb-3">

                                <label for="telephone_{{ $organisation->id }}"
                                       class="form-label fw-semibold">

                                    Téléphone

                                </label>

                                <input type="text"
                                       name="telephone"
                                       id="telephone_{{ $organisation->id }}"
                                       class="form-control @error('telephone') is-invalid @enderror"
                                       value="{{ old('telephone', $organisation->telephone) }}"
                                       placeholder="+242 ...">

                                @error('telephone')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- ADRESSE --}}
                            <div class="col-md-12 mb-3">

                                <label for="adresse_{{ $organisation->id }}"
                                       class="form-label fw-semibold">

                                    Adresse

                                </label>

                                <textarea name="adresse"
                                          id="adresse_{{ $organisation->id }}"
                                          rows="2"
                                          class="form-control @error('adresse') is-invalid @enderror"
                                          placeholder="Adresse complète de l'organisation">{{ old('adresse', $organisation->adresse) }}</textarea>

                                @error('adresse')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- ================= LOGO + STATUT ================= --}}
                    <div class="pt-3 mt-2 border-top">

                        <div class="d-flex align-items-center mb-3">

                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-2">

                                <i class="bi bi-image"></i>

                            </div>

                            <div>

                                <h6 class="fw-bold mb-0">
                                    Identité visuelle
                                </h6>

                                <small class="text-muted">
                                    Logo et statut
                                </small>

                            </div>

                        </div>


                        <div class="row">

                            {{-- LOGO --}}
                            <div class="col-md-7 mb-3">

                                <label for="logo_{{ $organisation->id }}"
                                       class="form-label fw-semibold">

                                    Remplacer le logo

                                </label>


                                <div class="border rounded-3 bg-light p-3">

                                    <div class="d-flex align-items-center">

                                        {{-- APERCU --}}
                                        <div class="border bg-white rounded-3 d-flex align-items-center justify-content-center me-3"
                                             style="width:75px;height:75px;flex-shrink:0;overflow:hidden;">

                                            @if($organisation->logo)

                                                <img id="logoPreview{{ $organisation->id }}"
                                                     src="{{ asset('storage/' . $organisation->logo) }}"
                                                     alt="Logo"
                                                     style="width:100%;height:100%;object-fit:contain;">

                                                <i id="logoPlaceholder{{ $organisation->id }}"
                                                   class="bi bi-image text-secondary d-none"
                                                   style="font-size:30px;">
                                                </i>

                                            @else

                                                <img id="logoPreview{{ $organisation->id }}"
                                                     src=""
                                                     alt="Aperçu"
                                                     class="d-none"
                                                     style="width:100%;height:100%;object-fit:contain;">

                                                <i id="logoPlaceholder{{ $organisation->id }}"
                                                   class="bi bi-image text-secondary"
                                                   style="font-size:30px;">
                                                </i>

                                            @endif

                                        </div>


                                        {{-- SELECTION --}}
                                        <div>

                                            <div class="fw-semibold mb-1">
                                                Modifier le logo
                                            </div>

                                            <small class="text-muted d-block mb-2">
                                                Laisser vide pour conserver le logo actuel.
                                            </small>

                                            <label for="logo_{{ $organisation->id }}"
                                                   class="btn btn-outline-primary btn-sm mb-0">

                                                <i class="bi bi-upload me-1"></i>

                                                Sélectionner

                                            </label>

                                            <input type="file"
                                                   name="logo"
                                                   id="logo_{{ $organisation->id }}"
                                                   class="d-none"
                                                   accept="image/jpeg,image/png,image/webp">

                                        </div>

                                    </div>


                                    {{-- NOM FICHIER --}}
                                    <div id="logoFileName{{ $organisation->id }}"
                                         class="small text-primary fw-semibold mt-3 d-none">
                                    </div>

                                </div>


                                <small class="text-muted d-block mt-2">
                                    JPG, JPEG, PNG ou WEBP — 2 Mo maximum.
                                </small>


                                @error('logo')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- STATUT --}}
                            <div class="col-md-5 mb-3">

                                <label for="statut_{{ $organisation->id }}"
                                       class="form-label fw-semibold">

                                    Statut

                                </label>

                                <select name="statut"
                                        id="statut_{{ $organisation->id }}"
                                        class="form-select">

                                    <option value="1"
                                        {{ old('statut', $organisation->statut ? '1' : '0') == '1' ? 'selected' : '' }}>

                                        Active

                                    </option>

                                    <option value="0"
                                        {{ old('statut', $organisation->statut ? '1' : '0') == '0' ? 'selected' : '' }}>

                                        Inactive

                                    </option>

                                </select>

                                <small class="text-muted d-block mt-2">
                                    Détermine l'état actuel de l'organisation.
                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- ================= DESCRIPTION ================= --}}
                    <div class="pt-3 border-top">

                        <div class="d-flex align-items-center mb-3">

                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-2">

                                <i class="bi bi-card-text"></i>

                            </div>

                            <div>

                                <h6 class="fw-bold mb-0">
                                    Description
                                </h6>

                                <small class="text-muted">
                                    Présentation de l'organisation
                                </small>

                            </div>

                        </div>


                        <textarea name="description"
                                  id="description_{{ $organisation->id }}"
                                  rows="3"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Décrivez brièvement l'organisation...">{{ old('description', $organisation->description) }}</textarea>

                        @error('description')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- ================= FOOTER ================= --}}
                <div class="modal-footer bg-light border-0 px-4 py-3">

                    <button type="button"
                            class="btn btn-light border px-4"
                            data-bs-dismiss="modal">

                        Annuler

                    </button>


                    <button type="submit"
                            class="btn btn-warning px-4">

                        <i class="bi bi-check2 me-1"></i>

                        Enregistrer les modifications

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =====================================================
     APERCU DU NOUVEAU LOGO
====================================================== --}}

<script>

document.addEventListener('change', function (event) {

    if (event.target.id !== 'logo_{{ $organisation->id }}') {
        return;
    }

    const input = event.target;

    const preview = document.getElementById(
        'logoPreview{{ $organisation->id }}'
    );

    const placeholder = document.getElementById(
        'logoPlaceholder{{ $organisation->id }}'
    );

    const fileName = document.getElementById(
        'logoFileName{{ $organisation->id }}'
    );


    if (input.files && input.files.length > 0) {

        const file = input.files[0];

        preview.src = URL.createObjectURL(file);

        preview.classList.remove('d-none');

        placeholder.classList.add('d-none');

        fileName.textContent = file.name;

        fileName.classList.remove('d-none');

    }

});

</script>
