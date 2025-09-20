<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\StatisticsController;

Route::post('/tickets', [TicketController::class, 'store'])->name('api.tickets.store');
Route::get('/tickets/statistics', [StatisticsController::class, 'index'])->name('api.tickets.statistics');
