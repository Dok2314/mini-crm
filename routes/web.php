<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\WidgetController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\Web\DownloadFileController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('admin.tickets.index');
    }
    return view('auth.login');
});

Route::get('/widget', [WidgetController::class, 'index'])->name('widget');

Route::prefix('admin')
    ->middleware(['auth', CheckRole::class.':manager,admin'])
    ->group(function () {
        Route::get('/', function () {
            return view('admin.home');
        })->name('admin.home');

        Route::get('/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
        Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
        Route::post('/tickets/{ticket}/status', [AdminTicketController::class, 'changeStatus'])->name('admin.tickets.changeStatus');

        Route::get('/customers', [AdminCustomerController::class, 'index'])->name('admin.customers.index');

        Route::get('/tickets/{ticket}/file/{media}', [DownloadFileController::class, 'downloadFile'])
            ->name('tickets.file.download');
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
