<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CondominiaController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redis;
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

Route::get('/test-redis', function(){
    //Redis::set('chave', 'valor');
    $valor = Redis::get('products');
    return $valor;
});

Route::get('/401', [AuthController::class, 'unauthorized'])->name('unauthorized');

Route::group(['prefix'=>'auth'], function(){
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


Route::get('product/', [ProductController::class, 'index']);
Route::get('/invite/{invitation}', [InvitationController::class, 'get'])->name('get');

Route::group(['prefix' => 'password'],
    function($router){
        Route::post('/forgot', [PasswordController::class, 'forgotPassword']);
        Route::post('/reset', [PasswordController::class, 'reset']);
    }
);

Route::middleware('auth:api')->group(function(){
    Route::group(['prefix'=>'auth'],
        function($router){

            Route::post('/validateToken', [AuthController::class, 'validateToken']);
            Route::post('/logout',[AuthController::class, 'logout']);
            Route::post('/refresh',[AuthController::class, 'refresh']);

        }
    );
    // Route::post('invite/created', [InvitationController::class, 'sendInvite']);
    Route::group(['prefix' => 'invite'],
        function(){
            Route::get('/', [InvitationController::class, 'getAll'])->name('getAll');
            Route::post('/created', [InvitationController::class, 'sendInvite'])->name('created');
            Route::post('/resend/{invitation}', [InvitationController::class, 'resendInvite'])->name('resend');
            Route::put('/{invitation}', [InvitationController::class, 'updateInvitation'])->name('updateInvitation');
        }
    );
    Route::group(['prefix'=>'account'],
        function($router){
            Route::post('/created', [AccountController::class, 'created']);
            Route::get('/get', [AccountController::class, 'getAll']);
            Route::get('/{id}', [AccountController::class, 'show']);
            Route::put('/{account}', [AccountController::class, 'updated']);
        }
    );

    Route::group(['prefix' => 'condominia'],
        function($router){
            Route::get('/', [CondominiaController::class, 'index']);
            Route::get('/getAll', [CondominiaController::class, 'getAll']);
            Route::post('/created', [CondominiaController::class, 'created']);
            Route::get('/{condominia}', [CondominiaController::class, 'getCondominia']);
            Route::put('/{condominia}', [CondominiaController::class, 'update']);
            Route::delete('/{condominia}', [CondominiaController::class, 'destroy']);
        }
    );

    Route::group(['prefix' => 'user'],
        function($router){
            Route::get('/', [UserController::class, 'index']);
            Route::post('/created', [UserController::class, 'created']);
            Route::put('/update', [UserController::class, 'update']);
        }
    );

    Route::group(['prefix' => 'apartment'],
        function($router){
            Route::get('/', [ApartmentController::class, 'index']);
            Route::post('/created', [ApartmentController::class, 'created']);
            Route::post('/block', [ApartmentController::class, 'createdBlock']);
            Route::get('/{apartment}', [ApartmentController::class, 'getApartment']);
            Route::put('/{apartment}', [ApartmentController::class, 'update']);
            Route::delete('/{apartment}', [ApartmentController::class, 'destroy']);

        }
    );
    Route::group(['prefix' => 'product'],
        function($router){
            Route::post('/created', [ProductController::class, 'created']);
            Route::get('/trashed', [ProductController::class, 'trashed']);
            Route::get('/{product}', [ProductController::class, 'getProduct']);
            Route::post('/{product}', [ProductController::class, 'update']);
            Route::delete('/{product}', [ProductController::class, 'destroy']);
            Route::delete('/forcedelete/{product}', [ProductController::class, 'deleteForce']);
            Route::get('/{product}/restore', [ProductController::class, 'restore']);
        }
    );
    Route::group(['prefix' => 'category'],
    function($router){
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/list', [CategoryController::class, 'getList']);
        Route::post('/created', [CategoryController::class, 'created']);
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    }
);

});
