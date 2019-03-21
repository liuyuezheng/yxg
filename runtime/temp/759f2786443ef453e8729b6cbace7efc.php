<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"F:\ayxg\public/../application/refund\view\login\login.html";i:1552875339;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
<head>

    <meta charset="utf-8"><!--7123456-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>易享购后台</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="/favicon.ico"> <link href="css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <link href="/static/hplus/css/animate.min.css" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
    <style type="text/css">
        .form-group{
            margin: 20px 0;

        }
        .btn-primary{
            margin: 0 auto;
            width: 100%
        }
        .yanzhengma{
            width: 36%;
        }
        .yanzheng{
            position: relative;
            left: 48%;
            top:-37px;
            width: 53%;
        }
    </style>
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>

            <!--     <h1 class="logo-name">H+</h1> -->

        </div>
        <h3>欢迎易享购后台</h3>

        <form class="m-t" role="form" action="http://www.zi-han.net/theme/hplus/index.html">
            <div class="form-group">
                <input type="text" class="form-control adminname" placeholder="用户名" required="" style="width: 92%">
            </div>
            <div class="form-group">
                <input type="password" class="form-control adminpassword" placeholder="密码" required="" style="width: 92%">
            </div>
            <div class="form-group input-group">
                <input type="text" name="verify" class="form-control yanzhengma" placeholder="验证码" required />
                <span class="input-group-btn">
                 <div><img id="verify_img" src="<?php echo captcha_src(); ?>" alt="验证码" class="yanzheng" onclick="refreshVerify()">
                </span>
            </div>
            <button type="button" onclick="userlogin()" class="btn btn-primary" style="height: 30px">登 录</button>

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
    //用户登录
    function userlogin(){
        var adminname = $('.adminname').val();
        var adminpassword = $('.adminpassword').val();
        var code = $('.yanzhengma').val();
        $.ajax({
            url: "<?php echo \think\Url::build('login/goindex'); ?>",
            data: {
                name: adminname,
                password:adminpassword,
                code:code
            },
            dataType: "json",
            type: "post",
            success: function(data) {
//                console.log(data);
                if(data.code == 1){
                    layer.msg(data.msg);
                    window.location.href = "<?php echo url('refund/index/index'); ?>"
                }else{
                    layer.msg(data.msg);
                    refreshVerify();
//                    location=location;
                }
            }
        });
    }
    var SubmitOrHidden = function(event) {
        e = event ? event : (window.event ? window.event : null);
        if (e.keyCode == 13) {
            userlogin();
        }
    }
    window.document.onkeydown = SubmitOrHidden;

    //刷新验证码
    function refreshVerify() {
        var ts = Date.parse(new Date())/1000;
        $('#verify_img').attr("src", "/captcha?id="+ts);
    }
</script>

<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
</html>
