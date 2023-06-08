<?php

namespace App\Http\Requests\Supplier;

use App\Rules\Supplier\SupplierNotUsed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
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
        if ($this->route()->getName() !== 'suppliers.store') {
            $supplier = $this->route('supplier');
            $this->merge(['supplier' => $supplier]);
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
            case 'suppliers.store':
                $rules = $this->store();
                break;
            case 'suppliers.update':
                $rules = $this->update();
                break;
            case 'suppliers.destroy':
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
                'string',
                'unique:suppliers,identification_document'
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
            'address' => [
                'nullable', 
                'string',
            ],
            'contacts' => [
                'nullable',
                'array'
            ],
            'contacts.*.name' => [
                'nullable',
                'string',
            ],
            'contacts.*.phone' => [
                'nullable',
                'string',
            ],
            'contacts.*.email' => [
                'nullable',
                'email',
            ],
            'contacts.*.comments' => [
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
            'name' => [
                'required', 
                'string',
            ],
            'identification_document' => [
                'required', 
                'string',
                Rule::unique('suppliers', 'identification_document')->ignore($this->route('supplier'))
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
            'supplier' => [
                new SupplierNotUsed
            ]
        ];
    }
}
