@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Determina las clases de color basadas en el tipo de transacción --}}
            @php
                $isIncome = $transaction->transaction_type == 'income';
                $cardClass = $isIncome ? 'bg-success bg-opacity-10' : 'bg-danger bg-opacity-10';
                $headerClass = $isIncome ? 'bg-success' : 'bg-danger';
            @endphp

            {{-- Tarjeta Principal con Estilo Dinámico --}}
            <div class="card shadow {{ $cardClass }}">
                <div class="card-header {{ $headerClass }} text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        {{ __('Editar Transacción') }}: 
                        <span class="fw-bold">${{ number_format($transaction->amount, 2) }}</span>
                    </h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transactions.update', $transaction) }}">
                        @csrf
                        @method('PUT') 

                        <!-- Tipo de Transacción (Deshabilitado en Edición para consistencia, o se usa para el estilo) -->
                        <div class="mb-3">
                            <label for="transaction_type" class="form-label">Tipo de Transacción</label>
                            <select class="form-select @error('transaction_type') is-invalid @enderror" id="transaction_type" name="transaction_type" required>
                                <option value="">Seleccione...</option>
                                <option value="income" {{ old('transaction_type', $transaction->transaction_type) == 'income' ? 'selected' : '' }}>Ingreso</option>
                                <option value="expense" {{ old('transaction_type', $transaction->transaction_type) == 'expense' ? 'selected' : '' }}>Gasto</option>
                            </select>
                            @error('transaction_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Monto -->
                        <div class="mb-3">
                            <label for="amount" class="form-label">Monto</label>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $transaction->amount) }}" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Categoría -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoría</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Seleccione...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ ucfirst($category->type) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fecha -->
                        <div class="mb-3">
                            <label for="transaction_date" class="form-label">Fecha</label>
                            <input type="date" class="form-control @error('transaction_date') is-invalid @enderror" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', $transaction->transaction_date) }}" required>
                            @error('transaction_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción (Opcional)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $transaction->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('transactions.index') }}" class="btn btn-secondary shadow-sm">
                                <i class="bi bi-x-circle me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary shadow-sm">
                                <i class="bi bi-save me-1"></i> Actualizar Transacción
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection