<?php

namespace App\Http\Requests\Staff\Service;

use App\Rules\Staff\Service\ServiceDeleteAllowed;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        $this->merge(['service' => $this->route('service')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'services.store':
                $rules = $this->store();
                break;
            case 'services.update':
                $rules = $this->update();
                break;
            case 'services.destroy':
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
            'name' => [
                'required',
                'string',
                'unique:services,name'
            ],
            'status' => [
                'required',
                'boolean'
            ],
            'comments' => [
                'nullable',
                'string'
            ],
            'prices' => [
                'required',
                'array',
                'min:1'
            ],
            'features' => [
                'required',
                'array',
                'min:1'
            ],
            'prices.*.service_price_type_id' => [
                'required', 
                'integer', 
                'exists:service_price_types,id'
            ],
            'prices.*.currency_id' => [
                'required', 
                'integer', 
                'exists:currencies,id'
            ],
            'prices.*.billing_cycle_id' => [
                'required', 
                'integer', 
                'exists:billing_cycles,id'
            ],
            'prices.*.status' => [
                'required',
                'boolean'
            ],
            'prices.*.amount' => [
                'required', 
                'numeric'
            ],
            'prices.*.trial_period' => [
                'required', 
                'numeric', 
                'min:0'
            ],
            'prices.*.trial_interval' => [
                'required', 
                Rule::in(['days', 'weeks', 'months', 'trimesters', 'semesters', 'years'])
            ],
            'prices.*.grace_period' => [
                'required', 
                'numeric', 
                'min:0'
            ],
            'prices.*.grace_interval' => [
                'required', 
                Rule::in(['days', 'weeks', 'months', 'trimesters', 'semesters', 'years'])
            ],
            'prices.*.bill_generation_period' => [
                'required', 
                'numeric', 
                'min:0'
            ],
            'prices.*.bill_generation_interval' => [
                'required', 
                Rule::in(['days', 'weeks', 'months', 'trimesters', 'semesters', 'years'])
            ],
            'features.*.feature_id' => [
                'required',
                'integer',
                'exists:features,id'
            ],
            'features.*.quantity' => [
                'required',
                'numeric',
                'min:1'
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
            'name' => [
                'required',
                'string',
                Rule::unique('services')->ignore($this->route('service')->id)
            ],
            'status' => [
                'required',
                'boolean'
            ],
            'comments' => [
                'nullable',
                'string'
            ],
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
            'service' => [
                new ServiceDeleteAllowed
            ]
        ];
    }
}
