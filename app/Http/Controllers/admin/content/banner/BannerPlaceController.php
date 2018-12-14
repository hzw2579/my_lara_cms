<?php

namespace App\Http\Controllers\admin\content\banner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Banner_Place;

class BannerPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.content.banner.place_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.banner.place_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Banner_Place $banner_Place)
    {
        $data = $request->all();
        $res  = $banner_Place->add($data);
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
        $banner_place = new Banner_Place();
        $data['info'] = $banner_place->find($id);
        return view('admin.content.banner.place_edit',$data);
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
        $banner_place = new Banner_Place();
        $data = $request->all();
        $res = $banner_place->edit($id,$data);
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
        $banner_place = new Banner_Place();
        $res = $banner_place->del($id);
        return ajax_return($res);
    }

    //ajax列表
    public function ajax_list(Request $request,Banner_Place $banner_place){
        $PageId = $request->input('page',1);
        $limit = $request->input('limit',10);
        $offset = ($PageId-1)*$limit;
        if($request->has('search')){
            $search = $request->input('search');
            $data  = $banner_place->get_limit([['name','like','%'.$search.'%']],$offset,$limit);
            $count = $banner_place->where([['name','like','%'.$search.'%']])->count();
        }else{
            $data  = $banner_place->get_limit([],$offset,$limit);
            $count = $banner_place->count();
        }
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }

    //多删除
    public function delAll(Request $request,Banner_Place $banner_Place){
        $res = $banner_Place->delall($request->input('data'));
        return ajax_return($res);
    }
}
