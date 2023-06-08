<?php

namespace App\Rules\Product;

use Illuminate\Contracts\Validation\Rule;

class ProductCostTypeNotUsed implements Rule
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
         * Poner comprobación de que no existan productos facturados en ventas o compras o cualquier tipo de registros
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
        return __('rule.product.product_cost_type_not_used');
    }
}
