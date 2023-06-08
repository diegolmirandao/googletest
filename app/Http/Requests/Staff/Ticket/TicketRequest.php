<?php

namespace App\Http\Requests\Staff\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            case 'tickets.index':
                $rules = $this->index();
                break;
            case 'tickets.store':
                $rules = $this->store();
                break;
            case 'tickets.update':
                $rules = $this->update();
                break;
            case 'tickets.close':
                $rules = $this->close();
                break;
            case 'tickets.destroy':
                $rules = $this->destroy();
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
            //
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
            'business_id' => [
                'required',
                'integer',
                'exists:businesses,id'
            ],
            'ticket_department_id' => [
                'required',
                'integer',
                'exists:ticket_departments,id'
            ],
            'message' => [
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
            'business_id' => [
                'required',
                'integer',
                'exists:businesses,id'
            ],
            'ticket_department_id' => [
                'required',
                'integer',
                'exists:ticket_departments,id'
            ],
            'ticket_status_id' => [
                'required',
                'integer',
                'exists:ticket_statuses,id'
            ],
            'generated_at' => [
                'date',
                'nullable'
            ],
            'message' => [
                'string'
            ],
        ];
    }

    /**
     * Get the validation rules that apply to the close request.
     *
     * @return array
     */
    public function close()
    {
        return [
            //
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
