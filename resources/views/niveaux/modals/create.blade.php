<div
    class="modal fade"
    id="modalAjouterNiveau"
    tabindex="-1"
    aria-labelledby="modalAjouterNiveauLabel"
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
                    id="modalAjouterNiveauLabel"
                >
                    <i class="bi bi-layers me-2 text-primary"></i>
                    Nouveau niveau
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
                action="{{ route('niveaux.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- CYCLE --}}
                        <div class="col-md-6">

                            <label
                                for="cycle_id"
                                class="form-label fw-semibold"
                            >
                                Cycle
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="cycle_id"
                                id="cycle_id"
                                class="form-select @error('cycle_id') is-invalid @enderror"
                                required
                            >

                                <option value="">
                                    Sélectionner un cycle
                                </option>

                                @foreach($cycles as $cycle)

                                    <option
                                        value="{{ $cycle->id }}"
                                        {{ old('cycle_id') == $cycle->id ? 'selected' : '' }}
                                    >
                                        {{ $cycle->nom }}
                                        — {{ $cycle->organisation->nom }}
                                    </option>

                                @endforeach

                            </select>

                            @error('cycle_id')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- NOM --}}
                        <div class="col-md-6">

                            <label
                                for="nom_niveau"
                                class="form-label fw-semibold"
                            >
                                Nom du niveau
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="nom"
                                id="nom_niveau"
                                class="form-control @error('nom') is-invalid @enderror"
                                value="{{ old('nom') }}"
                                placeholder="Ex. 1ère année"
                                required
                            >

                            @error('nom')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- CODE --}}
                        <div class="col-md-6">

                            <label
                                for="code_niveau"
                                class="form-label fw-semibold"
                            >
                                Code
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="code"
                                id="code_niveau"
                                class="form-control @error('code') is-invalid @enderror"
                                value="{{ old('code') }}"
                                placeholder="Ex. 1A"
                                maxlength="20"
                                required
                            >

                            <div class="form-text">
                                Le code doit être unique dans le cycle.
                            </div>

                            @error('code')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- ORDRE --}}
                        <div class="col-md-6">

                            <label
                                for="ordre_niveau"
                                class="form-label fw-semibold"
                            >
                                Ordre d'affichage
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                name="ordre"
                                id="ordre_niveau"
                                class="form-control @error('ordre') is-invalid @enderror"
                                value="{{ old('ordre', 1) }}"
                                min="1"
                                required
                            >

                            <div class="form-text">
                                Exemple : 1, 2, 3, 4...
                            </div>

                            @error('ordre')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="col-12">

                            <label
                                for="description_niveau"
                                class="form-label fw-semibold"
                            >
                                Description
                            </label>

                            <textarea
                                name="description"
                                id="description_niveau"
                                rows="3"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Description du niveau..."
                            >{{ old('description') }}</textarea>

                            @error('description')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- STATUT --}}
                        <div class="col-12">

                            <div class="form-check form-switch">

                                <input
                                    type="checkbox"
                                    name="statut"
                                    value="1"
                                    class="form-check-input"
                                    id="statut_niveau"
                                    {{ old('statut', true) ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="statut_niveau"
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
