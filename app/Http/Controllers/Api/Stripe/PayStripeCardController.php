<?php

namespace App\Http\Controllers\Api\Stripe;

use Exception;
use Stripe\Stripe;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Stripe\Interfaces\PayStripeCardControllerInterface;

class PayStripeCardController extends Controller implements PayStripeCardControllerInterface
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
            return response()->json([
                'error' => false,
                'data' => [
                    'status' => $responsePayment->status,
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
