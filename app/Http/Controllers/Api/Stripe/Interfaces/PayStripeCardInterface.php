<?php

namespace App\Http\Controllers\Api\Stripe\Interfaces;

use Illuminate\Http\Request;

interface PayStripeCardInterface
{
    /**
     * @OA\Post(
     * path="/stripe/payment/card",
     * summary="Stripe Card Payment URL",
     * description="Stripe Card Payment URL",
     * operationId="paymentStripeCard",
     * tags={"Stripe Payment"},
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
     *              "user_id": null,
     *              "return_stripe_api_response": true,
     *              "amount": 2000,
     *              "description": "My First Test Charge",
     *              "card": {
     *                 "number": "4242424242424242",
     *                 "exp_month": "8",
     *                 "exp_year": "2028",
     *                 "cvc": "314"
     *              }
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
