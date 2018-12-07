<?php

namespace App\Http\Controllers\admin\system\media;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Media;
use App\Model\Category;
class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.system.media.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('admin.system.media.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = new Media();
        //获取七牛对应的默认上传外链接
        $media_info = $media->find($id);
        //判断当前文件是否存在
        $disk = \Storage::disk('qiniu');

        if($disk->exists(preg_replace("/^((http:\/\/)|(https:\/\/))?([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}\//","",$media_info->src))){
            //调用删除接口
            $disk->delete(preg_replace("/^((http:\/\/)|(https:\/\/))?([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}\//","",$media_info->src));
        }
        $res = $media->destroy($id);
        return ajax_return($res);
    }

    //ajax返回数据
    public function ajax_list(Request $request,Media $media){
        $PageId = $request->input('page',1);
        $limit = $request->input('limit',10);
        $offset = ($PageId-1)*$limit;
        $data  = $media->get_limit([],$offset,$limit);
        $count = $media->where([])->count();
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }


    //文件上传
    public function file_upload(Request $request,Media $media){
        $type = 'file';
        //判断文件是否上传成功
        if ($request->file($type)->isValid()){
            $file = $request->file($type);
            //调用上传接口
            $disk = \Storage::disk('qiniu');
            $catalog = 'cms';//文件所在目录
            $result=$disk->put($catalog,$file);
            $res = $media->add(['name'=>$file -> getClientOriginalName(),'src'=>'http://'.config('filesystems')['disks']['qiniu']['domains']['default'].'/'.$result,'type'=>get_file_type($result)]);
            return ajax_return($res);
        }else{
            return ajax_return(0);
        }
    }

    public function open_list(){
        return view('admin.system.media.open_list');
    }
}
