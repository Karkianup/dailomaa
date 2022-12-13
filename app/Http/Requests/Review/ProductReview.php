<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class ProductReview extends FormRequest
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
            'message' => 'required|string|max:500',
            'user_id' => 'required|string|exists:users,random_id',
            'product_id' => 'required|string|exists:products,id',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'A review is required',
            'user_id.exists' => 'Your user id is invalid. Please donot try to be oversmart.',
            'product_id.exists' => 'Product id is invalid. Please donot try to be oversmart.',
        ];
    }
}
