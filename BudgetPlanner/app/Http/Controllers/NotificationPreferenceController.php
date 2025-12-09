<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationPreference;

class NotificationPreferenceController extends Controller
{
    public function edit()
    {
        // Carga las preferencias del usuario actual o crea un nuevo registro si no existe
        $preferences = Auth::user()->preferences()->firstOrCreate();
        
        return view('preferences.notification-preferences', compact('preferences'));
    }

    public function update(Request $request)
    {
        // 1. Validar los datos de entrada
        $validated = $request->validate([
            'email_new_post' => 'nullable|boolean',
            'inapp_comment' => 'nullable|boolean',
            'email_weekly_summary' => 'nullable|boolean',
        ]);
        
        // 2. Obtener y actualizar las preferencias
        Auth::user()->preferences()->updateOrCreate(
            ['user_id' => Auth::id()], // Criterio para encontrar (o crear)
            $validated // Datos a actualizar
        );

        return redirect()->route('preferences.edit')->with('status', 'Preferencias actualizadas con éxito!');
    }
}
