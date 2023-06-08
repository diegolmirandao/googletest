<?php

namespace App\Http\Requests;

use App\Rules\PointOfSaleNotUsed;
use Illuminate\Foundation\Http\FormRequest;

class PointOfSaleRequest extends FormRequest
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
        if ($this->route()->getName() !== 'establishments.points-of-sale.store') {
            $pointOfSale = $this->route('point_of_sale');
            $this->merge(['point_of_sale' => $pointOfSale]);
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
            case 'establishments.points-of-sale.store':
                $rules = $this->store();
                break;
            case 'establishments.points-of-sale.update':
                $rules = $this->update();
                break;
            case 'establishments.points-of-sale.destroy':
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
            'number' => [
                'required', 
                'integer',
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
            'number' => [
                'required', 
                'integer'
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
            'point_of_sale' => [
                new PointOfSaleNotUsed
            ]
        ];
    }
}
