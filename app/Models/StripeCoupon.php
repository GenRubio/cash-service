<?php

namespace App\Models;

use Stripe\Stripe;
use Stripe\StripeClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StripeCoupon extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'stripe_coupons';
    //protected $primaryKey = 'id';
    //public $timestamps = true;
    // protected $guarded = ['id'];

    protected $fillable = [
        'coupon_id',
        'percent_off',
        'amount_off',
        'duration',
        'duration_in_months',
        'active',
    ];

    // protected $hidden = [];
    // protected $dates = [];
    // protected $translatable = [];
    // protected $casts = [];


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function stripeDataAPI()
    {
        Stripe::setApiKey(config('services.stripe.secret_key'));
        $client = new StripeClient(config('services.stripe.secret_key'));
        return $client->coupons->retrieve($this->attributes['coupon_id']);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeCoupon($query, $couponId)
    {
        return $query->where('coupon_id', $couponId);
    }

    public function scopeCouponSearch($query, $couponId)
    {
        if (!empty($couponId)) {
            return $query->where('coupon_id', $couponId);
        }
    }

    public function scopePercentOffSearch($query, $min, $max)
    {
        $field = $this->table . '.percent_off';
        if (!empty($min) && !empty($max)) {
            return $query->whereBetween($field, [$min, $max]);
        } else if (!empty($min)) {
            return $query->where($field, '>=', $min);
        } else if (!empty($max)) {
            return $query->where($field, '<=', $max);
        }
    }

    public function scopeAmountOffSearch($query, $min, $max)
    {
        $field = $this->table . '.amount_off';
        if (!empty($min) && !empty($max)) {
            return $query->whereBetween($field, [$min, $max]);
        } else if (!empty($min)) {
            return $query->where($field, '>=', $min);
        } else if (!empty($max)) {
            return $query->where($field, '<=', $max);
        }
    }

    public function scopeDurationSearch($query, $min, $max)
    {
        $field = $this->table . '.duration';
        if (!empty($min) && !empty($max)) {
            return $query->whereBetween($field, [$min, $max]);
        } else if (!empty($min)) {
            return $query->where($field, '>=', $min);
        } else if (!empty($max)) {
            return $query->where($field, '<=', $max);
        }
    }

    public function scopeDurationInMonthsSearch($query, $min, $max)
    {
        $field = $this->table . '.duration_in_months';
        if (!empty($min) && !empty($max)) {
            return $query->whereBetween($field, [$min, $max]);
        } else if (!empty($min)) {
            return $query->where($field, '>=', $min);
        } else if (!empty($max)) {
            return $query->where($field, '<=', $max);
        }
    }

    public function scopeActiveSearch($query, $activeTrue, $activeFalse)
    {
        $field = $this->table . '.active';
        if (!empty($activeTrue) && !empty($activeFalse)) {
            return $query->where($field, true)
                ->orWhere($field, false);
        } else if (!empty($activeTrue)) {
            return $query->where($field, true);
        } else if (!empty($activeFalse)) {
            return $query->where($field, false);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
