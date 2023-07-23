<?php

namespace App\Http\Controllers\Api\Stripe;

use Exception;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Validators\Stripe\ValidateCouponStripeLayout;
use App\Http\Controllers\Api\Stripe\Interfaces\PayStripeLayoutInterface;

class PayStripeLayoutController extends Controller implements PayStripeLayoutInterface
{
    public function index(Request $request)
    {
        try {
            $request = getJsonDataValues($request);
            ValidateCouponStripeLayout::validate($request['payment']['discounts'] ?? null);
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
