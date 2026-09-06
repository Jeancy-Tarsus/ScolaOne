<div
    class="modal fade"
    id="modalModifierPeriodeScolaire{{ $periode->id }}"
    tabindex="-1"
    aria-labelledby="modalModifierPeriodeScolaireLabel{{ $periode->id }}"
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
                    id="modalModifierPeriodeScolaireLabel{{ $periode->id }}"
                >
                    <i class="bi bi-pencil-square me-2 text-warning"></i>
                    Modifier la période scolaire
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
                action="{{ route('periodes-scolaires.update', $periode) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="modal-body">

                    <div class="row g-3">

                        {{-- ANNÉE SCOLAIRE --}}
                        <div class="col-md-12">

                            <label
                                for="annee_scolaire_id_{{ $periode->id }}"
                                class="form-label fw-semibold"
                            >
                                Année scolaire
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="annee_scolaire_id"
                                id="annee_scolaire_id_{{ $periode->id }}"
                                class="form-select"
                                required
                            >

                                @foreach($anneesScolaires as $annee)

                                    <option
                                        value="{{ $annee->id }}"
                                        {{ $periode->annee_scolaire_id == $annee->id ? 'selected' : '' }}
                                    >
                                        {{ $annee->libelle }}
                                        —
                                        {{ $annee->organisation->nom }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- NOM --}}
                        <div class="col-md-8">

                            <label
                                for="nom_{{ $periode->id }}"
                                class="form-label fw-semibold"
                            >
                                Nom de la période
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="nom"
                                id="nom_{{ $periode->id }}"
                                class="form-control"
                                value="{{ $periode->nom }}"
                                placeholder="Exemple : Premier trimestre"
                                required
                            >

                        </div>


                        {{-- CODE --}}
                        <div class="col-md-4">

                            <label
                                for="code_{{ $periode->id }}"
                                class="form-label fw-semibold"
                            >
                                Code
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="code"
                                id="code_{{ $periode->id }}"
                                class="form-control"
                                value="{{ $periode->code }}"
                                maxlength="20"
                                placeholder="Exemple : T1"
                                required
                            >

                        </div>


                        {{-- DATE DEBUT --}}
                        <div class="col-md-6">

                            <label
                                for="date_debut_{{ $periode->id }}"
                                class="form-label fw-semibold"
                            >
                                Date de début
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="date"
                                name="date_debut"
                                id="date_debut_{{ $periode->id }}"
                                class="form-control"
                                value="{{ $periode->date_debut?->format('Y-m-d') }}"
                                required
                            >

                        </div>


                        {{-- DATE FIN --}}
                        <div class="col-md-6">

                            <label
                                for="date_fin_{{ $periode->id }}"
                                class="form-label fw-semibold"
                            >
                                Date de fin
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="date"
                                name="date_fin"
                                id="date_fin_{{ $periode->id }}"
                                class="form-control"
                                value="{{ $periode->date_fin?->format('Y-m-d') }}"
                                required
                            >

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="col-md-12">

                            <label
                                for="description_{{ $periode->id }}"
                                class="form-label fw-semibold"
                            >
                                Description
                            </label>

                            <textarea
                                name="description"
                                id="description_{{ $periode->id }}"
                                class="form-control"
                                rows="4"
                                placeholder="Description ou informations complémentaires..."
                            >{{ $periode->description }}</textarea>

                        </div>


                        {{-- STATUT --}}
                        <div class="col-md-12">

                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="active"
                                    id="active_{{ $periode->id }}"
                                    value="1"
                                    {{ $periode->active ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="active_{{ $periode->id }}"
                                >
                                    Période scolaire active
                                </label>

                            </div>

                            <small class="text-muted">
                                Cette période sera considérée comme active.
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
