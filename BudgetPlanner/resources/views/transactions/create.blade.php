@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Tarjeta Principal con Estilo Consistente --}}
            <div class="card shadow bg-success bg-opacity-10">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-plus-circle me-2"></i>
                        Registrar Nueva Transacción
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf

                        {{-- Tipo de Transacción (Ingreso/Gasto) --}}
                        <div class="mb-3">
                            <label for="transaction_type" class="form-label fw-semibold">Tipo de Transacción</label>
                            <select name="transaction_type" id="transaction_type" class="form-select @error('transaction_type') is-invalid @enderror" required>
                                <option value="">Seleccione el tipo</option>
                                <option value="income" {{ old('transaction_type') == 'income' ? 'selected' : '' }}>Ingreso</option>
                                <option value="expense" {{ old('transaction_type') == 'expense' ? 'selected' : '' }}>Gasto</option>
                            </select>
                            @error('transaction_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Categoría --}}
                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-semibold">Categoría</label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Seleccione una Categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ ucfirst($category->type) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Monto --}}
                        <div class="mb-3">
                            <label for="amount" class="form-label fw-semibold">Monto</label>
                            <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}" 
                                class="form-control @error('amount') is-invalid @enderror" 
                                required placeholder="Ej: 150.75">
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Fecha de la Transacción --}}
                        <div class="mb-3">
                            <label for="transaction_date" class="form-label fw-semibold">Fecha</label>
                            <input type="date" name="transaction_date" id="transaction_date" value="{{ old('transaction_date', now()->toDateString()) }}" 
                                class="form-control @error('transaction_date') is-invalid @enderror" 
                                required>
                            @error('transaction_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Descripción (Opcional) --}}
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Descripción (Opcional)</label>
                            <textarea name="description" id="description" rows="3" 
                                class="form-control @error('description') is-invalid @enderror" 
                                placeholder="Notas sobre esta transacción...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between pt-2">
                            <a href="{{ route('transactions.index') }}" class="btn btn-secondary shadow-sm">
                                <i class="bi bi-x-circle me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success shadow-sm">
                                <i class="bi bi-floppy me-1"></i> Guardar Transacción
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection