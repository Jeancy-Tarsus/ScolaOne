<div class="modal fade"
     id="modalAfficherPermission{{ $permission->id }}"
     tabindex="-1"
     aria-labelledby="modalAfficherPermissionLabel{{ $permission->id }}"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- En-tête --}}
            <div class="modal-header">

                <h5 class="modal-title"
                    id="modalAfficherPermissionLabel{{ $permission->id }}">

                    <i class="bi bi-key-fill me-2"></i>
                    Détails de la permission

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>

            {{-- Contenu --}}
            <div class="modal-body">

                <div class="row g-4">

                    {{-- Nom --}}
                    <div class="col-md-8">

                        <label class="form-label fw-semibold">
                            Nom de la permission
                        </label>

                        <div class="form-control bg-body-tertiary">
                            <i class="bi bi-key me-2"></i>
                            {{ $permission->name }}
                        </div>

                    </div>

                    {{-- Guard --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Guard
                        </label>

                        <div>
                            <span class="badge bg-secondary fs-6">
                                {{ $permission->guard_name }}
                            </span>
                        </div>

                    </div>

                    {{-- Date création --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Date de création
                        </label>

                        <div class="form-control bg-body-tertiary">
                            <i class="bi bi-calendar-plus me-2"></i>

                            {{ $permission->created_at?->format('d/m/Y à H:i') ?? '—' }}
                        </div>

                    </div>

                    {{-- Date modification --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Dernière modification
                        </label>

                        <div class="form-control bg-body-tertiary">
                            <i class="bi bi-calendar-check me-2"></i>

                            {{ $permission->updated_at?->format('d/m/Y à H:i') ?? '—' }}
                        </div>

                    </div>

                </div>

                {{-- Rôles utilisant la permission --}}
                <div class="mt-4">

                    <label class="form-label fw-semibold">
                        <i class="bi bi-shield-lock me-1"></i>
                        Rôles utilisant cette permission
                    </label>

                    <div class="border rounded p-3">

                        @if($permission->roles->count())

                            <div class="d-flex flex-wrap gap-2">

                                @foreach($permission->roles as $role)

                                    <span class="badge bg-primary">
                                        <i class="bi bi-shield me-1"></i>
                                        {{ $role->name }}
                                    </span>

                                @endforeach

                            </div>

                        @else

                            <div class="text-body-secondary">
                                <i class="bi bi-info-circle me-2"></i>
                                Cette permission n'est actuellement attribuée
                                à aucun rôle.
                            </div>

                        @endif

                    </div>

                </div>

            </div>

            {{-- Pied --}}
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
                        data-bs-target="#modalModifierPermission{{ $permission->id }}">

                    <i class="bi bi-pencil-square me-1"></i>
                    Modifier

                </button>

            </div>

        </div>
    </div>
</div>
