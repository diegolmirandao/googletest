<?php

namespace App\Http\Requests\Product;

use App\Rules\Product\ProductCostTypeNotUsed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductCostTypeRequest extends FormRequest
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
        if ($this->route()->getName() !== 'product-cost-types.store') {
            $productCostType = $this->route('product_cost_type');
            $this->merge(['product_cost_type' => $productCostType]);
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
            case 'product-cost-types.store':
                $rules = $this->store();
                break;
            case 'product-cost-types.update':
                $rules = $this->update();
                break;
            case 'product-cost-types.destroy':
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
                'unique:product_cost_types,name'
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
                Rule::unique('product_cost_types', 'name')->ignore($this->route('product_cost_type'))
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
            'product_cost_type' => [
                new ProductCostTypeNotUsed
            ]
        ];
    }
}
