<div class="container bg-white shadow p-2 rounded-2">

    <h4 class="text-muted fw-bold mt-1">Versements</h4>
    <hr>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Nouveau
    </button>



    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau virement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="" wire:submit.prevent="store">
                    <div class="modal-body">
                        <label for="">Numero de cheque</label>
                        <input type="number" wire:model='num_cheque' class="form-control"
                            placeholder="Numero de cheque">
                        <label for="">numero de compte</label>
                        <input type="number" name="" id="" wire:model="num_compte" class="form-control {{ $current_user == null ? 'border border-danger' : 'border border-success'  }}">
                        <button type="button" wire:click="verifier_compte " class=" mr-2 mt-2 btn btn-sm btn-outline-secondary ">Verifier numero de compte</button>
                        <span class=" mt-1 {{ $current_user == null ? 'd-none' : 'd-block'  }}" >
                            -------------------------------------------------------
                            <br>
                             Client : <span class="fw-bold">{{$current_user->nomclient ?? null}} </span>
                             <br>
                            -------------------------------------------------------
                            </span>
                           @if($current_user)

                           <label for="">Montant (Ar)</label>
                           <input type="number" name="" id="" wire:model="montant" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            
                            @else

                            
                            @endif
                            
                        </div>


                </form>
            </div>
        </div>
    </div>


    <div class="modal fade " wire:ignore.self id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel11" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier un versement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="" wire:submit.prevent="update">
                    <div class="modal-body">
                        <label for="">Numero de cheque</label>
                        <input type="hidden" value="{{$num_versement}}">
                        <input type="number" value="{{$num_cheque}}"  class="form-control"
                            placeholder="Numero de cheque" disabled>
                        <label for="">numero de compte</label>
                        <input type="number" name="" value="{{$num_compte}}" id=""  class="form-control {{ $current_user == null ? 'border border-danger' : 'border border-success'  }}" disabled>
                        <span class=" mt-1 " >
                            -------------------------------------------------------
                            <br>
                             Client : <span class="fw-bold">{{$current_user->nomclient ?? null}} </span>
                             <br>
                            -------------------------------------------------------
                            </span>
                            <br>
                            <label for="">Montant (Ar)</label>
                            <input type="number" name="" value="{{$montant}}" id="" wire:model="montant" class="form-control my-2" disabled>
                           <label for="">Type d'operation</label>
                            <select name="" id="" wire:model='operation' class="form-control">
                                <option value="">Selectionner</option>
                                <option value="exces">Excès de</option>
                                <option value="manque">Manque de</option>
                                <option value="erreur">Versement par erreur <span class="text-danger">(Annulation)</span></option>

                            </select>

                            <br>
                            <label for=""> montant en (Ar)</label>
                             <input type="number" name="" id="" wire:model="new_montant" class="form-control my-2" >
                          
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            
                      
                        </div>


                </form>
            </div>
        </div>
    </div>
    <table class="table bg-white table-sm">
        <thead>
            <tr>
                <th class="bg-white" scope="col">Client</th>
                <th class="bg-white" scope="col">N° versement</th>
                <th class="bg-white" scope="col">N° cheque</th>
                <th class="bg-white" scope="col">N° compte</th>
                <th class="bg-white" scope="col">Montant (Ar)</th>
                <th class="bg-white ">Action</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($versements as $versement)
            <tr>
                <td class="bg-white">
                    @foreach ($clients as $client)
                        @if ($client->num_compte == $versement->num_compte)
                            <img src="https://ui-avatars.com/api/?name={{ $client->nomclient }}&background=808080&color=ffff"  class="rounded-circle" width="20" height="20">
                        {{ $client->nomclient }}
                        @endif

                    @endforeach
                </td>
                <td class="bg-white">{{ $versement->num_versement }}</td>
                <td class="bg-white">{{ $versement->num_cheque }}</td>
                <td class="bg-white">
                                    {{ trim(chunk_split($versement->num_compte, 4, ' ')) }}

                </td>
                <td class="bg-white">
                    + {{ number_format($versement->montant , 0, ',', ' ') }}
                </td>

                <td class="bg-white"><button class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#exampleModal1"  wire:click="edit({{ $versement->num_versement }})">
                    <i class="bi bi-pencil"></i> 
                </button>
                    <button class="btn btn-sm" wire:click="delete({{ $versement->num_versement }})">
                        <i class="bi bi-trash text-danger"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>