<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class SupplierAddressRequest extends FormRequest
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
            case 'suppliers.addresses.store':
                $rules = $this->store();
                break;
            case 'suppliers.addresses.update':
                $rules = $this->update();
                break;
            case 'suppliers.addresses.destroy':
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
