<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('cuenta/{id}', 'CuentaController@show');
Route::resource('cuenta', 'CuentaController@index');
Route::post('cuenta', 'CuentaController@store');
Route::post('cuentaforgot', 'CuentaController@forgot');

Route::post('cuentacomercial', 'CuentaComercialController@store');
Route::post('cuentapersonal', 'CuentaPersonalController@store');

Route::post('cliente', 'ClienteController@store');

Route::group(['prefix' => 'api'], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
});