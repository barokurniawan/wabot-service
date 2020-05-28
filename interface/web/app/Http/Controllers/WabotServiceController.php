<?php

namespace App\Http\Controllers;

use App\Engine\Engine;
use Illuminate\Http\Request;
use App\Jobs\SendTextMessage;
use App\Jobs\SendMediaMessage;
use Illuminate\Support\Facades\Queue;

class WabotServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function qrcodeHandler()
    {
        $engine = Engine::getInstance();
        $response = $engine->getQRCode();

        return json_encode($response);
    }

    public function textMessageHandler(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'message' => 'required'
        ]);

        Queue::push(new SendTextMessage($request->phone, $request->message));
        return [
            'info' => true,
            'status' => 'Send to queue'
        ];
    }

    public function mediaMessageHandler(Request $request)
    {
        $this->validate($request, [
            'phone'       => 'required',
            'mime'        => 'required',
            'filename'    => 'required',
            'fileAddress' => 'required'
        ]);

        Queue::push(new SendMediaMessage(
            $request->phone,
            $request->mime,
            $request->filename,
            $request->fileAddress,
            $request->message
        ));

        return [
            'info' => true,
            'status' => 'Send to queue'
        ];
    }

    public function deviceInfoHandler(Request $request)
    {
        $engine = Engine::getInstance();
        return json_encode($engine->getDeviceInformation());
    }

    public function resetDeviceHandler(Request $request)
    {
        $engine = Engine::getInstance();
        return json_encode($engine->resetEngine());
    }

    public function serverHealthHandler(Request $request)
    {
        $engine = Engine::getInstance();
        return json_encode($engine->serverHealth());
    }
}
