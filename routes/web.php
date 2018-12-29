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

Route::get('jiege', function () {
    echo 1;exit;
});

Route::get('jiegetwo', function () {
    echo 2;exit;
});


Route::group(['prefix' => 'breakpoint'], function () {

    Route::get('/uploadGet', 'BreakPoint\BreakPointController@uploadGet');
    Route::get('/uploadPost', 'BreakPoint\BreakPointController@uploadPost');
});


