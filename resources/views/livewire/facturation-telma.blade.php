<div class="container bg-white shadow p-2 rounded-1 ">
    @if(auth()->user()->email == config('app.email') )
    <h4 class="fw-bold text-success mt-1">Facture telma</h4>
    <div class="row">
        <div class="col-lg-3 ">


            <form wire:submit.prevent="import" class="space-y-3">

                <input type="file" wire:model="file" class="form-control">

                @error('file')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <button type="submit" class="btn mt-1 btn-sm btn-success">
                    Importer
                </button>
            </form>
        </div>
        <div class="col-lg-8">
            <div class="d-flex gap-2">

                {{-- Mois --}}
                <select wire:model="mois" class="form-select">
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
                <select wire:model="annee" class="form-select">
                    <option value="">Année</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </select>

                <select wire:model="Facture_telma" class="form-select">
                    <option value="">-- Toutes les factures --</option>

                    @foreach($filtrefactures as $f)
                    <option value="{{ $f->Facture_telma }}">
                        {{ $f->Facture_telma }}
                    </option>
                    @endforeach
                </select>
                <div>
                    @if (!empty($annee) and !empty($mois) and !empty($Facture_telma))

                    <button class="btn btn-sm btn-warning" wire:click="calculFacture({{ $annee }}, {{ $mois }}, '{{ $Facture_telma }}')">Calculer facture</button>
                    @endif
                </div>

               
                    @if(count($selected) > 0)
                    <button wire:click="deleteSelected" class="btn btn-danger"
                    onclick="confirm('Confirmer la suppression ?') || event.stopImmediatePropagation()">
                    Supprimer (
                        {{ count($selected) }}  )
                        @endif 
                </button>

            </div>
        </div>
    </div>
    @else

    @endif
    <hr>


    <div class="modal fade" wire:ignore.self id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau facture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" wire:submit.prevent="store">
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

    <div class="table-responsive"
        style="max-height: 100vh; overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
        {{-- {{$factures}} --}}
        <table class="table text-muted  table-hover align-middle" wire:poll>
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" wire:model="selectAll">
                    </th>
                    <th class="bg-white text-nowrap">Nom de compte</th>
                    <th class="bg-white text-nowrap">Compte</th>
                    <th class="bg-white text-nowrap">Profil de facturation</th>
                    <th class="bg-white text-nowrap">Facture TELMA</th>
                    <th class="bg-white text-nowrap">MSISDN</th>
                    <th class="bg-white text-nowrap">Abonnement</th>
                    <th class="bg-white text-nowrap">Montant HT</th>
                    <th class="bg-white text-nowrap">Droit d'accises</th>
                    <th class="bg-white text-nowrap">TVA / TMP</th>
                    <th class="bg-white text-nowrap">Montant TTC</th>
                    <th class="bg-white text-nowrap">Date</th>
                </tr>
            <tbody>
                @forelse ($factures as $facture)
                <tr>
                    <td>
                        <input type="checkbox" value="{{ $facture->id }}" wire:model="selected">
                    </td>
                    <td class="text-nowrap">{{ $facture->NOM_DE_COMPTE }}</td>
                    <td class="text-nowrap">{{ $facture->Compte }}</td>
                    <td class="text-nowrap">{{ $facture->Profil_de_facturation }}</td>
                    <td class="text-nowrap">{{ $facture->Facture_TELMA }}</td>
                    <td class="text-nowrap">{{ $facture->msisdn }}</td>
                    <td class="text-nowrap">{{ $facture->Abonnement }}</td>
                    <td class="text-nowrap">{{ $facture->Montant_HT }}</td>
                    <td class="text-nowrap">{{ $facture->Droit_d_accises }}</td>
                    <td class="text-nowrap">{{ $facture->TVA_TMP }}</td>
                    <td class="text-nowrap">{{ $facture->Montant_TTC }}</td>
                    <td class="text-nowrap">
                        {{$facture->Date}}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center text-muted">
                        Aucune donnée disponible
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{$factures->links()}}
        </div>
    </div>

    
    <div>
        
    </div>

</div>
</div>
</div>