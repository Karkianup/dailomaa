<?php

namespace App\Http\Requests\Retailer;

use Illuminate\Foundation\Http\FormRequest;

class CreateRetailer extends FormRequest
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
            'email' => 'required', 'string', 'email', 'max:255', 'unique:retailers',
            'password' => 'required|min:6',
            'address' => 'nullable', 'string', 'max:255',
            'city' => 'nullable', 'string', 'max:255',
            'country' => 'nullable', 'string', 'max:255',
            'contact_no' => 'nullable', 'string', 'max:255',
            'image' => 'nullable', 'image', 'max:255',
        ];
    }
}
