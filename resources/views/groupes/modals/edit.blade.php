<div class="modal fade"
     id="modalModifierGroupe{{ $groupe->id }}"
     tabindex="-1"
     aria-labelledby="modalModifierGroupeLabel{{ $groupe->id }}"
     aria-hidden="true"
     data-bs-backdrop="static">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"
                    id="modalModifierGroupeLabel{{ $groupe->id }}">
                    <i class="bi bi-pencil-square me-2"></i>
                    Modifier le groupe
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer"></button>
            </div>

            <form method="POST"
                  action="{{ route('groupes.update', $groupe) }}">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="niveau_id_{{ $groupe->id }}"
                                   class="form-label">
                                Niveau <span class="text-danger">*</span>
                            </label>

                            <select name="niveau_id"
                                    id="niveau_id_{{ $groupe->id }}"
                                    class="form-select"
                                    required>

                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}"
                                        {{ $groupe->niveau_id == $niveau->id ? 'selected' : '' }}>
                                        {{ $niveau->nom }}
                                        — {{ $niveau->cycle->nom }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="nom_{{ $groupe->id }}"
                                   class="form-label">
                                Nom du groupe <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="nom"
                                   id="nom_{{ $groupe->id }}"
                                   class="form-control"
                                   value="{{ $groupe->nom }}"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label for="code_{{ $groupe->id }}"
                                   class="form-label">
                                Code <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="code"
                                   id="code_{{ $groupe->id }}"
                                   class="form-control"
                                   value="{{ $groupe->code }}"
                                   required>
                        </div>

                        <div class="col-md-3">
                            <label for="ordre_{{ $groupe->id }}"
                                   class="form-label">
                                Ordre <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   name="ordre"
                                   id="ordre_{{ $groupe->id }}"
                                   class="form-control"
                                   min="1"
                                   value="{{ $groupe->ordre }}"
                                   required>
                        </div>

                        <div class="col-md-3">
                            <label for="capacite_{{ $groupe->id }}"
                                   class="form-label">
                                Capacité <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   name="capacite"
                                   id="capacite_{{ $groupe->id }}"
                                   class="form-control"
                                   min="1"
                                   value="{{ $groupe->capacite }}"
                                   required>
                        </div>

                        <div class="col-12">
                            <label for="description_{{ $groupe->id }}"
                                   class="form-label">
                                Description
                            </label>

                            <textarea name="description"
                                      id="description_{{ $groupe->id }}"
                                      class="form-control"
                                      rows="3">{{ $groupe->description }}</textarea>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch">

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="statut"
                                       id="statut_{{ $groupe->id }}"
                                       value="1"
                                       {{ $groupe->statut ? 'checked' : '' }}>

                                <label class="form-check-label"
                                       for="statut_{{ $groupe->id }}">
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
                        Enregistrer les modifications
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
