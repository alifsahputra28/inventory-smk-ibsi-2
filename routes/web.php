<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataComputerController;
use App\Http\Controllers\DataSupportingDeviceController;
use App\Http\Controllers\LaboratoryComputerController;
use App\Http\Controllers\LaboratoryRoomController;
use App\Http\Controllers\LaboratorySupportingDeviceController;
use App\Http\Controllers\OutdatedComputerController;
use App\Http\Controllers\OutdatedSupportingDeviceController;
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
    // return view('welcome');
    return redirect()->route('dashboard');
});
// Route::resource('users', UserController::class);

Auth::routes();

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function() {
    // Route::get('/dashboard', function(){
    //     return view('pages.dashboard.index');
    // })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('laboratory-rooms', LaboratoryRoomController::class)->except('show');
    Route::resource('data-computers', DataComputerController::class);
    // Route::resource('laboratory-computers', LaboratoryComputerController::class);
    // Route::resource('data-supporting-devices', DataSupportingDeviceController::class);
    
    Route::get('get-data-computer/{dataComputer}', [LaboratoryComputerController::class,'getComputer'])->name('get.computer');
   

    Route::controller(LaboratoryComputerController::class)->name('laboratory-computers.')->group(
        function () {
            Route::get('laboratory-computers', 'index')->name('index');
            Route::get('laboratory-computers/{laboratory_room}/create', 'create')->name('create');
            Route::post('laboratory-computers/{laboratory_room}', 'store')->name('store');
            Route::get('laboratory-computers/{laboratory_computer}/edit', 'edit')->name('edit');
            Route::patch('laboratory-computers/{laboratory_computer}', 'update')->name('update');
            Route::get('laboratory-computers/{laboratory_computer}/show', 'show')->name('show');
            Route::delete('laboratory-computers/{laboratory_computer}', 'destroy')->name('destroy');
            // Route::get('laboratory-computers/get-computers', 'getComputers')->name('get-computers');
        }
    );


    Route::controller(DataSupportingDeviceController::class)->name('data-supporting-devices.')->group(function(){
        Route::get('data-supporting-devices', 'index')->name('index');
        Route::get('data-supporting-devices/create', 'create')->name('create');
        Route::post('data-supporting-devices', 'store')->name('store');
        Route::get('data-supporting-devices/{data_supporting_device}/edit', 'edit')->name('edit');
        Route::patch('data-supporting-devices/{data_supporting_device}', 'update')->name('update');
        Route::get('data-supporting-devices/{data_supporting_device}/show', 'show')->name('show');
        Route::delete('data-supporting-devices/{data_supporting_device}', 'destroy')->name('destroy');
    });

    Route::controller(LaboratorySupportingDeviceController::class)->name('laboratory-supporting-devices.')->group(
        function () {
            Route::get('laboratory-supporting-devices', 'index')->name('index');
            Route::get('laboratory-supporting-devices/{laboratory_room}/create', 'create')->name('create');
            Route::post('laboratory-supporting-devices/{laboratory_room}', 'store')->name('store');
            Route::get('laboratory-supporting-devices/{laboratory_supporting_device}/edit', 'edit')->name('edit');
            Route::patch('laboratory-supporting-devices/{laboratory_supporting_device}', 'update')->name('update');
            Route::get('laboratory-supporting-devices/{laboratory_supporting_device}/show', 'show')->name('show');
            Route::delete('laboratory-supporting-devices/{laboratory_supporting_device}', 'destroy')->name('destroy');
            Route::get('get-data-supporting-devices/{data_supporting_device}', 'getSupportingDevice')->name('get.supportingDevice');
        }
    );


    Route::controller(OutdatedComputerController::class)->name('data-outdated-computers.')->group(function(){
        Route::get('data-outdated-computers', 'index')->name('index');
    });
    Route::controller(OutdatedSupportingDeviceController::class)->name('data-outdated-supporting-device.')->group(function(){
        Route::get('data-outdated-supporting-device', 'index')->name('index');
    });
    
    
});
