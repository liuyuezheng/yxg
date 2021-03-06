<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"F:\ayxg\public/../application/index\view\coupons\index.html";i:1552382721;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>优惠券</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/static/hplus/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="/static/hplus/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/static/hplus/css/animate.min.css" rel="stylesheet">
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
                    <div style="float: left">优惠券列表&nbsp;&nbsp;<img style="width: 20px" onclick="history.go(0)" src="/static/hplus/img/123.jpg"></div>
                    <div style="float: left;margin-left: 59%;">
                        <a class="btntop" onclick="update_slideadd(this)" style="background-color: red;color: #FFF;border-radius: 5% ;font-size: 15px;padding: 6px 12px;">新增优惠券</a>

                    </div>
                </div>

                <!-- <div class="ibox-content">
                   <a data-toggle="modal" class="btn btn-primary" onclick="add_goodsinfo()"  href="form_basic.html#modal-form">添加商品信息</a>
                       <div class="input-group">
                        <input type="text" class="form-control input-sm keywords" name="" placeholder="商品名称,分类">
                        <div class="input-group-btn">
                            <button type="button" onclick="search()" class="btn btn-sm btn-primary">
                                搜索
                            </button>
                        </div>
                    </div> -->
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                    <tr>
                        <th>优惠券名称</th>
                        <th>金额</th>
                        <th>满减条件</th>
                        <th>优惠券类型</th>
                        <th>发放总量</th>
                        <th>剩余总量</th>
                        <th>领取总量</th>
                        <th>有效时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
                    <tbody>
                    <tr class="gradeX">
                        <td><?php echo $v['name']; ?></td>
                        <td>￥<?php echo $v['limit_money']; ?></td>
                        <td>￥<?php echo $v['limit_condition']; ?></td>
                        <td>
                            <?php if($v['type'] == 0): ?>
                            新手优惠券
                            <?php elseif($v['type'] == 1): ?>
                            赠送优惠券
                            <?php elseif($v['type'] == 2): ?>
                            商品赠送优惠券
                            <?php else: ?>
                             无条件使用优惠券
                            <?php endif; ?>

                        </td>
                        <td><?php echo $v['nums']; ?></td>
                        <td><?php echo $v['num']; ?></td>
                        <td><?php echo $v['get_num']; ?></td>
                        <td><?php echo $v['end_time']; ?></td>
                        <td><?php echo $v['is_putaway']==0?'未发放' : '发放中'; ?></td>
                        <td class="center">

                            <a class="btn btn-primary btn-rounded" id="status" style=" border-radius: 4px"  onclick="update_slidestatus(this)" data-id="<?php echo $v['id']; ?>" data-status="<?php echo $v['is_putaway']; ?>"><?php echo $v['is_putaway']==0?'发放' : '停止'; ?></a>
                            <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slideshow(this)" data-id="<?php echo $v['id']; ?>">修改</a>
                            <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidedel(this)" data-id="<?php echo $v['id']; ?>">删除</a>
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
<script src="/static/hplus/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/hplus/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/hplus/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/static/hplus/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/static/hplus/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/static/hplus/js/content.min.js?v=1.0.0"></script>
<script src="/static/hplus/js/plugins/layer/laydate/laydate.js"></script>
<script src="/static/hplus/layer/layer.js"></script>
<script>
function update_slideadd(update_slideadd) {

        layer.ready(function(){
            layer.open({
                type: 2,
                title: '添加',
                maxmin: true,
                area: ['60%', '80%'],
                content: '<?php echo url('add'); ?>',
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('index'); ?>';
                }
            });
        });

}
    //编辑首页
    function update_slidestatus(update_slidestatus){
        var id = $(update_slidestatus).attr('data-id');
        var status = $(update_slidestatus).attr('data-status');
        var staval=$(update_slidestatus).text();
//        alert(staval);
        layer.msg('是否' + staval + '显示？', {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: '<?php echo url("coupons/upstatus"); ?>',
                    data: {
                        id:id,status:status
                    },
                    dataType: "json",
                    type: "post",
                    success: function(data) {
//                        console.log(data);
                        if(data==1){
                            layer.msg('操作成功');
                            window.location.href = "<?php echo url('coupons/index'); ?>"
                        }else{
                            layer.msg('操作失败');
                        }
                    }
                });
            }
        });

//        alert(id);
//        window.location.href = "<?php echo url('slideshow/show_update'); ?>?id="+id
    }
    //修改优惠券
    function update_slideshow(update_slideshow){
        var id = $(update_slideshow).attr('data-id');
        layer.ready(function(){
            layer.open({
                type: 2,
                title: '修改',
                maxmin: true,
                area: ['80%', '70%'],
                content: '<?php echo url('edit'); ?>?did='+id,
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('index'); ?>';
                }
            });
        });
    }

    //删除
    function update_slidedel(update_slidedel){
        var id = $(update_slidedel).attr('data-id');

//        alert(staval);
        layer.msg('是否删除优惠券？', {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: '<?php echo url("coupons/del"); ?>',
                    data: {
                        id:id
                    },
                    dataType: "json",
                    type: "post",
                    success: function(data) {
//                        console.log(data);
                        if(data==1){
                            layer.msg('操作成功');
                            window.location.href = "<?php echo url('coupons/index'); ?>"
                        }else{
                            layer.msg('操作失败');
                        }

                    }
                });

            }
        });

//        alert(id);
//        window.location.href = "<?php echo url('slideshow/show_update'); ?>?id="+id
    }


</script>

</body>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


