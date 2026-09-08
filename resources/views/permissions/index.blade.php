@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Permissions
        </span>
    </li>
@stop

@section('title', 'Permissions')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            <i class="bi bi-key-fill me-2"></i>
            Permissions
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">

            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item">
                Administration
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('roles.index') }}">
                    Rôles & permissions
                </a>
            </li>

            <li class="breadcrumb-item active">
                Permissions
            </li>

        </ol>

    </div>

@stop


@section('content')

    {{-- =========================================================
         RECHERCHE + NOUVELLE PERMISSION
         ========================================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row align-items-center g-3">

                {{-- TITRE --}}
                <div class="col-md-3">

                    <h5 class="mb-0 fw-bold text-nowrap">

                        <i class="bi bi-key text-primary me-2"></i>

                        Liste des permissions

                    </h5>

                </div>


                {{-- RECHERCHE --}}
                <div class="col-md-6">

                    <form
                        method="GET"
                        action="{{ route('permissions.index') }}"
                    >

                        <div class="d-flex gap-2">

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                value="{{ request('search') }}"
                                placeholder="Rechercher une permission..."
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
                                    href="{{ route('permissions.index') }}"
                                    class="btn btn-outline-secondary"
                                    title="Effacer la recherche"
                                >

                                    <i class="bi bi-x-lg"></i>

                                </a>

                            @endif

                        </div>

                    </form>

                </div>


                {{-- NOUVELLE PERMISSION --}}
                <div class="col-md-3 text-md-end">

                    <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalAjouterPermission"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Nouvelle permission

                    </button>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         TABLEAU DES PERMISSIONS
         ========================================================= --}}

    <div class="card shadow-sm border-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Permission</th>

                        <th>Guard</th>

                        <th>Créée le</th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($permissions as $permission)

                        <tr>

                            {{-- NUMÉRO --}}
                            <td>
                                {{ $permissions->firstItem() + $loop->index }}
                            </td>


                            {{-- PERMISSION --}}
                            <td>

                                <div class="d-flex align-items-center">

                                    <div
                                        class="me-2 d-flex align-items-center justify-content-center"
                                        style="width: 38px; height: 38px;"
                                    >

                                        <i class="bi bi-key-fill text-primary fs-4"></i>

                                    </div>

                                    <div>

                                        <div class="fw-semibold">
                                            {{ $permission->name }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- GUARD --}}
                            <td>

                                <span class="badge text-bg-secondary">
                                    {{ $permission->guard_name }}
                                </span>

                            </td>


                            {{-- DATE --}}
                            <td>

                                {{ $permission->created_at?->format('d/m/Y H:i') }}

                            </td>


                            {{-- ACTIONS --}}
                            <td class="text-end">

                                {{-- VOIR --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAfficherPermission{{ $permission->id }}"
                                    title="Voir"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>


                                {{-- MODIFIER --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalModifierPermission{{ $permission->id }}"
                                    title="Modifier"
                                >

                                    <i class="bi bi-pencil"></i>

                                </button>


                                {{-- SUPPRIMER --}}
                                <form
                                    action="{{ route('permissions.destroy', $permission) }}"
                                    method="POST"
                                    class="d-inline form-suppression-permission"
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
                                        class="bi bi-key-fill text-muted"
                                        style="font-size: 3rem;"
                                    ></i>

                                </div>


                                @if(request('search'))

                                    <h5 class="fw-bold">
                                        Aucune permission trouvée
                                    </h5>

                                    <p class="text-muted mb-0">
                                        Aucune permission ne correspond à votre recherche.
                                    </p>

                                @else

                                    <h5 class="fw-bold">
                                        Aucune permission
                                    </h5>

                                    <p class="text-muted mb-3">
                                        Aucune permission n'a encore été créée.
                                    </p>

                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalAjouterPermission"
                                    >

                                        <i class="bi bi-plus-lg me-1"></i>

                                        Créer une permission

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

        @if($permissions->hasPages())

            <div class="position-relative p-3">

                <div class="text-muted small">

                    Affichage de

                    <strong>
                        {{ $permissions->firstItem() }}
                    </strong>

                    à

                    <strong>
                        {{ $permissions->lastItem() }}
                    </strong>

                    sur

                    <strong>
                        {{ $permissions->total() }}
                    </strong>

                    permissions

                </div>


                <div class="d-flex justify-content-center mt-2">

                    {{ $permissions->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>



    {{-- =========================================================
         MODAL CRÉATION
         ========================================================= --}}

    @include('permissions.modals.create')


    {{-- =========================================================
         MODALS VOIR + MODIFICATION
         ========================================================= --}}

    @foreach($permissions as $permission)

        @include(
            'permissions.modals.show',
            ['permission' => $permission]
        )

        @include(
            'permissions.modals.edit',
            ['permission' => $permission]
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
                .querySelectorAll('.form-suppression-permission')
                .forEach(function (form) {

                    form.addEventListener('submit', function (event) {

                        event.preventDefault();

                        Swal.fire({

                            title: 'Supprimer cette permission ?',

                            text: 'Cette action est irréversible.',

                            icon: 'warning',

                            confirmButtonColor: '#d33',

                            cancelButtonColor: '#6c757d',

                            showCancelButton: true,

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
