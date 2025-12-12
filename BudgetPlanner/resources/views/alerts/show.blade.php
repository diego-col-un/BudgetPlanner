@extends('layouts.app')

@section('content')
<div class="container">
  <h3>{{ $alert->title }}</h3>
  <p>{{ $alert->message }}</p>
  <pre>{{ json_encode($alert->meta, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
  <a href="{{ route('alerts.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
