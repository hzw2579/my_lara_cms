<?php

namespace App\Http\Controllers\admin\system\category;

use App\Http\Requests\CheckCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Category_Type;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $data['list'] = $category->getTree($category->get()->toarray(),'0','1');
        return view('admin.system.category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category_Type $category_Type,Category $category)
    {
        $data['type_list'] = $category_Type->get();
        $data['list'] = $category->getTree($category->where([['status','=',1]])->get()->toarray(),'0','1');
        return view('admin.system.category.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckCategory $request,Category $category)
    {

        $data = $request->all();
        if($request->input('status',0) == 0){
            $data['status'] = 0;
        }
        $res  = $category->add($data);
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
        $category = new Category();
        $data['info'] = $category->find($id);
        $data['list'] = $category->getTree($category->where([['status','=',1]])->get()->toarray(),'0','1');
        return view('admin.system.category.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckCategory $request, $id)
    {
        $category = new Category();
        $data = $request->all();
        if($request->input('status',0) == 0){
            $data['status'] = 0;
        }
        $res = $category->edit($id,$data);
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
        $category = new Category();
        $res = $category->del($id);
        return ajax_return($res);
    }

    //ajax返回
    public function ajax_list(Category $category){
        $data = $category->getTree($category->get()->toarray(),'0','1');
        $count = $category->count();
        foreach($data as $k => $v){
            $data[$k]['name'] = str_repeat("|----",$v['level']-1).$v['name'];
            $data[$k]['type'] = get_cate_type($v['type']);
            if($v['status'] == 1){
                $data[$k]['status'] = '<button class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal">启用</button>';
            }else{
                $data[$k]['status'] = '<button class="layui-btn layui-btn-xs layui-btn-radius layui-btn-disabled">禁用</button>';
            }
        }
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }
}
