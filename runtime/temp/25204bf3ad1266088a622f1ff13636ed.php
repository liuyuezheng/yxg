<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"F:\ayxg\public/../application/refund\view\login\changepwd.html";i:1550747384;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>修改密码</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <link href="/static/hplus/css/animate.min.css" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
</head>
<style type="text/css">
    .form-group{
        margin: 20px 0;

    }
    .btn-primary{
        margin: 0 auto;
        width: 30%
    }
    .full-width{
        width: 50%!important;
        height: 26px;
    }
    .updatepassword{
        width: 50%;
        float: left;
    }
    .cancelbtn{
        width: 50%;
        float: right;
        position: relative;
        left: 30px;
        background-color: #ccc;
        border-color: #ccc;
    }
</style>
<body>
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>

            <!--     <h1 class="logo-name">H+</h1> -->

        </div>
        <h3>修改密码</h3>

        <form class="m-t" role="form" action="http://www.zi-han.net/theme/hplus/index.html">
            <div class="form-group">
                <input type="password" class="form-control oldpwd" placeholder="旧密码" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control newpwd1" placeholder="新密码" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control newpwd2" placeholder="确认密码" required="">
            </div>
            <button type="button" onclick="updatepwd()" class="btn btn-primary block full-width m-b updatepassword">修改密码</button>
            <button type="button" onclick="quxiao()" class="btn btn-primary block full-width m-b cancelbtn">取消</button>

            <!--
                            <p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>
                            </p> -->

        </form>
    </div>
</div>
<script src="/static/hplus/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/hplus/js/bootstrap.min.js?v=3.3.6"></script>
<script type="/static/hplus/text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
<script src="/static/hplus/layer/layer.js"></script>
</body>
<script type="text/javascript">
    //用户修改密码
    function updatepwd(){
        var oldpwd = $('.oldpwd').val();
        var pwd = $('.newpwd1').val();
        var repwd = $('.newpwd2').val();
        if(repwd=="" || pwd=="" || oldpwd==""){
            layer.msg('密码不能为空',{icon: 2, shift: 6})
        }else{
            layer.msg("是否确认修改密码", {
                time: 0 //不自动关闭
                ,btn: ['确认', '取消']
                ,yes: function(index){
                    layer.close(index);
                    $.ajax({
                        url: '<?php echo url("login/changepwds"); ?>',
                        data: {
                            oldpwd: oldpwd,
                            pwd:pwd,
                            repwd:repwd
                        },
                        dataType: "json",
                        type: "post",
                        success: function(data) {
                            console.log(data);
                            if(data.code==1){
                                layer.msg(data.msg,{icon: 1, shift: 6},function () {
                                    window.location.href = "<?php echo url('login/login'); ?>"
                                });

                            }else{
                                layer.msg(data.msg,{icon: 2, shift: 6});
                            }
                        }
                    });
                }
            });
        }

      /*  $.ajax({
            url: "<?php echo \think\Url::build('login/changepwds'); ?>",
            data: {
                oldpwd: oldpwd,
                pwd:pwd,
                repwd:repwd
            },
            dataType: "json",
            type: "post",
            success: function(data) {
                if(data.code == 1){
                    layer.msg(data.msg);
                    window.location.href = "<?php echo url('login/login'); ?>"
                }else{
                    layer.msg(data.msg);
                }
            }
        });*/
    }

    //取消按钮
    function quxiao(){
        window.location.href = "<?php echo url('login/changepwd'); ?>"
    }
</script>
</html>