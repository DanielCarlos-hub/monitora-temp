@extends('layouts.login', ['title' => 'Freezolar Refrigeração - Cliente - Login'])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center pt-lg-5">
        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card" style="background-color: white;">
                <div class="card-header">{{ __('Autenticação') }}</div>
                <div class="card-body">
                    @if (session('erro'))
                        <div class="alert alert-danger text-center" role="alert" style="width: 80%; margin-right: auto; margin-left: auto;">
                            {{ session('erro') }}
                        </div>
                    @endif
                    @error('active')
                        <div class="alert alert-danger text-center" role="alert" style="width: 80%; margin-right: auto; margin-left: auto;">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <form method="POST" action="{{ route('auth.cliente.login.submit', request()->tenant) }}">
                        @csrf
                        <div class="row text-center">
                            <div class="col-12 col-md-12 col-lg-12 p-0 pt-3 pb-5 pr-4">
                                <img src="/storage/site/logo/{{SiteConfig::logo()}}" width="250" height="92" style="padding: 10px;">
                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <h5 class="card-title text-primary">Acesse sua conta</h5>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group row justify-content-center pb-2">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <input id="login" type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('username') ?: old('email') }}" required autofocus placeholder="Email ou Nome de Usuário">

                                        @if ($errors->has('username') || $errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row justify-content-center">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Senha">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row justify-content-center">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Lembrar') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-center mb-0">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            {{ __('Entrar') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Esqueceu a senha?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
