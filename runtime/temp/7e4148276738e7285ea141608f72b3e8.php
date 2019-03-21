<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"F:\ayxg\public/../application/index\view\special\index.html";i:1547001579;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品专场</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/static/hplus/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <script src="/static/hplus/layui/assets/jquery-1.12.4.js"></script>
    <!-- Data Tables -->
    <link href="/static/hplus/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/static/hplus/css/animate.min.css" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">
    <style>
        .col-sm-2 {
            width: 6.66666667%;
        }
        .input-group .form-control {
            position: relative;
            z-index: 2;
            float: right;
            width: 25%;
            margin-bottom: 0;

        }
        .layui-elem-field legend {
            margin-left: -9px;
            padding: 0 10px;
            font-size: 20px;
            font-weight: 300;
        }
        .layui-btn-primary{
            margin-left: -105px;
        }
        .layui-upload-img { width: 90px; height: 90px; margin: 0; }
        .pic-more { width:100%; left; margin: 10px 0px 0px 0px;}
        .pic-more li { width:90px; float: left; margin-right: 5px;}
        .pic-more li .layui-input { display: initial; }
        .pic-more li a { position: absolute; top: 0; display: block; }
        .pic-more li a i { font-size: 24px; background-color: #008800; }
        #slide-pc-priview .item_img img{ width: 90px; height: 90px;}
        #slide-pc-priview li{position: relative;}
        #slide-pc-priview li .operate{ color: #000; display: none;}
        #slide-pc-priview li .toleft{ position: absolute;top: 40px; left: 1px; cursor:pointer;}
        #slide-pc-priview li .toright{ position: absolute;top: 40px; right: 1px;cursor:pointer;}
        #slide-pc-priview li .close{position: absolute;top: 5px; right: 5px;cursor:pointer;}
        #slide-pc-priview li:hover .operate{ display: block;}


        a{
            text-decoration: none;
            color:black;
        }

        h3{
            text-align:center;
        }
        .box{
            width: 100%;
            height: 100%;
        }
        ul{
            list-style: none;
            border-bottom:none;
            overflow:hidden;
        }
        ul li{
            float:left;
            border:1px solid #e7eaec;
            margin-left:-1px;
            padding:6px 30px;
            border-top-left-radius:3px;
            border-top-right-radius:3px;
            border-bottom:none;
            cursor:pointer;
        }
        ul li:first-child{
            background:#1ab394;
        }
        ul li:first-child a{
            color:white;
        }
        iframe{
            width:100%;
            height:100%;
            border:none;
            background:none;
        }
    </style>
</head>
<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
    <ul id="example1">
        <li id=hot"><a  href="<?php echo url('special/hots'); ?>"  target="content1">昨日爆款</a></li>
        <li ><a id="tui" href="<?php echo url('special/mains'); ?>"  target="content1">今日主推</a></li>
    </ul>
    <iframe src="<?php echo url('special/hots'); ?>" name="content1" style="width: 100%;height: 1080px;"></iframe>
                </div>
        </div>
        </div>
    </div>
</div>
<script>
    var lis=document.querySelectorAll("#example1 li");
    var len=lis.length;
    console.log(len);
//    $("#hot").click(function(){
//        alert(111)
//    });
//    console.log(len);
    //切换页签样式：遍历li，给li绑定onclick事件
    for(var i=0;i<len;i++){
        lis[i].onclick=function(){
            //切换页签样式↓
            for(var i=0;i<len;i++){
//                alert(111)
                if(lis[i]==this){
                    lis[i].style.background="#1ab394";
                    lis[i].querySelector("a").style.color="white";
                }else{
                    lis[i].style.background="white";
                    lis[i].querySelector("a").style.color="black";
                }
            }
        }
    }
</script>
</body>
</html>
