<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SiteSetting extends FormRequest
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
            'title' => 'required|string',
            'email' => 'nullable|string',
            'telephone_no' => 'nullable|string',
            'mobile_no' => 'nullable|string',
            'fax' => 'nullable|string',
            'address' => 'nullable|string',
            'post_code' => 'nullable|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'default_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'skype' => 'nullable|string',
            'meta_title' => 'sometimes|string',
            'meta_keywords' => 'sometimes|string',
            'meta_description' => 'sometimes|string',
            'site_url' => 'required|string',
        ];
    }
}
