<?php

namespace App\Http\Requests\Staff\Business;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Staff\Service\ServiceActive;
use App\Rules\Staff\Service\ServicePriceActive;
use App\Models\Staff\Service\ServicePrice;
use App\Rules\Staff\Business\BusinessServicePriceActive;
use App\Rules\Staff\Business\BusinessServicePriceNotActive;
use App\Rules\Staff\Business\BusinessServicePriceNotSuspended;
use App\Rules\Staff\Business\BusinessServicePriceNotCanceled;

class BusinessServicePriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->route()->getName()) {
            case 'businesses.services.store':
                $servicePriceTypeId = ServicePrice::findOrFail($this->service_price_id)->type->id;
                $can = auth()->user()->hasDirectPermission('service_price_type.sell_price_type_'.$servicePriceTypeId);
                break;
            default:
                $can = true;
                break;
        }
        return $can;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->route('service')) {
            $this->merge(['business_service_price' => $this->route('service')]);
        }

        if ($this->service_price_id) {
            $servicePrice = ServicePrice::findOrFail($this->service_price_id);
            
            $this->merge(['service_price' => $servicePrice]);
            $this->merge(['service' => $servicePrice->service]);
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
            case 'businesses.services.store':
                $rules = $this->store();
                break;
            case 'businesses.services.update':
                $rules = $this->update();
                break;
            case 'businesses.services.destroy':
                $rules = $this->destroy();
                break;
            case 'businesses.services.activate':
                $rules = $this->activate();
                break;
            case 'businesses.services.suspend':
                $rules = $this->suspend();
                break;
            case 'businesses.services.cancel':
                $rules = $this->cancel();
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
            'service_price_id' => [
                'required',
                'integer',
                'exists:service_prices,id',
            ],
            'quantity' => [
                'numeric',
                'min:1'
            ],
            'service_price' => [
                new ServicePriceActive
            ],
            'service' => [
                new ServiceActive
            ],
        ];
    }

    /**
     * Get the validation rules that apply to the put request.
     *
     * @return array
     */
    public function update()
    {
        return [
            'service_price_id' => [
                'required',
                'integer',
                'exists:service_prices,id',
            ],
            'business_service_status_id' => [
                'nullable',
                'integer',
                'exists:business_service_statuses,id',
            ],
            'quantity' => [
                'numeric',
                'min:1'
            ],
            'activated_at' => [
                'nullable',
                'date',
            ],
            'suspended_at' => [
                'nullable',
                'date',
            ],
            'canceled_at' => [
                'nullable',
                'date',
            ],
            'service_price' => [
                new ServicePriceActive
            ],
            'service' => [
                new ServiceActive
            ],
        ];
    }

    /**
     * Get the validation rules that apply to the patch activate request.
     *
     * @return array
     */
    public function activate()
    {
        return [
            'business_service_price' => [
                new BusinessServicePriceNotActive,
                new BusinessServicePriceNotCanceled
            ]
        ];
    }

    /**
     * Get the validation rules that apply to the patch suspend request.
     *
     * @return array
     */
    public function suspend()
    {
        return [
            'business_service_price' => [
                new BusinessServicePriceNotSuspended,
                new BusinessServicePriceNotCanceled,
                new BusinessServicePriceActive
            ]
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
            'business_service_price' => [
                new BusinessServicePriceNotCanceled
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
