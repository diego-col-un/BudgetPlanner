@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Crear recordatorio</h3>

    <form action="{{ route('reminders.store') }}" method="POST">
        @csrf

        <label class="form-label">Título</label>
        <input type="text" name="title" class="form-control" required>

        <label class="form-label mt-2">Fecha</label>
        <input type="date" name="due_date" class="form-control" required>

        <label class="form-label mt-2">Notas</label>
        <textarea name="notes" class="form-control"></textarea>

        <button class="btn btn-success mt-3">Guardar</button>
    </form>
</div>
@endsection
