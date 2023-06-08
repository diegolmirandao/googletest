<?php

namespace App\Http\Requests;

use App\Rules\EstablishmentNotUsed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EstablishmentRequest extends FormRequest
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
        if ($this->route()->getName() !== 'establishments.store') {
            $establishment = $this->route('establishment');
            $this->merge(['establishment' => $establishment]);
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
            case 'establishments.store':
                $rules = $this->store();
                break;
            case 'establishments.update':
                $rules = $this->update();
                break;
            case 'establishments.destroy':
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
            'business_id' => [
                'required', 
                'integer', 
                'exists:businesses,id'
            ],
            'name' => [
                'required', 
                'string',
            ],
            'points_of_sale' => [
                'required',
                'array',
                'min:1'
            ],
            'points_of_sale.*.number' => [
                'required',
                'integer',
                'min:1'
            ]
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
            'business_id' => [
                'required', 
                'integer', 
                'exists:businesses,id'
            ],
            'name' => [
                'required', 
                'string'
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
            'establishment' => [
                new EstablishmentNotUsed
            ]
        ];
    }
}
