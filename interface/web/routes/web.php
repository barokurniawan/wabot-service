<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/qr', [
        'as' => 'qrcode', 'uses' => 'WabotServiceController@qrcodeHandler'
    ]);

    $router->post('/message', [
        'as' => 'send_message', 'uses' => 'WabotServiceController@textMessageHandler'
    ]);

    $router->post('/media', [
        'as' => 'send_message', 'uses' => 'WabotServiceController@mediaMessageHandler'
    ]);

    $router->get('/device', [
        'as' => 'device_info', 'uses' => 'WabotServiceController@deviceInfoHandler'
    ]);

    $router->get('/device/reset', [
        'as' => 'device_reset', 'uses' => 'WabotServiceController@resetDeviceHandler'
    ]);

    $router->get('/health', [
        'as' => 'server_health', 'uses' => 'WabotServiceController@serverHealthHandler'
    ]);
});
