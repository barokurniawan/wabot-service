<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class StrictInternalController extends Controller
{
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
