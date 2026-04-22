<div class="container bg-white shadow p-2 rounded-1 ">
    @if(auth()->user()->email ?? 'guest' == config('app.email') )
    <h4 class="fw-bold text-muted mt-1">Facture Airtel</h4>
    <div class="row">
        <div class="col-lg-4 ">


            <form wire:submit.prevent="import" class="row">
                @csrf
                <div class="row">

                    <div class="col-lg-10">

                        <input type="file" wire:model="file" class="form-control form-control-sm border-0 shadow-sm">

                        @error('file')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn  btn-sm btn-primary border-0">
                           
                            <span wire:loading.remove wire:target="import">
                            Importer
                        </span>

                            <span wire:loading wire:target="import">
                            Chargement...
                        </span>
                        </button>

                    </div>
                </div>

            </form>
        </div>
        <div class="col-lg-3">
            <input type="text" wire:model='recherche' class="form-control bg-white border-0 shadow-sm"
                placeholder="Rechercher un contact">
        </div>
        <div class="col-lg-5 justify-content-end d-flex">
            <div class="d-flex gap-2">

                {{-- Mois --}}
                <select wire:model="mois" class="form-control-sm border-0 shadow-sm">
                    <option value="">Mois</option>
                    <option value="1">Janvier</option>
                    <option value="2">Février</option>
                    <option value="3">Mars</option>
                    <option value="4">Avril</option>
                    <option value="5">Mai</option>
                    <option value="6">Juin</option>
                    <option value="7">Juillet</option>
                    <option value="8">Août</option>
                    <option value="9">Septembre</option>
                    <option value="10">Octobre</option>
                    <option value="11">Novembre</option>
                    <option value="12">Décembre</option>
                </select>

                {{-- Année --}}
                <select wire:model="annee" class="form-control-sm border-0 shadow-sm">
                    <option value="">Année</option>

                    @foreach ($annees as $annee)
                    @if($annee == date('Y'))
                    <option class="bg-primary text-white" value="{{ $annee }}">{{ $annee }}</option>
                    @else
                    <option value="{{ $annee }}">{{ $annee }}</option>

                    @endif

                    @endforeach
                </select>

              
                <div>
                    @if (!empty($annee) and !empty($mois))

                    <button class="btn btn-sm btn-warning border-0 shadow-sm"
                        wire:click="calculFacture({{ $annee }}, {{ $mois }}, '{{ $Facture_telma }}')"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="calculFacture">
                            Calculer facture
                        </span>

                        <span wire:loading wire:target="calculFacture">
                            Chargement...
                        </span>
                    </button>
                    @endif
                </div>
                @if(count($selected) > 0)
                <button wire:click="deleteSelected" class="btn btn-sm border-0 shadow-sm btn-danger"
                    onclick="confirm('Confirmer la suppression ?') || event.stopImmediatePropagation()">
                    Supprimer (
                    {{ count($selected) }} )
                    @endif
                </button>

            </div>
        </div>
    </div>
    @else

    @endif



    <div class="modal fade " wire:ignore.self id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau facture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" wire:submit.prevent="store">
                    @csrf
                    <div class="modal-body">
                        <label for="">Nom du client</label>
                        <input type="text" class="form-control" placeholder="Nom de produit">
                        <label for="">numero de compte</label>
                        <input type="number" name="" id="" class="form-control">

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

    <div class="table-responsive mt-2"
        style="max-height: 100vh; overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
        {{-- {{$factures}} --}}
        <table class="table text-muted  table-hover align-middle" wire:poll>
            <thead>
                <tr>
                    <th class="bg-white text-nowrap">
                        <input type="checkbox" wire:model="selectAll">
                    </th>
                    <th class="bg-white text-nowrap">N_DOSSIER</th>
                    <th class="bg-white text-nowrap">MSISDN</th>
                    <th class="bg-white text-nowrap">N_facture</th>
                    <th class="bg-white text-nowrap">MONTANT_HT</th>
                    <th class="bg-white text-nowrap">DROIT_ACCISE</th>
                    <th class="bg-white text-nowrap">TVA</th>
                    <th class="bg-white text-nowrap">MONTANT_TTC</th>
                    <th class="bg-white text-nowrap">REMISE</th>
                    <th class="bg-white text-nowrap">TOTAL_ PAYER</th>
                    <th class="bg-white text-nowrap">Date</th>
                </tr>
            <tbody class="text-muted small">
                    @forelse($factures as $facture)
                    <tr>
                        <td> <input type="checkbox" value="{{ $facture->id }}" wire:model="selected"></td>
                        <td>{{ $facture->N_DOSSIER }}</td>
                        <td>{{ $facture->MSISDN }}</td>
                        <td>{{ $facture->N_facture }}</td>
                        {{-- <td>{{ $facture->Facture_AIRTEL }}</td> --}}
                        <td>{{ $facture->MONTANT_HT }}</td>
                        <td>{{ $facture->DROIT_ACCISE }}</td>
                        <td>{{ $facture->TVA }}</td>
                        <td>{{ $facture->MONTANT_TTC }}</td>
                        <td>{{ $facture->REMISE }}</td>
                        <td>{{ $facture->TOTAL_PAYER }}</td>
                        <td>{{ $facture->Date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">
                            Aucune facture trouvée
                        </td>
                    </tr>
                @endforelse
            </tbody>
         
        </table>
        <div>

        </div>
    </div>


    <div>

    </div>

</div>
</div>
</div>

<script>
    window.addEventListener('reload-after-download', event => {
        setTimeout(() => {
            window.location.reload();
        }, 2000); // 3 secondes
    });
</script>