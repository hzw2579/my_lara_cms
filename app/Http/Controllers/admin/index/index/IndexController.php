<?php

namespace App\Http\Controllers\admin\index\index;

use App\Events\LogEvent;
use App\Http\Controllers\BackBaseController;
use App\Http\Requests\CheckLogin;
use App\Http\Requests\CheckUsers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        //调用laravel默认判断
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user=new User();
            $user=$user->where('email',$data['email'])->first();
            $session=[
                'name'=>$user->name,
                'id'=>$user->id,
                'email'=>$user->email
            ];
            session($session);
            event(new LogEvent('用户登录'));
            return true;
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
        event(new LogEvent('用户退出登录'));
        session()->forget(['name','id','email']);
        Auth::logout();

        return redirect('admin/login');
    }

    public function info_edit($id){
        $user=new User();
        $data['info']=$user->find($id);
        return view('admin.index.index.info_edit',$data);
    }

    public function user_edit($id,CheckUsers $request,User $user){
        $user=$user->find($id);
        $res=$user->edit($id,$request->all());
        event(new LogEvent('用户修改个人信息'));
        return $res?['code'=>1]:['code'=>0];
    }

    public function psw_edit($id){
        $user=new User();
        $data['info']=$user->find($id);
        return view('admin.index.index.psw_edit',$data);
    }


}
