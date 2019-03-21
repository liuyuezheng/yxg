<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"F:\ayxg\public/../application/index\view\order\showorder.html";i:1553082244;}*/ ?>
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
        padding: 10px 10px;
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
                    订单管理 &nbsp;&nbsp;&nbsp;&nbsp;
                    <!-- <button class="layui-btn " onclick="window.history.back(-1)">返回上一页</button> -->
                </div>
                <div class="ibox-content">
                    <div class="input-group" style=" width: 100%;">
                        <div style="float: left;width: 50px;height: 50px"><img src="<?php echo $detail['goods_image']; ?>" style="width: 50px"></div>
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
                        <h3>订单</h3>
                    </div>
                    <div class="ibox-title">
                        <h4>订单信息</h4>
                    </div>
                    <div class="input-group" style=" width: 100%;">
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>买家付款时间：<?php if($orders['pay_time'] > 0): ?> <?php echo date('Y-m-d H:i:s',$orders['pay_time']); else: ?> 无
                                    <?php endif; ?></li>
                                <li>    付款方式:<?php if($orders['type'] == '0'): ?>余额<?php endif; if($orders['type'] == '1'): ?>微信<?php endif; ?>
                                </li>
                                <li>    收货地址：<?php echo $orders['address']; ?></li>
                                <li>    会员电话：<?php echo $users['telephone']; ?></li>
                                <li>    买家留言：   <?php if(empty($orders['remark']) || (($orders['remark'] instanceof \think\Collection || $orders['remark'] instanceof \think\Paginator ) && $orders['remark']->isEmpty())): ?>
                                   无
                                    <?php else: ?>
                                    <?php echo $orders['remark']; endif; ?></li>
                            </ul>
                        </div>
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>订单状态：
                                    <?php if(($detail['orders_status'] == 0)): ?>
                                    待付款
                                    <?php elseif(($detail['orders_status'] == 1)): ?>
                                    待发货
                                    <?php elseif(($detail['orders_status'] == 2)): ?>
                                    待收货
                                    <?php elseif(($detail['orders_status'] == 4)): ?>
                                    交易取消
                                    <?php else: ?>
                                    交易成功
                                    <?php endif; ?>
                                  <!--  <?php if(($orders['status'] == 0)): ?>
                                    待付款
                                    <?php elseif(($orders['status'] == 1)): ?>
                                    待发货
                                    <?php elseif(($orders['status'] == 2)): ?>
                                    待收货
                                    <?php elseif(($orders['status'] == 3)): ?>
                                    交易失败
                                    <?php else: ?>
                                    交易取消
                                    <?php endif; ?>-->
                                </li>
                                <li>  收货人: <?php echo $orders['name']; ?></li>
                                <li>联系方式：<?php echo $orders['telephone']; ?></li>
                                <li>  会员编号：<?php echo $users['user_num']; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div style="margin: 13px">
                    <h4>佣金信息</h4>
                </div>
                    <div class="input-group" style=" width: 100%;">
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>总代：
                                    <?php if(empty($arr1) || (($arr1 instanceof \think\Collection || $arr1 instanceof \think\Paginator ) && $arr1->isEmpty())): ?>
                                    无
                                    <?php else: ?>
                                    <?php echo $arr1['gradename1']; ?>
                                    <?php echo $arr1['telephone1']; ?>
                                    分配<span style="color: red">￥<?php echo $arr1['money1']; ?></span>
                                    <?php endif; ?>

                                    </li>
                                <li>一级总代：
                                    <?php if(empty($arr2) || (($arr2 instanceof \think\Collection || $arr2 instanceof \think\Paginator ) && $arr2->isEmpty())): ?>
                                    无
                                    <?php else: ?>
                                    <?php echo $arr2['gradename2']; ?>
                                    <?php echo $arr2['telephone2']; ?>
                                    分配<span style="color: red">￥<?php echo $arr2['money2']; ?></span>
                                    <?php endif; ?>

                                </li>
                                <li>二级总代：
                                    <?php if(empty($arr3) || (($arr3 instanceof \think\Collection || $arr3 instanceof \think\Paginator ) && $arr3->isEmpty())): ?>
                                    无
                                    <?php else: ?>
                                    <?php echo $arr3['gradename3']; ?>
                                    <?php echo $arr3['telephone3']; ?>
                                    分配<span style="color: red">￥<?php echo $arr3['money3']; ?></span>
                                    <?php endif; ?>
                                    </li>

                            </ul>
                        </div>
                        <div style="float: left;width: 50%">
                            <ul>
                            <!--    <li>一级总代：
                                    <?php if(empty($arr2) || (($arr2 instanceof \think\Collection || $arr2 instanceof \think\Paginator ) && $arr2->isEmpty())): ?>
                                    无
                                    <?php else: ?>
                                    <?php echo $arr2['gradename2']; ?>
                                    <?php echo $arr2['telephone2']; ?>
                                    分配￥<?php echo $arr2['money2']; endif; ?>

                                    </li>-->
                                <li>董事：
                                    <?php if(empty($arr4) || (($arr4 instanceof \think\Collection || $arr4 instanceof \think\Paginator ) && $arr4->isEmpty())): ?>
                                    无
                                    <?php else: ?>
                                    <?php echo $arr4['gradename4']; ?>
                                    <?php echo $arr4['telephone4']; ?>
                                    分配<span style="color: red">￥<?php echo $arr4['money4']; ?></span>
                                    <?php endif; ?>

                                    </li>
                                <li>一级董事：
                                    <?php if(empty($arr5) || (($arr5 instanceof \think\Collection || $arr5 instanceof \think\Paginator ) && $arr5->isEmpty())): ?>
                                    无
                                    <?php else: ?>
                                    <?php echo $arr5['gradename5']; ?>
                                    <?php echo $arr5['telephone5']; ?>
                                    分配<span style="color: red">￥<?php echo $arr5['money5']; ?></span>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div style="margin: 13px">
                        <h4>订单时间</h4>
                    </div>
                    <div class="input-group" style=" width: 100%;">
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>创建时间：<?php echo date('Y-m-d H:i:s',$orders['create_time']); ?></li>
                                <li>买家付款时间:<?php if($orders['pay_time'] > 0): ?> <?php echo date('Y-m-d H:i:s',$orders['pay_time']); else: ?> 无
                                    <?php endif; ?></li>

                            </ul>
                        </div>
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>卖家发货时间：<?php if($detail['shipments_time'] > 0): ?>
                                    <?php echo date('Y-m-d H:i:s',$detail['shipments_time']); else: ?> 无
                                    <?php endif; ?>
                                </li>
                                <li>确认收货时间:<?php if($detail['accomplish_time'] > 0): ?>
                                    <?php echo date('Y-m-d H:i:s',$detail['accomplish_time']); else: ?> 无
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div style="margin: 13px">
                        <h4>评价</h4>
                    </div>
                    <div class="input-group" style=" width: 100%;">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr style="text-align: center;">
                                <th style="text-align: center;">评价信息</th>
                                <th style="text-align: center;">操作</th>
                            </tr>
                            </thead>
                            <?php if(is_array($opinions) || $opinions instanceof \think\Collection || $opinions instanceof \think\Paginator): if( count($opinions)==0 ) : echo "" ;else: foreach($opinions as $key=>$v1): ?>
                            <tbody>
                            <tr class="gradeX">
                                <td><ul>
                                    <li>用户：<?php echo $v1['nickname']; ?></li>
                                    <li>内容：<?php echo $v1['content']; ?></li>
                                    <li>
                                        <?php if(is_array($v1['images']) || $v1['images'] instanceof \think\Collection || $v1['images'] instanceof \think\Paginator): if( count($v1['images'])==0 ) : echo "" ;else: foreach($v1['images'] as $key=>$vs): ?>
                                        <img src="<?php echo $vs; ?>" style="width: 50px" >
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </li>
                                </ul></td>

                                <td class="center">

                                    <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="update_showorder(this)" data-status="2" data-id="<?php echo $v1['id']; ?>">修改</a>

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



</body>
<script>
    function update_showorder(update_showorder){
        var id = $(update_showorder).attr('data-id');
//        var status = $(update_slidedeliver).attr('data-status');
//       alert(status)
        layer.ready(function(){
            layer.open({
                type: 2,
                title: '评论修改',
                maxmin: true,
                area: ['80%', '80%'],
                content: '<?php echo url('editopinion'); ?>?id='+id,
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('showorder'); ?>';
                }
            });
        });
    }


</script>

<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


