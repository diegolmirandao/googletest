<?php

namespace App\Rules\Staff\Service;

use Illuminate\Contracts\Validation\Rule;

class ServiceDeleteAllowed implements Rule
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
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value->prices()->with('businessServicePrices')->get()->pluck('businessServicePrices')->flatten()->isNotEmpty()) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Una o mas empresas cuentan con este servicio';
    }
}
