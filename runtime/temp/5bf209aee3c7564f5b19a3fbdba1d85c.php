<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"F:\ayxg\public/../application/index\view\order\excelin.html";i:1552621433;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>订单管理</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/static/hplus/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="/static/hplus/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/static/hplus/css/animate.min.css" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">
    <script src="/static/hplus/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/hplus/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/hplus/js/plugins/jeditable/jquery.jeditable.js"></script>
    <script src="/static/hplus/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/static/hplus/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/static/hplus/H-ui.admin.js"></script>
    <script src="/static/hplus/js/content.min.js?v=1.0.0"></script>
    <script src="/static/hplus/js/plugins/layer/laydate/laydate.js"></script>
    <script src="/static/hplus/layer/layer.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/hplus/layui2/css/layui.css">
    <script type="text/javascript" src="/static/hplus/layui2/layui.js"></script>
</head>
<style type="text/css">
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
    table{
        text-align: center;
    }
    ul{
        list-style: none;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    导入
                </div>
                <div class="ibox-content">
                    <!-- <a data-toggle="modal" class="btn btn-primary" onclick="add_goodsinfo()"  href="form_basic.html#modal-form">添加商品信息</a>
                     <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId"  href="form_basic.html#modal-form">批量昨日爆款</a>
                     <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId2"  href="form_basic.html#modal-form">批量今日主推</a>
 -->

                    <form action="" method="post" class="form form-horizontal" id="form-admin-permission-add" enctype="multipart/form-data">

                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-3">excel文件：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="file"  value="" name="excel">
                            </div>
                        </div>

                        <div class="row cl">
                            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                                <button type="submit" class="btn btn-success radius" id="admin-permission-save" name="admin-permission-save"><i class="icon-ok"></i> 确定</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $(".permission-list dt input:checkbox").click(function(){
            $(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
        });
        $(".permission-list2 dd input:checkbox").click(function(){
            var l =$(this).parent().parent().find("input:checked").length;
            var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
            if($(this).prop("checked")){
                $(this).closest("dl").find("dt input:checkbox").prop("checked",true);
                $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
            }
            else{
                if(l==0){
                    $(this).closest("dl").find("dt input:checkbox").prop("checked",false);
                }
                if(l2==0){
                    $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
                }
            }
        });


        //form表单通过Ajax无刷新方式提交数据给服务器端
        $('#form-admin-permission-dd').submit(function(evt){
            //阻止浏览器默认的form表单提交
            //evt.preventDefault();
            //收集form表单的信息,下述serialize()收集的信息传递给服务器端的时候与传统form表单提交的效果一致
            var shuju = $(this).serialize();  //字符串  name=val&name=val&name=val...
//            console.log(shuju);
//            return;
            if(shuju==""){
                layer.msg('请选择导入数据',{icon: 2, shift: 6});
            }else{
                //走Ajax
                $.ajax({
                    url:'<?php echo url("index/order/excelin"); ?>',
                    data:shuju,
                    dataType:'json',
                    type:'post',
                    success:function(msg){
                        alert(msg.status)
                        if(msg.status=='success'){
                            layer.alert('添加成功', {icon: 6},function(){
                                //主页面刷新
                                parent.window.location.href=parent.window.location.href;
                                //当前窗口关闭
                                layer_close();//本身的H-ui.admin.js封装的
                            });
                        }else{
                            layer.alert('添加失败，【'+msg.errorinfo+'】', {icon: 5});
                        }
                    }
                });
            }

        });
    });
</script>



</body>

<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


