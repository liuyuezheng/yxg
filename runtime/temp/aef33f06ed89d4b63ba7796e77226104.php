<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"F:\ayxg\public/../application/index\view\monitor\index.html";i:1552466325;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>资金监控日志</title>
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
                    资金监控日志&nbsp;&nbsp;<img style="width: 20px" onclick="history.go(0)" src="/static/hplus/img/123.jpg"></div>
                </div>
                <div class="ibox-content">
                    <!-- <a data-toggle="modal" class="btn btn-primary" onclick="add_goodsinfo()"  href="form_basic.html#modal-form">添加商品信息</a>
                     <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId"  href="form_basic.html#modal-form">批量昨日爆款</a>
                     <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId2"  href="form_basic.html#modal-form">批量今日主推</a>
 -->
                    <div class="input-group" style=" width: 100%;">
                        <select  style="width: 19%;margin-left: 16px"  id="pay_type" name="order_type">
                            <?php if($types == 2): ?>
                            <option value="2" selected="selected" >支出</option>
                            <option value="" >全部</option>
                            <option value="1" >收入</option>
                            <?php elseif($types == 1): ?>
                            <option value="1" selected="selected" >收入</option>
                            <option value="" >全部</option>
                            <option value="2" >支出</option>
                            <?php else: ?>
                            <option value="" selected="selected">全部</option>
                            <option value="2" >支出</option>
                            <option value="1" >收入</option>
                            <?php endif; ?>
                        </select>

                        <div class="layui-input-inline" style="margin-left:16px;">
                            <?php if(empty($times) || (($times instanceof \think\Collection || $times instanceof \think\Paginator ) && $times->isEmpty())): ?>
                            <input type="text" class="layui-input" style="height: 23px;width: 164%;" id="test5" placeholder="时间筛选">
                            <?php else: ?>
                            <input type="text" class="layui-input" style="height: 23px;width: 164%;" id="test5" placeholder="时间筛选" value="<?php echo $times; ?>">
                            <?php endif; ?>

                        </div>
                        <?php if(empty($nameorder) || (($nameorder instanceof \think\Collection || $nameorder instanceof \think\Paginator ) && $nameorder->isEmpty())): ?>
                        <input type="text" style="width: 21%;margin-left: 134px;" id="nameorder"  placeholder="手机号">
                        <?php else: ?>
                        <input type="text" style="width: 21%;margin-left: 134px;" id="nameorder"  placeholder="手机号" value="<?php echo $nameorder; ?>">
                        <?php endif; ?>
                        <!--<input type="text" style="width: 21%;margin-left: 134px;" id="nameorder"  placeholder="用户编号">-->
                        <button type="button" onclick="search()" style=" margin-left: 14px; " class="btn btn-sm btn-primary">
                            搜索
                        </button>
                        <a data-toggle="modal" class="btn btn-w-m btn-danger"  style="margin-left: 10px"  href="<?php echo url('excel'); ?>">导出</a>
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr style="text-align: center;">
                            <th style="text-align: center;">手机号</th>
                            <th style="text-align: center;">昵称</th>
                            <th style="text-align: center;">订单编号</th>
                            <th style="text-align: center;">金额</th>
                            <th style="text-align: center;">收支类型</th>
                            <th style="text-align: center;">收支来源</th>
                            <th style="text-align: center;">备注信息</th>
                            <th style="text-align: center;">创建时间</th>

                        </tr>
                        </thead>
                        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
                        <tbody>
                        <tr class="gradeX">
                            <td>
                                <?php if(empty($v['telephone']) || (($v['telephone'] instanceof \think\Collection || $v['telephone'] instanceof \think\Paginator ) && $v['telephone']->isEmpty())): ?>
                                  未绑定
                                <?php else: ?>
                                <?php echo $v['telephone']; endif; ?>
                            </td>
                            <td><?php echo $v['nickname']; ?></td>
                            <td><?php echo $v['order_num']; ?></td>
                            <td>￥<?php echo $v['money']; ?></td>
                            <td><?php if($v['type'] == '0'): ?>支出<?php endif; if($v['type'] == '1'): ?>收入<?php endif; ?>
                            </td>
                            <td><?php if($v['status'] == '0'): ?>余额<?php endif; if($v['status'] == '1'): ?>佣金<?php endif; ?></td>
                            <td>   <?php if(empty($v['title']) || (($v['title'] instanceof \think\Collection || $v['title'] instanceof \think\Paginator ) && $v['title']->isEmpty())): ?>
                                无
                                <?php else: ?>
                                <?php echo $v['title']; endif; ?></td>

                            <td>
                                <?php echo date('Y-m-d H:i:s',$v['time']); ?>
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

    //关键字搜索
    function search(){
        var pay_type = $("#pay_type option:selected").val();
//        var order_status = $("#order_status option:selected").val();
//        var time_type = $("#time_type option:selected").val();
        var time = $("#test5").val();
        var nameorder = $("#nameorder").val();
        var reg = RegExp(/~/);
        console.log(reg.test(time));
        if(time==''){
            window.location.href = "<?php echo url('monitor/index'); ?>?type="+pay_type+"&time="+time+"&nameorder="+nameorder;
        }else{
            if(reg.test(time)){
                window.location.href = "<?php echo url('monitor/index'); ?>?type="+pay_type+"&time="+time+"&nameorder="+nameorder;
            }else{
                layer.msg('时间格式有误',{icon: 2, shift: 6});
            }

        }
//        if(reg.test(time)){
//            window.location.href = "<?php echo url('monitor/index'); ?>?type="+pay_type+"&time="+time+"&nameorder="+nameorder;
//        }else{
//            layer.msg('时间格式有误',{icon: 2, shift: 6});
//        }

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
            ,range: '~'
            ,format: 'yyyy-MM-dd'
        });
    });
</script>

</body>

<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


