<?php

use App\Http\Controllers\DataComputerController;
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
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('laboratory-rooms', LaboratoryRoomController::class)->except('show');
    Route::get('laboratory-create-computers/{laboratory_room}', [DataComputerController::class, 'indexComputerInLabor'])->name('laboratoryComputer.index');
    Route::get('laboratory-create-computers/{laboratory_room}/create', [DataComputerController::class, 'createLaboratoryComputer'])->name('laboratoryComputer.create');
    Route::post('laboratory-create-computers/{laboratory_room}', [DataComputerController::class, 'storeLaboratoryComputer'])->name('laboratoryComputer.store');
    Route::get('laboratory-create-computers/{laboratory_room}/{computer_information}/show', [DataComputerController::class, 'showLaboratoryComputer'])->name('laboratoryComputer.show');
    Route::get('laboratory-create-computers/{laboratory_room}/{computer_information}/edit', [DataComputerController::class, 'editLaboratoryComputer'])->name('laboratoryComputer.edit');
    Route::patch('laboratory-create-computers/{laboratory_room}/{computer_information}/update', [DataComputerController::class, 'updateLaboratoryComputer'])->name('laboratoryComputer.update');
    Route::delete('laboratory-create-computers/{computer_information}/delete', [DataComputerController::class, 'deleteLaboratoryComputer'])->name('laboratoryComputer.destroy');
});
