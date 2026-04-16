<div class="container bg-white shadow  rounded-1 ">
    @if(auth()->user()->email == config('app.email') )
    <h4 class="fw-bold text-muted pt-1">Listes des contacts</h4>
    <div class="row">
        <div class="col-lg-3">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Nouveau
            </button>

        </div>
        <div class="col-lg-5">
            <input type="text" wire:model='recherche' class="form-control bg-white border-0 shadow-sm"
                placeholder="Recherccher un contact">
        </div>
        <div class="col-lg-1 mx-1 ">
            <select name="" wire:model='service' id="" class="form-control-sm border-0 shadow-sm">
                <option value="">Services</option>
                <option value="it">IT</option>
                <option value="RH">RH</option>
                <option value="SG">SG</option>
                <option value="mouvement">mouvement</option>
                <option value="entrepot">entrepot</option>
                <option value="soin">Soin primaire</option>
            </select>
        </div>
        <div class="col-lg-1">
            <select name="" wire:model='localites' id="" class="form-control-sm border-0 shadow-sm">
                <option value="">Localisation</option>
                <option value="ranomafana">Ranomafana</option>
                <option value="fianara">fianarantsoa</option>
                <option value="kelilalina">Kelilalina</option>
                <option value="boston">Boston</option>
                <option value="Vohitrandriana">Vohitrandriana</option>
                <option value="Antananarivo">Antananarivo</option>
                <option value="nosy varika">Nosy varika</option>
            </select>
        </div>
        <div class="col-lg-1 mx-1">
            @if(count($selected) > 0)
            <button class="btn btn-sm btn-danger" wire:click="deleteSelected"
                onclick="confirm('Confirmer la suppression ?') || event.stopImmediatePropagation()">
                  
                         {{ count($selected) }} Supprimer
                    </div>
                </button>
                @endif
    </div>
    @else
    <h4 class="fw-bold text-muted mt-1">Historique versement</h4>

    @endif
  


    <div class="modal fade" wire:ignore.self id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">

                {{-- HEADER --}}
                <div class="modal-header  text-white">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">
                        Nouveau contact
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                {{-- FORM --}}
                <form wire:submit.prevent="store">
                         @csrf
                    <div class="modal-body">

                        <div class="row">

                            {{-- NOM --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" wire:model="nom" class="form-control">
                                @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- PRENOM --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prénom</label>
                                <input type="text" wire:model="prenom" class="form-control">
                            </div>

                            {{-- POSTE --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Poste</label>
                                <input type="text" wire:model="poste" class="form-control">
                            </div>

                            {{-- SERVICE --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Service</label>
                                <input type="text" wire:model="services" class="form-control">
                            </div>

                            {{-- LOCALITE --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Localité</label>
                                <input type="text" wire:model="localite" class="form-control">
                            </div>

                            {{-- BUDGET --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Budget</label>
                                <input type="text" wire:model="budget" class="form-control">
                            </div>

                            {{-- AIRTEL --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Airtel</label>
                                <input type="text" wire:model="airtel" class="form-control">
                            </div>

                            {{-- TELMA --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Telma</label>
                                <input type="text" wire:model="telma" class="form-control">
                            </div>

                            {{-- ORANGE --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Orange</label>
                                <input type="text" wire:model="orange" class="form-control">
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" wire:model="mail" class="form-control">
                            </div>

                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Annuler
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Enregistrer
                        </button>
                    </div>

                </form>

            </div>
        </div>


    </div>
    <div class="modal fade" wire:ignore.self id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">

                {{-- HEADER --}}
                <div class="modal-header  text-dark">
                    <h5 class="modal-title">Modifier contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                {{-- FORM --}}
                <form wire:submit.prevent="update">
                     @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" wire:model="nom" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prénom</label>
                                <input type="text" wire:model="prenom" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Poste</label>
                                <input type="text" wire:model="poste" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Service</label>
                                <input type="text" wire:model="services" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Localité</label>
                                <input type="text" wire:model="localite" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Budget</label>
                                <input type="text" wire:model="budget" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Airtel</label>
                                <input type="text" wire:model="airtel" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Telma</label>
                                <input type="text" wire:model="telma" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Orange</label>
                                <input type="text" wire:model="orange" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" wire:model="mail" class="form-control">
                            </div>

                        </div>
                    </div>

                    {{-- FOOTER --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Annuler
                        </button>

                        <button type="submit" class="btn btn-warning">
                            Mettre à jour
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class=" mt-1"
        style="max-height: 100vh; overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
        {{-- {{$contacts}} --}}
        <table class="table-responsive table text-muted  table-hover align-middle" wire:poll>
            <thead class="">
                <tr>
                    {{-- <th scope="col" class="bg-white">ID</th> --}}
                    <th class="bg-white text-nowrap"><input type="checkbox" wire:model="selectAll"></th>
                    <th class="bg-white text-nowrap">Nom</th>
                    <th class="bg-white text-nowrap">Prenom</th>
                    {{-- <th class="bg-white">Date Operation</th> --}}
                    <th class="bg-white text-nowrap">Poste</th>
                    <th class="bg-white text-nowrap">Services</th>
                    <th class="bg-white text-nowrap">localite</th>
                    <th class="bg-white text-nowrap">budget</th>
                    <th class="bg-white text-nowrap">airtel</th>
                    <th class="bg-white text-nowrap">telma</th>
                    <th class="bg-white text-nowrap">orange</th>
                    <th class="bg-white text-nowrap">email</th>

                    <th>action</th>



                    {{-- <th class="bg-white text-nowrap">Date de creation</th> --}}
                    {{-- <th class="bg-white"> Date de modification</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td class="bg-white">
                        <input type="checkbox" value="{{ $contact->id }}" wire:model="selected">
                    </td>
                    <td class="bg-white text-nowrap">{{ $contact->nom }}</td>
                    <td class="bg-white text-nowrap">{{ $contact->prenom }}</td>

                    <td class="bg-white text-nowrap">{{ $contact->poste }}</td>
                    <td class="bg-white text-nowrap">{{ $contact->services }}</td>
                    <td class="bg-white text-nowrap">{{ $contact->localite }}</td>

                    <td class="bg-white text-nowrap">{{ $contact->budget }}</td>

                    <td class="bg-white text-nowrap">{{ $contact->airtel }}</td>
                    <td class="bg-white text-nowrap">{{ $contact->telma }}</td>
                    <td class="bg-white text-nowrap">{{ $contact->orange }}</td>

                    <td class="bg-white text-nowrap">{{ $contact->mail }}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-warning" wire:click="edit({{ $contact->id }})"
                            data-bs-toggle="modal" data-bs-target="#editModal">
                            Modifier
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>

    </div>

</div>
</div>
</div>