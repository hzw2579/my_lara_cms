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
                <div class="layui-form" wid100 lay-filter="">
                    {{csrf_field()}}
                    <div class="layui-form-item">
                        <label class="layui-form-label">上传文件</label>
                        <div class="layui-input-block layui-upload-drag" id="uploadDemo">
                            <i class="layui-icon"></i>
                            <p>点击上传，或将文件拖拽到此处</p>
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
    layui.use(['form','layer','upload'], function(){
        var form = layui.form,
            layer = layui.layer,
            upload = layui.upload,
            $ = layui.$;
        //上传
        upload.render({
            elem: '#uploadDemo'
            ,url: "{{url('admin/file_upload')}}" //上传接口
            ,data: {
                _token: function(){
                    return $("[name='_token']").val();
                }
            }
            ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                layer.load(); //上传loading
            }
            ,accept:'file'
            ,exts: 'mpga|gif|jpg|png|bmp|jpeg|avi|wm|mpeg|mp4|mov|mkv|flv|f4v|m4v|rmvb|rm|3gp|dat|ts|mts|vob|cd|ogg|mp3|asf|wma|wav|vqf|midi|module|ape|real|rm|mp3pro'
            ,done: function(res){
                if(res.code == 1){
                    layer.msg('上传成功');
                    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    parent.layer.close(index); //再执行关闭
                }else{
                    layer.msg('上传失败');
                }
            }
        });
    });
</script>
</body>
</html>