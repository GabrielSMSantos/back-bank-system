<?php

use App\Infrastructure\Customer\Presentation\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::post('/', [CustomerController::class, 'create'])->name('create');
