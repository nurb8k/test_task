<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
       Route::post('/register','register');
       Route::post('/login','login');
       Route::post('/logout','logout')->middleware('auth:sanctum');
   });


    Route::group(['prefix' => 'post','controller' => PostController::class, 'middleware' => 'auth:sanctum'], function () {
        Route::get('/index','index');
        Route::post('/store','store');
        Route::get('/show/{id}','show');
        Route::put('/update/{id}','update');
        Route::delete('/delete/{id}','delete');
    });



});
