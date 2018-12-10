<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5
 * Time: 14:33
 */
namespace App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Base
{
    use SoftDeletes;
    //指定表名
    protected $table = 'category';
    //指定主键ID
    protected $primaryKey='id';
    //软删除
    protected $dates = ['deleted_at'];

    /**
     * 菜单无限极分类
     * 作者：何志伟
     * 日期：2018-09-07
     */
    public function getTree($data, $pid,$level)
    {
        //声明一个静态数组
        static $tree = [];
        //组装对应的的父结构数组
        foreach ($data as $k1=>$v2){
            $arr[$v2['id']]=$v2['name'];
        }
        //遍历传入的数据
        foreach($data as $k => $v)
        {
            //顶级菜单
            if($v['pid'] == $pid)
            {
                $v['level']=$level;
                if($v['pid']=="0"){
                    $v['parent_name']='顶级菜单';
                }else{
                    //$arr[$v['pid']]['name'] = '|----'.$arr[$v['pid']]['name'];
                    $v['parent_name']=$arr[$v['pid']];
                }
                $tree[] = $v;
                $this->getTree($data, $v['id'],$level+1);
            }
        }
        return $tree;
    }
}