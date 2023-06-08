<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NumericOrArray;

class UserRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'users.store':
                $rules = $this->store();
                break;
            case 'users.update':
                $rules = $this->update();
                break;
            case 'users.destroy':
                $rules = $this->destroy();
                break;
            default:
                $rules = $this->index();
                break;
        }

        return $rules;
    }

    /**
     * Get the validation rules that apply to the get request.
     *
     * @return array
     */
    public function index()
    {
        return [
            'name' => [
                'string',
            ],
            'username' => [
                'string'
            ],
            'email' => [
                'string'
            ],
            'status' => [
                'boolean'
            ],
            'roles.id' => [
                new NumericOrArray,
                'exists:roles,id'
            ],
            'roles.id.*' => [
                'integer',
                'exists:roles,id'
            ],
            'created_at' => [
                'date'
            ]
        ];
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
                'string'
            ],
            'username' => [
                'required',
                'string',
                'unique:users,username'
            ],
            'email' => [
                'required',
                'string',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string'
            ],
            'status' => [
                'boolean'
            ],
            'role_id' => [
                'required',
                'integer',
                'exists:roles,id'
            ],
            'permissions' => [
                'required',
                'array'
            ],
            'permissions.*' => [
                'string',
                'exists:permissions,name'
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
                'string'
            ],
            'username' => [
                'required',
                'string',
                'unique:users,username,'.$this->route()->parameter('user')->id
            ],
            'email' => [
                'required',
                'string',
                'unique:users,email,'.$this->route()->parameter('user')->id
            ],
            'status' => [
                'boolean'
            ],
            'role_id' => [
                'required',
                'integer',
                'exists:roles,id'
            ],
            'permissions' => [
                'required',
                'array'
            ],
            'permissions.*' => [
                'string',
                'exists:permissions,name'
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

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'permissions.required' => 'Por favor seleccionar permisos',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'permissions' => 'permisos',
        ];
    }
}
