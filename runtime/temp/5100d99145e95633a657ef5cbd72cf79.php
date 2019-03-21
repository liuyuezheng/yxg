<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"F:\ayxg\public/../application/index\view\index\welcome.html";i:1552633487;}*/ ?>
<!DOCTYPE html>
<html>

	<!-- Mirrored from www.zi-han.net/theme/hplus/graph_metrics.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:09 GMT -->

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>数据统计</title>
		<meta name="keywords">
		<meta name="description">

		<link rel="shortcut icon" href="favicon.ico">
		<link href="/static/hplus/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
		<link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

		<link href="/static/hplus/css/animate.min.css" rel="stylesheet">
		<link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">

	</head>

	<body class="gray-bg">
		<div class="wrapper wrapper-content animated fadeInRight">

			<div class="glyphicon glyphicon-align-right" style="font-size:16px; padding: 0 0 30px 12px;">
				<span style="font-size: 24px;">基本数据统计&nbsp;<img style="width: 20px" onclick="history.go(0)" src="/static/hplus/img/123.jpg"></span></div>
			</div>
			<div class="row">
				<div class="col-sm-3" style="width: 100%">
					<div class="ibox">
						<div style="float: left;background-color: #FFF;    padding: 15px 20px 20px;">
							<h5>申请提现（笔）</h5>
							<h1 class="no-margins"><?php echo $kit['kit_num']; ?></h1>
		<!-- 					<div class="stat-percent font-bold text-navy">98% <i class="fa fa-bolt"></i></div> -->
						</div>
						<div style="float: left;background-color: #FFF;    padding: 15px 20px 20px;">
							<h5>已支出佣金（元）</h5>
							<h1 class="no-margins"><?php echo $kit['out_price']; ?></h1>
							<!-- 					<div class="stat-percent font-bold text-navy">98% <i class="fa fa-bolt"></i></div> -->
						</div>
						<div style="float: left;background-color: #FFF;    padding: 15px 20px 20px;">
							<h5>佣金余额（元）</h5>
							<h1 class="no-margins"><?php echo $kit['brokerage']; ?></h1>
							<!-- 					<div class="stat-percent font-bold text-navy">98% <i class="fa fa-bolt"></i></div> -->
						</div>
						<div style="float: left;background-color: #FFF;    padding: 15px 20px 20px;">
							<h5>待收益佣金（元）</h5>
							<h1 class="no-margins"><?php echo $kit['unbrokerage']; ?></h1>
							<!-- 					<div class="stat-percent font-bold text-navy">98% <i class="fa fa-bolt"></i></div> -->
						</div>
					</div>
				</div>


			</div>
			<div class="glyphicon glyphicon-align-right" style="font-size:16px; padding: 0 0 30px 12px;">
				<span style="font-size: 24px;">总订单信息</span>
			</div>
			<div class="row">
				<div class="col-sm-3" style="
    width: 100%;">
					<div class="ibox">
						<div   style="float: left;background-color: #FFF;    padding: 15px 20px 20px;">
							<h5>总订单总数（笔）</h5>
							<h1 class="no-margins"><?php echo $data['order_num']; ?></h1>
						</div>
						<div  style="float: left;background-color: #FFF;    padding: 15px 20px 20px;">
							<h5>总消费金额（元）</h5>
							<h1 class="no-margins"><?php echo $data['num']; ?></h1>
						</div>
						<div  style="float: left;background-color: #FFF;    padding: 15px 20px 20px;">
							<h5>本月订单总数（笔）</h5>
							<h1 class="no-margins"><?php echo $data['month_order_num']; ?></h1>
						</div>
						<div  style="float: left;background-color: #FFF;    padding: 15px 20px 20px;">
							<h5>本月消费金额（元）</h5>
							<h1 class="no-margins"><?php echo $data['month_num']; ?></h1>
						</div>
					</div>
				</div>
			</div>
			<div style="padding-top: 15px;width: 100%"></div>
		    <div style="width: 10%;text-align: center;background-color: #00a0e9;float: left;color: white;height: 36px;line-height: 36px;font-size: 14px;font-weight: bolder;border:1px solid #ccc; border-width:0 1px;" id="orders"> 总订单数 </div>
			<div style="width: 10%;text-align: center;float: left;height: 36px;line-height: 36px;font-size: 14px;background-color: white;font-weight: bolder;border:1px solid #ccc; border-width:0 1px;" id="manager_orders"> 总代董事总订单数 </div>
			<div style="width: 10%;text-align: center;float: left;height: 36px;line-height: 36px;font-size: 14px;background-color: white;font-weight: bolder;border:1px solid #ccc; border-width:0 1px;" id="person_orders"> 普通用户总订单数 </div>
		<div style="width: 10%;text-align: center;float: left;height: 36px;line-height: 36px;font-size: 14px;background-color: white;font-weight: bolder;border:1px solid #ccc; border-width:0 1px;" id="sales"> 销量 </div>
		<div style="width: 10%;text-align: center;float: left;height: 36px;line-height: 36px;font-size: 14px;background-color: white;font-weight: bolder;border:1px solid #ccc; border-width:0 1px;" id="sales_money"> 销售总金额(元) </div>
			<div style="padding-top: 36px"></div>
			<div id="container" style="height:500px"></div>
		</div>
		<script src="/static/hplus/js/jquery.min.js?v=2.1.4"></script>
		<script src="/static/hplus/echarts.min.js?v=111"></script>
		<script src="/static/hplus/js/bootstrap.min.js?v=3.3.6"></script>
		<script src="/static/hplus/js/plugins/sparkline/jquery.sparkline.min.js"></script>
		<script src="/static/hplus/js/plugins/peity/jquery.peity.min.js"></script>
		<script src="/static/hplus/js/content.min.js?v=1.0.0"></script>
		<script src="/static/hplus/js/demo/peity-demo.min.js"></script>
		<script src="/static/hplus/js/plugins/morris/raphael-2.1.0.min.js"></script>
		<script src="/static/hplus/js/plugins/morris/morris.js"></script>
		<script src="/static/hplus/js/content.min.js"></script>
		<script src="/static/hplus/js/plugins/layer/laydate/laydate.js"></script>
		<script src="/static/hplus/layer/layer.js"></script>
		<script>
			//总订单数
         $('#orders').click(function(){
             $(this).css("background-color","#00a0e9");
             $(this).css("color","white");
             $('#manager_orders').css("background-color","white");
             $('#manager_orders').css("color","black");
             $('#person_orders').css("background-color","white");
             $('#person_orders').css("color","black");
             $('#sales').css("background-color","white");
             $('#sales').css("color","black");
             $('#sales_money').css("background-color","white");
             $('#sales_money').css("color","black");
             $.ajax({
                 url: "<?php echo url('index/user_order'); ?>",
                 type: "post",
                 data: {
                     grade:3
                 },
                 dataType: "json",
                 success: function (data) {
                     console.log(data);
                     var dom = document.getElementById("container");
                     var myChart = echarts.init(dom);
                     var app = {};
                     option = null;
                     option = {
                         tooltip: {
                             trigger: 'axis'
                         },
                         xAxis: {
                             type: 'category',
                             data: data.days
                         },
                         yAxis: {
                             type: 'value'
                         },
                         series: [{
                             name:'总订单（个）',
                             data: data.data,
                             type: 'line'
                         }]
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
//         	window.location.href = "<?php echo url('orders/order_delivered'); ?>?type=2"
         })
           //总代董事总订单数
        $('#manager_orders').click(function(){
            $(this).css("background-color","#00a0e9");
            $(this).css("color","white");
            $('#orders').css("background-color","white");
            $('#orders').css("color","black");
            $('#person_orders').css("background-color","white");
            $('#person_orders').css("color","black");
            $('#sales').css("background-color","white");
            $('#sales').css("color","black");
            $('#sales_money').css("background-color","white");
            $('#sales_money').css("color","black");
            $.ajax({
                url: "<?php echo url('index/user_order'); ?>",
                type: "post",
                data: {
                    grade:2
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    var dom = document.getElementById("container");
                    var myChart = echarts.init(dom);
                    var app = {};
                    option = null;
                    option = {
                        tooltip: {
                            trigger: 'axis'
                        },
                        xAxis: {
                            type: 'category',
                            data: data.days
                        },
                        yAxis: {
                            type: 'value'
                        },
                        series: [{
                            name:'总代/董事订单（个）',
                            data: data.data,
                            type: 'line'
                        }]
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
//         	window.location.href = "<?php echo url('shop/index'); ?>"
         });
//            普通用户总订单数
            $('#person_orders').click(function(){
                $(this).css("background-color","#00a0e9");
                $(this).css("color","white");
                $('#orders').css("background-color","white");
                $('#orders').css("color","black");
                $('#manager_orders').css("background-color","white");
                $('#manager_orders').css("color","black");
                $('#sales').css("background-color","white");
                $('#sales').css("color","black");
                $('#sales_money').css("background-color","white");
                $('#sales_money').css("color","black");
                $.ajax({
                    url: "<?php echo url('index/user_order'); ?>",
                    type: "post",
                    data: {
                        grade:1
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        var dom = document.getElementById("container");
                        var myChart = echarts.init(dom);
                        var app = {};
                        option = null;
                        option = {
                            tooltip: {
                                trigger: 'axis'
                            },
                            xAxis: {
                                type: 'category',
                                data: data.days
                            },
                            yAxis: {
                                type: 'value'
                            },
                            series: [{
                                name:'普通用户订单（个）',
                                data: data.data,
                                type: 'line'
                            }]
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
//                window.location.href = "<?php echo url('shop/index'); ?>"
            });
//            销量
            $('#sales').click(function(){
                $(this).css("background-color","#00a0e9");
                $(this).css("color","white");
                $('#orders').css("background-color","white");
                $('#orders').css("color","black");
                $('#manager_orders').css("background-color","white");
                $('#manager_orders').css("color","black");
                $('#person_orders').css("background-color","white");
                $('#person_orders').css("color","black");
                $('#sales_money').css("background-color","white");
                $('#sales_money').css("color","black");
                $.ajax({
                    url: "<?php echo url('index/user_order'); ?>",
                    type: "post",
                    data: {
                        grade:4
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        var dom = document.getElementById("container");
                        var myChart = echarts.init(dom);
                        var app = {};
                        option = null;
                        option = {
                            tooltip: {
                                trigger: 'axis'
                            },
                            xAxis: {
                                type: 'category',
                                data: data.days
                            },
                            yAxis: {
                                type: 'value'
                            },
                            series: [{
                                name:'销量（件）',
                                data: data.data,
                                type: 'line'
                            }]
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
//                window.location.href = "<?php echo url('shop/index'); ?>"
            });
            //            销量总金额
            $('#sales_money').click(function(){
                $(this).css("background-color","#00a0e9");
                $(this).css("color","white");
                $('#orders').css("background-color","white");
                $('#orders').css("color","black");
                $('#manager_orders').css("background-color","white");
                $('#manager_orders').css("color","black");
                $('#person_orders').css("background-color","white");
                $('#person_orders').css("color","black");
                $('#sales').css("background-color","white");
                $('#sales').css("color","black");
                $.ajax({
                    url: "<?php echo url('index/user_order'); ?>",
                    type: "post",
                    data: {
                        grade:5
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        var dom = document.getElementById("container");
                        var myChart = echarts.init(dom);
                        var app = {};
                        option = null;
                        option = {
                            tooltip: {
                                trigger: 'axis'
                            },
                            xAxis: {
                                type: 'category',
                                data: data.days
                            },
                            yAxis: {
                                type: 'value'
                            },
                            series: [{
                                name:'销量金额（元）',
                                data: data.data,
                                type: 'line'
                            }]
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
//                window.location.href = "<?php echo url('shop/index'); ?>"
            });
            $.ajax({
                url: "<?php echo url('index/user_order'); ?>",
                type: "post",
                data: {
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    var dom = document.getElementById("container");
                    var myChart = echarts.init(dom);
                    var app = {};
                    option = null;
                    option = {
                        tooltip: {
                            trigger: 'axis'
                        },
                        xAxis: {
                            type: 'category',
                            data: data.days
                        },
                        yAxis: {
                            type: 'value'
                        },
                        series: [{
                            name:'总订单（个）',
                            data: data.data,
                            type: 'line'
                        }]
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
	</body>

	<!-- Mirrored from www.zi-han.net/theme/hplus/graph_metrics.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:09 GMT -->

</html>