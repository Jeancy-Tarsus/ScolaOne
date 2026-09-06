@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Niveaux
        </span>
    </li>
@stop

@section('title', 'Niveaux')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            Gestion des niveaux
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">

            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item active">
                Niveaux
            </li>

        </ol>

    </div>
@stop


@section('content')

    {{-- =========================================================
         RECHERCHE ET FILTRE
         ========================================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row align-items-center g-3">

                {{-- TITRE --}}
                <div class="col-md-3">

                    <h5 class="mb-0 fw-bold text-nowrap">

                        <i class="bi bi-layers me-2 text-primary"></i>

                        Liste des niveaux

                    </h5>

                </div>


                {{-- RECHERCHE + FILTRE --}}
                <div class="col-md-7">

                    <form
                        method="GET"
                        action="{{ route('niveaux.index') }}"
                    >

                        <div class="d-flex gap-2 align-items-center">

                            {{-- RECHERCHE --}}
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                value="{{ $search ?? '' }}"
                                placeholder="Nom, code ou cycle..."
                            >


                            {{-- FILTRE CYCLE --}}
                            <select
                                name="cycle_id"
                                class="form-select"
                            >

                                <option value="">
                                    Tous les cycles
                                </option>

                                @foreach($cycles as $cycle)

                                    <option
                                        value="{{ $cycle->id }}"
                                        {{ request('cycle_id') == $cycle->id ? 'selected' : '' }}
                                    >
                                        {{ $cycle->nom }}
                                        — {{ $cycle->organisation->nom }}
                                    </option>

                                @endforeach

                            </select>


                            {{-- RECHERCHER --}}
                            <button
                                type="submit"
                                class="btn btn-primary text-nowrap"
                            >

                                <i class="bi bi-search me-1"></i>

                                Rechercher

                            </button>


                            {{-- EFFACER --}}
                            @if(!empty($search) || request('cycle_id'))

                                <a
                                    href="{{ route('niveaux.index') }}"
                                    class="btn btn-outline-secondary"
                                    title="Effacer les filtres"
                                >

                                    <i class="bi bi-x-lg"></i>

                                </a>

                            @endif

                        </div>

                    </form>

                </div>


                {{-- NOUVEAU NIVEAU --}}
                <div class="col-md-2 text-md-end">

                    <button
                        type="button"
                        class="btn btn-primary text-nowrap"
                        data-bs-toggle="modal"
                        data-bs-target="#modalAjouterNiveau"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Nouveau niveau

                    </button>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         TABLEAU
         ========================================================= --}}

    <div class="card shadow-sm border-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Code</th>

                        <th>Niveau</th>

                        <th>Cycle</th>

                        <th>Organisation</th>

                        <th>Ordre</th>

                        <th>Statut</th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($niveaux as $niveau)

                        <tr>

                            {{-- NUMÉRO --}}
                            <td>
                                {{ $niveaux->firstItem() + $loop->index }}
                            </td>


                            {{-- CODE --}}
                            <td>

                                <span class="fw-semibold">
                                    {{ $niveau->code }}
                                </span>

                            </td>


                            {{-- NIVEAU --}}
                            <td>

                                <div class="fw-semibold">
                                    {{ $niveau->nom }}
                                </div>

                            </td>


                            {{-- CYCLE --}}
                            <td>

                                @if($niveau->cycle)

                                    {{ $niveau->cycle->nom }}

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- ORGANISATION --}}
                            <td>

                                @if($niveau->cycle && $niveau->cycle->organisation)

                                    {{ $niveau->cycle->organisation->nom }}

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- ORDRE --}}
                            <td>

                                <span class="badge text-bg-secondary">
                                    {{ $niveau->ordre }}
                                </span>

                            </td>


                            {{-- STATUT --}}
                            <td>

                                @if($niveau->statut)

                                    <span class="badge text-bg-success">
                                        Actif
                                    </span>

                                @else

                                    <span class="badge text-bg-danger">
                                        Inactif
                                    </span>

                                @endif

                            </td>


                            {{-- ACTIONS --}}
                            <td class="text-end">

                                {{-- VOIR --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalVoirNiveau{{ $niveau->id }}"
                                    title="Voir"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>


                                {{-- MODIFIER --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalModifierNiveau{{ $niveau->id }}"
                                    title="Modifier"
                                >

                                    <i class="bi bi-pencil"></i>

                                </button>


                                {{-- SUPPRIMER --}}
                                <form
                                    action="{{ route('niveaux.destroy', $niveau) }}"
                                    method="POST"
                                    class="d-inline form-suppression"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        title="Supprimer"
                                    >

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-5"
                            >

                                <div class="mb-3">

                                    <i
                                        class="bi bi-layers text-muted"
                                        style="font-size: 3rem;"
                                    ></i>

                                </div>


                                @if(!empty($search) || request('cycle_id'))

                                    <h5 class="fw-bold">
                                        Aucun niveau trouvé
                                    </h5>

                                    <p class="text-muted mb-0">
                                        Aucun niveau ne correspond aux critères de recherche.
                                    </p>

                                @else

                                    <h5 class="fw-bold">
                                        Aucun niveau
                                    </h5>

                                    <p class="text-muted mb-3">
                                        Aucun niveau n'a encore été créé.
                                    </p>

                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalAjouterNiveau"
                                    >

                                        <i class="bi bi-plus-lg me-1"></i>

                                        Créer un niveau

                                    </button>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
             PAGINATION
             ===================================================== --}}

        @if($niveaux->hasPages())

            <div class="position-relative p-3">

                <div class="text-muted small">

                    Affichage de

                    <strong>
                        {{ $niveaux->firstItem() }}
                    </strong>

                    à

                    <strong>
                        {{ $niveaux->lastItem() }}
                    </strong>

                    sur

                    <strong>
                        {{ $niveaux->total() }}
                    </strong>

                    niveaux

                </div>


                <div class="d-flex justify-content-center mt-2">

                    {{ $niveaux->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>



    {{-- =========================================================
         MODALS
         ========================================================= --}}

    @include('niveaux.modals.create')


    @foreach($niveaux as $niveau)

        @include(
            'niveaux.modals.show',
            ['niveau' => $niveau]
        )

    @endforeach


    @foreach($niveaux as $niveau)

        @include(
            'niveaux.modals.edit',
            ['niveau' => $niveau]
        )

    @endforeach

@stop



{{-- =============================================================
     CSS SWEETALERT
     ============================================================= --}}

@section('css')

    <link
        rel="stylesheet"
        href="{{ asset('sweetalert/dist/sweetalert2.min.css') }}"
    >

@stop



{{-- =============================================================
     JAVASCRIPT
     ============================================================= --}}

@section('js')

    <script src="{{ asset('sweetalert/dist/sweetalert2.all.min.js') }}"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
             * Confirmation de suppression
             */

            document.querySelectorAll('.form-suppression').forEach(function (form) {

                form.addEventListener('submit', function (event) {

                    event.preventDefault();

                    Swal.fire({

                        title: 'Supprimer ce niveau ?',

                        text: 'Cette action est irréversible.',

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonColor: '#d33',

                        cancelButtonColor: '#6c757d',

                        confirmButtonText: 'Oui, supprimer',

                        cancelButtonText: 'Annuler',

                        reverseButtons: true

                    }).then(function (result) {

                        if (result.isConfirmed) {

                            form.submit();

                        }

                    });

                });

            });


            /*
             * Message de succès
             */

            @if(session('success'))

                Swal.fire({

                    icon: 'success',

                    title: 'Opération réussie',

                    text: @json(session('success')),

                    confirmButtonText: 'OK',

                    timer: 3000,

                    timerProgressBar: true

                });

            @endif


            /*
             * Message d'erreur
             */

            @if(session('error'))

                Swal.fire({

                    icon: 'error',

                    title: 'Erreur',

                    text: @json(session('error')),

                    confirmButtonText: 'OK'

                });

            @endif


            /*
             * Message d'avertissement
             */

            @if(session('warning'))

                Swal.fire({

                    icon: 'warning',

                    title: 'Attention',

                    text: @json(session('warning')),

                    confirmButtonText: 'OK'

                });

            @endif

        });

    </script>

@stop
