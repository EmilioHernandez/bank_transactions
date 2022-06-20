<?php

use App\Http\Controllers\AccountsController;
use Illuminate\Support\Facades\Route;

Route::resource('accounts', AccountsController::class);

