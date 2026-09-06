<div
    class="modal fade"
    id="modalAjouterPeriodeScolaire"
    tabindex="-1"
    aria-labelledby="modalAjouterPeriodeScolaireLabel"
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
                    id="modalAjouterPeriodeScolaireLabel"
                >
                    <i class="bi bi-calendar-plus me-2 text-primary"></i>
                    Nouvelle période scolaire
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
                action="{{ route('periodes-scolaires.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- ANNÉE SCOLAIRE --}}
                        <div class="col-md-12">

                            <label
                                for="annee_scolaire_id"
                                class="form-label fw-semibold"
                            >
                                Année scolaire
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="annee_scolaire_id"
                                id="annee_scolaire_id"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Sélectionner une année scolaire
                                </option>

                                @foreach($anneesScolaires as $annee)

                                    <option
                                        value="{{ $annee->id }}"
                                        {{ old('annee_scolaire_id') == $annee->id ? 'selected' : '' }}
                                    >
                                        {{ $annee->libelle }}
                                        —
                                        {{ $annee->organisation->nom }}
                                    </option>

                                @endforeach

                            </select>

                            <small class="text-muted">
                                Sélectionnez l'année scolaire à laquelle cette période appartient.
                            </small>

                        </div>


                        {{-- NOM --}}
                        <div class="col-md-8">

                            <label
                                for="nom"
                                class="form-label fw-semibold"
                            >
                                Nom de la période
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="nom"
                                id="nom"
                                class="form-control"
                                value="{{ old('nom') }}"
                                placeholder="Exemple : Premier trimestre"
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
                                placeholder="Exemple : T1"
                                maxlength="20"
                                required
                            >

                        </div>


                        {{-- DATE DEBUT --}}
                        <div class="col-md-6">

                            <label
                                for="date_debut"
                                class="form-label fw-semibold"
                            >
                                Date de début
                                <span class="text-danger">*</span>
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


                        {{-- DATE FIN --}}
                        <div class="col-md-6">

                            <label
                                for="date_fin"
                                class="form-label fw-semibold"
                            >
                                Date de fin
                                <span class="text-danger">*</span>
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
                                    name="active"
                                    id="active"
                                    value="1"
                                    {{ old('active') ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="active"
                                >
                                    Période scolaire active
                                </label>

                            </div>

                            <small class="text-muted">
                                Activez cette option si cette période est actuellement utilisée.
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
