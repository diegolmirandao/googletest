<?php

namespace App\Http\Requests\Staff\Service;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Staff\Service\ServicePriceTypeDeleteAllowed;

class ServicePriceTypeRequest extends FormRequest
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
        if ($this->route()->getName() !== 'service-price-types.store') {
            $servicePriceType = $this->route('service_price_type');
            $this->merge(['service_price_type' => $servicePriceType]);
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
            case 'service-price-types.store':
                $rules = $this->store();
                break;
            case 'service-price-types.update':
                $rules = $this->update();
                break;
            case 'service-price-types.cancel':
                $rules = $this->cancel();
                break;
            case 'service-price-types.destroy':
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
            'name' => [
                'required',
                'string',
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
            'service_price_type' => [
                new ServicePriceTypeDeleteAllowed               
            ],
        ];
    }
}
