@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Cycles
        </span>
    </li>
@stop

@section('title', 'Cycles')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            Gestion des cycles
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">

            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item active">
                Cycles
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

                        <i class="bi bi-diagram-3 me-2 text-primary"></i>

                        Liste des cycles

                    </h5>

                </div>


                {{-- RECHERCHE + FILTRE --}}
                <div class="col-md-7">

                    <form
                        method="GET"
                        action="{{ route('cycles.index') }}"
                    >

                        <div class="d-flex gap-2 align-items-center">

                            {{-- RECHERCHE --}}
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                value="{{ $search ?? '' }}"
                                placeholder="Nom, code ou organisation..."
                            >


                            {{-- FILTRE ORGANISATION --}}
                            <select
                                name="organisation_id"
                                class="form-select"
                            >

                                <option value="">
                                    Toutes les organisations
                                </option>

                                @foreach($organisations as $organisation)

                                    <option
                                        value="{{ $organisation->id }}"
                                        {{ request('organisation_id') == $organisation->id ? 'selected' : '' }}
                                    >
                                        {{ $organisation->nom }}
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
                            @if(!empty($search) || request('organisation_id'))

                                <a
                                    href="{{ route('cycles.index') }}"
                                    class="btn btn-outline-secondary"
                                    title="Effacer les filtres"
                                >

                                    <i class="bi bi-x-lg"></i>

                                </a>

                            @endif

                        </div>

                    </form>

                </div>


                {{-- NOUVEAU CYCLE --}}
                <div class="col-md-2 text-md-end">

                    <button
                        type="button"
                        class="btn btn-primary text-nowrap"
                        data-bs-toggle="modal"
                        data-bs-target="#modalAjouterCycle"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Nouveau cycle

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

                        <th>Cycle</th>

                        <th>Organisation</th>

                        <th>Description</th>

                        <th>Statut</th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($cycles as $cycle)

                        <tr>

                            {{-- NUMÉRO --}}
                            <td>
                                {{ $cycles->firstItem() + $loop->index }}
                            </td>


                            {{-- CODE --}}
                            <td>

                                <span class="fw-semibold">
                                    {{ $cycle->code }}
                                </span>

                            </td>


                            {{-- NOM --}}
                            <td>

                                <div class="fw-semibold">
                                    {{ $cycle->nom }}
                                </div>

                            </td>


                            {{-- ORGANISATION --}}
                            <td>

                                @if($cycle->organisation)

                                    {{ $cycle->organisation->nom }}

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- DESCRIPTION --}}
                            <td>

                                @if($cycle->description)

                                    <span
                                        title="{{ $cycle->description }}"
                                    >
                                        {{ \Illuminate\Support\Str::limit($cycle->description, 45) }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- STATUT --}}
                            <td>

                                @if($cycle->statut)

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
                                    data-bs-target="#modalVoirCycle{{ $cycle->id }}"
                                    title="Voir"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>


                                {{-- MODIFIER --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalModifierCycle{{ $cycle->id }}"
                                    title="Modifier"
                                >

                                    <i class="bi bi-pencil"></i>

                                </button>


                                {{-- SUPPRIMER --}}
                                <form
                                    action="{{ route('cycles.destroy', $cycle) }}"
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
                                colspan="7"
                                class="text-center py-5"
                            >

                                <div class="mb-3">

                                    <i
                                        class="bi bi-diagram-3 text-muted"
                                        style="font-size: 3rem;"
                                    ></i>

                                </div>


                                @if(!empty($search) || request('organisation_id'))

                                    <h5 class="fw-bold">
                                        Aucun cycle trouvé
                                    </h5>

                                    <p class="text-muted mb-0">
                                        Aucun cycle ne correspond aux critères de recherche.
                                    </p>

                                @else

                                    <h5 class="fw-bold">
                                        Aucun cycle
                                    </h5>

                                    <p class="text-muted mb-3">
                                        Aucun cycle n'a encore été créé.
                                    </p>

                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalAjouterCycle"
                                    >

                                        <i class="bi bi-plus-lg me-1"></i>

                                        Créer un cycle

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

        @if($cycles->hasPages())

            <div class="position-relative p-3">

                <div class="text-muted small">

                    Affichage de

                    <strong>
                        {{ $cycles->firstItem() }}
                    </strong>

                    à

                    <strong>
                        {{ $cycles->lastItem() }}
                    </strong>

                    sur

                    <strong>
                        {{ $cycles->total() }}
                    </strong>

                    cycles

                </div>


                <div class="d-flex justify-content-center mt-2">

                    {{ $cycles->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>



    {{-- =========================================================
         MODALS
         ========================================================= --}}

    @include('cycles.modals.create')


    @foreach($cycles as $cycle)

        @include(
            'cycles.modals.show',
            ['cycle' => $cycle]
        )

    @endforeach


    @foreach($cycles as $cycle)

        @include(
            'cycles.modals.edit',
            ['cycle' => $cycle]
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

            /* ======================================================
             * CONFIRMATION SUPPRESSION
             * ======================================================
             */

            document.querySelectorAll('.form-suppression').forEach(function (form) {

                form.addEventListener('submit', function (event) {

                    event.preventDefault();

                    Swal.fire({

                        title: 'Supprimer ce cycle ?',

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


            /* ======================================================
             * MESSAGES DE SESSION
             * ======================================================
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


            @if(session('error'))

                Swal.fire({

                    icon: 'error',

                    title: 'Erreur',

                    text: @json(session('error')),

                    confirmButtonText: 'OK'

                });

            @endif


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
