<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBanner extends FormRequest
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
            'title' => 'required', 'string', 'min:5', 'max:200', 'unique:banners', 'title,' . $this->id,
            'description' => 'required|string',
            'url' => 'nullable|string',
            'image' => 'nullable|image',
            'status' => 'required|integer|in:1,2,3',
        ];
    }
}
