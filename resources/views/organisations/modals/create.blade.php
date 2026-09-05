<div class="modal fade"
     id="modalAjouterOrganisation"
     tabindex="-1"
     aria-labelledby="modalAjouterOrganisationLabel"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">

            {{-- ================= HEADER ================= --}}
            <div class="modal-header bg-primary text-white px-4 py-3 border-0">

                <div>
                    <h5 class="modal-title fw-semibold mb-1"
                        id="modalAjouterOrganisationLabel">
                        Ajouter une organisation
                    </h5>

                    <small class="opacity-75">
                        Renseignez les informations de votre organisation scolaire
                    </small>
                </div>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- ================= FORMULAIRE ================= --}}
            <form action="{{ route('organisations.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-body px-4 py-4">

                    {{-- INFORMATIONS GENERALES --}}
                    <div class="mb-4">

                        <div class="d-flex align-items-center mb-3">

                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-2">
                                <i class="bi bi-building"></i>
                            </div>

                            <div>
                                <h6 class="fw-bold mb-0">
                                    Informations générales
                                </h6>

                                <small class="text-muted">
                                    Identité et coordonnées
                                </small>
                            </div>

                        </div>


                        <div class="row">

                            {{-- CODE --}}
                            <div class="col-md-4 mb-3">

                                <label for="code" class="form-label fw-semibold">
                                    Code
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="code"
                                       id="code"
                                       class="form-control @error('code') is-invalid @enderror"
                                       value="{{ old('code') }}"
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

                                <label for="nom" class="form-label fw-semibold">
                                    Nom de l'organisation
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="nom"
                                       id="nom"
                                       class="form-control @error('nom') is-invalid @enderror"
                                       value="{{ old('nom') }}"
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

                                <label for="email" class="form-label fw-semibold">
                                    Email
                                </label>

                                <input type="email"
                                       name="email"
                                       id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="contact@ecole.com">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- TELEPHONE --}}
                            <div class="col-md-6 mb-3">

                                <label for="telephone" class="form-label fw-semibold">
                                    Téléphone
                                </label>

                                <input type="text"
                                       name="telephone"
                                       id="telephone"
                                       class="form-control @error('telephone') is-invalid @enderror"
                                       value="{{ old('telephone') }}"
                                       placeholder="+242 ...">

                                @error('telephone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- ADRESSE --}}
                            <div class="col-md-12">

                                <label for="adresse" class="form-label fw-semibold">
                                    Adresse
                                </label>

                                <textarea name="adresse"
                                          id="adresse"
                                          rows="2"
                                          class="form-control @error('adresse') is-invalid @enderror"
                                          placeholder="Adresse complète de l'organisation">{{ old('adresse') }}</textarea>

                                @error('adresse')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- ================= IDENTITE ================= --}}
                    <div class="mb-4 pt-3 border-top">

                        <div class="d-flex align-items-center mb-3">

                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-2">
                                <i class="bi bi-image"></i>
                            </div>

                            <div>
                                <h6 class="fw-bold mb-0">
                                    Identité visuelle
                                </h6>

                                <small class="text-muted">
                                    Logo et statut de l'organisation
                                </small>
                            </div>

                        </div>


                        <div class="row">

                            {{-- LOGO --}}
                            <div class="col-md-7 mb-3">

                                <label class="form-label fw-semibold">
                                    Logo
                                </label>

                                <div class="border rounded-3 p-3 bg-light">

                                    <div class="d-flex align-items-center">

                                        {{-- PREVIEW --}}
                                        <div class="border bg-white rounded-3 d-flex align-items-center justify-content-center me-3"
                                             style="width:75px;height:75px;flex-shrink:0;">

                                            <img id="logoPreview"
                                                 src=""
                                                 alt="Aperçu du logo"
                                                 class="d-none"
                                                 style="width:100%;height:100%;object-fit:contain;border-radius:10px;">

                                            <i id="logoPlaceholder"
                                               class="bi bi-image text-secondary"
                                               style="font-size:30px;">
                                            </i>

                                        </div>


                                        {{-- SELECTION --}}
                                        <div>

                                            <div class="fw-semibold mb-1">
                                                Ajouter le logo
                                            </div>

                                            <small class="text-muted d-block mb-2">
                                                PNG, JPG, JPEG ou WEBP · 2 Mo maximum
                                            </small>

                                            <label for="logo"
                                                   class="btn btn-outline-primary btn-sm mb-0">

                                                <i class="bi bi-upload me-1"></i>
                                                Sélectionner

                                            </label>

                                            <input type="file"
                                                   name="logo"
                                                   id="logo"
                                                   class="d-none"
                                                   accept="image/jpeg,image/png,image/webp">

                                        </div>

                                    </div>


                                    {{-- NOM DU FICHIER --}}
                                    <div id="logoFileName"
                                         class="text-primary small fw-semibold mt-3 d-none">
                                    </div>

                                </div>

                                @error('logo')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- STATUT --}}
                            <div class="col-md-5 mb-3">

                                <label for="statut"
                                       class="form-label fw-semibold">
                                    Statut
                                </label>

                                <select name="statut"
                                        id="statut"
                                        class="form-select">

                                    <option value="1"
                                        {{ old('statut', '1') == '1' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0"
                                        {{ old('statut') === '0' ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>

                                <small class="text-muted d-block mt-2">
                                    Une organisation inactive ne sera plus considérée comme active.
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
                                  id="description"
                                  rows="3"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Décrivez brièvement l'organisation...">{{ old('description') }}</textarea>

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
                            class="btn btn-primary px-4">

                        <i class="bi bi-check2 me-1"></i>
                        Enregistrer

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>


{{-- ================= APERCU LOGO ================= --}}
<script>
document.addEventListener('change', function (event) {

    if (event.target.id !== 'logo') {
        return;
    }

    const input = event.target;
    const preview = document.getElementById('logoPreview');
    const placeholder = document.getElementById('logoPlaceholder');
    const fileName = document.getElementById('logoFileName');

    if (input.files && input.files.length > 0) {

        const file = input.files[0];

        preview.src = URL.createObjectURL(file);

        preview.classList.remove('d-none');
        placeholder.classList.add('d-none');

        fileName.textContent = file.name;
        fileName.classList.remove('d-none');

    } else {

        preview.src = '';

        preview.classList.add('d-none');
        placeholder.classList.remove('d-none');

        fileName.textContent = '';
        fileName.classList.add('d-none');
    }
});
</script>
