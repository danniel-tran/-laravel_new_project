<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{
    private $table            = 'user';
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
            'email'    => 'bail|required|email',
            'password' => 'bail|required|between: 5,100'
        ];
    }

    public function messages()
    {
        return [];
    }
    public function attributes()
    {
        return [];
    }
}
