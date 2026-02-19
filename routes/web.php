<?php

use App\Http\Controllers\RemitEventController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RemitEventController::class, 'index'])->name('remit.index');
