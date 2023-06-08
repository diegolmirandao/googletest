<?php

namespace App\Http\Requests\Location;

use App\Rules\Location\ZoneNotUsed;
use Illuminate\Foundation\Http\FormRequest;

class ZoneRequest extends FormRequest
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
        if ($this->route()->getName() !== 'zones.store') {
            $zone = $this->route('zone');
            $this->merge(['zone' => $zone]);
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
            case 'zones.store':
                $rules = $this->store();
                break;
            case 'zones.update':
                $rules = $this->update();
                break;
            case 'zones.destroy':
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
            'city_id' => [
                'required', 
                'integer',
                'exists:cities,id'
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
            'city_id' => [
                'required', 
                'integer',
                'exists:cities,id'
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
            'zone' => [
                new ZoneNotUsed
            ]
        ];
    }
}
