<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/10
 * Time: 17:18
 */
namespace App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Messages extends Base
{
    use SoftDeletes;
    //指定表名
    protected $table = 'Messages';
    //指定主键ID
    protected $primaryKey='id';
}