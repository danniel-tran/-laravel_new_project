<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    private $table            = 'article';
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
        $id = $this->id;

        $condThumb = 'bail|required|mimes:jpeg,jpg,png,gif|max:500';
        $condName  = "bail|required|between:5,100|unique:$this->table,name";

        if(!empty($id)){
            $condThumb   = 'bail|mimes:jpeg,jpg,png,gif|max:500';
            $condName  .= ",$id";
        }
        return [
            'name'        => $condName,
            'category_id' => 'bail|required|numeric',
            'type'        => 'bail|required|in:featured,normal',
            'content'     => 'bail|required|min:5',
            'status'      => 'bail|in:active,inactive',
            'thumb'       => $condThumb
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Name không được rỗng',
            // 'name.min'  => 'Name :input chiều dài ít nhất phải là :min ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'category',
            // 'description' => 'Field description',
        ];
    }
}
