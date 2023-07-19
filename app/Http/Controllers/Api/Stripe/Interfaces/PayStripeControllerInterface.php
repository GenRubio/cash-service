<?php

namespace App\Http\Controllers\Api\Stripe\Interfaces;

use Illuminate\Http\Request;

interface PayStripeControllerInterface
{
    /**
     * @OA\Post(
     * path="/payment/stripe/create",
     * summary="Create Stripe Payment URL",
     * description="Create Stripe Payment URL",
     * operationId="createPaymentStripe",
     * tags={"API"},
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
     *               "selected": {}
     *            }
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
