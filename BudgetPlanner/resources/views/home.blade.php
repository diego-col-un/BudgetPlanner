@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- Tarjeta Principal con Estilo Consistente --}}
            <div class="card shadow bg-success bg-opacity-10">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-speedometer2 me-2"></i>
                        Panel de Control
                    </h5>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        {{-- Mensaje de bienvenida de sesión (por ejemplo, después del login) --}}
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Contenido del Dashboard --}}
                    <div class="p-3">
                        <h2 class="h4 mb-3 text-success fw-bold">¡Bienvenido a Budget Planner, {{ Auth::user()->name ?? 'Usuario' }}!</h2>
                        <p class="lead">
                            Tu centro de gestión financiera personal. Desde aquí puedes:</p>
                        
                        <div class="row g-3 mt-4">
                            {{-- Tarjeta de Transacciones --}}
                            <div class="col-md-6">
                                <div class="p-3 border border-primary rounded-3 h-100 bg-white shadow-sm d-flex flex-column justify-content-between">
                                    <h5 class="fw-bold text-primary"><i class="bi bi-cash-stack me-2"></i> Transacciones</h5>
                                    <p>Revisa, edita y gestiona todos tus **ingresos** y **gastos**. Mantén un registro detallado de cada movimiento.</p>
                                    <a href="{{ route('transactions.index') }}" class="btn btn-primary btn-sm mt-2 align-self-start">Ir a Transacciones</a>
                                </div>
                            </div>
                            
                            {{-- Tarjeta de Categorías --}}
                            <div class="col-md-6">
                                <div class="p-3 border border-secondary rounded-3 h-100 bg-white shadow-sm d-flex flex-column justify-content-between">
                                    <h5 class="fw-bold text-secondary"><i class="bi bi-tags me-2"></i> Categorías</h5>
                                    <p>Organiza tus finanzas creando categorías personalizadas para Ingresos y Gastos.</p>
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm mt-2 align-self-start">Administrar Categorías</a>
                                </div>
                            </div>
                        </div>

                        <p class="mt-4 pt-3 border-top text-muted">Empieza a registrar tus movimientos o revisa tu saldo actual para tomar el control de tu dinero.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection