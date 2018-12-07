<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>站点设置</title>
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
                <div class="layui-card-header">站点设置</div>
                <div class="layui-card-body" pad15>
                    <div class="layui-form" wid100 lay-filter="form">
                        <input type="hidden" name="id" value="{{$list->id}}">
                        {{csrf_field()}}
                        <div class="layui-form-item">
                            <label class="layui-form-label">站点名称</label>
                            <div class="layui-input-block">
                                <input type="text" name="name" value="{{$list->name}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">网站域名</label>
                            <div class="layui-input-block">
                                <input type="text" name="domain" lay-verify="url" value="{{$list->domain}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">备案号</label>
                            <div class="layui-input-block">
                                <input type="text" name="records_number" value="{{$list->records_number}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">统计代码</label>
                            <div class="layui-input-block">
                                <textarea name="statistical_code" class="layui-textarea">{{$list->statistical_code}}</textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">版权信息</label>
                            <div class="layui-input-block">
                                <textarea name="copyright" class="layui-textarea">{{$list->copyright}}</textarea>
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
<script src="{{asset('src')}}/jquery.js"></script>
<script>
    layui.config({
        base: '{{asset('src')}}/' //静态资源所在路径
    }).extend({
        index: 'index' //主入口模块
    }).use(['index', 'set']);
</script>
<script>
    layui.use(['form','layer'], function(){
        var form = layui.form,
            layer = layui.layer;
        //各种基于事件的操作，下面会有进一步介绍
        form.on('submit(*)', function(data){
            console.log(data.field);
            $.ajax({
                url: "/admin/site_edit",
                type: "post",
                async: false,
                cache: false,
                data: data.field,
                success: function (msg) {
                    if(msg.code== 1){
                        layer.msg('保存成功');
                    }else{
                        layer.msg('保存失败');
                    }
                }
            });
        });
    });
</script>
</body>

</html>