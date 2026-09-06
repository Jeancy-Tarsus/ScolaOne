<div
    class="modal fade"
    id="modalVoirNiveau{{ $niveau->id }}"
    tabindex="-1"
    aria-labelledby="modalVoirNiveauLabel{{ $niveau->id }}"
    aria-hidden="true"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">

                <h5
                    class="modal-title fw-bold"
                    id="modalVoirNiveauLabel{{ $niveau->id }}"
                >
                    <i class="bi bi-layers me-2 text-primary"></i>
                    Détails du niveau
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fermer"
                ></button>

            </div>


            {{-- BODY --}}
            <div class="modal-body">

                <div class="row g-3">

                    {{-- ORGANISATION --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <div class="text-muted small mb-1">
                                <i class="bi bi-building me-1"></i>
                                Organisation
                            </div>

                            <div class="fw-semibold">

                                @if($niveau->cycle && $niveau->cycle->organisation)

                                    {{ $niveau->cycle->organisation->nom }}

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- CYCLE --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <div class="text-muted small mb-1">
                                <i class="bi bi-diagram-3 me-1"></i>
                                Cycle
                            </div>

                            <div class="fw-semibold">

                                @if($niveau->cycle)

                                    {{ $niveau->cycle->nom }}

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- NOM --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <div class="text-muted small mb-1">
                                <i class="bi bi-layers me-1"></i>
                                Nom du niveau
                            </div>

                            <div class="fw-semibold">
                                {{ $niveau->nom }}
                            </div>

                        </div>

                    </div>


                    {{-- CODE --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <div class="text-muted small mb-1">
                                <i class="bi bi-upc-scan me-1"></i>
                                Code
                            </div>

                            <div class="fw-semibold">
                                {{ $niveau->code }}
                            </div>

                        </div>

                    </div>


                    {{-- ORDRE --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <div class="text-muted small mb-1">
                                <i class="bi bi-sort-numeric-down me-1"></i>
                                Ordre d'affichage
                            </div>

                            <div class="fw-semibold">
                                {{ $niveau->ordre }}
                            </div>

                        </div>

                    </div>


                    {{-- STATUT --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <div class="text-muted small mb-1">
                                <i class="bi bi-toggle-on me-1"></i>
                                Statut
                            </div>

                            <div>

                                @if($niveau->statut)

                                    <span class="badge text-bg-success">
                                        Actif
                                    </span>

                                @else

                                    <span class="badge text-bg-danger">
                                        Inactif
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="col-12">

                        <div class="border rounded p-3">

                            <div class="text-muted small mb-2">
                                <i class="bi bi-card-text me-1"></i>
                                Description
                            </div>

                            @if($niveau->description)

                                <div>
                                    {{ $niveau->description }}
                                </div>

                            @else

                                <span class="text-muted">
                                    Aucune description.
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- DATES --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3">

                            <div class="text-muted small mb-1">
                                <i class="bi bi-calendar-plus me-1"></i>
                                Créé le
                            </div>

                            <div>
                                {{ $niveau->created_at?->format('d/m/Y à H:i') ?? '—' }}
                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="border rounded p-3">

                            <div class="text-muted small mb-1">
                                <i class="bi bi-calendar-check me-1"></i>
                                Dernière modification
                            </div>

                            <div>
                                {{ $niveau->updated_at?->format('d/m/Y à H:i') ?? '—' }}
                            </div>

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
                    data-bs-target="#modalModifierNiveau{{ $niveau->id }}"
                >
                    <i class="bi bi-pencil me-1"></i>
                    Modifier
                </button>

            </div>

        </div>

    </div>
</div>
