<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"F:\ayxg\public/../application/index\view\goodslist\index.html";i:1552813324;}*/ ?>
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
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    商品管理&nbsp;&nbsp;<img style="width: 20px" onclick="history.go(0)" src="/static/hplus/img/123.jpg">
                </div>
                <div class="ibox-content">
                    <a data-toggle="modal" class="btn btn-primary" onclick="add_goodsinfo()"  href="form_basic.html#modal-form">添加商品信息</a>
                    <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId"  href="form_basic.html#modal-form">批量昨日爆款</a>
                    <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId2"  href="form_basic.html#modal-form">批量今日主推</a>
                    <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId3"  href="form_basic.html#modal-form">批量上架</a>
                    <a data-toggle="modal" class="btn btn-w-m btn-danger" id="getAllSelectedId4"  href="form_basic.html#modal-form">批量下架</a>
                    <a data-toggle="modal" class="btn btn-w-m btn-danger"  onclick="member_out(this)" style="margin-left: 10px"  >导出</a>
                    <div class="input-group" style="width: 100%;">
                  <!--      <select  style="width: 10%;margin-left:442px"  id="goods_status" name="goods_status" >
                            <?php if($goods_status == 4): ?>
                            <option value="4" selected="selected">警戒</option>
                            <option value=""  >全部</option>
                            <option value="2" >待上架</option>
                            <option value="1" >已售罄</option>
                            <option value="3">出售中</option>
                            <?php elseif($goods_status == 3): ?>
                            <option value="3"  selected="selected">出售中</option>
                            <option value=""  >全部</option>
                            <option value="2" >待上架</option>
                            <option value="1" >已售罄</option>
                            <option value="4" >警戒</option>
                            <?php elseif($goods_status == 2): ?>
                            <option value="2" selected="selected"  >待上架</option>
                            <option value="" >全部</option>
                            <option value="3" >出售中</option>
                            <option value="1" >已售罄</option>
                            <option value="4" >警戒</option>
                            <?php elseif($goods_status == 1): ?>
                            <option value="1" selected="selected"  >已售罄</option>
                            <option value="" >全部</option>
                            <option value="3" >出售中</option>
                            <option value="2" >待上架</option>
                            <option value="4" >警戒</option>
                            <?php else: ?>
                            <option value="" selected="selected"  >全部</option>
                            <option value="3" >出售中</option>
                            <option value="2" >待上架</option>
                            <option value="1" >已售罄</option>
                            <option value="4" >警戒</option>
                            <?php endif; ?>


                        </select>-->

                        <select  style="width: 10%;margin-left:442px"  id="cate_type" name="cate_type">
                            <!--           $this->assign('cate_id',$cate['id']);
            $this->assign('cate_name',$cate['name']);-->
                            <?php if(empty($cate_id) || (($cate_id instanceof \think\Collection || $cate_id instanceof \think\Paginator ) && $cate_id->isEmpty())): ?>
                            <option value=""  selected="selected">全部</option>
                            <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $v['id']; ?>" ><?php echo $v['name']; ?></option>
                            <?php if(is_array($v['second']) || $v['second'] instanceof \think\Collection || $v['second'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['second'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vd): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vd['id']; ?>" >--|<?php echo $vd['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; else: ?>
                            <option value="<?php echo $cate_id; ?>"  selected="selected"><?php echo $cate_name; ?></option>
                            <option value="" >全部</option>
                            <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $v['id']; ?>" ><?php echo $v['name']; ?></option>
                            <?php if(is_array($v['second']) || $v['second'] instanceof \think\Collection || $v['second'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['second'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vd): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vd['id']; ?>" >--|<?php echo $vd['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                            <option value="" >全部</option>
                                <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $v['id']; ?>" ><?php echo $v['name']; ?></option>
                                <?php if(is_array($v['second']) || $v['second'] instanceof \think\Collection || $v['second'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['second'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vd): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $vd['id']; ?>" >--|<?php echo $vd['name']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                            <!--<option value="2" >已发货退货退款订单</option>-->
                        </select>
                        <?php if(empty($goods_name) || (($goods_name instanceof \think\Collection || $goods_name instanceof \think\Paginator ) && $goods_name->isEmpty())): ?>
                        <input type="text" id="goods_name" class="" style="    width: 11%;
    margin-left: 12px;" name="" placeholder="商品名称">
                        <?php else: ?>
                        <input type="text" id="goods_name" class="" style="    width: 11%;
    margin-left: 12px;" name="" placeholder="商品名称" value="<?php echo $goods_name; ?>">
                        <?php endif; ?>

                        <!--<div class="input-group-btn">-->
                            <button type="button" onclick="search()" style="    margin-left: 8px;" class="btn btn-sm btn-primary">
                                搜索
                            </button>
                        <!--</div>-->
                    </div>
                    <div class="tabs-container">
                        <ul class="nav nav-tabs bb">
                            <!--   <option value="3" >出售中</option>
                            <option value="2" >待上架</option>
                            <option value="1" >已售罄</option>
                            <option value="4" >警戒</option>-->
                            <?php if($goods_status == 4): ?>

                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="1"><a data-toggle="tab"  aria-expanded="false"> 已售罄(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="2"><a data-toggle="tab"  aria-expanded="false">待上架(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">出售中(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class="active _selected"  data-id="4" ><a data-toggle="tab"  aria-expanded="true">警戒(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">仓库中(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">今日下架(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <?php elseif($goods_status == 5): ?>
                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="1"><a data-toggle="tab"  aria-expanded="false"> 已售罄(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="2"><a data-toggle="tab"  aria-expanded="false">待上架(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">出售中(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="4" ><a data-toggle="tab"  aria-expanded="false">警戒(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class="active _selected"  data-id="5"><a data-toggle="tab"  aria-expanded="true">仓库中(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">今日下架(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <?php elseif($goods_status == 6): ?>
                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="1"><a data-toggle="tab"  aria-expanded="false"> 已售罄(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="2"><a data-toggle="tab"  aria-expanded="false">待上架(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">出售中(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="4" ><a data-toggle="tab"  aria-expanded="false">警戒(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">仓库中(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class="active _selected"  data-id="6"><a data-toggle="tab"  aria-expanded="true">今日下架(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <?php elseif($goods_status == 3): ?>

                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="1"><a data-toggle="tab"  aria-expanded="false"> 已售罄(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="2"><a data-toggle="tab"  aria-expanded="false">待上架(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class="active _selected"  data-id="3" ><a data-toggle="tab"  aria-expanded="true">出售中(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="4" ><a data-toggle="tab"  aria-expanded="false">警戒(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">仓库中(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">今日下架(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <?php elseif($goods_status == 2): ?>

                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="1"><a data-toggle="tab"  aria-expanded="false"> 已售罄(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class="active _selected"  data-id="2"><a data-toggle="tab"  aria-expanded="true">待上架(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">出售中(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="4" ><a data-toggle="tab"  aria-expanded="false">警戒(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">仓库中(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">今日下架(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <?php elseif($goods_status == 1): ?>

                            <li class=""  data-id=""><a data-toggle="tab"  aria-expanded="false">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="active _selected" data-id="1"><a data-toggle="tab"  aria-expanded="true"> 已售罄(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="2"><a data-toggle="tab"  aria-expanded="false">待上架(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">出售中(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="4" ><a data-toggle="tab"  aria-expanded="false">警戒(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">仓库中(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">今日下架(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <?php else: ?>
                            <li class="active _selected"  data-id=""><a data-toggle="tab"  aria-expanded="true">全部(<?php echo $count['all']; ?>)</a>
                            </li>
                            <li class="" data-id="1"><a data-toggle="tab"  aria-expanded="false"> 已售罄(<?php echo $count['all1']; ?>)</a>
                            </li>
                            <li class=""  data-id="2"><a data-toggle="tab"  aria-expanded="false">待上架(<?php echo $count['all2']; ?>)</a>
                            </li>
                            <li class=""  data-id="3" ><a data-toggle="tab"  aria-expanded="false">出售中(<?php echo $count['all3']; ?>)</a>
                            </li>
                            <li class=""  data-id="4" ><a data-toggle="tab"  aria-expanded="false">警戒(<?php echo $count['all4']; ?>)</a>
                            </li>
                            <li class=""  data-id="5"><a data-toggle="tab"  aria-expanded="false">仓库中(<?php echo $count['all5']; ?>)</a>
                            </li>
                            <li class=""  data-id="6"><a data-toggle="tab"  aria-expanded="false">今日下架(<?php echo $count['all6']; ?>)</a>
                            </li>
                            <?php endif; ?>

                        </ul>
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <td>主推 / 爆款
                                <input type="checkbox"  id = "allAndNotAll"/>
                            </td>
                            <td>上架 / 下架
                                <input type="checkbox"  id = "allAndNotAll2"/>
                            </td>
                            <th>商品图片</th>
                            <th>商品名称</th>
                            <th>分类</th>
                            <th>所属专区</th>
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
                            <td style="text-align: center"><?php if(($v['is_putaway'] == 1)): ?>
                                <input type="checkbox" name = "item" id = "<?php echo $v['id']; ?>" />
                                <?php else: ?>
                                <input type="checkbox" name = "items" id = "<?php echo $v['id']; ?>" />
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center"><?php if(($v['nums'] == 0)): ?>
                                <input type="checkbox" name = "item2" id = "<?php echo $v['id']; ?>" />
                                <?php else: ?>
                                <input type="checkbox" name = "items2" id = "<?php echo $v['id']; ?>" />
                                <?php endif; ?>
                            </td>
                            <td><img src="<?php echo $v['logo_image']; ?>" style="width: 80px;height: 80px" ></td>
                            <td><?php echo $v['name']; ?></td>
                            <td><?php echo $v['cate_name']; ?></td>
                            <td><?php if($v['where_division'] == '0'): ?>昨日爆款<?php endif; if($v['where_division'] == '1'): ?>今日主推<?php endif; if($v['where_division'] == '2'): ?>其他<?php endif; ?>
                            </td>
                            <td>￥<?php echo $v['original_price']; ?></td>
                            <td>￥<?php echo $v['goods_price']; ?></td>
                            <td><?php echo $v['nums']; ?></td>
                            <td><?php echo $v['sales']; ?></td>
                            <td><?php if($v['is_putaway'] == '0'): ?>出售中<?php endif; if($v['is_putaway'] == '1'): ?>已下架<?php endif; ?>
                              <!--   <?php if($v['nums'] == '0'): ?>已售罄<?php endif; ?>-->
                               </td>
                            <td class="center">
                                <a class="btn btn-primary btn-rounded" id="status" style=" border-radius: 4px"  onclick="update_slidestatus(this)" data-id="<?php echo $v['id']; ?>" data-status="<?php echo $v['is_putaway']; ?>" data-nums="<?php echo $v['nums']; ?>"><?php if($v['is_putaway'] == '0'): ?>下架<?php endif; if($v['is_putaway'] == '1'): ?>上架<?php endif; ?>
                                 </a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"   onclick="update_slideshow(this)" data-id="<?php echo $v['id']; ?>">修改</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidedel(this)" data-id="<?php echo $v['id']; ?>">删除</a>
                                <a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidesale(this)" data-id="<?php echo $v['id']; ?>">修改销量</a>
                            </td>
                        </tr>
                        </tbody>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                    <?php echo $data->render(); ?>
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
    //添加商品信息界面
    function add_goodsinfo(){
        window.location.href = "<?php echo url('goodslist/add'); ?>"
    }
    //编辑商品信息界面
    function update_slideshow(update_slideshow){
//        alert(11111)
        var id = $(update_slideshow).attr('data-id');
        window.open("<?php echo url('goodslist/edit'); ?>?goods_id="+id);
    }
    function update_slidesale(update_slidesale) {
        var id = $(update_slidesale).attr('data-id');
        layer.ready(function(){
            layer.open({
                type: 2,
                title: '修改销量',
                maxmin: true,
                area: ['50%', '50%'],
                content: '<?php echo url('editsale'); ?>?did='+id,
                cancel: function(){ //刷新网页
                    //重新加载表格数据
                    self.location='<?php echo url('index'); ?>';
                }
            });
        });
    }
    //导出
    function member_out(member_out) {
        console.log($('._selected').attr('data-id'))
//        return
        var goods_status = $('._selected').attr('data-id');
        var cate_type = $("#cate_type option:selected").val();
        var goods_name = $('#goods_name').val();
        window.location.href = "<?php echo url('goodslist/excel'); ?>?goods_name="+goods_name+"&cate_type="+cate_type+"&goods_status="+goods_status;
//        var order_type = $('._selected').attr('data-id');
//        var time = $("#test5").val();
//        var nameorder = $("#nameorder").val();
////        var str = "~";
//        var reg = RegExp(/~/);
//        console.log(reg.test(time));
//        if(time==''){
//            window.location.href = "<?php echo url('order/excel'); ?>?order_type="+order_type+"&time="+time+"&nameorder="+nameorder;
//        }else{
//            if(reg.test(time)){
//                window.location.href = "<?php echo url('order/excel'); ?>?order_type="+order_type+"&time="+time+"&nameorder="+nameorder;
//            }else{
//                layer.msg('时间格式有误',{icon: 2, shift: 6});
//            }
//
//        }
    }
    //删除商品信息
    function update_slidedel(update_slidedel){
        var id = $(update_slidedel).attr('data-id');
        layer.msg("是否删除此商品", {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: '<?php echo url("goodslist/del"); ?>',
                    data: {
                        id:id
                    },
                    dataType: "json",
                    type: "post",
                    success: function(data) {
                        console.log(data);
                        if(data==1){
                            layer.msg('操作成功',{icon: 1, shift: 6},function () {
                                history.go(0)
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
    //关键字搜索
    $('.bb li').on('click',function () {
        $(this).addClass('_selected').siblings().removeClass('_selected')
        search($(this).attr('data-id'))
    })
    function search(tabid){
        console.log($('._selected').attr('data-id'))
//        return
        var goods_status = $('._selected').attr('data-id');
        var cate_type = $("#cate_type option:selected").val();
        var goods_name = $('#goods_name').val();
        window.location.href = "<?php echo url('goodslist/index'); ?>?goods_name="+goods_name+"&cate_type="+cate_type+"&goods_status="+goods_status;
    }

    //上下架商品
    function update_slidestatus(update_slidestatus){
        var id = $(update_slidestatus).attr('data-id');
        var status = $(update_slidestatus).attr('data-status');
        var nums = $(update_slidestatus).attr('data-nums');
//        alert(id+"状态"+status+"库存"+nums);
        if(status == 1 && nums == 0){
          var str = "此商品已无库存确定上架吗？";
        }else{
            str ="是否"+$(update_slidestatus).text()+"商品";
        }
//        alert(str);
        layer.msg(str, {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: '<?php echo url("goodslist/putaway"); ?>',
                    data: {
                        id:id,status:status
                    },
                    dataType: "json",
                    type: "post",
                    success: function(data) {
                        console.log(data);
                        if(data==1){
                            layer.msg('操作成功',{icon: 1, shift: 6},function () {
                                history.go(0)
                            });

                        }else{
                            layer.msg('操作失败');
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
    //实现全选与反选
    $("#allAndNotAll2").change(function() {

        if ($(this).prop("checked")){
            $("input[name='items2']:checkbox").each(function(index,item){
                $(item).prop("checked", true);
            });
        } else {
            $("input[name='items2']:checkbox").each(function(index,item) {
                $(item).removeAttr("checked");
            });
        }
    });

    //批量爆款
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
            url: "<?php echo url('goodslist/hotstyle'); ?>",
            type: "post",
            data: {
                id:ids
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.code === 1) {
                    layer.msg(data.msg, {icon: 1, shift: 6});
                    history.go(0)
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
    //批量主推
    var ids2=[];
    $('#getAllSelectedId2').click(function(){
        $("input[name='items']:checked").each(function(){
            ids2.push($(this).attr("id"));
        });
        console.log("id长度"+ids2.length);
        if(ids2.length == 0){
            layer.msg('请选择商品', {icon: 2, shift: 6});
            return;
        }
//        main
        $.ajax({
            url: "<?php echo url('goodslist/mainly'); ?>",
            type: "post",
            data: {
                id:ids2
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.code === 1) {
                    layer.msg(data.msg, {icon: 1, shift: 6},function () {
                        history.go(0)
                    });

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
    //批量上架
    var ids3=[];
    $('#getAllSelectedId3').click(function(){
        $("input[name='items2']:checked").each(function(){
            ids3.push($(this).attr("id"));
        });
        console.log("id长度"+ids3.length);
        if(ids3.length == 0){
            layer.msg('请选择商品', {icon: 2, shift: 6});
            return;
        }
//        main
        layer.msg("是否批量上架", {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: "<?php echo url('goodslist/putaways'); ?>",
                    type: "post",
                    data: {
                        id:ids3
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
/*        $.ajax({
            url: "<?php echo url('goodslist/putaways'); ?>",
            type: "post",
            data: {
                id:ids3
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.code === 1) {
                    layer.msg(data.msg, {icon: 1, shift: 6});
                    history.go(0)
                } else {
                    layer.msg(data.msg, {icon: 2, shift: 6});
                }
            },
            error: function (e) {
                layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
            }
        });*/
        return false;

    });
    //批量下架
    var ids4=[];
    $('#getAllSelectedId4').click(function(){
        $("input[name='items2']:checked").each(function(){
            ids4.push($(this).attr("id"));
        });
        console.log("id长度"+ids.length);
        if(ids4.length == 0){
            layer.msg('请选择商品', {icon: 2, shift: 6});
            return;
        }
//        main
        layer.msg("是否批量下架", {
            time: 0 //不自动关闭
            ,btn: ['确认', '取消']
            ,yes: function(index){
                layer.close(index);
                $.ajax({
                    url: '<?php echo url("goodslist/downaways"); ?>',
                    data: {
                        id:ids4
                    },
                    dataType: "json",
                    type: "post",
                    success: function(data) {
                        console.log(data);
                        if(data.code === 1){
                            layer.msg(data.msg, {icon: 1, shift: 6},function () {
                                history.go(0)
                            });

                        }else{
                            layer.msg('操作失败');
                        }
                    }
                });
            }
        });
//        $.ajax({
//            url: "<?php echo url('goodslist/downaways'); ?>",
//            type: "post",
//            data: {
//                id:ids
//            },
//            dataType: "json",
//            success: function (data) {
//                console.log(data);
//                if (data.code === 1) {
//                    layer.msg(data.msg, {icon: 1, shift: 6});
//                    history.go(0)
//                } else {
//                    layer.msg(data.msg, {icon: 2, shift: 6});
//                }
//            },
//            error: function (e) {
//                layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
//            }
//        });
        return false;

    });
</script>

</body>

<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:02 GMT -->
</html>


