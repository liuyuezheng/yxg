<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"F:\ayxg\public/../application/index\view\goodslist\edit.html";i:1553091054;}*/ ?>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改商品</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/hplus/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link rel="stylesheet" href="/static/hplus/cations/css/sku_style.css"/>
    <script src="/static/hplus/layui/assets/jquery-1.12.4.js"></script>
    <!--<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>-->
    <script type="text/javascript" src="/static/hplus/cations/js/customSku.js"></script>
    <script type="text/javascrip  t" src="/static/hplus/cations/plugins/layer/layer.js"></script>
    <!-- Data Tables -->
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/static/hplus/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="/static/hplus/css/animate.min.css" rel="stylesheet">

    <link href="/static/hplus/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="/static/hplus/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/hplus/ueditor/ueditor.all.min.js"></script>
    <script src="/static/hplus/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/hplus/js/content.min.js?v=1.0.0"></script>
    <script src="/static/hplus/js/plugins/chosen/chosen.jquery.js"></script>
    <script src="/static/hplus/js/plugins/jsKnob/jquery.knob.js"></script>
    <script src="/static/hplus/js/plugins/jasny/jasny-bootstrap.min.js"></script>
    <script src="/static/hplus/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="/static/hplus/js/plugins/prettyfile/bootstrap-prettyfile.js"></script>
    <script src="/static/hplus/js/plugins/nouslider/jquery.nouislider.min.js"></script>
    <script src="/static/hplus/js/plugins/switchery/switchery.js"></script>
    <script src="/static/hplus/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>
    <script src="/static/hplus/js/plugins/iCheck/icheck.min.js"></script>
    <script src="/static/hplus/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/static/hplus/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="/static/hplus/js/plugins/clockpicker/clockpicker.js"></script>
    <script src="/static/hplus/js/plugins/cropper/cropper.min.js"></script>
    <script src="/static/hplus/js/demo/form-advanced-demo.min.js"></script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    <script src="/static/hplus/laydate/laydate.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/hplus/layui2/css/layui.css">
    <script type="text/javascript" src="/static/hplus/layui2/layui.js"></script>
    <script type="text/javascript" src="/static/hplus/layui/assets/data.js"></script>
    <script type="text/javascript" src="/static/hplus/layui/assets/province.js"></script>

    <script type="text/javascript">
        var defaults = {
            s1: 'provid',
            s2: 'cityid',
            s3: 'areaid',
            v1: null,
            v2: null,
            v3: null
        };

    </script>
