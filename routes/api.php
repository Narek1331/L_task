<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogAndNewsController;


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signup']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

    Route::group([
        'prefix' => 'reset_password',    
    ], function ($router) {
        Route::post('/generate', [ForgotPasswordController::class,'sendResetLinkEmail']);
        Route::post('/new_password', [ForgotPasswordController::class,'setNewPassword']);
    });
});

Route::group([
    'middleware' => 'auth:api',
], function ($router) {
    Route::group([
        'prefix' => 'profile',    
    ], function ($router) {
        Route::get('/', [AuthController::class,'me']);
        Route::patch('/avatar', [ProfileController::class,'updateAvatar']);
    });
});

Route::group([
    'prefix' => 'blog_news',
], function ($router) {
    Route::get('/', [BlogAndNewsController::class,'index']);
    Route::post('/', [BlogAndNewsController::class,'store']);
    Route::post('/{blog_news_id}/like', [BlogAndNewsController::class,'like'])->where('blog_news_id', '[0-9]+');
    Route::post('/{blog_news_id}/comment', [BlogAndNewsController::class,'comment'])->where('blog_news_id', '[0-9]+');
});

