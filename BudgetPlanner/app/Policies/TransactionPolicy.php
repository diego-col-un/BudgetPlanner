<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{
    /**
     * Determina si el usuario puede ver la transacción. (Lo usamos en 'edit')
     */
    public function view(User $user, Transaction $transaction): bool
    {
        return $user->id === $transaction->user_id;
    }

    /**
     * Determina si el usuario puede actualizar la transacción.
     */
    public function update(User $user, Transaction $transaction): bool
    {
        // El usuario puede actualizar si el 'user_id' de la transacción es SU 'id'
        return $user->id === $transaction->user_id;
    }

    /**
     * Determina si el usuario puede eliminar la transacción.
     */
    public function delete(User $user, Transaction $transaction): bool
    {
        // Misma lógica: solo puedo borrar lo mío
        return $user->id === $transaction->user_id;
    }

    // Nota: No necesitamos 'create' aquí porque eso se maneja
    // con el middleware 'auth' (solo usuarios logueados pueden crear)
}