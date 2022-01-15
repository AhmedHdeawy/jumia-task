<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{

    /**
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function phoneNumbersList(Request $request)
    {
        $data = Customer::all();
        
        return response()->json($data, 200);
    }
}