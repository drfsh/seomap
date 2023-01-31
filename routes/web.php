<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/test',[DashboardController::class, 'test']);

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'view'])->name('dashboard');
    Route::get('/api/countAlert', [DashboardController::class, 'countAlert'])->name('countAlert');
    Route::get('/api/infoSlider', [DashboardController::class, 'infoSlider'])->name('infoSlider');

    Route::get('/service', [OrderController::class, 'service'])->name('service');

    Route::get('/service/{slug}', [OrderController::class, 'create'])->name('order.create');

    Route::get('/orders', [OrderController::class, 'list'])->name('orders.list');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/order/{code}', [OrderController::class,'project'])->name('order');
    Route::post('/order/file', [OrderController::class,'uploadAttrs'])->name('file.send');
    Route::post('/order/demo', [OrderController::class,'demoChecked'])->name('demo.checked');

    Route::get('/invoice/pay/{id}', [\App\Http\Controllers\Panel\InvoiceController::class,'pay'])->name('invoice.pay');
    Route::any('/invoice/callback', [\App\Http\Controllers\Panel\InvoiceController::class,'callback'])->name('invoice.callback');


    Route::get('/tickets', [TicketController::class, 'list'])->name('ticket.list');
    Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/ticket/create', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/ticket/{code}', [TicketController::class, 'view'])->name('ticket.view');
    Route::post('/ticket', [TicketController::class, 'reply'])->name('ticket.reply');
    Route::post('/admin/ticket/status', [\App\Http\Controllers\Admin\TicketController::class, 'status'])->name('admin.ticket.status');

    Route::get('/notifications', [NotificationController::class, 'list'])->name('notification.list');
    Route::get('/notification/{id}', [NotificationController::class,'view'])->name('notification');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth.admin')->group(function () {
    Route::get('/admin', [HomeController::class,'view'])->name('admin');
    Route::get('/admin/infoSlider', [HomeController::class,'infoSlider'])->name('admin.infoSlider');

    Route::get('/admin/user', [UserController::class,'view'])->name('admin.users');
    Route::get('/admin/user/create', [UserController::class,'create'])->name('admin.user.create');
    Route::post('/admin/user/create', [UserController::class,'store'])->name('admin.user.store');
    Route::get('/admin/user/{id}', [UserController::class,'edit'])->name('admin.user.edit');
    Route::post('/admin/user', [UserController::class,'update'])->name('admin.user.update');
    Route::delete('/admin/user/{id}', [UserController::class,'destroy'])->name('admin.user.delete');

    Route::get('/admin/service', [ServiceController::class,'view'])->name('admin.services');
    Route::get('/admin/service/create', [ServiceController::class,'create'])->name('admin.service.create');
    Route::post('/admin/service/create', [ServiceController::class,'store'])->name('admin.service.store');
    Route::get('/admin/service/{id}', [ServiceController::class,'edit'])->name('admin.service.edit');
    Route::post('/admin/service/', [ServiceController::class,'update'])->name('admin.service.update');

    Route::get('/admin/orders', [OrdersController::class,'view'])->name('admin.orders');
    Route::get('/admin/order/{code}', [OrdersController::class,'project'])->name('admin.order');
    Route::post('/admin/order/attr/{id}', [OrdersController::class,'attrUpdate'])->name('admin.order.attr.edit');
    Route::delete('/admin/order/attr/{id}', [OrdersController::class,'attrDelete'])->name('admin.order.attr.delete');
    Route::post('/admin/order/attr', [OrdersController::class,'attrStore'])->name('admin.order.attr.store');
    Route::post('/admin/order/status', [OrdersController::class,'status'])->name('admin.order.status');
    Route::post('/admin/order/update', [OrdersController::class,'update'])->name('admin.order.update');

    Route::post('/admin/start/store', [OrdersController::class,'createStartAttrs'])->name('admin.start.store');
    Route::post('/admin/file/ok', [OrdersController::class,'changeStatusFile'])->name('admin.file.ok');

    Route::post('/admin/check/store', [OrdersController::class,'createDemoAttrs'])->name('admin.demo.store');



    Route::post('/admin/invoice', [InvoiceController::class,'store'])->name('admin.invoice.store');



    Route::get('/admin/tickets', [\App\Http\Controllers\Admin\TicketController::class,'list'])->name('admin.tickets');
    Route::get('/admin/ticket/create', [\App\Http\Controllers\Admin\TicketController::class, 'create'])->name('admin.ticket.create');
    Route::post('/admin/ticket/create', [\App\Http\Controllers\Admin\TicketController::class, 'store'])->name('admin.ticket.store');
    Route::get('/admin/ticket/{code}', [\App\Http\Controllers\Admin\TicketController::class, 'view'])->name('admin.ticket.view');
    Route::post('/admin/ticket', [\App\Http\Controllers\Admin\TicketController::class, 'reply'])->name('admin.ticket.reply');
    Route::post('/admin/ticket/status', [\App\Http\Controllers\Admin\TicketController::class, 'status'])->name('admin.ticket.status');

    Route::get('/admin/notifications', [\App\Http\Controllers\Admin\NotificationController::class,'view'])->name('admin.notifications');
    Route::get('/admin/notification/create', [\App\Http\Controllers\Admin\NotificationController::class,'create'])->name('admin.notification.create');
    Route::post('/admin/notification/create', [\App\Http\Controllers\Admin\NotificationController::class,'store'])->name('admin.notification.store');
    Route::get('/admin/notification/{id}', [\App\Http\Controllers\Admin\NotificationController::class,'notification'])->name('admin.notification');
    Route::get('/admin/notification/edit/{id}', [\App\Http\Controllers\Admin\NotificationController::class,'edit'])->name('admin.notification.edit');
    Route::post('/admin/notification/edit/{id}', [\App\Http\Controllers\Admin\NotificationController::class,'update'])->name('admin.notification.update');
    Route::delete('/admin/notification/{id}', [\App\Http\Controllers\Admin\NotificationController::class,'delete'])->name('admin.notification.delete');

});
require __DIR__.'/auth.php';
