<?php

namespace App\Http\Requests\Product;

use App\Rules\Product\CodeNotRepeated;
use App\Rules\Product\ProductNotUsed;
use App\Rules\StringOrArray;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if ($this->route()->getName() !== 'products.store') {
            $product = $this->route('product');
            $this->merge(['product' => $product]);
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
            case 'products.store':
                $rules = $this->store();
                break;
            case 'products.update':
                $rules = $this->update();
                break;
            case 'products.destroy':
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
            'subcategory_id' => [
                'required',
                'integer',
                'exists:product_subcategories,id'
            ],
            'brand_id' => [
                'required',
                'integer',
                'exists:brands,id'
            ],
            'type_id' => [
                'required',
                'integer',
                'exists:product_types,id'
            ],
            'measurement_unit_id' => [
                'required',
                'integer',
                'exists:product_subcategories,id'
            ],
            'codes' => [
                'required',
                'array',
                'min:1'
            ],
            'name' => [
                'required', 
                'string'
            ],
            'description' => [
                'nullable', 
                'string'
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
            'status' => [
                'boolean'
            ],
            'taxed' => [
                'required',
                'boolean'
            ],
            'tax' => [
                'required',
                'numeric'
            ],
            'percentage_taxed' => [
                'required',
                'numeric'
            ],
            'prices' => [
                'required_without:details',
                'array'
            ],
            'prices.*.currency_id' => [
                'required_without:details',
                'integer',
                'exists:currencies,id'
            ],
            'prices.*.price_type_id' => [
                'required_without:details',
                'integer',
                'exists:product_price_types,id'
            ],
            'prices.*.amount' => [
                'required_without:details',
                'numeric',
                'min:0'
            ],
            'costs' => [
                'required_without:details',
                'array'
            ],
            'costs.*.currency_id' => [
                'required_without:details',
                'integer',
                'exists:currencies,id'
            ],
            'costs.*.cost_type_id' => [
                'required_without:details',
                'integer',
                'exists:product_cost_types,id'
            ],
            'costs.*.amount' => [
                'required_without:details',
                'numeric',
                'min:0'
            ],
            'details' => [
                'array',
            ],
            'details.*.status' => [
                'nullable',
                'boolean'
            ],
            'details.*.codes' => [
                'required',
                'array',
                'min:0'
            ],
            'details.*.prices' => [
                'required',
                'array'
            ],
            'details.*.prices.*.currency_id' => [
                'required',
                'integer',
                'exists:currencies,id'
            ],
            'details.*.prices.*.price_type_id' => [
                'required',
                'integer',
                'exists:product_price_types,id'
            ],
            'details.*.prices.*.amount' => [
                'required',
                'numeric',
                'min:0'
            ],
            'details.*.costs' => [
                'required',
                'array'
            ],
            'details.*.costs.*.currency_id' => [
                'required',
                'integer',
                'exists:currencies,id'
            ],
            'details.*.costs.*.cost_type_id' => [
                'required',
                'integer',
                'exists:product_cost_types,id'
            ],
            'details.*.costs.*.amount' => [
                'required',
                'numeric',
                'min:0'
            ],
            'details.*.variants' => [
                'nullable',
                'array'
            ],
            'details.*.variants.*.option_id' => [
                'required',
                'integer',
                'exists:variant_options,id'
            ],
            'parameters' => [
                'nullable', 
                'array'
            ],
            'parameters.*.parameter_id' => [
                'integer',
                'exists:parameters:id'
            ],
            'parameters.*.value' => [
                'string'
            ],
            'properties' => [
                'nullable', 
                'array'
            ],
            'properties.*.property_id' => [
                'nullable',
                'numeric'
            ],
            'properties.*.value' => [
                new StringOrArray
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
            'subcategory_id' => [
                'required',
                'integer',
                'exists:product_subcategories,id'
            ],
            'brand_id' => [
                'required',
                'integer',
                'exists:brands,id'
            ],
            'type_id' => [
                'required',
                'integer',
                'exists:product_types,id'
            ],
            'measurement_unit_id' => [
                'required',
                'integer',
                'exists:product_subcategories,id'
            ],
            'codes' => [
                'required',
                'array',
                'min:1'
            ],
            'name' => [
                'required', 
                'string'
            ],
            'description' => [
                'nullable', 
                'string'
            ],
            'properties' => [
                'nullable', 
                'array'
            ],
            'properties.*.property_id' => [
                'nullable',
                'numeric'
            ],
            'properties.*.value' => [
                new StringOrArray
            ],
            'descriptions' => [
                'nullable', 
                'array'
            ],
            'descriptions.*.id' => [
                'nullable',
                'numeric'
            ],
            'descriptions.*.name' => [
                'string'
            ],
            'descriptions.*.description' => [
                'string'
            ],
            'status' => [
                'boolean'
            ],
            'taxed' => [
                'required',
                'boolean'
            ],
            'tax' => [
                'required',
                'numeric'
            ],
            'percentage_taxed' => [
                'required',
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
            'product' => [
                new ProductNotUsed
            ]
        ];
    }
}
