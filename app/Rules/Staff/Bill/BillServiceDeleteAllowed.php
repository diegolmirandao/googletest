<?php

namespace App\Rules\Staff\Bill;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class BillServiceDeleteAllowed implements Rule, DataAwareRule
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
        $paidAmount = $this->data['bill']->paid_amount;
        $newBillAmount = 0;

        $billServicesCollection = collect($this->data['bill']->billServices);

        $billServicesCollection = $billServicesCollection->filter(function ($service) use ($value) {
            return ($service->id != $value->id) && ($service->service_price_id != $value->service_price_id);
        });

        $newBillAmount = $billServicesCollection->sum(function ($service) {
            return $service->servicePrice->amount * $service->quantity;
        });

        if ($newBillAmount < $paidAmount) {
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
        return 'Los montos pagados superan al monto que quedaría al eliminar el servicio.';
    }
}
