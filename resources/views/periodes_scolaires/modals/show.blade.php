<div
    class="modal fade"
    id="modalVoirPeriodeScolaire{{ $periode->id }}"
    tabindex="-1"
    aria-labelledby="modalVoirPeriodeScolaireLabel{{ $periode->id }}"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">

                <h5
                    class="modal-title fw-bold"
                    id="modalVoirPeriodeScolaireLabel{{ $periode->id }}"
                >
                    <i class="bi bi-calendar3 me-2 text-info"></i>
                    Détails de la période scolaire
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

                    {{-- ANNÉE SCOLAIRE --}}
                    <div class="col-md-6">

                        <div class="small text-muted mb-1">
                            Année scolaire
                        </div>

                        <div class="fw-semibold">

                            @if($periode->anneeScolaire)

                                {{ $periode->anneeScolaire->libelle }}

                            @else

                                —

                            @endif

                        </div>

                    </div>


                    {{-- ORGANISATION --}}
                    <div class="col-md-6">

                        <div class="small text-muted mb-1">
                            Organisation
                        </div>

                        <div class="fw-semibold">

                            @if($periode->anneeScolaire?->organisation)

                                {{ $periode->anneeScolaire->organisation->nom }}

                            @else

                                —

                            @endif

                        </div>

                    </div>


                    {{-- NOM --}}
                    <div class="col-md-8">

                        <div class="small text-muted mb-1">
                            Nom de la période
                        </div>

                        <div class="fw-semibold">
                            {{ $periode->nom }}
                        </div>

                    </div>


                    {{-- CODE --}}
                    <div class="col-md-4">

                        <div class="small text-muted mb-1">
                            Code
                        </div>

                        <span class="badge text-bg-secondary">
                            {{ $periode->code }}
                        </span>

                    </div>


                    {{-- DATE DEBUT --}}
                    <div class="col-md-6">

                        <div class="small text-muted mb-1">
                            Date de début
                        </div>

                        <div class="fw-semibold">

                            {{ $periode->date_debut?->format('d/m/Y') ?? '—' }}

                        </div>

                    </div>


                    {{-- DATE FIN --}}
                    <div class="col-md-6">

                        <div class="small text-muted mb-1">
                            Date de fin
                        </div>

                        <div class="fw-semibold">

                            {{ $periode->date_fin?->format('d/m/Y') ?? '—' }}

                        </div>

                    </div>


                    {{-- STATUT --}}
                    <div class="col-md-12">

                        <div class="small text-muted mb-1">
                            Statut
                        </div>

                        @if($periode->active)

                            <span class="badge text-bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge text-bg-danger">
                                Inactive
                            </span>

                        @endif

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="col-md-12">

                        <div class="small text-muted mb-1">
                            Description
                        </div>

                        <div>
                            {{ $periode->description ?: 'Aucune description.' }}
                        </div>

                    </div>


                    {{-- DATES SYSTÈME --}}
                    <div class="col-md-6">

                        <div class="small text-muted mb-1">
                            Créée le
                        </div>

                        <div>
                            {{ $periode->created_at?->format('d/m/Y à H:i') ?? '—' }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="small text-muted mb-1">
                            Dernière modification
                        </div>

                        <div>
                            {{ $periode->updated_at?->format('d/m/Y à H:i') ?? '—' }}
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
                    data-bs-target="#modalModifierPeriodeScolaire{{ $periode->id }}"
                >
                    <i class="bi bi-pencil me-1"></i>
                    Modifier
                </button>

            </div>

        </div>

    </div>
</div>
