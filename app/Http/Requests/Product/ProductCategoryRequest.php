<?php

namespace App\Http\Requests\Product;

use App\Rules\Product\ProductCategoryEmpty;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductCategoryRequest extends FormRequest
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
        if ($this->route()->getName() !== 'product-categories.store') {
            $productCategory = $this->route('product_category');
            $this->merge(['product_category' => $productCategory]);
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
            case 'product-categories.store':
                $rules = $this->store();
                break;
            case 'product-categories.update':
                $rules = $this->update();
                break;
            case 'product-categories.destroy':
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
                'unique:product_categories,name'
            ],
            'subcategories' => [
                'required',
                'array',
                'min:1'
            ],
            'subcategories.*.name' => [
                'required',
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
                Rule::unique('product_categories', 'name')->ignore($this->route('product_category'))
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
            'product_category' => [
                new ProductCategoryEmpty
            ]
        ];
    }
}
