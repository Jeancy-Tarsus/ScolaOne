<div class="modal fade"
     id="modalAjouterPermission"
     tabindex="-1"
     aria-labelledby="modalAjouterPermissionLabel"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- En-tête --}}
            <div class="modal-header">

                <h5 class="modal-title" id="modalAjouterPermissionLabel">
                    <i class="bi bi-key-fill me-2"></i>
                    Nouvelle permission
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>

            {{-- Formulaire --}}
            <form action="{{ route('permissions.store') }}" method="POST">

                @csrf

                <div class="modal-body">

                    {{-- Nom --}}
                    <div class="mb-4">

                        <label for="permission_name"
                               class="form-label fw-semibold">
                            Nom de la permission
                        </label>

                        <input type="text"
                               name="name"
                               id="permission_name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="Ex. users.view"
                               required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-text">
                            Utilisez de préférence le format :
                            <strong>module.action</strong>
                        </div>

                    </div>

                    {{-- Exemples --}}
                    <div class="card border">

                        <div class="card-header">
                            <h6 class="mb-0 fw-semibold">
                                <i class="bi bi-info-circle me-2"></i>
                                Exemples
                            </h6>
                        </div>

                        <div class="card-body">

                            <div class="row g-2">

                                <div class="col-md-6">
                                    <code>users.view</code>
                                    <small class="text-body-secondary d-block">
                                        Voir les utilisateurs
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <code>users.create</code>
                                    <small class="text-body-secondary d-block">
                                        Créer un utilisateur
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <code>users.edit</code>
                                    <small class="text-body-secondary d-block">
                                        Modifier un utilisateur
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <code>users.delete</code>
                                    <small class="text-body-secondary d-block">
                                        Supprimer un utilisateur
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <code>classes.view</code>
                                    <small class="text-body-secondary d-block">
                                        Voir les classes
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <code>notes.edit</code>
                                    <small class="text-body-secondary d-block">
                                        Modifier les notes
                                    </small>
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Information --}}
                    <div class="alert alert-info mt-3 mb-0">

                        <i class="bi bi-shield-check me-2"></i>

                        Cette permission pourra ensuite être attribuée
                        à un ou plusieurs rôles.

                    </div>

                </div>

                {{-- Pied --}}
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
