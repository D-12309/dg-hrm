<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|max:255',
                    'phone' => 'required|numeric|unique:users,phone,deleted_at',
                    'email' => 'required|email|max:255|unique:users,email,deleted_at',
                    'role_id' => 'required',
                    'department_id' => 'required',
                    'designation_id' => 'required',
                    'gender' => 'required',
                    'country' => 'required|integer',
                    'password' => 'required|min:6|confirmed',
                    'location_id'=>'requiredIf:is_free_location,0',
                ];
            }
            case 'PATCH':
            {
                return [
                    'name' => 'required|max:255',
                    'phone' => 'required|numeric|unique:users,phone,' . $this->id,'deleted_at,NULL',
                    'email' => 'required|email|max:255|unique:users,email,' . $this->id,'deleted_at,NULL',
                    'role_id' => 'required',
                    'department_id' => 'required',
                    'designation_id' => 'required',
                    'gender' => 'required',
                    'location_id'=>'requiredIf:is_free_location,0',
                ];
            }
            default:
                break;
        }

    }
    public function messages()
    {
        return [
            'location_id.required_if' => 'The location field is required when is free location is no.',
        ];
    }

}
