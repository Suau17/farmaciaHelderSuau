<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/clients',[ClientsController::class,'index']);

Route::get('/clients/formnew',[ClientsController::class,'create']);

Route::post('/clients/save',[ClientsController::class,'store']);

Route::get('/clients/delete/{id}',[ClientsController::class,'destroy']);

Route::get('/clients/update/{id}',[ClientsController::class,'edit']);

Route::post('/clients/update/{id}',[ClientsController::class,'update']);
