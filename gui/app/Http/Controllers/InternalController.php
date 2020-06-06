<?php

namespace App\Http\Controllers;

use App\Engine\Engine;
use Illuminate\Http\Request;

class InternalController extends Controller
{
    public function main(Request $request)
    {
        return view('internal.main');
    }

    public function service(Request $request)
    {
        return view('internal.service');
    }

    public function newService(Request $request)
    {
        return view('internal.form_create_service', [
            'step' => $request->step
        ]);
    }

    public function validateHandler(Request $request)
    {
        $phone = Engine::escapePhoneNumber(request()->phone);
        return [
            'info' => ($phone != false),
            'phone' => $phone,
            'message' => ($phone == false) ? 'Invalid phone number' : null
        ];
    }
}
