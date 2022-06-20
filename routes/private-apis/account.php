<?php

use App\Http\Controllers\AccountsController;
use Illuminate\Support\Facades\Route;

Route::controller(AccountsController::class)
    ->prefix('accounts')
    ->group(function () {
        Route::post('/', 'create');
    });
