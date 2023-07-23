<?php

namespace App\Validators\Stripe;

use Stripe\Coupon;
use Stripe\Stripe;
use App\Exceptions\GenericException;
use App\Services\StripeCouponService;

class ValidateCouponStripeLayout
{
    public static function validate($discounts)
    {
        if (is_null($discounts)) {
            return;
        }
        if (count($discounts) > 1) {
            throw new GenericException('Only one discount is allowed');
        }
        if (!isset($discounts[0]['coupon'])) {
            throw new GenericException('coupon field is required');
        }
        self::validateIfCouponExists($discounts[0]['coupon']);
    }

    private static function validateIfCouponExists($couponId)
    {
        $coupon = (new StripeCouponService())->getActiveCoupon($couponId);
        if (!$coupon) {
            throw new GenericException('Coupon does not exist');
        }
        if (!$coupon->active) {
            throw new GenericException('Coupon is not active');
        }
        Stripe::setApiKey(config('services.stripe.secret_key'));
        $coupon = Coupon::retrieve($couponId);
        if ($coupon->valid) {
            throw new GenericException('Coupon is not valid');
        }
    }
}
