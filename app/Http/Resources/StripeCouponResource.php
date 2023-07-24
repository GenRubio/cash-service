<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StripeCouponResource extends JsonResource
{
    public $extra;

    public function __construct($resource, $extraData = [])
    {
        parent::__construct($resource);
        $this->extra = $extraData;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'coupon_id' => $this->coupon_id,
            'title' => $this->title,
            'percent_off' => $this->percent_off,
            'amount_off' => $this->amount_off,
            'duration' => $this->duration,
            'duration_in_months' => $this->duration_in_months,
            'active' => $this->active,
            'stripe_api_response' => $this->extra['return_stripe_api_response'] ? $this->stripeDataAPI() : [],
        ];
    }
}
