<?php

namespace App\Http\Controllers\Api;

use App\Engine\Engine;
use App\Models\Service;
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

        if (empty($request->user_id)) {
            return [
                'info' => false,
                'message' => 'User id is required'
            ];
        }

        $engine = Engine::getInstance();
        $response = $engine->clientRegistration($request->phone);

        /**
         * note: register new service only when API result is only true. 
         * when user is already registered API will return false
         */
        if ($response->info) {
            $service = Service::getInstance();
            $service->registerService($request->phone, $request->user_id);
        }

        return (array) $response;
    }

    public function listUserHandler(Request $request)
    {
        $engine = Engine::getInstance();
        $response = $engine->fetchConnectedUsers();

        return (array) $response;
    }

    /**
     * Handle callback from engine when user disconect their device
     */
    public function disconectClient(Request $request)
    {
        $request->validate([
            'cl' => 'required'
        ]);

        $service = Service::getInstance();
        $service->setServiceStatus(
            $request->cl,
            Service::STATUS_DISCONNECTED
        );

        return [
            "info" => true
        ];
    }
}
