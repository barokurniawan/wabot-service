<?php

namespace App\Http\Controllers\Api;

use App\Engine\Engine;
use App\Engine\MessageArgs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function messageHandler(Request $request)
    {
        if (empty($request->phone)) {
            return [
                'info' => false,
                'message' => 'phone number is required'
            ];
        }

        if (empty($request->message)) {
            return [
                'info' => false,
                'message' => 'Message is required'
            ];
        }

        if (empty($request->cl)) {
            return [
                'info' => false,
                'message' => 'cl is required'
            ];
        }

        $messageArgs = new MessageArgs(
            $request->cl,
            $request->phone,
            $request->message
        );

        $engine = Engine::getInstance();
        $response = $engine->sendMessage($messageArgs);

        return (array) $response;
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
