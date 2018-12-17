<?php

namespace App\Listeners;

use App\Events\LogEvent;
use App\Model\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Request;

class LogListen
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LogEvent  $event
     * @return void
     */
    public function handle(LogEvent $event)
    {
        //实例化对应的日志模型
        $log=new Log();
        $str=Request::route()->action['controller'];
        $arr=explode('\\',$str);
        $count=count($arr);
        $log->name=session('name');
        $log->url=Request::path();
        $log->uid=session('id');
        $log->behavior=$event->geteventname();
        $log->controller=$arr[$count-1];
        $log->save();
    }
}
