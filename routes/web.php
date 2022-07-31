<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\DashboardController;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/dashboard/rules',[DashboardController::class,'rules'])->name('dashboard/rules');

    //ROUTES THAT LOGGED IN USERS SHOULD SEE WITHOUT NEEDING PERMISSIONS
    //Operation Show Routes
    Route::get('/operations/{operation}',[OperationController::class, 'show']);
    //Operation Register\Unregister Routes
    Route::post('/operations/{operation}/user/{user}/unregister',[OperationController::class,'unregister']);
    Route::post('/operations/{operation}/user/{user}',[OperationController::class,'signup']);
});


//Admin Middleware group
Route::middleware('can:Admin')->group(function (){
    //Admin Routes
    Route::get('/admin',[AdminController::class, 'index'])->name('admin');

    //Admin User Routes
    Route::get('/admin/users',[AdminUserController::class,'index'])->name('admin/users');
    Route::delete('admin/users/{user}',[AdminUserController::class, 'destroy']);
    Route::get('/admin/users/{user}/edit',[AdminUserController::class,'edit']);
    Route::patch('/admin/users/{user}',[AdminUserController::class, 'update']);


});

//Mission Maker Group
Route::middleware('can:MissionMaker')->group(function(){
    Route::get('/operations',[OperationController::class,'index'])->name('missions');
    Route::delete('/operations/{operation}',[OperationController::class,'destroy']);
    Route::patch('/operations/{operation}',[OperationController::class,'update']);
    Route::get('/operations/{operation}/edit',[OperationController::class, 'edit']);
    Route::get('/operation/create',[OperationController::class,'create']);
    Route::post('/operations',[OperationController::class,'store']);
    Route::post('/operations/{operation}/complete',[OperationController::class,'complete']);

});
