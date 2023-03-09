<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProducteController;
use App\Http\Controllers\api\ProveidorController;
use App\Http\Controllers\api\Prod_ProvController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\RegisterController;

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
Route::post('register', [RegisterController::class, 'register']);

<<<<<<< HEAD
//Route::post('login', [LoginController::class, 'login']);

=======
Route::post('login', [RegisterController::class, 'login']);
>>>>>>> 389d845ff9e5fdbfb6922aa4de71f168c4db8f5a

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
      Route::post('producte/save',[ProducteController::class,'store']); 
      Route::delete('producte/delete/{id}',[ProducteController::class,'destroy']); 
    Route::put('producte/update/{id}',[ProducteController::class,'update']);

    Route::post('proveidor/save', [ProveidorController::class,'store']);
Route::delete('proveidor/delete/{id}', [ProveidorController::class,'destroy']);
Route::put('proveidor/update/{id}', [ProveidorController::class,'update']);
 });


Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
});

//productos
Route::get('producte',[ProducteController::class,'index']); 
// Route::post('producte/save',[ProducteController::class,'store']); 
// Route::delete('producte/delete/{id}',[ProducteController::class,'destroy']); 
// Route::put('producte/update/{id}',[ProducteController::class,'update']);

//clients
Route::get('client', [ClientController::class, 'index']);
Route::post('client/save',[ClientController::class,'store']); 
Route::delete('client/delete/{id}',[ClientController::class,'destroy']); 
Route::put('client/update/{id}',[ClientController::class,'update']);

//cositas
Route::get('proveidor', [ProveidorController::class,'index']);
// Route::post('proveidor/save', [ProveidorController::class,'store']);
// Route::delete('proveidor/delete/{id}', [ProveidorController::class,'destroy']);
// Route::put('proveidor/update/{id}', [ProveidorController::class,'update']);

//treballadors
Route::get('treballador',[TreballadorController::class,'index']); 
// Route::post('treballador/save',[TreballadorController::class,'store']); 
// Route::delete('treballador/delete/{id}',[TreballadorController::class,'destroy']); 
// Route::put('treballador/update/{id}',[TreballadorController::class,'update']);

Route::get('/login', function () {
    return "Has de validar-te com a usuari!";
})->name("login");
