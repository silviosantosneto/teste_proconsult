<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [TicketController::class, 'list'])->name('dashboard');
    Route::prefix('ticket')->group( function (){
        Route::get('show/{id}', [TicketController::class, 'show'])->name('ticket.show');
        Route::get('create', [TicketController::class, 'create'])->name('ticket.create');
        Route::post('ticket-store', [TicketController::class, 'ticketStore'])->name('ticket.store');
        Route::post('reply-store', [TicketController::class, 'replyStore'])->name('reply.store');
        Route::put('close', [TicketController::class, 'close'])->name('ticket.close');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return redirect()->route('dashboard');
});

require __DIR__.'/auth.php';
