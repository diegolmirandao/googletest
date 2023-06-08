<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'properties.store':
                $rules = $this->store();
                break;
            case 'properties.update':
                $rules = $this->update();
                break;
            case 'properties.destroy':
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
                'string'
            ],
            'type' => [
                'required', 
                'string', 
                Rule::in(['numeric', 'string', 'list'])
            ],
            'measurement_unit_id' => [
                'nullable',
                'integer',
                'exists:measurement_units,id'
            ],
            'has_multiple_values' => [
                'required', 
                'boolean'
            ],
            'is_required' => [
                'required', 
                'boolean'
            ],
            'subcategories' => [
                'nullable',
                'array'
            ],
            'subcategories.*' => [
                'integer',
                'exists:product_subcategories,id'
            ],
            'options' => [
                // 'required', hacer required if es list el tipo de campo
                'array'
            ],
            'options.*.value' => [
                // 'required',
                'string'
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
                Rule::unique('properties', 'name')->ignore($this->route('property'))
            ],
            'type' => [
                'required', 
                'string', 
                Rule::in(['numeric', 'string', 'list'])
            ],
            'measurement_unit_id' => [
                'nullable',
                'integer',
                'exists:measurement_units,id'
            ],
            'has_multiple_values' => [
                'required', 
                'boolean'
            ],
            'is_required' => [
                'required', 
                'boolean'
            ],
            'subcategories' => [
                'nullable',
                'array'
            ],
            'subcategories.*' => [
                'integer',
                'exists:product_subcategories,id'
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
