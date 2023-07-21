<?php

namespace App\Http\Controllers\Api\Stripe;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Http\Controllers\Api\Stripe\Interfaces\PayStripeControllerInterface;

class PayStripeController extends Controller implements PayStripeControllerInterface
{
    public function index(Request $request)
    {
        try {
            $request = getJsonDataValues($request);
            Stripe::setApiKey(config('services.stripe.secret_key'));
            if ($request['retrieve_stripe_id']) {
                $session = Session::retrieve($request['retrieve_stripe_id']);
            } else {
                $session = Session::create([$request['payment']]);
            }
            return response()->json([
                'error' => false,
                'data' => [
                    'retrieve_stripe_id' => $session->id,
                    'payment_url' => $session->url
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
