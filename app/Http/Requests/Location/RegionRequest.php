<?php

namespace App\Http\Requests\Location;

use App\Rules\Location\RegionNotUsed;
use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
        if ($this->route()->getName() !== 'regions.store') {
            $region = $this->route('region');
            $this->merge(['region' => $region]);
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
            case 'regions.store':
                $rules = $this->store();
                break;
            case 'regions.update':
                $rules = $this->update();
                break;
            case 'regions.destroy':
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
            'country_id' => [
                'required', 
                'integer',
                'exists:countries,id'
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
            'country_id' => [
                'required', 
                'integer',
                'exists:countries,id'
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
            'region' => [
                new RegionNotUsed
            ]
        ];
    }
}
