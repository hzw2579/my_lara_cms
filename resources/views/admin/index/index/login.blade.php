<!DOCTYPE html>
<html class="loginHtml">
<head>
	<meta charset="utf-8">
	<title>mycms</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="{{asset('back')}}/favicon.ico">
	<link rel="stylesheet" href="{{asset('back')}}/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="{{asset('back')}}/css/public.css" media="all" />
</head>
<body class="loginBody">
	<form class="layui-form" id="ajaxfrom">
		{{csrf_field()}}
		<div class="login_face"><img src="{{asset('back')}}/images/face.jpg" class="userAvatar"></div>
		<div class="layui-form-item input-item">
			<label for="userName">邮箱地址</label>
			<input type="text" placeholder="请输入登录邮箱" autocomplete="off" id="userName" name="email" class="layui-input" lay-verify="required|email">
		</div>
		<div class="layui-form-item input-item">
			<label for="password">密码</label>
			<input type="password" placeholder="请输入密码" autocomplete="off" id="password" name="password" class="layui-input" lay-verify="required">
		</div>
		<div class="layui-form-item input-item" id="imgCode">
			<label for="code">验证码</label>
			<input type="text" placeholder="请输入验证码" autocomplete="off" id="code" class="layui-input" name="captcha">
			<img src="{{Captcha::src()}}" onclick="this.src='/captcha/default?'+Math.random()" id="captcha">
		</div>
		<div class="layui-form-item">
			<button class="layui-btn layui-block login" lay-filter="login" lay-submit >登录</button>
		</div>
		{{--<div class="layui-form-item layui-row">--}}
			{{--<a href="javascript:;" class="seraph icon-qq layui-col-xs4 layui-col-sm4 layui-col-md4 layui-col-lg4"></a>--}}
			{{--<a href="javascript:;" class="seraph icon-wechat layui-col-xs4 layui-col-sm4 layui-col-md4 layui-col-lg4"></a>--}}
			{{--<a href="javascript:;" class="seraph icon-sina layui-col-xs4 layui-col-sm4 layui-col-md4 layui-col-lg4"></a>--}}
		{{--</div>--}}
	</form>
	<script type="text/javascript" src="{{asset('back')}}/layui/layui.js"></script>
	<script type="text/javascript" src="{{asset('back')}}/login.js"></script>
	<script type="text/javascript" src="{{asset('back')}}/js/cache.js"></script>

</body>
</html>