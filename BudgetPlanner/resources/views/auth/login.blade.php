@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Tarjeta Principal de Login --}}
            <div class="card shadow bg-success bg-opacity-10">
                <div class="card-header bg-success text-white">
                    <h4 class="card-title mb-0">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        {{ __('Inicio de Sesión') }}
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Campo Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        {{-- Campo Contraseña --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                name="password" required autocomplete="current-password">

                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        {{-- Checkbox Recordarme --}}
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Recordarme') }}
                            </label>
                        </div>

                        {{-- Botón de Login y Enlace de Olvidó Contraseña --}}
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <button type="submit" class="btn btn-success shadow-sm">
                                <i class="bi bi-lock me-1"></i> {{ __('Iniciar Sesión') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-muted" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu Contraseña?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection