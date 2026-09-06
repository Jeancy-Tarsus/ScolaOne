<div class="modal fade"
     id="modalModifierSalle{{ $salle->id }}"
     tabindex="-1"
     aria-labelledby="modalModifierSalleLabel{{ $salle->id }}"
     aria-hidden="true"
     data-bs-backdrop="static">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"
                    id="modalModifierSalleLabel{{ $salle->id }}">

                    <i class="bi bi-pencil-square me-2"></i>
                    Modifier la salle

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer">
                </button>

            </div>

            <form action="{{ route('salles.update', $salle) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- Site --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Site <span class="text-danger">*</span>
                            </label>

                            <select name="site_id"
                                    class="form-select"
                                    required>

                                @foreach($sites as $site)

                                    <option value="{{ $site->id }}"
                                        {{ $salle->site_id == $site->id ? 'selected' : '' }}>

                                        {{ $site->nom }}
                                        — {{ $site->organisation->nom }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- Code --}}
                        <div class="col-md-3">

                            <label class="form-label">
                                Code <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="code"
                                   class="form-control"
                                   maxlength="20"
                                   value="{{ $salle->code }}"
                                   required>

                        </div>

                        {{-- Nom --}}
                        <div class="col-md-3">

                            <label class="form-label">
                                Nom <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="nom"
                                   class="form-control"
                                   maxlength="100"
                                   value="{{ $salle->nom }}"
                                   required>

                        </div>

                        {{-- Capacité --}}
                        <div class="col-md-4">

                            <label class="form-label">
                                Capacité <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   name="capacite"
                                   class="form-control"
                                   min="1"
                                   max="5000"
                                   value="{{ $salle->capacite }}"
                                   required>

                        </div>

                        {{-- Type --}}
                        <div class="col-md-4">

                            <label class="form-label">
                                Type
                            </label>

                            <input type="text"
                                   name="type"
                                   class="form-control"
                                   maxlength="100"
                                   value="{{ $salle->type }}">

                        </div>

                        {{-- Statut --}}
                        <div class="col-md-4">

                            <label class="form-label">
                                Statut <span class="text-danger">*</span>
                            </label>

                            <select name="statut"
                                    class="form-select"
                                    required>

                                <option value="disponible"
                                    {{ $salle->statut === 'disponible' ? 'selected' : '' }}>
                                    Disponible
                                </option>

                                <option value="maintenance"
                                    {{ $salle->statut === 'maintenance' ? 'selected' : '' }}>
                                    Maintenance
                                </option>

                                <option value="indisponible"
                                    {{ $salle->statut === 'indisponible' ? 'selected' : '' }}>
                                    Indisponible
                                </option>

                            </select>

                        </div>

                        {{-- Bâtiment --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Bâtiment
                            </label>

                            <input type="text"
                                   name="batiment"
                                   class="form-control"
                                   maxlength="100"
                                   value="{{ $salle->batiment }}">

                        </div>

                        {{-- Étage --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Étage
                            </label>

                            <input type="text"
                                   name="etage"
                                   class="form-control"
                                   maxlength="50"
                                   value="{{ $salle->etage }}">

                        </div>

                        {{-- Description --}}
                        <div class="col-12">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea name="description"
                                      class="form-control"
                                      rows="3">{{ $salle->description }}</textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        <i class="bi bi-x-lg me-1"></i>
                        Annuler

                    </button>

                    <button type="submit"
                            class="btn btn-warning">

                        <i class="bi bi-check-lg me-1"></i>
                        Enregistrer les modifications

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
