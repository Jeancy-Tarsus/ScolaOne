@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Années scolaires
        </span>
    </li>
@stop

@section('title', 'Années scolaires')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="m-0">
            Gestion des années scolaires
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item active">
                Années scolaires
            </li>
        </ol>
    </div>
@stop

@section('content')

    {{-- RECHERCHE ET FILTRES --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <div class="row align-items-center g-3">

                {{-- TITRE --}}
                <div class="col-md-3">
                    <h5 class="mb-0 fw-bold text-nowrap">
                        <i class="bi bi-calendar3 me-2 text-primary"></i>
                        Liste des années
                    </h5>
                </div>

                {{-- RECHERCHE --}}
                <div class="col-md-7">

                    <form method="GET" action="{{ route('annees-scolaires.index') }}">

                        <div class="d-flex gap-2 align-items-center">

                            {{-- Recherche --}}
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                value="{{ $search ?? '' }}"
                                placeholder="Rechercher une année ou une école..."
                            >

                            {{-- Organisation --}}
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

                            {{-- Rechercher --}}
                            <button
                                type="submit"
                                class="btn btn-primary text-nowrap"
                            >
                                <i class="bi bi-search me-1"></i>
                                Rechercher
                            </button>

                            {{-- Effacer --}}
                            @if(!empty($search) || request('organisation_id'))
                                <a
                                    href="{{ route('annees-scolaires.index') }}"
                                    class="btn btn-outline-secondary"
                                    title="Effacer les filtres"
                                >
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif

                        </div>

                    </form>

                </div>

                {{-- NOUVELLE ANNÉE --}}
                <div class="col-md-2 text-md-end">

                    <button
                        type="button"
                        class="btn btn-primary text-nowrap"
                        data-bs-toggle="modal"
                        data-bs-target="#modalAjouterAnneeScolaire"
                    >
                        <i class="bi bi-plus-lg me-1"></i>
                        Nouvelle année
                    </button>

                </div>

            </div>

        </div>
    </div>


    {{-- TABLEAU --}}
    <div class="card shadow-sm border-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Année scolaire</th>
                        <th>Organisation</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($anneesScolaires as $annee)

                        <tr>

                            <td>
                                {{ $anneesScolaires->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <strong>
                                    {{ $annee->libelle }}
                                </strong>
                            </td>

                            <td>
                                <span class="fw-semibold">
                                    {{ $annee->organisation->nom ?? '—' }}
                                </span>
                            </td>

                            <td>
                                {{ $annee->date_debut?->format('d/m/Y') ?? '—' }}
                            </td>

                            <td>
                                {{ $annee->date_fin?->format('d/m/Y') ?? '—' }}
                            </td>

                            <td>

                                @if($annee->active)

                                    <span class="badge text-bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge text-bg-secondary">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td class="text-end">

                                {{-- Voir --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalVoirAnneeScolaire{{ $annee->id }}"
                                    title="Voir"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>

                                {{-- Modifier --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalModifierAnneeScolaire{{ $annee->id }}"
                                    title="Modifier"
                                >
                                    <i class="bi bi-pencil"></i>
                                </button>

                                {{-- Supprimer --}}
                                <form
                                    action="{{ route('annees-scolaires.destroy', $annee) }}"
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
                            <td colspan="7" class="text-center py-5">

                                <div class="mb-3">
                                    <i class="bi bi-calendar3 fs-1 text-muted"></i>
                                </div>

                                <h5 class="mb-2">
                                    Aucune année scolaire trouvée
                                </h5>

                                <p class="text-muted mb-3">

                                    @if(!empty($search) || request('organisation_id'))

                                        Aucune année scolaire ne correspond
                                        aux critères de recherche.

                                    @else

                                        Aucune année scolaire n'a encore été enregistrée.

                                    @endif

                                </p>

                                @if(empty($search) && !request('organisation_id'))

                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalAjouterAnneeScolaire"
                                    >
                                        <i class="bi bi-plus-lg me-1"></i>
                                        Créer une année scolaire
                                    </button>

                                @endif

                            </td>
                        </tr>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($anneesScolaires->hasPages())

            <div class="position-relative p-3">

                <div class="text-muted small">

                    Affichage de
                    <strong>{{ $anneesScolaires->firstItem() }}</strong>
                    à
                    <strong>{{ $anneesScolaires->lastItem() }}</strong>
                    sur
                    <strong>{{ $anneesScolaires->total() }}</strong>
                    années scolaires

                </div>

                <div class="d-flex justify-content-center mt-2">

                    {{ $anneesScolaires->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>


    {{-- MODALE AJOUT --}}
    @include('annees_scolaires.modals.create')


    {{-- MODALES VOIR --}}
    @foreach($anneesScolaires as $annee)

        @include(
            'annees_scolaires.modals.show',
            ['annee' => $annee]
        )

    @endforeach


    {{-- MODALES MODIFIER --}}
    @foreach($anneesScolaires as $annee)

        @include(
            'annees_scolaires.modals.edit',
            ['annee' => $annee]
        )

    @endforeach

@stop


@section('css')

    <link
        rel="stylesheet"
        href="{{ asset('sweetalert/dist/sweetalert2.min.css') }}"
    >

@stop


@section('js')

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

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

                    title: 'Supprimer cette année scolaire ?',

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
