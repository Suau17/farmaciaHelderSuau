<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TreballadorController;

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
    return view('plantilla');
});
Route::get('/Client',[ClientController::class,'index']);

Route::get('/Client/formnew',[ClientController::class,'create']);

Route::post('/Client/save',[ClientController::class,'store']);

Route::get('/Client/delete/{id}',[ClientController::class,'destroy']);

Route::get('/Client/update/{id}',[ClientController::class,'edit']);

Route::post('/Client/update/{id}',[ClientController::class,'update']);

//treballador


Route::get('/Treballador',[TreballadorController::class,'index']);

Route::get('/Treballador/formnew',[TreballadorController::class,'create']);

Route::post('/Treballador/save',[TreballadorController::class,'store']);

Route::get('/Treballador/delete/{id}',[TreballadorController::class,'destroy']);

Route::get('/Treballador/update/{id}',[TreballadorController::class,'edit']);

Route::post('/Treballador/update/{id}',[TreballadorController::class,'update']);
