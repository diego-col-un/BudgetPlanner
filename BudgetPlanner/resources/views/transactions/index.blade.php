@extends('layouts.app') {{-- Asume que usas el layout base de Laravel --}}

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Mis Transacciones</h1>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">Nueva Transacción</a>
    </div>

    {{-- Mostrar mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
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
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</td>
                            <td>
                                @if($transaction->transaction_type == 'income')
                                    <span class="badge bg-success">Ingreso</span>
                                @else
                                    <span class="badge bg-danger">Gasto</span>
                                @endif
                            </td>
                            <td>${{ number_format($transaction->amount, 2) }}</td>
                            <td>{{ $transaction->category->name ?? 'N/A' }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>
                                <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-warning">Editar</a>
                                
                                <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar esta transacción?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay transacciones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection