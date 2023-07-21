<?php

namespace App\Http\Controllers\Api\Stripe;

use Exception;
use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;

class PayStripeCardController extends Controller
{
    public function index(Request $request)
    {
        try {
            $request = getJsonDataValues($request);
            Stripe::setApiKey(config('services.stripe.secret_key'));
            
            return response()->json([
                'error' => false,
                'data' => [
                    
                ]
            ], 200);
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 200);
        }
    }
}
