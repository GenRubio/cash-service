<?php

namespace App\Http\Controllers\Api\Stripe;

use Exception;
use Stripe\Stripe;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Stripe\Interfaces\PayStripeCardInterface;

class PayStripeCardController extends Controller implements PayStripeCardInterface
{
    public function index(Request $request)
    {
        try {
            $request = getJsonDataValues($request);
            Stripe::setApiKey(config('services.stripe.secret_key'));
            $client = new StripeClient(config('services.stripe.secret_key'));
            $token = $client->tokens->create([
                'card' => $request['card'],
            ]);
            $responsePayment = $client->charges->create([
                'amount' => $request['amount'],
                'currency' => config('services.stripe.currency'),
                'source' => $token->id,
                'description' => $request['description'],
            ]);

            $responseData = [];
            $responseData['status'] = $responsePayment->status;
            if ($request['return_stripe_api_response']) {
                $responseData['stripe_api_response'] = $responsePayment;
            }
            return response()->json([
                'error' => false,
                'data' => $responseData
            ], 200);
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 200);
        }
    }
}
