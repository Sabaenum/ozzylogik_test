@extends('layouts.app')

@section('content')
<div class="container position-relative">
    <div class="row justify-content-center shadow-above">
        <div class="login-form">
            <div class="card login-forms">
                <div class="login-header text-center">{{ __('Login') }}</div>

                <div class="login-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="font-size-12 font-text-grey">{{ __('Email:') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control login-fonts @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="font-size-12 font-text-grey">{{ __('Password:') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input login-fonts" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label font-size-12 font-text-grey" for="remember">
                                        {{ __('Remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="form-group d-flex flex-column">
                                <button type="submit" class="btn background-custom-primary-400 text-light login-button">
                                    {{ __('Login') }}
                                </button>
                                <a href="{{ route('register') }}" class="btn background-custom-green-400 text-light login-button">
                                    {{ __('Register') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
