<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NotificationPreferenceController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\AlertController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// rutas protegidas en el cual solo se accede si el usuario haya iniciado sesion
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('reminders', ReminderController::class);

    Route::get('/alerts', [AlertController::class, 'index'])->name('alerts.index');
    Route::get('/alerts/{alert}', [AlertController::class, 'show'])->name('alerts.show');
    Route::patch('/alerts/{alert}/read', [AlertController::class, 'markAsRead'])->name('alerts.read');

    #Notificaciones personalizadas
    Route::get('/profile/notifications', [NotificationPreferenceController::class, 'edit'])->name('preferences.edit');
    Route::put('/profile/notifications', [NotificationPreferenceController::class, 'update'])->name('preferences.update');
    Route::middleware(['auth'])->group(function () {
    // Ruta para descargar el PDF (Solo usuario logueado)
    Route::get('/transactions/export/pdf', [TransactionController::class, 'exportPdf'])->name('transactions.exportPdf');
});

// Ruta PÚBLICA pero FIRMADA para compartir (No requiere login, pero sí el hash válido)
Route::get('/shared-report/{user}', [TransactionController::class, 'sharedReport'])
    ->name('transactions.shared')
    ->middleware('signed');
});



