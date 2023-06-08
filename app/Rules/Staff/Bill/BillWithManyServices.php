<?php

namespace App\Rules\Staff\Bill;

use Illuminate\Contracts\Validation\Rule;

class BillWithManyServices implements Rule
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
        return $value->services()->count() > 1 ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No se puede eliminar este detalle. Por favor agregar otros y luego proceder a la eliminación.';
    }
}
