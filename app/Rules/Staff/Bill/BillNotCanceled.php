<?php

namespace App\Rules\Staff\Bill;

use Illuminate\Contracts\Validation\Rule;

class BillNotCanceled implements Rule
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
     * @param  \App\Models\Bill  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value) {
            return !$value->isCanceled();
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
        return 'La factura se encuentra anulada';
    }
}
