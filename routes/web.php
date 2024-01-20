<?php

use App\Http\Controllers\LaboratoryRoomController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
// Route::resource('users', UserController::class);

Auth::routes();
Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function() {
    Route::get('/tes', function(){
        return view('pages.dashboard.index');
    })->name('dashboard');
    Route::resource('laboratory-rooms', LaboratoryRoomController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
