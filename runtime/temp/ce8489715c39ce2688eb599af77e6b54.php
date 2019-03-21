<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"F:\ayxg\public/../application/index\view\special\hots.html";i:1552292444;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品信息列表</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/static/hplus/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="/static/hplus/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/static/hplus/css/animate.min.css" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">

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
    .active span{
        background-color: #1ab394 !important;
        color: white !important;
    }
</style>





                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <td><input type="checkbox"  id = "allAndNotAll"/></td>
                            <th>商品图片</th>
                            <th>商品名称</th>
                            <th>分类</th>
                            <th>原价</th>
                            <th>现价</th>
                            <th>总库存</th>
                            <th>销量</th>
                            <th>状态</th>
                            <th >操作</th>
                        </tr>
                        </thead>
                        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
                        <tbody>
                        <tr class="gradeX">
                            <td><input type="checkbox" name = "items" id = "<?php echo $v['id']; ?>" /></td>
                            <td><img src="<?php echo $v['logo_image']; ?>" width="80px"></td>
                            <td><?php echo $v['name']; ?></td>
                            <td><?php echo $v['cate_name']; ?></td>
                            <td>￥<?php echo $v['original_price']; ?></td>
                            <td>￥<?php echo $v['goods_price']; ?></td>
                            <td><?php echo $v['nums']; ?></td>
                            <td><?php echo $v['sales']; ?></td>
                            <td><?php if($v['is_putaway'] == '0'): ?>出售中<?php endif; if($v['is_putaway'] == '1'): ?>已下架<?php endif; ?>
                                <!--   <?php if($v['nums'] == '0'): ?>已售罄<?php endif; ?>-->
                            </td>
                            <td class="center">

                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidedel(this)" data-id="<?php echo $v['id']; ?>">取消</a>
                            </td>
                        </tr>
                        </tbody>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
<?php echo $page; ?>
<a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId"  href="form_basic.html#modal-form">批量取消</a>


<script src="/static/hplus/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/hplus/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/hplus/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/static/hplus/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/static/hplus/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/static/hplus/js/content.min.js?v=1.0.0"></script>
<script src="/static/hplus/js/plugins/layer/laydate/laydate.js"></script>
<script src="/static/hplus/layer/layer.js"></script>
<script>

    //取消
    function update_slidedel(update_slidedel){
        var id = $(update_slidedel).attr('data-id');
        layer.msg("是否取消", {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: '<?php echo url("special/cancel"); ?>',
                    data: {
                        id:id
                    },
                    dataType: "json",
                    type: "post",
                    success: function(data) {
                        console.log(data);
                        if(data==1){
                            layer.msg('操作成功',{icon: 1, shift: 6},function () {
                                window.location.href = "<?php echo url('special/hots'); ?>";
                            });

                        }else{
                            layer.msg('操作失败');
                        }
                    },
                    error: function (e) {
                        layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
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

    //批量取消
    var ids=[];
    $('#getAllSelectedId').click(function(){
        $("input[name='items']:checked").each(function(){
            ids.push($(this).attr("id"));
        });
        console.log("id长度"+ids.length);
        if(ids.length == 0){
            layer.msg('请选择商品', {icon: 2, shift: 6});
            return;
        }
//        main
        $.ajax({
            url: "<?php echo url('special/allCancel'); ?>",
            type: "post",
            data: {
                id:ids
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.code === 1) {
                    layer.msg(data.msg, {icon: 1, shift: 6});
                    window.location.href = "<?php echo url('special/hots'); ?>"
                } else {
                    layer.msg(data.msg, {icon: 2, shift: 6});
                }
            },
            error: function (e) {
                layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
            }
        });
        return false;

    });

</script>

</body>

<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


