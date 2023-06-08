<?php

namespace App\Http\Requests;

use App\Rules\PaymentMethodNotUsed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentMethodRequest extends FormRequest
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
        if ($this->route()->getName() !== 'payment-methods.store') {
            $paymentMethod = $this->route('payment_method');
            $this->merge(['payment_method' => $paymentMethod]);
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
            case 'payment-methods.store':
                $rules = $this->store();
                break;
            case 'payment-methods.update':
                $rules = $this->update();
                break;
            case 'payment-methods.destroy':
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
                'unique:payment_methods,name'
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
                Rule::unique('payment_methods', 'name')->ignore($this->route('payment_method'))
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
            'payment_method' => [
                new PaymentMethodNotUsed
            ]
        ];
    }
}
