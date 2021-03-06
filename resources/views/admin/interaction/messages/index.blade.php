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
            搜索：
            <div class="layui-inline">
                <input class="layui-input" name="search" id="search" autocomplete="off">
            </div>
            <button class="layui-btn layuiadmin-btn-tags" id="reload">搜索</button>
        </div>
        <div class="layui-card-body">
            <table id="demo" lay-filter="test" lay-data="demo"></table>
            <script type="text/html" id="toolbarDemo">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                            class="layui-icon layui-icon-edit"></i>编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                            class="layui-icon layui-icon-delete"></i>删除</a>
            </script>
            <script type="text/html" id="head-left">
                <div class="layui-btn-container">
                    <button class="layui-btn layui-btn-sm" lay-event="delete">删除</button>
                </div>
            </script>
        </div>
    </div>
</div>
@verbatim
    <script type="text/html" id="statusTpl">
        {{#  if(d.status  == 1){ }}
        <button class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal">已处理</button>
        {{#  } else { }}
        <button class="layui-btn layui-btn-xs layui-btn-radius layui-btn-disabled">未处理</button>
        {{# }}}
    </script>
    <script type="text/html" id="imageTpl">
        <img src="{{ d.image }}">
    </script>
    <script type="text/html" id="typeTpl">
        {{#  if(d.type  == 1){ }}
        邮箱：
        {{#  } else if( d.status == 2) { }}
        手机：
        {{#  } else if( d.status == 3) { }}
        QQ：
        {{#  } else if( d.status == 4) { }}
        微信：
        {{# }}}
        {{ d.contact }}
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
    layui.use(['table','layer'],function(){
        var table = layui.table,
            layer = layui.layer;
        //第一个实例
        table.render({
            elem: '#demo'
            ,height: 'full-170'
            ,url: "{{url('admin/messages_ajax_list')}}" //数据接口
            ,toolbar: '#head-left' //开启工具栏，此处显示默认图标，可以自定义模板，详见文档
            ,page: true //开启分页
            ,cols: [[ //表头
                {type: 'checkbox', fixed: 'left'}
                , {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left'}
                ,{field: 'type',templet:'#typeTpl', title: '联系方式'}
                ,{field: 'message', title: '留言'}
                ,{field: 'status',templet:'#statusTpl', title: '状态', sort: true, width:'10%'}
                ,{field: 'updated_at', title: '修改时间', sort: true,width:'15%'}
                ,{field: 'created_at', title: '创建时间', sort: true,width:'15%'}
                ,{title: '操作',fixed: 'right', width:'20%', align:'center', toolbar: '#toolbarDemo'}
            ]]
            ,done: function(res, curr, count){
            }
        });

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
                area: ['60%', '60%'],
                fixed: false, //不固定
                maxmin: true,
                offset: 't',
                content: "/admin/messages/"+id+"/edit",
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
                        url: "/admin/messages/" + id,
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
        //添加
        function add(){
            layer.open({
                type: 2,
                title: '添加类型',
                area: ['800px', '250px'],
                fixed: false, //不固定
                maxmin: true,
                offset: 't',
                content: '{{url('admin/category_type/create')}}',
                //关闭是的回调函数
                end: function () {
                    table.reload('demo');
                }
            });
        }

        //监听头工具栏事件
        table.on('toolbar(test)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id)
                ,data = checkStatus.data; //获取选中的数据
            console.log(data);
            switch(obj.event){
                case 'delete':
                    if(data.length === 0){
                        layer.msg('请选择一行');
                    } else {
                        layer.confirm('确认要删除吗？', {icon: 3, title:'提示'}, function(index) {
                            if(index) {
                                var arr = [],
                                    leng = data.length;
                                for(var i=0; i < leng; i++)
                                {
                                    arr[i] = data[i].id;
                                }

                                $.ajax({
                                    url: "/admin/messages_delAll",
                                    type: "post",
                                    async: false,
                                    cache: false,
                                    data: {_token: '{{csrf_token()}}', 'data': arr},
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
                    break;
            };
        });

        $('#reload').on('click',function(){
            //执行重载
            table.reload('demo', {
                page: {
                    curr: 1 //重新从第 1 页开始
                }
                ,where: {
                    search:$('#search').val()
                }
            });
        });
    });
</script>
</body>

</html>