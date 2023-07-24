<?php

namespace App\Http\Controllers\Api\Stripe\Coupons;

use Exception;
use Stripe\Stripe;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Services\StripeCouponService;
use App\Http\Controllers\Api\Stripe\Coupons\Interfaces\DeleteStripeCouponsInterface;

class DeleteStripeCouponsController extends Controller implements DeleteStripeCouponsInterface
{
    public function index(Request $request)
    {
        try {
            $request = getJsonDataValues($request);
            Stripe::setApiKey(config('services.stripe.secret_key'));

            $couponId = $request['coupon_id'];
            $coupon = (new StripeCouponService())->getActiveCoupon($couponId);
            if (!$coupon) {
                throw new GenericException('Coupon not found');
            }
            (new StripeCouponService())->deleteByCouponId($couponId);
            $client = new StripeClient(config('services.stripe.secret_key'));
            $client->coupons->delete($couponId);
            return response()->json([
                'error' => false,
                'data' => [
                    'message' => 'Coupons deleted successfully'
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
