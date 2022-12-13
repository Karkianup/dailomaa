<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategory extends FormRequest
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
            'name' => 'required', 'string', 'max:255', 'unique:categories,' . $this->name,
            'image' => 'nullable|image|max:255',
            'is_featured' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ];
    }
}
