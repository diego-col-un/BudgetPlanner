@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Mis recordatorios</h3>

    <a href="{{ route('reminders.create') }}" class="btn btn-success mb-3">Crear recordatorio</a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Título</th>
                <th>Fecha</th>
                <th>Notas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reminders as $reminder)
            <tr>
                <td>{{ $reminder->title }}</td>
                <td>{{ $reminder->due_date }}</td>
                <td>{{ $reminder->notes }}</td>
                <td>
                    <a href="{{ route('reminders.edit', $reminder->id) }}" class="btn btn-primary btn-sm">Editar</a>

                    <form action="{{ route('reminders.destroy', $reminder->id) }}" 
                          method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
