<?php

namespace App\Repositories\StripeCoupon;

use App\Models\StripeCoupon;
use App\Repositories\Repository;

/**
 * Class StripeCouponRepository
 * @package App\Repositories\StripeCoupon
 */
class StripeCouponRepository extends Repository implements StripeCouponRepositoryInterface
{
    /**
     * @var int Limit for retrieve data
     */
    protected $limit;

    /**
     * @var int defaultTtl for cache
     */
    protected $defaultTtl;

    /**
     * @var stripeCoupon
     */
    protected $model;

    /**
     * StripeCouponRepository constructor.
     */
    public function __construct()
    {
        $this->model = new StripeCoupon();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getActiveCoupons()
    {
        return $this->model->active()->get();
    }

    public function getActiveCoupon($couponId)
    {
        return $this->model->coupon($couponId)->active()->first();
    }

    public function create($coupon)
    {
        return $this->model->create($coupon);
    }

    public function deleteByCouponId($couponId)
    {
        return $this->model->coupon($couponId)->delete();
    }

    public function search($request)
    {
        return $this->model->couponSearch($request['coupon_id'])
            ->percentOffSearch($request['percent_off']['min'], $request['percent_off']['max'])
            ->amountOffSearch($request['amount_off']['min'], $request['amount_off']['max'])
            ->durationSearch($request['duration']['min'], $request['duration']['max'])
            ->durationInMonthsSearch($request['duration_in_months']['min'], $request['duration_in_months']['max'])
            ->activeSearch($request['active']['active_true'], $request['active']['active_false'])
            ->get();
    }
}
