<?php

namespace App\Http\Controllers\Api\Stripe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Stripe\Interfaces\PayStripeControllerInterface;

class PayStripeController extends Controller implements PayStripeControllerInterface
{
    public function index(Request $request) 
    {
        return response()->json([
            'message' => 'Stripe Payment URL created successfully'
        ]);
    }
}
