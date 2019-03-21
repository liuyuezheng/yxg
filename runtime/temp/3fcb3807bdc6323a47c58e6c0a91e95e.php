<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"F:\ayxg\public/../application/index\view\category\index.html";i:1550482738;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>商品分类</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/static/hplus/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="/static/hplus/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/static/hplus/css/animate.min.css" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">
    <link rel="stylesheet" href="/static/hplus/layui/css/layui.css" media="all">
    <script src="/static/hplus/layui/layui.js"></script>


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
    .laytable-cell-1-0-0 {
        width: 80px;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="layui-fluid">

            <div style="margin-top: 20px;">
                <div class="layui-btn-group">
                    <button class="layui-btn " id="btn-expand"><i class="layui-icon layui-icon-down"></i>全部展开</button>
                    <!--<button class="layui-btn " id="btn-fold"><i class="layui-icon layui-icon-left"></i>全部折叠</button>-->
                    <button class="layui-btn " id="btn-refresh"><i class="layui-icon layui-icon-loading"></i>刷新表格</button>
                </div>
            </div>


            <!-- 操作列 -->
            <table id="table1" class="layui-table" lay-filter="table1"></table>
            <script type="text/html" id="toolbarDemo">
                <!--<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">修改</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>-->

                <div class="layui-btn-group">
                    <button class="layui-btn layui-btn-primary layui-btn-xs" lay-event="add"><i class="layui-icon layui-icon-add-1"></i> 增加</button>
                    <!--<button class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i> 编辑</button>-->
                    <!--<button class="layui-btn layui-btn-primary layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i> 删除</button>-->
                </div>
            </script>
            <script type="text/html" id="auth-state">
                <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">修改</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
            </script>
            <!-- 表格end -->
            <script>
                layui.config({
                    base: '/static/hplus/treetable-lay/module/'
                }).extend({
                    treetable: 'treetable-lay/treetable'
                }).use(['layer', 'table', 'treetable','form','jquery'], function () {
                    var $ = layui.jquery;
                    var table = layui.table;
                    var form = layui.form;
                    // var element = layui.element;
                    var layer = layui.layer;
                    var treetable = layui.treetable;

                    // 渲染表格
                    var renderTable = function () {
                        layer.load(2);
                        treetable.render({
                            treeColIndex: 1,
                            treeSpid: 0,
                            treeIdName: 'id',
                            treePidName: 'pid',
                            treeDefaultClose: true,
                            treeLinkage: false,
                            elem: '#table1',
                            //url: '/static/json/menus.json',
                            url: '<?php echo url("category/lists"); ?>',
                            toolbar:'#toolbarDemo',
                            page: false,
                            cols: [[
//                                {type: 'checkbox'},
                                {field: 'id', width:150, title: 'ID'},
                                {field: 'name', width: 500, align: 'left', title: '栏目名'},
                                {field: 'sort', width: 180, align: 'center', title: '排序'},
                                {templet: '#auth-state', width: 120, align: 'center', title: '操作'}
                            ]],
                            done: function () {
                                layer.closeAll('loading');
                            }
                        });
                    };

                    renderTable();

                    //全部展开
                    $(document).on("click","#btn-expand",function(){
                        if($(this).text() == '全部展开'){
                            $(this).html('<i class="layui-icon layui-icon-left"></i>全部折叠')
                            treetable.expandAll('#table1');
                        }else {
                            $(this).html('<i class="layui-icon layui-icon-down"></i>全部展开')
                            treetable.foldAll('#table1');
                        }
                    });

                    //全部折叠
                    $(document).on("click","#btn-fold",function(){
                        treetable.foldAll('#table1');
                    });

                    //刷新表格
                    $(document).on("click","#btn-refresh",function(){
                        renderTable();
                    });
                    //搜索
                    $(document).on("click","#btn-search",function(){
                        var keyword = $('#edt-search').val();
                        var searchCount = 0;
                        $('#table1').next('.treeTable').find('.layui-table-body tbody tr td').each(function () {
                            $(this).css('background-color', 'transparent');
                            var text = $(this).text();
                            if (keyword != '' && text.indexOf(keyword) >= 0) {
                                $(this).css('background-color', 'rgba(250,230,160,0.5)');
                                if (searchCount == 0) {
                                    treetable.expandAll('#table1');
                                    $('html,body').stop(true);
                                    $('html,body').animate({scrollTop: $(this).offset().top - 150}, 500);
                                }
                                searchCount++;
                            }
                        });
                        if (keyword == '') {
                            layer.msg("请输入搜索内容", {icon: 5});
                        } else if (searchCount == 0) {
                            layer.msg("没有匹配结果", {icon: 5});
                        }
                    });

                    //头工具栏事件
                    table.on('toolbar(table1)', function(obj){
                        var checkStatus = table.checkStatus(obj.config.id);

                        switch(obj.event){
                            case 'add':
                                layer.ready(function(){
                                    layer.open({
                                        type: 2,
                                        title: '增加',
                                        maxmin: true,
                                        area: ['80%', '70%'],
                                        content: '<?php echo url('add'); ?>',
                                        cancel: function(){ //刷新网页
                                            //重新加载表格数据
                                            self.location='<?php echo url('index'); ?>';
                                        }
                                    });
                                });
                                //layer.msg('增加' + obj.config.id);
                                break;
                            case 'edit':
                                var data = checkStatus.data;
                                var dataall = '';
                                //data = JSON.stringify(data);
                                //循环把所有要删除的ID整成12,13,545
                                for(var i=0;i<data.length;i++){
                                    dataall += data[i].id+",";
                                }
                                dataall=dataall.substring(0,dataall.length-1)

                                //         console.log(dataall)
                                //         layer.alert(dataall);
                                break;
                            case 'del':
                                var data = checkStatus.data;
                                var dataall = '';
                                //data = JSON.stringify(data);
                                //循环把所有要删除的ID整成12,13,545
                                for(var i=0;i<data.length;i++){
                                    dataall += data[i].id+",";
                                }
                                dataall=dataall.substring(0,dataall.length-1)

                                //         console.log(dataall)
                                layer.alert(dataall);
                                break;
                        };
                    });

                    //监听工具条
                    table.on('tool(table1)', function (obj) {
                        var data = obj.data;
                        console.log(data)
                        var layEvent = obj.event;

                        if (layEvent === 'del') {

//                            layer.msg('删除' + data.id);
                            layer.msg('是否删除该分类？', {
                                time: 0 //不自动关闭
                                ,btn: ['确认', '取消']
                                ,yes: function(index){
                                    layer.close(index);
                                    $.ajax({
                                        url: '<?php echo url("category/del"); ?>',
                                        data: {
                                            id:data.id
                                        },
                                        dataType: "json",
                                        type: "post",
                                        success: function(data) {
//                        console.log(data);
                                            if(data.code==1){
                                                layer.msg('操作成功');
                                                window.location.href = "<?php echo url('category/index'); ?>"
                                            }else{
                                                layer.msg('操作失败');
                                            }

                                        }
                                    });

                                }
                            });
                        } else if (layEvent === 'edit') {
                            layer.ready(function(){
                                layer.open({
                                    type: 2,
                                    title: '修改',
                                    maxmin: true,
                                    area: ['80%', '70%'],
                                    content: '<?php echo url('edit'); ?>?id='+data.id,
                                    cancel: function(){ //刷新网页
                                        //重新加载表格数据
                                        self.location='<?php echo url('index'); ?>';
                                    }
                                });
                            });
                        }
                    });


                });
            </script>
    </div>
</div>
</div>
<!--<script>-->
    <!--layui.config({-->
        <!--base: '/static/hplus/module/'-->
    <!--}).extend({-->
        <!--treetable: 'treetable-lay/treetable'-->
    <!--}).use(['layer', 'table', 'treetable'], function () {-->
        <!--var $ = layui.jquery;-->
        <!--var table = layui.table;-->
        <!--var layer = layui.layer;-->
        <!--var treetable = layui.treetable;-->

        <!--// 渲染表格-->
        <!--var renderTable = function () {//树桩表格参考文档：https://gitee.com/whvse/treetable-lay-->
            <!--layer.load(2);-->
            <!--treetable.render({-->
                <!--treeColIndex: 1,//树形图标显示在第几列-->
                <!--treeSpid: 0,//最上级的父级id-->
                <!--treeIdName: 'id',//id字段的名称-->
                <!--treePidName: 'pid',//pid字段的名称-->
                <!--treeDefaultClose: false,//是否默认折叠-->
                <!--treeLinkage: true,//父级展开时是否自动展开所有子级-->
                <!--elem: '#permissionTable',-->
                <!--url: '<?php echo url("category/lists"); ?>',-->
                <!--page: false,-->
                <!--cols: [[-->
                    <!--{type: 'id', title: 'ID'},-->
                    <!--{field: 'name', title: '栏目名'},-->
                    <!--{field: 'pid', title: '父级'},-->
                    <!--{field: 'sort', title: '排序'},-->
                    <!--{templet: complain, title: '操作'}-->
                <!--]],-->
                <!--done: function () {-->
                    <!--layer.closeAll('loading');-->
                <!--}-->
            <!--});-->
        <!--};-->

        <!--renderTable();-->

        <!--//触发三个button按钮-->
        <!--$('#btn-expand').click(function () {-->
            <!--treetable.expandAll('#permissionTable');-->
        <!--});-->

        <!--$('#btn-fold').click(function () {-->
            <!--treetable.foldAll('#permissionTable');-->
        <!--});-->

        <!--$('#btn-refresh').click(function () {-->
            <!--renderTable();-->
        <!--});-->


        <!--function complain(d)else{-->
                <!--return '';-->
            <!--}-->

        <!--}-->
        <!--//监听工具条-->
        <!--table.on('tool(permissionTable)', function (obj) {-->
            <!--var data = obj.data;-->
            <!--var layEvent = obj.event;-->
            <!--if(data.permissionName!=null){-->
                <!--if (layEvent === 'del') {-->
                    <!--layer.msg('删除' + data.id);-->
                <!--} else if (layEvent === 'edit') {-->
                    <!--layer.msg('修改' + data.id);-->
                <!--}-->
            <!--}-->
        <!--});-->
    <!--});-->
<!--</script>-->

</body>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


