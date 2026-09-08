<div class="modal fade"
     id="modalVoirRole{{ $role->id }}"
     tabindex="-1"
     aria-labelledby="modalVoirRoleLabel{{ $role->id }}"
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
                    id="modalVoirRoleLabel{{ $role->id }}">

                    <i class="bi bi-shield-lock-fill me-2"></i>

                    Détails du rôle

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- =====================================================
                 CORPS
                 ===================================================== --}}

            <div class="modal-body"
                 style="max-height: calc(100vh - 190px); overflow-y: auto;">

                {{-- =================================================
                     INFORMATIONS GÉNÉRALES
                     ================================================= --}}

                <div class="row g-4">

                    {{-- NOM --}}
                    <div class="col-md-8">

                        <label class="form-label fw-semibold">

                            Nom du rôle

                        </label>

                        <div class="form-control bg-body-tertiary">

                            <i class="bi bi-shield-fill text-primary me-2"></i>

                            {{ $role->name }}

                        </div>

                    </div>


                    {{-- GUARD --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">

                            Guard

                        </label>

                        <div>

                            <span class="badge text-bg-secondary fs-6">

                                {{ $role->guard_name }}

                            </span>

                        </div>

                    </div>


                    {{-- DATE CRÉATION --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            Date de création

                        </label>

                        <div class="form-control bg-body-tertiary">

                            <i class="bi bi-calendar-plus me-2"></i>

                            {{ $role->created_at?->format('d/m/Y à H:i') ?? '—' }}

                        </div>

                    </div>


                    {{-- DATE MODIFICATION --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            Dernière modification

                        </label>

                        <div class="form-control bg-body-tertiary">

                            <i class="bi bi-calendar-check me-2"></i>

                            {{ $role->updated_at?->format('d/m/Y à H:i') ?? '—' }}

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     PERMISSIONS
                     ================================================= --}}

                <div class="mt-4">

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <label class="form-label fw-semibold mb-0">

                            <i class="bi bi-key-fill me-1"></i>

                            Permissions attribuées

                        </label>


                        <span class="badge text-bg-info">

                            {{ $role->permissions->count() }}

                            permission{{ $role->permissions->count() > 1 ? 's' : '' }}

                        </span>

                    </div>


                    <div class="border rounded p-3">

                        @if($role->permissions->count())

                            <div class="row">

                                @foreach($role->permissions as $permission)

                                    <div class="col-md-6 col-lg-4 mb-2">

                                        <div class="d-flex align-items-center">

                                            <i class="bi bi-check-circle-fill text-success me-2"></i>

                                            <span>
                                                {{ $permission->name }}
                                            </span>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="text-center py-4">

                                <i class="bi bi-shield-x fs-1 text-body-secondary"></i>

                                <p class="mt-3 mb-0 text-body-secondary">

                                    Aucune permission n'est attribuée
                                    à ce rôle.

                                </p>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     INFORMATION
                     ================================================= --}}

                <div class="alert alert-info mt-4 mb-0">

                    <i class="bi bi-info-circle me-2"></i>

                    Les permissions affichées correspondent aux actions
                    que ce rôle peut effectuer dans ScolaOne.

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

                    Fermer

                </button>


                <button type="button"
                        class="btn btn-warning"
                        data-bs-dismiss="modal"
                        data-bs-toggle="modal"
                        data-bs-target="#modalModifierRole{{ $role->id }}">

                    <i class="bi bi-pencil-square me-1"></i>

                    Modifier

                </button>

            </div>

        </div>

    </div>

</div>
