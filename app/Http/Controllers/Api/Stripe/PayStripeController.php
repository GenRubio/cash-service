<?php

namespace App\Http\Controllers\Api\Stripe;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Stripe\Interfaces\PayStripeControllerInterface;

class PayStripeController extends Controller implements PayStripeControllerInterface
{
    public function index(Request $request)
    {
        try {
            $request = getJsonDataValues($request);
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 200);
        }
    }
}
