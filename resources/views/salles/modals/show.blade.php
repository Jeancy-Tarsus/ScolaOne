<div class="modal fade"
     id="modalVoirSalle{{ $salle->id }}"
     tabindex="-1"
     aria-labelledby="modalVoirSalleLabel{{ $salle->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"
                    id="modalVoirSalleLabel{{ $salle->id }}">

                    <i class="bi bi-door-open me-2"></i>
                    Détails de la salle

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="small text-muted">
                            Organisation
                        </div>

                        <div class="fw-semibold">
                            {{ $salle->site->organisation->nom }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="small text-muted">
                            Site
                        </div>

                        <div class="fw-semibold">
                            {{ $salle->site->nom }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="small text-muted">
                            Code
                        </div>

                        <div class="fw-semibold">
                            {{ $salle->code }}
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="small text-muted">
                            Nom
                        </div>

                        <div class="fw-semibold">
                            {{ $salle->nom }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="small text-muted">
                            Capacité
                        </div>

                        <div class="fw-semibold">
                            {{ $salle->capacite }} places
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="small text-muted">
                            Type
                        </div>

                        <div class="fw-semibold">
                            {{ $salle->type ?: '—' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="small text-muted">
                            Bâtiment
                        </div>

                        <div class="fw-semibold">
                            {{ $salle->batiment ?: '—' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="small text-muted">
                            Étage
                        </div>

                        <div class="fw-semibold">
                            {{ $salle->etage ?: '—' }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="small text-muted">
                            Statut
                        </div>

                        @if($salle->statut === 'disponible')
                            <span class="badge text-bg-success">
                                Disponible
                            </span>
                        @elseif($salle->statut === 'maintenance')
                            <span class="badge text-bg-warning">
                                Maintenance
                            </span>
                        @else
                            <span class="badge text-bg-danger">
                                Indisponible
                            </span>
                        @endif
                    </div>

                    <div class="col-12">
                        <div class="small text-muted">
                            Description
                        </div>

                        <div>
                            {{ $salle->description ?: 'Aucune description.' }}
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    <i class="bi bi-x-lg me-1"></i>
                    Fermer

                </button>

            </div>

        </div>
    </div>
</div>
