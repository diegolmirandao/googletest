<?php

namespace App\Http\Requests\Purchase;

use App\Models\Supplier\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
        if ($this->route()->getName() !== 'purchases.store') {
            $purchase = $this->route('purchase');
            $this->merge(['purchase' => $purchase]);
        }

        $supplier = Supplier::find($this->all()['supplier_id']);
        $this->merge([
            'name' => $supplier->name,
            'identification_document' => $supplier->identification_document,
            'phone' => count($supplier->phones) > 0 ? $supplier->phones[0] : null,
            'email' => $supplier->email,
            'address' => $supplier->address
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
            case 'purchases.store':
                $rules = $this->store();
                break;
            case 'purchases.update':
                $rules = $this->update();
                break;
            case 'purchases.destroy':
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
            'supplier_id' => [
                'required', 
                'integer', 
                'exists:suppliers,id'
            ],
            'currency_id' => [
                'required', 
                'integer', 
                'exists:currencies,id'
            ],
            'establishment_id' => [
                'required', 
                'integer', 
                'exists:establishments,id'
            ],
            'warehouse_id' => [
                'required', 
                'integer', 
                'exists:warehouses,id'
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
            'purchased_at' => [
                'required', 
                'date',
            ],
            'expires_at' => [
                'nullable', 
                'date',
                'after_or_equal:purchased_at'
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
            'products.*.product_detail_cost_id' => [
                'required', 
                'integer', 
                'exists:product_detail_costs,id'
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
            'supplier_id' => [
                'required', 
                'integer', 
                'exists:suppliers,id'
            ],
            'currency_id' => [
                'required', 
                'integer', 
                'exists:currencies,id'
            ],
            'establishment_id' => [
                'required', 
                'integer', 
                'exists:establishments,id'
            ],
            'warehouse_id' => [
                'required', 
                'integer', 
                'exists:warehouses,id'
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
            'purchased_at' => [
                'required', 
                'date',
            ],
            'expires_at' => [
                'nullable', 
                'date',
                'after_or_equal:purchased_at'
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
                'exists:purchase_products,id'
            ],
            'products.*.product_detail_cost_id' => [
                'required', 
                'integer', 
                'exists:product_detail_costs,id'
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
                'exists:purchase_payments,id'
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
                'exists:purchase_instalments,id'
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
            'purchase' => [
                //
            ]
        ];
    }
}
