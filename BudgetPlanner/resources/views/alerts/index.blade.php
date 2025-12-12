@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Mis alertas</h3>
  </div>

  @if($alerts->isEmpty())
    <div class="card">
      <div class="card-body text-center">
        <p class="mb-0">No tienes alertas por ahora 🎉</p>
      </div>
    </div>
  @else
    @foreach ($alerts as $alert)
      <div class="card mb-3 {{ $alert->read ? '' : 'border-warning' }}">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <h5 class="card-title mb-1">{{ $alert->title }}</h5>
              <p class="card-text mb-1">{{ $alert->message }}</p>
              @if($alert->meta)
                <small class="text-muted">Detalles: {{ json_encode($alert->meta) }}</small>
              @endif
            </div>

            <div class="text-end">
              <small class="text-muted d-block mb-2">{{ $alert->created_at->diffForHumans() }}</small>

              @if(! $alert->read)
                <form action="{{ route('alerts.read', $alert->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('PATCH')
                  <button class="btn btn-sm btn-success">Marcar leída</button>
                </form>
              @else
                <span class="badge bg-secondary">Leída</span>
              @endif
            </div>
          </div>
        </div>
      </div>
    @endforeach
  @endif
</div>
@endsection
