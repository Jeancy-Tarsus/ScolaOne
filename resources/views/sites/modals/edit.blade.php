<div class="modal fade"
     id="modalModifierSite{{ $site->id }}"
     tabindex="-1"
     aria-labelledby="modalModifierSiteLabel{{ $site->id }}"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">

                <h5 class="modal-title fw-bold"
                    id="modalModifierSiteLabel{{ $site->id }}">

                    <i class="bi bi-pencil-square me-2 text-warning"></i>

                    Modifier le site

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- FORMULAIRE --}}
            <form action="{{ route('sites.update', $site) }}"
                  method="POST">

                @csrf

                @method('PUT')

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- ORGANISATION --}}
                        <div class="col-md-6">

                            <label for="organisation_id_{{ $site->id }}"
                                   class="form-label fw-semibold">

                                Organisation <span class="text-danger">*</span>

                            </label>

                            <select name="organisation_id"
                                    id="organisation_id_{{ $site->id }}"
                                    class="form-select"
                                    required>

                                <option value="">
                                    -- Sélectionner une organisation --
                                </option>

                                @foreach($organisations as $organisation)

                                    <option value="{{ $organisation->id }}"
                                        {{ old('organisation_id', $site->organisation_id) == $organisation->id ? 'selected' : '' }}>

                                        {{ $organisation->nom }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- CODE --}}
                        <div class="col-md-6">

                            <label for="code_{{ $site->id }}"
                                   class="form-label fw-semibold">

                                Code du site <span class="text-danger">*</span>

                            </label>

                            <input type="text"
                                   name="code"
                                   id="code_{{ $site->id }}"
                                   class="form-control"
                                   value="{{ old('code', $site->code) }}"
                                   required>

                        </div>


                        {{-- NOM --}}
                        <div class="col-md-6">

                            <label for="nom_{{ $site->id }}"
                                   class="form-label fw-semibold">

                                Nom du site <span class="text-danger">*</span>

                            </label>

                            <input type="text"
                                   name="nom"
                                   id="nom_{{ $site->id }}"
                                   class="form-control"
                                   value="{{ old('nom', $site->nom) }}"
                                   required>

                        </div>


                        {{-- VILLE --}}
                        <div class="col-md-6">

                            <label for="ville_{{ $site->id }}"
                                   class="form-label fw-semibold">

                                Ville

                            </label>

                            <input type="text"
                                   name="ville"
                                   id="ville_{{ $site->id }}"
                                   class="form-control"
                                   value="{{ old('ville', $site->ville) }}">

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <label for="email_{{ $site->id }}"
                                   class="form-label fw-semibold">

                                Email

                            </label>

                            <input type="email"
                                   name="email"
                                   id="email_{{ $site->id }}"
                                   class="form-control"
                                   value="{{ old('email', $site->email) }}">

                        </div>


                        {{-- TELEPHONE --}}
                        <div class="col-md-6">

                            <label for="telephone_{{ $site->id }}"
                                   class="form-label fw-semibold">

                                Téléphone

                            </label>

                            <input type="text"
                                   name="telephone"
                                   id="telephone_{{ $site->id }}"
                                   class="form-control"
                                   value="{{ old('telephone', $site->telephone) }}">

                        </div>


                        {{-- PAYS --}}
                        <div class="col-md-6">

                            <label for="pays_{{ $site->id }}"
                                   class="form-label fw-semibold">

                                Pays

                            </label>

                            <input type="text"
                                   name="pays"
                                   id="pays_{{ $site->id }}"
                                   class="form-control"
                                   value="{{ old('pays', $site->pays) }}">

                        </div>


                        {{-- ADRESSE --}}
                        <div class="col-md-6">

                            <label for="adresse_{{ $site->id }}"
                                   class="form-label fw-semibold">

                                Adresse

                            </label>

                            <textarea name="adresse"
                                      id="adresse_{{ $site->id }}"
                                      class="form-control"
                                      rows="2">{{ old('adresse', $site->adresse) }}</textarea>

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="col-12">

                            <label for="description_{{ $site->id }}"
                                   class="form-label fw-semibold">

                                Description

                            </label>

                            <textarea name="description"
                                      id="description_{{ $site->id }}"
                                      class="form-control"
                                      rows="3">{{ old('description', $site->description) }}</textarea>

                        </div>


                        {{-- STATUT --}}
                        <div class="col-12">

                            <div class="form-check form-switch">

                                <input type="checkbox"
                                       name="statut"
                                       value="1"
                                       class="form-check-input"
                                       id="statut_{{ $site->id }}"
                                       {{ old('statut', $site->statut) ? 'checked' : '' }}>

                                <label class="form-check-label fw-semibold"
                                       for="statut_{{ $site->id }}">

                                    Site actif

                                </label>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        <i class="bi bi-x-lg me-1"></i>

                        Annuler

                    </button>

                    <button type="submit"
                            class="btn btn-warning">

                        <i class="bi bi-check-lg me-1"></i>

                        Enregistrer les modifications

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
