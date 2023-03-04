<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('/ping', function(){
    return ['pong' =>true];
});
Route::get('/401', [AuthController::class, 'unauthorized'])->name('unauthorized');

Route::group(['prefix'=>'auth'], function(){
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth:api')->group(function(){
    Route::group(['prefix'=>'auth'],
        function($router){

            Route::post('/validateToken', [AuthController::class, 'validateToken']);
            Route::post('/logout',[AuthController::class, 'logout']);
            Route::post('/refresh',[AuthController::class, 'refresh']);

        }
    );
    Route::group(['prefix'=>'account'],
        function($router){
            Route::post('/created', [AccountController::class, 'created']);
            Route::get('/{id}', [AccountController::class, 'show']);
        }
    );

});
