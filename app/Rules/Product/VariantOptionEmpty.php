<?php

namespace App\Rules\Product;

use Illuminate\Contracts\Validation\Rule;

class VariantOptionEmpty implements Rule
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
     * @param  mixed  $option
     * @return bool
     */
    public function passes($attribute, $option)
    {
        /**
         * Poner comprobación de que no existan productos con esa variante para poder eliminar
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
        return __('rule.product.variant_option_empty');
    }
}
