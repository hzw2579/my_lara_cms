<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckLogin extends FormRequest
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
            'email'=>'email|required',
            'password'=>'required',
            'captcha'=>'required|captcha'
        ];
    }
    public function messages(){
        return [
            'email.email' => '请输入正确的邮箱地址',
            'email.required' => '请输入邮箱地址',
            'password.required'=>'请输入用户密码',
            'captcha.required'=>'请输入验证码',
            'captcha.captcha'=>'请输入正确的验证码',
        ];
    }
}
