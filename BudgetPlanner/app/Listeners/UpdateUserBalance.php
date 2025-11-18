<?php

namespace App\Listeners;

use App\Events\TransactionCreated;
use App\Events\TransactionUpdated;
use App\Events\TransactionDeleted;
use Illuminate\Contracts\Queue\ShouldQueue; // Opcional: para que se ejecute en segundo plano
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class UpdateUserBalance
{
    /**
     * Handle the event.
     */
    public function handle(TransactionCreated|TransactionUpdated|TransactionDeleted $event): void
    {
        // Obtenemos el usuario del evento
        $user = $event instanceof TransactionDeleted ? $event->user : $event->transaction->user;

        // Lógica de recalculo (la forma más simple):
        // 1. Suma todos los ingresos
        $totalIncome = $user->transactions()->where('transaction_type', 'income')->sum('amount');
        
        // 2. Suma todos los gastos
        $totalExpense = $user->transactions()->where('transaction_type', 'expense')->sum('amount');

        // 3. Calcula el balance y actualiza al usuario
        // (Asume que tienes una columna 'balance' en tu tabla 'users')
        // $user->balance = $totalIncome - $totalExpense;
        // $user->save();

        // --- ¡IMPLEMENTA TU LÓGICA DE BALANCE AQUÍ! ---
        // Por ahora, solo loguearemos que funcionó
        \Log::info("Recalculando balance para el usuario: {$user->id}");
    }
}