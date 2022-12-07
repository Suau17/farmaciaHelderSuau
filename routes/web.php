<?php

use Illuminate\Support\Facades\Route;
//IMPORTANTE PONER LOS CONTROLLERS
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TreballadorController;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\ProveidorController;

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
Auth::routes();
Route::get('plantilla', function () {
    return "plantilla";
})->middleware('auth');


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('plantilla');
})->name('plantilla');

Route::group(['middleware'=>['auth']], function(){

//Producte

Route::get('/Producte',[ProducteController::class,'index']);

Route::get('/Producte/formnew',[ProducteController::class,'create']);

Route::post('/Producte/save',[ProducteController::class,'store']);

Route::get('/Producte/delete/{id}',[ProducteController::class,'destroy']);

Route::get('/Producte/update/{id}',[ProducteController::class,'edit']);

Route::post('/Producte/update/{id}',[ProducteController::class,'update']);

Route::group(['middleware'=>['role:admin']], function(){

//Client

Route::get('/Client',[ClientController::class,'index']);

Route::get('/Client/formnew',[ClientController::class,'create']);

Route::post('/Client/save',[ClientController::class,'store']);

Route::get('/Client/delete/{id}',[ClientController::class,'destroy']);

Route::get('/Client/update/{id}',[ClientController::class,'edit']);

Route::post('/Client/update/{id}',[ClientController::class,'update']);
});

//treballador

Route::get('/Treballador',[TreballadorController::class,'index']);

Route::get('/Treballador/formnew',[TreballadorController::class,'create']);

Route::post('/Treballador/save',[TreballadorController::class,'store']);

Route::get('/Treballador/delete/{id}',[TreballadorController::class,'destroy']);

Route::get('/Treballador/update/{id}',[TreballadorController::class,'edit']);

Route::post('/Treballador/update/{id}',[TreballadorController::class,'update']);

//Proveidor

Route::get('/Proveidor',[ProveidorController::class,'index']);

Route::get('/Proveidor/formnew',[ProveidorController::class,'create']);

Route::post('/Proveidor/save',[ProveidorController::class,'store']);

Route::get('/Proveidor/delete/{id}',[ProveidorController::class,'destroy']);

Route::get('/Proveidor/update/{id}',[ProveidorController::class,'edit']);

Route::post('/Proveidor/update/{id}',[ProveidorController::class,'update']);

//middleware

});