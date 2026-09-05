<div class="modal fade"
     id="modalAjouterSite"
     tabindex="-1"
     aria-labelledby="modalAjouterSiteLabel"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">

                <h5 class="modal-title fw-bold" id="modalAjouterSiteLabel">

                    <i class="bi bi-geo-alt me-2 text-primary"></i>

                    Ajouter un nouveau site

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- FORMULAIRE --}}
            <form action="{{ route('sites.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- ORGANISATION --}}
                        <div class="col-md-6">

                            <label for="organisation_id" class="form-label fw-semibold">
                                Organisation <span class="text-danger">*</span>
                            </label>

                            <select name="organisation_id"
                                    id="organisation_id"
                                    class="form-select"
                                    required>

                                <option value="">
                                    -- Sélectionner une organisation --
                                </option>

                                @foreach($organisations as $organisation)

                                    <option value="{{ $organisation->id }}"
                                        {{ old('organisation_id') == $organisation->id ? 'selected' : '' }}>

                                        {{ $organisation->nom }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- CODE --}}
                        <div class="col-md-6">

                            <label for="code" class="form-label fw-semibold">
                                Code du site <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="code"
                                   id="code"
                                   class="form-control"
                                   value="{{ old('code') }}"
                                   placeholder="Ex : SITE-BRA-001"
                                   required>

                        </div>


                        {{-- NOM --}}
                        <div class="col-md-6">

                            <label for="nom" class="form-label fw-semibold">
                                Nom du site <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="nom"
                                   id="nom"
                                   class="form-control"
                                   value="{{ old('nom') }}"
                                   placeholder="Ex : Établissement Centre"
                                   required>

                        </div>


                        {{-- VILLE --}}
                        <div class="col-md-6">

                            <label for="ville" class="form-label fw-semibold">
                                Ville
                            </label>

                            <input type="text"
                                   name="ville"
                                   id="ville"
                                   class="form-control"
                                   value="{{ old('ville') }}"
                                   placeholder="Ex : Brazzaville">

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <label for="email" class="form-label fw-semibold">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   placeholder="site@ecole.com">

                        </div>


                        {{-- TELEPHONE --}}
                        <div class="col-md-6">

                            <label for="telephone" class="form-label fw-semibold">
                                Téléphone
                            </label>

                            <input type="text"
                                   name="telephone"
                                   id="telephone"
                                   class="form-control"
                                   value="{{ old('telephone') }}"
                                   placeholder="+242 06 000 00 00">

                        </div>


                        {{-- PAYS --}}
                        <div class="col-md-6">

                            <label for="pays" class="form-label fw-semibold">
                                Pays
                            </label>

                            <input type="text"
                                   name="pays"
                                   id="pays"
                                   class="form-control"
                                   value="{{ old('pays', 'République du Congo') }}">

                        </div>


                        {{-- ADRESSE --}}
                        <div class="col-md-6">

                            <label for="adresse" class="form-label fw-semibold">
                                Adresse
                            </label>

                            <textarea name="adresse"
                                      id="adresse"
                                      class="form-control"
                                      rows="2"
                                      placeholder="Adresse complète du site">{{ old('adresse') }}</textarea>

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="col-12">

                            <label for="description" class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea name="description"
                                      id="description"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Description ou informations complémentaires...">{{ old('description') }}</textarea>

                        </div>


                        {{-- STATUT --}}
                        <div class="col-12">

                            <div class="form-check form-switch">

                                <input type="checkbox"
                                       name="statut"
                                       value="1"
                                       class="form-check-input"
                                       id="statut"
                                       checked>

                                <label class="form-check-label fw-semibold"
                                       for="statut">

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
                            class="btn btn-primary">

                        <i class="bi bi-check-lg me-1"></i>

                        Enregistrer

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
