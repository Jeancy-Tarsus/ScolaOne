<div
    class="modal fade"
    id="modalAjouterAnneeScolaire"
    tabindex="-1"
    aria-labelledby="modalAjouterAnneeScolaireLabel"
    aria-hidden="true"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalAjouterAnneeScolaireLabel">
                    <i class="bi bi-calendar-plus me-2 text-primary"></i>
                    Nouvelle année scolaire
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fermer"
                ></button>
            </div>

            <form
                action="{{ route('annees-scolaires.store') }}"
                method="POST"
            >
                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- Organisation --}}
                        <div class="col-md-12">

                            <label for="organisation_id" class="form-label fw-semibold">
                                Organisation <span class="text-danger">*</span>
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


                        {{-- Libellé --}}
                        <div class="col-md-6">

                            <label for="libelle" class="form-label fw-semibold">
                                Année scolaire <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="libelle"
                                id="libelle"
                                class="form-control"
                                value="{{ old('libelle') }}"
                                placeholder="Exemple : 2026-2027"
                                required
                            >

                        </div>


                        {{-- Date début --}}
                        <div class="col-md-3">

                            <label for="date_debut" class="form-label fw-semibold">
                                Date de début <span class="text-danger">*</span>
                            </label>

                            <input
                                type="date"
                                name="date_debut"
                                id="date_debut"
                                class="form-control"
                                value="{{ old('date_debut') }}"
                                required
                            >

                        </div>


                        {{-- Date fin --}}
                        <div class="col-md-3">

                            <label for="date_fin" class="form-label fw-semibold">
                                Date de fin <span class="text-danger">*</span>
                            </label>

                            <input
                                type="date"
                                name="date_fin"
                                id="date_fin"
                                class="form-control"
                                value="{{ old('date_fin') }}"
                                required
                            >

                        </div>


                        {{-- Description --}}
                        <div class="col-md-12">

                            <label for="description" class="form-label fw-semibold">
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


                        {{-- Active --}}
                        <div class="col-md-12">

                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="active"
                                    id="active"
                                    value="1"
                                    {{ old('active', true) ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="active"
                                >
                                    Année scolaire active
                                </label>

                            </div>

                            <small class="text-muted">
                                L'année active sera considérée comme l'année scolaire courante de l'organisation.
                            </small>

                        </div>

                    </div>

                </div>

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
                        Créer l'année scolaire
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>
