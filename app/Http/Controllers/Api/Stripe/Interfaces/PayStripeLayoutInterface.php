<?php

namespace App\Http\Controllers\Api\Stripe\Interfaces;

use Illuminate\Http\Request;

interface PayStripeLayoutInterface
{
    /**
     * @OA\Post(
     * path="/stripe/payment/stripe-layout",
     * summary="Stripe Layout Payment URL",
     * description="Stripe Layout Payment URL",
     * operationId="paymentStripeLayout",
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
     *                   "discounts": {{
     *                     "coupon": "Z5ixjx9g",
     *                   }},
     *                   "allow_promotion_codes": true,
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
     *                   "success_url": "https://example.com/success/token_238423747824734",
     *                   "cancel_url": "https://example.com/cancel/token_238423747824734", 
     *               }
     *            }
     *       ),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Results limit exceeded",
     *    @OA\JsonContent(
     *       @OA\Property(
     *           property="message", 
     *           type="string", 
     *           example={
     *              "error": false,
     *              "data": {
     *                "retrieve_stripe_id": "cs_test_b1ffhNZvf421f42qKxUrtigMyJjTN5U4juXtAviJJbmJyoujCArrmliLkn",
     *                "payment_url": "https://checkout.stripe.com/c/pay/cs_test_b1ffhNZvf421f42qKxUrtigMyJjTN5U4juXtAviJJbmJyoujCArrmliLkn#fidkdWxOYHwnPyd1blpxYHZxWjA0SE1uNjFHTnFST01HRExTbj1pdklUVXJuTjBwdENkQGNOQGphYmJQd11xM2FkbG5ncWBRSTZIdk08MH1uQDRDPU1pSDZKdHBAcnNmblV8cGZWZ203UGRHNTViVV1sTH9dTCcpJ2N3amhWYHdzYHcnP3F3cGApJ2lkfGpwcVF8dWAnPydocGlxbFpscWBoJyknYGtkZ2lgVWlkZmBtamlhYHd2Jz9xd3BgeCUl"
     *              }
     *            }
     *          )
     *        )
     *     )
     * )
     *
     */
    public function index(Request $request);
}
