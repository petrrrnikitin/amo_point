<?php

use App\Dogs\Controllers\DogController;
use Illuminate\Support\Facades\Route;

Route::get('/dogs', [DogController::class, 'index']);