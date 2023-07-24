<?php

namespace App\Http\Controllers\Api\Stripe\Coupons;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Services\StripeCouponService;

class GetStripeCouponsController extends Controller
{
    public function index(Request $request){
        try {
            $request = getJsonDataValues($request);
            $coupons = (new StripeCouponService())->search($request);
            return response()->json([
                'error' => false,
                'data' => $coupons
            ], 200);
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 200);
        }
    }
}
