<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/4
 * Time: 14:38
 */
namespace App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category_Type extends Base
{
    use SoftDeletes;
    //指定表名
    protected $table = 'category_type';
    //指定主键ID
    protected $primaryKey='id';
    //软删除
    protected $dates = ['deleted_at'];
}