<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudsController;

Route::resource('/cruds', CrudsController::class, [
    'except' => ['edit', 'show', 'store']
]);