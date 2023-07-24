<?php

namespace App\Http\Controllers\Api\Stripe\Coupons\Interfaces;

use Illuminate\Http\Request;

interface DeleteStripeCouponsInterface
{
    /**
     * @OA\Post(
     * path="/stripe/coupons/delete",
     * summary="Delete Stripe Coupons",
     * description="Delete Stripe Coupons",
     * operationId="deleteStripeCoupons",
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
     *              "coupon_id": "Z5ixjx9g"
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
