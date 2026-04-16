@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-6 offset-1">
            <div class="card mt-5 col-lg-8 border-0 shadow-sm bg-white">
                <div class="card-header border-0 fw-bold"><i class="bi bi-person-fill border rounded-pill px-2 py-1"></i>  {{ __('Se connecter') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 ">
                            
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end"><i class="text-danger bi bi-envelope"></i>{{ __('Adresse e-mail') }}</label> --}}

                            <div class="">
                                <input id="email" type="email" placeholder="E-mail" class="form-control col-lg-8 border-0 shadow-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" placeholder="Mot de passe" type="password" class="form-control border-0 shadow-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 ">
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label " for="remember">
                                        {{ __('Se souvenir de moi?') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-3 justify-content-center row">
                                <button type="submit" class="btn btn-primary  btn-sm border-0 shadow-sm">
                                    {{ __('Se connecter') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link " href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
