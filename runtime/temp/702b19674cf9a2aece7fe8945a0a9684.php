<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"F:\ayxg\public/../application/index\view\kitings\agree.html";i:1552468480;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>提现记录</title>
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
    .active span{
        background-color: #1ab394 !important;
        color: white !important;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    提现记录&nbsp;&nbsp;<img style="width: 20px" onclick="history.go(0)" src="/static/hplus/img/123.jpg">
                </div>
                <div class="ibox-content">
                    <!-- <a data-toggle="modal" class="btn btn-primary" onclick="add_goodsinfo()"  href="form_basic.html#modal-form">添加商品信息</a>
                     <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId"  href="form_basic.html#modal-form">批量昨日爆款</a>
                     <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId2"  href="form_basic.html#modal-form">批量今日主推</a>
 -->
                    <div class="input-group" style=" width: 100%;">


                        <div class="layui-input-inline" style="margin-left:16px;">
                            <?php if(empty($times) || (($times instanceof \think\Collection || $times instanceof \think\Paginator ) && $times->isEmpty())): ?>
                            <input type="text" class="layui-input" style="height: 23px;width: 165%;" id="test5" placeholder="申请日期">
                            <?php else: ?>
                            <input type="text" class="layui-input" style="height: 23px;width: 165%;" id="test5" placeholder="申请日期" value="<?php echo $times; ?>">
                            <?php endif; ?>
                        </div>
                        <?php if(empty($nameorder) || (($nameorder instanceof \think\Collection || $nameorder instanceof \think\Paginator ) && $nameorder->isEmpty())): ?>
                        <input type="text" style="width: 25%;margin-left: 135px" id="nameorder"  placeholder="手机号/用户编号">
                        <?php else: ?>
                        <input type="text" style="width: 25%;margin-left: 135px" id="nameorder"  placeholder="手机号/用户编号" value="<?php echo $nameorder; ?>">
                        <?php endif; ?>
                        <button type="button" onclick="search()" style=" margin-left: 14px; " class="btn btn-sm btn-primary">
                            搜索
                        </button>
                        <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId"  style="margin-left: 10px"href="form_basic.html#modal-form">用户提现</a>
                        <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId2" style="margin-left: 10px" href="form_basic.html#modal-form">提现驳回记录</a>
                        <a data-toggle="modal" class="btn btn-w-m btn-danger"  onclick="member_out(this)" style="margin-left: 10px"  >导出</a>
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr style="text-align: center;">
                            <th style="text-align: center;">昵称</th>
                            <th style="text-align: center;">手机号</th>
                            <th style="text-align: center;">支付宝用户名</th>
                            <th style="text-align: center;">支付宝账号</th>
                            <th style="text-align: center;">申请时间</th>
                            <th style="text-align: center;">申请金额</th>
                            <th style="text-align: center;">支付类型</th>
                            <th style="text-align: center;">支付日期</th>

                        </tr>
                        </thead>
                        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
                        <tbody>
                        <tr class="gradeX">
                            <td><?php echo $v['nickname']; ?></td>
                            <td><?php echo $v['telephone']; ?></td>
                            <td><?php if(empty($v['alipay']) || (($v['alipay'] instanceof \think\Collection || $v['alipay'] instanceof \think\Paginator ) && $v['alipay']->isEmpty())): ?>
                                无
                                <?php else: ?>
                                <?php echo $v['alipay']; endif; ?></td>
                            <td><?php if(empty($v['wechat']) || (($v['wechat'] instanceof \think\Collection || $v['wechat'] instanceof \think\Paginator ) && $v['wechat']->isEmpty())): ?>
                                无
                                <?php else: ?>
                                <?php echo $v['wechat']; endif; ?></td>
                            <td><?php echo date('Y-m-d H:i:s',$v['time']); ?></td>
                            <td>￥<?php echo $v['money']; ?></td>
                            <td><?php if($v['type1'] == '0'): ?>支付宝<?php endif; if($v['type1'] == '1'): ?>余额<?php endif; ?>
                            </td>
                            <td>
                                <?php echo date('Y-m-d H:i:s',$v['update_time']); ?>
                            </td>


                        </tr>
                        </tbody>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>

                </div>
                <?php echo $page; ?>
            </div>
        </div>
    </div>
</div>


<script>
    //导出
    function member_out(member_out) {
        var time1 = $("#test5").val();
        var nameorder = $("#nameorder").val();
        var reg1 = RegExp(/~/);
        console.log(reg1.test(time1));
        if(time1==''){
            window.location.href = "<?php echo url('kitings/upexcel1'); ?>?time="+time1+"&nameorder="+nameorder;
        }else{
            if(reg1.test(time1)){
                window.location.href = "<?php echo url('kitings/upexcel1'); ?>?time="+time1+"&nameorder="+nameorder;
            }else{
                layer.msg('时间格式有误',{icon: 2, shift: 6});
            }

        }
    }
    //关键字搜索
    function search(){
        var time = $("#test5").val();
        var nameorder = $("#nameorder").val();
//        window.location.href = "<?php echo url('kitings/index'); ?>?time="+time+"&nameorder="+nameorder;
        var reg = RegExp(/~/);
        console.log(reg.test(time));
        if(time==''){
            window.location.href = "<?php echo url('kitings/agree'); ?>?time="+time+"&nameorder="+nameorder;
        }else{
            if(reg.test(time)){
                window.location.href = "<?php echo url('kitings/agree'); ?>?time="+time+"&nameorder="+nameorder;
            }else{
                layer.msg('时间格式有误',{icon: 2, shift: 6});
            }

        }
//        if(reg.test(time)){
//            window.location.href = "<?php echo url('kitings/agree'); ?>?time="+time+"&nameorder="+nameorder;
//        }else{
//            layer.msg('时间格式有误',{icon: 2, shift: 6});
//        }

    }
    //同意退款 退货
    function update_slidedel(update_slidedel){
        var id = $(update_slidedel).attr('data-id');
//        alert(str);
        layer.msg("是否删除此订单", {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: '<?php echo url("order/orderdel"); ?>',
                    data: {
                        id:id
                    },
                    dataType: "json",
                    type: "post",
                    success: function(data) {
                        console.log(data);
                        if(data.code==1){
                            layer.msg(data.msg,{icon: 2, shift: 6},function () {
                                window.location.href = "<?php echo url('refunds/index'); ?>";
                            });

                        }else{
                            layer.msg('操作失败');
                        }
                    }
                });
            }
        });

    }

    //实现全选与反选
    $("#allAndNotAll").change(function() {

        if ($(this).prop("checked")){
            $("input[name='items']:checkbox").each(function(index,item){
                $(item).prop("checked", true);
            });
        } else {
            $("input[name='items']:checkbox").each(function(index,item) {
                $(item).removeAttr("checked");
            });
        }
    });

    //提现记录

    $('#getAllSelectedId').click(function(){

        window.location.href = "<?php echo url('kitings/index'); ?>"


    });
    //提现驳回记录
    $('#getAllSelectedId2').click(function(){
        window.location.href = "<?php echo url('kitings/reject'); ?>"

    });
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        laydate.render({
            elem: '#test5'
            ,type: 'datetime'
            ,range: '~'
            ,format: 'yyyy-M-d HH:mm:ss'
        });
    });
</script>

</body>

<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


