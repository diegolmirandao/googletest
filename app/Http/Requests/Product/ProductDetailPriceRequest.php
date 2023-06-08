<?php

namespace App\Http\Requests\Product;

use App\Rules\Product\ProductDetailPriceNotUsed;
use App\Rules\Product\ProductSubcategoryEmpty;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductDetailPriceRequest extends FormRequest
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
        if ($this->route()->getName() !== 'products.details.prices.store') {
            $productDetailPrice = $this->route('price');
            $this->merge(['product_detail_price' => $productDetailPrice]);
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
            case 'products.details.prices.store':
                $rules = $this->store();
                break;
            case 'products.details.prices.update':
                $rules = $this->update();
                break;
            case 'products.details.prices.destroy':
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
            'currency_id' => [
                'required', 
                'integer',
                'exists:currencies,id'
            ],
            'price_type_id' => [
                'required', 
                'integer',
                'exists:product_price_types,id'
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0'
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
            'currency_id' => [
                'required', 
                'integer',
                'exists:currencies,id'
            ],
            'price_type_id' => [
                'required', 
                'integer',
                'exists:product_price_types,id'
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0'
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
            'product_detail_price' => [
                new ProductDetailPriceNotUsed
            ]
        ];
    }
}
