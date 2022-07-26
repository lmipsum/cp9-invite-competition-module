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
    return redirect()->route('login');
});

Route::get('admin', function () {
    return redirect()->route('login');
});

Route::get('home', function () {
    return redirect()->route('pageTexts.edit');
});

$this->group(['prefix' => 'admin'], function () {
    Auth::routes();

    $this->group(['middleware' => ['auth']], function () {
        Route::get('texts', 'PageTextController@edit')->name('pageTexts.edit');
        Route::patch('pages/{page}/texts', 'PageTextController@update')->name('pageTexts.update');

        Route::get('export', 'PageSubmitController@showExportForm')->name('pageSubmits.exportForm');
        Route::post('pages/{page}/export', 'PageSubmitController@export')->name('pageSubmits.export');
    });
});

Route::get('{page}', 'PageController@show');
Route::post('pages/{page}/submits', 'PageSubmitController@store')->name('pageSubmits.store');
