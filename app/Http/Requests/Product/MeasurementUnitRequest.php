<?php

namespace App\Http\Requests\Product;

use App\Rules\Product\MeasurementUnitNotUsed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MeasurementUnitRequest extends FormRequest
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
        if ($this->route()->getName() !== 'measurement-units.store') {
            $measurementUnit = $this->route('measurement_unit');
            $this->merge(['measurement_unit' => $measurementUnit]);
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
            case 'measurement-units.store':
                $rules = $this->store();
                break;
            case 'measurement-units.update':
                $rules = $this->update();
                break;
            case 'measurement-units.destroy':
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
                'unique:measurement_units,name'
            ],
            'abbreviation' => [
                'required', 
                'string', 
                'unique:measurement_units,abbreviation'
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
                Rule::unique('measurement_units', 'name')->ignore($this->route('measurement_unit'))
            ],
            'abbreviation' => [
                'required', 
                'string',
                Rule::unique('measurement_units', 'abbreviation')->ignore($this->route('measurement_unit'))
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
            'measurement_unit' => [
                new MeasurementUnitNotUsed
            ]
        ];
    }
}
