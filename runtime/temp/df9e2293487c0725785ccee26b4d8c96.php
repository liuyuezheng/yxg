<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"F:\ayxg\public/../application/index\view\refunds\index.html";i:1552890039;}*/ ?>
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
                    售后管理&nbsp;&nbsp;<img style="width: 20px" onclick="history.go(0)" src="/static/hplus/img/123.jpg"></div>
                </div>
                <div class="ibox-content">
                    <div class="input-group" style=" width: 100%;">
                        <select  style="width: 14%;margin-left: 16px"  id="order_type" name="order_type">
                            <?php if($order_type == 3): ?>

                            <option value="3" selected="selected">未发货退款订单</option>
                            <option value="" >全部</option>
                            <option value="1" >已发货仅退款订单</option>
                            <option value="2" >已发货退货退款订单</option>
                            <?php elseif($order_type == 2): ?>
                            <option value="2" selected="selected" >已发货退货退款订单</option>
                            <option value="" >全部</option>
                            <option value="3" >未发货退款订单</option>
                            <option value="1" >已发货仅退款订单</option>

                            <?php elseif($order_type == 1): ?>
                            <option value="1" selected="selected" >已发货仅退款订单</option>
                            <option value="" >全部</option>
                            <option value="3" >未发货退款订单</option>
                            <option value="2" >已发货退货退款订单</option>
                            <?php else: ?>
                            <option value="" selected="selected" >全部</option>
                            <option value="3" >未发货退款订单</option>
                            <option value="1" >已发货仅退款订单</option>
                            <option value="2" >已发货退货退款订单</option>
                            <?php endif; ?>

                        </select>
                        <select  style="width: 9%;margin-left: 16px"  id="order_status" name="order_status" >
                            <?php if($order_status == 3): ?>
                            <option value="3" selected="selected" >退款中</option>
                            <option value="" >全部</option>
                            <option value="2" >已退款</option>
                            <option value="1" >拒绝退款</option>
                            <?php elseif($order_status == 2): ?>
                            <option value="2" selected="selected" >已退款</option>
                            <option value="" >全部</option>
                            <option value="3" >退款中</option>

                            <option value="1" >拒绝退款</option>
                            <?php elseif($order_status == 1): ?>
                            <option value="1" selected="selected" >拒绝退款</option>
                            <option value="" >全部</option>
                            <option value="3" >退款中</option>
                            <option value="2" >已退款</option>
                            <?php else: ?>
                            <option value="" selected="selected" >全部</option>
                            <option value="3" >退款中</option>
                            <option value="2" >已退款</option>
                            <option value="1" >拒绝退款</option>
                            <?php endif; ?>
                        </select>
                        <select  style="width: 10%;margin-left: 16px"  id="time_type" name="time_type">
                            <?php if($time_type == 3): ?>
                            <option value="3" selected="selected" >订单申请时间</option>
                            <option value="" >全部</option>
                            <option value="1" >订单下单时间</option>
                            <?php elseif($time_type == 1): ?>
                            <option value="1" selected="selected" >订单下单时间</option>
                            <option value="" >全部</option>
                            <option value="3" >订单申请时间</option>
                            <?php else: ?>
                            <option value="" selected="selected" >全部</option>
                            <option value="3" >订单申请时间</option>
                            <option value="1" >订单下单时间</option>
                            <?php endif; ?>

                            <!--<option value="2" >已发货退货退款订单</option>-->
                        </select>
                        <div class="layui-input-inline" style="margin-left:16px;">
                            <?php if(empty($times) || (($times instanceof \think\Collection || $times instanceof \think\Paginator ) && $times->isEmpty())): ?>
                            <input type="text" class="layui-input" style="height: 25px;width: 164%;" id="test5" placeholder="选择时间" value="">
                            <?php else: ?>
                            <input type="text" class="layui-input" style="height: 25px;width: 164%;" id="test5" placeholder="选择时间" value="<?php echo $times; ?>">
                            <?php endif; ?>
                          <!--  <input type="text" class="layui-input" style="width: 168%;height: 23px" id="test5" placeholder="选择时间">-->
                        </div>
                        <?php if(empty($nameorder) || (($nameorder instanceof \think\Collection || $nameorder instanceof \think\Paginator ) && $nameorder->isEmpty())): ?>
                        <input type="text" style="width: 30%;margin-left: 139px" id="nameorder"  placeholder="商品名称/退货单号/订单号/收件人姓名/收件人手机号/会员ID">
                        <?php else: ?>
                        <input type="text" style="width: 30%;margin-left: 139px" id="nameorder" value="<?php echo $nameorder; ?>"  placeholder="商品名称/退货单号/订单号/收件人姓名/手机号/会员ID">
                        <?php endif; ?>
       <!--                 <input type="text" style="width: 25%;margin-left: 139px" id="nameorder" value="<?php echo $nameorder; ?>"  placeholder="商品名称/退货单号">-->

                            <button type="button" onclick="search()" style=" margin-left: 14px; " class="btn btn-sm btn-primary">
                                搜索
                            </button>

                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr style="text-align: center;">
                            <th style="text-align: center;"><input type="checkbox"  id = "allAndNotAll"/></th>
                            <th style="text-align: center;">商品图片</th>
                            <th style="text-align: center;">商品信息</th>
                            <th style="text-align: center;">订单退货单编号</th>
                            <th style="text-align: center;">实际支付金额</th>
                            <th style="text-align: center;">退款状态</th>
                            <th style="text-align: center;">退款类型</th>
                            <th style="text-align: center;">退货人信息</th>
                            <th style="text-align: center;">信息</th>
                            <th style="text-align: center;">操作</th>
                        </tr>
                        </thead>
                        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
                        <tbody>
                        <tr class="gradeX">
                            <td> <?php if(($v['refund_status'] == 1) OR ($v['refund_status'] == 2) OR ($v['refund_status'] == 4)): ?>
                                <input type="checkbox" name = "item" id = "<?php echo $v['refund_id']; ?>" />
                                <?php elseif(($v['refund_status'] == 0) AND ($v['type'] == 2)): if(empty($v['return_num']) || (($v['return_num'] instanceof \think\Collection || $v['return_num'] instanceof \think\Paginator ) && $v['return_num']->isEmpty())): ?>
                                    <input type="checkbox" name = "items"    id = "<?php echo $v['refund_id']; ?>" />

                                    <?php else: ?>
                                    <input type="checkbox" name = "item"  id = "<?php echo $v['refund_id']; ?>" />
                                    <?php endif; elseif(($v['refund_status'] == 3)): ?>
                                <input type="checkbox" name = "item"  id = "<?php echo $v['refund_id']; ?>" />
                                <?php else: ?>
                                <input type="checkbox" name = "items"    id = "<?php echo $v['refund_id']; ?>" />
                                <?php endif; ?>


                            </td>
                            <td><img src="<?php echo $v['goods_image']; ?>" width="80px"></td>
                            <td><ul>
                                <li><?php echo $v['goods_name']; ?></li>
                                <li>规格:<?php if(is_array($v['goods_specification']) || $v['goods_specification'] instanceof \think\Collection || $v['goods_specification'] instanceof \think\Paginator): if( count($v['goods_specification'])==0 ) : echo "" ;else: foreach($v['goods_specification'] as $key=>$vs): ?>
                                    <?php echo $vs; endforeach; endif; else: echo "" ;endif; ?></li>
                                <li>数量：<?php echo $v['goods_count']; ?></li>
                                <li>单价：￥<?php echo $v['goods_price']; ?></li>
                            </ul></td>
                            <td><ul>
                                <li>退货单编号:<?php echo $v['refund_num']; ?></li>
                                <li>订单编号:<?php echo $v['orders_num']; ?></li>
                            </ul></td>
                            <td>￥<?php echo $v['real_pay']; ?></td>
                            <td><?php if($v['refund_status'] == '0'): ?>退款中<?php endif; if($v['refund_status'] == '1'): ?>拒绝退款<?php endif; if($v['refund_status'] == '2'): ?>退款成功<?php endif; if($v['refund_status'] == '3'): ?>退款中<?php endif; if($v['refund_status'] == '4'): ?>拒绝退货<?php endif; ?>
                            </td>
                            <td><?php if($v['type'] == '0'): ?>未发货退款订单<?php endif; if($v['type'] == '1'): ?>已发货仅退款订单<?php endif; if($v['type'] == '2'): ?>退货退款订单<?php endif; ?></td>
                            <td><ul>
                                <li><?php echo $v['telephone']; ?></li>
                                <li><?php echo $v['address']; ?></li>
                            </ul></td>
                            <td>
                                <a href="<?php echo url('refunds/detail'); ?>?refund_id=<?php echo $v['refund_id']; ?>" target="_blank">详情</a>
                            </td>
                            <td class="center">
                                <!--<a class="btn btn-primary btn-rounded" id="status" style=" border-radius: 4px"  onclick="update_slidestatus(this)" data-id="" data-status="" data-nums="">-->

                                <!--</a>-->
                                <?php if(($v['refund_status'] == 0) AND ($v['type'] < 2)): ?>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="update_slidestatus(this)" data-status="2" data-id="<?php echo $v['refund_id']; ?>">同意退款</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_sliderefuse(this)" data-status="1" data-id="<?php echo $v['refund_id']; ?>">拒绝退款</a>
                                <?php elseif(($v['refund_status'] == 0) AND ($v['type'] == 2)): if(empty($v['return_num']) || (($v['return_num'] instanceof \think\Collection || $v['return_num'] instanceof \think\Paginator ) && $v['return_num']->isEmpty())): ?>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="update_slidestatus(this)" data-status="3" data-id="<?php echo $v['refund_id']; ?>">同意退货</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_sliderefuse(this)" data-status="4" data-id="<?php echo $v['refund_id']; ?>">拒绝退货</a>

                                <?php else: ?>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="check_order(this)" data-id="<?php echo $v['refund_id']; ?>">核对订单</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_sliderefuse(this)" data-status="1" data-id="<?php echo $v['refund_id']; ?>">拒绝退款</a>
                                <?php endif; elseif(($v['refund_status'] == 3)): ?>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="check_order(this)" data-id="<?php echo $v['refund_id']; ?>">核对订单</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_sliderefuse(this)" data-status="1" data-id="<?php echo $v['refund_id']; ?>">拒绝退款</a>
                               <!-- <?php elseif(($v['refund_status'] == 0) AND ($v['type'] == 2) AND ($v['return_num'] != '')): ?>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="check_order(this)" data-id="<?php echo $v['refund_id']; ?>">核对订单</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_sliderefuse(this)" data-status="1" data-id="<?php echo $v['refund_id']; ?>">拒绝退款</a>-->
                                <?php elseif(($v['refund_status'] == 1) OR ($v['refund_status'] == 4)): ?>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"    >已拒绝</a>
                                <?php else: ?>  <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"    >已完成</a>
                                <?php endif; ?>
                          <!---->
                                <!--<a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="update_slidestatus(this)" data-id="<?php echo $v['refund_id']; ?>">同意退货</a>-->
                                <!--<a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidedel(this)" data-id="">拒绝退货</a>-->
                            </td>
                        </tr>
                        </tbody>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </table>
                    <?php echo $page; ?>
                    <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId"  href="form_basic.html#modal-form">批量同意</a>
                    <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId2"  href="form_basic.html#modal-form">批量拒绝</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
   //核对订单
    function check_order(check_order){
        var id = $(check_order).attr('data-id');
        layer.ready(function(){
            layer.open({
                type: 2,
                title: '核对订单',
                maxmin: true,
                area: ['50%', '40%'],
                content: '<?php echo url('checkorder'); ?>?refunds_id='+id,
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('index'); ?>';
                }
            });
        });
    }
    //订单拒绝
   function update_sliderefuse(update_sliderefuse) {
       var id = $(update_sliderefuse).attr('data-id');
       var status = $(update_sliderefuse).attr('data-status');
//       alert(status)
       layer.ready(function(){
           layer.open({
               type: 2,
               title: '拒绝原因',
               maxmin: true,
               area: ['50%', '40%'],
               content: '<?php echo url('refuse'); ?>?id='+id+'&status='+status,
               cancel: function(){ //刷新网页
                   //重新加载表格数据
                   self.location='<?php echo url('index'); ?>';
               }
           });
       });
   }
    //关键字搜索
    function search(){
        var order_type = $("#order_type option:selected").val();
        var order_status = $("#order_status option:selected").val();
        var time_type = $("#time_type option:selected").val();
        var time = $("#test5").val();
        var nameorder = $("#nameorder").val();
        if(time_type>0 && time==""){
            layer.msg('请选择时间',{icon: 2, shift: 6});
            return;
        }else{
            var reg = RegExp(/~/);
            console.log(reg.test(time));
            if(time==''){
                window.location.href = "<?php echo url('refunds/index'); ?>?order_type="+order_type+"&order_status="+order_status+"&time="+time+"&nameorder="+nameorder+"&time_type="+time_type;
            }else{
                if(reg.test(time)){
                    window.location.href = "<?php echo url('refunds/index'); ?>?order_type="+order_type+"&order_status="+order_status+"&time="+time+"&nameorder="+nameorder+"&time_type="+time_type;
                }else{
                    layer.msg('时间格式有误',{icon: 2, shift: 6});
                }

            }
//            if(reg.test(time)){
//                window.location.href = "<?php echo url('refunds/index'); ?>?order_type="+order_type+"&order_status="+order_status+"&time="+time+"&nameorder="+nameorder+"&time_type="+time_type;
//            }else{
//                layer.msg('时间格式有误',{icon: 2, shift: 6});
//            }

        }
    }

    //同意退款 退货
    function update_slidestatus(update_slidestatus){
        var id = $(update_slidestatus).attr('data-id');
        var status = $(update_slidestatus).attr('data-status');
        var str = $(update_slidestatus).text();
//        alert(str);
        layer.msg("是否"+str, {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: '<?php echo url("refunds/upstatus"); ?>',
                    data: {
                        id:id,status:status
                    },
                    dataType: "json",
                    type: "post",
                    success: function(data) {
                        console.log(data);
                        if(data.code==1){
                            layer.msg('操作成功',{icon: 1, shift: 6},function () {
                                history.go(0)
                            });

                        }else{
                            layer.msg(data.msg,{icon: 2, shift: 6});
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
                        if (data == 1) {
                            layer.msg('操作成功', {icon: 1, shift: 6});
                            history.go(0)
                        } else {
                            layer.msg('操作失败', {icon: 2, shift: 6});
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
            layer.msg('请选择订单', {icon: 2, shift: 6});
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
                        ids:ids2,type:2
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (data.code === 1) {
                            layer.msg(data.msg, {icon: 1, shift: 6});
                            history.go(0)
//                            window.location.href = "<?php echo url('refunds/index'); ?>"
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


