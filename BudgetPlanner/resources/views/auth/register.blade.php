@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Tarjeta Principal de Registro --}}
            <div class="card shadow bg-success bg-opacity-10">
                <div class="card-header bg-success text-white">
                    <h4 class="card-title mb-0">
                        <i class="bi bi-person-plus me-2"></i>
                        {{ __('Registrarse') }}
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Campo Nombre --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">{{ __('Nombre') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        {{-- Campo Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                name="password" required autocomplete="new-password">

                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        {{-- Campo Confirmar Contraseña --}}
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-semibold">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="form-control" 
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                        {{-- Botón de Registro --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg shadow-sm">
                                <i class="bi bi-person-check me-1"></i> {{ __('Crear Cuenta') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection