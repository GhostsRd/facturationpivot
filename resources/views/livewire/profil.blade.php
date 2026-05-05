<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6 ">

            <div class="card shadow border-0">

                <!-- Header profil -->
                <div class="card-header text-center text-dark fw-bold">
                    <h4 class="mb-0">Profil Utilisateur</h4>
                </div>

                <div class="card-body text-center">

                    <!-- Avatar -->
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=808080&color=ffff"  class="rounded-circle" width="60" height="60">


                    <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                    <p class="text-muted">{{ Auth::user()->email }}</p>

                    <hr>

                    <!-- Infos -->
                    <div class="row text-start">

                        {{-- <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Email</label>
                            <div class="form-control bg-light">{{ $profil->email }}</div>
                        </div> --}}

                        {{-- <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Téléphone</label>
                            <div class="form-control bg-light">{{ $profil->phone }}</div>
                        </div> --}}

                        {{-- <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Poste</label>
                            <div class="form-control bg-light">{{ $profil->poste }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Localité</label>
                            <div class="form-control bg-light"></div>
                        </div> --}}

                    </div>

                    <!-- Boutons -->
                    <div class="mt-3">
                        <button class="btn border" data-bs-toggle="modal" data-bs-target="#exampleModal1" wire:click="edit({{ $name }})">Modifier le profil</button>
                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Changer mot de passe</button>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="exampleModal1"  tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modifier profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" wire:submit.prevent="update" >
                <div class="modal-body">
                    <input type="hidden" wire:model="id" value="{{$id}}">
                        <label for="" >Nom de l'utilisateur</label>
                        <input type="text"  wire:model='name' value="{{Auth::user()->name}}" class="form-control" placeholder="Nom de produit">
                        <label for="">Email</label>
                        <input type="email" value="{{ Auth::user()->email }}"  id="" wire:model="email" class="form-control" >
                        {{-- <label for="">Ancien mot de passe</label>
                        <input type="password" id="" wire:model="current_password" class="form-control" >
                        <label for="">Nouveau mot de passe</label>
                        <input type="password" id="" wire:model="new_password" class="form-control" >
                        <label for="">Confirmer mot de passe</label>
                        <input type="password" id="" wire:model="confirm_password" class="form-control" >   
                         --}}
                        </textarea>
                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>
                    <button type="submit" class="btn border">Sauvegarder</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Changer mot de passe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" wire:submit.prevent="changePassword" >
                <div class="modal-body">
                    <input type="hidden" wire:model="id" value="{{$id}}">
                 
                        <label for="">Ancien mot de passe</label>
                        <input type="password" id="" wire:model="current_password" class="form-control" >
                        <label for="">Nouveau mot de passe</label>
                        <input type="password" id="" wire:model="new_password" class="form-control" >
                        <label for="">Confirmer mot de passe</label>
                        <input type="password" id="" wire:model="confirm_password" class="form-control" @error('confirm_password') is-invalid @enderror>   
                         @error('confirm_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </textarea>
                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>
                    <button type="submit" class="btn border">Sauvegarder</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif

    @if (session('error'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
            {{ session('error') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif

</div>
