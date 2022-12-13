<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class CreateBrand extends FormRequest
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
            'name' => 'required|string|max:255|unique:brands',
            'image' => 'required|image|max:255',
            'is_featured' => 'required|string',
            'category_id' => 'required|integer',
            'sub_category_id' => 'nullable|integer',
            'status' => 'required|boolean',
        ];
    }
}
