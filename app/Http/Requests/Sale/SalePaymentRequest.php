<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class SalePaymentRequest extends FormRequest
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
        if ($this->route()->getName() !== 'sales.payments.store') {
            $sale = $this->route('sale');
            $salePayment = $this->route('payment');
            $this->merge(['sale' => $sale, 'sale_payment' => $salePayment]);
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
            case 'sales.payments.store':
                $rules = $this->store();
                break;
            case 'sales.payments.update':
                $rules = $this->update();
                break;
            case 'sales.payments.destroy':
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
            'payment_method_id' => [
                'required', 
                'integer', 
                'exists:payment_methods,id'
            ],
            'paid_at' => [
                'required', 
                'date',
            ],
            'amount' => [
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
            'currency_id' => [
                'required', 
                'integer', 
                'exists:currencies,id'
            ],
            'payment_method_id' => [
                'required', 
                'integer', 
                'exists:payment_methods,id'
            ],
            'paid_at' => [
                'required', 
                'date',
            ],
            'amount' => [
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
