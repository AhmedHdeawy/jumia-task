<?php

namespace App\Http\Controllers\Api\V1;

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
        return response()->json([], 200);
    }
}