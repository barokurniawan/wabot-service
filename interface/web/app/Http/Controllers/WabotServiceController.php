<?php

namespace App\Http\Controllers;

use App\Engine\Engine;
use Illuminate\Http\Request;
use App\Jobs\SendTextMessage;
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
            'status' => 'Added to queue'
        ];
    }
}
