<?php

namespace App\Rules\Product;

use Illuminate\Contracts\Validation\Rule;

class ProductCategoryEmpty implements Rule
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
         * Poner comprobación de que no existan productos con esa categorua para poder eliminar
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
        return __('rule.product.product_category_empty');
    }
}
