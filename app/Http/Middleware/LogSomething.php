<?php

namespace App\Http\Middleware;

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
//        dump($arr[$count-1]);
        return $next($request);
    }
}
