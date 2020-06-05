<?php

namespace App\Http\Controllers;

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
        return view('internal.form_create_service');
    }
}
