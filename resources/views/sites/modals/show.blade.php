<div class="modal fade"
     id="modalVoirSite{{ $site->id }}"
     tabindex="-1"
     aria-labelledby="modalVoirSiteLabel{{ $site->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">

                <h5 class="modal-title fw-bold"
                    id="modalVoirSiteLabel{{ $site->id }}">

                    <i class="bi bi-geo-alt me-2 text-primary"></i>

                    Informations du site

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- BODY --}}
            <div class="modal-body">

                <div class="row g-4">

                    {{-- NOM --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Nom du site
                        </small>

                        <div class="fw-semibold">
                            {{ $site->nom }}
                        </div>

                    </div>


                    {{-- CODE --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Code
                        </small>

                        <span class="badge text-bg-secondary">
                            {{ $site->code }}
                        </span>

                    </div>


                    {{-- ORGANISATION --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Organisation
                        </small>

                        <div class="fw-semibold">

                            @if($site->organisation)

                                {{ $site->organisation->nom }}

                            @else

                                <span class="text-muted">
                                    Non renseignée
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- VILLE --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Ville
                        </small>

                        <div>

                            {{ $site->ville ?: 'Non renseignée' }}

                        </div>

                    </div>


                    {{-- EMAIL --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Email
                        </small>

                        <div>

                            {{ $site->email ?: 'Non renseigné' }}

                        </div>

                    </div>


                    {{-- TELEPHONE --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Téléphone
                        </small>

                        <div>

                            {{ $site->telephone ?: 'Non renseigné' }}

                        </div>

                    </div>


                    {{-- PAYS --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Pays
                        </small>

                        <div>

                            {{ $site->pays ?: 'Non renseigné' }}

                        </div>

                    </div>


                    {{-- STATUT --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Statut
                        </small>

                        @if($site->statut)

                            <span class="badge text-bg-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Active

                            </span>

                        @else

                            <span class="badge text-bg-danger">

                                <i class="bi bi-x-circle me-1"></i>

                                Inactive

                            </span>

                        @endif

                    </div>


                    {{-- ADRESSE --}}
                    <div class="col-12">

                        <small class="text-muted d-block mb-1">
                            Adresse
                        </small>

                        <div>

                            {{ $site->adresse ?: 'Aucune adresse renseignée.' }}

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="col-12">

                        <small class="text-muted d-block mb-1">
                            Description
                        </small>

                        <div>

                            {{ $site->description ?: 'Aucune description renseignée.' }}

                        </div>

                    </div>


                    {{-- DATES --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Créé le
                        </small>

                        <div>
                            {{ $site->created_at?->format('d/m/Y à H:i') }}
                        </div>

                    </div>

                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Dernière modification
                        </small>

                        <div>
                            {{ $site->updated_at?->format('d/m/Y à H:i') }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
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
                        data-bs-target="#modalModifierSite{{ $site->id }}">

                    <i class="bi bi-pencil-square me-1"></i>

                    Modifier

                </button>

            </div>

        </div>

    </div>

</div>
