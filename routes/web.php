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

/* Route::get('/pagina404', function () {
    return '404 - Página não existe';
})->name('404.tenant'); */

Route::get('/erro404', 'RedirectBadController@falha')->name('404.tenant');

Route::get('/teste', function () {
    return 'Página teste.';
})->name('teste');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
