@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Utilisateurs
        </span>
    </li>
@stop

@section('title', 'Utilisateurs')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            Gestion des utilisateurs
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">

            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item active">
                Utilisateurs
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

                        <i class="bi bi-people-fill me-2 text-primary"></i>

                        Liste des utilisateurs

                    </h5>

                </div>


                {{-- RECHERCHE + FILTRE --}}
                <div class="col-md-7">

                    <form
                        method="GET"
                        action="{{ route('users.index') }}"
                    >

                        <div class="d-flex gap-2 align-items-center">

                            {{-- RECHERCHE --}}
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                value="{{ request('search') }}"
                                placeholder="Nom ou email..."
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
                            @if(request('search') || request('organisation_id'))

                                <a
                                    href="{{ route('users.index') }}"
                                    class="btn btn-outline-secondary"
                                    title="Effacer les filtres"
                                >

                                    <i class="bi bi-x-lg"></i>

                                </a>

                            @endif

                        </div>

                    </form>

                </div>


                {{-- NOUVEL UTILISATEUR --}}
                <div class="col-md-2 text-md-end">

                    <button
                        type="button"
                        class="btn btn-primary text-nowrap"
                        data-bs-toggle="modal"
                        data-bs-target="#modalAjouterUtilisateur"
                    >

                        <i class="bi bi-person-plus-fill me-1"></i>

                        Nouvel utilisateur

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

                        <th>Utilisateur</th>

                        <th>Email</th>

                        <th>Organisation</th>

                        <th>Site</th>

                        <th>Rôle</th>

                        <th>Statut</th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                        <tr>

                            {{-- NUMÉRO --}}
                            <td>
                                {{ $users->firstItem() + $loop->index }}
                            </td>


                            {{-- UTILISATEUR --}}
                            <td>

                                <div class="fw-semibold">
                                    {{ $user->name }}
                                </div>

                            </td>


                            {{-- EMAIL --}}
                            <td>

                                {{ $user->email }}

                            </td>


                            {{-- ORGANISATION --}}
                            <td>

                                @if($user->organisation)

                                    {{ $user->organisation->nom }}

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- SITE --}}
                            <td>

                                @if($user->site)

                                    {{ $user->site->nom }}

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- RÔLE --}}
                            <td>

                                @forelse($user->roles as $role)

                                    <span class="badge text-bg-primary">
                                        {{ $role->name }}
                                    </span>

                                @empty

                                    <span class="text-muted">
                                        Aucun rôle
                                    </span>

                                @endforelse

                            </td>


                            {{-- STATUT --}}
                            <td>

                                @if($user->statut)

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
                                    data-bs-target="#modalVoirUtilisateur{{ $user->id }}"
                                    title="Voir"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>


                                {{-- MODIFIER --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalModifierUtilisateur{{ $user->id }}"
                                    title="Modifier"
                                >

                                    <i class="bi bi-pencil"></i>

                                </button>


                                {{-- SUPPRIMER --}}
                                <form
                                    action="{{ route('users.destroy', $user) }}"
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
                                        class="bi bi-people text-muted"
                                        style="font-size: 3rem;"
                                    ></i>

                                </div>


                                @if(request('search') || request('organisation_id'))

                                    <h5 class="fw-bold">
                                        Aucun utilisateur trouvé
                                    </h5>

                                    <p class="text-muted mb-0">
                                        Aucun utilisateur ne correspond aux critères de recherche.
                                    </p>

                                @else

                                    <h5 class="fw-bold">
                                        Aucun utilisateur
                                    </h5>

                                    <p class="text-muted mb-3">
                                        Aucun utilisateur n'a encore été créé.
                                    </p>

                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalAjouterUtilisateur"
                                    >

                                        <i class="bi bi-person-plus-fill me-1"></i>

                                        Créer un utilisateur

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

        @if($users->hasPages())

            <div class="position-relative p-3">

                <div class="text-muted small">

                    Affichage de

                    <strong>
                        {{ $users->firstItem() }}
                    </strong>

                    à

                    <strong>
                        {{ $users->lastItem() }}
                    </strong>

                    sur

                    <strong>
                        {{ $users->total() }}
                    </strong>

                    utilisateurs

                </div>


                <div class="d-flex justify-content-center mt-2">

                    {{ $users->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>



    {{-- =========================================================
         MODALS
         ========================================================= --}}

    @include('users.modals.create')


    @foreach($users as $user)

        @include(
            'users.modals.show',
            ['user' => $user]
        )

    @endforeach


    @foreach($users as $user)

        @include(
            'users.modals.edit',
            ['user' => $user]
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

                        title: 'Supprimer cet utilisateur ?',

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
