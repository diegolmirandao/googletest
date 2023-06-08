<?php

namespace App\Http\Requests\Sale;

use App\Models\Customer\Customer;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
        if ($this->route()->getName() !== 'sales.store') {
            $sale = $this->route('sale');
            $this->merge(['sale' => $sale]);
        }

        $customer = Customer::find($this->all()['customer_id']);
        $this->merge([
            'name' => $customer->name,
            'identification_document' => $customer->identification_document,
            'phone' => count($customer->phones) > 0 ? $customer->phones[0] : null,
            'email' => $customer->email,
            'address' => $customer->address
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'sales.store':
                $rules = $this->store();
                break;
            case 'sales.update':
                $rules = $this->update();
                break;
            case 'sales.destroy':
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
            'document_type_id' => [
                'required', 
                'integer', 
                'exists:document_types,id'
            ],
            'payment_term_id' => [
                'required', 
                'integer', 
                'exists:payment_terms,id'
            ],
            'billed_at' => [
                'required', 
                'date',
            ],
            'expires_at' => [
                'nullable', 
                'date',
                'after_or_equal:billed_at'
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
            'payments' => [
                'nullable',
                'array'
            ],
            'payments.*.currency_id' => [
                'required', 
                'integer', 
                'exists:currencies,id'
            ],
            'payments.*.payment_method_id' => [
                'required', 
                'integer', 
                'exists:payment_methods,id'
            ],
            'payments.*.paid_at' => [
                'required', 
                'date',
            ],
            'payments.*.amount' => [
                'required', 
                'numeric'
            ],
            'payments.*.comments' => [
                'nullable',
                'string'
            ],
            'instalments' => [
                'nullable',
                'array'
            ],
            'instalments.*.number' => [
                'required', 
                'integer',
            ],
            'instalments.*.expires_at' => [
                'required', 
                'date',
            ],
            'instalments.*.amount' => [
                'required', 
                'numeric'
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
            'document_type_id' => [
                'required', 
                'integer', 
                'exists:document_types,id'
            ],
            'payment_term_id' => [
                'required', 
                'integer', 
                'exists:payment_terms,id'
            ],
            'billed_at' => [
                'required', 
                'date',
            ],
            'expires_at' => [
                'nullable', 
                'date',
                'after_or_equal:billed_at'
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
            'products.*.id' => [
                'nullable', 
                'integer', 
                'exists:sale_products,id'
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
            'payments' => [
                'nullable',
                'array'
            ],
            'payments.*.id' => [
                'nullable', 
                'integer', 
                'exists:sale_payments,id'
            ],
            'payments.*.currency_id' => [
                'required', 
                'integer', 
                'exists:currencies,id'
            ],
            'payments.*.payment_method_id' => [
                'required', 
                'integer', 
                'exists:payment_methods,id'
            ],
            'payments.*.paid_at' => [
                'required', 
                'date',
            ],
            'payments.*.amount' => [
                'required', 
                'numeric'
            ],
            'payments.*.comments' => [
                'nullable',
                'string'
            ],
            'instalments' => [
                'nullable',
                'array'
            ],
            'instalments.*.id' => [
                'nullable', 
                'integer', 
                'exists:sale_instalments,id'
            ],
            'instalments.*.number' => [
                'required', 
                'integer',
            ],
            'instalments.*.expires_at' => [
                'required', 
                'date',
            ],
            'instalments.*.amount' => [
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
            'sale' => [
                //
            ]
        ];
    }
}
