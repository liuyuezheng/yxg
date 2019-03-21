<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"F:\ayxg\public/../application/index\view\users\superiordetail.html";i:1552571431;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>董事/总代管理信息</title>
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
    <script src="/static/hplus/echarts.min.js?v=111"></script>
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
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" style="height: 100%">
                <div class="ibox-title">
                    董事/总代管理信息&nbsp;&nbsp;&nbsp;&nbsp;
                    <!-- <button class="layui-btn " onclick="window.history.go(-1)">返回上一页</button> -->
                </div>
                <div class="ibox-content">
                    <div class="input-group" style=" width: 100%;">
                        <input type="hidden" value="<?php echo $id; ?>" id="u_id">
                        <div style="float: left;width: 50px;height: 50px"><img src="<?php echo $data['head_image']; ?>" style="width: 45px;height: 45px"></div>
                        <div style="float: left">
                            <ul>
                                <li><?php echo $data['nickname']; ?>
                                    <lable style="color: #FFF;border-radius: 31%;background-color: red;padding: 5px">
                                        <?php if($data['grade'] == '1'): ?>总代<?php endif; if($data['grade'] == '2'): ?>董事<?php endif; ?>
                                    </lable>
                                </li>
                                <li>手机号:<?php echo $data['telephone']; ?></li>
                                <li>用户编号：<?php echo $data['user_num']; ?></li>
                            </ul>
                        </div>
                        <div style="float: left;margin-left: 50px">
                            <h1><a href="<?php echo url('users/expect'); ?>?id=<?php echo $id; ?>">预计佣金：￥<?php echo $data['unbrokerage']; ?></a></h1>
                        </div>
                    </div>
                    <div >
                        <h3><?php echo $data['nickname']; ?>信息</h3>
                    </div>
                    <div class="ibox-title">
                        <h4>基本信息</h4>
                    </div>
                    <div class="input-group" style=" width: 100%;">
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>直属上级：<?php echo $data['up_name']; ?></li>
                                <li>创建时间:<?php echo date('Y-m-d H:i:s',$data['time']); ?>
                                </li>
                            </ul>
                        </div>
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>  直属董事: <?php echo $data['manager_name']; ?></li>
                                <?php if($data['grade'] == '1'): ?>
                                <li>成为分销商时间:
                                    <?php if($data['retail_time'] != 0): ?>
                                    <?php echo date('Y-m-d H:i:s',$data['retail_time']); else: ?>
                                     无
                                    <?php endif; ?>

                                </li>
                                <?php endif; if($data['grade'] == '2'): ?>
                                <li>成为董事时间:<?php if($data['ceo_time'] != 0): ?>
                                    <?php echo date('Y-m-d H:i:s',$data['ceo_time']); else: ?>
                                    无
                                    <?php endif; ?>
                                   </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div style="margin: 13px">
                        <h4>消费信息</h4>
                    </div>
                    <div class="input-group" style=" width: 100%;">
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>总计订单：<?php echo $data['order_nums']; ?></li>
                                <li>本月订单:<?php echo $data['month_order_nums']; ?></li>
                            </ul>
                        </div>
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>总消费金额：￥<?php echo $data['consumes']; ?></li>
                                <li>本月消费金额:￥<?php echo $data['month_consumes']; ?></li>
                            </ul>
                        </div>

                    </div>
                    <div style="margin: 13px">
                        <h4>财务信息</h4>
                    </div>
                    <div class="input-group" style=" width: 100%;">
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>积分：<?php echo $data['integral']; ?></li>
                                <li>佣金余额:￥<?php echo $data['brokerage']; ?></li>
                                <li>佣金总收入:￥<?php echo $data['remain_brokerage']; ?></li>
                            </ul>
                        </div>
                        <div style="float: left;width: 50%">
                            <ul>
                                <li>账户余额：￥<?php echo $data['balance']; ?></li>
                                <li>持有优惠券:<?php echo $data['my_coupon']; ?></li>
                                <li> <a href="<?php echo url('users/changebalance'); ?>?id=<?php echo $id; ?>">余额变动记录:<label style="color: red">
                                    <?php echo $data['balance_num']; ?></label></a></li>
                            </ul>
                        </div>

                    </div>
                    <div style="margin: 13px">
                        <h4>财务报表</h4>
                    </div>
                    <!--<div class="input-group" style=" width: 100%;height: 100%">-->
                        <div id="container" style="height:500px"></div>
                    <!--</div>-->
                    <div style="margin: 13px">
                        <h4>提现记录</h4>
                    </div>
                    <div class="input-group" style=" width: 100%;">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr style="text-align: center;">
                                <th style="text-align: center;">提现时间</th>
                                <th style="text-align: center;">提现金额（元）</th>
                            </tr>
                            </thead>
                            <?php if(is_array($kits) || $kits instanceof \think\Collection || $kits instanceof \think\Paginator): if( count($kits)==0 ) : echo "" ;else: foreach($kits as $key=>$v1): ?>
                            <tbody>
                            <tr class="gradeX">
                                <td><?php echo date('Y-m-d H:i:s',$v1['update_time']); ?></td>
                                <td>￥<?php echo $v1['money']; ?></td>
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
</div>



</body>
<script>
    var u_id = $('#u_id').val();
    $.ajax({
        url: "<?php echo url('users/week_user'); ?>",
        type: "post",
        data: {
            id:u_id
        },
        dataType: "json",
        success: function (data) {
            console.log(data.data.bro_prices)
            var dom = document.getElementById("container");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            option = {
                title: {
                    text: '折线图堆叠'
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data:['佣金提成','订单数','订单金额']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: ['周一','周二','周三','周四','周五','周六','周日']
                },
                yAxis: {
                    type: 'value'
                },
                series: [
                    {
                        name:'佣金提成',
                        type:'line',
                        stack: '总量',
                        data:data.data.bro_prices
                    },
                    {
                        name:'订单数',
                        type:'line',
                        stack: '总量',
                        data:data.data.num
                    },
                    {
                        name:'订单金额',
                        type:'line',
                        stack: '总量',
                        data:data.data.orders_prices
                    },
                ]
            };
            window.onload = myChart.resize;
            myChart.setOption(option, true);
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
        },
        error: function (e) {
            layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
        }
    });


</script>
<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


