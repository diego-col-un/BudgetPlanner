@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Encabezado y Botón de Nueva Transacción --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-3xl font-bold text-gray-800">Mis Transacciones</h1>
        <a href="{{ route('transactions.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Nueva Transacción
        </a>
    </div>

    {{-- Mostrar mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tarjeta Principal con Estilo Consistente --}}
    <div class="card shadow bg-success bg-opacity-10">
        {{-- Encabezado de la Tarjeta --}}
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-wallet2 me-2"></i>
                Total de Transacciones: {{ $transactions->total() }}
            </h5>
        </div>
        
        {{-- Cuerpo de la Tarjeta con la Tabla --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-success">
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Monto</th>
                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            {{-- Colores de Fila Dinámicos --}}
                            <tr class="{{ $transaction->transaction_type == 'income' ? 'table-success' : 'table-danger' }} bg-opacity-25">
                                <td class="fw-semibold">
                                    {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}
                                </td>
                                <td>
                                    @if($transaction->transaction_type == 'income')
                                        <span class="badge bg-success shadow-sm py-1">Ingreso</span>
                                    @else
                                        <span class="badge bg-danger shadow-sm py-1">Gasto</span>
                                    @endif
                                </td>
                                {{-- Aplicamos color del texto al Monto --}}
                                <td class="fw-bold {{ $transaction->transaction_type == 'income' ? 'text-success' : 'text-danger' }}">
                                    ${{ number_format($transaction->amount, 2) }}
                                </td>
                                <td>{{ $transaction->category->name ?? 'N/A' }}</td>
                                <td>{{ Str::limit($transaction->description, 30) }}</td>
                                <td class="d-flex gap-2">
                                    {{-- Botón Editar --}}
                                    <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-primary shadow-sm" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    
                                    {{-- Formulario para Eliminar --}}
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar la transacción de ${{ number_format($transaction->amount, 2) }}?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted bg-white">
                                    <i class="bi bi-emoji-frown me-2"></i>
                                    No hay transacciones registradas. ¡Añade una para empezar!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Paginación en el Footer de la Tarjeta --}}
        @if ($transactions->hasPages())
            <div class="card-footer bg-white pt-3 pb-1">
                <div class="d-flex justify-content-center">
                    {{ $transactions->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection