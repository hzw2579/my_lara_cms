<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>联系方式</title>
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
                <div class="layui-card-header">联系方式</div>
                <div class="layui-card-body" pad15>

                    <div class="layui-form" wid100 lay-filter="">
                        <input type="hidden" name="id" value="{{$list->id}}">
                        {{csrf_field()}}
                        <div class="layui-form-item">
                            <label class="layui-form-label">联系人</label>
                            <div class="layui-input-block">
                                <input type="text" name="linkman" value="{{$list->linkman}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">联系电话</label>
                            <div class="layui-input-block">
                                <input type="text" name="phone"  value="{{$list->phone}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">移动电话</label>
                            <div class="layui-input-block">
                                <input type="text" name="mobile_phone"  value="{{$list->mobile_phone}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">传真</label>
                            <div class="layui-input-block">
                                <input type="text" name="fax"  value="{{$list->fax}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">地址</label>
                            <div class="layui-input-block">
                                <input type="text" name="location"  value="{{$list->location}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">邮箱</label>
                            <div class="layui-input-block">
                                <input type="text" name="email"  value="{{$list->email}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">qq</label>
                            <div class="layui-input-block">
                                <input type="text" name="qq"  value="{{$list->qq}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">地图坐标</label>
                                <div class="layui-input-inline" style="width: 100px;">
                                    <input type="text" name="coord1" placeholder="经度"  value="{{$list->coord[0]}}" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid">-</div>
                                <div class="layui-input-inline" style="width: 100px;">
                                    <input type="text" name="coord2" placeholder="纬度" value="{{$list->coord[1]}}" autocomplete="off" class="layui-input">
                                </div>
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
            data.field.coord = data.field.coord1+'-'+data.field.coord2;
            delete data.field.coord1;
            delete data.field.coord2;
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