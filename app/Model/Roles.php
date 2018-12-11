<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Role;
class Roles extends Base
{
    //指定表名
    protected $table = 'roles';
    //指定主键ID
    protected $primaryKey='id';
}
