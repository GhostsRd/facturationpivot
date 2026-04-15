<div class="container bg-white shadow p-2 rounded-1 ">
    @if(auth()->user()->email  ==  config('app.email')  )
      <h4 class="fw-bold text-muted mt-1">Listes des contacts</h4>
      <div class="row">
          <div class="col-lg-3">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                     Nouveau
                 </button>   

            </div>
            <div class="col-lg-5">
                    <input type="text" wire:model='recherche' class="form-control bg-white border-0 shadow-sm" placeholder="Recherccher un contact">
            </div>
            <div class="col-lg-1 ">
                <select name="" wire:model='recherche' id="" class="form-control-sm border-0">
                    
                    <option value="service">Service</option>
                    <option value="it">IT</option>
                    <option value="RH">RH</option>
                    <option value="SG">SG</option>
                    <option value="mouvement">mouvement</option>
                    <option value="entrepot">entrepot</option>
                    <option value="soin">Soin primaire</option>
                </select>
            </div>
            <div class="col-lg-1">
                <select name="" wire:model='recherche' id="" class="form-control-sm border-0">
                    <option value="ranomafana">Ranomafana</option>
                    <option value="fianara">fianarantsoa</option>
                    <option value="kelilalina">Kelilalina</option>
                    <option value="boston">Boston</option>
                    <option value="Vohitrandriana">Vohitrandriana</option>
                    <option value="Antananarivo">Antananarivo</option>
                    <option value="nosy varika">Nosy varika</option>
                </select>
            </div>
        </div>
      @else
      <h4 class="fw-bold text-muted mt-1">Historique versement</h4>
          
      @endif
      <hr>


       <div class="modal fade" wire:ignore.self id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" wire:submit.prevent="store" >
                <div class="modal-body">
                        <label for="">Nom du client</label>
                        <input type="text"  class="form-control" placeholder="Nom de produit">
                        <label for="">numero de compte</label>
                        <input type="number" name="" id=""  class="form-control">

                        </textarea>
                        <label for="">Solde (Ar)</label>
                        <input type="number" class="form-control" placeholder="Nouveau">
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

      <div class="table-responsive" style="max-height: 100vh; overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;" >
        {{-- {{$contacts}} --}}
          <table class="table text-muted  table-hover align-middle" wire:poll >
             <thead class="">
                 <tr>
                 {{-- <th scope="col" class="bg-white">ID</th> --}}
                 <th></th>
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



                 {{-- <th class="bg-white text-nowrap">Date de creation</th> --}}
                 {{-- <th class="bg-white"> Date de modification</th> --}}
             </tr>
             </thead>
                    <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td class="text-nowrap">
                        <input type="checkbox">
                    </td>

                    <td class="text-nowrap">{{ $contact->nom }}</td>
                    <td class="text-nowrap">{{ $contact->prenom }}</td>

                    <td class="text-nowrap">{{ $contact->poste }}</td>
                    <td class="text-nowrap">{{ $contact->services }}</td>
                    <td class="text-nowrap">{{ $contact->localite }}</td>

                    <td class="text-nowrap">{{ $contact->budget }}</td>

                    <td class="text-nowrap">{{ $contact->airtel }}</td>
                    <td class="text-nowrap">{{ $contact->telma }}</td>
                    <td class="text-nowrap">{{ $contact->orange }}</td>

                    <td class="text-nowrap">{{ $contact->mail }}</td>
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

