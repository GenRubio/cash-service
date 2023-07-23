<?php

namespace App\Http\Controllers\Api\Stripe\Coupons\Interfaces;

use Illuminate\Http\Request;

interface CreateStripeCouponsInterface
{
    /**
     * @OA\Post(
     * path="/stripe/coupons/create",
     * summary="Create Stripe Coupons",
     * description="Create Stripe Coupons",
     * operationId="createStripeCoupons",
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
     *              "coupons": {
     *                {
     *                   "name": "Example Coupon 1",
     *                   "percent_off": 25,
     *                   "amount_off": null,
     *                   "duration": "once",
     *                   "duration_in_months": null,
     *                   "active": true,
     *               },
     *               {
     *                   "name": "Example Coupon 2",
     *                   "percent_off": null,
     *                   "amount_off": 2000,
     *                   "duration": "repeating",
     *                   "duration_in_months": 3,
     *                   "active": true,
     *               },
     *               {
     *                   "name": "Example Coupon 3",
     *                   "percent_off": 25,
     *                   "amount_off": null,
     *                   "duration": "forever",
     *                   "duration_in_months": null,
     *                   "active": true,
     *               }
     *             }
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
