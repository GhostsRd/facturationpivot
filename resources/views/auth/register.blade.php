@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row  justify-content-center">
        <div class="col-md-4 mt-5 border-0">
            <div class="card  bg-white border-0 shadow-sm">
                <div class="card-header border-0 fw-bold"><i class="bi bi-person-fill shadow-sm  rounded-pill px-2 py-1"></i> {{ __('Creer un compte') }}</div>

                <div class="card-body ">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            {{-- <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom d\'utilisateur') }}</label> --}}

                            <div class="">  
                                <input id="name" type="text" placeholder="Nom d'utilisateur" class="col-lg-12 form-control border-0 shadow-sm  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Adresse e-mail') }}</label> --}}

                            <div class="">
                                <input id="email" type="email" placeholder="Adresse e-mail" class="col-lg-8 form-control border-0 shadow-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label> --}}

                            <div class="">
                                <input id="password" type="password" placeholder="Mot de passe" class="col-lg-8 form-control border-0 shadow-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmer le mot de passe') }}</label> --}}

                            <div class="">
                                <input id="password-confirm" type="password" placeholder="Confirmer le mot de passe" class="col-lg-8 form-control border-0 shadow-sm" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-10 offset-md-4 justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm border-0 shadow-sm">
                                    {{ __('Creer un compte') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
