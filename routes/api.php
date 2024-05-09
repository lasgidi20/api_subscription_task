<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\AuthenticateController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\API\PostController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\BlockedIPChecker;

Route::post('/register', [RegisterController::class, 'register'])->middleware('blockip');

Route::middleware(['blockip'])->group(function(){
    Route::post('login', [AuthenticateController::class,'login']);
    Route::get('logout', [AuthenticateController::class,'logout']);
});

Route::resource('subscriptions', SubscriptionController::class)->middleware(BlockedIPChecker::class, 'auth:sanctum', ThrottleMiddleware::class);
Route::resource('posts', PostController::class)->middleware('auth:sanctum', ThrottleMiddleware::class);

