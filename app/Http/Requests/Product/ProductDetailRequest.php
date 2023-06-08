<?php

namespace App\Http\Requests\Product;

use App\Rules\Product\ProductDetailNotUsed;
use Illuminate\Foundation\Http\FormRequest;

class ProductDetailRequest extends FormRequest
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
            case 'products.details.store':
                $rules = $this->store();
                break;
            case 'products.details.update':
                $rules = $this->update();
                break;
            case 'products.details.destroy':
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
            'status' => [
                'nullable',
                'boolean'
            ],
            'prices' => [
                'required',
                'array'
            ],
            'prices.*.currency_id' => [
                'required',
                'integer',
                'exists:currencies,id'
            ],
            'prices.*.price_type_id' => [
                'required',
                'integer',
                'exists:product_price_types,id'
            ],
            'prices.*.amount' => [
                'required',
                'numeric',
                'min:0'
            ],
            'variants' => [
                'nullable',
                'array'
            ],
            'variants.*.value_id' => [
                'required',
                'integer',
                'exists:variant_values,id'
            ],
            'codes' => [
                'required',
                'array',
                'min:1'
            ],
            'codes.*.code' => [
                'alpha_dash:ascii'
            ],
            'descriptions' => [
                'nullable', 
                'array'
            ],
            'descriptions.*.name' => [
                'string'
            ],
            'descriptions.*.description' => [
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
            'status' => [
                'nullable',
                'boolean'
            ],
            'variants' => [
                'nullable',
                'array'
            ],
            'variants.*.id' => [
                'required',
                'integer',
                'exists:variants,id'
            ],
            'variants.*.value_id' => [
                'required',
                'integer',
                'exists:variant_values,id'
            ],
            'codes' => [
                'required',
                'array',
                'min:1'
            ],
            'codes.*.code' => [
                'alpha_dash:ascii'
            ],
            'descriptions' => [
                'nullable', 
                'array'
            ],
            'descriptions.*.name' => [
                'string'
            ],
            'descriptions.*.description' => [
                'string'
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
            'product' => [
                new ProductDetailNotUsed
            ]
        ];
    }
}
