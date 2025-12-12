@extends('layouts.app')

@section('content')
<div class="container">
  <h3>{{ $notification->data['title'] ?? 'Notificación' }}</h3>
  <p>{{ $notification->data['message'] ?? json_encode($notification->data) }}</p>
  <small class="text-muted">{{ $notification->created_at }}</small>
  <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-secondary mt-3">Volver</a>
</div>
@endsection
