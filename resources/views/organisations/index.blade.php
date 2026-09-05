@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Organisations
        </span>
    </li>
@stop

@section('title', 'Organisations')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            Gestion des organisations
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">

            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item active">
                Organisations
            </li>

        </ol>

    </div>

@stop


@section('content')

    {{-- ========================================================= --}}
    {{-- BARRE DE RECHERCHE --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row align-items-center g-3">

                {{-- TITRE --}}
                <div class="col-md-4">

                    <h5 class="mb-0 fw-bold">

                        <i class="bi bi-buildings me-2 text-primary"></i>

                        Liste des organisations

                    </h5>

                </div>


                {{-- RECHERCHE --}}
                <div class="col-md-5">

                    <form method="GET"
                          action="{{ route('organisations.index') }}">

                        <div class="input-group">

                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   value="{{ $search ?? '' }}"
                                   placeholder="Rechercher par code ou nom...">

                            @if(!empty($search))

                                <a href="{{ route('organisations.index') }}"
                                   class="btn btn-outline-secondary"
                                   title="Effacer">

                                    <i class="bi bi-x-lg"></i>

                                </a>

                            @endif

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-search me-1"></i>

                                Rechercher

                            </button>

                        </div>

                    </form>

                </div>


                {{-- AJOUTER --}}
                <div class="col-md-3 text-md-end">

                    <button type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalAjouterOrganisation">

                        <i class="bi bi-plus-lg me-1"></i>

                        Nouvelle organisation

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- TABLEAU DES ORGANISATIONS --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            @if($organisations->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th width="60">
                                    #
                                </th>

                                <th>
                                    Code
                                </th>

                                <th>
                                    Organisation
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Téléphone
                                </th>

                                <th>
                                    Statut
                                </th>

                                <th width="160"
                                    class="text-center">

                                    Actions

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($organisations as $organisation)

                                <tr>

                                    {{-- NUMÉRO --}}
                                    <td class="text-muted">
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- CODE --}}
                                    <td>

                                        <span class="badge text-bg-secondary">

                                            {{ $organisation->code }}

                                        </span>

                                    </td>


                                    {{-- NOM --}}
                                    <td>

                                        <div class="fw-semibold">
                                            {{ $organisation->nom }}
                                        </div>

                                    </td>


                                    {{-- EMAIL --}}
                                    <td>

                                        @if($organisation->email)

                                            {{ $organisation->email }}

                                        @else

                                            <span class="text-muted">
                                                Non renseigné
                                            </span>

                                        @endif

                                    </td>


                                    {{-- TÉLÉPHONE --}}
                                    <td>

                                        @if($organisation->telephone)

                                            {{ $organisation->telephone }}

                                        @else

                                            <span class="text-muted">
                                                Non renseigné
                                            </span>

                                        @endif

                                    </td>


                                    {{-- STATUT --}}
                                    <td>

                                        @if($organisation->statut)

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

                                    </td>


                                    {{-- ACTIONS --}}
                                    <td class="text-center">

                                        {{-- VOIR --}}
                                        <button type="button"
                                                class="btn btn-sm btn-info"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalVoirOrganisation{{ $organisation->id }}"
                                                title="Voir">

                                            <i class="bi bi-eye"></i>

                                        </button>


                                        {{-- MODIFIER --}}
                                        <button type="button"
                                                class="btn btn-sm btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalModifierOrganisation{{ $organisation->id }}"
                                                title="Modifier">

                                            <i class="bi bi-pencil-square"></i>

                                        </button>


                                        {{-- SUPPRIMER --}}
                                        <form action="{{ route('organisations.destroy', $organisation) }}"
                                              method="POST"
                                              class="form-suppression d-inline">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Supprimer">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                    @if($organisations->hasPages())

                        <div class="position-relative p-3">

                            {{-- INFORMATIONS --}}
                            <div class="text-muted small">
                                Affichage de
                                <strong>{{ $organisations->firstItem() }}</strong>
                                à
                                <strong>{{ $organisations->lastItem() }}</strong>
                                sur
                                <strong>{{ $organisations->total() }}</strong>
                                organisations
                            </div>

                            {{-- PAGINATION CENTRÉE --}}
                            <div class="d-flex justify-content-center mt-2">

                                {{ $organisations->onEachSide(1)->links() }}

                            </div>

                        </div>

                    @endif

                </div>

            @else

                {{-- ================================================= --}}
                {{-- AUCUN RÉSULTAT --}}
                {{-- ================================================= --}}

                <div class="text-center py-5 px-3">

                    <div class="mb-3">

                        <i class="bi bi-buildings text-muted"
                           style="font-size: 4rem;">
                        </i>

                    </div>

                    @if(!empty($search))

                        <h5>
                            Aucune organisation trouvée
                        </h5>

                        <p class="text-muted">

                            Aucun résultat pour :

                            <strong>
                                "{{ $search }}"
                            </strong>

                        </p>

                        <a href="{{ route('organisations.index') }}"
                           class="btn btn-secondary">

                            <i class="bi bi-arrow-counterclockwise me-1"></i>

                            Réinitialiser

                        </a>

                    @else

                        <h5>
                            Aucune organisation
                        </h5>

                        <p class="text-muted">
                            Aucune organisation n'a encore été enregistrée.
                        </p>

                        <button type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalAjouterOrganisation">

                            <i class="bi bi-plus-lg me-1"></i>

                            Nouvelle organisation

                        </button>

                    @endif

                </div>

            @endif

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL AJOUTER --}}
    {{-- ========================================================= --}}

    @include('organisations.modals.create')


    {{-- ========================================================= --}}
    {{-- MODALS VOIR --}}
    {{-- ========================================================= --}}

    @foreach($organisations as $organisation)

        @include('organisations.modals.show', [
            'organisation' => $organisation
        ])

    @endforeach


    {{-- ========================================================= --}}
    {{-- MODALS MODIFIER --}}
    {{-- ========================================================= --}}

    @foreach($organisations as $organisation)

        @include('organisations.modals.edit', [
            'organisation' => $organisation
        ])

    @endforeach

@stop


{{-- ============================================================= --}}
{{-- SWEETALERT CSS --}}
{{-- ============================================================= --}}

@section('css')

    <link rel="stylesheet"
          href="{{ asset('sweetalert/dist/sweetalert2.min.css') }}">

@stop


{{-- ============================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================================================= --}}

@section('js')

    {{-- Bootstrap 5 --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    {{-- SweetAlert --}}
    <script src="{{ asset('sweetalert/dist/sweetalert2.all.min.js') }}"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
             * ======================================================
             * CONFIRMATION SUPPRESSION
             * ======================================================
             */

            document.querySelectorAll('.form-suppression').forEach(function (form) {

                form.addEventListener('submit', function (event) {

                    event.preventDefault();

                    Swal.fire({

                        title: 'Êtes-vous sûr ?',

                        text: 'Cette organisation sera définitivement supprimée.',

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
             * ======================================================
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
