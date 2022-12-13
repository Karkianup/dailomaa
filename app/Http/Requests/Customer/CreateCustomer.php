<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomer extends FormRequest
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
        return [
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required|min:6',
            'address' => 'nullable', 'string', 'max:255',
            'is_wholesaler' => 'nullable', 'boolean',
            'city' => 'nullable', 'string', 'max:255',
            'country' => 'nullable', 'string', 'max:255',
            'contact_no' => 'nullable', 'string', 'max:255',
            'image' => 'nullable', 'image', 'max:255',
        ];
    }
}
