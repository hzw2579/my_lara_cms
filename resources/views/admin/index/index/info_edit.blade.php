<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>修改管理员</title>
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
                    <div class="layui-form" wid100 lay-filter="">
                        {{csrf_field()}}
                        {{--{{ method_field('PUT') }}--}}
                        <div class="layui-form-item">
                            <label class="layui-form-label">管理员名称</label>
                            <div class="layui-input-block">
                                <input type="text" name="name" value="{{$info->name}}" class="layui-input" lay-verify="required">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">邮箱地址</label>
                            <div class="layui-input-block">
                                <input type="text" lay-verify="email" name="email"  value="{{$info->email}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="*">确认保存</button>
                            </div>
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
            layer = layui.layer;
        //各种基于事件的操作，下面会有进一步介绍
        form.on('submit(*)', function(data){
            console.log(data.field);
            $ = layui.$;
            $.ajax({
                url: "/admin/user_edit/{{$info->id}}",
                type: "post",
                async: false,
                cache: false,
                data: data.field,
                success: function (msg) {
                    if(msg.code== 1){
                        layer.msg('保存成功');
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
    });
</script>
</body>
</html>