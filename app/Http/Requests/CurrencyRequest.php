<?php

namespace App\Http\Requests;

use App\Rules\CurrencyNotUsed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyRequest extends FormRequest
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
        if ($this->route()->getName() !== 'currencies.store') {
            $currency = $this->route('currency');
            $this->merge(['currency' => $currency]);
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
            case 'currencies.store':
                $rules = $this->store();
                break;
            case 'currencies.update':
                $rules = $this->update();
                break;
            case 'currencies.destroy':
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
                'unique:currencies,name'
            ],
            'code' => [
                'required', 
                'string', 
                'unique:currencies,code'
            ],
            'abbreviation' => [
                'required', 
                'string', 
                'unique:currencies,abbreviation'
            ],
            'exchange_rate' => [
                'required',
                'numeric'
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
            'name' => [
                'required', 
                'string',
                Rule::unique('currencies', 'name')->ignore($this->route('currency'))
            ],
            'code' => [
                'required', 
                'string',
                Rule::unique('currencies', 'code')->ignore($this->route('currency'))
            ],
            'abbreviation' => [
                'required', 
                'string',
                Rule::unique('currencies', 'abbreviation')->ignore($this->route('currency'))
            ],
            'exchange_rate' => [
                'required',
                'numeric'
            ]
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
            'currency' => [
                new CurrencyNotUsed
            ]
        ];
    }
}
