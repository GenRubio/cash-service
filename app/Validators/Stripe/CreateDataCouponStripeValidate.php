<?php

namespace App\Validators\Stripe;

use App\Exceptions\GenericException;
use Illuminate\Support\Facades\Validator;

class CreateDataCouponStripeValidate
{
    public static function validate($data)
    {
        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255', 'unique:stripe_coupons,title'],
            'percent_off' => ['nullable', 'numeric', 'min:1', 'max:100'],
            'amount_off' => ['required_if:percent_off,null', 'nullable', 'numeric', 'min:1'],
            'duration' => ['required', 'string', 'in:once,repeating,forever'],
            'duration_in_months' => ['required_if:duration,repeating', 'nullable', 'integer'],
        ], [
            'title.unique' => 'The title has already been taken.',
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'percent_off.numeric' => 'The percent off must be a number.',
            'percent_off.min' => 'The percent off must be at least 1.',
            'percent_off.max' => 'The percent off may not be greater than 100.',
            'amount_off.required_if' => 'The amount off field is required when percent off is null.',
            'amount_off.numeric' => 'The amount off must be a number.',
            'amount_off.min' => 'The amount off must be at least 1.',
            'duration.required' => 'The duration field is required.',
            'duration.string' => 'The duration must be a string.',
            'duration.in' => 'The selected duration is invalid. Must be one of: once, repeating, forever.',
            'duration_in_months.required_if' => 'The duration in months field is required when duration is repeating.',
            'duration_in_months.integer' => 'The duration in months must be an integer.',
        ]);

        if ($validator->fails()) {
            $errorsString = "";
            foreach ($validator->errors()->all() as $error) {
                $errorsString .= $error . "\n";
            }
            throw new GenericException($errorsString);
        }
    }
}
