<?php
namespace App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Link extends Base
{
    use SoftDeletes;
    //指定表名
    protected $table = 'link';
    //指定主键ID
    protected $primaryKey='id';
}