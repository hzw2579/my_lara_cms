<?php

namespace App\Http\Controllers\admin\system\auth;
use Illuminate\Support\Facades\DB;
use App\Model\Auth;
use App\Model\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.auth.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Auth $auth)
    {
        $data['auth']=$auth->get();
        return view('admin.auth.roles.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth=new Auth();
        $role=Role::create(['name'=>$request->input('name')]);
        //根据权限获取权限列表
        $res=$role->syncPermissions($request->input('auths'));
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
    public function edit($id,Auth $auth)
    {
        $roles=new Roles();
        //角色基本信息
        $data['info']=$roles->find($id);
        //权限列表
        $data['auth']=$auth->get();
        //拥有的权限
        $data['has']= DB::table('role_has_permissions')->select('permission_id')->where('role_id',$id)->get()->toarray();
        //重新组装has数据
        foreach ($data['has'] as $k=>$v){
            $data['has'][$k]=$v->permission_id;
        }
        return view('admin.auth.roles.edit',$data);
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
        $roles=Role::findById($id);
        $res=$roles->syncPermissions($request->input('auths'));
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
       $roles=new Roles();
       $res=$roles->destroy($id);
        return $res?['code'=>1]:['code'=>0];
    }

    //ajax列表
    public function roles_ajax_list(Request $request,Roles $roles){
        $PageId = $request->input('page',1);
        $limit = $request->input('limit',10);
        $offset = ($PageId-1)*$limit;
        $data  = $roles->get_limit([],$offset,$limit);
        $count = $roles->count();
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }
}
