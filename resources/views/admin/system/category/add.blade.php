<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 分类管理 iframe 框</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{asset('src')}}/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{{asset('src')}}/style/admin.css" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-form" wid100 lay-filter="lay-form">
                    {{csrf_field()}}
                    <div class="layui-form-item">
                        <label class="layui-form-label">分类名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" value="" class="layui-input" lay-verify="required">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">分类类型</label>
                        <div class="layui-input-block">
                            <select name="type" lay-verify="required" lay-filter="">
                                @foreach($type_list as $v)
                                <option value="{{$v->id}}">{{$v->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">上级菜单</label>
                        <div class="layui-input-block">
                            <select name="pid" lay-verify="required" lay-filter="" lay-search>
                                <option value="0">顶级菜单</option>
                                @foreach($list as $v)
                                <option value="{{$v['id']}}">{{str_repeat("|----",$v['level']-1)}}{{$v['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">分类描述</label>
                        <div class="layui-input-block">
                            <textarea name="account" placeholder="" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-block">
                            <input type="text" lay-verify="number" name="sort"  value="" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">分类图标</label>
                        <div class="layui-col-md8">
                            <input type="text" name="icon"  value="" class="layui-input">
                        </div>
                        <div class="layui-col-md2">
                            <button id="imgbutton" class="layui-btn">选择图片</button>
                        </div>
                    </div>
                    <div class="layui-form-item" style="text-align:center;">
                        <img id="icon"  src="{{asset('src')}}/style/res/a5.jpg" style="width: 300px;">
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">分类状态</label>
                        <div class="layui-input-block">
                            <input type="checkbox" checked value="1" name="status" lay-skin="switch" lay-text="启用|禁用">
                        </div>
                    </div>

                    <div class="layui-form-item" style="text-align:center;">
                            <button class="layui-btn" lay-submit lay-filter="*">确认保存</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<script src="{{asset('src')}}/layui/layui.js"></script>
<script>
    layui.config({
        base: '{{asset('src')}}/' //静态资源所在路径
    }).extend({
        index: 'index' //主入口模块
    }).use(['index', 'form'], function () {
        var $ = layui.$
            , form = layui.form;
    })
</script>
<script>
    layui.use(['form','layer'], function(){
        var form = layui.form,
            layer = layui.layer,
            $ = layui.$;
        //各种基于事件的操作，下面会有进一步介绍
        form.on('submit(*)', function(data){
            console.log(data.field);
            $.ajax({
                url: "/admin/category",
                type: "post",
                async: false,
                cache: false,
                data: data.field,
                success: function (msg) {
                    if(msg.code== 1){
                        layer.msg('保存成功');
                        // parent.tableIns.reload()
                        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                        parent.layer.close(index); //再执行关闭
                    }else{
                        layer.msg('保存失败');
                    }
                },
                error:function (msg) {
                    console.log(msg);
                    $.each(msg.responseJSON.errors,function (k,v) {
                        layer.msg(v[0]);
                    })
                }
            });
        });
        $('#imgbutton').on('click',function(){
            layer.open({
                type: 2,
                title:'附件管理',
                area: ['1000px', '700px'],
                fixed: false, //不固定
                maxmin: true,
                offset: 't',
                content: '{{url('admin/media_open_list')}}',
                //关闭是的回调函数
                end:function () {
                    //获取本地保存的src地址
                    var storage=window.localStorage;
                    var path=storage.getItem("src");
                    if(storage.getItem("src")==null){
                        return ;
                    }
                    //把对应的src地址传值
                    $("#icon").attr('src',path);
                    form.val("lay-form", {
                        "icon": path
                    })
                    //清除对应的本地缓存
                    storage.removeItem("src");
                }
            });
        });
    });
</script>
</body>
</html>