@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Salles
        </span>
    </li>
@stop

@section('title', 'Salles')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            Gestion des salles
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item active">
                Salles
            </li>
        </ol>

    </div>
@stop


@section('content')

    {{-- Recherche et actions --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row align-items-center g-3">

                {{-- Titre --}}
                <div class="col-md-3">

                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-door-open me-2 text-primary"></i>
                        Liste des salles
                    </h5>

                </div>


                {{-- Recherche + filtre --}}
                <div class="col-md-7">

                    <form method="GET"
                          action="{{ route('salles.index') }}">

                        <div class="row g-2">

                            {{-- Recherche --}}
                            <div class="col-md-5">

                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       value="{{ $search ?? '' }}"
                                       placeholder="Rechercher par code, nom, type...">

                            </div>


                            {{-- Site --}}
                            <div class="col-md-4">

                                <select name="site_id"
                                        class="form-select">

                                    <option value="">
                                        Tous les sites
                                    </option>

                                    @foreach($sites as $site)

                                        <option value="{{ $site->id }}"
                                            {{ request('site_id') == $site->id ? 'selected' : '' }}>

                                            {{ $site->nom }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- Bouton recherche --}}
                            <div class="col-md-3">

                                <button type="submit"
                                        class="btn btn-primary w-100">

                                    <i class="bi bi-search me-1"></i>
                                    Rechercher

                                </button>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- Nouvelle salle --}}
                <div class="col-md-2 text-md-end">

                    <button type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalAjouterSalle">

                        <i class="bi bi-plus-lg me-1"></i>
                        Nouvelle salle

                    </button>

                </div>

            </div>

        </div>

    </div>



    {{-- Tableau --}}
    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Code</th>

                            <th>Salle</th>

                            <th>Site</th>

                            <th>Organisation</th>

                            <th>Capacité</th>

                            <th>Type</th>

                            <th>Statut</th>

                            <th class="text-end">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($salles as $salle)

                            <tr>

                                <td>
                                    {{ $salles->firstItem() + $loop->index }}
                                </td>


                                <td>
                                    <span class="fw-semibold">
                                        {{ $salle->code }}
                                    </span>
                                </td>


                                <td>
                                    {{ $salle->nom }}
                                </td>


                                <td>
                                    {{ $salle->site->nom }}
                                </td>


                                <td>
                                    {{ $salle->site->organisation->nom }}
                                </td>


                                <td>
                                    <span class="fw-semibold">
                                        {{ $salle->capacite }}
                                    </span>
                                    places
                                </td>


                                <td>
                                    {{ $salle->type ?: '—' }}
                                </td>


                                <td>

                                    @if($salle->statut === 'disponible')

                                        <span class="badge text-bg-success">
                                            Disponible
                                        </span>

                                    @elseif($salle->statut === 'maintenance')

                                        <span class="badge text-bg-warning">
                                            Maintenance
                                        </span>

                                    @else

                                        <span class="badge text-bg-danger">
                                            Indisponible
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="text-end">

                                    {{-- Voir --}}
                                    <button type="button"
                                            class="btn btn-sm btn-info"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalVoirSalle{{ $salle->id }}"
                                            title="Voir">

                                        <i class="bi bi-eye"></i>

                                    </button>


                                    {{-- Modifier --}}
                                    <button type="button"
                                            class="btn btn-sm btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalModifierSalle{{ $salle->id }}"
                                            title="Modifier">

                                        <i class="bi bi-pencil"></i>

                                    </button>


                                    {{-- Supprimer --}}
                                    <form action="{{ route('salles.destroy', $salle) }}"
                                          method="POST"
                                          class="d-inline form-suppression">

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

                        @empty

                            <tr>

                                <td colspan="9"
                                    class="text-center py-5">

                                    <div class="mb-3">

                                        <i class="bi bi-door-open display-4 text-muted"></i>

                                    </div>

                                    @if(!empty($search) || request('site_id'))

                                        <h5>
                                            Aucune salle trouvée
                                        </h5>

                                        <p class="text-muted mb-0">
                                            Aucun résultat ne correspond
                                            aux critères de recherche.
                                        </p>

                                    @else

                                        <h5>
                                            Aucune salle enregistrée
                                        </h5>

                                        <p class="text-muted mb-0">
                                            Commencez par ajouter une salle.
                                        </p>

                                    @endif

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Pagination --}}
        @if($salles->hasPages())

            <div class="position-relative p-3">

                <div class="text-muted small">

                    Affichage de

                    <strong>
                        {{ $salles->firstItem() }}
                    </strong>

                    à

                    <strong>
                        {{ $salles->lastItem() }}
                    </strong>

                    sur

                    <strong>
                        {{ $salles->total() }}
                    </strong>

                    salles

                </div>


                <div class="d-flex justify-content-center mt-2">

                    {{ $salles->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>



    {{-- Modal Ajouter --}}
    @include('salles.modals.create')


    {{-- Modals Voir --}}
    @foreach($salles as $salle)

        @include(
            'salles.modals.show',
            ['salle' => $salle]
        )

    @endforeach


    {{-- Modals Modifier --}}
    @foreach($salles as $salle)

        @include(
            'salles.modals.edit',
            ['salle' => $salle]
        )

    @endforeach

@stop



@section('css')

    <link rel="stylesheet"
          href="{{ asset('sweetalert/dist/sweetalert2.min.css') }}">

@stop

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

                        title: 'Supprimer cette période scolaire ?',

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

                    showConfirmButton: true,

                    timer: 3000,

                    timerProgressBar: true

                });

            @endif


            @if(session('error'))

                Swal.fire({

                    icon: 'error',

                    title: 'Erreur',

                    text: @json(session('error')),

                    confirmButtonText: 'OK',

                    showConfirmButton: true,

                    timer: 3000,

                    timerProgressBar: true

                });

            @endif


            @if(session('warning'))

                Swal.fire({

                    icon: 'warning',

                    title: 'Attention',

                    text: @json(session('warning')),

                    confirmButtonText: 'OK',

                    showConfirmButton: true,

                    timer: 3000,

                    timerProgressBar: true

                });

            @endif


            @if(session('error'))

                Swal.fire({

                    icon: 'error',

                    title: 'Erreur',

                    text: @json(session('error')),

                    confirmButtonText: 'OK',

                    showConfirmButton: true

                });

            @endif


            @if(session('warning'))

                Swal.fire({

                    icon: 'warning',

                    title: 'Attention',

                    text: @json(session('warning')),

                    confirmButtonText: 'OK',

                    showConfirmButton: true

                });

            @endif

        });

    </script>

@stop
