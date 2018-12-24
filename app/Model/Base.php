<?php
/**
 * 基础模型
 * 作者：何志伟
 * 日期：2018-08-30
 */
namespace App\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
class Base extends Model
{
    //定义公共黑名单属性
    protected $expect = ['_token','_method','psw_confirmation'];

    //设置当字段为psw的时候自动使用bcrypt存放数据
    public function setPswAttribute($value)
    {
        $this->attributes['psw'] = bcrypt($value);
    }

    //ajax分页
    public function get_limit($where = [],$offset = 0,$limit = 10,$By = 'id'){
        return $this->where($where)->offset($offset)->limit($limit)->orderBy($By,'desc')->get()->toArray();
    }

    /**
     * 作者:fivetong
     * 创建时间：2018/12/8
     * 公共添加方法
     * @param $data 传入需要处理的数据
     * @return bool 返回布尔值
     */
    public function add($data){
        //组装数据
        foreach ($data as $k=>$v){
            //排除数组
            $arr=$this->expect;
            if(!in_array($k,$arr)){
                $this->$k=$v;
            }
        }
        try{
            return $res=$this->save();
        }catch (\Exception $e){
            Log::error("错误提示".$e->getMessage());
        }
    }

    /**
     * 作者:fivetong
     * 创建时间：2018/12/8
     * 公共修改方法
     * @param $id 需求修改的ID
     * @param $data 传入的数据
     * @return mixed 返回混合数据
     */
    public function edit($id,$data){

        $model=$this->find($id);

        //遍历数据,判断数据是否与模型的字段一致
        foreach ($data as $k=>$v){
            //排除数组
            $arr=$this->expect;
            if(!in_array($k,$arr)){
                $model->$k=$v;
            }
        }
        try{
            return $res=$model->save();
        }catch (\Exception $e){
            Log::error("错误提示".$e->getMessage());
        }
    }

    /**
     * 公共删除方法
     * 作者：何志伟
     * 日期：2018-08-31
     * @param $id  需要删除的ID
     * @param null $img  传入参数判断是否需要删除对应的图片
     * @param null $field  传入参数获取对应地址位置图片
     * @return array
     */
    public function del($id){
        try {
            return $this->destroy($id);
        }catch (\Exception $e){
                Log::error("错误提示".$e->getMessage());
        }
    }
    /**
     * 多条删除方法
     * 作者：何志伟
     * 日期：2018-09-03
     * @param $data
     * @param null $img
     * @return bool
     */
    public function delall($data){
        try {
            return $this->whereIn('id',$data)->delete();
        }catch (\Exception $e){
            Log::error("错误提示".$e->getMessage());
        }
    }
}
