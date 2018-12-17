<?php

namespace App\Http\Middleware;

use App\Model\Log;
use Closure;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class LogSomething
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $str=$request->route()->action['controller'];
        $arr=explode('\\',$str);
        $count=count($arr);
        //写入数据库
        //判断用户是否已经登录
        if(session('id')!=null){
            $log=new Log();
            $log->name=session('name');
            $log->url=$request->path();
            $log->controller=$arr[$count-1];
            $log->save();

        }

        return $next($request);
    }
}
