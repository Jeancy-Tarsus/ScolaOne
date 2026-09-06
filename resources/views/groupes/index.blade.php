@extends('adminlte::page')

@section('content_top_nav_left')
    <li class="nav-item">
        <span class="nav-link fw-bold">
            Groupes
        </span>
    </li>
@stop

@section('title', 'Groupes')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="m-0">
            Gestion des groupes
        </h1>

        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-1"></i>
                    Accueil
                </a>
            </li>

            <li class="breadcrumb-item">
                Structure scolaire
            </li>

            <li class="breadcrumb-item active">
                Groupes
            </li>
        </ol>
    </div>
@stop

@section('content')

    {{-- Barre de recherche et actions --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <div class="row align-items-center g-3">

                {{-- Titre --}}
                <div class="col-md-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-people me-2 text-primary"></i>
                        Liste des groupes
                    </h5>
                </div>

                {{-- Recherche + filtre --}}
                <div class="col-md-7">

                    <form method="GET"
                          action="{{ route('groupes.index') }}">

                        <div class="row g-2">

                            {{-- Recherche --}}
                            <div class="col-md-5">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       value="{{ $search ?? '' }}"
                                       placeholder="Rechercher par code ou nom...">
                            </div>

                            {{-- Niveau --}}
                            <div class="col-md-4">
                                <select name="niveau_id"
                                        class="form-select">

                                    <option value="">
                                        Tous les niveaux
                                    </option>

                                    @foreach($niveaux as $niveau)
                                        <option value="{{ $niveau->id }}"
                                            {{ request('niveau_id') == $niveau->id ? 'selected' : '' }}>

                                            {{ $niveau->nom }}
                                            — {{ $niveau->cycle->nom }}

                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- Rechercher --}}
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

                {{-- Nouveau groupe --}}
                <div class="col-md-2 text-md-end">

                    <button type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalAjouterGroupe">

                        <i class="bi bi-plus-lg me-1"></i>
                        Nouveau groupe

                    </button>

                </div>

            </div>

        </div>
    </div>


    {{-- Liste --}}
    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Groupe</th>
                            <th>Niveau</th>
                            <th>Cycle</th>
                            <th>Capacité</th>
                            <th>Ordre</th>
                            <th>Statut</th>
                            <th class="text-end">
                                Actions
                            </th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($groupes as $groupe)

                            <tr>

                                {{-- Numéro --}}
                                <td>
                                    {{ $groupes->firstItem() + $loop->index }}
                                </td>

                                {{-- Code --}}
                                <td>
                                    <span class="fw-semibold">
                                        {{ $groupe->code }}
                                    </span>
                                </td>

                                {{-- Groupe --}}
                                <td>
                                    {{ $groupe->nom }}
                                </td>

                                {{-- Niveau --}}
                                <td>
                                    {{ $groupe->niveau->nom }}
                                </td>

                                {{-- Cycle --}}
                                <td>
                                    {{ $groupe->niveau->cycle->nom }}
                                </td>

                                {{-- Capacité --}}
                                <td>
                                    <span class="badge text-bg-secondary">
                                        {{ $groupe->capacite }}
                                    </span>
                                </td>

                                {{-- Ordre --}}
                                <td>
                                    {{ $groupe->ordre }}
                                </td>

                                {{-- Statut --}}
                                <td>

                                    @if($groupe->statut)

                                        <span class="badge text-bg-success">
                                            Actif
                                        </span>

                                    @else

                                        <span class="badge text-bg-danger">
                                            Inactif
                                        </span>

                                    @endif

                                </td>

                                {{-- Actions --}}
                                <td class="text-end">

                                    {{-- Voir --}}
                                    <button type="button"
                                            class="btn btn-sm btn-info"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalVoirGroupe{{ $groupe->id }}"
                                            title="Voir">

                                        <i class="bi bi-eye"></i>

                                    </button>

                                    {{-- Modifier --}}
                                    <button type="button"
                                            class="btn btn-sm btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalModifierGroupe{{ $groupe->id }}"
                                            title="Modifier">

                                        <i class="bi bi-pencil"></i>

                                    </button>

                                    {{-- Supprimer --}}
                                    <form action="{{ route('groupes.destroy', $groupe) }}"
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
                                        <i class="bi bi-people fs-1 text-muted"></i>
                                    </div>

                                    @if(!empty($search) || request('niveau_id'))

                                        <h5 class="text-muted">
                                            Aucun groupe trouvé
                                        </h5>

                                        <p class="text-muted mb-0">
                                            Aucun groupe ne correspond aux
                                            critères de recherche.
                                        </p>

                                    @else

                                        <h5 class="text-muted">
                                            Aucun groupe enregistré
                                        </h5>

                                        <p class="text-muted mb-0">
                                            Commencez par ajouter un groupe.
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
        @if($groupes->hasPages())

            <div class="position-relative p-3">

                <div class="text-muted small">

                    Affichage de
                    <strong>{{ $groupes->firstItem() }}</strong>
                    à
                    <strong>{{ $groupes->lastItem() }}</strong>
                    sur
                    <strong>{{ $groupes->total() }}</strong>
                    groupes

                </div>

                <div class="d-flex justify-content-center mt-2">

                    {{ $groupes->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>


    {{-- Modal Ajouter --}}
    @include('groupes.modals.create')


    {{-- Modals Voir --}}
    @foreach($groupes as $groupe)

        @include(
            'groupes.modals.show',
            ['groupe' => $groupe]
        )

    @endforeach


    {{-- Modals Modifier --}}
    @foreach($groupes as $groupe)

        @include(
            'groupes.modals.edit',
            ['groupe' => $groupe]
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

            // Confirmation suppression
            document.querySelectorAll('.form-suppression').forEach(function (form) {

                form.addEventListener('submit', function (event) {

                    event.preventDefault();

                    Swal.fire({
                        title: 'Supprimer ce groupe ?',
                        text: 'Cette action est irréversible.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Oui, supprimer',
                        cancelButtonText: 'Annuler',
                        reverseButtons: true
                    }).then((result) => {

                        if (result.isConfirmed) {
                            form.submit();
                        }

                    });

                });

            });


            // Message succès
            @if(session('success'))

                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: @json(session('success')),
                    confirmButtonText: 'OK'
                });

            @endif


            // Message erreur
            @if(session('error'))

                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: @json(session('error')),
                    confirmButtonText: 'OK'
                });

            @endif


            // Message avertissement
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
