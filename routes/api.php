<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\AuthenticateController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\API\PostController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\BlockedIPChecker;

Route::post('/register', [RegisterController::class, 'register']);

Route::controller(AuthenticateController::class)->group(function(){
    Route::post('login', 'login');
    Route::get('logout', 'logout');
});

Route::resource('subscriptions', SubscriptionController::class)->middleware(BlockedIPChecker::class);
Route::resource('posts', PostController::class);

