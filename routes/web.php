<?php

use Illuminate\Support\Facades\Route;
//IMPORTANTE PONER LOS CONTROLLERS
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TreballadorController;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\ProveidorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Prod_ProvController;

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

//Producte

Route::get('/Producte',[ProducteController::class,'index']);

Route::get('/Producte/formnew',[ProducteController::class,'create']);

Route::post('/Producte/save',[ProducteController::class,'store']);

Route::get('/Producte/delete/{id}',[ProducteController::class,'destroy']);

Route::get('/Producte/update/{id}',[ProducteController::class,'edit']);

Route::post('/Producte/update/{id}',[ProducteController::class,'update']);

//Proveidor

Route::get('/Proveidor',[ProveidorController::class,'index']);

Route::get('/Proveidor/formnew',[ProveidorController::class,'create']);

Route::get('/Proveidor/show/{id}',[ProveidorController::class,'show']);

Route::post('/Proveidor/save',[ProveidorController::class,'store']);

Route::get('/Proveidor/delete/{id}',[ProveidorController::class,'destroy']);

Route::get('/Proveidor/update/{id}',[ProveidorController::class,'edit']);

Route::post('/Proveidor/update/{id}',[ProveidorController::class,'update']);

//prod_prov
Route::get('/Prod_Prov',[Prod_ProvController::class,'index']);


//middleware

Auth::routes();
Route::get('/webSegura', function () {
    return "";
})->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('plantilla', [App\Http\Controllers\RegisterController::class, 'index'])->name('plantilla');


// proteger rutas si es admin o usuario
// Route::group(['middleware'=>['auth','is_admin']], function() {}                                                                                                            
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
