<?php
/**
 * 基础模型
 * 作者：何志伟
 * 日期：2018-08-30
 */
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
class Base extends Model
{
    //ajax分页
    public function get_limit($where = [],$offset = 0,$limit = 10,$By = 'id'){
        return $this->where($where)->offset($offset)->limit($limit)->orderBy($By,'desc')->get()->toArray();
    }
    /**
     * 公共添加方法
     * 作者：何志伟
     * 日期：2018-09-03
     * @param $data 传入需要写入的参数
     * @param array $field  需要特别处理的字段
     * @param array $expect 需要排除的字段
     * @param array $edit   需要修改参数名的字段
     * @return mixed
     */
    public function add($data,$field=[],$expect=['_token','_method'],$edit=[]){
        foreach ($data as $k=>$v){
            //如果关键字在排除字段中则不组装该字段的数组结构
            if(in_array($k,$expect)){
                continue;
            }
            //判断如果存在密码字段
            if($k=="psw"){
                $arr[$k]=bcrypt($v);
                continue;
            }
            //判断如果存在特别处理字段
            if(array_key_exists($k,$field)){
                //判断是否需要字段修改的
                if(array_key_exists($k,$edit)){
                    $arr[$edit[$k]]=$field[$k];
                }else{
                    if($field[$k]=="json"){
                        $arr[$k]=json_encode($v);
                        continue;
                    }
                    $arr[$k]=$field[$k];
                }
                continue;
            }
            $arr[$k]=$v;
        }

        $arr['created_at']=date('Y-m-d H:i:s',time());
        $arr['updated_at']=date('Y-m-d H:i:s',time());
        $res=$this->insertGetId($arr);
        return $res;
    }
    /**
     * @param $id 需要更新的数据
     * @param $data 传入需要写入的参数
     * @param array $field 需要特别处理的字段
     * @param array $expect 需要排除的字段
     * @param array $edit 需要修改参数名的字段
     */
    public function edit($id,$data,$field=[],$expect=['_token','_method'],$edit=[]){
        foreach ($data as $k=>$v){
            //如果关键字在排除字段中则不组装该字段的数组结构
            if(in_array($k,$expect)){
                continue;
            }
            if($v === NULL){
                continue;
            }
            //判断如果存在密码字段
            if($k=="psw"){
                $arr[$k]=bcrypt($v);
                continue;
            }
            //判断如果存在特别处理字段
            if(array_key_exists($k,$field)){
                //判断是否需要字段修改的
                if(array_key_exists($k,$edit)){
                    $arr[$edit[$k]]=$field[$k];
                }else{

                    if($field[$k]=="json"){
                        $arr[$k]=json_encode($v);
                        continue;
                    }
                    $arr[$k]=$field[$k];
                }
                continue;
            }
            $arr[$k]=$v;
        }
//        $arr['created_at']=date('Y-m-d H:i:s',time());
        $arr['updated_at']=date('Y-m-d H:i:s',time());
        $res=$this->where('id', $id)
            ->update($arr);
        return $res;
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
    public function del($id,$img=null,$field='avatar'){
        //判断当前删除的数据是否有图片需要删除
        if($img!=null){
            $resous=$this->find($id);
            //获取七牛对应的默认上传外链接
            $domains = config('filesystems.disks.qiniu.domains.default');
            //截取对应的字符串
            $img=substr($resous->$field,strlen($domains)+8);
            //判断当前文件是否存在
            $disk = \Storage::disk('qiniu');
            if($disk->exists($img)){
                //调用删除接口
                $disk->delete($img);
            }
        }
        $res= $this->destroy($id);
        if($res){
            return ['code'=>'0','message'=>'删除成功'];
        }else{
            return ['code'=>'0','message'=>'删除失败'];
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
    public function delall($data,$img=null,$field='avatar'){
        foreach ($data['data'] as $v){
            $this->del($v,$img,$field);
        }
        return true;
    }
    //假删除
    public function false_del($id){
        return $this->edit($id,['false_del'=>0]);
    }
}
