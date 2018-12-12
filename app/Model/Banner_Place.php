<?php
/**
 * Created by PhpStorm.
 * User: 黄啸天
 * Date: 2018/12/12/012
 * Time: 10:45
 */
namespace App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Banner_Place extends Base
{
    use SoftDeletes;
    //指定表名
    protected $table = 'banner_place';
    //指定主键ID
    protected $primaryKey='id';
    //软删除
    protected $dates = ['deleted_at'];

}