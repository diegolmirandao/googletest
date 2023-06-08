<?php

namespace App\Http\Requests\Staff\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceFeatureRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'services.features.update':
                $rules = $this->update();
                break;
        }

        return $rules;
    }

    /**
     * Get the validation rules that apply to the put/patch request.
     *
     * @return array
     */
    public function update()
    {
        return [
            '*.feature_id' => [
                'required',
                'integer',
                'exists:features,id'
            ],
            '*.quantity' => [
                'required',
                'numeric',
                'min:1'
            ],
        ];
    }
}
