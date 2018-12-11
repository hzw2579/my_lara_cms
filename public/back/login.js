layui.use(['form','layer','jquery'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer
        $ = layui.jquery;

    $(".loginBody .seraph").click(function(){
        layer.msg("这只是做个样式，至于功能，你见过哪个后台能这样登录的？还是老老实实的找管理员去注册吧",{
            time:5000
        });
    })

    //登录按钮
    form.on("submit(login)",function(data){
        $(this).text("登录中...").attr("disabled","disabled").addClass("layui-disabled");
        setTimeout(function(){
            //通过fromdata转换数据
            var fm=$("#ajaxfrom")[0];
            var formData = new FormData(fm);
            //表单提交通过
            $.ajax({
                url: "/admin/login_now",
                type: "post",
                // async: false,
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                beforeSend:function(){

                },
                success: function (msg) {
                    if(msg.code=="1"){
                        layer.msg("正在登录中",function () {
                            window.location.href='/admin/index';
                        })
                    }else{
                        layer.msg("密码或账户错误",function () {
                            $(".login").text("登录").attr("disabled",false).removeClass("layui-disabled");
                            $("#captcha").click();
                        })
                    }
                },
                error:function (msg) {
                    console.log(msg);
                    $.each(msg.responseJSON.errors,function (k,v) {
                        layer.msg(v[0],function () {
                            $(".login").text("登录").attr("disabled",false).removeClass("layui-disabled");
                            $("#captcha").click();
                        });
                    })
                }
            });
        },1000);
        return false;
    })

    //表单输入效果
    $(".loginBody .input-item").click(function(e){
        e.stopPropagation();
        $(this).addClass("layui-input-focus").find(".layui-input").focus();
    })
    $(".loginBody .layui-form-item .layui-input").focus(function(){
        $(this).parent().addClass("layui-input-focus");
    })
    $(".loginBody .layui-form-item .layui-input").blur(function(){
        $(this).parent().removeClass("layui-input-focus");
        if($(this).val() != ''){
            $(this).parent().addClass("layui-input-active");
        }else{
            $(this).parent().removeClass("layui-input-active");
        }
    })

})
