<?php

use App\Http\Controllers\Adm\BlockController;
use App\Http\Controllers\Adm\CondominiaController;
use App\Http\Controllers\Adm\InvitationController;
use App\Http\Controllers\Adm\ProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/users')->name('users.')->middleware(['auth'])->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'create'])->name('create');
    Route::delete('/{id}', [UserController::class, 'deleted'])->name('delete');
});
Route::prefix('/products')->name('products.')->middleware(['auth'])->group(function(){
    Route::get('/', [ProductsController::class, 'index'])->name('index');
    Route::get('/{id}', [ProductsController::class, 'getOne'])->name('edit');
    // Route::post('/', [UserController::class, 'create'])->name('create');
    Route::delete('/{id}', [ProductsController::class, 'deleted'])->name('delete');
});
Route::prefix('/condominia')->name('condominia.')->middleware(['auth'])->group(function(){
    Route::get('/', [CondominiaController::class, 'index'])->name('index');
    Route::post('/', [CondominiaController::class, 'create'])->name('create');
    Route::get('/{condominia}', [CondominiaController::class, 'getOne'])->name('edit');
    // Route::delete('/{id}', [ProductsController::class, 'deleted'])->name('delete');
});
Route::prefix('/blocks')->name('blocks.')->middleware((['auth']))->group(function (){
    Route::post('/', [BlockController::class, 'created'])->name('create');
});
Route::prefix('/invites')->name('invites.')->middleware(['auth'])->group(function(){
    Route::get('/', [InvitationController::class, 'index'])->name('index');
    // Route::get('/{id}', [ProductsController::class, 'getOne'])->name('edit');
    Route::post('/', [InvitationController::class, 'create'])->name('create');
    // Route::delete('/{id}', [ProductsController::class, 'deleted'])->name('delete');
});



require __DIR__.'/auth.php';
