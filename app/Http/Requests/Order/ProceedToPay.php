<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class ProceedToPay extends FormRequest
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
            // 'product_id' => 'required|exists:products,id',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            // 'quantity' => 'required|integer|min:5',
            'address' => 'required|string|min:5|max:200',
            'contact_no' => 'required|numeric|digits:10'
        ];
    }

    public function messages()
    {
        return [
            'product_id.exists' => 'Product id is invalid. Please donot try to be oversmart.',
            'contact_no.size' => 'The contact number must be of 10 digits.',
        ];
    }
}
