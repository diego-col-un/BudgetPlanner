@extends('layouts.app')

@section('content')

    <div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h2 class="h5 mb-0">⚙️ Personalizar Notificaciones</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('preferences.update') }}">
                        @csrf
                        @method('PUT') 
                        
                        <p class="mb-4 text-muted">Selecciona las notificaciones que deseas recibir.</p>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="email_new_post" value="1" id="checkEmailPost" 
                                    {{ $preferences->email_new_post ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkEmailPost">
                                    📧 Recibir email cuando hay un nuevo post
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="inapp_comment" value="1" id="checkInAppComment" 
                                    {{ $preferences->inapp_comment ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkInAppComment">
                                    🔔 Notificación en la aplicación por cada comentario
                                </label>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-save"></i> Guardar Cambios
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection