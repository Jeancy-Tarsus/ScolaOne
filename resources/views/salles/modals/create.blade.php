<div class="modal fade"
     id="modalAjouterSalle"
     tabindex="-1"
     aria-labelledby="modalAjouterSalleLabel"
     aria-hidden="true"
     data-bs-backdrop="static">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalAjouterSalleLabel">
                    <i class="bi bi-door-open me-2"></i>
                    Nouvelle salle
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>
            </div>

            <form action="{{ route('salles.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- Site --}}
                        <div class="col-md-6">
                            <label for="site_id" class="form-label">
                                Site <span class="text-danger">*</span>
                            </label>

                            <select name="site_id"
                                    id="site_id"
                                    class="form-select"
                                    required>

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

                        {{-- Code --}}
                        <div class="col-md-3">
                            <label for="code" class="form-label">
                                Code <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="code"
                                   id="code"
                                   class="form-control"
                                   maxlength="20"
                                   placeholder="S001"
                                   required>
                        </div>

                        {{-- Nom --}}
                        <div class="col-md-3">
                            <label for="nom" class="form-label">
                                Nom <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="nom"
                                   id="nom"
                                   class="form-control"
                                   maxlength="100"
                                   placeholder="Salle 01"
                                   required>
                        </div>

                        {{-- Capacité --}}
                        <div class="col-md-4">
                            <label for="capacite" class="form-label">
                                Capacité <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   name="capacite"
                                   id="capacite"
                                   class="form-control"
                                   min="1"
                                   max="5000"
                                   value="40"
                                   required>
                        </div>

                        {{-- Type --}}
                        <div class="col-md-4">
                            <label for="type" class="form-label">
                                Type
                            </label>

                            <input type="text"
                                   name="type"
                                   id="type"
                                   class="form-control"
                                   maxlength="100"
                                   placeholder="Salle de classe">
                        </div>

                        {{-- Statut --}}
                        <div class="col-md-4">
                            <label for="statut" class="form-label">
                                Statut <span class="text-danger">*</span>
                            </label>

                            <select name="statut"
                                    id="statut"
                                    class="form-select"
                                    required>

                                <option value="disponible">
                                    Disponible
                                </option>

                                <option value="maintenance">
                                    Maintenance
                                </option>

                                <option value="indisponible">
                                    Indisponible
                                </option>

                            </select>
                        </div>

                        {{-- Bâtiment --}}
                        <div class="col-md-6">
                            <label for="batiment" class="form-label">
                                Bâtiment
                            </label>

                            <input type="text"
                                   name="batiment"
                                   id="batiment"
                                   class="form-control"
                                   maxlength="100"
                                   placeholder="Bâtiment A">
                        </div>

                        {{-- Étage --}}
                        <div class="col-md-6">
                            <label for="etage" class="form-label">
                                Étage
                            </label>

                            <input type="text"
                                   name="etage"
                                   id="etage"
                                   class="form-control"
                                   maxlength="50"
                                   placeholder="RDC">
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label for="description" class="form-label">
                                Description
                            </label>

                            <textarea name="description"
                                      id="description"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Description de la salle..."></textarea>
                        </div>

                    </div>

                </div>

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
