<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseInstalmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
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
            case 'purchases.instalments.update':
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
            '*.number' => [
                'required', 
                'integer',
            ],
            '*.expires_at' => [
                'required', 
                'date',
            ],
            '*.amount' => [
                'required', 
                'numeric'
            ],
        ];
    }
}
