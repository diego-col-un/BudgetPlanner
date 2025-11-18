<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

// --- AÑADIR ESTOS IMPORTS ---
use App\Events\TransactionCreated;
use App\Events\TransactionUpdated;
use App\Events\TransactionDeleted;
use App\Listeners\UpdateUserBalance;
use App\Listeners\CheckForAlerts;
// -----------------------------

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        
        // --- AÑADIR ESTAS LÍNEAS ---
        // Cuando se cree una transacción...
        TransactionCreated::class => [
            UpdateUserBalance::class, // ...actualiza el balance
            CheckForAlerts::class,    // ...y comprueba si hay que enviar alertas (A3)
        ],
        // Cuando se actualice...
        TransactionUpdated::class => [
            UpdateUserBalance::class, // ...también actualiza el balance
        ],
        // Cuando se borre...
        TransactionDeleted::class => [
            UpdateUserBalance::class, // ...también actualiza el balance
        ],
        // ------------------------------
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }
}