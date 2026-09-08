<div class="modal fade"
     id="modalModifierRole{{ $role->id }}"
     tabindex="-1"
     aria-labelledby="modalModifierRoleLabel{{ $role->id }}"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- =====================================================
                 EN-TÊTE
                 ===================================================== --}}

            <div class="modal-header">

                <h5 class="modal-title"
                    id="modalModifierRoleLabel{{ $role->id }}">

                    <i class="bi bi-pencil-square me-2"></i>

                    Modifier le rôle

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- =====================================================
                 FORMULAIRE
                 ===================================================== --}}

            <form action="{{ route('roles.update', $role) }}"
                  method="POST">

                @csrf

                @method('PUT')


                {{-- =================================================
                     CORPS SCROLLABLE
                     ================================================= --}}

                <div class="modal-body"
                     style="max-height: calc(100vh - 190px); overflow-y: auto;">

                    {{-- =================================================
                         NOM DU RÔLE
                         ================================================= --}}

                    <div class="mb-4">

                        <label for="role_name_{{ $role->id }}"
                               class="form-label fw-semibold">

                            Nom du rôle

                        </label>

                        <input type="text"
                               name="name"
                               id="role_name_{{ $role->id }}"
                               class="form-control"
                               value="{{ $role->name }}"
                               placeholder="Ex. Admin d'école"
                               required>

                    </div>


                    {{-- =================================================
                         GUARD
                         ================================================= --}}

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Guard

                        </label>

                        <input type="text"
                               class="form-control"
                               value="{{ $role->guard_name }}"
                               readonly>

                        <div class="form-text">

                            Le guard utilisé par ScolaOne est
                            <strong>web</strong>.

                        </div>

                    </div>


                    {{-- =================================================
                         PERMISSIONS
                         ================================================= --}}

                    <div class="mb-2">

                        <label class="form-label fw-semibold">

                            <i class="bi bi-key-fill me-1"></i>

                            Permissions

                        </label>


                        <div class="border rounded p-3">

                            @if(isset($permissions) && $permissions->count())

                                <div class="row">

                                    @foreach($permissions as $permission)

                                        <div class="col-md-6 col-lg-4 mb-2">

                                            <div class="form-check">

                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="permissions[]"
                                                    value="{{ $permission->id }}"
                                                    id="permission_edit_{{ $role->id }}_{{ $permission->id }}"
                                                    {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}
                                                >

                                                <label
                                                    class="form-check-label"
                                                    for="permission_edit_{{ $role->id }}_{{ $permission->id }}"
                                                >

                                                    {{ $permission->name }}

                                                </label>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            @else

                                <div class="text-center py-4">

                                    <i class="bi bi-shield-exclamation fs-1 opacity-50"></i>

                                    <p class="mt-3 mb-2">

                                        Aucune permission n'est encore disponible.

                                    </p>

                                    <small class="text-body-secondary">

                                        Créez d'abord des permissions
                                        depuis la gestion des permissions.

                                    </small>

                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                         INFORMATION
                         ================================================= --}}

                    <div class="alert alert-info mt-3 mb-0">

                        <i class="bi bi-info-circle me-2"></i>

                        Les permissions sélectionnées détermineront
                        les actions que ce rôle pourra effectuer dans ScolaOne.

                    </div>

                </div>


                {{-- =====================================================
                     PIED DU MODAL
                     ===================================================== --}}

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
