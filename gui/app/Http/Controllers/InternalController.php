<?php

namespace App\Http\Controllers;

use App\Engine\Engine;
use App\Models\Service;
use App\Lib\QueryFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (!empty($request->step) && $request->step > 1 && empty($request->cl)) {
            return route('internal_service_new');
        }

        return view('internal.form_create_service', [
            'step' => $request->step,
            'client_phone' => $request->cl,
            'userID' => Auth::user()->id
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

    public function serviceShowlistHandler(Request $request)
    {
        $request->validate([
            "draw" => "required"
        ]);

        $userID = Auth::user()->id;
        $filter = QueryFilter::getInstance();
        $output = [
            "draw"            => $request->draw,
            "search"          => $request->search['value'],
            "recordsTotal"    => 0,
            "recordsFiltered" => 0,
            "data"            => []
        ];

        $filter->setOffset($request->start);
        $filter->setLimit($request->length);
        $filter->setSearch($output['search']);

        $service = Service::getInstance();
        $nomor = $request->start;
        foreach ($service->advanceShowList($userID, $filter) as $item) {
            $nomor++;

            $item = $item->toArray();
            $item['no'] = $nomor;
            $item['sum_message_text'] = 0;
            $item['sum_message_media'] = 0;
            array_push($output['data'], $item);
        }

        $output['recordsTotal'] = $output['recordsFiltered'] = $service->countRows($userID, $filter);
        return $output;
    }
}
