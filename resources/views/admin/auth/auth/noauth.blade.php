<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('src')}}/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="https://heerey525.github.io/layui-v2.4.3/layui-v2.4.5/css/layui.css">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    html {
        width: 100%;
        height: 100%;
    }

    body {
        background-image: url("bg.jpg");
        background-size: 100% 100%;
        width: 100%;
        height: 100%;

    }

    .box {
        text-align: center;
        position: fixed;
        top: 30%;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .box-top {
        margin-bottom: 20px;
        font-size: 40px;
    }
   
</style>

<body>
    <div class="box">
        <div class="box-top">没有权限</div>
        <div class="lian">
            <a href="/admin/index" class="layui-btn layui-btn-danger layui-btn-lg">返回</a>
        </div>
    </div>
</body>

</html>