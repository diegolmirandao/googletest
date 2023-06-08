<?php

namespace App\Http\Requests\Staff\Bill;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Staff\Bill\BillNotCanceled;
use App\Rules\Staff\Bill\BillServiceUpdateAllowed;
use App\Rules\Staff\Bill\BillServiceDeleteAllowed;
use App\Rules\Staff\Business\BusinessServicePriceExists;
use App\Rules\Staff\Bill\BillServicePriceNotRepeated;
use App\Rules\Staff\Bill\BillWithManyServices;
use App\Models\Staff\Business\BusinessServicePrice;
use App\Rules\Staff\Business\BusinessServicePriceActive;

class BillServiceRequest extends FormRequest
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
        $this->merge(['service' => $this->route('service')]);

        $businessServicePrice = BusinessServicePrice::find($this->business_service_price_id);

        $this->merge(['business_service_price' => $businessServicePrice]);
        $this->merge(['service_price' => $businessServicePrice->servicePrice ?? null]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'bills.services.store':
                $rules = $this->store();
                break;
            case 'bills.services.update':
                $rules = $this->update();
                break;
            case 'bills.services.destroy':
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
            'business_service_price_id' => [
                'required',
                'integer',
                'exists:business_service_prices,id',
            ],
            'quantity' => [
                'numeric',
                'min:1'
            ],
            'business_service_price' => [
                new BusinessServicePriceExists,
                new BusinessServicePriceActive,
                new BillServicePriceNotRepeated,
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
            'business_service_price_id' => [
                'required',
                'integer',
                'exists:business_service_prices,id',
            ],
            'quantity' => [
                'numeric'
            ],
            'business_service_price' => [
                new BusinessServicePriceActive,
                new BillServicePriceNotRepeated,
            ],
            'service_price' => [
                new BillServiceUpdateAllowed
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
            'bill' => [
                new BillNotCanceled,
                new BillWithManyServices
            ],
            'service' => [
                new BillServiceDeleteAllowed
            ],
        ];
    }
}
