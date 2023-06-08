<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerBillingAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'customers.billing-addresses.store':
                $rules = $this->store();
                break;
            case 'customers.billing-addresses.update':
                $rules = $this->update();
                break;
            case 'customers.billing-addresses.destroy':
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
            ],
            'identification_document' => [
                'required', 
                'string'
            ],
            'phone' => [
                'nullable', 
                'string'
            ],
            'address' => [
                'nullable', 
                'string',
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
            'name' => [
                'required', 
                'string',
            ],
            'identification_document' => [
                'required', 
                'string'
            ],
            'phone' => [
                'nullable', 
                'string'
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
            //
        ];
    }
}
