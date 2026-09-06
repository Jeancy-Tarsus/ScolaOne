<div
    class="modal fade"
    id="modalModifierAnneeScolaire{{ $annee->id }}"
    tabindex="-1"
    aria-labelledby="modalModifierAnneeScolaireLabel{{ $annee->id }}"
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
                    id="modalModifierAnneeScolaireLabel{{ $annee->id }}"
                >
                    <i class="bi bi-pencil-square me-2 text-warning"></i>
                    Modifier l'année scolaire
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
                action="{{ route('annees-scolaires.update', $annee) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- ORGANISATION --}}
                        <div class="col-md-12">

                            <label
                                for="organisation_id_{{ $annee->id }}"
                                class="form-label fw-semibold"
                            >
                                Organisation <span class="text-danger">*</span>
                            </label>

                            <select
                                name="organisation_id"
                                id="organisation_id_{{ $annee->id }}"
                                class="form-select"
                                required
                            >

                                @foreach($organisations as $organisation)

                                    <option
                                        value="{{ $organisation->id }}"
                                        {{ $annee->organisation_id == $organisation->id ? 'selected' : '' }}
                                    >
                                        {{ $organisation->nom }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- LIBELLE --}}
                        <div class="col-md-6">

                            <label
                                for="libelle_{{ $annee->id }}"
                                class="form-label fw-semibold"
                            >
                                Année scolaire <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="libelle"
                                id="libelle_{{ $annee->id }}"
                                class="form-control"
                                value="{{ $annee->libelle }}"
                                placeholder="Exemple : 2026-2027"
                                required
                            >

                        </div>


                        {{-- DATE DEBUT --}}
                        <div class="col-md-3">

                            <label
                                for="date_debut_{{ $annee->id }}"
                                class="form-label fw-semibold"
                            >
                                Date de début <span class="text-danger">*</span>
                            </label>

                            <input
                                type="date"
                                name="date_debut"
                                id="date_debut_{{ $annee->id }}"
                                class="form-control"
                                value="{{ $annee->date_debut?->format('Y-m-d') }}"
                                required
                            >

                        </div>


                        {{-- DATE FIN --}}
                        <div class="col-md-3">

                            <label
                                for="date_fin_{{ $annee->id }}"
                                class="form-label fw-semibold"
                            >
                                Date de fin <span class="text-danger">*</span>
                            </label>

                            <input
                                type="date"
                                name="date_fin"
                                id="date_fin_{{ $annee->id }}"
                                class="form-control"
                                value="{{ $annee->date_fin?->format('Y-m-d') }}"
                                required
                            >

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="col-md-12">

                            <label
                                for="description_{{ $annee->id }}"
                                class="form-label fw-semibold"
                            >
                                Description
                            </label>

                            <textarea
                                name="description"
                                id="description_{{ $annee->id }}"
                                class="form-control"
                                rows="4"
                                placeholder="Description ou informations complémentaires..."
                            >{{ $annee->description }}</textarea>

                        </div>


                        {{-- STATUT --}}
                        <div class="col-md-12">

                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="active"
                                    id="active_{{ $annee->id }}"
                                    value="1"
                                    {{ $annee->active ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="active_{{ $annee->id }}"
                                >
                                    Année scolaire active
                                </label>

                            </div>

                            <small class="text-muted">
                                Cette année sera considérée comme l'année scolaire courante.
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
