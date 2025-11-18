<?php

namespace App\Events;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionDeleted
{
    use Dispatchable, SerializesModels;

    public $transaction; // Esta es la transacción "en memoria" con los datos antiguos
    public $user;        // El usuario al que pertenecía

    public function __construct(Transaction $transaction, User $user)
    {
        $this->transaction = $transaction;
        $this->user = $user;
    }
}