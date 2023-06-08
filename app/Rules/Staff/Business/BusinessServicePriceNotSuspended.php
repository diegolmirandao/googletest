<?php

namespace App\Rules\Staff\Business;

use Illuminate\Contracts\Validation\Rule;

class BusinessServicePriceNotSuspended implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  \App\Models\BusinessServicePrice  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value) {
            return !$value->isSuspended();
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El servicio se encuentra en estado suspendido';
    }
}
