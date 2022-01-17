<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function phoneNumbersList(Request $request)
    {
        return response()->json([], 200);
    }
}
