<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Auth extends Base
{
    //指定表名
    protected $table = 'permissions';
    //指定主键ID
    protected $primaryKey='id';
}
