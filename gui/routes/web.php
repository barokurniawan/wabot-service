<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware('auth')->prefix('internal')->group(function () {
    Route::get('/', 'InternalController@main')->name('internal_main');
    Route::get('/service', 'InternalController@service')->name('internal_service');
    Route::get('/service/new', 'InternalController@newService')->name('internal_service_new');
});

Route::get('/', function () {
    return view('welcome');
})->name('main_page');

Route::get('/home', 'HomeController@index')->name('home');
