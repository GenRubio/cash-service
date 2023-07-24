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
        return $this->model->active()->where('coupon_id', $couponId)->first();
    }

    public function create($coupon)
    {
        return $this->model->create($coupon);
    }

    public function deleteByCouponId($couponId)
    {
        return $this->model->where('coupon_id', $couponId)->delete();
    }
}
