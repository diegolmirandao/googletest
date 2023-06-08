<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class SupplierContactRequest extends FormRequest
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
            case 'suppliers.contacts.store':
                $rules = $this->store();
                break;
            case 'suppliers.contacts.update':
                $rules = $this->update();
                break;
            case 'suppliers.contacts.destroy':
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
            ],
            'phone' => [
                'nullable', 
                'string'
            ],
            'email' => [
                'nullable', 
                'email'
            ],
            'comments' => [
                'nullable', 
                'string',
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
            ],
            'phone' => [
                'nullable', 
                'string'
            ],
            'email' => [
                'nullable', 
                'email'
            ],
            'comments' => [
                'nullable', 
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
            //
        ];
    }
}
