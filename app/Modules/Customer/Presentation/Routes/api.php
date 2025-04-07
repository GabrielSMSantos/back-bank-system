<?php

namespace App\Modules\Customer\Presentation\Routes;

use App\Modules\Customer\Presentation\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::post('/', [CustomerController::class, 'create'])->name('create');
