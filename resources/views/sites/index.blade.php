@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Sites
        </span>
    </li>
@stop

@section('title', 'Sites')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            Gestion des sites
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">

            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item active">
                Sites
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

                {{-- ================================================= --}}
                {{-- TITRE --}}
                {{-- ================================================= --}}

                <div class="col-md-3">

                    <h5 class="mb-0 fw-bold text-nowrap">

                        <i class="bi bi-geo-alt me-2 text-primary"></i>

                        Liste des sites

                    </h5>

                </div>


                {{-- ================================================= --}}
                {{-- RECHERCHE --}}
                {{-- ================================================= --}}

                <div class="col-md-7">

                    <form method="GET"
                        action="{{ route('sites.index') }}">

                        <div class="row g-2 align-items-center">

                            {{-- RECHERCHE TEXTE --}}
                            <div class="col-md-5">

                                <input type="text"
                                    name="search"
                                    class="form-control"
                                    value="{{ $search ?? '' }}"
                                    placeholder="Code, nom ou ville...">

                            </div>


                            {{-- FILTRE ORGANISATION --}}
                            <div class="col-md-4">

                                <select name="organisation_id"
                                        class="form-select">

                                    <option value="">
                                        Toutes les organisations
                                    </option>

                                    @foreach($organisations as $organisation)

                                        <option value="{{ $organisation->id }}"
                                            {{ request('organisation_id') == $organisation->id ? 'selected' : '' }}>

                                            {{ $organisation->nom }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- BOUTONS --}}
                            <div class="col-md-3">

                                <div class="d-flex gap-2">

                                    {{-- RECHERCHER --}}
                                    <button type="submit"
                                            class="btn btn-primary flex-grow-1 text-nowrap">

                                        <i class="bi bi-search me-1"></i>

                                        Rechercher

                                    </button>


                                    {{-- EFFACER --}}
                                    @if(!empty($search) || request('organisation_id'))

                                        <a href="{{ route('sites.index') }}"
                                        class="btn btn-outline-secondary"
                                        title="Effacer les filtres">

                                            <i class="bi bi-x-lg"></i>

                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- ================================================= --}}
                {{-- NOUVEAU SITE --}}
                {{-- ================================================= --}}

                <div class="col-md-2 text-md-end">

                    <button type="button"
                            class="btn btn-primary text-nowrap"
                            data-bs-toggle="modal"
                            data-bs-target="#modalAjouterSite">

                        <i class="bi bi-plus-lg me-1"></i>

                        Nouveau site

                    </button>

                </div>

            </div>

        </div>

    </div>

    {{-- ========================================================= --}}
    {{-- TABLEAU DES SITES --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            @if($sites->count() > 0)

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
                                    Site
                                </th>

                                <th>
                                    Organisation
                                </th>

                                <th>
                                    Ville
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

                            @foreach($sites as $site)

                                <tr>

                                    {{-- NUMÉRO --}}
                                    <td class="text-muted">
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- CODE --}}
                                    <td>

                                        <span class="badge text-bg-secondary">

                                            {{ $site->code }}

                                        </span>

                                    </td>


                                    {{-- NOM --}}
                                    <td>

                                        <div class="fw-semibold">

                                            {{ $site->nom }}

                                        </div>

                                        @if($site->email)

                                            <small class="text-muted">

                                                {{ $site->email }}

                                            </small>

                                        @endif

                                    </td>


                                    {{-- ORGANISATION --}}
                                    <td>

                                        @if($site->organisation)

                                            {{ $site->organisation->nom }}

                                        @else

                                            <span class="text-muted">
                                                Non renseignée
                                            </span>

                                        @endif

                                    </td>


                                    {{-- VILLE --}}
                                    <td>

                                        @if($site->ville)

                                            {{ $site->ville }}

                                        @else

                                            <span class="text-muted">
                                                Non renseignée
                                            </span>

                                        @endif

                                    </td>


                                    {{-- TELEPHONE --}}
                                    <td>

                                        @if($site->telephone)

                                            {{ $site->telephone }}

                                        @else

                                            <span class="text-muted">
                                                Non renseigné
                                            </span>

                                        @endif

                                    </td>


                                    {{-- STATUT --}}
                                    <td>

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

                                    </td>


                                    {{-- ACTIONS --}}
                                    <td class="text-center">

                                        {{-- VOIR --}}
                                        <button type="button"
                                                class="btn btn-sm btn-info"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalVoirSite{{ $site->id }}"
                                                title="Voir">

                                            <i class="bi bi-eye"></i>

                                        </button>


                                        {{-- MODIFIER --}}
                                        <button type="button"
                                                class="btn btn-sm btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalModifierSite{{ $site->id }}"
                                                title="Modifier">

                                            <i class="bi bi-pencil-square"></i>

                                        </button>


                                        {{-- SUPPRIMER --}}
                                        <form action="{{ route('sites.destroy', $site) }}"
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

                    @if($sites->hasPages())

                        <div class="position-relative p-3">

                            {{-- INFORMATIONS À GAUCHE --}}
                            <div class="text-muted small">
                                Affichage de
                                <strong>{{ $sites->firstItem() }}</strong>
                                à
                                <strong>{{ $sites->lastItem() }}</strong>
                                sur
                                <strong>{{ $sites->total() }}</strong>
                                sites
                            </div>

                            {{-- PAGINATION CENTRÉE --}}
                            <div class="d-flex justify-content-center mt-2">

                                {{ $sites->onEachSide(1)->links() }}

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

                        <i class="bi bi-geo-alt text-muted"
                           style="font-size: 4rem;">
                        </i>

                    </div>

                    @if(!empty($search))

                        <h5>
                            Aucun site trouvé
                        </h5>

                        <p class="text-muted">

                            Aucun résultat pour :

                            <strong>
                                "{{ $search }}"
                            </strong>

                        </p>

                        <a href="{{ route('sites.index') }}"
                           class="btn btn-secondary">

                            <i class="bi bi-arrow-counterclockwise me-1"></i>

                            Réinitialiser

                        </a>

                    @else

                        <h5>
                            Aucun site
                        </h5>

                        <p class="text-muted">
                            Aucun site n'a encore été enregistré.
                        </p>

                        <button type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalAjouterSite">

                            <i class="bi bi-plus-lg me-1"></i>

                            Nouveau site

                        </button>

                    @endif

                </div>

            @endif

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL AJOUTER --}}
    {{-- ========================================================= --}}

    @include('sites.modals.create')


    {{-- ========================================================= --}}
    {{-- MODALS VOIR --}}
    {{-- ========================================================= --}}

    @foreach($sites as $site)

        @include('sites.modals.show', [
            'site' => $site
        ])

    @endforeach


    {{-- ========================================================= --}}
    {{-- MODALS MODIFIER --}}
    {{-- ========================================================= --}}

    @foreach($sites as $site)

        @include('sites.modals.edit', [
            'site' => $site,
            'organisations' => $organisations
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

                        text: 'Ce site sera définitivement supprimé.',

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
