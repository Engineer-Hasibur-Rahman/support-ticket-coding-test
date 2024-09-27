<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // tickets
    Route::get('customer/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('customer/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('customer/tickets', [TicketController::class, 'allTickets'])->name('tickets.all');
    // admin
    Route::get('admin/tickets/delete/{id?}', [TicketController::class, 'adminTicketDelete'])->name('admin.delete.ticket');
    Route::get('admin/tickets/view/{id?}', [TicketController::class, 'adminTicketView'])->name('admin.ticket.view');
    Route::get('admin/tickets/close/{id?}', [TicketController::class, 'adminTicketClose'])->name('admin.ticket.close');
    // ticket replay
    Route::post('tickets/{id}/reply', [TicketController::class, 'replyToTicket'])->name('tickets.reply');

});

require __DIR__.'/auth.php';
