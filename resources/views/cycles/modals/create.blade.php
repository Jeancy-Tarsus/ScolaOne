<div
    class="modal fade"
    id="modalAjouterCycle"
    tabindex="-1"
    aria-labelledby="modalAjouterCycleLabel"
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
                    id="modalAjouterCycleLabel"
                >
                    <i class="bi bi-diagram-3 me-2 text-primary"></i>
                    Nouveau cycle
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
                action="{{ route('cycles.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- ORGANISATION --}}
                        <div class="col-md-12">

                            <label
                                for="organisation_id"
                                class="form-label fw-semibold"
                            >
                                Organisation
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="organisation_id"
                                id="organisation_id"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Sélectionner une organisation
                                </option>

                                @foreach($organisations as $organisation)

                                    <option
                                        value="{{ $organisation->id }}"
                                        {{ old('organisation_id') == $organisation->id ? 'selected' : '' }}
                                    >
                                        {{ $organisation->nom }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- NOM --}}
                        <div class="col-md-8">

                            <label
                                for="nom"
                                class="form-label fw-semibold"
                            >
                                Nom du cycle
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="nom"
                                id="nom"
                                class="form-control"
                                value="{{ old('nom') }}"
                                placeholder="Exemple : Primaire"
                                required
                            >

                        </div>


                        {{-- CODE --}}
                        <div class="col-md-4">

                            <label
                                for="code"
                                class="form-label fw-semibold"
                            >
                                Code
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="code"
                                id="code"
                                class="form-control"
                                value="{{ old('code') }}"
                                placeholder="Exemple : PRI"
                                maxlength="20"
                                required
                            >

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="col-md-12">

                            <label
                                for="description"
                                class="form-label fw-semibold"
                            >
                                Description
                            </label>

                            <textarea
                                name="description"
                                id="description"
                                class="form-control"
                                rows="4"
                                placeholder="Description ou informations complémentaires..."
                            >{{ old('description') }}</textarea>

                        </div>


                        {{-- STATUT --}}
                        <div class="col-md-12">

                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="statut"
                                    id="statut"
                                    value="1"
                                    {{ old('statut', true) ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="statut"
                                >
                                    Cycle actif
                                </label>

                            </div>

                            <small class="text-muted">
                                Un cycle actif peut être utilisé dans la structure scolaire.
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
                        Enregistrer
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>
