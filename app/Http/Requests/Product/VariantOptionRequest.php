<?php

namespace App\Http\Requests\Product;

use App\Rules\Product\VariantOptionEmpty;
use Illuminate\Foundation\Http\FormRequest;

class VariantOptionRequest extends FormRequest
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
        if ($this->route()->getName() !== 'variant-options.store') {
            $variantOption = $this->route('option');
            $this->merge(['variant_option' => $variantOption]);
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
            case 'variants.options.store':
                $rules = $this->store();
                break;
            case 'variants.options.update':
                $rules = $this->update();
                break;
            case 'variants.options.destroy':
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
            'equivalent_variant_option_id' => [
                'nullable',
                'integer',
                'exists:variant_options,id'
            ],
            'equivalent_amount' => [
                'nullable',
                'numeric'
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
            ],
            'equivalent_variant_option_id' => [
                'nullable',
                'integer',
                'exists:variant_options,id'
            ],
            'equivalent_amount' => [
                'nullable',
                'numeric'
            ]
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
            'variant_option' => [
                new VariantOptionEmpty
            ]
        ];
    }
}
