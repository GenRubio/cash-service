<?php

namespace App\Http\Controllers\Api\Stripe\Coupons;

use Exception;
use Stripe\Stripe;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Services\StripeCouponService;

class CreateStripeCouponsController extends Controller
{
    public function index(Request $request)
    {
        //https://stripe.com/docs/api/coupons/create?lang=php
        //https://www.thedevnerd.com/2022/07/stripe-coupons-create-coupons-in.html
        //https://stripe.com/docs/payments/checkout/discounts
        try {
            $request = getJsonDataValues($request);
            Stripe::setApiKey(config('services.stripe.secret_key'));
            $client = new StripeClient(config('services.stripe.secret_key'));
            foreach ($request['coupons'] as $coupon) {
                $couponStripe = $client->coupons->create($coupon);
                $coupon['coupon_id'] = $couponStripe->id;
                (new StripeCouponService())->create($coupon);
            }
            return response()->json([
                'error' => false,
                'data' => [
                    'message' => 'Coupons created successfully'
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