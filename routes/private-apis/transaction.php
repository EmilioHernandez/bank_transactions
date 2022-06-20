<?php

use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

Route::resource('transactions', TransactionsController::class);

