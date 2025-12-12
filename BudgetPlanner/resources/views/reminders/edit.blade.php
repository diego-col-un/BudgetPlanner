@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Editar recordatorio</h3>

    <form action="{{ route('reminders.update', $reminder->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Título</label>
        <input type="text" name="title" class="form-control" value="{{ $reminder->title }}" required>

        <label class="mt-2">Fecha</label>
        <input type="date" name="due_date" class="form-control" value="{{ $reminder->due_date }}" required>

        <label class="mt-2">Notas</label>
        <textarea name="notes" class="form-control">{{ $reminder->notes }}</textarea>

        <button class="btn btn-primary mt-3">Actualizar</button>
    </form>
</div>
@endsection
