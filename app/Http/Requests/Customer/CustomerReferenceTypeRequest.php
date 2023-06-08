<?php

namespace App\Http\Requests\Customer;

use App\Rules\Customer\ReferenceTypeNotUsed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerReferenceTypeRequest extends FormRequest
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
        if ($this->route()->getName() !== 'customer-reference-types.store') {
            $customerReferenceType = $this->route('customer_reference_type');
            $this->merge(['customer_reference_type' => $customerReferenceType]);
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
            case 'customer-reference-types.store':
                $rules = $this->store();
                break;
            case 'customer-reference-types.update':
                $rules = $this->update();
                break;
            case 'customer-reference-types.destroy':
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
                'unique:customer_reference_types,name'
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
                Rule::unique('customer_reference_types', 'name')->ignore($this->route('customer_reference_type'))
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
            'customer_reference_type' => [
                new ReferenceTypeNotUsed
            ]
        ];
    }
}
