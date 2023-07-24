<?php

namespace App\Http\Controllers\Api\Stripe\Coupons\Interfaces;

use Illuminate\Http\Request;

interface GetStripeCouponsInterface
{
    /**
     * @OA\Post(
     * path="/stripe/coupons/get",
     * summary="Get Stripe Coupons",
     * description="Get Stripe Coupons",
     * operationId="getStripeCoupons",
     * tags={"Stripe Coupons"},
     * security={
     *   {"passport": {}},
     * },
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass filters for invoices",
     *    @OA\JsonContent(
     *       required={"_data"},
     *       @OA\Property(
     *           property="_data",
     *           type="object",
     *           example={
     *              "coupon_id": "Z5ixjx9g",
     *              "return_stripe_api_response": true,
     *              "percent_off": {
     *                 "min": null,
     *                 "max": null
     *              },
     *              "amount_off": {
     *                 "min": null,
     *                 "max": null
     *              },
     *              "duration": {
     *                 "min": null,
     *                 "max": null
     *              },
     *              "duration_in_months": {
     *                 "min": null,
     *                 "max": null
     *              },
     *              "active": {
     *                "active_true": true,
     *                "active_false": true
     *              },
     *           }
     *       ),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Results limit exceeded",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="")
     *        )
     *     )
     * )
     *
     */
    public function index(Request $request);
}
