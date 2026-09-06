@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Périodes scolaires
        </span>
    </li>
@stop

@section('title', 'Périodes scolaires')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            Gestion des périodes scolaires
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">

            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item active">
                Périodes scolaires
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

                        <i class="bi bi-calendar3 me-2 text-primary"></i>

                        Liste des périodes

                    </h5>

                </div>


                {{-- RECHERCHE + FILTRE --}}
                <div class="col-md-7">

                    <form
                        method="GET"
                        action="{{ route('periodes-scolaires.index') }}"
                    >

                        <div class="d-flex gap-2 align-items-center">

                            {{-- RECHERCHE --}}
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                value="{{ $search ?? '' }}"
                                placeholder="Nom, code ou année scolaire..."
                            >


                            {{-- FILTRE ANNÉE SCOLAIRE --}}
                            <select
                                name="annee_scolaire_id"
                                class="form-select"
                            >

                                <option value="">
                                    Toutes les années
                                </option>

                                @foreach($anneesScolaires as $annee)

                                    <option
                                        value="{{ $annee->id }}"
                                        {{ request('annee_scolaire_id') == $annee->id ? 'selected' : '' }}
                                    >
                                        {{ $annee->libelle }}
                                        —
                                        {{ $annee->organisation->nom }}
                                    </option>

                                @endforeach

                            </select>


                            {{-- BOUTON RECHERCHER --}}
                            <button
                                type="submit"
                                class="btn btn-primary text-nowrap"
                            >

                                <i class="bi bi-search me-1"></i>

                                Rechercher

                            </button>


                            {{-- BOUTON EFFACER --}}
                            @if(!empty($search) || request('annee_scolaire_id'))

                                <a
                                    href="{{ route('periodes-scolaires.index') }}"
                                    class="btn btn-outline-secondary"
                                    title="Effacer les filtres"
                                >

                                    <i class="bi bi-x-lg"></i>

                                </a>

                            @endif

                        </div>

                    </form>

                </div>


                {{-- NOUVELLE PÉRIODE --}}
                <div class="col-md-2 text-md-end">

                    <button
                        type="button"
                        class="btn btn-primary text-nowrap"
                        data-bs-toggle="modal"
                        data-bs-target="#modalAjouterPeriodeScolaire"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Nouvelle période

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

                        <th>Période</th>

                        <th>Année scolaire</th>

                        <th>Organisation</th>

                        <th>Début</th>

                        <th>Fin</th>

                        <th>Statut</th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($periodesScolaires as $periode)

                        <tr>

                            {{-- NUMÉRO --}}
                            <td>
                                {{ $periodesScolaires->firstItem() + $loop->index }}
                            </td>


                            {{-- CODE --}}
                            <td>

                                <span class="fw-semibold">
                                    {{ $periode->code }}
                                </span>

                            </td>


                            {{-- NOM --}}
                            <td>

                                <div class="fw-semibold">
                                    {{ $periode->nom }}
                                </div>

                            </td>


                            {{-- ANNÉE SCOLAIRE --}}
                            <td>

                                @if($periode->anneeScolaire)

                                    <span class="badge text-bg-secondary">

                                        {{ $periode->anneeScolaire->libelle }}

                                    </span>

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- ORGANISATION --}}
                            <td>

                                @if($periode->anneeScolaire?->organisation)

                                    {{ $periode->anneeScolaire->organisation->nom }}

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- DATE DÉBUT --}}
                            <td>

                                {{ $periode->date_debut?->format('d/m/Y') }}

                            </td>


                            {{-- DATE FIN --}}
                            <td>

                                {{ $periode->date_fin?->format('d/m/Y') }}

                            </td>


                            {{-- STATUT --}}
                            <td>

                                @if($periode->active)

                                    <span class="badge text-bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge text-bg-danger">
                                        Inactive
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
                                    data-bs-target="#modalVoirPeriodeScolaire{{ $periode->id }}"
                                    title="Voir"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>


                                {{-- MODIFIER --}}
                                <button
                                    type="button"
                                    class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalModifierPeriodeScolaire{{ $periode->id }}"
                                    title="Modifier"
                                >

                                    <i class="bi bi-pencil"></i>

                                </button>


                                {{-- SUPPRIMER --}}
                                <form
                                    action="{{ route('periodes-scolaires.destroy', $periode) }}"
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
                                colspan="9"
                                class="text-center py-5"
                            >

                                <div class="mb-3">

                                    <i
                                        class="bi bi-calendar3 text-muted"
                                        style="font-size: 3rem;"
                                    ></i>

                                </div>


                                @if(!empty($search) || request('annee_scolaire_id'))

                                    <h5 class="fw-bold">
                                        Aucune période trouvée
                                    </h5>

                                    <p class="text-muted mb-0">
                                        Aucune période scolaire ne correspond aux critères de recherche.
                                    </p>

                                @else

                                    <h5 class="fw-bold">
                                        Aucune période scolaire
                                    </h5>

                                    <p class="text-muted mb-3">
                                        Aucune période scolaire n'a encore été créée.
                                    </p>

                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalAjouterPeriodeScolaire"
                                    >

                                        <i class="bi bi-plus-lg me-1"></i>

                                        Créer une période scolaire

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

        @if($periodesScolaires->hasPages())

            <div class="position-relative p-3">

                <div class="text-muted small">

                    Affichage de

                    <strong>
                        {{ $periodesScolaires->firstItem() }}
                    </strong>

                    à

                    <strong>
                        {{ $periodesScolaires->lastItem() }}
                    </strong>

                    sur

                    <strong>
                        {{ $periodesScolaires->total() }}
                    </strong>

                    périodes

                </div>


                <div class="d-flex justify-content-center mt-2">

                    {{ $periodesScolaires->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>



    {{-- =========================================================
         MODALS
         ========================================================= --}}

    @include('periodes_scolaires.modals.create')


    @foreach($periodesScolaires as $periode)

        @include(
            'periodes_scolaires.modals.show',
            ['periode' => $periode]
        )

    @endforeach


    @foreach($periodesScolaires as $periode)

        @include(
            'periodes_scolaires.modals.edit',
            ['periode' => $periode]
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
