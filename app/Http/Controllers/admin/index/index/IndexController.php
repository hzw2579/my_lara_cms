<?php

namespace App\Http\Controllers\admin\index\index;

use App\Http\Controllers\BackBaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
