<?php

namespace App\Tasks\Stripe\Coupons;

use Stripe\Stripe;
use Stripe\StripeClient;
use App\Exceptions\GenericException;
use App\Services\StripeCouponService;

class DeleteCouponStripeTask
{
    private $couponId;
    private $client;

    public function __construct($couponId)
    {
        Stripe::setApiKey(config('services.stripe.secret_key'));
        $this->couponId = $couponId;
        $this->client = new StripeClient(config('services.stripe.secret_key'));;
    }

    public function run()
    {
        $this->validate();
        $this->deleteStripeCoupon();
        $this->deleteCoupon();
    }

    private function validate()
    {
        $coupon = (new StripeCouponService())->getActiveCoupon($this->couponId);
        if (!$coupon) {
            throw new GenericException('Coupon not found');
        }
    }

    private function deleteStripeCoupon()
    {
        $this->client->coupons->delete($this->couponId);
    }

    private function deleteCoupon()
    {
        (new StripeCouponService())->deleteByCouponId($this->couponId);
    }
}
