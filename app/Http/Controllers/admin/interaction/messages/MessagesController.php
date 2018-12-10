<?php

namespace App\Http\Controllers\admin\interaction\messages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Messages;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.interaction.messages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    //ajax列表
    public function ajax_list(Request $request,Messages $messages){
        $PageId = $request->input('page',1);
        $limit = $request->input('limit',10);
        $offset = ($PageId-1)*$limit;
        if($request->has('search')){
            $search = $request->input('search');
            $data  = $messages->get_limit([['message','like','%'.$search.'%']],$offset,$limit);
            $count = $messages->where([['message','like','%'.$search.'%']])->count();
        }else{
            $data  = $messages->get_limit([],$offset,$limit);
            $count = $messages->count();
        }
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }
    //多删除
    public function delAll(Request $request,Messages $messages){
        $res = $messages->whereIn('id',$request->input('data'))->delete();
        return ajax_return($res);
    }
}
