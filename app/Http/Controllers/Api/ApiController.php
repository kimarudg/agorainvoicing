<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Order\Order;
use Exception;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function checkDomain(Request $request)
    {
        try {
            $result = 'fails';
            $url = $request->input('url');

            //            if (ends_with($domain, '/')) {
            //                $domain = substr_replace($domain,"", -1, 1);
            //            }

            $url_info = parse_url($url);
            $domain = $url_info['host'];

            $orders = new Order();
            $order = $orders->where('domain', $domain)->first();
            if ($order) {
                $result = 'success';
            }

            return response()->json(compact('result'));
        } catch (Exception $ex) {
            $error = $ex->getMessage();

            return response()->json(compact('error'));
        }
    }
}
