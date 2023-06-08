<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WarehouseNotUsed implements Rule
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
        /**
         * Poner comprobación de que no cuente con ventas o compras o cualquier movimiento
         */
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('rule.warehouse_not_used');
    }
}
