<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InternalController extends Controller
{
    public function main(Request $request)
    {
        return view('internal.main');
    }
}
