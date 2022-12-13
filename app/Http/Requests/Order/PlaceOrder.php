<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrder extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'payment_method' => 'required|exists:payment_methods,slug',
            // 'quantity' => 'required|integer|min:5',
        ];
    }

    public function messages()
    {
        return [
            'product_id.exists' => 'Product id is invalid. Please donot try to be oversmart.',
            'payment_method.exists' => 'Payment method is invalid. Please donot try to be oversmart.',
        ];
    }
}
