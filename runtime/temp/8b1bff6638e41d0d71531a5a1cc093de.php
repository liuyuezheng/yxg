<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"F:\ayxg\public/../application/index\view\index\index.html";i:1552009897;}*/ ?>
<!DOCTYPE html>
<html>

<!-- Mirrored from www.zi-han.net/theme/hplus/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:16:41 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>易享购后台</title>

    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="/favicon.ico">
    <link href="/static/hplus/css/bootstrap.min14ed.css?v=3.4.6" rel="stylesheet">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/static/hplus/css/animate.min.css" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4" rel="stylesheet">
    <style type="text/css">
       .second_level{
           padding-left: 20px;
       }
        .active{
            color: deepskyblue !important;
        }
        .minimalize-styl-2{
            height:40px;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 0;
        }
       .minimalize-styl-2 i{
           height:20px;
           font-size: 20px;
           line-height: 40px;
       }
    </style>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                          <div class="dropdown profile-element">
                         <span>
                             <a class="J_menuItem" href="<?php echo url('index/welcome'); ?>">
                                 <img alt="image" class="img-circle" src="/static/hplus/img/p3.jpg" width="100px" /></a>
                         </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">

                                <span class="text-muted text-xs block" style="margin-left: 18px;">欢迎<?php echo $data['admin']; ?></span>
                                </span>
                            </a>
                         <!--   <ul class="dropdown-menu animated fadeInRight m-t-xs">

                                <li><a onclick="logout()">安全退出</a>
                                </li>
                            </ul>-->
                        </div>
                        <div class="logo-element">H+
                        </div>
                    </li>
                    <li>


                    </li>


                    <li class="li">
                        <a><i class="fa fa-envelope"></i>
                         <span class="nav-label">用户管理 </span>
                         <span class="fa arrow"></span>
                     </a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?php echo url('users/index'); ?>">普通用户</a>

                            </li>
                            <li><a class="J_menuItem" href="<?php echo url('users/superior'); ?>">董事/总代</a>

                            </li>

                        </ul>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo url('category/index'); ?>"><i class="fa fa-edit"></i> <span class="nav-label">商品分类管理</span></a>

                    </li>
                     <li>
                        <a class="J_menuItem" href="<?php echo url('goodslist/index'); ?>"><i class="fa fa-edit"></i> <span class="nav-label">商品管理</span></a>

                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo url('order/index'); ?>"><i class="fa fa-edit"></i> <span class="nav-label">订单管理</span></a>

                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo url('refunds/index'); ?>"><i class="fa fa-edit"></i> <span class="nav-label">售后管理</span></a>

                    </li>


                      <li class="li">
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">活动管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?php echo url('coupons/index'); ?>">优惠券管理</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo url('special/index'); ?>">商品专场</a>
                            </li>

                        </ul>
                    </li>

                     <li class="li">
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">财务管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?php echo url('kitings/index'); ?>">用户提现</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo url('monitor/index'); ?>">资金监控日志</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo url('general/index'); ?>">总代佣金</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo url('manager/index'); ?>">董事佣金</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo url('adjust/index'); ?>">财务调整日志</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="J_menuItem"  href="<?php echo url('login/changepwd'); ?>"><i class="fa fa-edit"></i> <span class="nav-label">系统设置</span></a>

                    </li>
                    <li>
                        <a class="J_menuItem"  href="<?php echo url('describe/index'); ?>"><i class="fa fa-edit"></i> <span class="nav-label">轮播图管理</span></a>

                    </li>

                </ul>
            </div>
        </nav>

        <!--左侧导航结束-->
    <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">

            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft" id="backs"><i class="fa fa-backward"></i>
                </button>
                   <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <!--<li class="J_tabShowActive"><a>定位当前选项卡</a>-->
                        <!--</li>-->
                        <!--<li class="divider"></li>-->
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a onclick="logout()" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo url('index/welcome'); ?>" frameborder="0" data-id="index_v1.html" seamless></iframe>
            </div>
            <!--<div class="footer">
                <div class="pull-right">&copy; 2014-2015 <a href="http://www.zi-han.net/" target="_blank">zihan's blog</a>
                </div>
            </div>-->
                <!--<nav class="page-tabs J_menuTabs">-->
                    <!--<div>-->
                        <!--<a href="<?php echo url('index/index'); ?>" style="background-color: black;color: white;margin-left: 10px">去首页</a>-->
                    <!--</div>-->
                     <!--<div>-->
                        <!--<a  style="background-color: black;color: white;margin-left: 10px">安全退出</a>-->
                    <!--</div>-->
                <!--</nav>-->


                <!--</button>   -->
            </div>
            <!--<div class="row J_mainContent" id="content-main">-->
                <!--<iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo url('index/welcome'); ?>?type=1" frameborder="0" data-id="index_v1.html" seamless></iframe>-->
            <!--</div>-->
        </div>
        <!--右侧部分结束-->
       
    </div>
    <script src="/static/hplus/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/hplus/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/hplus/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/static/hplus/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/static/hplus/js/plugins/layer/layer.min.js"></script>
    <script src="/static/hplus/js/hplus.min.js?v=4.1.0"></script>
    <script type="text/javascript" src="/static/hplus/js/contabs.min.js"></script>
    <script src="/static/hplus/js/plugins/pace/pace.min.js"></script>
    <script src="/static/hplus/layer/layer.js"></script>
</body>
<script language="javascript">
//    $("#backs").click(function(){
//        alert(1);
//        console.log(window);
//        console.log(window.history);
////        window.history.back(-1);
//    });

</script>
<script type="text/javascript">
    $(".J_menuItem").on('click',function () {
        console.log(211321);
        $('.active').removeClass('active')
        $(this).addClass('active')
        $(this).parents('.li').addClass("active")
    })
    $(".li").on("click",function () {
        $('.active').removeClass('active')
        $(this).addClass('active')
    })
//    $(".J_menuTab active").on('click',function () {
//        history.go(0);
//    })
//    //显示修改密码界面
//    function updatePwd(){
//         window.location.href = "<?php echo url('login/showUpdatePwd'); ?>"
//
//    }
    //安全退出
    function logout(){
          $.ajax({
                url: '<?php echo url("login/logout"); ?>',
                data: {
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
            });
    }
   
   //跳到首页
  // function index(){
  //    window.location.href = "<?php echo url('index/welcome'); ?>"
  // }

</script>

<!-- Mirrored from www.zi-han.net/theme/hplus/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:17:11 GMT -->
</html>