</head>
<style type="text/css">
    .col-sm-2 {
        width: 6.66666667%;
    }

    .gray-bg {
        background-color: #FFF;
    }

    .input-group .form-control {
        position: relative;
        z-index: 2;
        float: right;
        width: 25%;
        margin-bottom: 0;

    }

    .file11 {
        position: relative;
        z-index: 999;
    }

    .file11 input {
        position: absolute;
        width: 80px;
        height: 48px;
        right: 50%;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .showitem {
        display: flex;
        line-height: 28px;
        margin: 10px 0;
        flex-wrap: wrap;
    }

    .selectPro {
        width: auto !important;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        margin-right: 50px;
    }

    .selectPro .del {
        width: 20px;
        height: 20px;
        position: absolute;
        background: #000;
        color: #fff0f5;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        top: 5px;
        right: -23px;
    }

    .surebrn {
        line-height: 40px;
        border: 1px solid #333;
        padding: 0 20px;
        display: inline-block;
        background-color: #1ab394;
        border-color: #1ab394;
        color: #fff;
        border-radius: 3px;
    }
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    修改商品
                </div>
                <div class="fen"
                     style="border-style:solid solid none;border-image: none;border-width: 1px 0;border-color: #e7eaec;"></div>
                <div class="group" style="margin: 10px 0px;float: left;width: 50%">
                    <label class="labels" style="font-size: 16px">商品名称:</label>
                    <input type="hidden" id="goods_id" class="goods_id" value="<?php echo $info['id']; ?>">
                    <input type="text" class="goodsname" placeholder="请输入商品名称" value="<?php echo $info['name']; ?>">
                    <!--     <label class="labels" style="font-size: 16px;margin-left: 150px">商品描述:</label>
                         <input type="text" class="goods_describe" placeholder="请输入商品描述"  value="<?php echo $info['describe']; ?>" >-->
                </div>
                <div class="group" style="margin: 10px 0px;float: left;width: 50%">
                    <label class="labels" style="font-size: 16px;margin-left: 117px">一级分类:</label>
                    <select style="width: 29%;margin-left: 21px;height: 25px;" id="supplier_id" name="cate_id"
                            onchange="handleFirst2(this)">
                        <option value="<?php echo $pnames['id']; ?>"><?php echo $pnames['name']; ?></option>
                        <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                        <!--     <?php if(is_array($v['second']) || $v['second'] instanceof \think\Collection || $v['second'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['second'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vd): $mod = ($i % 2 );++$i;?>
                             <option value="<?php echo $vd['id']; ?>" >&#45;&#45;|<?php echo $vd['name']; ?></option>
                             <?php endforeach; endif; else: echo "" ;endif; ?>-->
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <!--<input type="text" class="nsmes" placeholder="请输入商品名称"  value="" >-->
                </div>
                <div class="group" style="margin: 10px 0px;float: left;width: 50%">
                    <label class="labels" style="font-size: 16px;">商品描述:</label>
                    <input type="text" class="goods_describe" placeholder="请输入商品描述" value="<?php echo $info['describe']; ?>">
                </div>
                <div class="group" style="margin: 10px 0px;float: left;width: 50%">
                    <label class="labels" style="font-size: 16px;margin-left: 117px">二级分类:</label>
                    <select style="width: 29%;margin-left: 21px;height: 25px;" id="supplier_id2" name="cate_id2">
                        <option value="<?php echo $info['classify_id']; ?>"><?php echo $info['cate_name']; ?></option>

                    </select>
                    <!--<input type="text" class="nsmes" placeholder="请输入商品名称"  value="" >-->
                </div>
                <div class="group" style="margin: 10px 0px;width: 50%;float: left">
                    <label class="labels" style="font-size: 16px">限购数量:</label>
                    <input type="text" class="limit_num" id="limit_num" oninput="value=value.replace(/[^\d]/g,'')"
                           placeholder="请输入限购数量" value="<?php echo $info['limit_num']; ?>">
                    <!-- <input type="text" class="limit_num" id="limit_num" oninput="value=value.replace(/[^\d]/g,'')" placeholder="请输入限购数量"  value="" >-->
                </div>
                <div class="group" style="margin: 10px 0px;width: 50%;float: left">
                    <label class="labels" style="font-size: 16px;margin-left: 117px;">商品编码:</label>
                    <input type="text" class="goods_bian" id="goods_bian" placeholder="请输入商品编码"
                           value="<?php echo $info['goods_number']; ?>">
                </div>
                <div class="layui-collapse">
                    <div class="layui-colla-item">
                        <h2 class="layui-colla-title" style="font-weight: bold;font-size: 25px;">商品规格</h2>
                        <div class="layui-colla-content" id="shangpingguige">
                            <div id="loading">
                                <div class="ibox-content">
                                    <div class="spiner-example">
                                        <div class="sk-spinner sk-spinner-chasing-dots">
                                            <div class="sk-dot1"></div>
                                            <div class="sk-dot2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    //注意：折叠面板 依赖 element 模块，否则无法进行功能性操作
                    layui.use('element', function () {
                        var element = layui.element;
                        var goods_id = $('#goods_id').val();//商品id
                        $.ajax({
                            url: '<?php echo url("goodslist/assess"); ?>',
                            type: "get",
                            data: {
                                goods_id: goods_id,
                            },
                            dataType: "json",
                            success: function (data) {
                                if (data.code == 1) {
                                    var html = '', list = '';
                                    console.log(data.data.prices);
                                    $.each(data.data.prices, function (idx, obj) {
                                        list += `
                                            <tr>
                                            <td>
                                            <input class="first_td" type="hidden"  value="${obj.ments}">
                                            ${obj.ments}
                                        </td>
                                        <td>
                                        <div class="file11">
                                            <label for="inputs" style="cursor:pointer;">
                                        <img src="${obj.img}" style="width:60px;height:60px;" title="点击上传图片 ">
                                        </label>
                                        <input type="file" class="setting_img" onchange="showPreviews(this)"    img-url="${obj.img}"/>
                                            <input type="hidden" class="setting_imgs" name="attrimg[]" value="${obj.img}" /></div></td>
                                            <td class="_prices"><input type="text" class="cost_price" style="width: 82px"   value="${obj.cost_price}"/><input type="hidden" class="atr_id" value="${obj.id}"></td>
                                            <td class="_prices"><input type="text" class="price" style="width: 82px"  value="${obj.price}"/></td>
                                            <td><input type="text" class="num" style="width: 82px"  oninput="value=value.replace(/[^0-9]/g,'')" value="${obj.num}"/></td>
                                            <td><input type="text" class="sell_num" style="width: 82px"  oninput="value=value.replace(/[^0-9]/g,'')" value="${obj.sell_num}"/></td>
                                            <td class="_prices"><input type="text" class="general_price" style="width: 82px"   value="${obj.general_price}"/></td>
                                            <td class="_prices"><input type="text" class="director_price" style="width: 82px"   value="${obj.director_price}"/></td>                                            <td class="_prices"><input type="text" class="two_agent"  style="width: 82px"  value="${obj.two_agent}"/></td>
                                            <td class="_prices"><input type="text" class="three_agent"  style="width: 82px"  value="${obj.three_agent}"/></td>
                                            <td class="_prices"><input type="text" class="manager" style="width: 82px"   value="${obj.manager}"/></td>
                                            <td ><a class="btn btn-primary btn-rounded" style=" border-radius: 4px"  onclick="update_slidedel(this)" data-id="${obj.id}">删除</a></td>
                                            </tr>`
                                    })
                                    console.log(list);
                                    html = `<table class="layui-table" id="views"><thead>
                                        <tr>
                                        <th>规格</th>
                                        <th>展示图</th>
                                        <th>规格原价</th>
                                        <th>用户售价</th>
                                        <th>对应库存</th>
                                        <th>起卖数量</th>
                                        <th>总代售价</th>
                                        <th>董事售价</th>
                                        <th>一级总代佣金</th>
                                        <th>二级总代佣金</th>
                                        <th>董事同级奖励</th>
                                        <th>操作</th>
                                        </tr>
                                        <tbody>${list}</tbody>
                                        </thead>
                                        </table>`;
                                    $('#shangpingguige').html(html);
                                } else {

                                }
                            },
                            error: function (e) {
                                flag = 1;
                                layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
                            }
                        });
                    });
                </script>
                <style>
                    .stateInput{
                        line-height: 50px;
                        float: left;
                        /*margin-left: 10px;*/
                        width: 50%;
                    }
                </style>
                <div>
                    <div class="stateInput">
                        <span>规格原价统一修改:</span>
                        <input class="_prices" data-cls="cost_price" placeholder="1" type="text" value="" onchange="stateInpue(this)">
                    </div>

                    <div class="stateInput">
                        <span>用户售价统一修改:</span>
                        <input class="_prices"  data-cls="price" placeholder="1" type="text" value="" onchange="stateInpue(this)">
                    </div>
                    <div class="stateInput">
                        <span>对应库存统一修改:</span>
                        <input data-cls="num" placeholder="0" type="text" value="" onchange="stateInpue(this)">
                    </div>
                    <div class="stateInput">
                        <span>售价统一修改:</span>
                        <input class="_prices" data-cls="general_price" placeholder="总代" style="width: 64px;" type="text" value="" onchange="stateInpue(this)">
                        <input class="_prices" data-cls="director_price"  placeholder="董事" style="width: 64px;" type="text" value="" onchange="stateInpue(this)">
                    </div>
                 <!--   <div class="stateInput">
                        <span>董事售价统一修改:</span>
                        <input data-cls="director_price" type="text" value="" onchange="stateInpue(this)">
                    </div>-->
                    <div class="stateInput">
                        <span>佣金统一修改:</span>
                        <input class="_prices" data-cls="two_agent" style="width: 85px;" placeholder="一级总代" type="text" value="" onchange="stateInpue(this)">
                        <input class="_prices" data-cls="three_agent" style="width: 85px;"  placeholder="二级总代" type="text" value="" onchange="stateInpue(this)">
                        <input class="_prices" data-cls="manager"  style="width: 85px;" placeholder="董事" type="text" value="" onchange="stateInpue(this)">
                    </div>
                    <!--<div class="stateInput">
                        <span>二级总代佣金统一修改:</span>
                        <input data-cls="three_agent" type="text" value="" onchange="stateInpue(this)">
                    </div>-->
                    <!--<div class="stateInput">
                        <span>董事同级奖励统一修改:</span>
                        <input data-cls="manager" type="text" value="" onchange="stateInpue(this)">
                    </div>-->
                </div>
                <div class="ibox-content">
                    <div class="demo-title">注：添加商品属性时请先添加一级属性，再添加二级属性，最后勾选！</div>
                    <?php if(is_array($attr) || $attr instanceof \think\Collection || $attr instanceof \think\Paginator): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vall): $mod = ($i % 2 );++$i;?>
                    <div class="clear"></div>
                    <ul class="SKU_TYPE">
                        <li is_required='0' propid='' sku-type-name="">
                            <!--                            <a href="javascript:void(0);" class="delCusSkuType">移除</a>-->
                            <input type="text" class="cusSkuTypeInput" placeholder="请输入一级属性名称" value="<?php echo $vall['atrname']; ?>"
                                   style="width: 120px;"/>：<!--一级栏目input框-->
                        </li>
                    </ul>
                    <ul style="border: 1px solid #fff;">
                        <?php if(is_array($vall['name']) || $vall['name'] instanceof \think\Collection || $vall['name'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vall['name'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val2): $mod = ($i % 2 );++$i;?>
                        <li>
                            <input type="checkbox" class="model_sku_val" propvalid='' value="<?php echo $val2; ?>"/>
                            <input type="text" class="cusSkuValInput" placeholder="请输入二级属性名称，然后选中当前"
                                   value="<?php echo $val2; ?>" style="width: 120px;"/>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <button class="cloneSkuVal"
                                style="border: 1px solid rgb(129,148,170);height: 27px;background: rgb(129,148,170);color:#fff">
                            添加自定义属性值
                        </button>
                        <!--                        <button class="cloneSkuVal" style="border: 1px solid rgb(129,148,170);height: 27px;background: rgb(129,148,170);color:#fff">添加自定义属性值</button>-->
                    </ul>
                    <?php endforeach; endif; else: echo "" ;endif; ?>


                    <button class="cloneSku"
                            style="border: 1px solid rgb(53,87,114);height: 27px;background: rgb(53,87,114);color:#fff">
                        添加自定义sku属性
                    </button>

                    <!--一级属性+第一个二级属性         sku模板,用于克隆,生成自定义sku-->
                    <div id="skuCloneModel" style="display: none;">
                        <div class="clear"></div>
                        <ul class="SKU_TYPE">
                            <li is_required='0' propid='' sku-type-name="">
                                <a href="javascript:void(0);" class="delCusSkuType">移除</a>
                                <input type="text" class="cusSkuTypeInput" placeholder="请输入一级属性名称"/>：<!--一级栏目input框-->
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <input type="checkbox" class="model_sku_val" propvalid='' value=""/>
                                <input type="text" class="cusSkuValInput" placeholder="请输入二级属性名称，然后选中当前"/>
                            </li>
                            <button class="cloneSkuVal"
                                    style="border: 1px solid rgb(129,148,170);height: 27px;background: rgb(129,148,170);color:#fff">
                                添加自定义属性值
                            </button>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <!--=第2个二级属性(单个sku值克隆模板)-->
                    <li style="display: none;" id="onlySkuValCloneModel">
                        <input type="checkbox" class="model_sku_val" propvalid='' value=""/>
                        <input type="text" class="cusSkuValInput" placeholder="请输入二级属性名称，然后选中当前"/>
                        <a href="javascript:void(0);" class="delCusSkuVal">删除</a>
                    </li>
                    <div class="clear"></div>
                    <div id="skuTable"></div>

                </div>
                <div style="width: 100%;margin-top: 10px;border-style:solid solid none;border-image: none;border-width: 1px 0;border-color: #e7eaec;">

                    <div class="group _prices" style="margin: 10px 0px;float: left;width: 50%">
                        <label class="labels" style="font-size: 16px">商品原价:</label>
                        <input type="text" class="nsmes" id="old_price" oninput="value=value.replace(/[^\d.]/g,'')"
                               placeholder="1" value="<?php echo $info['original_price']; ?>">
                    </div>
                    <div class="group _prices" style="margin: 10px 0px;width: 50%;float: left">
                        <label class="labels" style="font-size: 16px;margin-left: 117px">商品售价:</label>
                        <input type="text" class="goods_price" id="goods_price"
                               oninput="value=value.replace(/[^\d.]/g,'')" placeholder="1" value="<?php echo $info['goods_price']; ?>">
                        <!--<input type="text" class="goods_price" id="goods_price" placeholder="请输入商品价格"  value="" >-->
                    </div>

                </div>
                <div style="width: 100%">
                    <div class="group _prices" style="margin: 10px 0px;width: 50%;float: left">
                        <label class="labels" style="font-size: 16px">库存:</label>
                        <input type="text" class="sell_num" id="sell_num" oninput="value=value.replace(/[^\d]/g,'')"
                               placeholder="0" value="">
                        <!--<input type="text" class="goods_price" id="goods_price" placeholder="请输入商品价格"  value="" >-->
                    </div>
                    <div class="group _prices" style="margin: 10px 0px;width: 50%;float: left">
                        <label class="labels" style="font-size: 16px;margin-left: 117px">售价:</label>
                        <input type="text" class="gen_prices" id="gen_prices" style="width: 64px" placeholder="总代"
                               oninput="value=value.replace(/[^\d.]/g,'')" value="">
                        <input type="text" class="manager_prices" id="manager_prices" style="width: 64px"
                               placeholder="董事" oninput="value=value.replace(/[^\d.]/g,'')" value="">
                    </div>


                </div>
                <!--<div style="width: 100%;margin-top: 10px;border-style:solid solid none;border-image: none;border-width: 1px 0;border-color: #e7eaec;">-->
                <!--<div class="group" style="margin: 10px 0px;width: 50%;float: left">-->
                <!--<label class="labels" style="font-size: 16px">商品价格:</label>-->
                <!--<input type="text" class="goods_price" id="goods_price" oninput="value=value.replace(/[^\d.]/g,'')"  placeholder="请输入商品价格"  value="<?php echo $info['goods_price']; ?>" >-->
                <!--</div>-->
                <!--<div class="group" style="margin: 10px 0px;float: left;width: 50%">-->
                <!--<label class="labels" style="font-size: 16px;margin-left: 117px">商品原价:</label>-->
                <!--<input type="text" class="nsmes" id="old_price" oninput="value=value.replace(/[^\d.]/g,'')" placeholder="请输入商品原价"  value="<?php echo $info['original_price']; ?>" >-->
                <!--</div>-->
                <!--</div>-->

                <div style="width: 100%">
                    <!-- <div class="group" style="margin: 10px 0px;width: 50%;float: left">
                         <label class="labels" style="font-size: 16px">限购数量:</label>
                         <input type="text" class="limit_num" id="limit_num" oninput="value=value.replace(/[^\d]/g,'')" placeholder="请输入限购数量"  value="<?php echo $info['limit_num']; ?>" >
                     </div>-->
                    <div class="group _prices" style="margin: 10px 0px;float: left;width: 50%">
                        <label class="labels" style="font-size: 16px">佣金:</label>
                        <input type="text" class="two_moneys" id="two_moneys" style="width: 85px" placeholder="一级总代"
                               oninput="value=value.replace(/[^\d.]/g,'')" value="">
                        <input type="text" class="three_moneys" id="three_moneys" style="width: 85px" placeholder="二级总代"
                               oninput="value=value.replace(/[^\d.]/g,'')" value="">
                        <input type="text" class="manager_moneys" id="manager_moneys" style="width: 85px"
                               placeholder="一级董事" oninput="value=value.replace(/[^\d.]/g,'')" value="">
                        <!--<input type="text" class="nsmes" placeholder="请输入商品名称"  value="" >-->
                    </div>
                    <div class="group" style="margin: 10px 0px;float: left;width: 50%">
                        <label class="labels" style="font-size: 16px;margin-left: 117px">所属专区:</label>
                        <select style="width: 29%;margin-left: 21px;height: 25px;" id="division" name="division">
                            <?php if($info['where_division'] == '0'): ?>
                            <option value="0">昨日爆款</option>
                            <option value="1">今日主推</option>
                            <option value="2">其他</option>
                            <?php endif; if($info['where_division'] == '1'): ?>
                            <option value="1">今日主推</option>
                            <option value="0">昨日爆款</option>
                            <option value="2">其他</option>
                            <?php endif; if($info['where_division'] == '2'): ?>
                            <option value="2">其他</option>
                            <option value="0">昨日爆款</option>
                            <option value="1">今日主推</option>
                            <?php endif; ?>
                        </select>
                        <!--<input type="text" class="nsmes" placeholder="请输入商品名称"  value="" >-->
                    </div>
                </div>
                <div style="width: 100%">
                    <div class="group" style="margin: 10px 0px;width: 30%;float: left">
                        <label class="labels" style="font-size: 16px">三级分销积分:</label>
                        <input type="text" class="one" id="one" style="width: 64px" placeholder="一级"
                               oninput="value=value.replace(/[^\d]/g,'')" value="<?php echo $info['one_integral']; ?>">
                        <input type="text" class="two" id="two" style="width: 64px" placeholder="二级"
                               oninput="value=value.replace(/[^\d]/g,'')" value="<?php echo $info['two_integral']; ?>">
                        <input type="text" class="three" id="three" style="width: 64px" placeholder="三级"
                               oninput="value=value.replace(/[^\d]/g,'')" value="<?php echo $info['three_integral']; ?>">
                    </div>
                    <div class="group" style="margin: 10px 0px;float: left;width: 25%">
                        <label class="labels" style="font-size: 16px;margin-left: 0px">是否可使用优惠券:</label>
                        <?php if($info['is_use_coupon'] == '1'): ?>
                        <input id="checs" type="checkbox" class="js-switch" checked/>
                        <script>
                            var iszs = 1;
                            //                    console.log($(".switchery"));
                            $("#checs").change(function () {
                                console.log($(this)[0].checked);
                                if ($(this)[0].checked == true) {
                                    iszs = 1;
                                } else {
                                    iszs = 0;
                                }
                            });

                        </script>
                        <?php endif; if($info['is_use_coupon'] == '0'): ?>
                        <input id="checs" type="checkbox" class="js-switch" style="display: none;"/>
                        <script>
                            var iszs = 0;
                            //                    console.log($(".switchery"));
                            $("#checs").change(function () {
                                console.log($(this)[0].checked);
                                if ($(this)[0].checked == true) {
                                    iszs = 1;
                                } else {
                                    iszs = 0;
                                }
                            });

                        </script>
                        <?php endif; ?>

                    </div>

                    <div class="group" style="margin: 10px 0px;float: left;width: 45%">
                        <label class="labels" style="font-size: 16px;margin-left: 27px">赠送优惠券:</label>
                        <select style="width: 29%;height: 25px;;margin-left: 14px" id="pons" name="pons">
                            <?php if(empty($coupons) || (($coupons instanceof \think\Collection || $coupons instanceof \think\Paginator ) && $coupons->isEmpty())): ?>
                            <option value="2">==请选择==</option>
                            <?php else: ?>
                            <option value="<?php echo $info['coupon_id']; ?>"><?php echo $coupons['name']; ?></option>
                            <option value="2">==请选择==</option>
                            <?php endif; if(is_array($coupon) || $coupon instanceof \think\Collection || $coupon instanceof \think\Paginator): $i = 0; $__LIST__ = $coupon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $v1['id']; ?>"><?php echo $v1['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <!--<input type="text" class="nsmes" placeholder="请输入商品名称"  value="" >-->
                    </div>

                </div>

                <div class="groups" style="width: 50%;height: 50%">
                    <label class="jifen" style="font-size: 16px">赠送积分:</label>
                    <input type="text" class="zfen" id="integral" placeholder="请输入赠送积分"
                           oninput="value=value.replace(/[^\d]/g,'')" value="<?php echo $info['own_integral']; ?>">

                    <label class="labels" style="font-size: 16px;margin-left: 0px">退款时是否退货:</label>
                    <?php if($info['is_return'] == '1'): ?>
                    <input id="checs2" type="checkbox" class="js-switch_2" checked/>
                    <script>
                        var iszs1 = 1;
                        //                    console.log($(".switchery"));
                        $("#checs2").change(function () {
                            console.log($(this)[0].checked);
                            if ($(this)[0].checked == true) {
                                iszs1 = 1;
                            } else {
                                iszs1 = 0;
                            }
                        });

                    </script>
                    <?php endif; if($info['is_return'] == '0'): ?>
                    <input id="checs2" type="checkbox" class="js-switch_2" style="display: none;"/>
                    <script>
                        var iszs1 = 0;
                        //                    console.log($(".switchery"));
                        $("#checs2").change(function () {
                            console.log($(this)[0].checked);
                            if ($(this)[0].checked == true) {
                                iszs1 = 1;
                            } else {
                                iszs1 = 0;
                            }
                        });

                    </script>
                    <?php endif; ?>

                </div>


                <div class="fen"
                     style="margin: 10px 0px;border-style:solid solid none;border-image: none;border-width: 1px 0;border-color: #e7eaec;">
                </div>
                <div class="layui-form-item" id="pics">
                    <span style="color: red">注意:建议轮播图比例  375*375，不然会失真</span>
                    <div class="layui-input-block" style="width: 70%;">
                        <div class="layui-upload">
                            <button type="button" class="layui-btn layui-btn-primary pull-left" id="slide-pc">轮播图
                            </button>
                            <div class="pic-more">
                                <ul class="pic-more-upload-list" id="slide-pc-priview">
                                    <?php if(is_array($images) || $images instanceof \think\Collection || $images instanceof \think\Paginator): $i = 0; $__LIST__ = $images;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                                    <li class="item_img">
                                        <div class="operate">
                                            <i class="toleft layui-icon"></i>
                                            <i class="toright layui-icon"></i>
                                            <i class="close layui-icon"></i>
                                        </div>
                                        <img src="<?php echo $v1; ?>" style="width: 150px;height: 150px" class="img">
                                        <input type="hidden" name="pics[]" value="<?php echo $v1; ?>"/>
                                    </li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fen"
                     style="border-style:solid solid none;border-image: none;border-width: 1px 0;border-color: #e7eaec;">
                </div>
                <div class="group" style="margin: 10px 0px;width: 100%;">
                    <div>
                        <label class="labels" style="font-size: 16px">商品详情:<span
                                style="color: red">注意:建议图片宽度为346，不然会失真</span></label>
                    </div>
                    <textarea id="editor" name="editors" type="text/plain" style="width:1000px;height:500px;"><?php echo $info['goods_detail']; ?></textarea>
                </div>
                <div class="fen"
                     style="border-style:solid solid none;border-image: none;border-width: 1px 0;border-color: #e7eaec;">
                </div>
                <div>
                    <div class="group" style="margin: 10px 0px;width: 50%;float: left">
                        <label class="labels" style="font-size: 16px">开始时间:</label>
                        <?php if($info['start_time'] != 0): ?>
                        <input type="text" id="startTime" placeholder='开始时间'
                               value="<?php echo date('Y-m-d H:i:s',$info['start_time']); ?>">
                        <?php else: ?>
                        <input type="text" id="startTime" placeholder='开始时间' value="">
                        <?php endif; ?>
                        <!--<input type="text" class="nsmes" placeholder="开始时间"  value="" >-->
                    </div>
                    <div class="group" style="margin: 10px 0px;float: left;width: 50%">
                        <label class="labels" style="font-size: 16px;margin-left: 117px">结束时间:</label>
                        <?php if($info['end_time'] != 0): ?>
                        <input type="text" id="endTime" placeholder='结束时间'
                               value="<?php echo date('Y-m-d H:i:s',$info['end_time']); ?>">
                        <?php else: ?>
                        <input type="text" id="endTime" placeholder='结束时间' value="">
                        <?php endif; ?>

                        <!--<input type="text" class="nsmes" placeholder="结束时间"  value="" >-->
                    </div>

                </div>
                <div>
                    <div class="group" style="margin: 10px 0px;width: 50%;float: left">
                        <label class="labels" style="font-size: 16px">固定身份购买:</label>
                        <select style="width: 20%;height: 25px;" id="identity" name="cate_id">
                            <?php if($info['use_type'] == '0'): ?>
                            <option value="0">普通用户</option>
                            <option value="1">总代/董事</option>
                            <option value="2">全部</option>
                            <?php endif; if($info['use_type'] == '1'): ?>
                            <option value="1">总代/董事</option>
                            <option value="0">普通用户</option>
                            <option value="2">全部</option>
                            <?php endif; if($info['use_type'] == '2'): ?>
                            <option value="2">全部</option>
                            <option value="0">普通用户</option>
                            <option value="1">总代/董事</option>


                            <?php endif; ?>
                            <!--      <?php if($info['use_type'] == '1'): ?>
                                  <option value="1" >总代/董事</option>
                                  <?php endif; ?>-->


                        </select>

                    </div>
                    <div class="group" style="margin: 10px 0px;float: left;width: 50%">
                        <label class="labels" style="font-size: 16px;margin-left: 117px">库存警戒线:</label>
                        <input type="text" class="zfen" id="cordon" placeholder="1"
                               oninput="value=value.replace(/[^\d]/g,'')" value="<?php echo $info['cordon']; ?>">
                    </div>
                </div>
                <div>
                    <div class="group" style="margin: 10px 0px;width: 100%">
                        <label class="labels" style="font-size: 16px">购买后是否升级总代:</label>
                        <?php if($info['is_up'] == '1'): ?>
                        <input id="chec" type="checkbox" class="js-switch_3" checked/>
                        <script>
                            var isz = 1;
                            //                    console.log($(".switchery"));
                            $("#chec").change(function () {
                                console.log($(this)[0].checked);
                                if ($(this)[0].checked == true) {
                                    isz = 1;
                                } else {
                                    isz = 0;
                                }
//                        alert(isz);
                            });

                        </script>
                        <?php endif; if($info['is_up'] == '0'): ?>
                        <input id="chec" type="checkbox" class="js-switch_3" style="display: none;"/>
                        <script>
                            var isz = 0;
                            //                    console.log($(".switchery"));
                            $("#chec").change(function () {
                                console.log($(this)[0].checked);
                                if ($(this)[0].checked == true) {
                                    isz = 1;
                                } else {
                                    isz = 0;
                                }
//                        alert(isz);
                            });

                        </script>
                        <?php endif; ?>
                        <!--<input id="chec"  type="checkbox" class="js-switch_3" style="display: none;"  />-->
                        <!--<input id="chec"  type="checkbox" class="js-switch_3"  />-->
                    </div>
                </div>
                <!-- <div class="group" style="margin: 10px 0px;width: 100%">
                     <label class="labels" style="font-size: 16px">运费:</label>
                     <input type="text" id="freights" class="freights" style="width: 64px"  oninput="value=value.replace(/[^0-9.]/g,'')" placeholder="请输入统一运费"  value="<?php echo $info['freight']; ?>" >
                 </div>-->

                <div class="group" style="margin: 10px 0px;width: 100%">
                    展示：
                    <div class="showbox">
                        <?php if(is_array($haves) || $haves instanceof \think\Collection || $haves instanceof \think\Paginator): if( count($haves)==0 ) : echo "" ;else: foreach($haves as $key=>$v): ?>
                        <div class="showitem">
                            所选省：
                            <?php if(is_array($v['province']) || $v['province'] instanceof \think\Collection || $v['province'] instanceof \think\Paginator): if( count($v['province'])==0 ) : echo "" ;else: foreach($v['province'] as $key=>$v1): ?>
                            <div class="selectPro">
                                <span class="cont"><?php echo $v1; ?></span> <span class="del">x</span>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            <div style="display: inline-block">运费：<span class="price"><?php echo $v['price']; ?></span></div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    运费：<input type="text" value="" id="yunfei" oninput="value=value.replace(/[^\d]/g,'')">
                    <button class="btn btn-primary selectAll" style="" type="button">全选</button>
                    <div class="tbox">
                        <?php if(is_array($province) || $province instanceof \think\Collection || $province instanceof \think\Paginator): if( count($province)==0 ) : echo "" ;else: foreach($province as $key=>$v): if($v['status'] == 1): ?>
                        <div class="selectPro" style="display: none;">
                            <input type="checkbox" value="<?php echo $v['name']; ?>" checked disabled> <span><?php echo $v['name']; ?></span>
                        </div>
                        <?php else: ?>
                        <div class="selectPro" style="display: inline-block;">
                            <input type="checkbox" value="<?php echo $v['name']; ?>"> <span><?php echo $v['name']; ?></span>
                        </div>
                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="surebrn" style="">确定</div>
                </div>
                <script>
                    var selectArr = []
                    $.each($('.tbox [type="checkbox"]'), function (index, element) {
                        $(element).on('click', function () {
//                存选中项
                            if ($(element).prop("checked")) {
//                                    console.log($(element).siblings('span').text());
                                selectArr.push($(element).val())
                            } else {
                                $('.selectAll').text('全选')
//                    取消删除改选中元素
                                selectArr.forEach(function (el, ind) {
                                    if ($(element).siblings('span').text() == el) {
                                        selectArr.splice(ind, 1);
                                    }
                                })
                            }
                        })
                    })
                    $('.surebrn').on('click', function () {

//            获取运费
                        var price = $('#yunfei').val()
                        if (!price) {
                            price = 0
                        }
                        var selecthtml = '';
                        var totalhtml = '';
                        var flag = "";//运费是否存在标识 真是存在
                        if (selectArr.length == 0) return
                        selectArr.forEach(function (element, index) {
                            selecthtml += `<div class="selectPro"><span class="cont">${element}</span> <span class="del">x</span></div>`
                            console.log(222)
                        })
                        totalhtml += `
                <div class="showitem">
                所选省：${selecthtml}
                <div style="display: inline-block">运费：<span class="price">${price}</span></div>
                </div>`;
                        //判断运费是否存在
                        $.each($('.showitem .price'), function (index, element) {
                            console.log($(element).text(), price);
                            if ($(element).text() == price) {
                                flag = $(element);
                            }
                        })
                        if (flag) {
                            flag.parent().before(selecthtml);
                        } else {
                            $('.showbox').append(totalhtml)
                        }
//删除
                        $('.del').on('click', function () {
//拿到当前的值，
                            $('.selectAll').text('全选')
                            var nowvalue = $(this).prev('.cont').html()
                            $.each($('.tbox [type=checkbox]'), function (index, element) {
                                if ($(element).val() == nowvalue) {
                                    $(element).prop({'disabled': false, 'checked': false});
                                    $(element).parent().css('display', 'inline-block')
                                }
                            })
                            if ($(this).parents('.showitem').find('.selectPro').length == 1) $(this).parents('.showitem').remove();
                            $(this).parent('.selectPro').remove();
                        })
//            所有选中的被禁用
                        selectArr = []
                        $.each($('.tbox [type=checkbox]'), function (index, element) {
                            if ($(element).prop('checked')) {
                                $(element).prop('disabled', true)
                                $(element).parent().css('display', 'none')
                            }
                        })
                    })

                    $('.edit').on('click', function () {
                        let arr = [];
                        $.each($('.showitem'), function (index, element) {
                            var provincearr = [];
                            console.log(element);
                            $.each($(element).find('.cont'), function (i, v) {
                                provincearr.push($(v).text());
                            })
                            arr.push({
                                province: provincearr,
                                price: $(element).find('.price').text()
                            })
                        })
                        console.log(arr);
                    })
                    $('.del').on('click', function () {
//拿到当前的值，
                        var nowvalue = $(this).prev('.cont').html()
                        $.each($('.tbox [type=checkbox]'), function (index, element) {
                            if ($(element).val() == nowvalue) {
                                $(element).prop({'disabled': false, 'checked': false});
                                $(element).parent().css('display', 'inline-block')
                            }
                        })
                        if ($(this).parents('.showitem').find('.selectPro').length == 1) $(this).parents('.showitem').remove();
                        $(this).parent('.selectPro').remove();
                    })
                    $('.selectAll').on('click', function () {
                        if ($(this).text().trim() == '全选') {
                            selectArr = []
                            $('.tbox [type="checkbox"]').prop("checked", true)
                            $.each($('.tbox [type="checkbox"]'), function (index, element) {
                                if ($(element).prop("checked") && !$(element).prop("disabled")) {
//                                    console.log($(element).siblings('span').text());
                                    selectArr.push($(element).val())
                                }
                            })
                            $(this).text('全不选')
                        } else {
                            $('.tbox [type="checkbox"]').prop("checked", false)
                            selectArr = []
                            $(this).text('全选')
                        }
                    })
                </script>
                <div class="group" style="margin: 10px 0px;width: 100%">
                    <label class="labels" style="font-size: 16px">上下架:</label>
                    <?php if($info['is_putaway'] == '0'): ?>
                    <input type="radio" id="is_hot" name="is_hot" class="ishot" checked value="0">上架
                    <input type="radio" id="is_hot" name="is_hot" class="ishot" value="1">下架
                    <?php endif; if($info['is_putaway'] == '1'): ?>
                    <input type="radio" id="is_hot" name="is_hot" class="ishot" value="0">上架
                    <input type="radio" id="is_hot" name="is_hot" class="ishot" checked value="1">下架
                    <?php endif; ?>


                </div>
                <div class="col-sm-4 col-sm-offset-3" style="height:329px">
                    <button class="btn btn-primary" style="width: 30%;height: 10%" onclick="add_goodsinfo()"
                            type="button">确认修改
                    </button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--<button type="button" class="btn btn-default"
                                                                            style="width: 30%;height: 10%"
                                                                            onclick="quxiao()">取消
                </button>-->
                </div>
                <!--<button class="getSetSkuVal">提交</button>-->
            </div>
        </div>
    </div>
</div>
<!--加载框-->
<style>
    .loadingbox{
        display: none;
    }
    .loadingbox.display{
        display: flex;
    }
</style>
<div class="loadingbox" style="position: fixed;top: 0;left: 0;width: 100vw;height: 100vh;background: rgba(0,0,0,.6);justify-content: center;align-items: center;z-index: 3;">
    <img src="/static/loading.gif" alt="">
</div>
</body>
<script>
    //修改规格内容
    function stateInpue(_this) {
        var _thisVal = $(_this).val();
        var _thisCla = $(_this).data('cls');
        $('.'+ _thisCla).val(_thisVal);
    };
    //输入框只能输入数字且小数点只能有两位
    $('._prices input').on('input', function () {
        console.log($(this).val())
        function num(obj) {
            obj.val(obj.val().replace(/[^\d.]/g, "")); //清除"数字"和"."以外的字符
            obj.val(obj.val().replace(/^\./g, "")); //验证第一个字符是数字
            obj.val(obj.val().replace(/\.{2,}/g, ".")); //只保留第一个, 清除多余的
            obj.val(obj.val().replace(".", "$#$").replace(/\./g, "").replace("$#$", "."));
            obj.val(obj.val().replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3')); //只能输入两个小数
        }

        num($(this))
    })
    var flag = 1;
    $('._money input').on('input', function () {
        console.log($(this).val())
        function num(obj) {
            obj.val(obj.val().replace(/[^\d]/g, "")); //清除"数字"和"."以外的字符
        }

        num($(this))
    })
    console.log($('.first_td').val())
    var temarr = [], maxtemp = '';
    $(".first_td").each(function (index, element) {
        console.log(element)
        console.log(index + ": " + $(this).val());
        temarr.push($(this).val().split(',').length)
    });
    console.log(temarr)
    maxtemp = Math.max(...temarr
    )
    console.log(maxtemp)
    //    限购数量
    $('#limit_num').on('input', function () {
        if ($(this).val() != 0) {
            var temarr1 = [], maxtemp1 = '';
            $(".setting_sell_num").each(function (index, element) {
                console.log(element)
                console.log(index + ": " + $(this).val());
                temarr1.push($(this).val())
            });
            console.log(temarr1)
            maxtemp1 = Math.max(...temarr1
        )
            console.log('maxtemp1----->' + maxtemp1)
//        起卖数量不能大于限购数量  则限购数量 =最大起卖件数
            if ($(this).val() < maxtemp1) {
                $(this).val(maxtemp1)
            }
        }

    })
    $('td._prices input').on('blur', function () {
        if ($(this).hasClass('general_price')) {
            console.log(2222)
            console.log($(this).val(), $(this).parent().next().children('input').val())
            if (Number($(this).val()) < Number($(this).parent().next().children('input').val())) {
                $(this).val($(this).parent().next().children('input').val())
                layer.msg('总代售价需大于董事售价', {icon: 2, shift: 6});
                return;
            }
        }
        if ($(this).hasClass('director_price')) {
            console.log($(this).val(), $(this).parent().prev().children('input').val())
            if (Number($(this).val()) > Number($(this).parent().prev().children('input').val())) {
                $(this).val($(this).parent().prev().children('input').val())
                layer.msg('总代售价需大于董事售价', {icon: 2, shift: 6});
                return;
            }
        }
    })
    $('input._prices').on('blur', function () {
        console.log('sdfjhtgjh',$(this).attr('data-cls'))
        var _thisc = $(this).attr('data-cls')
        if ($(this).attr('data-cls') == 'general_price') {
            console.log(2222)
            console.log($(this).val(), $(this).next('input').val())
            if (Number($(this).val()) < Number($(this).next('input').val())) {
                $(this).val($(this).next('input').val())
                layer.msg('总代售价需大于董事售价', {icon: 2, shift: 6});
                $('.'+ _thisc).val($(this).val());
                return;
            }
        }
        if ( $(this).attr('data-cls') == 'director_price') {
            console.log($(this).val(), $(this).prev('input').val())
            if (Number($(this).val()) > Number($(this).prev('input').val())) {
                $(this).val($(this).prev('input').val())
                layer.msg('总代售价需大于董事售价', {icon: 2, shift: 6});
                $('.'+ _thisc).val($(this).val());
                return;
            }
        }


    })

    $('#gen_prices').bind('blur', function () {
        var _price = $(this).val();
        if (Number($('#manager_prices').val())) {
            if (Number(_price) < Number($('#manager_prices').val())) {
                $(this).val(Number($('#manager_prices').val()))
                layer.msg('总代售价需大于董事售价', {icon: 2, shift: 6});
                return;
            }
        }
        $('.setting_general_price').val(_price)

    });
    $('#manager_prices').bind('blur', function () {
        var _price = $(this).val();
        if ($('#gen_prices').val()) {
            if (Number(_price) > Number($('#gen_prices').val())) {
                $(this).val(Number($('#gen_prices').val()))
                layer.msg('总代售价需大于董事售价', {icon: 2, shift: 6});
                return;
            }
        }
        $('.setting_director_price').val(_price)

    });
    var ue = UE.getEditor("editor");

    function add_goodsinfo() {
        var atr_id = $(".atr_id");
        var atr_ids = [];
        for (var i = 0; i < atr_id.length; i++) {
            atr_ids.push(atr_id[i].value);
        }
        console.log("属性价格id" + atr_id);
//        setting_imgattrpic
        var setting_img = $(".setting_imgs");
        var setting_imgs = [];
        for (var ii = 0; ii < setting_img.length; ii++) {
            setting_imgs.push(setting_img[ii].value);
        }
//        var setting_imgs = valArr2.join(',');
        console.log("属性图片" + setting_imgs);


        var price = $(".price");
        var prices = [];
        for (var i1 = 0; i1 < price.length; i1++) {
            prices.push(price[i1].value);
        }
//        console.log("售价"+prices);
        var cost_price = $(".cost_price");
        var cost_prices = [];
        for (var is = 0; is < cost_price.length; is++) {
            cost_prices.push(cost_price[is].value);
        }
//        console.log("规格原价"+cost_prices);
        var num = $(".num");
        var nums = [];
        for (var i2 = 0; i2 < num.length; i2++) {
            nums.push(num[i2].value);
        }
//        console.log("库存"+nums);
        var director_price = $(".director_price");
        var director_prices = [];
        for (var i4 = 0; i4 < director_price.length; i4++) {
            director_prices.push(director_price[i4].value);
        }

//        console.log("总代价"+director_prices);

        var general_price = $(".general_price");
        var general_prices = [];
        for (var i5 = 0; i5 < general_price.length; i5++) {
            general_prices.push(general_price[i5].value);
        }
//        console.log("董事价"+general_prices);
//        console.log("董事价"+general_prices);
//        var one_agent = $(".one_agent");
//        var one_agents  = [];
//        for (var i6=0;i6<one_agent.length;i6++){
//            one_agents.push(one_agent[i6].value);
//        }
//        console.log("一级佣金"+one_agents);
        var two_agent = $(".two_agent");
        var two_agents = [];
        for (var i7 = 0; i7 < two_agent.length; i7++) {
            two_agents.push(two_agent[i7].value);
        }
//        console.log("二级佣金"+two_agents);
        var three_agent = $(".three_agent");
        var three_agents = [];
        for (var i8 = 0; i8 < three_agent.length; i8++) {
            three_agents.push(three_agent[i8].value);
        }
//        console.log("三级佣金"+three_agents);
        var sell_num = $(".sell_num");
        var sell_nums = [];
        for (var i3 = 0; i3 < sell_num.length; i3++) {
            sell_nums.push(sell_num[i3].value);
        }
//        console.log("起卖量"+sell_nums);
        var manager = $(".manager");
        var managers = [];
        for (var i9 = 0; i9 < manager.length; i9++) {
            managers.push(manager[i9].value);
        }
//        console.log("董事奖金"+managers);
//        console.log();sell_num
        var testArray = [];
        var goods_id = $('#goods_id').val();//商品id
        var cordon = $('#cordon').val();//库存警戒线
        var goodsname = $('.goodsname').val(); //商品名
        var goods_bian = $('#goods_bian').val();//商品编号
        var goods_describe = $('.goods_describe').val(); //商品描述
//        var cate_id=$('#supplier_id').val();//分类id
        var cate_id1 = $('#supplier_id').val();//分类id
        var cate_id = $('#supplier_id2').val();//分类id
        var goods_price = $('#goods_price').val();//价格
        var old_price = $('#old_price').val();//原价
        var limit_num = $('#limit_num').val();//分类id
        var division = $('#division').val();//所属专区
        var one = $('#one').val();//一级
        var two = $('#two').val();//二级
        var three = $('#three').val();//三级
        var is_pons = iszs;
        //      iszs1  退款是否退货
        var is_return = iszs1;
        var pons = $('#pons').val();//赠送优惠券
        var integral = $('#integral').val();//赠送积分
        var startTime = $('#startTime').val();//开始时间
        var endTime = $('#endTime').val();//结束时间
        var identity = $('#identity').val();//身份
        var is_up = isz;//升级总代
//        var freights=$('#freights').val();//运费
//        var identity=$('#identity').val();//身份
        var ishot = $('input:radio:checked').val();//上下架
//        alert(ishot);
//        var citys=freight_city = $(".freight_city");
        var valArr = new Array;
        $("input[name='pics[]']").each(function (i) {
            valArr[i] = $(this).val();
        });
        var pics = valArr.join(',');
        console.log('轮播图' + pics)
        var detail = ue.getContent();
//        return priv;  startTime
//        var pics=$("input[name='pics[]']").val();

        /*sku属性*/
        /*  var goods=[];*/
        var freight_pros = [];
        $.each($('.showitem'), function (index, element) {
            var provincearr = [];
            console.log(element);
            $.each($(element).find('.cont'), function (i, v) {
                provincearr.push($(v).text());
            })
            freight_pros.push({
                province: provincearr,
                price: $(element).find('.price').text()
            })
        })
//        var freight_pro_lists = $(".freight_pro");
//        for(var p=0;p<freight_pro_lists.length;p++){
//            freight_pros.push(freight_pro_lists[p].value);
////            freight_pros += freight_pro_lists[p].value+",";
//        }
//        var freight_citys = [];
//        var freight_city_lists = $(".freight_city");
//        for(var c=0;c<freight_city_lists.length;c++){
//            freight_citys.push(freight_city_lists[c].value);
////            freight_citys += freight_city_lists[c].value+",";
//        }
//        var sell_num = $(".sell_num");
//        var sell_nums  = [];
//        for (var i3=0;i3<sell_num.length;i3++){
//            sell_nums.push(sell_num[i3].value);
//        }
//        var freight_id = [];
//        var freight_ids = $(".freight_id");
//        for(var d=0;d<freight_ids.length;d++){
//            freight_id.push(freight_ids[d].value);
//        }

//        var freight_moneys = [];
//        var freight_money_lists = $(".freight_money");
//        for(var w=0;w<freight_money_lists.length;w++){
//            freight_moneys.push(freight_money_lists[w].value);
//        }
        var atr_name = $(".first_td");
        var atr_names = [];
        for (var j = 0; j < atr_name.length; j++) {
            atr_names.push(atr_name[j].value);
        }
        console.log(atr_names);
        var indexx = 0;
//        console.log("省"+freight_pros+"市"+freight_citys+"运费"+freight_moneys);
        $("tr[class*='sku_table_tr']").each(function () {
            var obj = {
                propnames: '',
                propvalnames: '',
                proImg: '',
                cost_price: '',
                price: '',
                num: '',
                sell_num: '',
                general_price: '',
                director_price: '',
                one_agent: '',
                two_agent: '',
                three_agent: '',
                manager: ''
            };
            //obj.proImg=$("#setting_img").prop("files");        //图片
            /*$(this).find("input[type='file'][class*='setting_img']").attr('img-url');*/
            obj.proImg = $(this).find("input[type='file'][class*='setting_img']").attr('img-url');        //图片
            obj.cost_price = $(this).find("input[type='text'][class*='setting_cost_price']").val();        //规格原价
            obj.price = $(this).find("input[type='text'][class*='setting_price']").val();        //用户售价

            obj.num = $(this).find("input[type='text'][class*='setting_num']").val();  //对应库存
            obj.sell_num = $(this).find("input[type='text'][class*='setting_sell_num']").val();//起卖数量
            obj.general_price = $(this).find("input[type='text'][class*='setting_general_price']").val();//总代售价
            obj.director_price = $(this).find("input[type='text'][class*='setting_director_price']").val();//董事售价
            obj.one_agent = $(this).find("input[type='text'][class*='setting_one_agent']").val();//上级总代佣金
            obj.two_agent = $(this).find("input[type='text'][class*='setting_two_agent']").val();//二级总代佣金
            obj.three_agent = $(this).find("input[type='text'][class*='setting_three_agent']").val();//三级级总代佣金
            obj.manager = $(this).find("input[type='text'][class*='setting_manager']").val();//董事同级奖励
            obj.propnames = $(this).attr("propnames");  //一级属性名称
            obj.propvalnames = $(this).attr("propvalnames");  //二级属性名称
            testArray.push(obj);
            $tt = $(this).attr("propvalnames");
            $tts = $tt.replace(";", ",");
            console.log($tts);
            console.log(atr_names);
            var index = $.inArray($tts, atr_names);
            console.log(index)
            if (index >= 0) {
                indexx++;
            }
        });
//        console.log("商品详情"+detail);
//        return;
//        var propnames="";
//        if(testArray != ""){
//            var propnames=testArray[0]['propnames'].split(';');
//        }
//        if(propnames!="" && propnames.length<2){
//            layer.msg('至少选择一个一级属性', {icon: 2, shift: 6});
//            return;
//        }
//        else
        if (goodsname == "") {
            layer.msg('商品名称不能为空！', {icon: 2, shift: 6});
            return;
        } else if (cate_id1 == "") {
            layer.msg('请选择一级分类！', {icon: 2, shift: 6});
            return;
        }
        else if (cate_id == "") {
            layer.msg('请选择二级分类', {icon: 2, shift: 6});
            return;
        } else if (goods_bian == "") {
            layer.msg('请填写商品编码', {icon: 2, shift: 6});
            return;
        } else if (goods_price == "") {
            layer.msg('请填写商品售价', {icon: 2, shift: 6});
            return;
        }
        else if (old_price == "") {
            layer.msg('请填写商品原价', {icon: 2, shift: 6});
            return;
        } else if (pics == "") {
            layer.msg('请选择商品轮播图', {icon: 2, shift: 6});
            return;
        } else if (testArray == "" && atr_ids == "") {
            layer.msg('请填写商品属性', {icon: 2, shift: 6});
            return;
        } else if (freight_pros == "") {
            layer.msg('请选择商品运费', {icon: 2, shift: 6});
            return;
        } else if (indexx != 0) {
            layer.msg('请勿添加已存在的规格属性!', {icon: 2, shift: 6});
            return;
        } else {
            var testArray1 =JSON.stringify(testArray);
            var setting_imgs1 =JSON.stringify(setting_imgs);
            var atr_ids1 =JSON.stringify(atr_ids);
            var prices1 =JSON.stringify(prices);
            var cost_prices1 =JSON.stringify(cost_prices);
            var nums1 =JSON.stringify(nums);
            var director_prices1 =JSON.stringify(director_prices);
            var general_prices1 =JSON.stringify(general_prices);
            var two_agents1 =JSON.stringify(two_agents);
            var three_agents1 =JSON.stringify(three_agents);
            var managers1 =JSON.stringify(managers);
            var sell_nums1 =JSON.stringify(sell_nums);

//            alert(11);
            if (flag) {
                flag = 0;
                $('.loadingbox').addClass('display')
                $.ajax({
                    url: '<?php echo url("goodslist/edits"); ?>',
                    type: "post",
                    data: {
                        goods_id: goods_id,
                        name: goodsname,
                        describe: goods_describe,
                        classify_id: cate_id,
                        goods_price: goods_price,
                        original_price: old_price,
                        goods_number: goods_bian,
                        limit_num: limit_num,
                        where_division: division,
                        one_integral: one,
                        two_integral: two,
                        three_integral: three,
                        is_use_coupon: is_pons,
                        coupon_id: pons,
                        own_integral: integral,
                        startTime: startTime,
                        endTime: endTime,
                        use_type: identity,
                        is_up: is_up,
                        is_return: is_return,
//                        freight:freights,
                        cordon: cordon,
                        is_putaway: ishot,
                        goods_images: pics,
                        goods_detail: detail,
//                        freight_ids:freight_id,
                        freight_pros: freight_pros,
//                        freight_citys:freight_citys,
//                        freight_moneys:freight_moneys,
                        testArray: testArray1,
                        atr_ids: atr_ids1,
                        prices: prices1,
                        cost_prices: cost_prices1,
                        nums: nums1,
                        general_prices: director_prices1,
                        director_prices: general_prices1,
//                    one_agents:one_agents,
                        two_agents: two_agents1,
                        three_agents: three_agents1,
                        sell_nums: sell_nums1,
                        setting_imgs: setting_imgs1,
                        managers: managers1


                    },
                    dataType: "json",
                    success: function (data) {
                        $('.loadingbox').removeClass('display')
                        console.log(data);
                        if (data.code == 1) {

                            layer.msg(data.msg, {icon: 1, shift: 6}, function () {
                                flag = 1;
                                window.location=window.location;
                            });
//                    window.location.href = "<?php echo url('goodslist/index'); ?>";
                        } else {
                            flag = 1;
                            layer.msg(data.msg, {icon: 2, shift: 6});
                        }
                    },
                    error: function (e) {
                        $('.loadingbox').removeClass('display')
                        flag = 1;
                        layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
                    }
                });
            }

        }

    }
    function handleFirst2(obj) {
        var cate_id = $(obj).find("option:selected").val();
//        alert(cate_id);
        var url = "<?php echo url('describe/second'); ?>";
        var that = $(obj);
        $.post(url, {cate_id: cate_id}, function (data) {
            var html = "";
            html += '<option value="">二级分类</option>';
            if (data.length != 0) {
                $.each(data, function (idx, obj) {
                    html += '<option value="' + obj.id + '">' + obj.name + '</option>';
                })
            }
            $('#supplier_id2').html(html);
        });
    }
    /*取消*/
    function quxiao() {
        history.back(-1);
    }
    var flag2 = 1;
    //删除商品属性信息
    function update_slidedel(update_slidedel) {
        var id = $(update_slidedel).attr('data-id');
        var that = $(update_slidedel);
        layer.msg("是否删除此规格属性", {
            time: 0 //不自动关闭
            , btn: ['确认', '取消']
            , yes: function (index) {
                layer.close(index);
                $.ajax({
                    url: '<?php echo url("goodslist/delatr"); ?>',
                    data: {
                        id: id
                    },
                    dataType: "json",
                    type: "post",
                    success: function (data) {
                        console.log(data);
                        if (data == 1) {
                            layer.msg('操作成功', {icon: 1, shift: 6}, function () {
                                that.parent().parent().remove();
                            });

                        } else {
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
    /**
     * 添加属性图
     */
    function showPreviews(soure) {
//        alert(111);
        var fileObj = soure.files[0]; // js 获取文件对象
        var formFile = new FormData();
        formFile.append("action", "UploadVMKImagePath");
        formFile.append("file", fileObj); //加入文件对象
        var datas = formFile;
        $.ajax({
            type: "post",
            url: "<?php echo url('goodslist/uploadSxImg'); ?>",
            dataType: 'json',
            data: datas,
            processData: false,
            cache: false,//上传文件无需缓存
            contentType: false, //必须
            success: function (data) {
                $(soure).attr('img-url', data);
                $(soure).attr('value', data);
                $(soure).prev().find('img').attr('src', data);
                $(soure).parent().find(".setting_imgs").attr("value", data);
            },
            error: function (error) {
                console.log(error)
            }
        });
    }
    /*选择省份*/
    /*  function handleFirst(obj){
     var pro_id = $(obj).find("option:selected").val();

     var url = "<?php echo url('goodslist/city'); ?>";
     var that = $(obj);
     $.post(url, {pro_id: pro_id}, function (data) {
     var html = "";
     html +='<option value="">请选择市</option>';
     if(data.length!=0){
     console.log(data);
     $.each(data, function (idx, obj) {
     console.log(obj.id);
     html +='<option value="'+obj.id+'">'+obj.name+'</option>';
     })
     }
     that.parent().parent().find('#city_freight_tip').html(html);
     });
     }*/
    /*选择省份*/
    function handleFirst(obj) {
        var pro_id = $(obj).find("option:selected").val();

        var url = "<?php echo url('goodslist/city'); ?>";
        var that = $(obj);
        $.post(url, {pro_id: pro_id}, function (data) {
            var html = "";
            html += '<option value="">请选择市</option>';
            if (data.length != 0) {
                console.log(data);
                $.each(data, function (idx, obj) {
                    console.log(obj.id);
                    html += '<option value="' + obj.id + '" data-name="' + obj.name + '">' + obj.name + '</option>';
                })
            }
            that.parent().parent().find('#city_freight_tip2').html(html);
        });
    }
    /*添加特殊省运费*/
    function addArea() {
        var province_freight_tip = $("#province_freight_tip1").val();
        var city_freight_tip = $("#city_freight_tip1").val();
        var money = $("#money1").val();
        var freight_pro = $(".freight_pro").val();
//        alert(province_freight_tip +" 市   "+city_freight_tip);
        var freight_city = $(".freight_city");
        var checkRes = "";
//        console.log(freight_pro);
//        console.log(money);
//        if (province_freight_tip === 0 || city_freight_tip.length === 0 || money.length === 0){
//            layer.alert("省市运费请不要为空",{icon:5});
//        }
        if (province_freight_tip === 0 || money.length === 0) {
            layer.alert("省运费请不要为空", {icon: 5});
        } else {
            $.ajax({
                url: "<?php echo url('goodslist/allname'); ?>",
                data: {
                    province_id: province_freight_tip
//                    city_id:city_freight_tip
                },
                type: 'POST',
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if (freight_city.length > 0) {

                        for (var i = 0; i < freight_city.length; i++) {
                            for (var i2 = 0; i2 < res.length; i2++) {
                                if (freight_city[i].value === res[i2].city_name) {
                                    layer.alert("请不要重复添加特殊地区运费", {icon: 5});
                                    checkRes += freight_city[i].value + ",";
                                }
                            }

                        }
                    }
                    console.log(checkRes);
                    if (checkRes === "") {
//                        alert(1111111111);
                        var top = "<tbody>";
                        var tr = "";
                        for (var j = 0; j < res.length; j++) {
                            tr = tr +
                                "<tr>" +
                                "<td><input type='hidden' class='freight_pro' value='" + res[j].pro_name + "'/>" + res[j].pro_name + "</td>" +
                                "<td><input type='hidden' class='freight_city' value='" + res[j].city_name + "'/>" + res[j].city_name + "</td>" +
                                "<td class='_money'><input type='text' class='freight_money ' value='" + money + "'/></td>" +
                                "<td class='delData'>删除</td>" +
                                "</tr>";

                        }
                        var wei = "</tbody>";
                        var td = $(top + tr + wei);
                        console.log(td);
                        $("#_table").append(td);
                    }

                }
            });

        }

    }
    /*添加特殊省市运费*/
    function addArea2() {
        var province_freight_tip = $("#province_freight_tip2").val();
        var city_freight_tip = $("#city_freight_tip2").val();
        var money = $("#money2").val();
        var freight_pro = $(".freight_pro").val();
//        alert(province_freight_tip +" 市   "+city_freight_tip);
        var freight_city = $(".freight_city");
        var checkRes = "";
        if (province_freight_tip === 0 || city_freight_tip.length === 0 || money.length === 0) {
            layer.alert("省市运费请不要为空", {icon: 5});
        }
        else {
            $.ajax({
                url: "<?php echo url('goodslist/allname'); ?>",
                data: {
                    province_id: province_freight_tip,
                    city_id: city_freight_tip
                },
                type: 'POST',
                dataType: 'json',
                success: function (res) {
//                    console.log(freight_city);
//                    console.log(res);
                    if (freight_city.length > 0) {
                        for (var i3 = 0; i3 < freight_city.length; i3++) {
                            console.log(freight_city[i3].value);
                            console.log(res.city_name[0]);
                            if (freight_city[i3].value === res.city_name[0]) {
                                layer.alert("请不要重复添加特殊地区运费", {icon: 5});
                                checkRes += freight_city[i3].value + ",";
                            }
                        }
                    }
//                    console.log(checkRes);
//                    if(freight_city.length>0){
//
//                        for(var i=0;i<freight_city.length;i++){
//                            if(freight_city[i].value === res.city_name){
//                                layer.alert("请不要重复添加特殊地区运费",{icon:5});
//                                checkRes += freight_city[i].value+",";
//                            }
//                        }
//                    }
                    if (checkRes === "") {
//                        alert(1111111111);
                        var td = $(" <tbody>" +
                            "<tr>" +
                            "<td><input type='hidden' class='freight_pro' value='" + res.pro_name + "'/>" + res.pro_name + "</td>" +
                            "<td><input type='hidden' class='freight_city' value='" + res.city_name + "'/>" + res.city_name + "</td>" +
                            "<td class='_money'><input type='text' class='freight_money' value='" + money + "'/></td>" +
                            "<td class='delData'>删除</td>" +
                            "</tr>" +
                            "</tbody>");
                        console.log(td);
                        $("#_table").append(td);
                    }

                }
            });

        }

    }
    //    $(".model_sku_val").on("click",function(){
    ////        alert(1111);
    //        $('#views').hide();
    //    });
    //  	点击删除
    $("#_table").on("click", ".delData", function () {
        $(this).parent().remove();
    });
    //  	点击删除
    $("#_table").on("click", ".delData2", function () {
        var id = $(this).find("input[type='hidden']").val();
        var that = $(this);
        layer.msg("是否删除此运费", {
            time: 0 //不自动关闭
            , btn: ['确认', '取消']
            , yes: function (index) {
                layer.close(index);
                $.ajax({
                    url: '<?php echo url("goodslist/delfre"); ?>',
                    data: {
                        id: id
                    },
                    dataType: "json",
                    type: "post",
                    success: function (data) {
                        console.log(data);
                        if (data == 1) {
                            that.parent().remove();
                            layer.msg('操作成功', {icon: 1, shift: 6});

                        } else {
                            layer.msg('操作失败');
                        }
                    }
                });
            }
        });
    });


    function changeDate() {
        var date = new Date();
        var y = date.getFullYear();
        var m = date.getMonth() + 1;
        m = m < 10 ? ('0' + m) : m;
        var d = date.getDate();
        d = d < 10 ? ('0' + d) : d;
        var h = date.getHours();
        h = h < 10 ? ('0' + h) : h;
        var i = date.getMinutes();
        i = i < 10 ? ('0' + i) : i;
        var s = date.getSeconds();
        s = s < 10 ? ('0' + s) : s;
        return y + '-' + m + '-' + d + ' ' + h + ':' + i + ':' + s;
    }
    var now = changeDate();
    //console.log(now);
    /*时间插件*/
    var startTime = laydate.render({
        elem: '#startTime',
        type: 'datetime',
        min: 0,
        max: '2035-12-31 12:30:00',
        done: function (value, date, endDate) {
            endLayDate.config.min = {
                year: date.year,
                month: date.month - 1,
                date: date.date,
                hours: date.hours,
                minutes: date.minutes,
                seconds: date.seconds + 1
            };
        }
    });
    /*时间插件*/
    var endLayDate = laydate.render({
        elem: '#endTime',
        type: 'datetime',
        max: '2035-12-31 12:30:00',
        btns: ['clear', 'confirm'],  //clear、now、confirm
        done: function (value, date, endDate) {
            startTime.config.max = {
                year: date.year,
                month: date.month - 1,
                date: date.date,
                hours: date.hours,
                minutes: date.minutes,
                seconds: date.seconds - 1
            };
        }
    });
    layui.use('upload', function () {
        var $ = layui.jquery;
        var upload = layui.upload;
        upload.render({
            elem: '#slide-pc',
            url: "<?php echo url('index/uploads'); ?>",
            exts: 'jpg|png|jpeg',
            multiple: true,
            before: function (obj) {
                layer.msg('图片上传中...', {
                    icon: 16,
                    shade: 0.01,
                    time: 0
                })
            },
            done: function (res) {
                console.log(res);
                layer.close(layer.msg());//关闭上传提示窗口
                if (res.status == 0) {
                    return layer.msg(res.message);
                }
                //$('#slide-pc-priview').append('<input type="hidden" name="pc_src[]" value="' + res.filepath + '" />');
                $('#slide-pc-priview').append('<li class="item_img"><div class="operate"><i class="toleft layui-icon"></i><i class="toright layui-icon"></i><i  class="close layui-icon"></i></div><img src="' + res.filepath + '" style="width: 150px;height: 150px" class="img" ><input type="hidden" name="pics[]" value="' + res.filepath + '" /></li>');
            }
        });
    });
    //点击多图上传的X,删除当前的图片
    $("body").on("click", ".close", function () {
        $(this).closest("li").remove();
    });
    //多图上传点击<>左右移动图片
    $("body").on("click", ".pic-more ul li .toleft", function () {
        var li_index = $(this).closest("li").index();
        if (li_index >= 1) {
            $(this).closest("li").insertBefore($(this).closest("ul").find("li").eq(Number(li_index) - 1));
        }
    });
    $("body").on("click", ".pic-more ul li .toright", function () {
        var li_index = $(this).closest("li").index();
        $(this).closest("li").insertAfter($(this).closest("ul").find("li").eq(Number(li_index) + 1));
    });
    $('#goods_price').bind('input propertychange', function () {
        var _price = $(this).val();
        $('.setting_price').val(_price)
    });
    $('#old_price').bind('input propertychange', function () {
        var _price = $(this).val();
        $('.setting_cost_price').val(_price)
    });
    $('#sell_num').bind('input propertychange', function () {
        var _price = $(this).val();
        $('.setting_num').val(_price)
    });
    $('#gen_prices').bind('input propertychange', function () {
        var _price = $(this).val();
        $('.setting_general_price').val(_price)
    });
    $('#manager_prices').bind('input propertychange', function () {
        var _price = $(this).val();
        $('.setting_director_price').val(_price)
    });
    $('#manager_moneys').bind('input propertychange', function () {
        var _price = $(this).val();
        $('.setting_manager').val(_price)
    });
    $('#two_moneys').bind('input propertychange', function () {
        var _price = $(this).val();
        $('.setting_two_agent').val(_price)
    });
    $('#three_moneys').bind('input propertychange', function () {
        var _price = $(this).val();
        $('.setting_three_agent').val(_price)
    });
    /*
     省市区
     */
    //初始数据
    var areaData = Area;
    var $form;
    var form;
    var $;
    layui.use(['jquery', 'form'], function () {
        $ = layui.jquery;
        form = layui.form();
        $form = $('form');
        loadProvince();
    });
    //加载省数据   '_' + areaData[i].mallCityList.length + '_' + i +
    function loadProvince() {
        var proHtml = '';
        for (var i = 0; i < areaData.length; i++) {
            proHtml += '<option value="' + areaData[i].provinceCode + '_' + areaData[i].mallCityList.length + '_' + i + '">' + areaData[i].provinceName + '</option>';
        }
        //初始化省数据
        $form.find('select[name=province]').append(proHtml);
        form.render();
        form.on('select(province)', function (data) {
            $form.find('select[name=area]').html('<option value="">请选择县/区</option>').parent().hide();
            var value = data.value;
            var d = value.split('_');
            var code = d[0];
            var count = d[1];
            var index = d[2];
            if (count > 0) {
                loadCity(areaData[index].mallCityList);
            } else {
                $form.find('select[name=city]').parent().hide();
            }
        });
    }
    //加载市数据   '_' + citys[i].mallAreaList.length + '_' + i +
    function loadCity(citys) {
        var cityHtml = '';
        for (var i = 0; i < citys.length; i++) {
            cityHtml += '<option value="' + citys[i].cityCode + '_' + citys[i].mallAreaList.length + '_' + i + '">' + citys[i].cityName + '</option>';
        }
        $form.find('select[name=city]').html(cityHtml).parent().show();
        form.render();
        form.on('select(city)', function (data) {
            var value = data.value;
            var d = value.split('_');
            var code = d[0];
            var count = d[1];
            var index = d[2];
            if (count > 0) {
                loadArea(citys[index].mallAreaList);
            } else {
                $form.find('select[name=area]').parent().hide();

            }
        });
    }


</script>
</html>