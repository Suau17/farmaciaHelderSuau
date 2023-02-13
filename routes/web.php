<?php

use Illuminate\Support\Facades\Route;
//IMPORTANTE PONER LOS CONTROLLERS
// use App\Http\Controllers\ClientController;
// use App\Http\Controllers\TreballadorController;
// use App\Http\Controllers\ProducteController;
// use App\Http\Controllers\ProveidorController;


use Illuminate\Http\Request;

use App\Http\Controllers\api\ProducteController;
use App\Http\Controllers\ProveidorController;
use App\Http\Controllers\api\Prod_ProvController;
use App\Http\Controllers\api\ClientController;

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

Route::group(['middleware'=>['auth']], function() {

Route::get('/', function () {
    return view('plantilla');
})->name('plantilla');

Route::get('/producte/create2', function () {
    return view('Producte/index2');
});

Route::get('/client/create2', function(){
    return view('Client/index2');
});


});

//Producte

Route::get('/Producte',[ProducteController::class,'index']);

Route::get('/Producte/formnew',[ProducteController::class,'create']);



Route::get('/Producte/delete/{id}',[ProducteController::class,'destroy']);

Route::get('/Producte/update/{id}',[ProducteController::class,'edit']);

Route::post('/Producte/update/{id}',[ProducteController::class,'update']);

Route::get('/Producte/show/{id}',[ProducteController::class,'show']);

//Rutes que només podrà accedir un usuari amb rol "admin"
Route::group(['middleware'=>['auth','role:admin']], function() {

//Client

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

//Proveidor

Route::get('/Proveidor',[ProveidorController::class,'index']);

Route::get('/Proveidor/formnew',[ProveidorController::class,'create']);

Route::post('/Proveidor/save',[ProveidorController::class,'store']);

Route::get('/Proveidor/delete/{id}',[ProveidorController::class,'destroy']);

Route::get('/Proveidor/update/{id}',[ProveidorController::class,'edit']);

Route::post('/Proveidor/update/{id}',[ProveidorController::class,'update']);

Route::get('/Proveidor/show/{id}',[ProveidorController::class,'show']);

//middleware



//vista api 
Route::get('/api/producte/create');
});

