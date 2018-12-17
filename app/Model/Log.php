<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Log extends Base
{
    //指定表名
    protected $table = 'log';
    //指定主键ID
    protected $primaryKey='id';
}
