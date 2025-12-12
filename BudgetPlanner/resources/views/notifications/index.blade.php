@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Notificaciones</h3>

  @foreach($notifications as $n)
    <div class="card mb-2 {{ $n->read_at ? '' : 'border-warning' }}">
      <div class="card-body">
        <h5>{{ $n->data['title'] ?? class_basename($n->type) }}</h5>
        <p>{{ $n->data['message'] ?? ($n->data['text'] ?? '') }}</p>
        <small class="text-muted">{{ $n->created_at->diffForHumans() }}</small>

        <div class="mt-2">
          <a href="{{ route('notifications.show', $n->id) }}" class="btn btn-sm btn-primary">Ver</a>

          @if(!$n->read_at)
            <form action="{{ route('notifications.markRead', $n->id) }}" method="POST" style="display:inline-block">
              @csrf
              <button class="btn btn-sm btn-secondary">Marcar leída</button>
            </form>
          @endif
        </div>
      </div>
    </div>
  @endforeach

  {{ $notifications->links() }}
</div>
@endsection
