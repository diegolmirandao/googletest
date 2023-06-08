<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddressRequest extends FormRequest
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
            case 'customers.addresses.store':
                $rules = $this->store();
                break;
            case 'customers.addresses.update':
                $rules = $this->update();
                break;
            case 'customers.addresses.destroy':
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
            'zone_id' => [
                'required', 
                'integer',
                'exists:zones,id'
            ],
            'name' => [
                'required', 
                'string',
            ],
            'phone' => [
                'nullable', 
                'string'
            ],
            'address' => [
                'required', 
                'string'
            ],
            'reference' => [
                'nullable', 
                'string'
            ],
            'lat' => [
                'nullable', 
                'numeric'
            ],
            'lng' => [
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
            'zone_id' => [
                'required', 
                'integer',
                'exists:zones,id'
            ],
            'name' => [
                'required', 
                'string',
            ],
            'phone' => [
                'nullable', 
                'string'
            ],
            'address' => [
                'nullable', 
                'string'
            ],
            'reference' => [
                'nullable', 
                'string'
            ],
            'lat' => [
                'nullable', 
                'numeric'
            ],
            'lng' => [
                'nullable', 
                'numeric',
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
