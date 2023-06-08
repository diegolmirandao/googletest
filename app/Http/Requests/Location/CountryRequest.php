<?php

namespace App\Http\Requests\Location;

use App\Rules\Location\LocationNotUsed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
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
        if ($this->route()->getName() !== 'countries.store') {
            $country = $this->route('country');
            $this->merge(['country' => $country]);
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
            case 'countries.store':
                $rules = $this->store();
                break;
            case 'countries.update':
                $rules = $this->update();
                break;
            case 'countries.destroy':
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
            'code' => [
                'required', 
                'string', 
                'unique:countries,code'
            ],
            'name' => [
                'required', 
                'string', 
                'unique:countries,name'
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
            'code' => [
                'required', 
                'string',
                Rule::unique('countries', 'code')->ignore($this->route('country'))
            ],
            'name' => [
                'required', 
                'string',
                Rule::unique('countries', 'name')->ignore($this->route('country'))
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
            'country' => [
                new CountryNotUsed
            ]
        ];
    }
}
