<div
    class="modal fade"
    id="modalVoirCycle{{ $cycle->id }}"
    tabindex="-1"
    aria-labelledby="modalVoirCycleLabel{{ $cycle->id }}"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">

                <h5
                    class="modal-title fw-bold"
                    id="modalVoirCycleLabel{{ $cycle->id }}"
                >
                    <i class="bi bi-diagram-3 me-2 text-info"></i>
                    Détails du cycle
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fermer"
                ></button>

            </div>


            {{-- CONTENU --}}
            <div class="modal-body">

                <div class="row g-3">

                    {{-- ORGANISATION --}}
                    <div class="col-md-12">

                        <div class="small text-muted mb-1">
                            Organisation
                        </div>

                        <div class="fw-semibold">

                            @if($cycle->organisation)

                                {{ $cycle->organisation->nom }}

                            @else

                                —

                            @endif

                        </div>

                    </div>


                    {{-- NOM --}}
                    <div class="col-md-8">

                        <div class="small text-muted mb-1">
                            Nom du cycle
                        </div>

                        <div class="fw-semibold">
                            {{ $cycle->nom }}
                        </div>

                    </div>


                    {{-- CODE --}}
                    <div class="col-md-4">

                        <div class="small text-muted mb-1">
                            Code
                        </div>

                        <span class="badge text-bg-secondary">
                            {{ $cycle->code }}
                        </span>

                    </div>


                    {{-- STATUT --}}
                    <div class="col-md-12">

                        <div class="small text-muted mb-1">
                            Statut
                        </div>

                        @if($cycle->statut)

                            <span class="badge text-bg-success">
                                Actif
                            </span>

                        @else

                            <span class="badge text-bg-danger">
                                Inactif
                            </span>

                        @endif

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="col-md-12">

                        <div class="small text-muted mb-1">
                            Description
                        </div>

                        <div>
                            {{ $cycle->description ?: 'Aucune description.' }}
                        </div>

                    </div>


                    {{-- CRÉATION --}}
                    <div class="col-md-6">

                        <div class="small text-muted mb-1">
                            Créé le
                        </div>

                        <div>
                            {{ $cycle->created_at?->format('d/m/Y à H:i') ?? '—' }}
                        </div>

                    </div>


                    {{-- MODIFICATION --}}
                    <div class="col-md-6">

                        <div class="small text-muted mb-1">
                            Dernière modification
                        </div>

                        <div>
                            {{ $cycle->updated_at?->format('d/m/Y à H:i') ?? '—' }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    <i class="bi bi-x-lg me-1"></i>
                    Fermer
                </button>

                <button
                    type="button"
                    class="btn btn-warning"
                    data-bs-dismiss="modal"
                    data-bs-toggle="modal"
                    data-bs-target="#modalModifierCycle{{ $cycle->id }}"
                >
                    <i class="bi bi-pencil me-1"></i>
                    Modifier
                </button>

            </div>

        </div>

    </div>
</div>
