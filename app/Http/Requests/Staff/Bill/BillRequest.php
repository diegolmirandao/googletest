<?php

namespace App\Http\Requests\Staff\Bill;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Staff\Business\Business;
use App\Models\Staff\Service\ServicePrice;
use App\Rules\Staff\Bill\BillNotCanceled;
use App\Rules\Staff\Bill\BillServicePriceNotRepeated;
use App\Rules\Staff\Service\ServicePriceActive;
use App\Rules\Staff\Business\BusinessServicePriceExists;

class BillRequest extends FormRequest
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

        $business = Business::findOrFail($this->business_id);
        $businessServicePrices = $business->businessServicePrices()->active()->get();

        if ($this->services) {
            $servicePricesInput = [];

            foreach ($businessServicePrices as $businessServicePrice) {
                $servicePricesInput[] =  ServicePrice::find($businessServicePrice->service_price_id);
            }

            $this->merge(['service_prices' => $servicePricesInput]);
            $this->merge(['business_service_prices' => $businessServicePrices]);
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
            case 'bills.store':
                $rules = $this->store();
                break;
            case 'bills.update':
                $rules = $this->update();
                break;
            case 'bills.cancel':
                $rules = $this->cancel();
                break;
            case 'bills.destroy':
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
            'business_id' => [
                'required',
                'integer',
                'exists:businesses,id'
            ],
            'currency_id' => [
                'required',
                'integer',
                'exists:currencies,id'
            ],
            'billed_at' => [
                'date',
                'nullable'
            ],
            'services' => [
                'required',
                'array'
            ],
            'services.*.business_service_price_id' => [
                'required',
                'integer',
                'exists:business_service_prices,id',
                new BillServicePriceNotRepeated,
            ],
            'services.*.quantity' => [
                'required',
                'numeric',
                'min:0'
            ],
            'service_prices.*' => [
                new ServicePriceActive
            ],
            'business_service_prices.*' => [
                new BusinessServicePriceExists
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
            // 'bill' => [
            //     new BillNotCanceled
            // ],
            'bill_status_id' => [
                'required',
                'integer',
                'exists:bill_statuses,id'
            ],
            'currency_id' => [
                'required',
                'integer',
                'exists:currencies,id'
            ],
            'billed_at' => [
                'date',
                'nullable'
            ],
            'expires_at' => [
                'date',
                'after:billed_at',
                'nullable'
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
            //
        ];
    }
}
