<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>附件管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{asset('src')}}/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{{asset('src')}}/style/admin.css" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <button class="layui-btn layuiadmin-btn-tags" id="add">添加</button>
        </div>
        <div class="layui-card-body">
            <table id="demo" lay-filter="test"></table>
            <script type="text/html" id="toolbarDemo">
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="choose"><i
                        class="layui-icon layui-icon-ok"></i>选择</a>
            </script>
        </div>
    </div>
</div>
@verbatim
<script type="text/html" id="srcTpl">
    {{#  if(d.type  == 'img'){ }}
    <img class="media" src="{{ d.src}}" data-type="{{ d.type }}">
    {{#  } else if( d.type == 'video') { }}
    <video class="media" data-type="{{ d.type }}" style="height:auto;" src="{{ d.src}}" id="video0" controls="controls"></video>

    {{#  } else if( d.type == 'redio'){}}
    <audio class="media" data-type="{{ d.type }}" src="{{ d.src}}" controls="controls" loop="loop" autoplay="autoplay">亲 您的浏览器不支持html5的audio标签</audio>
    {{# }}}
</script>
@endverbatim

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
    layui.use(['table', 'layer'], function () {
        var table = layui.table,
            layer = layui.layer;
        //第一个实例
        table.render({
            elem: '#demo'
            , url: "{{url('admin/media_ajax_list')}}" //数据接口
            , page: true //开启分页
            , cols: [[ //表头
                {field: 'id', title: 'ID', width: '8%', sort: true, fixed: 'left'}
                , {field: 'name', title: '文件名称', width: '25%'}
                , {field: 'type', title: '素材类型',width: '17%'}
                , {field: 'src', title: '预览', templet: '#srcTpl', width: '38%'}
                , {title: '操作', fixed: 'right', width: '10%', align: 'center', toolbar: '#toolbarDemo'}
            ]]
            , done: function (res, curr, count) {
                hoverOpenImg();
            }
        });

        //添加
        $("#add").on('click', function () {
            layer.open({
                type: 2,
                title: '上传文件',
                area: ['500px', '300px'],
                fixed: false, //不固定
                maxmin: true,
                offset: 't',
                content: '{{url('admin/media/create')}}',
                //关闭是的回调函数
                end: function () {
                window.location.reload();
            }
        });
        })
        //选择
        table.on('tool(test)', function (obj) {
            console.log(obj)
            var data = obj.data,
                layEvent = obj.event;
            if (layEvent == 'choose') {
                choose_ajax(data.src);
            }
        });
        //选择
        function choose_ajax(src){
            //存放SRC到本地储存中
            var storage=window.localStorage;
            storage.setItem("src",src);
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
            parent.layer.close(index); //再执行关闭
        }

        function hoverOpenImg(){
            var img_show = null; // tips提示
            $('.media').hover(function(){
                var type = $(this).attr('data-type');
                src = $(this).attr('src');

                if( type  == 'img'){
                    str = '<img src="'+src+'" style="width:200px;">';
                } else if( type == 'video') {
                    str = '<video style="width:200px;height:auto;" src="'+src+'" id="video0" controls="controls"></video>';
                } else if( d.type == 'redio'){
                    str = '<audio src="'+src+'" style="width:200px;" controls="controls" loop="loop" autoplay="autoplay">亲 您的浏览器不支持html5的audio标签</audio>';
                }
                img_show = layer.tips(str, this,{
                    tips:[2, 'rgba(41,41,41,.5)']
                    ,area: ['230px']
                });
            },function(){
                layer.close(img_show);
            });
        }
    });
</script>
<style>
</style>
</body>

</html>