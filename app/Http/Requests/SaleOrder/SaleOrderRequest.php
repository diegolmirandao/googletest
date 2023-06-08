<?php

namespace App\Http\Requests\SaleOrder;

use App\Models\Customer\Customer;
use Illuminate\Foundation\Http\FormRequest;

class SaleOrderRequest extends FormRequest
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
        if ($this->route()->getName() !== 'sale-orders.store') {
            $saleOrder = $this->route('sale_order');
            $this->merge(['sale_order' => $saleOrder]);
        }

        if ($this->route()->getName() !== 'sale-orders.cancel') {
            $customer = Customer::find($this->all()['customer_id']);
            $this->merge([
                'name' => $customer->name,
                'identification_document' => $customer->identification_document,
                'phone' => count($customer->phones) > 0 ? $customer->phones[0] : null,
                'email' => $customer->email,
                'address' => $customer->address
            ]);
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
            case 'sale-orders.store':
                $rules = $this->store();
                break;
            case 'sale-orders.update':
                $rules = $this->update();
                break;
            case 'sale-orders.cancel':
                $rules = $this->cancel();
                break;
            case 'sale-orders.destroy':
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
            'customer_id' => [
                'required', 
                'integer', 
                'exists:customers,id'
            ],
            'currency_id' => [
                'required', 
                'integer', 
                'exists:currencies,id'
            ],
            'point_of_sale_id' => [
                'required', 
                'integer', 
                'exists:points_of_sale,id'
            ],
            'warehouse_id' => [
                'required', 
                'integer', 
                'exists:warehouses,id'
            ],
            'seller_id' => [
                'required', 
                'integer', 
                'exists:users,id'
            ],
            'ordered_at' => [
                'required', 
                'date',
            ],
            'expires_at' => [
                'nullable', 
                'date',
                'after_or_equal:ordered_at'
            ],
            'name' => [
                'required',
                'string'
            ],
            'identification_document' => [
                'required',
                'string'
            ],
            'phone' => [
                'nullable',
                'string'
            ],
            'email' => [
                'nullable',
                'string'
            ],
            'address' => [
                'nullable',
                'string'
            ],
            'comments' => [
                'nullable',
                'string'
            ],
            'products' => [
                'required',
                'array',
                'min:1'
            ],
            'products.*.product_detail_price_id' => [
                'required', 
                'integer', 
                'exists:product_detail_prices,id'
            ],
            'products.*.measurement_unit_id' => [
                'required', 
                'integer', 
                'exists:measurement_units,id'
            ],
            'products.*.quantity' => [
                'required', 
                'numeric'
            ],
            'products.*.discount' => [
                'required', 
                'numeric'
            ],
            'products.*.code' => [
                'nullable',
                'string'
            ],
            'products.*.name' => [
                'required',
                'string'
            ],
            'products.*.taxed' => [
                'required',
                'boolean'
            ],
            'products.*.tax' => [
                'required',
                'numeric'
            ],
            'products.*.percentage_taxed' => [
                'required',
                'numeric'
            ],
            'products.*.comments' => [
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
            'customer_id' => [
                'required', 
                'integer', 
                'exists:customers,id'
            ],
            'currency_id' => [
                'required', 
                'integer', 
                'exists:currencies,id'
            ],
            'point_of_sale_id' => [
                'required', 
                'integer', 
                'exists:points_of_sale,id'
            ],
            'warehouse_id' => [
                'required', 
                'integer', 
                'exists:warehouses,id'
            ],
            'seller_id' => [
                'required', 
                'integer', 
                'exists:users,id'
            ],
            'ordered_at' => [
                'required', 
                'date',
            ],
            'expires_at' => [
                'nullable', 
                'date',
                'after_or_equal:ordered_at'
            ],
            'name' => [
                'required',
                'string'
            ],
            'identification_document' => [
                'required',
                'string'
            ],
            'phone' => [
                'nullable',
                'string'
            ],
            'email' => [
                'nullable',
                'string'
            ],
            'address' => [
                'nullable',
                'string'
            ],
            'comments' => [
                'nullable',
                'string'
            ],
        ];
    }

    /**
     * Get the validation rules that apply to the cancel request.
     *
     * @return array
     */
    public function cancel()
    {
        return [
            'sale' => [
                //
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
            'sale' => [
                //
            ]
        ];
    }
}
