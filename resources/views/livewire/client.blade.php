<div class="container bg-white shadow p-2 rounded-2">

    <h4 class="fw-bold text-muted mt-1">Clients</h4>
   
    <!-- Button trigger modal -->
    <hr>
    @if(auth()->user()->email == config('app.email'))

        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Nouveau
        </button>
    @endif

    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" wire:submit.prevent="store" >
                <div class="modal-body">
                        <label for="">Nom du client</label>
                        <input type="text" wire:model='nomclient' class="form-control" placeholder="Nom de produit">
                        <label for="">numero de compte</label>
                        <input type="number" name="" id="" wire:model="num_compte" class="form-control">

                        </textarea>
                        <label for="">Solde (Ar)</label>
                        <input type="number" wire:model='solde' class="form-control" placeholder="Nouveau">
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modif modal --}}

     <div class="modal fade" wire:ignore.self id="exampleModal1"  tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modifier client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" wire:submit.prevent="update" >
                <div class="modal-body">
                        <label for="">Nom du client</label>
                        <input type="text"  value="nomclient" wire:model='nomclient' class="form-control" placeholder="Nom de produit">
                        <label for="">numero de compte</label>
                        <input type="number" name="" value="{{$id}}" id="" wire:model="num_compte" class="form-control" disabled>

                        </textarea>
                        <label for="">Solde (Ar)</label>
                        <input type="number" value="solde" wire:model='solde' class="form-control" placeholder="Nouveau" disabled>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

     <table class="table table-sm mt-2" wire:poll>
        <thead>
            <tr>
                {{-- <th scope="col" class="bg-white">#</th> --}}
                <th scope="col" class="bg-white">Numero de compte</th>
                <th scope="col" class="bg-white">Nom d'utilisateur</th>
                <th class="bg-white">Email</th>
                {{-- <th scope="col" class="bg-white">Solde (Ar)</th> --}}
                <th class="bg-white">Statut</th>
               
              
                
                
            </tr>
        </thead>
        <tbody>
        
            @foreach ($clients as $client)
                <tr>
                    {{-- <th scope="row" class="bg-white">{{ $client->num_compte }}</th> --}}
                    <td class="bg-white">{{ $client->num_compte }}</td>
                    <td class="bg-white"> 
                            <img src="https://ui-avatars.com/api/?name={{ $client->nomclient }}&background=808080&color=ffff"  class="rounded-circle" width="20" height="20">
                        {{ $client->nomclient }}</td>
                    <td class="bg-white">{{ number_format($client->solde, 0, ',', '.') }}</td>
                    <td class="bg-white"><button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal1" wire:click="edit({{ $client->num_compte }})">
                         <i class="bi bi-pencil"></i> 
                    </button>
                       @if(auth()->user()->email == config('app.email'))
                       <button class="btn btn-sm" wire:click="delete({{ $client->num_compte }})">   <i class="bi bi-trash text-danger"></i></button></td>
                       @endif
                       </td>
                       <td>Supprimer</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
