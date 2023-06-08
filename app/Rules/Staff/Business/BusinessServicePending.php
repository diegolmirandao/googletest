<?php

namespace App\Rules\Staff\Business;

use Illuminate\Contracts\Validation\Rule;

class BusinessServicePending implements Rule
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
     * @param  \App\Models\BusinessService  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value) {
            return $value->isPending();
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
        return 'El servicio no se encuentra en estado pendiente';
    }
}
