@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Registrar Nueva Transacción</h1>

        {{-- Formulario que apunta al método store del controlador --}}
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            {{-- Tipo de Transacción (Ingreso/Gasto) --}}
            <div class="mb-4">
                <label for="transaction_type" class="block text-gray-700 text-sm font-semibold mb-2">Tipo de Transacción</label>
                <select name="transaction_type" id="transaction_type" class="form-select w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Seleccione el tipo</option>
                    <option value="income" {{ old('transaction_type') == 'income' ? 'selected' : '' }}>Ingreso</option>
                    <option value="expense" {{ old('transaction_type') == 'expense' ? 'selected' : '' }}>Gasto</option>
                </select>
                @error('transaction_type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Categoría (Usando las categorías globales pasadas por el controlador) --}}
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 text-sm font-semibold mb-2">Categoría</label>
                <select name="category_id" id="category_id" class="form-select w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Seleccione una Categoría</option>
                    
                    {{-- Bucle CORREGIDO que itera sobre la lista de categorías --}}
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ ucfirst($category->type) }})
                        </option>
                    @endforeach
                    
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Monto --}}
            <div class="mb-4">
                <label for="amount" class="block text-gray-700 text-sm font-semibold mb-2">Monto</label>
                <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}" 
                       class="form-input w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" 
                       required placeholder="Ej: 150.75">
                @error('amount')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Fecha de la Transacción --}}
            <div class="mb-4">
                <label for="transaction_date" class="block text-gray-700 text-sm font-semibold mb-2">Fecha</label>
                <input type="date" name="transaction_date" id="transaction_date" value="{{ old('transaction_date', now()->toDateString()) }}" 
                       class="form-input w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" 
                       required>
                @error('transaction_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción (Opcional) --}}
            <div class="mb-6">
                <label for="description" class="block text-gray-700 text-sm font-semibold mb-2">Descripción (Opcional)</label>
                <textarea name="description" id="description" rows="3" 
                          class="form-textarea w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" 
                          placeholder="Notas sobre esta transacción...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botones --}}
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Guardar Transacción
                </button>
                <a href="{{ route('transactions.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection