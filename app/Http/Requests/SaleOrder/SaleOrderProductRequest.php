<?php

namespace App\Http\Requests\SaleOrder;

use Illuminate\Foundation\Http\FormRequest;

class SaleOrderProductRequest extends FormRequest
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
        if ($this->route()->getName() !== 'sale-orders.products.store') {
            $saleOrder = $this->route('sale_order');
            $saleOrderProduct = $this->route('product');
            $this->merge(['sale_order' => $saleOrder, 'sale_order_product' => $saleOrderProduct]);
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
            case 'sale-orders.products.store':
                $rules = $this->store();
                break;
            case 'sale-orders.products.update':
                $rules = $this->update();
                break;
            case 'sale-orders.products.cancel':
                $rules = $this->cancel();
                break;
            case 'sale-orders.products.destroy':
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
            '*.product_detail_price_id' => [
                'required', 
                'integer', 
                'exists:product_detail_prices,id'
            ],
            '*.measurement_unit_id' => [
                'required', 
                'integer', 
                'exists:measurement_units,id'
            ],
            '*.quantity' => [
                'required', 
                'numeric'
            ],
            '*.discount' => [
                'required', 
                'numeric'
            ],
            '*.code' => [
                'required',
                'string'
            ],
            '*.name' => [
                'required',
                'string'
            ],
            '*.taxed' => [
                'required',
                'boolean'
            ],
            '*.tax' => [
                'required',
                'numeric'
            ],
            '*.percentage_taxed' => [
                'required',
                'numeric'
            ],
            '*.comments' => [
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
            'billed_quantity' => [
                'required', 
                'numeric'
            ],
            'canceled_quantity' => [
                'required', 
                'numeric'
            ],
            'discount' => [
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
    public function cancel()
    {
        return [
            'quantity' => [
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
     * Get the validation rules that apply to the delete request.
     *
     * @return array
     */
    public function destroy()
    {
        return [
            'sale' => [
                //
            ]
        ];
    }
}
