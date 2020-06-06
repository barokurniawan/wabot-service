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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/send-message', 'Api\ApiController@messageHandler')->name('api.send-message');

Route::post('/send-media',  'Api\ApiController@mediaHandler')->name('api.send-media');

Route::get('/device',  'Api\ApiController@deviceHandler')->name('api.device');

Route::post('/qr',  'Api\ApiController@qrcodeHandler')->name('api.qrcode');

Route::post('/health',  'Api\ApiController@healthHandler')->name('api.health');

Route::post('/registration',  'Api\ApiController@registrationHandler')->name('api.registration');

Route::get('/list-users', 'Api\ApiController@listUserHandler')->name('api.list-users');
