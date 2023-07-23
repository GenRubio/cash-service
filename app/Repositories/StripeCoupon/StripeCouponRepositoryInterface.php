<?php

namespace App\Repositories\StripeCoupon;

/**
 * Interface StripeCouponRepositoryInterface
 * @package App\Repositories\StripeCoupon
 */
interface StripeCouponRepositoryInterface
{
    public function getActiveCoupons();
    public function getActiveCoupon($couponId);
    public function create($coupon);
}
