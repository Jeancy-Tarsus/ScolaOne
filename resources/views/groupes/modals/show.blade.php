<div class="modal fade"
     id="modalVoirGroupe{{ $groupe->id }}"
     tabindex="-1"
     aria-labelledby="modalVoirGroupeLabel{{ $groupe->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"
                    id="modalVoirGroupeLabel{{ $groupe->id }}">
                    <i class="bi bi-people me-2"></i>
                    Détails du groupe
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer"></button>
            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <div class="col-md-6">
                        <strong>Niveau</strong>
                        <div>
                            {{ $groupe->niveau->nom }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>Cycle</strong>
                        <div>
                            {{ $groupe->niveau->cycle->nom }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>Organisation</strong>
                        <div>
                            {{ $groupe->niveau->cycle->organisation->nom }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>Nom du groupe</strong>
                        <div>
                            {{ $groupe->nom }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <strong>Code</strong>
                        <div>
                            {{ $groupe->code }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <strong>Ordre</strong>
                        <div>
                            {{ $groupe->ordre }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <strong>Capacité</strong>
                        <div>
                            {{ $groupe->capacite }} élèves
                        </div>
                    </div>

                    <div class="col-md-12">
                        <strong>Statut</strong>
                        <div>
                            @if($groupe->statut)
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

                    <div class="col-12">
                        <strong>Description</strong>
                        <div>
                            {{ $groupe->description ?: 'Aucune description.' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>Créé le</strong>
                        <div>
                            {{ $groupe->created_at?->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>Modifié le</strong>
                        <div>
                            {{ $groupe->updated_at?->format('d/m/Y H:i') }}
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Fermer
                </button>

                <button type="button"
                        class="btn btn-warning"
                        data-bs-dismiss="modal"
                        data-bs-toggle="modal"
                        data-bs-target="#modalModifierGroupe{{ $groupe->id }}">
                    <i class="bi bi-pencil me-1"></i>
                    Modifier
                </button>

            </div>

        </div>
    </div>
</div>
