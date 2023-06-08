<?php

namespace App\Http\Requests\Staff\Business;

use App\Rules\Staff\Business\BusinessDeleteAllowed;
use App\Rules\Staff\Business\BusinessNotActive;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Staff\Business\BusinessUserNotAssigned;

class BusinessRequest extends FormRequest
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
        if ($this->route()->getName() !== 'businesses.store') {
            $business = $this->route('business');
            $businessUsers = $business->businessUsers();

            $this->merge(['business_user' => $businessUsers->user($this->user_id)->first()]);
            $this->merge(['business' => $business]);
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
            case 'businesses.store':
                $rules = $this->store();
                break;
            case 'businesses.update':
                $rules = $this->update();
                break;
            case 'businesses.destroy':
                $rules = $this->destroy();
                break;
            case 'businesses.activate':
                $rules = $this->activate();
                break;
            case 'businesses.assign':
                $rules = $this->assign();
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
                'alpha_dash', 
                'unique:businesses,name'
            ],
            'customer_name' => [
                'required', 
                'string'
            ],
            'phone' => [
                'required', 
                'string'
            ],
            'email' => [
                'required', 
                'string',
                'email'
            ],
            'services' => [
                'required',
                'array',
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
            'name' => [
                'required', 
                'alpha_dash', 
                Rule::unique('businesses')->ignore($this->route('business')->id)
            ],
            'customer_name' => [
                'required', 
                'string'
            ],
            'phone' => [
                'required', 
                'string'
            ],
            'email' => [
                'required', 
                'string',
                'email'
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
            'business' => [
                new BusinessDeleteAllowed
            ]
        ];
    }

    /**
     * Get the validation rules that apply to the activate request.
     *
     * @return array
     */
    public function activate()
    {
        return [
            'business' => [
                new BusinessNotActive
            ]
        ];
    }

    /**
     * Get the validation rules that apply to the assign request.
     *
     * @return array
     */
    public function assign()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'business_user' => [
                new BusinessUserNotAssigned
            ]
        ];
    }
}
