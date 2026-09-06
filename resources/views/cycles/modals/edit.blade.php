<div
    class="modal fade"
    id="modalModifierCycle{{ $cycle->id }}"
    tabindex="-1"
    aria-labelledby="modalModifierCycleLabel{{ $cycle->id }}"
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
                    id="modalModifierCycleLabel{{ $cycle->id }}"
                >
                    <i class="bi bi-pencil-square me-2 text-warning"></i>
                    Modifier le cycle
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
                action="{{ route('cycles.update', $cycle) }}"
                method="POST"
            >

                @csrf

                @method('PUT')

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- ORGANISATION --}}
                        <div class="col-md-12">

                            <label
                                for="organisation_id_{{ $cycle->id }}"
                                class="form-label fw-semibold"
                            >
                                Organisation
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="organisation_id"
                                id="organisation_id_{{ $cycle->id }}"
                                class="form-select"
                                required
                            >

                                @foreach($organisations as $organisation)

                                    <option
                                        value="{{ $organisation->id }}"
                                        {{ $cycle->organisation_id == $organisation->id ? 'selected' : '' }}
                                    >
                                        {{ $organisation->nom }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- NOM --}}
                        <div class="col-md-8">

                            <label
                                for="nom_{{ $cycle->id }}"
                                class="form-label fw-semibold"
                            >
                                Nom du cycle
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="nom"
                                id="nom_{{ $cycle->id }}"
                                class="form-control"
                                value="{{ $cycle->nom }}"
                                placeholder="Exemple : Primaire"
                                required
                            >

                        </div>


                        {{-- CODE --}}
                        <div class="col-md-4">

                            <label
                                for="code_{{ $cycle->id }}"
                                class="form-label fw-semibold"
                            >
                                Code
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="code"
                                id="code_{{ $cycle->id }}"
                                class="form-control"
                                value="{{ $cycle->code }}"
                                placeholder="Exemple : PRI"
                                maxlength="20"
                                required
                            >

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="col-md-12">

                            <label
                                for="description_{{ $cycle->id }}"
                                class="form-label fw-semibold"
                            >
                                Description
                            </label>

                            <textarea
                                name="description"
                                id="description_{{ $cycle->id }}"
                                class="form-control"
                                rows="4"
                                placeholder="Description ou informations complémentaires..."
                            >{{ $cycle->description }}</textarea>

                        </div>


                        {{-- STATUT --}}
                        <div class="col-md-12">

                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="statut"
                                    id="statut_{{ $cycle->id }}"
                                    value="1"
                                    {{ $cycle->statut ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="statut_{{ $cycle->id }}"
                                >
                                    Cycle actif
                                </label>

                            </div>

                            <small class="text-muted">
                                Un cycle inactif ne pourra pas être utilisé pour les nouvelles structures scolaires.
                            </small>

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
                        class="btn btn-primary"
                    >
                        <i class="bi bi-check-lg me-1"></i>
                        Enregistrer les modifications
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>
