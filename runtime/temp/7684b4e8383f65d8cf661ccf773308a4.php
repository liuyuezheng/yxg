<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"F:\ayxg\public/../application/index\view\order\showdeliver.html";i:1550986396;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>核对订单</title>
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
<body>
<div style="margin: 20px 82px;">
    物流公司：<?php echo $data['logistics']; ?>
 <!--   <?php if($data['logistics'] == '1'): ?>中通物流<?php endif; if($data['logistics'] == '2'): ?>圆通物流<?php endif; if($data['logistics'] == '3'): ?>韵达物流<?php endif; if($data['logistics'] == '4'): ?>顺丰物流<?php endif; if($data['logistics'] == '5'): ?>京东物流<?php endif; if($data['logistics'] == '6'): ?>百世物流<?php endif; if($data['logistics'] == '7'): ?>申通物流<?php endif; ?>-->
</div>
<div style="margin: 10px 82px;">

    <!--   <select  style="width: 19%;margin-left: 16px"  id="logistics" name="logistics">
           <option value="1" >中通物流</option>logistics_num,logistics
           <option value="2" >圆通物流</option>1中通物流 2圆通物流
       </select>-->
    物流单号：<?php echo $data['logistics_num']; ?>
</div>
<a class="btn btn-primary btn-rounded" style=" border-radius: 4px;margin-left: 96px;"   onclick="update_slidestatus(this)">确认</a>
<a class="btn btn-primary btn-rounded" style=" border-radius: 4px;margin-left: 69px;"   onclick="quxiao(this)" data-status="2">取消</a>
</body>
<script>
    //同意退款 退货
    function update_slidestatus(){
        window.parent.location.reload();
    }
    //取消添加
    function quxiao(){
        window.parent.location.reload();
    }
</script>
</html>