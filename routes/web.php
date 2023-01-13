<?php

use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\NotificationController;
use App\Http\Controllers\Panel\OrderController;
use App\Http\Controllers\Panel\TicketController;
use App\Http\Controllers\Panel\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'view'])->name('dashboard');
    Route::get('/service', [OrderController::class, 'service'])->name('service');

    Route::get('/service/{slug}', [OrderController::class, 'create'])->name('order.create');

    Route::get('/orders', [OrderController::class, 'view'])->name('orders.view');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/tickets', [TicketController::class, 'list'])->name('ticket.list');
    Route::get('/notifications', [NotificationController::class, 'list'])->name('notification.list');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
