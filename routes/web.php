<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' =>['web']], function () {
    Route::get('producto', 'ProductoController@create');
    Route::post('producto', 'ProductoController@store');
    Route::get('productos', 'ProductoController@index');
    Route::delete('producto/{id}', 'ProductoController@destroy');
    //Route::get('producto/{id}', 'ProductoController@show');
    //Route::get('producto/{nombre}', 'ProductoController@findByName');

    Route::get('envio', 'EnvioController@create');
    Route::post('envio', 'EnvioController@store');
    Route::get('envios', 'EnvioController@index');
    Route::delete('envio/{id}', 'EnvioController@destroy');
});



