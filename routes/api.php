<?php

use App\Http\Controllers\Api\AgendaApiController;
use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthApiController::class, 'login']);
Route::post('register', [AuthApiController::class, 'register']);
Route::resource('agenda', AgendaApiController::class)->middleware('auth:sanctum');;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
