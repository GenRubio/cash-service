<?php

namespace App\Prepares\Stripe;

class DataCouponPreapre
{
    private $data;
    private $responseData;

    public function __construct($data)
    {
        $this->data = $data;
        $this->responseData = [];
    }

    public function prepare()
    {
        if (!empty($this->data['percent_off'])) {
            $this->responseData['percent_off'] = $this->data['percent_off'];
        } else {
            $this->responseData['amount_off'] = $this->data['amount_off'];
        }
        if (!empty($this->data['duration']) && $this->data['duration'] == 'repeating') {
            $this->responseData['duration'] = $this->data['duration'];
            $this->responseData['duration_in_months'] = $this->data['duration_in_months'];
        }
        return $this->responseData;
    }
}
