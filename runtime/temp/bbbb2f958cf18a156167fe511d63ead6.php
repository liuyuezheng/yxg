<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"F:\ayxg\public/../application/index\view\refunds\detail.html";i:1552909616;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>售后管理</title>
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
    ul li{
        padding: 10px;
    }
    .bgimg{
        background-color:rgba(0,0,0,0.5);width: 100%;height: 100%;
        top:0;
        left: 0;
        position: fixed;
        display: none;
    }
    .bgimg img{
        width: 400px;
        margin-top: 100px;
        position: relative;
        left: 50%;
        margin-left: -200px;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    售后管理 &nbsp;&nbsp;&nbsp;&nbsp;
                    <!-- <button class="layui-btn " onclick="window.history.back(-1)">返回上一页</button> -->
                </div>
                <div class="ibox-content">
                    <div class="input-group" style=" width: 100%;">
                       <div style="float: left;width: 50px;height: 50px"><img style="width: 50px;height: 50px" src="<?php echo $detail['goods_image']; ?>"></div>
                       <div style="float: left">
                           <ul>
                               <li><?php echo $detail['goods_name']; ?></li>
                               <li>规格:<?php if(is_array($detail['goods_specification']) || $detail['goods_specification'] instanceof \think\Collection || $detail['goods_specification'] instanceof \think\Paginator): if( count($detail['goods_specification'])==0 ) : echo "" ;else: foreach($detail['goods_specification'] as $key=>$v): ?>
                                   <?php echo $v; endforeach; endif; else: echo "" ;endif; ?></li>
                               <li>数量：<?php echo $detail['goods_count']; ?></li>
                               <li>订单编号：<?php echo $orders['orders_num']; ?></li>
                           </ul>
                       </div>
                        <div style="float: left">
                        <ul>
                            <li><label></label></li>
                            <li>单价:￥<?php echo $detail['goods_price']; ?></li>
                            <li>小计：￥<?php echo $detail['zmoneys']; ?></li>
                            <li>优惠券：<?php if($orders['coupon_id'] == '0'): ?>无<?php else: ?><?php echo $orders['coupon']; endif; ?></li>
                        </ul>
                        </div>
                        <div style="float: left">
                            <ul>
                                <li><label></label></li>
                                <li>单价:￥<?php echo $detail['goods_price']; ?></li>
                                <li>小计：￥<?php echo $detail['real_pay']; ?></li>
                                <li>实际支付金额：￥<?php echo $detail['real_pay']; ?></li>
                            </ul>
                        </div>
                        <div style="float: left">
                            <ul>
                                <li><label></label></li>
                                <li>积分:<?php echo $integral['own_integral']; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div >
                        <h3>退款订单</h3>
                    </div>
                    <div class="ibox-title">
                        <h4>订单信息</h4>
                    </div>
                    <div class="input-group" style=" width: 100%;">
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>买家付款时间：<?php echo date('Y-m-d H:i:s',$orders['create_time']); ?></li>
                                <li>    付款方式:<?php if($orders['type'] == '0'): ?>余额<?php endif; if($orders['type'] == '1'): ?>微信<?php endif; ?>
                                </li>
                                <li>    收货地址：<?php echo $orders['address']; ?></li>
                                <li>    会员电话：<?php echo $users['telephone']; ?></li>
                            </ul>
                        </div>
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>订单状态：<?php if($detail['status'] == '2'): ?>退款中<?php endif; if($detail['status'] == '3'): ?>退款成功<?php endif; if($detail['status'] == '4'): ?>退款失败<?php endif; ?>
                                </li>
                                <li>  收货人: <?php echo $orders['name']; ?></li>
                                <li>联系方式：<?php echo $orders['telephone']; ?></li>
                     <!--           <li>  会员编号：<?php echo $users['user_num']; ?></li>-->
                            </ul>
                        </div>
                    </div>
                        <div style="margin: 13px">
                            <h4>退款信息</h4>
                        </div>
                    <div class="input-group" style=" width: 100%;">
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>退款单号：<?php echo $refunds['refund_num']; ?></li>
                                <li>退款类型:<?php if($refunds['type'] == '0'): ?>未发货退款<?php endif; if($refunds['type'] == '1'): ?>已发货仅退款<?php endif; if($refunds['type'] == '2'): ?>已发货退货退款<?php endif; ?></li>
                            </ul>
                        </div>
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>退款状态：<?php if(($refunds['refund_status'] == 1)): ?> 退款失败
                                    <?php elseif($refunds['refund_status'] == 2): ?>退款成功
                                    <?php else: ?> 退款中
                                    <?php endif; ?></li>
                                <li>退款金额:￥<?php echo $refunds['refund_money']; ?></li>
                            </ul>
                        </div>
                        <div>
                            <ul>

                                <li>退货/退款理由:<?php if(empty($refunds['refund_reason']) || (($refunds['refund_reason'] instanceof \think\Collection || $refunds['refund_reason'] instanceof \think\Paginator ) && $refunds['refund_reason']->isEmpty())): ?>
                                    无
                                    <?php else: ?>
                                    <?php echo $refunds['refund_reason']; endif; ?></li>
                                <li>退货/退款拒绝理由：<?php if(empty($refunds['refund_reject']) || (($refunds['refund_reject'] instanceof \think\Collection || $refunds['refund_reject'] instanceof \think\Paginator ) && $refunds['refund_reject']->isEmpty())): ?>
                                    无
                                    <?php else: ?>
                                    <?php echo $refunds['refund_reject']; endif; ?></li>

                                <li>退货/退款图片:
                                    <?php if(is_array($refunds['refund_images']) || $refunds['refund_images'] instanceof \think\Collection || $refunds['refund_images'] instanceof \think\Paginator): if( count($refunds['refund_images'])==0 ) : echo "" ;else: foreach($refunds['refund_images'] as $key=>$v2): ?>
                                    <img src="<?php echo $v2; ?>" style="width: 50px;" onclick="bgimg('<?php echo $v2; ?>')">
                                    <?php endforeach; endif; else: echo "" ;endif; ?></li>
                            </ul>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


    <div class="bgimg" onclick="bgimgdis()">
        <img src="" alt="">
    </div>

</body>
<script>
    function bgimg(img) {
        $('.bgimg').css('display','block');
        $('.bgimg').find('img').attr('src',img);
    }
    function  bgimgdis() {
        $('.bgimg').css('display','none');
    }
</script>
<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


