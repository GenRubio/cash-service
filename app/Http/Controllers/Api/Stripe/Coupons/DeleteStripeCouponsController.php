<?php

namespace App\Http\Controllers\Api\Stripe\Coupons;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Tasks\Stripe\Coupons\DeleteCouponStripeTask;
use App\Http\Controllers\Api\Stripe\Coupons\Interfaces\DeleteStripeCouponsInterface;

class DeleteStripeCouponsController extends Controller implements DeleteStripeCouponsInterface
{
    public function index(Request $request)
    {
        try {
            $request = getJsonDataValues($request);

            foreach ($request['coupon_ids'] as $couponId) {
                (new DeleteCouponStripeTask($couponId))->run();
            }

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
