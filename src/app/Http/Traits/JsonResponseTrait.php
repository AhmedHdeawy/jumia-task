<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait JsonResponseTrait
{
    // Return Structured API Json Response
    public function successJsonResponse($status, $message = null, $data = null): JsonResponse
    {
        return response()->json([
            'status'        => $status,
            'message'       => $message,
            'data'          => $data
        ]);
    }


    // Return Structured API Json Response
    public function errorJsonResponse($status = 400, $message = null, $errors = null, $data = null): JsonResponse
    {
        return response()->json([
            'status'        => $status,
            'message'       => $message,
            'errors'        => $errors,
            'data'          => $data
        ]);
    }
}
