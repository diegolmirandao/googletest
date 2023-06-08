<?php

namespace App\Http\Requests;

use App\Rules\PaymentTermNotUsed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentTermRequest extends FormRequest
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
        if ($this->route()->getName() !== 'payment-terms.store') {
            $paymentTerm = $this->route('payment_term');
            $this->merge(['payment_term' => $paymentTerm]);
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
            case 'payment-terms.store':
                $rules = $this->store();
                break;
            case 'payment-terms.update':
                $rules = $this->update();
                break;
            case 'payment-terms.destroy':
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
                'unique:payment_terms,name'
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
                Rule::unique('payment_terms', 'name')->ignore($this->route('payment_term'))
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
            'payment_term' => [
                new PaymentTermNotUsed
            ]
        ];
    }
}
