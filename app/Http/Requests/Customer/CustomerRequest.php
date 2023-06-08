<?php

namespace App\Http\Requests\Customer;

use App\Rules\Customer\CustomerNotUsed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
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
        if ($this->route()->getName() !== 'customers.store') {
            $customer = $this->route('customer');
            $this->merge(['customer' => $customer]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'customers.store':
                $rules = $this->store();
                break;
            case 'customers.update':
                $rules = $this->update();
                break;
            case 'customers.destroy':
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
            'customer_category_id' => [
                'required', 
                'integer',
                'exists:customer_categories,id'
            ],
            'acquisition_channel_id' => [
                'required', 
                'integer',
                'exists:acquisition_channels,id'
            ],
            'name' => [
                'required', 
                'string',
            ],
            'identification_document' => [
                'required', 
                'string',
                'unique:customers,identification_document'
            ],
            'phones' => [
                'nullable',
                'array'
            ],
            'email' => [
                'nullable', 
                'string',
                'email'
            ],
            'birthday' => [
                'nullable',
                'date'
            ],
            'address' => [
                'nullable', 
                'string',
            ],
            'billing_addresses' => [
                'nullable',
                'array'
            ],
            'billing_addresses.*.name' => [
                'nullable',
                'string',
            ],
            'billing_addresses.*.identification_document' => [
                'nullable',
                'string',
            ],
            'billing_addresses.*.phone' => [
                'nullable',
                'string',
            ],
            'billing_addresses.*.address' => [
                'nullable',
                'string',
            ],
            'references' => [
                'nullable',
                'array'
            ],
            'references.*.name' => [
                'nullable',
                'string',
            ],
            'references.*.identification_document' => [
                'nullable',
                'string',
            ],
            'references.*.customer_reference_type_id' => [
                'required', 
                'integer',
                'exists:customer_reference_types,id'
            ],
            'references.*.phone' => [
                'nullable',
                'string',
            ],
            'references.*.email' => [
                'nullable',
                'email',
            ],
            'references.*.address' => [
                'nullable',
                'string',
            ],
            'addresses' => [
                'nullable',
                'array'
            ],
            'addresses.*.zone_id' => [
                'nullable',
                'integer',
                'exists:zones,id'
            ],
            'addresses.*.name' => [
                'nullable',
                'string',
            ],
            'addresses.*.phone' => [
                'nullable',
                'string',
            ],
            'addresses.*.address' => [
                'nullable',
                'string',
            ],
            'addresses.*.reference' => [
                'nullable',
                'string',
            ],
            'addresses.*.lat' => [
                'nullable',
                'numeric',
            ],
            'addresses.*.lng' => [
                'nullable',
                'numeric',
            ],
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
            'customer_category_id' => [
                'required', 
                'integer',
                'exists:customer_categories,id'
            ],
            'acquisition_channel_id' => [
                'required', 
                'integer',
                'exists:acquisition_channels,id'
            ],
            'name' => [
                'required', 
                'string',
            ],
            'identification_document' => [
                'required', 
                'string',
                Rule::unique('customers', 'identification_document')->ignore($this->route('customer'))
            ],
            'phones' => [
                'nullable',
                'array'
            ],
            'email' => [
                'nullable', 
                'string',
                'email'
            ],
            'birthday' => [
                'nullable',
                'date'
            ],
            'address' => [
                'nullable', 
                'string',
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
            'customer' => [
                new CustomerNotUsed
            ]
        ];
    }
}
