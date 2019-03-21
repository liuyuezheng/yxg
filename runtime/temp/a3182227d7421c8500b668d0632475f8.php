<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"F:\ayxg\public/../application/index\view\users\superior.html";i:1552571421;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>董事/总代</title>
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
                    董事/总代&nbsp;&nbsp;<img style="width: 20px" onclick="history.go(0)" src="/static/hplus/img/123.jpg">
                </div>
                <div class="ibox-content">
                    <div class="input-group" style=" width: 100%;">
                        <select  style="width: 20%;margin-left: 16px"  id="grade_type" name="grade_type">
                            <?php if($grades == 1): ?>
                            <option value="1" selected="selected" >总代</option>
                            <option value="" >董事/总代</option>
                            <option value="2" >董事</option>
                            <?php elseif($grades == 2): ?>
                            <option value="2" selected="selected" >董事</option>
                            <option value="" >董事/总代</option>
                            <option value="1" >总代</option>
                            <?php else: ?>
                            <option value="" selected="selected" >董事/总代</option>
                            <option value="2" >董事</option>
                            <option value="1" >总代</option>
                            <?php endif; ?>


                        </select>
                        <select  style="width: 20%;margin-left: 16px"  id="order_type" name="order_type">
                            <?php if($types == 3): ?>
                            <option value="3" selected="selected">用户编号</option>
                            <option value=""  >全部</option>
                            <option value="2" >昵称</option>
                            <option value="1" >手机号</option>
                            <?php elseif($types == 2): ?>
                            <option value="2" selected="selected">昵称</option>
                            <option value=""  >全部</option>
                            <option value="3" >用户编号</option>
                            <option value="1" >手机号</option>
                            <?php elseif($types == 1): ?>
                            <option value="1" selected="selected">手机号</option>
                            <option value=""  >全部</option>
                            <option value="3" >用户编号</option>
                            <option value="2" >昵称</option>
                            <?php else: ?>
                            <option value=""  selected="selected" >全部</option>
                            <option value="1">手机号</option>
                            <option value="3" >用户编号</option>
                            <option value="2" >昵称</option>
                            <?php endif; ?>
                        </select>
                        <?php if(empty($names) || (($names instanceof \think\Collection || $names instanceof \think\Paginator ) && $names->isEmpty())): ?>
                        <input type="text" style="width: 35%;margin-left: 16px" id="nameorder"  placeholder="根据筛选条件输入查询信息">
                        <?php else: ?>
                        <input type="text" value="<?php echo $names; ?>" style="width: 35%;margin-left: 16px" id="nameorder"  placeholder="根据筛选条件输入查询信息">
                        <?php endif; ?>
                        <button type="button" onclick="search()" style=" margin-left: 14px; " class="btn btn-sm btn-primary">
                            搜索
                        </button>

                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr style="text-align: center;">
                            <th style="text-align: center;">用户头像</th>
                            <th style="text-align: center;">用户信息</th>
                            <th style="text-align: center;">消费金额</th>
                            <th style="text-align: center;">积分</th>
                            <th style="text-align: center;">直属上级昵称</th>
                            <th style="text-align: center;">查询下级用户</th>
                            <th style="text-align: center;">账户余额</th>
                            <th style="text-align: center;">操作</th>
                        </tr>
                        </thead>
                        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
                        <tbody>
                        <tr class="gradeX">
                            <td><img src="<?php echo $v['head_image']; ?>" width="50px"></td>
                            <td><ul>
                                <li>用户昵称:<?php echo $v['nickname']; ?></li>
                                <li>手机号:<?php echo $v['telephone']; ?></li>
                                <li>用户编号：<?php echo $v['user_num']; ?></li>
                            </ul></td>
                            <td>￥<?php echo $v['consumes']; ?></td>
                            <td><?php echo $v['integral']; ?></td>
                            <td><?php echo $v['up_name']; ?></td>
                            <td ><a href="<?php echo url('excel'); ?>?id=<?php echo $v['id']; ?>" style="color: green">导出</a></td>
                            <td>￥<?php echo $v['balance']; ?></td>
                            <td class="center">
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="show_detail(this)" data-id="<?php echo $v['id']; ?>">查看</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="show_edit(this)" data-id="<?php echo $v['id']; ?>">编辑</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="show_editup(this)" data-id="<?php echo $v['id']; ?>">修改上级</a>
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
    //查看用户信息
    function show_detail(show_detail) {
        var id = $(show_detail).attr('data-id');
        window.open( "<?php echo url('users/superiordetail'); ?>?id="+id);
    }
    //修改用户信息
    function show_edit(show_edit){
        var id = $(show_edit).attr('data-id');
        layer.ready(function(){
            layer.open({
                type: 2,
                title: '修改上级',
                maxmin: true,
                area: ['80%', '85%'],
                content: '<?php echo url('edits'); ?>?id='+id,
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('superior'); ?>';
                }
            });
        });
    }
    //修改上级
    function show_editup(show_editup) {
        var id = $(show_editup).attr('data-id');
        layer.ready(function(){
            layer.open({
                type: 2,
                title: '修改用户信息',
                maxmin: true,
                area: ['80%', '85%'],
                content: '<?php echo url('editup'); ?>?id='+id,
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('superior'); ?>';
                }
            });
        });
    }
    //关键字搜索grade_type
    function search(){
        var grade_type = $("#grade_type option:selected").val();
        var order_type = $("#order_type option:selected").val();
        var nameorder = $("#nameorder").val();
        if(nameorder=="" && order_type>0){
            layer.msg("请输入查询信息", {icon: 2, shift: 6});
        }else{
            window.location.href = "<?php echo url('users/superior'); ?>?order_type="+order_type+"&nameorder="+nameorder+"&grade_type="+grade_type;
        }
    }
    //同意退款 退货
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        laydate.render({
            elem: '#test5'
            ,type: 'datetime'
        });
    });
</script>

</body>

<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


