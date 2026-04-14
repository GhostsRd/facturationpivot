<div class="container bg-white shadow p-2 rounded-1 ">
    @if(auth()->user()->email  ==  config('app.email')  )
      <h4 class="fw-bold text-success mt-1">Facture telma</h4>
      <div class="row">
          <div class="col-lg-3">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                     importer 
                 </button>   

            </div>
            <div class="col-lg-5">
                    <input type="text" wire:model='recherche' class="form-control bg-white border-0 shadow-sm" placeholder="Recherccher un contact">
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
                 {{-- <tr>
                
                 <th class="bg-white text-nowrap">Numero</th>
                 <th class="bg-white text-nowrap">Utilisateur</th>
                 
                 <th class="bg-white text-nowrap">Services</th>
                 <th class="bg-white text-nowrap">Code budgetaire</th>
                 <th class="bg-white text-nowrap">GL code</th>
                 <th class="bg-white text-nowrap">Departement</th>

           
             </tr> --}}
             </thead>
                    <tbody>
            {{-- @foreach ($contacts as $contact)
                <tr>
               
                    <td class="text-nowrap">{{ $contact->num }}</td>
                    <td class="text-nowrap">{{ $contact->utilisateur }}</td>
     
                    <td class="text-nowrap">{{ $contact->services }}</td>
                    <td class="text-nowrap">{{ $contact->code_budgetaire }}</td>
                    <td class="text-nowrap">{{ $contact->gl_code }}</td>
                    <td class="text-nowrap">{{ $contact->departement }}</td>
              
                </tr>
            @endforeach --}}
        </tbody>
         </table>
      </div>
    
    <div>
      
    </div>
  
</div>
</div>
</div>

