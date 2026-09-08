<div class="modal fade"
     id="modalAjouterRole"
     tabindex="-1"
     aria-labelledby="modalAjouterRoleLabel"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- =====================================================
                 EN-TÊTE
                 ===================================================== --}}

            <div class="modal-header">

                <h5 class="modal-title" id="modalAjouterRoleLabel">

                    <i class="bi bi-shield-plus me-2"></i>

                    Nouveau rôle

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

            <form action="{{ route('roles.store') }}"
                  method="POST">

                @csrf

                {{-- =================================================
                     CORPS SCROLLABLE
                     ================================================= --}}

                <div class="modal-body"
                     style="max-height: calc(100vh - 190px); overflow-y: auto;">

                    {{-- =================================================
                         NOM DU RÔLE
                         ================================================= --}}

                    <div class="mb-4">

                        <label for="name"
                               class="form-label fw-semibold">

                            Nom du rôle

                        </label>

                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Ex. Admin d'école"
                               required>

                        @error('name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         PERMISSIONS
                         ================================================= --}}

                    <div class="mb-2">

                        <label class="form-label fw-semibold">

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
                                                    id="permission_create_{{ $permission->id }}"
                                                    {{ in_array(
                                                        $permission->id,
                                                        old('permissions', [])
                                                    ) ? 'checked' : '' }}
                                                >

                                                <label
                                                    class="form-check-label"
                                                    for="permission_create_{{ $permission->id }}"
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

                                        Les permissions seront ajoutées
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
