<div class="container bg-white shadow p-2 rounded-1 ">
    @if(auth()->user()->email == config('app.email') )
    <h4 class="fw-bold text-muted mt-1">Facture telma</h4>
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
                            Importer
                        </button>
    
                    </div>
                </div>

            </form>
        </div>
        <div class="col-lg-8 justify-content-end d-flex">
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
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </select>

                <select wire:model="Facture_telma" class="form-control-sm border-0 shadow-sm">
                    <option value="">-- Toutes les factures --</option>

                    @foreach($filtrefactures as $f)
                    <option value="{{ $f->Facture_telma }}">
                        {{ $f->Facture_telma }}
                    </option>
                    @endforeach
                </select>
                <div>
                    @if (!empty($annee) and !empty($mois) and !empty($Facture_telma))

                    <button class="btn btn-sm btn-warning"
                        wire:click="calculFacture({{ $annee }}, {{ $mois }}, '{{ $Facture_telma }}')">Calculer
                        facture</button>
                    @endif
                </div>


                @if(count($selected) > 0)
                <button wire:click="deleteSelected" class="btn btn-danger"
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
            <tbody class="text-muted">
                @forelse ($factures as $facture)
                <tr>
                    <td class="bg-white text-nowrap">
                        <input type="checkbox" value="{{ $facture->id }}" wire:model="selected">
                    </td>
                    <td class="bg-white text-nowrap text-muted"> {{ $facture->NOM_DE_COMPTE }}</td>
                    <td class="bg-white text-nowrap text-muted">{{ $facture->Compte }}</td>
                    <td class="bg-white text-nowrap text-muted">{{ $facture->Profil_de_facturation }}</td>
                    <td class="bg-white text-nowrap text-muted">{{ $facture->Facture_TELMA }}</td>
                    <td class="bg-white text-nowrap text-muted">{{ $facture->msisdn }}</td>
                    <td class="bg-white text-nowrap text-muted">{{ $facture->Abonnement }}</td>
                    <td class="bg-white text-nowrap text-muted">{{ $facture->Montant_HT }}</td>
                    <td class="bg-white text-nowrap text-muted">{{ $facture->Droit_d_accises }}</td>
                    <td class="bg-white text-nowrap text-muted">{{number_format($facture->TVA_TMP, 0, ',', ' ') }}</td>
                    <td class="bg-white text-nowrap fw-bold">{{number_format($facture->Montant_TTC, 0, ',', ' ') }}</td>
                    <td class="bg-white text-nowrap">
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