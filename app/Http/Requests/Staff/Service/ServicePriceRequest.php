<?php

namespace App\Http\Requests\Staff\Service;

use App\Rules\Staff\Service\ServicePriceDeleteAllowed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServicePriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge(['price' => $this->route('price')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'services.prices.store':
                $rules = $this->store();
                break;
            case 'services.prices.update':
                $rules = $this->update();
                break;
            case 'services.prices.destroy':
                $rules = $this->destroy();
                break;
        }

        return $rules;
    }

    /**
     * Get the validation rules that apply to the post request.
     *
     * @return array
     */
    public function store()
    {
        return [
            'service_price_type_id' => [
                'required', 
                'integer', 
                'exists:service_price_types,id'
            ],
            'currency_id' => [
                'required', 
                'integer', 
                'exists:currencies,id'
            ],
            'billing_cycle_id' => [
                'required', 
                'integer', 
                'exists:billing_cycles,id'
            ],
            'amount' => [
                'required', 
                'numeric'
            ],
            'trial_period' => [
                'required', 
                'numeric', 
                'min:0'
            ],
            'trial_interval' => [
                'required', 
                Rule::in(['days', 'weeks', 'months', 'trimesters', 'semesters', 'years'])
            ],
            'grace_period' => [
                'required', 
                'numeric', 
                'min:0'
            ],
            'grace_interval' => [
                'required', 
                Rule::in(['days', 'weeks', 'months', 'trimesters', 'semesters', 'years'])
            ],
            'bill_generation_period' => [
                'required', 
                'numeric', 
                'min:0'
            ],
            'bill_generation_interval' => [
                'required', 
                Rule::in(['days', 'weeks', 'months', 'trimesters', 'semesters', 'years'])
            ]
        ];
    }

    /**
     * Get the validation rules that apply to the put/patch request.
     *
     * @return array
     */
    public function update()
    {
        return [
            'service_price_type_id' => [
                'required', 
                'integer', 
                'exists:service_price_types,id'
            ],
            'currency_id' => [
                'required', 
                'integer', 
                'exists:currencies,id'
            ],
            'billing_cycle_id' => [
                'required', 
                'integer', 
                'exists:billing_cycles,id'
            ],
            'status' => [
                'required',
                'boolean'
            ],
            'amount' => [
                'required', 
                'numeric'
            ],
            'trial_period' => [
                'required', 
                'numeric', 
                'min:0'
            ],
            'trial_interval' => [
                'required', 
                Rule::in(['days', 'weeks', 'months', 'trimesters', 'semesters', 'years'])
            ],
            'grace_period' => [
                'required', 
                'numeric', 
                'min:0'
            ],
            'grace_interval' => [
                'required', 
                Rule::in(['days', 'weeks', 'months', 'trimesters', 'semesters', 'years'])
            ],
            'bill_generation_period' => [
                'required', 
                'numeric', 
                'min:0'
            ],
            'bill_generation_interval' => [
                'required', 
                Rule::in(['days', 'weeks', 'months', 'trimesters', 'semesters', 'years'])
            ]
        ];
    }

    /**
     * Get the validation rules that apply to the delete request.
     *
     * @return array
     */
    public function destroy()
    {
        return [
            'price' => [
                new ServicePriceDeleteAllowed
            ]
        ];
    }
}
