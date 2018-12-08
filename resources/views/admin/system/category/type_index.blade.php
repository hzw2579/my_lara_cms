<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>分类类型</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
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
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                            class="layui-icon layui-icon-edit"></i>编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                            class="layui-icon layui-icon-delete"></i>删除</a>
            </script>
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
    layui.use(['table','layer'],function(){
        var table = layui.table,
            layer = layui.layer;
        //第一个实例
        table.render({
            elem: '#demo'
            ,height: 'full-170'
            ,url: "{{url('admin/type_ajax_list')}}" //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left'}
                ,{field: 'name', title: '类型名称'}
                ,{field: 'sort', title: '排序', sort: true, width:'20%'}
                ,{field: 'updated_at', title: '修改时间', sort: true,width:'25%'}
                ,{title: '操作',fixed: 'right', width:'20%', align:'center', toolbar: '#toolbarDemo'}
            ]]
            ,done: function(res, curr, count){
            }
        });

        //添加
        $("#add").on('click',function () {
            layer.open({
                type: 2,
                title:'添加类型',
                area: ['800px', '250px'],
                fixed: false, //不固定
                maxmin: true,
                offset: 't',
                content: '{{url('admin/category_type/create')}}',
                //关闭是的回调函数
                end:function () {
                    table.reload('demo');
                }
            });
        })
        //编辑，删除
        table.on('tool(test)', function(obj){
            console.log(obj)
            var data = obj.data,
                layEvent = obj.event;
            if(layEvent == 'edit'){
                edit_ajax(data.id);
            }else if(layEvent == 'del'){
                del_ajax(data.id);
            }
        });
        //修改
        function edit_ajax(id){
            layer.open({
                type: 2,
                title:'修改类型',
                area: ['60%', '35%'],
                fixed: false, //不固定
                maxmin: true,
                offset: 't',
                content: "/admin/category_type/"+id+"/edit",
                end:function () {
                    table.reload('demo');
                }
            });
        }
        //删除
        function del_ajax(id){
            layer.confirm('确认要删除吗？', {icon: 3, title:'提示'}, function(index) {
                if(index) {
                    $.ajax({
                        url: "/admin/category_type/" + id,
                        type: "post",
                        async: false,
                        cache: false,
                        data: {_token: '{{csrf_token()}}', _method: "DELETE"},
                        success: function (msg) {
                            if (msg.code == 1) {
                                layer.msg('删除成功');
                                table.reload('demo');
                            } else {
                                layer.msg('删除失败');
                            }
                        }
                    });
                }
            })
        }
    });
</script>
</body>

</html>