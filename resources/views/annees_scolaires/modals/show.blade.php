<div
    class="modal fade"
    id="modalVoirAnneeScolaire{{ $annee->id }}"
    tabindex="-1"
    aria-labelledby="modalVoirAnneeScolaireLabel{{ $annee->id }}"
    aria-hidden="true"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5
                    class="modal-title fw-bold"
                    id="modalVoirAnneeScolaireLabel{{ $annee->id }}"
                >
                    <i class="bi bi-calendar3 me-2 text-primary"></i>
                    Détails de l'année scolaire
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fermer"
                ></button>

            </div>


            <div class="modal-body">

                <div class="row g-3">

                    {{-- Année --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <small class="text-muted d-block mb-1">
                                Année scolaire
                            </small>

                            <div class="fw-bold fs-5">
                                {{ $annee->libelle }}
                            </div>

                        </div>

                    </div>


                    {{-- Organisation --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <small class="text-muted d-block mb-1">
                                Organisation
                            </small>

                            <div class="fw-semibold">
                                {{ $annee->organisation->nom ?? '—' }}
                            </div>

                        </div>

                    </div>


                    {{-- Date début --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <small class="text-muted d-block mb-1">
                                Date de début
                            </small>

                            <div class="fw-semibold">
                                {{ $annee->date_debut?->format('d/m/Y') ?? '—' }}
                            </div>

                        </div>

                    </div>


                    {{-- Date fin --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <small class="text-muted d-block mb-1">
                                Date de fin
                            </small>

                            <div class="fw-semibold">
                                {{ $annee->date_fin?->format('d/m/Y') ?? '—' }}
                            </div>

                        </div>

                    </div>


                    {{-- Statut --}}
                    <div class="col-md-12">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Statut
                            </small>

                            @if($annee->active)

                                <span class="badge text-bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge text-bg-secondary">
                                    Inactive
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Description --}}
                    <div class="col-md-12">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Description
                            </small>

                            <div>
                                {{ $annee->description ?: 'Aucune description.' }}
                            </div>

                        </div>

                    </div>


                    {{-- Dates système --}}
                    <div class="col-md-6">

                        <small class="text-muted">
                            Créée le
                        </small>

                        <div>
                            {{ $annee->created_at?->format('d/m/Y à H:i') ?? '—' }}
                        </div>

                    </div>

                    <div class="col-md-6">

                        <small class="text-muted">
                            Dernière modification
                        </small>

                        <div>
                            {{ $annee->updated_at?->format('d/m/Y à H:i') ?? '—' }}
                        </div>

                    </div>

                </div>

            </div>


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
                    data-bs-target="#modalModifierAnneeScolaire{{ $annee->id }}"
                >
                    <i class="bi bi-pencil me-1"></i>
                    Modifier
                </button>

            </div>

        </div>

    </div>
</div>
