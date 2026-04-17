<div class="container bg-white shadow  rounded-1 ">
    <h4 class="fw-bold text-muted pt-2">Listes des contacts</h4>
    <div class="row">
        <div class="col-lg-3">
            @if(auth()->user()->email ?? 'guest' == config('app.email') )
            <button type="button" class="btn btn-primary border-0 btn-sm" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Nouveau
            </button>
            @endif

        </div>
        <div class="col-lg-5">
            <input type="text" wire:model='recherche' class="form-control bg-white border-0 shadow-sm"
                placeholder="Recherccher un contact">
        </div>
        <div class="col-lg-4 justify-content-end d-flex ">
            <div class="d-flex gap-2">
                <select name="" wire:model='service' id="" style="cursor: pointer" class="form-control-sm border-0 shadow-sm">
                    <option value="">Services</option>
                    <option value="it">IT</option>
                    <option value="RH">RH</option>
                    <option value="SG">SG</option>
                    <option value="mouvement">mouvement</option>
                    <option value="entrepot">entrepot</option>
                    <option value="soin">Soin primaire</option>
                </select>

                <select name="" wire:model='localites' id="" style="cursor: pointer" class="form-control-sm border-0 shadow-sm">
                    <option value="">Localisation</option>
                    <option value="ranomafana">Ranomafana</option>
                    <option value="fianara">fianarantsoa</option>
                    <option value="kelilalina">Kelilalina</option>
                    <option value="boston">Boston</option>
                    <option value="Vohitrandriana">Vohitrandriana</option>
                    <option value="Antananarivo">Antananarivo</option>
                    <option value="nosy varika">Nosy varika</option>
                </select>
                @if(auth()->user()->email ?? 'guest' == config('app.email') )
                @if(count($selected) > 0)
                <button class="btn btn-sm btn-danger border-0 shadow-sm " style="cursor: pointer" wire:click="deleteSelected"
                    onclick="confirm('Confirmer la suppression ?') || event.stopImmediatePropagation()">
                    Supprimer ({{ count($selected) }})
                </button>
                @endif
                @endif
            </div>
        </div>

    </div>




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
                <form wire:submit.prevent="store" class="small">
                    @csrf
                    <div class="modal-body">

                        <div class="row">

                            {{-- NOM --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Nom</label>
                                <input type="text" placeholder="Nom d'utilisateur" wire:model="nom" class="form-control form-control-sm border-0 shadow-sm">
                                @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- PRENOM --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Prénom</label>
                                <input type="text" placeholder="Prenom " wire:model="prenom" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            {{-- POSTE --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Poste</label>
                                <input type="text" placeholder="Poste" wire:model="poste" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            {{-- SERVICE --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Service</label>
                                <input type="text" placeholder="Service" wire:model="services" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            {{-- LOCALITE --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Localité</label>
                                <input type="text" placeholder="Localité" wire:model="localite" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            {{-- BUDGET --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Budget</label>
                                <input type="text" placeholder="Budget" wire:model="budget" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            {{-- AIRTEL --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Airtel</label>
                                <input type="text" placeholder="Numéro Airtel" wire:model="airtel" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            {{-- TELMA --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Telma</label>
                                <input type="text" placeholder="Numéro Telma" wire:model="telma" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            {{-- ORANGE --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Orange</label>
                                <input type="text" placeholder="Numéro Orange" wire:model="orange" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label text-muted">Email</label>
                                <input type="email" placeholder="Email" wire:model="mail" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-sm border-0 shadow-sm btn-secondary" data-bs-dismiss="modal">
                            Annuler
                        </button>
                            <button type="button" class="btn btn-sm border-0 shadow-sm btn-secondary" wire:click="resetFilters">
                                Réinitialiser

                        <button type="submit" class="btn btn-sm border-0 shadow-sm btn-primary">
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
                <form wire:submit.prevent="update" class="small">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Nom</label>
                                <input type="text" wire:model="nom" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Prénom</label>
                                <input type="text" wire:model="prenom" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Poste</label>
                                <input type="text" wire:model="poste" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Service</label>
                                <input type="text" wire:model="services" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Localité</label>
                                <input type="text" wire:model="localite" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Budget</label>
                                <input type="text" wire:model="budget" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Airtel</label>
                                <input type="text" wire:model="airtel" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Telma</label>
                                <input type="text" wire:model="telma" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Orange</label>
                                <input type="text" wire:model="orange" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label text-muted">Email</label>
                                <input type="email" wire:model="mail" class="form-control form-control-sm border-0 shadow-sm">
                            </div>

                        </div>
                    </div>

                    {{-- FOOTER --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm border-0 shadow-sm btn-secondary" data-bs-dismiss="modal">
                            Annuler
                        </button>
                        @if(auth()->user()->email ?? 'guest' == config('app.email') )
                        <button type="submit" class="btn btn-sm border-0 shadow-sm btn-warning">
                            Mettre à jour
                        </button>
                        @endif
                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class=" mt-1" style="max-height: 100vh; overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
        {{-- {{$contacts}} --}}
        <table class="table-responsive table text-muted  table-hover align-middle" wire:poll>
            <thead class="">
                <tr>
                    {{-- <th scope="col" class="bg-white">ID</th> --}}
                    @if(auth()->user()->email ?? 'guest' == config('app.email') )

                    <th class="bg-white text-nowrap"><input type="checkbox" wire:model="selectAll"></th>
                    @endif
                    <th class="bg-white text-nowrap"><i class="bi bi-person-lines-fill"></i> Nom</th>
                    <th class="bg-white text-nowrap"><i class="bi bi-person-lines-fill"></i> Prenom</th>
                    {{-- <th class="bg-white">Date Operation</th> --}}
                    <th class="bg-white text-nowrap"><i class="bi bi-briefcase-fill"></i> Poste</th>
                    <th class="bg-white text-nowrap"><i class="bi bi-building-gear"></i> Services</th>
                    <th class="bg-white text-nowrap"><i class="bi bi-geo-alt-fill"></i> localite</th>
                    <th class="bg-white text-nowrap"><i class="bi bi-currency-dollar-fill"></i> budget</th>
                    <th class="bg-white text-nowrap"><i class="bi bi-phone-fill"></i> airtel</th>
                    <th class="bg-white text-nowrap"><i class="bi bi-phone-fill"></i> Yas</th>
                    <th class="bg-white text-nowrap"><i class="bi bi-phone-fill"></i> orange</th>
                    <th class="bg-white text-nowrap"><i class="bi bi-envelope-fill"></i> email</th>

                    {{-- <th>action</th> --}}



                    {{-- <th class="bg-white text-nowrap">Date de creation</th> --}}
                    {{-- <th class="bg-white"> Date de modification</th> --}}
                </tr>
            </thead>
            <tbody style="cursor: pointer" class="small ">
                @foreach ($contacts as $contact)
                <tr>
                    @if(auth()->user()->email ?? 'guest' == config('app.email') )
                    <td class="bg-white">
                        <input type="checkbox" value="{{ $contact->id }}" wire:model="selected">
                    </td>
                    @endif

                    <td class="bg-white text-nowrap text-muted" data-bs-toggle="modal" data-bs-target="#editModal"
                        wire:click="edit({{ $contact->id }})"> <img
                            src="https://ui-avatars.com/api/?name={{ urlencode($contact->nom) }}&background=ffffff&color=212529"
                            class="rounded-circle border border-secondary-subtle bg-white"
                            style="width: 20px; height: 20px;" alt="{{ $contact->nom }}"> {{ $contact->nom }}</td>
                    <td class="bg-white text-nowrap text-muted" data-bs-toggle="modal" data-bs-target="#editModal"
                        wire:click="edit({{ $contact->id }})"><i class="bi bi-person"></i> {{ $contact->prenom }}</td>

                    <td class="bg-white text-nowrap text-muted" data-bs-toggle="modal" data-bs-target="#editModal"
                        wire:click="edit({{ $contact->id }})"><i class="bi bi-briefcase"></i> {{ $contact->poste }}</td>
                    <td class="bg-white text-nowrap text-muted" data-bs-toggle="modal" data-bs-target="#editModal"
                        wire:click="edit({{ $contact->id }})"><i class="bi bi-building-gear"></i> {{ $contact->services
                        }}</td>
                    <td class="bg-white text-nowrap text-muted" data-bs-toggle="modal" data-bs-target="#editModal"
                        wire:click="edit({{ $contact->id }})"><i class="bi bi-geo-alt"></i> {{ $contact->localite }}
                    </td>

                    <td class="bg-white text-nowrap text-muted" data-bs-toggle="modal" data-bs-target="#editModal"
                        wire:click="edit({{ $contact->id }})"><i class="bi bi-currency-dollar"></i> {{ $contact->budget
                        }}</td>

                    <td class="bg-white text-nowrap text-muted" data-bs-toggle="modal" data-bs-target="#editModal"
                        wire:click="edit({{ $contact->id }})"><img class="rounded-2 mx-1" width="20"
                            src="{{asset('/airtel.png')}}" alt="">{{ $contact->airtel }}</td>
                    <td class="bg-white text-nowrap text-muted" data-bs-toggle="modal" data-bs-target="#editModal"
                        wire:click="edit({{ $contact->id }})"><img class="rounded-2 mx-1" width="15"
                            src="{{asset('/yas.png')}}" alt="">{{ $contact->telma }}</td>
                    <td class="bg-white text-nowrap text-muted" data-bs-toggle="modal" data-bs-target="#editModal"
                        wire:click="edit({{ $contact->id }})"><img class="rounded-2 mx-1" width="20"
                            src="{{asset('/orange.png')}}" alt="">{{ $contact->orange }}</td>

                    <td class="bg-white text-nowrap text-muted" data-bs-toggle="modal" data-bs-target="#editModal"
                        wire:click="edit({{ $contact->id }})"><i class="text-danger bi bi-envelope"></i> {{
                        $contact->mail }}</td>
                    {{-- <td>
                        <button class="btn btn-sm btn-outline-warning" wire:click="edit({{ $contact->id }})"
                            data-bs-toggle="modal" data-bs-target="#editModal">
                            Modifier
                        </button>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-2 mx-2 p-2">
        <span class="fw-bold">Total :</span> {{count($contacts)?? '0'}} <span class="text-muted">Contact(s) trouvé(s)</span>
    </div>

</div>
</div>
</div>