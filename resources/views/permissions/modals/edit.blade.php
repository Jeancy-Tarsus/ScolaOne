<div class="modal fade"
     id="modalModifierPermission{{ $permission->id }}"
     tabindex="-1"
     aria-labelledby="modalModifierPermissionLabel{{ $permission->id }}"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- En-tête --}}
            <div class="modal-header">

                <h5 class="modal-title"
                    id="modalModifierPermissionLabel{{ $permission->id }}">

                    <i class="bi bi-pencil-square me-2"></i>
                    Modifier la permission

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>

            {{-- Formulaire --}}
            <form action="{{ route('permissions.update', $permission) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    {{-- Nom --}}
                    <div class="mb-4">

                        <label for="permission_name_{{ $permission->id }}"
                               class="form-label fw-semibold">

                            Nom de la permission

                        </label>

                        <input type="text"
                               name="name"
                               id="permission_name_{{ $permission->id }}"
                               class="form-control"
                               value="{{ $permission->name }}"
                               placeholder="Ex. users.view"
                               required>

                        <div class="form-text">
                            Utilisez de préférence le format :
                            <strong>module.action</strong>
                        </div>

                    </div>

                    {{-- Guard --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Guard
                        </label>

                        <input type="text"
                               class="form-control"
                               value="{{ $permission->guard_name }}"
                               readonly>

                        <div class="form-text">
                            Le guard utilisé par ScolaOne est
                            <strong>web</strong>.
                        </div>

                    </div>

                    {{-- Information --}}
                    <div class="alert alert-warning mb-0">

                        <i class="bi bi-exclamation-triangle me-2"></i>

                        La modification du nom de cette permission
                        s'appliquera également aux rôles qui l'utilisent.

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
