<div class="modal fade"
     id="modalVoirOrganisation{{ $organisation->id }}"
     tabindex="-1"
     aria-labelledby="modalVoirOrganisationLabel{{ $organisation->id }}"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow rounded-4 overflow-hidden"
             style="background-color: #ffffff !important; color: #212529 !important;">

            {{-- HEADER --}}
            <div class="modal-header bg-primary text-white px-4 py-3 border-0">

                <div>
                    <h5 class="modal-title fw-semibold mb-1 text-white">
                        Détails de l'organisation
                    </h5>

                    <small class="text-white opacity-75">
                        Informations générales de l'organisation
                    </small>
                </div>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>


            {{-- BODY --}}
            <div class="modal-body px-4 py-4"
                 style="background-color: #ffffff !important; color: #212529 !important;">

                {{-- IDENTITÉ --}}
                <div class="d-flex align-items-center mb-4">

                    <div class="me-3">

                        @if($organisation->logo)

                            <img src="{{ asset('storage/' . $organisation->logo) }}"
                                 alt="Logo {{ $organisation->nom }}"
                                 class="rounded-3 border"
                                 style="width: 85px; height: 85px; object-fit: contain;">

                        @else

                            <div class="rounded-3 border d-flex align-items-center justify-content-center"
                                 style="width: 85px;
                                        height: 85px;
                                        background-color: #f8f9fa !important;">

                                <i class="bi bi-building fs-2 text-secondary"></i>

                            </div>

                        @endif

                    </div>


                    <div>

                        <h4 class="fw-semibold mb-1"
                            style="color: #212529 !important;">
                            {{ $organisation->nom }}
                        </h4>

                        <span class="badge bg-primary">
                            {{ $organisation->code }}
                        </span>

                    </div>

                </div>


                {{-- INFORMATIONS --}}
                <div class="row g-3">

                    {{-- CODE --}}
                    <div class="col-md-6">

                        <div class="rounded-3 p-3 h-100 border"
                             style="background-color: #f8f9fa !important;">

                            <small class="d-block mb-1"
                                   style="color: #6c757d !important;">
                                Code
                            </small>

                            <span class="fw-semibold"
                                  style="color: #212529 !important;">
                                {{ $organisation->code }}
                            </span>

                        </div>

                    </div>


                    {{-- NOM --}}
                    <div class="col-md-6">

                        <div class="rounded-3 p-3 h-100 border"
                             style="background-color: #f8f9fa !important;">

                            <small class="d-block mb-1"
                                   style="color: #6c757d !important;">
                                Nom de l'organisation
                            </small>

                            <span class="fw-semibold"
                                  style="color: #212529 !important;">
                                {{ $organisation->nom }}
                            </span>

                        </div>

                    </div>


                    {{-- EMAIL --}}
                    <div class="col-md-6">

                        <div class="rounded-3 p-3 h-100 border"
                             style="background-color: #f8f9fa !important;">

                            <small class="d-block mb-1"
                                   style="color: #6c757d !important;">
                                Email
                            </small>

                            @if($organisation->email)

                                <span style="color: #212529 !important;">
                                    {{ $organisation->email }}
                                </span>

                            @else

                                <span style="color: #6c757d !important;">
                                    Non renseigné
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- TELEPHONE --}}
                    <div class="col-md-6">

                        <div class="rounded-3 p-3 h-100 border"
                             style="background-color: #f8f9fa !important;">

                            <small class="d-block mb-1"
                                   style="color: #6c757d !important;">
                                Téléphone
                            </small>

                            @if($organisation->telephone)

                                <span style="color: #212529 !important;">
                                    {{ $organisation->telephone }}
                                </span>

                            @else

                                <span style="color: #6c757d !important;">
                                    Non renseigné
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- ADRESSE --}}
                    <div class="col-12">

                        <div class="rounded-3 p-3 border"
                             style="background-color: #f8f9fa !important;">

                            <small class="d-block mb-1"
                                   style="color: #6c757d !important;">
                                Adresse
                            </small>

                            @if($organisation->adresse)

                                <span style="color: #212529 !important;">
                                    {{ $organisation->adresse }}
                                </span>

                            @else

                                <span style="color: #6c757d !important;">
                                    Non renseignée
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- STATUT --}}
                    <div class="col-md-6">

                        <div class="rounded-3 p-3 border"
                             style="background-color: #f8f9fa !important;">

                            <small class="d-block mb-2"
                                   style="color: #6c757d !important;">
                                Statut
                            </small>

                            @if($organisation->statut)

                                <span class="badge bg-success px-3 py-2">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-danger px-3 py-2">
                                    Inactive
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- DATE --}}
                    <div class="col-md-6">

                        <div class="rounded-3 p-3 border"
                             style="background-color: #f8f9fa !important;">

                            <small class="d-block mb-1"
                                   style="color: #6c757d !important;">
                                Date de création
                            </small>

                            <span style="color: #212529 !important;">
                                {{ $organisation->created_at?->format('d/m/Y à H:i') }}
                            </span>

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="col-12">

                        <div class="rounded-3 p-3 border"
                             style="background-color: #ffffff !important;">

                            <div class="d-flex align-items-center mb-2">

                                <i class="bi bi-card-text me-2 text-primary"></i>

                                <span class="fw-semibold"
                                      style="color: #212529 !important;">
                                    Description
                                </span>

                            </div>

                            @if($organisation->description)

                                <p class="mb-0"
                                   style="color: #495057 !important;">
                                    {{ $organisation->description }}
                                </p>

                            @else

                                <p class="mb-0"
                                   style="color: #6c757d !important;">
                                    Aucune description renseignée.
                                </p>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="modal-footer border-0 px-4 py-3"
                 style="background-color: #f8f9fa !important;">

                <button type="button"
                        class="btn btn-light border px-4"
                        data-bs-dismiss="modal">

                    Fermer

                </button>


                <button type="button"
                        class="btn btn-warning px-4"
                        data-bs-dismiss="modal"
                        data-bs-toggle="modal"
                        data-bs-target="#modalModifierOrganisation{{ $organisation->id }}">

                    <i class="bi bi-pencil-square me-1"></i>

                    Modifier

                </button>

            </div>

        </div>

    </div>

</div>
