<?php

namespace App\Http\Controllers\Api\Stripe\Interfaces;

use Illuminate\Http\Request;

interface PayStripeLayoutControllerInterface
{
    /**
     * @OA\Post(
     * path="/payment/stripe/create-stripe-layout",
     * summary="Create Stripe Layout Payment URL",
     * description="Create Stripe Layout Payment URL",
     * operationId="createPaymentStripeLayout",
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
     *               "user_id": 1,
     *               "retrieve_stripe_id": null,
     *               "payment": {
     *                   "payment_method_types": {"card", "paypal"},
     *                   "shipping_options": {
     *                       {
     *                          "shipping_rate_data": {
     *                              "type": "fixed_amount",
     *                              "fixed_amount": {
     *                                  "amount": 500, 
     *                                  "currency": "eur"
     *                              },
     *                              "display_name": "Free shipping",
     *                              "delivery_estimate": {
     *                                 "minimum": {
     *                                     "unit": "business_day", 
     *                                     "value": 5
     *                                 },
     *                                 "maximum": {
     *                                     "unit": "business_day", 
     *                                     "value": 7
     *                                 },
     *                              }
     *                          },
     *                       }
     *                   },
     *                   "line_items": {
     *                       {
     *                          "price_data": {
     *                              "currency": "eur",
     *                              "product_data": {
     *                                  "name": "Product 1",
     *                              },
     *                              "unit_amount": 500,
     *                           },
     *                           "quantity": 1
     *                       }
     *                   },
     *                   "mode": "payment",
     *                   "success_url": "https://example.com/success",
     *                   "cancel_url": "https://example.com/cancel", 
     *               }
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
