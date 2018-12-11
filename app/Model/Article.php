<?php
/**
 * Created by PhpStorm.
 * User: 黄啸天
 * Date: 2018/12/11/011
 * Time: 14:57
 */
namespace App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Article extends Base
{
    use SoftDeletes;
    //指定表名
    protected $table = 'article';
    //指定主键ID
    protected $primaryKey='id';
    //软删除
    protected $dates = ['deleted_at'];

}