<?php

namespace App\Http\Controllers\admin\system\site;

use App\Http\Requests\CheckSite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Site;
use test\Mockery\Fixtures\EmptyTestCaseV5;

class SiteController extends Controller
{
    //站点设置
    public function site(Site $site){
        $data['list'] = $site->find(1);
        return view('admin.system.site.site',$data);
    }
    //SEO设置
    public function seo(Site $site){
        $data['list'] = $site->find(1);
        return view('admin.system.site.seo',$data);
    }
    //基本信息
    public function basic(Site $site){
        $data['list'] = $site->find(1);
        return view('admin.system.site.basic',$data);
    }
    //联系方式
    public function contact(Site $site){
        $data['list'] = $site->find(1);
        //判断百度地图经纬度是否存在
        if(!empty($data['list']['coord'])){
            $data['list']['coord'] = explode('-',$data['list']['coord']);
        }
        return view('admin.system.site.contact',$data);
    }
    //修改
    public function edit(CheckSite $request,Site $site){
        $data = $request->all();
        $res = $site->edit($data['id'],$data);
        if($res){
            return ['code' => 1];
        }else{
            return ['code' => 0];
        }
    }
}
