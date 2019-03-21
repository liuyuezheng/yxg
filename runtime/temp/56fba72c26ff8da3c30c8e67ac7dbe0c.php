<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"F:\ayxg\public/../application/index\view\order\index.html";i:1552911586;}*/ ?>
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

                    订单管理 &nbsp;&nbsp;<img style="width: 20px" onclick="history.go(0)" src="/static/hplus/img/123.jpg"></div>
                </div>
                <div class="ibox-content">
                    <!-- <a data-toggle="modal" class="btn btn-primary" onclick="add_goodsinfo()"  href="form_basic.html#modal-form">添加商品信息</a>
                     <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId"  href="form_basic.html#modal-form">批量昨日爆款</a>
                     <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId2"  href="form_basic.html#modal-form">批量今日主推</a>
 -->
                    <div class="input-group" style=" width: 100%;">
                     <!--   <select  style="width: 10%;margin-left: 16px"  id="order_type" name="order_type">
                            <?php if($order_type == 7): ?>
                            <option value="7" selected="selected" >待付款</option>
                            <option value="">全部</option>
                            <option value="1" >待发货</option>
                            <option value="2" >待收货</option>
                            <option value="3" >交易完成</option>
                            <option value="4" >交易关闭</option>
                            <option value="5" >已付款删除</option>
                            <option value="6" >未付款删除</option>
                            <?php elseif($order_type == 1): ?>
                            <option value="1" selected="selected" >待发货</option>
                            <option value="">全部</option>
                            <option value="7" >待付款</option>
                            <option value="2" >待收货</option>
                            <option value="3" >交易完成</option>
                            <option value="4" >交易关闭</option>
                            <option value="5" >已付款删除</option>
                            <option value="6" >未付款删除</option>
                            <?php elseif($order_type == 2): ?>
                            <option value="2" selected="selected" >待收货</option>
                            <option value="">全部</option>
                            <option value="7" >待付款</option>
                            <option value="1" >待发货</option>
                            <option value="3" >交易完成</option>
                            <option value="4" >交易关闭</option>
                            <option value="5" >已付款删除</option>
                            <option value="6" >未付款删除</option>
                            <?php elseif($order_type == 3): ?>
                            <option value="3" selected="selected" >交易完成</option>
                            <option value="">全部</option>
                            <option value="7" >待付款</option>
                            <option value="1" >待发货</option>
                            <option value="2" >待收货</option>
                            <option value="4" >交易关闭</option>
                            <option value="5" >已付款删除</option>
                            <option value="6" >未付款删除</option>
                            <?php elseif($order_type == 4): ?>
                            <option value="4" selected="selected" >交易关闭</option>
                            <option value="">全部</option>
                            <option value="7" >待付款</option>
                            <option value="1" >待发货</option>
                            <option value="2" >待收货</option>
                            <option value="3" >交易完成</option>
                            <option value="5" >已付款删除</option>
                            <option value="6" >未付款删除</option>
                            <?php elseif($order_type == 5): ?>
                            <option value="5" selected="selected" >已付款删除</option>
                            <option value="">全部</option>
                            <option value="7" >待付款</option>
                            <option value="1" >待发货</option>
                            <option value="2" >待收货</option>
                            <option value="3" >交易完成</option>
                            <option value="4" >交易关闭</option>

                            <option value="6" >未付款删除</option>
                            <?php elseif($order_type == 6): ?>
                            <option value="6" selected="selected" >未付款删除</option>
                            <option value="">全部</option>
                            <option value="7" >待付款</option>
                            <option value="1" >待发货</option>
                            <option value="2" >待收货</option>
                            <option value="3" >交易完成</option>
                            <option value="4" >交易关闭</option>
                            <option value="5" >已付款删除</option>
                            <?php else: ?>
                            <option value="" selected="selected">全部</option>
                            <option value="7" >待付款</option>
                            <option value="1" >待发货</option>
                            <option value="2" >待收货</option>
                            <option value="3" >交易完成</option>
                            <option value="4" >交易关闭</option>
                            <option value="5" >已付款删除</option>
                            <option value="6" >未付款删除</option>
                            <?php endif; ?>

                        </select>-->
                        <?php if(empty($nameorder) || (($nameorder instanceof \think\Collection || $nameorder instanceof \think\Paginator ) && $nameorder->isEmpty())): ?>
                        <input type="text" style="width: 25%;margin-left: 16px" id="nameorder"  placeholder="小订单id/手机号/收货人/订单编号/快递单号/商品名称/商品编号">
                        <?php else: ?>
                        <input type="text" style="width: 25%;margin-left: 16px" id="nameorder"  placeholder="小订单id/手机号/收货人/订单编号/快递单号/商品名称/商品编号" value="<?php echo $nameorder; ?>">
                        <?php endif; ?>

                        <div class="layui-input-inline" style="margin-left:16px;">
                            <?php if(empty($times) || (($times instanceof \think\Collection || $times instanceof \think\Paginator ) && $times->isEmpty())): ?>
                            <input type="text" class="layui-input" style="height: 25px;width: 164%;" id="test5" placeholder="下单时间" value="">
                            <?php else: ?>
                            <input type="text" class="layui-input" style="height: 25px;width: 164%;" id="test5" placeholder="下单时间" value="<?php echo $times; ?>">
                            <?php endif; ?>

                        </div>

                        <button type="button" onclick="search()" style=" margin-left: 127px; " class="btn btn-sm btn-primary">
                            搜索
                        </button>
                        <a data-toggle="modal" class="btn btn-w-m btn-danger" onclick="member_add(this)"  style="margin-left: 10px" >导入</a>
                        <a data-toggle="modal" class="btn btn-w-m btn-danger"  onclick="member_out(this)" style="margin-left: 10px"  >导出</a>
                    </div>
                    <div class="tabs-container">
                        <ul class="nav nav-tabs bb">
                        <!--    <option value="" selected="selected">全部</option>
                            <option value="7" >待付款</option>
                            <option value="1" >待发货</option>
                            <option value="2" >待收货</option>
                            <option value="3" >交易完成</option>
                            <option value="4" >交易关闭</option>
                            <option value="5" >已付款删除</option>
                            <option value="6" >未付款删除</option>-->
                            <?php if($order_type == 4): ?>

                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="7"><a data-toggle="tab"  aria-expanded="false"> 待付款(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="1"><a data-toggle="tab"  aria-expanded="false">待发货(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="2" ><a data-toggle="tab"  aria-expanded="false">待收货(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">交易完成(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class="active _selected"  data-id="4"><a data-toggle="tab"  aria-expanded="true">交易关闭(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">已付款删除(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">未付款删除(<?php echo $count['all7']; ?>)</a>
                            </li>
                            <?php elseif($order_type == 5): ?>
                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="7"><a data-toggle="tab"  aria-expanded="false"> 待付款(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="1"><a data-toggle="tab"  aria-expanded="false">待发货(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="2" ><a data-toggle="tab"  aria-expanded="false">待收货(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">交易完成(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="4"><a data-toggle="tab"  aria-expanded="false">交易关闭(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class="active _selected"  data-id="5"><a data-toggle="tab"  aria-expanded="true">已付款删除(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">未付款删除(<?php echo $count['all7']; ?>)</a>
                            </li>
                            <?php elseif($order_type == 6): ?>
                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="7"><a data-toggle="tab"  aria-expanded="false"> 待付款(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="1"><a data-toggle="tab"  aria-expanded="false">待发货(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="2" ><a data-toggle="tab"  aria-expanded="false">待收货(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">交易完成(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="4"><a data-toggle="tab"  aria-expanded="false">交易关闭(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">已付款删除(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <li class="active _selected"  data-id="6"><a data-toggle="tab"  aria-expanded="true">未付款删除(<?php echo $count['all7']; ?>)</a>
                            </li>
                            <?php elseif($order_type == 3): ?>

                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="7"><a data-toggle="tab"  aria-expanded="false"> 待付款(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="1"><a data-toggle="tab"  aria-expanded="false">待发货(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="2" ><a data-toggle="tab"  aria-expanded="false">待收货(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class="active _selected"  data-id="3" ><a data-toggle="tab"  aria-expanded="true">交易完成(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="4"><a data-toggle="tab"  aria-expanded="false">交易关闭(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">已付款删除(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">未付款删除(<?php echo $count['all7']; ?>)</a>
                            </li>
                            <?php elseif($order_type == 2): ?>

                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="7"><a data-toggle="tab"  aria-expanded="false"> 待付款(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="1"><a data-toggle="tab"  aria-expanded="false">待发货(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class="active _selected"  data-id="2" ><a data-toggle="tab"  aria-expanded="true">待收货(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">交易完成(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="4"><a data-toggle="tab"  aria-expanded="false">交易关闭(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">已付款删除(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">未付款删除(<?php echo $count['all7']; ?>)</a>
                            </li>
                            <?php elseif($order_type == 7): ?>

                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="active _selected" data-id="7"><a data-toggle="tab"  aria-expanded="true"> 待付款(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="1"><a data-toggle="tab"  aria-expanded="false">待发货(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="2" ><a data-toggle="tab"  aria-expanded="false">待收货(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">交易完成(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="4"><a data-toggle="tab"  aria-expanded="false">交易关闭(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">已付款删除(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">未付款删除(<?php echo $count['all7']; ?>)</a>
                            </li>
                            <?php elseif($order_type == 1): ?>

                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="7"><a data-toggle="tab"  aria-expanded="false"> 待付款(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class="active _selected"  data-id="1"><a data-toggle="tab"  aria-expanded="true">待发货(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="2" ><a data-toggle="tab"  aria-expanded="false">待收货(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">交易完成(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="4"><a data-toggle="tab"  aria-expanded="false">交易关闭(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">已付款删除(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">未付款删除(<?php echo $count['all7']; ?>)</a>
                            </li>
                            <?php else: ?>
                            <li class="active _selected"  data-id=""><a data-toggle="tab"  aria-expanded="true">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="7"><a data-toggle="tab"  aria-expanded="false"> 待付款(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="1"><a data-toggle="tab"  aria-expanded="false">待发货(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="2" ><a data-toggle="tab"  aria-expanded="false">待收货(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">交易完成(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="4"><a data-toggle="tab"  aria-expanded="false">交易关闭(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">已付款删除(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">未付款删除(<?php echo $count['all7']; ?>)</a>
                            </li>
                            <?php endif; ?>

                        </ul>
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr style="text-align: center;">
                            <th style="text-align: center;">商品图片</th>
                            <th style="text-align: center;">商品信息</th>
                            <th style="text-align: center;">买家付款时间</th>
                            <th style="text-align: center;">支付金额</th>
                            <th style="text-align: center;">付款方式</th>
                            <th style="text-align: center;">收货信息</th>
                            <th style="text-align: center;">状态</th>
                            <th style="text-align: center;">操作</th>
                        </tr>
                        </thead>
                        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
                        <tbody>
                        <tr class="gradeX">
                            <td><img src="<?php echo $v['goods_image']; ?>" width="80px"></td>
                            <td><ul>
                                <li><?php echo $v['goods_name']; ?></li>
                                <li>商品编码:<?php if(empty($v['goods_number']) || (($v['goods_number'] instanceof \think\Collection || $v['goods_number'] instanceof \think\Paginator ) && $v['goods_number']->isEmpty())): ?>
                                 无
                                    <?php else: ?>
                                    <?php echo $v['goods_number']; endif; ?></li>
                                <li>规格:<?php if(is_array($v['goods_specification']) || $v['goods_specification'] instanceof \think\Collection || $v['goods_specification'] instanceof \think\Paginator): if( count($v['goods_specification'])==0 ) : echo "" ;else: foreach($v['goods_specification'] as $key=>$vs): ?>
                                    <?php echo $vs; endforeach; endif; else: echo "" ;endif; ?></li>
                                <li>数量：<?php echo $v['goods_count']; ?></li>
                                <li>订单编号：<?php echo $v['orders_num']; ?></li>
                            </ul></td>
                            <td>  <?php if(($v['pay_time'] == 0)): ?>
                                未付款
                                <?php else: ?>
                                <?php echo date('Y-m-d H:i:s',$v['pay_time']); endif; ?></td>
                            <td>￥<?php echo $v['real_pay']; ?></td>
                            <td><?php if($v['type'] == '0'): ?>余额<?php endif; if($v['type'] == '1'): ?>微信<?php endif; ?>
                            </td>
                            <td><ul>
                                <li><?php echo $v['telephone']; ?></li>
                                <li><?php echo $v['address']; ?></li>
                                </ul>
                            </td>
                            <td style="color: red">
                                <?php if(($v['orders_status'] == 0)): ?>
                                  待付款
                                <?php elseif(($v['orders_status'] == 1)): ?>
                                  待发货
                                <?php elseif(($v['orders_status'] == 2)): ?>
                                  待收货
                                <?php elseif(($v['orders_status'] == 4)): ?>
                                交易取消
                                <?php else: ?>
                                交易成功
                                <?php endif; ?>

                            </td>
                            <td class="center">
                                <!--<a class="btn btn-primary btn-rounded" id="status" style=" border-radius: 4px"  onclick="update_slidestatus(this)" data-id="" data-status="" data-nums="">-->

                                <!--</a>-->
                                <?php if(($v['deletes'] == 0) AND ($v['orders_status'] == 0)): ?>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="update_showorder(this)" data-status="2" data-id="<?php echo $v['detail_id']; ?>">查看</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidedel(this)" data-status="1" data-id="<?php echo $v['detail_id']; ?>">删除</a>
                                <?php elseif(($v['deletes'] == 0) AND ($v['orders_status'] == 1)): ?>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="update_showorder(this)" data-status="3" data-id="<?php echo $v['detail_id']; ?>">查看</a>
                              <!--  <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidedel(this)" data-status="4" data-id="<?php echo $v['detail_id']; ?>">删除</a>-->
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="adddeliver(this)" data-status="4" data-id="<?php echo $v['detail_id']; ?>">发货</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="editorders(this)"  data-id="<?php echo $v['detail_id']; ?>">编辑</a>
                                <?php elseif(($v['deletes'] == 0) AND ($v['orders_status'] == 2)): ?>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="update_showorder(this)" data-id="<?php echo $v['detail_id']; ?>">查看</a>
                          <!--      <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidedel(this)" data-status="1" data-id="<?php echo $v['detail_id']; ?>">删除</a>-->
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_showdeliver(this)" data-status="1" data-id="<?php echo $v['detail_id']; ?>">查看物流</a>
                                <?php elseif(($v['deletes'] == 0) AND ($v['orders_status'] > 2)): ?>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="update_showorder(this)" data-id="<?php echo $v['detail_id']; ?>">查看</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidedel(this)" data-status="1" data-id="<?php echo $v['detail_id']; ?>">删除</a>
                                <?php else: ?>  <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"    >已删除</a>
                                <?php endif; ?>
                                <!---->
                                <!--<a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="update_slidestatus(this)" data-id="<?php echo $v['detail_id']; ?>">同意退货</a>-->
                                <!--<a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidedel(this)" data-id="">拒绝退货</a>-->
                            </td>
                        </tr>
                        </tbody>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
<?php echo $page; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    //导入
    function member_add(member_add){
        layer.ready(function(){
            layer.open({
                type: 2,
                title: '导入',
                maxmin: true,
                area: ['50%', '40%'],
                content: '<?php echo url('excelin'); ?>',
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('index'); ?>';
                }
            });
        });
    }
    //导出
    function member_out(member_out) {
        var order_type = $('._selected').attr('data-id');
        var time = $("#test5").val();
        var nameorder = $("#nameorder").val();
//        var str = "~";
        var reg = RegExp(/~/);
        console.log(reg.test(time));
        if(time==''){
            window.location.href = "<?php echo url('order/excel'); ?>?order_type="+order_type+"&time="+time+"&nameorder="+nameorder;
        }else{
            if(reg.test(time)){
                window.location.href = "<?php echo url('order/excel'); ?>?order_type="+order_type+"&time="+time+"&nameorder="+nameorder;
            }else{
                layer.msg('时间格式有误',{icon: 2, shift: 6});
            }

        }
    }
    //查看订单详情
    function update_showorder(update_showorder){
        var id = $(update_showorder).attr('data-id');
            window.open("<?php echo url('order/showorder'); ?>?detail_id="+id);

    }
    //发货
    function adddeliver(adddeliver) {
        var id = $(adddeliver).attr('data-id');
//        var status = $(update_slidedeliver).attr('data-status');
//       alert(status)
        layer.ready(function(){
            layer.open({
                type: 2,
                title: '发货',
                maxmin: true,
                area: ['50%', '40%'],
                content: '<?php echo url('adddeliver'); ?>?id='+id,
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('index'); ?>';
                }
            });
        });
    }
    //编辑订单信息
    function editorders(editorders) {
        var id = $(editorders).attr('data-id');
//        var status = $(update_slidedeliver).attr('data-status');
//       alert(status)
        layer.ready(function(){
            layer.open({
                type: 2,
                title: '编辑',
                maxmin: true,
                area: ['80%', '60%'],
                content: '<?php echo url('editorders'); ?>?id='+id,
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('index'); ?>';
                }
            });
        });
    }
    //查看物流
    function update_showdeliver(update_slidedeliver) {
        var id = $(update_slidedeliver).attr('data-id');
//        var status = $(update_slidedeliver).attr('data-status');
//       alert(status)
        layer.ready(function(){
            layer.open({
                type: 2,
                title: '查看物流',
                maxmin: true,
                area: ['50%', '40%'],
                content: '<?php echo url('showdeliver'); ?>?id='+id,
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('index'); ?>';
                }
            });
        });
    }
    console.log('25454354')
    //关键字搜索
    $('.bb li').on('click',function () {
        $(this).addClass('_selected').siblings().removeClass('_selected');
        search($(this).attr('data-id'))
    })
    //关键字搜索
    function search(){
        var order_type =$('._selected').attr('data-id');
        console.log('order_type=',order_type)
        var time = $("#test5").val();
        var nameorder = $("#nameorder").val();
//        var str = "~";
        var reg = RegExp(/~/);
        console.log(reg.test(time));
        if(time==''){
            window.location.href = "<?php echo url('order/index'); ?>?order_type="+order_type+"&time="+time+"&nameorder="+nameorder;
        }else{
            if(reg.test(time)){
                window.location.href = "<?php echo url('order/index'); ?>?order_type="+order_type+"&time="+time+"&nameorder="+nameorder;
            }else{
                layer.msg('时间格式有误',{icon: 2, shift: 6});
            }

        }
//        var order_status = $("#order_status option:selected").val();
//        var time_type = $("#time_type option:selected").val();

//
//        window.location.href = "<?php echo url('order/index'); ?>?order_type="+order_type+"&time="+time+"&nameorder="+nameorder;
    }

    //删除订单
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
                            layer.msg(data.msg,{icon: 1, shift: 6},function () {
                                history.go(0)
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

    //批量同意
    var ids=[];
    var status=[];
    $('#getAllSelectedId').click(function(){
        $("input[name='items']:checked").each(function(){
            ids.push($(this).attr("id"));
//            status.push($(this).parent().parent().find("a[]").attr('data-status'));
        });
        console.log("id长度"+ids.length);
//        console.log("状态"+status);
        if(ids.length == 0){
            layer.msg('请选择订单', {icon: 2, shift: 6});
            return;
        }
        var str=$(this).text();
        layer.msg("是否"+str, {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: "<?php echo url('refunds/allstatus'); ?>",
                    type: "post",
                    data: {
                        ids:ids,type:1
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (data.code === 1) {
                            layer.msg(data.msg, {icon: 1, shift: 6});
                            history.go(0)
                        } else {
                            layer.msg(data.msg, {icon: 2, shift: 6});
                        }
                    },
                    error: function (e) {
                        layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
                    }
                });
            }
        });

        return false;

    });
    //批量拒绝
    var ids2=[];
    $('#getAllSelectedId2').click(function(){
        $("input[name='items']:checked").each(function(){
            ids2.push($(this).attr("id"));
        });
        console.log("id长度"+ids2.length);
        if(ids2.length == 0){
            layer.msg('请选择商品', {icon: 2, shift: 6});
            return;
        }
//        main
        layer.msg("是否批量拒绝", {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: "<?php echo url('refunds/allrefuse'); ?>",
                    type: "post",
                    data: {
                        id:ids,type:2
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (data.code === 1) {
                            layer.msg(data.msg, {icon: 1, shift: 6});
                            history.go(0)
                        } else {
                            layer.msg(data.msg, {icon: 2, shift: 6});
                        }
                    },
                    error: function (e) {
                        layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
                    }
                });
            }
        });
        return false;

    });
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        laydate.render({
            elem: '#test5'
            ,range: '~'
            ,format: 'yyyy-MM-dd'
        });
    });
</script>

</body>

<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


