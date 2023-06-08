<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerReferenceRequest extends FormRequest
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
            case 'customers.references.store':
                $rules = $this->store();
                break;
            case 'customers.references.update':
                $rules = $this->update();
                break;
            case 'customers.references.destroy':
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
            'customer_reference_type_id' => [
                'required', 
                'integer',
                'exists:customer_reference_types,id'
            ],
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
            'email' => [
                'nullable', 
                'email'
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
            'customer_reference_type_id' => [
                'required', 
                'integer',
                'exists:customer_reference_types,id'
            ],
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
            'email' => [
                'nullable', 
                'email'
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
