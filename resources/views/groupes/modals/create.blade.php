<div class="modal fade"
     id="modalAjouterGroupe"
     tabindex="-1"
     aria-labelledby="modalAjouterGroupeLabel"
     aria-hidden="true"
     data-bs-backdrop="static">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalAjouterGroupeLabel">
                    <i class="bi bi-people me-2"></i>
                    Nouveau groupe
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer"></button>
            </div>

            <form method="POST" action="{{ route('groupes.store') }}">
                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="niveau_id" class="form-label">
                                Niveau <span class="text-danger">*</span>
                            </label>

                            <select name="niveau_id"
                                    id="niveau_id"
                                    class="form-select"
                                    required>
                                <option value="">
                                    Sélectionner un niveau
                                </option>

                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}">
                                        {{ $niveau->nom }}
                                        — {{ $niveau->cycle->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="nom" class="form-label">
                                Nom du groupe <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="nom"
                                   id="nom"
                                   class="form-control"
                                   placeholder="Ex : CM2 A"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label for="code" class="form-label">
                                Code <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="code"
                                   id="code"
                                   class="form-control"
                                   placeholder="Ex : CM2-A"
                                   required>
                        </div>

                        <div class="col-md-3">
                            <label for="ordre" class="form-label">
                                Ordre <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   name="ordre"
                                   id="ordre"
                                   class="form-control"
                                   min="1"
                                   value="1"
                                   required>
                        </div>

                        <div class="col-md-3">
                            <label for="capacite" class="form-label">
                                Capacité <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   name="capacite"
                                   id="capacite"
                                   class="form-control"
                                   min="1"
                                   value="40"
                                   required>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">
                                Description
                            </label>

                            <textarea name="description"
                                      id="description"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Description du groupe..."></textarea>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="statut"
                                       id="statut"
                                       value="1"
                                       checked>

                                <label class="form-check-label"
                                       for="statut">
                                    Groupe actif
                                </label>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
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
