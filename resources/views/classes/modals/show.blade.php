<div
    class="modal fade"
    id="modalVoirClasse{{ $classe->id }}"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    <i class="bi bi-eye me-2 text-info"></i>
                    Détails de la classe
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="card border-0 bg-body-tertiary h-100">

                            <div class="card-body">

                                <h6 class="fw-bold text-primary">
                                    <i class="bi bi-building me-1"></i>
                                    Site
                                </h6>

                                <p class="mb-1">
                                    <strong>
                                        {{ $classe->site->nom ?? '-' }}
                                    </strong>
                                </p>

                                <small class="text-muted">
                                    {{ $classe->site->organisation->nom ?? '-' }}
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="card border-0 bg-body-tertiary h-100">

                            <div class="card-body">

                                <h6 class="fw-bold text-primary">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    Année scolaire
                                </h6>

                                <p class="mb-0">
                                    {{ $classe->anneeScolaire->libelle ?? '-' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="card border-0 bg-body-tertiary h-100">

                            <div class="card-body">

                                <h6 class="fw-bold text-primary">
                                    <i class="bi bi-people me-1"></i>
                                    Groupe
                                </h6>

                                <p class="mb-1">
                                    {{ $classe->groupe->nom ?? '-' }}
                                </p>

                                <small class="text-muted">
                                    Niveau :
                                    {{ $classe->groupe->niveau->nom ?? '-' }}
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="card border-0 bg-body-tertiary h-100">

                            <div class="card-body">

                                <h6 class="fw-bold text-primary">
                                    <i class="bi bi-door-open me-1"></i>
                                    Salle
                                </h6>

                                <p class="mb-1">
                                    {{ $classe->salle->nom ?? 'Aucune salle' }}
                                </p>

                                @if($classe->salle)

                                    <small class="text-muted">
                                        {{ $classe->salle->code }}
                                        —
                                        {{ $classe->salle->capacite }} places
                                    </small>

                                @endif

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="fw-bold">
                            Nom de la classe
                        </label>

                        <p class="mb-0">
                            {{ $classe->nom }}
                        </p>

                    </div>


                    <div class="col-md-6">

                        <label class="fw-bold">
                            Code
                        </label>

                        <p class="mb-0">
                            {{ $classe->code }}
                        </p>

                    </div>


                    <div class="col-md-6">

                        <label class="fw-bold">
                            Effectif maximal
                        </label>

                        <p class="mb-0">
                            {{ $classe->effectif_max }}
                            élèves
                        </p>

                    </div>


                    <div class="col-md-6">

                        <label class="fw-bold">
                            Statut
                        </label>

                        <p class="mb-0">

                            @if($classe->statut === 'ouverte')

                                <span class="badge text-bg-success">
                                    Ouverte
                                </span>

                            @elseif($classe->statut === 'fermee')

                                <span class="badge text-bg-danger">
                                    Fermée
                                </span>

                            @else

                                <span class="badge text-bg-warning">
                                    Suspendue
                                </span>

                            @endif

                        </p>

                    </div>


                    <div class="col-md-12">

                        <label class="fw-bold">
                            Description
                        </label>

                        <div class="p-3 rounded bg-body-tertiary">

                            @if($classe->description)

                                {{ $classe->description }}

                            @else

                                <span class="text-muted">
                                    Aucune description.
                                </span>

                            @endif

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
                    Fermer
                </button>

            </div>

        </div>

    </div>
</div>
