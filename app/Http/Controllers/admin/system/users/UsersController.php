<?php

namespace App\Http\Controllers\admin\system\users;

use App\Http\Controllers\BackBaseController;
use App\Http\Requests\CheckUsers;
use App\Model\Roles;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UsersController extends BackBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.system.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Roles $roles)
    {
        $data['roles']=$roles->get();
        return view('admin.system.users.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckUsers $request,User $user,Roles $roles)
    {
            $user->name=$request->input('name');
            $user->password=$request->input('psw');
            $user->email=$request->input('email');
            //获取角色
            $name=$roles->where('id',$request->input('roles'))->first();
            $user->assignRole($name->name);
            try{
                $res=$user->save();
                return $res?['code'=>1]:['code'=>0];
            }catch (\Exception $e){
                Log::error("错误提示".$e->getMessage());
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles=new Roles();
        $data['roles']=$roles->get();

        $user=new User();

        $user=$user->find($id);
//        $dd=$user->getAllPermissions();
//        dd($dd);
        $data['role']=$user->getRoleNames();
        $data['info']=$user;
        return view('admin.system.users.edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckUsers $request,$id)
    {

        $user=new User();
        $user=$user->find($id);
        $user->name=$request->input('name');
        if($request->input('psw')!=null){
            $user->password=$request->input('psw');
        }
        $user->email=$request->input('email');
        //获取传入的角色名称
        $role=new Roles();
        $role=$role->find($request->input('roles'));
        //重新同步角色
        $user->syncRoles($role->name);
        $user->givePermissionTo('system_site');
        try{
            $res=$user->save();
            return $res?['code'=>1]:['code'=>0];
        }catch (\Exception $e){
            Log::error("错误提示".$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=new User();
        $user=$user->find($id);
        //获取用户当前的角色
        $roles_name=$user->getRoleNames();
        //把当前角色从用户中去除
        $user->removeRole($roles_name[0]);
        //删除指定用户
        try{
            $res=$user->destroy($id);
            return $res?['code'=>1]:['code'=>0];
        }catch (\Exception $e){
            Log::error("错误提示".$e->getMessage());
        }

    }

    //用户数据列表
    public function users_ajax_list(Request $request,User $user){
        $PageId = $request->input('page',1);
        $limit = $request->input('limit',10);
        $offset = ($PageId-1)*$limit;
        if($request->has('search')){
            $search = $request->input('search');
            $data  = $user->get_limit([['name','like','%'.$search.'%']],$offset,$limit);
            $count = $user->where([['name','like','%'.$search.'%']])->count();
        }else{
            $data  = $user->get_limit([],$offset,$limit);
            $count = $user->count();
        }
        return ['code'=>0,'count'=>$count,'data'=>$data];
    }
}
