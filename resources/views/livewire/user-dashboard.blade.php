<div class="container">
    <h1>Admin Dashboard</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" wire:submit.prevent="submit" >
                <div class="modal-body">
                        <label for="">Nom de produit</label>
                        <input type="text" wire:model='name' class="form-control" placeholder="Nom de produit">
                        <label for="">Description</label>
                        <textarea name="" id="" wire:model="description" class="form-control">

                        </textarea>
                        <label for="">Prix</label>
                        <input type="number" wire:model='price' class="form-control" placeholder="Prix">
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produits as $produit)
                <tr>
                    <th scope="row">{{ $produit->id }}</th>
                    <td>{{ $produit->name }}</td>
                    <td>{{ $produit->description }}</td>
                    <td>{{ $produit->price }}</td>
                    <td>
                        <button class="btn btn-sm " wire:click="edit({{ $produit->id }})">Edit</button>
                        <button class="btn btn-sm" wire:click="delete({{ $produit->id }})">Delete</button>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function() {
        myInput.focus()
    })
</script>
