<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'description' => 'required',
            'link' => 'bail|required|min:5|url',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name không được rỗng',
            'name.min'  => 'Name :input chiều dài ít nhất phải là :min ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'description' => 'Field description',
        ];
    }
}
