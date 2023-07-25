<?php

namespace App\Tasks\Stripe\Coupons;

use Stripe\Stripe;
use Stripe\StripeClient;
use App\Services\StripeCouponService;
use App\Prepares\Stripe\DataCouponPreapre;
use App\Validators\Stripe\CreateDataCouponStripeValidate;

class CreateCouponStripeTask
{
    private $data;
    private $client;

    public function __construct($data)
    {
        //https://stripe.com/docs/api/coupons/create?lang=php
        //https://www.thedevnerd.com/2022/07/stripe-coupons-create-coupons-in.html
        //https://stripe.com/docs/payments/checkout/discounts
        Stripe::setApiKey(config('services.stripe.secret_key'));
        $this->data = $data;
        $this->client = new StripeClient(config('services.stripe.secret_key'));;
    }

    public function run()
    {
        $this->validate();
        $couponStripe = $this->createStripeCoupon();
        $this->createCoupon($couponStripe);
    }

    private function validate()
    {
        CreateDataCouponStripeValidate::validate($this->data);
    }

    private function createStripeCoupon()
    {
        $dataCouponPrepare = (new DataCouponPreapre($this->data))->prepare();
        return $this->client->coupons->create($dataCouponPrepare);
    }

    private function createCoupon($couponStripe)
    {
        $this->data['coupon_id'] = $couponStripe->id;
        (new StripeCouponService())->create($this->data);
    }
}
