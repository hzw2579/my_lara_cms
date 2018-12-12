<?php

namespace App\Http\Controllers\admin\content\banner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Banner;
use App\Model\Banner_Place;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.content.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Banner_Place $banner_Place)
    {
        $data['list'] = $banner_Place->get();
        return view('admin.content.banner.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = new Banner();
        $data = $request->all();
        if($request->input('status',0) == 0){
            $data['status'] = 0;
        }
        $res  = $banner->add($data);
        return ajax_return($res);
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
        $banner = new Banner();
        $banner_Place = new Banner_Place();
        $data['info'] = $banner->find($id);
        $data['list'] = $banner_Place->get();
        return view('admin.content.banner.edit',$data);
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
        $banner = new Banner();
        $data = $request->all();
        if($request->input('status',0) == 0){
            $data['status'] = 0;
        }
        $res  = $banner->edit($id,$data);
        return ajax_return($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = new Banner();
        $res = $banner->del($id);
        return ajax_return($res);
    }

    //ajax列表
    public function ajax_list(Request $request, Banner $banner){
        $PageId = $request->input('page',1);
        $limit = $request->input('limit',10);
        $offset = ($PageId-1)*$limit;
        if($request->has('search')){
            $search = $request->input('search');
            $data  = $banner->get_limit([['title','like','%'.$search.'%']],$offset,$limit);
            $count = $banner->where([['title','like','%'.$search.'%']])->count();
        }else{
            $data  = $banner->get_limit([],$offset,$limit);
            $count = $banner->count();
        }
        foreach($data as $k => $v){
            $data[$k]['place'] = get_banner_place($v['place']);
        }
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }
    //多删除
    public function delAll(Request $request,Banner $banner){
        $res = $banner->delall($request->input('data'));
        return ajax_return($res);
    }

}
