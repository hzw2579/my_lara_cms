<?php

namespace App\Http\Controllers\admin\system\category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category_Type;

class CategoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category_Type $category_type)
    {
        $data['count'] = $category_type->where([['false_del','=',1]])->count();
        return view('admin.system.category.type_index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.system.category.type_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Category_Type $category_Type)
    {
        $res = $category_Type->add($request->all(),[],['_token']);
        if($res){
            return ['code'=>1];
        }else{
            return ['code'=>0];
        }
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
    public function edit(Category_Type $category_Type,$id)
    {
        $data['list'] = $category_Type->find($id);
        return view('admin.system.category.type_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category_Type $category_Type,Request $request, $id)
    {
        $res = $category_Type->edit($id,$request->all());
        return ajax_return($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category_Type $category_Type,$id)
    {
            $res = $category_Type->false_del($id);
            return ajax_return($res);
    }

    //ajax列表
    public function type_ajax_list(Request $request,Category_Type $category_type){
        $PageId = $request->input('page',1);
        $limit = $request->input('limit',10);
        $offset = ($PageId-1)*$limit;
        $data  = $category_type->get_limit([['false_del','=',1]],$offset,$limit);
        $count = $category_type->where([['false_del','=',1]])->count();
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }
}
