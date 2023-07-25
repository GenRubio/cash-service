<?php

namespace App\Http\Controllers\Api\Stripe\Coupons;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Tasks\Stripe\Coupons\CreateCouponStripeTask;
use App\Http\Controllers\Api\Stripe\Coupons\Interfaces\CreateStripeCouponsInterface;

class CreateStripeCouponsController extends Controller implements CreateStripeCouponsInterface
{
    public function index(Request $request)
    {
        try {
            $request = getJsonDataValues($request);
            foreach ($request['coupons'] as $coupon) {
                (new CreateCouponStripeTask($coupon))->run();
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
