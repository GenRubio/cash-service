<?php

namespace App\Services;

use App\Models\StripeCoupon;
use App\Http\Controllers\Controller;
use App\Http\Resources\StripeCouponResource;
use App\Repositories\StripeCoupon\StripeCouponRepository;
use App\Repositories\StripeCoupon\StripeCouponRepositoryInterface;

/**
 * Class StripeCouponService
 * @package App\Services\StripeCoupon
 */
class StripeCouponService extends Controller
{
    private $stripecouponRepository;

    /**
     * StripeCouponService constructor.
     * @param StripeCoupon $stripecoupon
     * @param StripeCouponRepositoryInterface $stripecouponRepository
     */
    public function __construct()
    {
        $this->stripecouponRepository = new StripeCouponRepository();
    }

    public function getActiveCoupons()
    {
        return $this->stripecouponRepository->getActiveCoupons();
    }

    public function getActiveCoupon($couponId)
    {
        return $this->stripecouponRepository->getActiveCoupon($couponId);
    }

    public function create($coupon)
    {
        return $this->stripecouponRepository->create($coupon);
    }

    public function deleteByCouponId($couponId)
    {
        return $this->stripecouponRepository->deleteByCouponId($couponId);
    }

    public function search($request)
    {
        $coupons = $this->stripecouponRepository->search($request);
        return StripeCouponResource::collection($coupons);
    }
}
