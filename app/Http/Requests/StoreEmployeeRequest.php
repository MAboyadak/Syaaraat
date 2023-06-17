<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // return [];
        return [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email|unique:employees,email',
            'phone'         => 'required|unique:employees,phone',
            'password'      => 'required|min:8',
            'salary'        => 'required',
            'department_id' => 'nullable',
            'manager_id'    => 'nullable',
            'role'          => 'nullable',
            'image'         => 'nullable|mimes:jpg,jpeg,png,gif|max:5000'
        ];
    }
}
