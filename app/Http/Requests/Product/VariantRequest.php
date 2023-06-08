<?php

namespace App\Http\Requests\Product;

use App\Rules\Product\VariantEmpty;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VariantRequest extends FormRequest
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
        if ($this->route()->getName() !== 'variants.store') {
            $variant = $this->route('variant');
            $this->merge(['variant' => $variant]);
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
            case 'variants.store':
                $rules = $this->store();
                break;
            case 'variants.update':
                $rules = $this->update();
                break;
            case 'variants.destroy':
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
            'has_amount_equivalencies' => [
                'nullable',
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
                'required',
                'array',
                'min:1'
            ],
            'options.*.name' => [
                'required',
                'string'
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
                'string'
            ],
            'has_amount_equivalencies' => [
                'nullable',
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
            'variant' => [
                new VariantEmpty
            ]
        ];
    }
}
