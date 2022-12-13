<?php

namespace App\Http\Requests\ProductFilter;

use Illuminate\Foundation\Http\FormRequest;

class PriceWiseRequest extends FormRequest
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
            'min' => 'required|integer|min:10',
            'max' => 'required|integer|min:10',
        ];
    }
}
