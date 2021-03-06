<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>移网汇</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{asset('src')}}/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{{asset('src')}}/style/admin.css" media="all">
</head>
<body class="layui-layout-body">
<div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <!-- 头部区域 -->
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item layadmin-flexible" lay-unselect="">
                    <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
                        <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
                    </a>
                </li>
                <li class="layui-nav-item" lay-unselect="">
                    <a href="javascript:;" layadmin-event="refresh" title="刷新">
                        <i class="layui-icon layui-icon-refresh-3"></i>
                    </a>
                </li>
                {{--<li class="layui-nav-item layui-hide-xs" lay-unselect="">--}}
                    {{--<input type="text" placeholder="搜索..." autocomplete="off" class="layui-input layui-input-search"--}}
                           {{--layadmin-event="serach" lay-action="template/search.html?keywords=">--}}
                {{--</li>--}}
            </ul>
            <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">

                {{--<li class="layui-nav-item" lay-unselect="">--}}
                    {{--<a lay-href="../src/views/app/message/index.html" layadmin-event="message" lay-text="消息中心">--}}
                        {{--<i class="layui-icon layui-icon-notice"></i>--}}

                        {{--<!-- 如果有新消息，则显示小圆点 -->--}}
                        {{--<span class="layui-badge-dot"></span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li class="layui-nav-item layui-hide-xs" lay-unselect="">
                    <a href="javascript:;" layadmin-event="theme">
                        <i class="layui-icon layui-icon-theme"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect="">
                    <a href="javascript:;" layadmin-event="note">
                        <i class="layui-icon layui-icon-note"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect="">
                    <a href="javascript:;" layadmin-event="fullscreen">
                        <i class="layui-icon layui-icon-screen-full"></i>
                    </a>
                </li>
                <li class="layui-nav-item" lay-unselect="">
                    <a href="javascript:;">
                        <cite>{{session('name')}}</cite>
                        <span class="layui-nav-more"></span></a>
                    <dl class="layui-nav-child">
                        <dd><a lay-href="/admin/info_edit/{{session('id')}}">基本资料</a></dd>
                        <dd><a lay-href="/admin/psw_edit/{{session('id')}}">修改密码</a></dd>
                        <hr>
                        <dd style="text-align: center;"><a href="/admin/login_out">退出</a></dd>
                    </dl>
                </li>

                <li class="layui-nav-item layui-hide-xs" lay-unselect="">
                    <a href="javascript:;" layadmin-event="about"><i
                                class="layui-icon layui-icon-more-vertical"></i></a>
                </li>
                <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect="">
                    <a href="javascript:;" layadmin-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
                </li>
            </ul>
        </div>

        <!--侧边菜单-->
        <div class="layui-side layui-side-menu">
            <div class="layui-side-scroll">
                <div class="layui-logo" lay-href="{{url('admin/main')}}">
                    <span>layuiAdmin</span>
                </div>
                <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
                    <li data-name="home" class="layui-nav-item layui-nav-itemed">
                        <a href="javascript:;" lay-tips="主页" lay-direction="2">
                            <i class="layui-icon layui-icon-home"></i>
                            <cite>主页</cite>
                            <span class="layui-nav-more"></span></a>
                        <dl class="layui-nav-child">
                            <dd data-name="console" class="layui-this">
                                <a lay-href="{{url('admin/main')}}">控制台</a>
                            </dd>
                            {{--<dd data-name="console">--}}
                                {{--<a lay-href="../src/views/home/homepage1.html">主页一</a>--}}
                            {{--</dd>--}}
                            {{--<dd data-name="console">--}}
                                {{--<a lay-href="../src/views/home/homepage2.html">主页二</a>--}}
                            {{--</dd>--}}
                        </dl>
                    </li>
                    <li data-name="system" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="系统配置" lay-direction="2">
                            <i class="layui-icon layui-icon-set"></i>
                            <cite>系统配置</cite>
                            <span class="layui-nav-more"></span></a>
                        <dl class="layui-nav-child">
                            @can('system_site')
                            <dd data-name="site" class="">
                                <a lay-href="{{url('admin/site')}}">站点设置</a>
                            </dd>



                            <dd data-name="seo" class="">
                                <a lay-href="{{url('admin/seo')}}">SEO设置</a>
                            </dd>


                            <dd data-name="basic" class="">
                                <a lay-href="{{url('admin/basic')}}">基本信息</a>
                            </dd>

                            <dd data-name="contact" class="">
                                <a lay-href="{{url('admin/contact')}}">联系方式</a>
                            </dd>
                            @endcan

                            @can('cate_set')
                            <dd data-name="category" class="">
                                <a lay-href="{{url('admin/category_type')}}">分类类型</a>
                            </dd>

                            <dd data-name="category" class="">
                                <a lay-href="{{url('admin/category')}}">分类管理</a>
                            </dd>
                            @endcan

                            @can('attach_set')
                            <dd data-name="media" class="">
                                <a lay-href="{{url('admin/media')}}">附件管理</a>
                            </dd>
                            @endcan

                            @can('auth_set')
                            <dd data-name="auth" class="">
                                <a lay-href="{{url('admin/auth')}}">权限管理</a>
                            </dd>

                            <dd data-name="auth" class="">
                                <a lay-href="{{url('admin/roles')}}">角色管理</a>
                            </dd>
                            @endcan

                            @can('user_set')
                            <dd data-name="users" class="">
                                <a lay-href="{{url('admin/users')}}">管理员管理</a>
                            </dd>

                            <dd data-name="log" class="">
                                <a lay-href="{{url('admin/log')}}">日志管理</a>
                            </dd>
                            @endcan
                        </dl>
                    </li>
                    <li data-name="content" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="内容管理" lay-direction="2">
                            <i class="layui-icon layui-icon-read"></i>
                            <cite>内容管理</cite>
                            <span class="layui-nav-more"></span></a>
                        <dl class="layui-nav-child">
                            @can('article_set')
                            <dd data-name="article" class="">
                                <a lay-href="{{url('admin/article')}}">文章管理</a>
                            </dd>
                            @endcan

                            @can('banner_set')
                            <dd data-name="banner" class="">
                                <a lay-href="{{url('admin/banner_place')}}">广告位管理</a>
                            </dd>
                            <dd data-name="banner" class="">
                                <a lay-href="{{url('admin/banner')}}">广告管理</a>
                            </dd>
                            @endcan

                            @can('friends_link_set')
                            <dd data-name="link" class="">
                                <a lay-href="{{url('admin/link')}}">友情链接</a>
                            </dd>
                            @endcan
                            @can('single_page_set')
                            <dd data-name="page" class="">
                                <a lay-href="{{url('admin/page')}}">单页管理</a>
                            </dd>
                            @endcan
                        </dl>
                    </li>
                    <li data-name="member" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="会员管理" lay-direction="2">
                            <i class="layui-icon layui-icon-user"></i>
                            <cite>会员管理</cite>
                            <span class="layui-nav-more"></span></a>
                        <dl class="layui-nav-child">
                            <dd data-name="member" class="">
                                <a lay-href="{{url('admin/member')}}">会员管理</a>
                            </dd>
                        </dl>
                    </li>

                    <li data-name="interaction" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="互动管理" lay-direction="2">
                            <i class="layui-icon layui-icon-face-smile"></i>
                            <cite>互动管理</cite>
                            <span class="layui-nav-more"></span></a>
                        <dl class="layui-nav-child">
                            @can('message_set')
                            <dd data-name="messages" class="">
                                <a lay-href="{{url('admin/messages')}}">留言管理</a>
                            </dd>
                            @endcan
                        </dl>
                    </li>

                </ul>
            </div>
        </div>
        <!-- 页面标签 -->
        <div class="layadmin-pagetabs" id="LAY_app_tabs">
            <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
            <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
            <div class="layui-icon layadmin-tabs-control layui-icon-down">
                <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
                    <li class="layui-nav-item" lay-unselect="">
                        <a href="javascript:;"><span class="layui-nav-more"></span></a>
                        <dl class="layui-nav-child layui-anim-fadein">
                            <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                            <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                            <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <div class="layui-tab" lay-unauto="" lay-allowclose="true" lay-filter="layadmin-layout-tabs">
                <ul class="layui-tab-title" id="LAY_app_tabsheader">
                    <li lay-id="../src/views/home/console.html" lay-attr="../src/views/home/console.html" class="layui-this"><i
                                class="layui-icon layui-icon-home"></i><i class="layui-icon layui-unselect layui-tab-close">ဆ</i>
                    </li>
                </ul>
            </div>
        </div>


        <!-- 主体内容 -->

        <div class="layui-body" id="LAY_app_body">
            <div class="layadmin-tabsbody-item layui-show">
                <iframe src="{{url('admin/main')}}" frameborder="0" class="layadmin-iframe"></iframe>
            </div>
        </div>


        <!-- 辅助元素，一般用于移动设备下遮罩 -->
        <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
</div>
<script src="{{asset('src')}}/layui/layui.js"></script>
<script>
    layui.config({
        base: "{{asset('src')}}/" //静态资源所在路径
    }).extend({
        index: 'index' //主入口模块
    }).use('index');
</script>
</body>
</html>