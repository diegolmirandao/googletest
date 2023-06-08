<?php

namespace App\Rules\Staff\Bill;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class BillServicePriceNotRepeated implements Rule, DataAwareRule
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
        if ($this->data['bill']) {
            if($value) {
                // BillService Request
                $billServicesCollection = collect($this->data['bill']->billServices);
    
                if ($this->data['service']) {
                    if (($this->data['service']->business_service_price_id != $value->id) && ($billServicesCollection->contains('business_service_price_id', $value->id))) {
                        return false;
                    }
                } else {
                    if ($billServicesCollection->contains('business_service_price_id', $value->id)) {
                        return false;
                    }
                }
            }

            return true;
        } else {
            // Bill Request
            $servicesCollection = collect($this->data['services']);

            if ($servicesCollection->count() > $servicesCollection->unique('business_service_price_id')->count()) {
                return false;
            }
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
        return 'El servicio ya fue cargado en la factura';
    }
}
