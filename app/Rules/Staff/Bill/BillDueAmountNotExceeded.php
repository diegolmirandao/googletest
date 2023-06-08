<?php

namespace App\Rules\Staff\Bill;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class BillDueAmountNotExceeded implements Rule, DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
 
        return $this;
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
        $dueAmount = $this->data['bill']->amount;
        foreach ($this->data['bill']->payments as $payment) {
            $dueAmount -= (isset($this->data['payment']) and $this->data['payment']->id == $payment->id) ? 0 : $payment->amount;
        }
        return $dueAmount >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El monto ingresado excede el saldo de la factura';
    }
}
