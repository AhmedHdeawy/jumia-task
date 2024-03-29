<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Traits\JsonResponseTrait;
use App\Http\Resources\CustomerResource;
use App\Repositories\CustomerRepositiory;

class ApiController extends Controller
{
    use JsonResponseTrait;

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
        
        return $this->successJsonResponse(200, "Data Returned Successfully", $response);
    }


    /**
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function countriesList(Request $request)
    {
        $countriesCode = config('countries.codes');
        
        return $this->successJsonResponse(200, "Data Returned Successfully", $countriesCode);
    }
}