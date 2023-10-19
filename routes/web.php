<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarUserController;
use App\Models\User;
use App\Models\Car;
use App\Models\CarUser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->name('admin')->group(function () {
    Route::middleware('auth')->group(function () {

        Route::get('/', [HomeController::class, 'dashboard'])->name('home');

        Route::prefix('users')->name('users.')->group(function (){
            // index
            Route::get('/', [UserController::class,'index'])->name('index');

            //create
            Route::get('/create', [UserController::class,'create'])->name('create');
            Route::post('/create', [UserController::class,'store'])->name('store');

            //edit
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');

            //update
            Route::post('/{id}/edit', [UserController::class, 'update'])->name('update');


            // Route::get('/factory', function(){
            //     User::factory()->count(10)->create();
            //     return 'success';
            // });
        });

        Route::prefix('cars')->name('cars.')->group(function (){
             // index
             Route::get('/', [CarController::class,'index'])->name('index');

             //create
             Route::get('/create', [CarController::class,'create'])->name('create');
             Route::post('/create', [CarController::class,'store'])->name('store');

             //edit
             Route::get('/{id}/edit', [CarController::class, 'edit'])->name('edit');

             //update
             Route::post('/{id}/edit', [CarController::class, 'update'])->name('update');

            Route::get('/factory', function(){
                Car::factory()->count(10)->create();
                return 'success';
            });
        });

        Route::prefix('carsUser')->name('carsUser.')->group(function (){
             // index
             Route::get('/', [CarUserController::class,'index'])->name('index');

        });
    });
});

