<?php

use App\Http\Controllers\AccountsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::resource('accounts', AccountsController::class);
});

