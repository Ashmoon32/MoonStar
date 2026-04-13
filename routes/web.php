<?php
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/videos/create', [VideoController::class, 'create']);

Route::post('/videos', [VideoController::class, 'store']);

Route::get('/videos', [VideoController::class, 'index']);