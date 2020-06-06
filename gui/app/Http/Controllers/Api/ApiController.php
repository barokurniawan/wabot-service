<?php

namespace App\Http\Controllers\Api;

use App\Engine\Engine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function messageHandler(Request $request)
    {
    }

    public function mediaHandler(Request $request)
    {
    }

    public function qrcodeHandler(Request $request)
    {
        if (empty($request->phone)) {
            return [
                'info' => false,
                'message' => 'phone number is required'
            ];
        }

        $engine = Engine::getInstance();
        $response = $engine->getQRCode($request->phone);

        return (array) $response;
    }

    public function deviceHandler(Request $request)
    {
        if (empty($request->phone)) {
            return [
                'info' => false,
                'message' => 'phone number is required'
            ];
        }

        $engine = Engine::getInstance();
        $response = $engine->getDeviceInfo($request->phone);

        return (array) $response;
    }

    public function healthHandler(Request $request)
    {
    }

    public function registrationHandler(Request $request)
    {
        if (empty($request->phone)) {
            return [
                'info' => false,
                'message' => 'phone number is required'
            ];
        }

        $engine = Engine::getInstance();
        $response = $engine->clientRegistration($request->phone);

        return (array) $response;
    }

    public function listUserHandler(Request $request)
    {
        $engine = Engine::getInstance();
        $response = $engine->fetchConnectedUsers();

        return (array) $response;
    }
}
