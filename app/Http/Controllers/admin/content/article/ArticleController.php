<?php

namespace App\Http\Controllers\admin\content\article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Article;
use App\Model\Category;
use App\Events\LogEvent;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.content.article.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Article $article,Category $category)
    {
        $data['cate_list'] = $category->getTree($category->where([['type','=',1],['status','=',1]])->get()->toarray(),'0','1');
        return view('admin.content.article.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Article $article)
    {
        $data = $request->all();
        if($request->input('status',0) == 0){
            $data['status'] = 0;
        }
        $res  = $article->add($data);
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
        $article = new Article();
        $category = new Category();
        $data['info'] = $article->find($id);
        $data['cate_list'] = $category->getTree($category->where([['type','=',1],['status','=',1]])->get()->toarray(),'0','1');
        return view('admin.content.article.edit',$data);
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
        $article = new Article();
        $data = $request->all();
        if($request->input('status',0) == 0){
            $data['status'] = 0;
        }
        $res  = $article->edit($id,$data);
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
        $article = new Article();
        $res = $article->del($id);
        event(new LogEvent('用户删除文章'));
        return ajax_return($res);
    }

    //ajax列表
    public function ajax_list(Request $request,Article $article){
        $PageId = $request->input('page',1);
        $limit = $request->input('limit',10);
        $offset = ($PageId-1)*$limit;
        if($request->has('search')){
            $search = $request->input('search');
            $data  = $article->get_limit([['title','like','%'.$search.'%']],$offset,$limit);
            $count = $article->where([['title','like','%'.$search.'%']])->count();
        }else{
            $data  = $article->get_limit([],$offset,$limit);
            $count = $article->count();
        }
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }

    //多删除
    public function delAll(Request $request,Article $article){
        $res = $article->delall($request->input('data'));
        return ajax_return($res);
    }
}
