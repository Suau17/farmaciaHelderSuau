<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProducteController;
use App\Http\Controllers\api\ProveidorController;
use App\Http\Controllers\api\Prod_ProvController;
use App\Http\Controllers\api\ClientController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//productos
Route::get('producte',[ProducteController::class,'index']); 
Route::post('producte/save',[ProducteController::class,'store']); 
Route::delete('producte/delete/{id}',[ProducteController::class,'destroy']); 
Route::put('producte/update',[ProducteController::class,'update']);

Route::resource('client', ClientController::class);
Route::resource('producte', ProducteController::class);
//cositas
Route::get('proveidor', [ProveidorController::class,'index']);
Route::post('proveidor/save', [ProveidorController::class,'store']);
Route::delete('proveidor/delete/{id}', [ProveidorController::class,'destroy']);
Route::put('proveidor/update/{id}', [ProveidorController::class,'update']);


