<?php

namespace App\Listeners;

use App\Events\TransactionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class CheckForAlerts
{
    /**
     * Handle the event.
     */
    public function handle(TransactionCreated $event): void
    {
        // Este listener solo nos importa si se creó un GASTO
        if ($event->transaction->transaction_type == 'expense') {
            
            $user = $event->transaction->user;

            $totalIncome = $user->transactions()->where('transaction_type', 'income')->sum('amount');
            $totalExpense = $user->transactions()->where('transaction_type', 'expense')->sum('amount');

            // Flujo A3: Gasto supera Ingreso
            if ($totalExpense > $totalIncome) {
                // --- INICIA CU-15 (Generar Alerta) ---
                
                // Ejemplo: Enviar una notificación, un email, etc.
                \Log::warning("¡Alerta de Gasto! Usuario {$user->id} ha gastado más de lo que tiene.");
                
                // (Aquí iría tu lógica de Notificación de Laravel)
                // $user->notify(new SpendingAlertNotification($totalExpense, $totalIncome));
            }
        }
    }
}