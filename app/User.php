<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    protected $guard_name = 'web'; // or whatever guard you want to use

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //ajax分页
    public function get_limit($where = [],$offset = 0,$limit = 10,$By = 'id'){
        return $this->where($where)->offset($offset)->limit($limit)->orderBy($By,'desc')->get()->toArray();
    }

    public function edit($id,$data){
        $model=$this->find($id);
        //遍历数据,判断数据是否与模型的字段一致
        foreach ($data as $k=>$v){
            if(isset($model->$k) && $data[$k]!==null){
                $model->$k=$v;
            }
        }
        try{
            return $res=$model->save();
        }catch (\Exception $e){
            Log::error("错误提示".$e->getMessage());
        }
    }

    //设置当字段为psw的时候自动使用bcrypt存放数据
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
