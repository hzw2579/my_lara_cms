<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>文章添加</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{asset('src')}}/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{{asset('src')}}/style/admin.css" media="all">
    @include('UEditor::head')
</head>
<body>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <form class="layui-form" wid100 lay-filter="lay-form">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <div class="layui-form-item">
                        <label class="layui-form-label">文章标题</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" value="{{$info->title}}" class="layui-input" lay-verify="required">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">副标题</label>
                        <div class="layui-input-block">
                            <input type="text" name="subtitle" value="{{$info->subtitle}}" class="layui-input" lay-verify="required">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">作者</label>
                        <div class="layui-input-block">
                            <input type="text" name="author" value="{{$info->author}}" class="layui-input" lay-verify="required">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">关键词</label>
                        <div class="layui-input-block">
                            <input type="text" name="keyword" value="{{$info->keyword}}" class="layui-input" lay-verify="required">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">文章分类</label>
                        <div class="layui-input-block">
                            <select name="type" lay-verify="required" lay-filter="" lay-search>
                                @foreach($cate_list as $v)
                                    <option @if($info->type == $v['id']) selected @endif value="{{$v['id']}}">{{str_repeat("|----",$v['level']-1)}}{{$v['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">描述</label>
                        <div class="layui-input-block">
                            <textarea name="description" placeholder="" class="layui-textarea">{{$info->description}}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">封面</label>
                        <div class="layui-col-md8">
                            <input type="text" name="thumb"  value="{{$info->thumb}}" class="layui-input">
                        </div>
                        <div class="layui-col-md2">
                            <button type="button" id="imgbutton" class="layui-btn">选择图片</button>
                        </div>
                    </div>
                    <div class="layui-form-item" style="text-align:center;">
                        <img id="icon"  src="{{$info->thumb}}" alt='暂无图片' style="width: 300px;">
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">文章内容</label>
                        <div class="layui-input-block">
                            <textarea type="text/plain" id="container" name="content">{!! $info->content !!}</textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-block">
                            <input type="text" lay-verify="number" name="sort"  value="{{$info->sort}}" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">虚拟点赞</label>
                        <div class="layui-input-block">
                            <input type="text" lay-verify="number" name="dummy_like"  value="{{$info->dummy_like}}" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">虚拟阅读</label>
                        <div class="layui-input-block">
                            <input type="text" lay-verify="number" name="dummy_read"  value="{{$info->dummy_read}}" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                            <input type="checkbox" @if($info->status == 1)checked @endif value="1" name="status" lay-skin="switch" lay-text="启用|禁用">
                        </div>
                    </div>
                    <div class="layui-form-item" style="text-align:center;">
                        <button type="button" class="layui-btn" lay-submit lay-filter="*">确认保存</button>
                    </div>
                </form>
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
                url: "/admin/article/"+{{$info->id}},
                type: "post",
                async: false,
                cache: false,
                data: data.field,
                success: function (msg) {
                    if(msg.code== 1){
                        layer.msg('修改成功');
                        // parent.tableIns.reload()
                        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                        parent.layer.close(index); //再执行关闭
                    }else{
                        layer.msg('修改失败');
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
                        "thumb": path
                    })
                    //清除对应的本地缓存
                    storage.removeItem("src");
                }
            });
        });
    });
</script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container',{
        toolbars: [
            [
                'undo', //撤销
                'redo', //重做
                'bold', //加粗
                'indent', //首行缩进
                'italic', //斜体
                'underline', //下划线
                'strikethrough', //删除线
                'subscript', //下标
                'fontborder', //字符边框
                'superscript', //上标
                'formatmatch', //格式刷
                'pasteplain', //纯文本粘贴模式
                'selectall', //全选
                'horizontal', //分隔线
                'removeformat', //清除格式
                'time', //时间
                'date', //日期
                'unlink', //取消链接
                'insertrow', //前插入行
                'insertcol', //前插入列
                'mergeright', //右合并单元格
                'mergedown', //下合并单元格
                'deleterow', //删除行
                'deletecol', //删除列
                'splittorows', //拆分成行
                'splittocols', //拆分成列
                'splittocells', //完全拆分单元格
                'deletecaption', //删除表格标题
                'inserttitle', //插入标题
                'mergecells', //合并多个单元格
                'deletetable', //删除表格
                'cleardoc', //清空文档
                'insertparagraphbeforetable', //"表格前插入行"
                'insertcode', //代码语言
                'fontfamily', //字体
                'fontsize', //字号
                'paragraph', //段落格式
                'simpleupload', //单图上传
                'edittable', //表格属性
                'edittd', //单元格属性
                'link', //超链接
                'emotion', //表情
                'spechars', //特殊字符
                'searchreplace', //查询替换
                'justifyleft', //居左对齐
                'justifyright', //居右对齐
                'justifycenter', //居中对齐
                'justifyjustify', //两端对齐
                'forecolor', //字体颜色
                'backcolor', //背景色
                'insertorderedlist', //有序列表
                'insertunorderedlist', //无序列表
                'directionalityltr', //从左向右输入
                'directionalityrtl', //从右向左输入
                'rowspacingtop', //段前距
                'rowspacingbottom', //段后距
                'pagebreak', //分页
                'insertframe', //插入Iframe
                'imagenone', //默认
                'imageleft', //左浮动
                'imageright', //右浮动
                'attachment', //附件
                'imagecenter', //居中
                'wordimage', //图片转存
                'lineheight', //行间距
                'edittip ', //编辑提示
                'customstyle', //自定义标题
                'autotypeset', //自动排版
            ]
        ],
        initialFrameHeight:300,
        autoHeightEnabled:false,
        initialFrameWidth:1000
    });
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
    });
</script>
</body>
</html>