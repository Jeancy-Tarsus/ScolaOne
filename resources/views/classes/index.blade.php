@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Classes
        </span>
    </li>
@stop

@section('title', 'Classes')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1 class="m-0">
            Gestion des classes
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">

            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item active">
                Classes
            </li>

        </ol>

    </div>

@stop


@section('content')

    {{-- Recherche / filtres --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row align-items-center g-3">

                {{-- Titre --}}
                <div class="col-md-3">

                    <h5 class="mb-0 fw-bold">

                        <i class="bi bi-easel me-2 text-primary"></i>

                        Liste des classes

                    </h5>

                </div>


                {{-- Filtres --}}
                <div class="col-md-7">

                    <form method="GET"
                          action="{{ route('classes.index') }}">

                        <div class="row g-2">

                            {{-- Recherche --}}
                            <div class="col-md-5">

                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       value="{{ $search ?? '' }}"
                                       placeholder="Rechercher une classe...">

                            </div>


                            {{-- Année scolaire --}}
                            <div class="col-md-4">

                                <select name="annee_scolaire_id"
                                        class="form-select">

                                    <option value="">
                                        Toutes les années
                                    </option>

                                    @foreach($anneesScolaires as $annee)

                                        <option value="{{ $annee->id }}"
                                            {{ request('annee_scolaire_id') == $annee->id ? 'selected' : '' }}>

                                            {{ $annee->libelle }}
                                            — {{ $annee->organisation->nom }}

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


                {{-- Nouvelle classe --}}
                <div class="col-md-2 text-md-end">

                    <button type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalAjouterClasse">

                        <i class="bi bi-plus-lg me-1"></i>

                        Nouvelle classe

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- Tableau --}}
    <div class="card shadow-sm border-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Code</th>

                        <th>Classe</th>

                        {{-- Site ajouté --}}
                        <th>Site</th>

                        <th>Année scolaire</th>

                        <th>Groupe</th>

                        <th>Niveau</th>

                        <th>Salle</th>

                        <th>Effectif</th>

                        <th>Statut</th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($classes as $classe)

                        <tr>

                            <td>
                                {{ $classes->firstItem() + $loop->index }}
                            </td>


                            <td>

                                <span class="fw-semibold">
                                    {{ $classe->code }}
                                </span>

                            </td>


                            <td>

                                <div class="fw-semibold">
                                    {{ $classe->nom }}
                                </div>

                            </td>


                            {{-- Site ajouté --}}
                            <td>

                                {{ $classe->site->nom ?? '-' }}

                            </td>


                            <td>

                                <span class="badge text-bg-info">

                                    {{ $classe->anneeScolaire->libelle }}

                                </span>

                            </td>


                            <td>

                                {{ $classe->groupe->nom }}

                            </td>


                            <td>

                                {{ $classe->groupe->niveau->nom }}

                            </td>


                            <td>

                                @if($classe->salle)

                                    {{ $classe->salle->nom }}

                                @else

                                    <span class="text-muted">
                                        Non affectée
                                    </span>

                                @endif

                            </td>


                            <td>

                                <span class="badge text-bg-secondary">

                                    {{ $classe->effectif_max }}

                                </span>

                            </td>


                            <td>

                                @if($classe->statut === 'ouverte')

                                    <span class="badge text-bg-success">
                                        Ouverte
                                    </span>

                                @elseif($classe->statut === 'fermee')

                                    <span class="badge text-bg-secondary">
                                        Fermée
                                    </span>

                                @else

                                    <span class="badge text-bg-warning">
                                        Suspendue
                                    </span>

                                @endif

                            </td>


                            <td class="text-end">

                                {{-- Voir --}}
                                <button type="button"
                                        class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalVoirClasse{{ $classe->id }}"
                                        title="Voir">

                                    <i class="bi bi-eye"></i>

                                </button>


                                {{-- Modifier --}}
                                <button type="button"
                                        class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalModifierClasse{{ $classe->id }}"
                                        title="Modifier">

                                    <i class="bi bi-pencil"></i>

                                </button>


                                {{-- Supprimer --}}
                                <form action="{{ route('classes.destroy', $classe) }}"
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

                            {{-- 11 colonnes maintenant --}}
                            <td colspan="11"
                                class="text-center py-5">

                                <i class="bi bi-easel fs-1 text-muted"></i>

                                <p class="mt-3 mb-1 fw-semibold">
                                    Aucune classe trouvée.
                                </p>

                                @if(!empty($search) || request('annee_scolaire_id'))

                                    <p class="text-muted mb-0">
                                        Aucun résultat ne correspond aux critères de recherche.
                                    </p>

                                @else

                                    <p class="text-muted mb-0">
                                        Aucune classe n'a encore été enregistrée.
                                    </p>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($classes->hasPages())

            <div class="position-relative p-3">

                <div class="text-muted small">

                    Affichage de
                    <strong>{{ $classes->firstItem() }}</strong>
                    à
                    <strong>{{ $classes->lastItem() }}</strong>
                    sur
                    <strong>{{ $classes->total() }}</strong>
                    classes

                </div>

                <div class="d-flex justify-content-center mt-2">

                    {{ $classes->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>


    {{-- Modal création --}}
    @include('classes.modals.create')


    {{-- Modals détails --}}
    @foreach($classes as $classe)

        @include('classes.modals.show', [
            'classe' => $classe
        ])

    @endforeach


    {{-- Modals modification --}}
    @foreach($classes as $classe)

        @include('classes.modals.edit', [
            'classe' => $classe
        ])

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

            document.querySelectorAll('.form-suppression').forEach(function (form) {

                form.addEventListener('submit', function (event) {

                    event.preventDefault();

                    Swal.fire({

                        title: 'Supprimer cette classe ?',

                        text: 'Cette action est irréversible.',

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonText: 'Oui, supprimer',

                        cancelButtonText: 'Annuler',

                        confirmButtonColor: '#d33',

                        cancelButtonColor: '#6c757d'

                    }).then(function (result) {

                        if (result.isConfirmed) {

                            form.submit();

                        }

                    });

                });

            });


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

                    title: 'Opération impossible',

                    text: @json(session('error')),

                    confirmButtonText: 'OK',

                    showConfirmButton: true,

                    timer: 3000,

                    timerProgressBar: true

                });

            @endif

        });

    </script>

@stop
