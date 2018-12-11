<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckCategory extends FormRequest
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
            'name'=>'required',
            'account'=>'required'
        ];
    }
    public function messages(){
        return [
            'name.required' => '请输入分类名称',
            'account.required' => '请输入分类描述',
        ];
    }
}
