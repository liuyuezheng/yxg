<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"F:\ayxg\public/../application/index\view\describe\index.html";i:1552011054;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>首页轮播图</title>
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
                    <div style="float: left">首页轮播图列表&nbsp;&nbsp;<img style="width: 20px" onclick="history.go(0)" src="/static/hplus/img/123.jpg"></div>
                    <div style="float: left;margin-left: 59%;">
                        <a class="btntop" onclick="update_slideadd(this)" style="background-color: red;color: #FFF;border-radius: 5% ;font-size: 15px;padding: 6px 12px;">新增轮播图</a>

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
                        <th>展示图</th>
                        <th>类型</th>
                        <th>描述</th>
                        <th>显示状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
                    <tbody>
                    <tr class="gradeX">
                        <td><img src="<?php echo $v['slideshow']; ?>" width="100px"></td>
                        <td><?php echo $v['type']==0?'链接' : '商品'; ?></td>
                        <td><?php echo $v['describe']; ?></td>
                        <td><?php echo $v['status']==0?'未显示' : '显示'; ?></td>

                        <td class="center">

                            <a class="btn btn-primary btn-rounded" id="status" style=" border-radius: 4px"  onclick="update_slidestatus(this)" data-id="<?php echo $v['id']; ?>" data-status="<?php echo $v['status']; ?>"><?php echo $v['status']==0?'开启' : '关闭'; ?></a>
                            <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slideshow(this)" data-id="<?php echo $v['id']; ?>">修改</a>
                            <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidedel(this)" data-id="<?php echo $v['id']; ?>">删除</a>
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
<script src="/static/hplus/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/hplus/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/hplus/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/static/hplus/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/static/hplus/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/static/hplus/js/content.min.js?v=1.0.0"></script>
<script src="/static/hplus/js/plugins/layer/laydate/laydate.js"></script>
<script src="/static/hplus/layer/layer.js"></script>
<script>

    //编辑首页轮播图
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
                    url: '<?php echo url("describe/upstatus"); ?>',
                    data: {
                        id:id,status:status
                    },
                    dataType: "json",
                    type: "post",
                    success: function(data) {
//                        console.log(data);
                        if(data==1){
                            layer.msg('操作成功');
                            window.location.href = "<?php echo url('describe/index'); ?>"
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
        layer.msg('是否删除轮播图？', {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: '<?php echo url("describe/del"); ?>',
                    data: {
                        id:id
                    },
                    dataType: "json",
                    type: "post",
                    success: function(data) {
//                        console.log(data);
                        if(data==1){
                            layer.msg('操作成功');
                            window.location.href = "<?php echo url('describe/index'); ?>"
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
    function update_slideadd(update_slidedel){
        layer.ready(function(){
            layer.open({
                type: 2,
                title: '添加',
                maxmin: true,
                area: ['80%', '70%'],
                content: '<?php echo url('add'); ?>',
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('index'); ?>';
                }
            });
        });
    }

</script>

</body>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


