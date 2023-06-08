<?php

namespace App\Http\Requests\Location;

use App\Rules\Location\CityNotUsed;
use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
        if ($this->route()->getName() !== 'cities.store') {
            $city = $this->route('city');
            $this->merge(['city' => $city]);
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
            case 'cities.store':
                $rules = $this->store();
                break;
            case 'cities.update':
                $rules = $this->update();
                break;
            case 'cities.destroy':
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
            'region_id' => [
                'required', 
                'integer',
                'exists:regions,id'
            ],
            'code' => [
                'required', 
                'string'
            ],
            'name' => [
                'required', 
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
            'region_id' => [
                'required', 
                'integer',
                'exists:regions,id'
            ],
            'code' => [
                'required', 
                'string',
            ],
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
            'city' => [
                new CityNotUsed
            ]
        ];
    }
}
