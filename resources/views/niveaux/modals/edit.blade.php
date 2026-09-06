<div
    class="modal fade"
    id="modalModifierNiveau{{ $niveau->id }}"
    tabindex="-1"
    aria-labelledby="modalModifierNiveauLabel{{ $niveau->id }}"
    aria-hidden="true"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">

                <h5
                    class="modal-title fw-bold"
                    id="modalModifierNiveauLabel{{ $niveau->id }}"
                >
                    <i class="bi bi-pencil-square me-2 text-warning"></i>
                    Modifier le niveau
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fermer"
                ></button>

            </div>


            {{-- FORMULAIRE --}}
            <form
                action="{{ route('niveaux.update', $niveau) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- CYCLE --}}
                        <div class="col-md-6">

                            <label
                                for="cycle_id_{{ $niveau->id }}"
                                class="form-label fw-semibold"
                            >
                                Cycle
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="cycle_id"
                                id="cycle_id_{{ $niveau->id }}"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Sélectionner un cycle
                                </option>

                                @foreach($cycles as $cycle)

                                    <option
                                        value="{{ $cycle->id }}"
                                        {{ $niveau->cycle_id == $cycle->id ? 'selected' : '' }}
                                    >
                                        {{ $cycle->nom }}
                                        — {{ $cycle->organisation->nom }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- NOM --}}
                        <div class="col-md-6">

                            <label
                                for="nom_{{ $niveau->id }}"
                                class="form-label fw-semibold"
                            >
                                Nom du niveau
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="nom"
                                id="nom_{{ $niveau->id }}"
                                class="form-control"
                                value="{{ $niveau->nom }}"
                                placeholder="Ex. 1ère année"
                                required
                            >

                        </div>


                        {{-- CODE --}}
                        <div class="col-md-6">

                            <label
                                for="code_{{ $niveau->id }}"
                                class="form-label fw-semibold"
                            >
                                Code
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="code"
                                id="code_{{ $niveau->id }}"
                                class="form-control"
                                value="{{ $niveau->code }}"
                                maxlength="20"
                                placeholder="Ex. 1A"
                                required
                            >

                            <div class="form-text">
                                Le code doit être unique dans le cycle.
                            </div>

                        </div>


                        {{-- ORDRE --}}
                        <div class="col-md-6">

                            <label
                                for="ordre_{{ $niveau->id }}"
                                class="form-label fw-semibold"
                            >
                                Ordre d'affichage
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                name="ordre"
                                id="ordre_{{ $niveau->id }}"
                                class="form-control"
                                value="{{ $niveau->ordre }}"
                                min="1"
                                required
                            >

                            <div class="form-text">
                                Exemple : 1, 2, 3, 4...
                            </div>

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="col-12">

                            <label
                                for="description_{{ $niveau->id }}"
                                class="form-label fw-semibold"
                            >
                                Description
                            </label>

                            <textarea
                                name="description"
                                id="description_{{ $niveau->id }}"
                                rows="3"
                                class="form-control"
                                placeholder="Description du niveau..."
                            >{{ $niveau->description }}</textarea>

                        </div>


                        {{-- STATUT --}}
                        <div class="col-12">

                            <div class="form-check form-switch">

                                <input
                                    type="checkbox"
                                    name="statut"
                                    value="1"
                                    class="form-check-input"
                                    id="statut_{{ $niveau->id }}"
                                    {{ $niveau->statut ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="statut_{{ $niveau->id }}"
                                >
                                    Niveau actif
                                </label>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        <i class="bi bi-x-lg me-1"></i>
                        Annuler
                    </button>

                    <button
                        type="submit"
                        class="btn btn-warning"
                    >
                        <i class="bi bi-check-lg me-1"></i>
                        Enregistrer les modifications
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>
