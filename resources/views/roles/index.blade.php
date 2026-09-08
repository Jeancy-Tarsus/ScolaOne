@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Rôles & permissions
        </span>
    </li>
@stop

@section('title', 'Rôles')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            <i class="bi bi-shield-lock-fill me-2"></i>
            Rôles & permissions
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">

            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('permissions.index') }}">
                   Permissions
                </a>
            </li>

        </ol>

    </div>

@stop


@section('content')

    {{-- =========================================================
         RECHERCHE + NOUVEAU RÔLE
         ========================================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row align-items-center g-3">

                {{-- TITRE --}}
                <div class="col-md-3">

                    <h5 class="mb-0 fw-bold text-nowrap">

                        <i class="bi bi-shield-check text-primary me-2"></i>

                        Liste des rôles

                    </h5>

                </div>


                {{-- RECHERCHE --}}
                <div class="col-md-6">

                    <form
                        method="GET"
                        action="{{ route('roles.index') }}"
                    >

                        <div class="d-flex gap-2">

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                value="{{ request('search') }}"
                                placeholder="Rechercher un rôle..."
                            >

                            <button
                                type="submit"
                                class="btn btn-primary text-nowrap"
                            >

                                <i class="bi bi-search me-1"></i>

                                Rechercher

                            </button>


                            @if(request('search'))

                                <a
                                    href="{{ route('roles.index') }}"
                                    class="btn btn-outline-secondary"
                                    title="Effacer la recherche"
                                >

                                    <i class="bi bi-x-lg"></i>

                                </a>

                            @endif

                        </div>

                    </form>

                </div>


                {{-- NOUVEAU RÔLE --}}
                <div class="col-md-3 text-md-end">

                    <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalAjouterRole"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Nouveau rôle

                    </button>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         TABLEAU DES RÔLES
         ========================================================= --}}

    <div class="card shadow-sm border-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Rôle</th>

                        <th>Guard</th>

                        <th>Permissions</th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($roles as $role)

                        <tr>

                            {{-- NUMÉRO --}}
                            <td>
                                {{ $roles->firstItem() + $loop->index }}
                            </td>


                            {{-- NOM DU RÔLE --}}
                            <td>

                                <div class="d-flex align-items-center">

                                    <div
                                        class="me-2 d-flex align-items-center justify-content-center"
                                        style="width: 38px; height: 38px;"
                                    >

                                        <i class="bi bi-shield-fill text-primary fs-4"></i>

                                    </div>

                                    <div>

                                        <div class="fw-semibold">
                                            {{ $role->name }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- GUARD --}}
                            <td>

                                <span class="badge text-bg-secondary">
                                    {{ $role->guard_name }}
                                </span>

                            </td>


                            {{-- PERMISSIONS --}}
                            <td>

                                <span class="badge text-bg-info">

                                    {{ $role->permissions()->count() }}

                                    permission{{ $role->permissions()->count() > 1 ? 's' : '' }}

                                </span>

                            </td>


                            {{-- ACTIONS --}}
                            <td class="text-end">

                                {{-- VOIR --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalVoirRole{{ $role->id }}"
                                    title="Voir"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>


                                {{-- MODIFIER --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalModifierRole{{ $role->id }}"
                                    title="Modifier"
                                >

                                    <i class="bi bi-pencil"></i>

                                </button>


                                {{-- SUPPRIMER --}}
                                <form
                                    action="{{ route('roles.destroy', $role) }}"
                                    method="POST"
                                    class="d-inline form-suppression-role"
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
                                colspan="5"
                                class="text-center py-5"
                            >

                                <div class="mb-3">

                                    <i
                                        class="bi bi-shield-x text-muted"
                                        style="font-size: 3rem;"
                                    ></i>

                                </div>


                                @if(request('search'))

                                    <h5 class="fw-bold">
                                        Aucun rôle trouvé
                                    </h5>

                                    <p class="text-muted mb-0">
                                        Aucun rôle ne correspond à votre recherche.
                                    </p>

                                @else

                                    <h5 class="fw-bold">
                                        Aucun rôle
                                    </h5>

                                    <p class="text-muted mb-3">
                                        Aucun rôle n'a encore été créé.
                                    </p>

                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalAjouterRole"
                                    >

                                        <i class="bi bi-plus-lg me-1"></i>

                                        Créer un rôle

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

        @if($roles->hasPages())

            <div class="position-relative p-3">

                <div class="text-muted small">

                    Affichage de

                    <strong>
                        {{ $roles->firstItem() }}
                    </strong>

                    à

                    <strong>
                        {{ $roles->lastItem() }}
                    </strong>

                    sur

                    <strong>
                        {{ $roles->total() }}
                    </strong>

                    rôles

                </div>


                <div class="d-flex justify-content-center mt-2">

                    {{ $roles->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>



    {{-- =========================================================
         MODAL CRÉATION
         ========================================================= --}}

    @include('roles.modals.create')


    {{-- =========================================================
         MODALS VOIR
         ========================================================= --}}

    @foreach($roles as $role)

        @include(
            'roles.modals.show',
            ['role' => $role]
        )

    @endforeach


    {{-- =========================================================
         MODALS MODIFICATION
         ========================================================= --}}

    @foreach($roles as $role)

        @include(
            'roles.modals.edit',
            ['role' => $role]
        )

    @endforeach

@stop



{{-- =============================================================
     SWEETALERT
     ============================================================= --}}

@section('css')

    <link
        rel="stylesheet"
        href="{{ asset('sweetalert/dist/sweetalert2.min.css') }}"
    >

@stop


@section('js')

    <script src="{{ asset('sweetalert/dist/sweetalert2.all.min.js') }}"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {


            /* =====================================================
             * CONFIRMATION SUPPRESSION
             * ===================================================== */

            document
                .querySelectorAll('.form-suppression-role')
                .forEach(function (form) {

                    form.addEventListener('submit', function (event) {

                        event.preventDefault();

                        Swal.fire({

                            title: 'Supprimer ce rôle ?',

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


            /* =====================================================
             * MESSAGE SUCCÈS
             * ===================================================== */

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


            /* =====================================================
             * MESSAGE ERREUR
             * ===================================================== */

            @if(session('error'))

                Swal.fire({

                    icon: 'error',

                    title: 'Erreur',

                    text: @json(session('error')),

                    confirmButtonText: 'OK'

                });

            @endif


            /* =====================================================
             * MESSAGE AVERTISSEMENT
             * ===================================================== */

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
