<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseProductRequest extends FormRequest
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
        if ($this->route()->getName() !== 'purchases.products.store') {
            $purchase = $this->route('purchase');
            $purchaseProduct = $this->route('product');
            $this->merge(['purchase' => $purchase, 'purchase_product' => $purchaseProduct]);
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
            case 'purchases.products.store':
                $rules = $this->store();
                break;
            case 'purchases.products.update':
                $rules = $this->update();
                break;
            case 'purchases.products.destroy':
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
            'product_detail_cost_id' => [
                'required', 
                'integer', 
                'exists:product_detail_costs,id'
            ],
            'measurement_unit_id' => [
                'required', 
                'integer', 
                'exists:measurement_units,id'
            ],
            'quantity' => [
                'required', 
                'numeric'
            ],
            'discount' => [
                'required', 
                'numeric'
            ],
            'code' => [
                'required',
                'string'
            ],
            'name' => [
                'required',
                'string'
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
            'comments' => [
                'nullable',
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
            'quantity' => [
                'required', 
                'numeric'
            ],
            'discount' => [
                'required', 
                'numeric'
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
            'purchase' => [
                //
            ]
        ];
    }
}
