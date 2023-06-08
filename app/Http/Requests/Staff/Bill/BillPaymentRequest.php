<?php

namespace App\Http\Requests\Staff\Bill;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Staff\Bill\BillDueAmountNotExceeded;
use App\Rules\Staff\Bill\BillNotCanceled;
use App\Rules\Staff\Bill\BillPaymentNotCanceled;

class BillPaymentRequest extends FormRequest
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
        $this->merge(['bill' => $this->route('bill')]);
        $this->merge(['bill_payment' => $this->route('payment')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'bills.payments.store':
                $rules = $this->store();
                break;
            case 'bills.payments.update':
                $rules = $this->update();
                break;
            case 'bills.payments.cancel':
                $rules = $this->cancel();
                break;
            case 'bills.payments.destroy':
                $rules = $this->destroy();
                break;
            
            default:
                $rules = $this->index();
                break;
        }
        return $rules;
    }

    /**
     * Get the validation rules that apply to the get request.
     *
     * @return array
     */
    public function index()
    {
        return [
            //
        ];
    }
    
    /**
     * Get the validation rules that apply to the post request.
     *
     * @return array
     */
    public function store()
    {
        return [
            'bill' => [
                new BillNotCanceled
            ],
            'payment_method_id' => [
                'required',
                'integer',
                'exists:payment_methods,id'
            ],
            'amount' => [
                'required',
                'numeric',
                new BillDueAmountNotExceeded
            ],
            'currency_id' => [
                'required',
                'integer',
                'exists:currencies,id'
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
            'bill' => [
                new BillNotCanceled
            ],
            'payment_method_id' => [
                'required',
                'integer',
                'exists:payment_methods,id'
            ],
            'amount' => [
                'required',
                'numeric',
                new BillDueAmountNotExceeded
            ],
            'currency_id' => [
                'required',
                'integer',
                'exists:currencies,id'
            ],
        ];
    }

    /**
     * Get the validation rules that apply to the patch cancel request.
     *
     * @return array
     */
    public function cancel()
    {
        return [
            'bill' => [
                new BillNotCanceled
            ],
            'bill_payment' => [
                new BillPaymentNotCanceled
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
            //
        ];
    }
}
