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

Route::redirect('/','inicio');

Route::get('VerMapa/{id}','Web\PageController@Mapa')->name('detalle');

Route::get('inicio','Web\MapController@index')->name('inicio');

Route::get('error','Web\PageController@Error')->name('error');

Route::resource('maps','Web\MapController');

//Route::get('detalle','Web\PageController@Mapa')->name('detalle');


//{{route('maps.export')}}