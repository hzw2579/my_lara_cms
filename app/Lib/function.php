<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/3
 * Time: 17:54
 */
//ajax返回
function ajax_return($code = '' , $msg = '', $data = []){
    if($code){
        return ['code'=> 1,'msg' => $msg, 'data' => $data];
    }else{
        return ['code'=> 0,'msg' => $msg, 'data' => $data];
    }
}
//判断文件类型
function get_file_type($file){
    $img = ['gif','jpg','png','bmp','jpeg'];
    $video = ['avi','wmv','mpeg','mp4','mov','mkv','flv','f4v','m4v','rmvb','rm','3gp','dat','ts','mts','vob'];
    $redio = ['cd','ogg','mp3','asf','wma','wav','vqf','midi','module','ape','real','rm','mp3pro','mpga'];
    $file_name = strtolower(substr(strrchr($file, '.'), 1));
    if(in_array($file_name , $img)){
        return 'img';
    }
    if(in_array($file_name , $video)){
        return 'video';
    }
    if(in_array($file_name , $redio)){
        return 'redio';
    }
    return '';
}

function get_cate_type($id){
    $type = DB::table('category_type')->where(['id'=>$id,'false_del'=>1])->first();
    if(empty($type)){
        return '';
    }
    return  $type->name;
}