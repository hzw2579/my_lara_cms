<?php

namespace App\Http\Controllers\admin\system\auth;

use App\Model\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.auth.auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.auth.auth.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = Permission::create(['name' => $request->input('name'),'desc'=>$request->input('desc')]);

        return $res?['code'=>1]:['code'=>0];
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
        $auth=new Auth();
        $data['info']=$auth->find($id);
        return view('admin.auth.auth.edit',$data);
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
        $auth=new Auth();
        $res=$auth->edit($id,$request->all());
        return $res?['code'=>1]:['code'=>0];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Permission::findById($id);
        $role->revokePermissionTo($permission);
        $res = $auth->destroy($id);
        return $res?['code'=>1]:['code'=>0];
    }

    public function auth_ajax_list(Request $request,Auth $auth){
        $PageId = $request->input('page',1);
        $limit = $request->input('limit',10);
        $offset = ($PageId-1)*$limit;
        $data  = $auth->get_limit([],$offset,$limit);
        $count = $auth->count();
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }
}
