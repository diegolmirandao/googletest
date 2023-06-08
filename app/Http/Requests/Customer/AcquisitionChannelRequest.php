<?php

namespace App\Http\Requests\Customer;

use App\Rules\Customer\AcquisitionChannelNotUsed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AcquisitionChannelRequest extends FormRequest
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
        if ($this->route()->getName() !== 'acquisition-channels.store') {
            $acquisitionChannel = $this->route('acquisition_channel');
            $this->merge(['acquisition_channel' => $acquisitionChannel]);
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
            case 'acquisition-channels.store':
                $rules = $this->store();
                break;
            case 'acquisition-channels.update':
                $rules = $this->update();
                break;
            case 'acquisition-channels.destroy':
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
                'unique:acquisition_channels,name'
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
                Rule::unique('acquisition_channels', 'name')->ignore($this->route('acquisition_channel'))
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
            'acquisition_channel' => [
                new AcquisitionChannelNotUsed
            ]
        ];
    }
}
