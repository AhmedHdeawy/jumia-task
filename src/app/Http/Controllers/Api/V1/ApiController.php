<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use App\Http\Resources\CustomerResource;
use App\Repositories\CustomerRepositiory;

class ApiController extends Controller
{
    public $customerRepositiory;

    public function __construct(CustomerRepositiory $customerRepositiory)
    {
        $this->customerRepositiory = $customerRepositiory;
    }

    /**
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function phoneNumbersList(Request $request)
    {
        $data = $request->only(['country', 'state', 'perPage', 'page']);
        
        $customers = $this->customerRepositiory->search($data);

        $response = $this->paginate(CustomerResource::collection($customers));
        
        return response()->json($response, 200);
    }
}