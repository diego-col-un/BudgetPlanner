@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Tarjeta Principal de Restablecimiento --}}
            <div class="card shadow bg-success bg-opacity-10">
                <div class="card-header bg-success text-white">
                    <h4 class="card-title mb-0">
                        <i class="bi bi-key me-2"></i>
                        {{ __('Restablecer Contraseña') }}
                    </h4>
                </div>

                <div class="card-body">
                    {{-- Manejo de Errores de Validación (reemplaza <x-auth-validation-errors>) --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Token de Restablecimiento (oculto) -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        {{-- Campo Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control" name="email" 
                                value="{{ old('email', $request->email) }}" required autofocus>
                        </div>

                        {{-- Campo Nueva Contraseña --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">{{ __('Nueva Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                name="password" required>
                            
                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        {{-- Campo Confirmar Contraseña --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">{{ __('Confirmar Nueva Contraseña') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" 
                                name="password_confirmation" required>
                        </div>

                        {{-- Botón de Enviar --}}
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success shadow-sm">
                                <i class="bi bi-arrow-repeat me-1"></i> {{ __('Restablecer Contraseña') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection