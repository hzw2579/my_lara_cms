<?php

namespace App\Http\Controllers\admin\content\link;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Link;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.content.link.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.content.link.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Link $link)
    {
        $data = $request->all();
        if($request->input('status',0) == 0){
            $data['status'] = 0;
        }
        $res  = $link->add($data);
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
        $link = new Link();
        $data['info'] = $link->find($id);
        return view('admin.content.link.edit',$data);
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
        $link = new Link();
        $data = $request->all();
        if($request->input('status',0) == 0){
            $data['status'] = 0;
        }
        $res = $link->edit($id,$data);
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
        $link = new Link();
        $res = $link->del($id);
        return ajax_return($res);
    }

    //ajax列表
    public function ajax_list(Request $request,Link $link){
        $PageId = $request->input('page',1);
        $limit = $request->input('limit',10);
        $offset = ($PageId-1)*$limit;
        if($request->has('search')){
            $search = $request->input('search');
            $data  = $link->get_limit([['name','like','%'.$search.'%']],$offset,$limit);
            $count = $link->where([['name','like','%'.$search.'%']])->count();
        }else{
            $data  = $link->get_limit([],$offset,$limit);
            $count = $link->count();
        }
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }
    //多删除
    public function delAll(Request $request,Link $link){
        $res = $link->delall($request->input('data'));
        return ajax_return($res);
    }
}
