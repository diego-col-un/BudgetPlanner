<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NotificationPreferenceController;
use App\Http\Controllers\ReminderController;
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

    #Notificaciones personalizadas
    Route::get('/profile/notifications', [NotificationPreferenceController::class, 'edit'])->name('preferences.edit');
    Route::put('/profile/notifications', [NotificationPreferenceController::class, 'update'])->name('preferences.update');
});



