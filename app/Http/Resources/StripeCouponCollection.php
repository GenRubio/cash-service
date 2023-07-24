<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StripeCouponCollection extends ResourceCollection
{
    public $extra;

    public function __construct($resource, $extraData = [])
    {
        parent::__construct($resource);
        $this->extra = $extraData;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($n) {
            return new StripeCouponResource($n, $this->extra);
        })->toArray();
    }
}
