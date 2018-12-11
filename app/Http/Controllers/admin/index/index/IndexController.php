<?php

namespace App\Http\Controllers\admin\index\index;

use App\Http\Controllers\BackBaseController;
use App\Http\Requests\CheckLogin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class IndexController extends BackBaseController
{
    /**
     * 作者:fivetong
     * 首页展示
     * 创建时间：2018/11/30
     */
    public function index(){
        return view('admin.index.index.index');
    }

    /**
     * 作者:fivetong
     * 用户登录
     * 创建时间：2018/11/30
     */
    public function login(){
        return view('admin.index.index.login');
    }

    public function main(){
        return view('admin.index.index.main');
    }

    public function checklogin($data){
            $user=new User();
            $user=$user->where('email',$data['email'])->first();
            if($user){
                //判断密码是否正确
                if (Hash::check($data['password'],$user->password)) {
                    $session=[
                        'name'=>$user->name,
                        'id'=>$user->id,
                        'email'=>$user->email
                    ];
                    session($session);
                    return true;
                }
                return false;
            }
            return false;

    }

    public function login_now(CheckLogin $request){
        if($request->ajax()){
            $res=$this->checklogin($request->all());
            return $res?['code'=>1]:['code'=>0];
        }
    }

    public function login_out(){
        session()->forget(['name','id','email']);
        return redirect('admin/login');
    }
}
