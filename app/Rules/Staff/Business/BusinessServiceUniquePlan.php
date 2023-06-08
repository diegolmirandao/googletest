<?php

namespace App\Rules\Staff\Business;

use Illuminate\Contracts\Validation\Rule;

class BusinessServiceUniquePlan implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param  \App\Models\Business\Business  $business
     * @return void
     */
    public function __construct($business)
    {
        $this->business = $business;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Solo puede haber un plan al que pueda estar suscripta la empresa simultaneamente';
    }
}
