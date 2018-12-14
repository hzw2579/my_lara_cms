<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckUsers extends FormRequest
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
        $id = $this->route('user');
        if(!$id){
            $id = $this->route('id');
        }
        return [
            'email'=>'email|unique:users,email,'.$id,
            'name'=>'nullable',
            'psw'=>'nullable|confirmed',
        ];
    }

    public function messages(){
        return [
            'email.email' => '请输入正确的邮箱地址',
            'email.unique' => '邮箱已注册',
//            'name.required'=>'请输入用户名称',
            'psw.filled'=>'请输入用户密码',
            'psw.confirmed'=>'确认密码不一致',
        ];
    }
}
