<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"F:\ayxg\public/../application/index\view\refunds\checkorder.html";i:1550984940;}*/ ?>
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
<div style="margin-top: 83px ;margin-left: 82px;">
    物流公司：<?php if(empty($info['logistics_name']) || (($info['logistics_name'] instanceof \think\Collection || $info['logistics_name'] instanceof \think\Paginator ) && $info['logistics_name']->isEmpty())): ?>
       无
    <?php else: ?>
    <?php echo $info['logistics_name']; endif; ?>
</div>
<div style="    margin: 10px 82px;">

   寄送订单编号：<?php if(empty($info['return_num']) || (($info['return_num'] instanceof \think\Collection || $info['return_num'] instanceof \think\Paginator ) && $info['return_num']->isEmpty())): ?>
    无
    <?php else: ?>
    <?php echo $info['return_num']; endif; ?>
</div>
<a class="btn btn-primary btn-rounded" style=" border-radius: 4px;margin-left: 96px;"   onclick="update_slidestatus(this)" data-status="2" data-id="<?php echo $info['id']; ?>">同意退款</a>
<a class="btn btn-primary btn-rounded" style=" border-radius: 4px;margin-left: 69px;"   onclick="quxiao(this)">取消</a>
</body>
<script>
    //同意退款 退货
    function update_slidestatus(update_slidestatus){
        var id = $(update_slidestatus).attr('data-id');
//        var status = $(update_slidestatus).attr('data-status');
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
                        id:id,status:2
                    },
                    dataType: "json",
                    type: "post",
                    success: function(data) {
                        console.log(data);
                        if(data==1){
                            layer.msg('操作成功',{icon: 1, shift: 6},function () {
                                window.parent.location.reload();
                            });

                        }else{
                            layer.msg('操作失败');
                        }
                    }
                });
            }
        });

    }
    //取消添加
    function quxiao(){
        window.parent.location.reload();
    }
</script>
</html>