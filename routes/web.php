<?php

use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CityController::class, 'index'])->name('CityView');
