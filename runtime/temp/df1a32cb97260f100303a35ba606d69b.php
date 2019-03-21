<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"F:\ayxg\public/../application/index\view\kitings\wherereject.html";i:1550561889;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>拒绝原因</title>
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
<div style="margin: 25px 82px;">
   <textarea style="    width: 80%;
    height: 75%;" placeholder="请输入驳回原因" id="con"></textarea>
</div>
<a class="btn btn-primary btn-rounded" style=" border-radius: 4px;margin-left: 96px;"   onclick="update_slidestatus(this)" data-id="<?php echo $id; ?>">确定</a>
<a class="btn btn-primary btn-rounded" style=" border-radius: 4px;margin-left: 69px;"   onclick="quxiao(this)" data-status="2">取消</a>
</body>
<script>
    //    //同意退款 退货
    function update_slidestatus(update_slidestatus){
        var id = $(update_slidestatus).attr('data-id');
        var con=$('#con').val();
if(con==""){
    layer.msg("请输入驳回原因");
}else{
    $.ajax({
        url: '<?php echo url("kitings/uptstatus"); ?>',
        data: {
            id:id,content:con
        },
        dataType: "json",
        type: "post",
        success: function(data) {
            console.log(data);
            if(data.code==1){
                layer.msg(data.msg,{icon: 2, shift: 6},function () {
                    window.parent.location.reload();
                });

            }else{
                layer.msg('操作失败');
            }
        }
    });
}

////            }
////        });
//
    }
    //    //取消添加
        function quxiao(){
            window.parent.location.reload();
        }
</script>
</html>