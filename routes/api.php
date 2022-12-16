<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/clientes/create', 'App\Http\Controllers\ClientesController@store');
Route::post('/clientes/update', 'App\Http\Controllers\ClientesController@update');
Route::get('/clientes/delete', 'App\Http\Controllers\ClientesController@delete');


//Rotas de Clientes
Route::post('/pedidos/create', 'App\Http\Controllers\PedidosController@store');
Route::post('/pedidos/update', 'App\Http\Controllers\PedidosController@update');
Route::get('/pedidos/delete', 'App\Http\Controllers\PedidosController@delete');
