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
//Rotas de Clientes
Route::get('/clientes/cadastro', 'App\Http\Controllers\ClientesController@create')->name('cli_form');
Route::get('/clientes/alterar', 'App\Http\Controllers\ClientesController@update_form')->name('cli_alt');
Route::post('/clientes/update', 'App\Http\Controllers\ClientesController@update')->name('cli_update');
Route::get('/clientes/excluir', 'App\Http\Controllers\ClientesController@delete')->name('cli_del');
Route::get('/clientes/index', 'App\Http\Controllers\ClientesController@index')->name('cli_index');
Route::post('/clientes/cadastro', 'App\Http\Controllers\ClientesController@store')->name('cli_save');