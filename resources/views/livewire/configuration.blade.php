<div class="container bg-white shadow p-2 rounded-2">

    <h4 class=" text-muted mt-1" style="font-family: 'UnifrakturCook';font-size: 20px;color: #111;">Paramètres</h4>

    <!-- Button trigger modal -->

    {{-- modif modal --}}

    <div class="modal fade" wire:ignore.self id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modifier client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" wire:submit.prevent="update">
                    <div class="modal-body">
                        <input type="hidden" wire:model="id" value="{{$id}}">
                        <label for="" value="{{$name}}">Nom de l'utilisateur</label>
                        <input type="text" wire:model='name' class="form-control" placeholder="Nom de produit">
                        <label for="">Email</label>
                        <input type="email" value="{{$email}}" id="" wire:model="email" class="form-control">

                        </textarea>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table table-sm small mt-2" wire:poll>
          <colgroup>
                            <col style="width: 30%">
                            <col style="width: 40%">
                            <col style="width: 10%">
                            <col style="width: 5%">
                            <col style="width: 5%">

                        </colgroup>
        <thead>
            <tr>
                {{-- <th scope="col" class="bg-white">#</th> --}}

                <th scope="col" class="bg-white text-muted">Nom d'utilisateur</th>
                <th class="bg-white text-muted">Email</th>
                <th class="bg-white text-muted">Verifier le</th>
                {{-- <th scope="col" class="bg-white">Solde (Ar)</th> --}}
                <th class="bg-white text-muted">Status</th>
                <th class="bg-white text-muted  text-end">Action</th>



            </tr>
        </thead>
        <tbody class="">


            @foreach ($clients as $client)
            <tr>
                {{-- <th scope="row" class="bg-white">{{ $client->num_compte }}</th> --}}

                <td class="text-muted">
                    <img src="https://ui-avatars.com/api/?name={{ $client->name }}&background=808080&color=ffff"
                        class="rounded-circle" width="20" height="20">
                    {{ $client->name }}
                </td>
                <td class="text-muted">{{ $client->email }}</td>
                <td class="text-muted">{{ $client->email_verified_at?->format('d M Y H:i:s') ?? 'False' }}</td>
                <td class="text-muted">
                    <div class="form-check form-switch">
                        <input wire:click="toggle({{$client->id}})" class="form-check-input " type="checkbox"
                            id="switch1"
                            {{ $client->email_verified_at ? 'checked' : '' }}>
                            
                    </div>
                </td>
                <td class="justify-content-end text-end text-muted">
                    <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal1"
                        wire:click="edit({{ $client->id }})">
                        <i class="bi bi-pencil"></i>
                        <button class="btn btn-sm" wire:click="delete({{ $client->id }})">
                            <i class="bi bi-trash"></i>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('livewire:init', () => {
    Livewire.on('saved', () => {
        alert('Enregistré avec succès !');
    });
      
});
</script>