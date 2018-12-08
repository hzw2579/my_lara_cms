<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>分类管理</title>
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
            <table lay-filter="demo" id="demo">
            <thead>
            <tr>
                <th lay-data="{field:'id', width:100, sort:true}">ID</th>
                <th lay-data="{field:'name',width:'38.1%'}">分类名称</th>
                <th lay-data="{field:'type',width:100}">分类类型</th>
                <th lay-data="{field:'parent_name',width:150}">上级分类</th>
                <th lay-data="{field:'sort',width:100,sort:true}">排序</th>
                <th lay-data="{field:'status',width:100,sort:true}">状态</th>
                <th lay-data="{field:'update',width:180,sort:true}">修改时间</th>
                <th lay-data="{field:'operation',width:170}">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $v)
            <tr>
                <td>{{$v['id']}}</td>
                <td>{{str_repeat("|----",$v['level']-1)}}{{$v['name']}}</td>
                <td>{{get_cate_type($v['type'])}}</td>
                <td>{{$v['parent_name']}}</td>
                <td>{{$v['sort']}}</td>
                <td>
                    @if($v['status'] == 1)
                        <button class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal">启用</button>
                    @else
                        <button class="layui-btn layui-btn-xs layui-btn-radius layui-btn-disabled">禁用</button>
                    @endif
                </td>
                <td>{{$v['updated_at']}}</td>
                <td>
                    <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit" data-id="{{$v['id']}}"><i
                                class="layui-icon layui-icon-edit"></i>编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" data-id="{{$v['id']}}"><i
                                class="layui-icon layui-icon-delete"></i>删除</a>
                </td>
            </tr>
             @endforeach
            </tbody>
            </table>
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
        table.init('demo',{
            limit:1000
        });

        //添加
        $("#add").on('click',function () {
            layer.open({
                type: 2,
                title:'添加分类',
                area: ['80%','80%'],
                fixed: false, //不固定
                maxmin: true,
                offset: 't',
                content: '{{url('admin/category/create')}}',
                //关闭是的回调函数
                end:function () {
                    table.reload('demo');
                }
            });
        })
        //编辑，删除
        table.on('tool(demo)', function(obj){
            console.log(obj)
            var data = obj.data,
                layEvent = obj.event;
            if(layEvent == 'edit'){
                edit_ajax(data.id);
            }else if(layEvent == 'del'){
                del_ajax(data.id);
            }
        });
        //编辑，删除
        function edit_ajax(id){
            layer.open({
                type: 2,
                title:'修改分类',
                area: ['80%','80%'],
                fixed: false, //不固定
                maxmin: true,
                offset: 't',
                content: "/admin/category/"+id+"/edit",
                //关闭是的回调函数
                end:function () {
                    table.reload('demo');
                }
            });
        }
        function del_ajax(id){
            layer.confirm('确认要删除吗？', {icon: 3, title:'提示'}, function(index){
                if(index){
                    $.ajax({
                        url: "/admin/category/" + id,
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
            });
        };
    });
</script>
</body>

</html>