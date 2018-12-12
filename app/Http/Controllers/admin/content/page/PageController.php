<?php

namespace App\Http\Controllers\admin\content\page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.content.page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.page.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page();
        $data = $request->all();
        if($request->input('status',0) == 0){
            $data['status'] = 0;
        }
        $res = $page->add($data);
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
        $page = new Page();
        $data['info'] = $page->find($id);
        return view('admin.content.page.edit',$data);
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
        $page = new Page();
        $data = $request->all();
        if($request->input('status',0) == 0){
            $data['status'] = 0;
        }
        $res = $page->edit($id,$data);
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
        $page = new Page();
        $res = $page->del($id);
        return ajax_return($res);
    }

    //ajax列表
    public function ajax_list(Request $request,Page $page){
        $PageId = $request->input('page',1);
        $limit = $request->input('limit',10);
        $offset = ($PageId-1)*$limit;
        if($request->has('search')){
            $search = $request->input('search');
            $data  = $page->get_limit([['title','like','%'.$search.'%']],$offset,$limit);
            $count = $page->where([['title','like','%'.$search.'%']])->count();
        }else{
            $data  = $page->get_limit([],$offset,$limit);
            $count = $page->count();
        }
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }
    //多删除
    public function delAll(Request $request,Page $page){
        $res = $page->delall($request->input('data'));
        return ajax_return($res);
    }
}
