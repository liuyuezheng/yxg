<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"F:\ayxg\public/../application/index\view\coupons\add.html";i:1552552170;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="format-detection" content="telephone=no" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <title>新增优惠券</title>

    <meta name="keywords" content="jQuery省市区三级联动" />

    <meta name="description" content="jQuery实现省、市、区三级联动的代码网上应该已经挺多了，今天群里一名成员投了篇关于省、市、区三级联动的实现代码，不同的一点是他将代码片段封装成了jQuery插件。" />


    <link rel="shortcut icon" href="favicon.ico"> <link href="/static/hplus/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link rel="stylesheet" href="/static/hplus/cations/css/sku_style.css" />
    <script src="/static/hplus/layui/assets/jquery-1.12.4.js"></script>
    <!--<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>-->
    <script type="text/javascript" src="/static/hplus/cations/js/customSku.js"></script>
    <script type="text/javascript" src="/static/hplus/cations/plugins/layer/layer.js"></script>
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
</head>
<style type="text/css">
    .control-label{
        display: inline-block;
        width: 110px;
        height:30px;

    }
    .col-sm-1{
        margin-right: -10px;
        width: 90%;
        float: right;
    }
    .release_add {
        width: 78px;
        height: 78px;
        display: flex;
        flex-direction: column;
        border: .02px solid #EBEBEB;
        margin-left: 32px;
    }
    .release_add_img {
        width: 75px;
        height: 85px;
        margin: 12px auto;
    }

    .release_add_txt {
        text-align: center;
        color: #BBBBBB;
        font-size: 14px;
    }

    element.style {
    }
    .ibox {
        clear: both;
        margin-bottom: 25px;
        margin-top: 0;
        padding: 0;
        padding-left: 50px;
    }
    .form-control, .single-line {
        background-color: #FFF;
        background-image: none;
        border: 1px solid #e5e6e7;
        border-radius: 1px;
        color: inherit;
        display: block;
        padding: 6px 12px;
        /* -webkit-transition: border-color .15s ease-in-out 0s,box-shadow .15s ease-in-out 0s; */
        width: 100%;
        font-size: 14px;
        margin-top: -36px;
    }
    .form-control{
        width: 45%;
        margin-left: 30px;
        margin-top: -35px;
    }
    .ishot{
        margin-left: 30px;
    }
    .layui-elem-field legend {
        margin-left: -9px;
        padding: 0 10px;
        font-size: 20px;
        font-weight: 300;
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
</style>
<style>

    *{ margin:0; padding:0;}

    #box{width:540px; min-height:400px; background:#FF9}


</style>
<body>



<div id="content-wrap">

    <div id="content-left" class="demo">
        <div style="margin-top: 22px;font-size: larger;font-weight:bolder;margin-left: 20px">
            新增优惠券
        </div>
        <form action="" class="form-horizontal" name="form1">

            <div class="ibox float-e-margins" style="margin-top: 40px;">

                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block">
                    <label class="col-sm-2 control-label">优惠券名称:</label>
                    <input type="text"  class="form-control"  id="name" style="margin-left: 102px" placeholder="请输入描述"  value="" >
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block;margin-left: 5px;">
                    <label class="labels" style="font-size: 16px">优惠券限制类型:</label>

                    <input  type="radio" id="line_type" name="line_type" style="margin-left: 33px" class="line_type" checked  value="0">满减限制
                    <input  type="radio"  id="line_type" name="line_type" style="margin-left: 30px" class="line_type" value="1">无满减限制
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group _prices" style="display: inline-block">
                    <label class="col-sm-2 control-label">满减金额:</label>

                    <input type="text" id="limit_money"  placeholder="请输入满减金额" class="form-control" style="margin-left: 102px" value="" >

                </div>
                <div class="hr-line-dashed" id="where" ></div>
                <div class="form-group _prices" id="whereinput" style="display: inline-block">
                    <label class="col-sm-2 control-label">满减条件:</label>

                    <input type="text" id="limit_condition"  placeholder="请输入满减条件" class="form-control" style="margin-left: 102px" value="" >

                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">优惠券类型:</label>

                    <select  style="width: 28%;margin-left: 98px;"  id="type" name="cate_id">
                        <option value="" >===请选择===</option>
                        <option value="0" >新手优惠券</option>
                        <option value="1" >赠送优惠券</option>
                    </select>

                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block">
                    <label class="col-sm-2 control-label">优惠券等级:</label>
                    <select  style="width: 40%;margin-left: 209px"  id="grade" name="cate_id">
                        <option value="0" selected >全部</option>
                        <option value="1" >普通</option>
                        <option value="2"  >总代</option>
                        <option value="3" >董事</option>
                    </select>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block;margin-left: 5px;">
                    <label class="labels" style="font-size: 16px">优惠券有效时间类型:</label>

                    <input  type="radio" id="is_hot" name="is_hot" style="margin-left: 33px" class="ishot" checked  value="0">天数
                    <input  type="radio"  id="is_hot" name="is_hot" style="margin-left: 30px" class="ishot" value="1">时间
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group day_group" style="display: inline-block">
                    <label class="col-sm-2 control-label">有效时间:</label>

                    <input type="text" id="end_time" placeholder="请输入天数" oninput="value=value.replace(/[^\d]/g,'')" class="form-control" style="margin-left: 102px" value="" >

                </div>
                <!--<div class="hr-line-dashed"></div>-->
                <div class="form-group startEnd" style="display: none;width: 100%">
                    <div class="group" style="width: 38%;float: left;margin-left: 24px;margin-top: 10px;">
                        <label class="labels" style="font-size: 16px">开始时间:</label>
                        <input type="text" id="startTime" placeholder='开始时间'>
                        <!--<input type="text" class="nsmes" placeholder="开始时间"  value="" >-->
                    </div>
                    <div class="group" style="margin-top: 10px;float: left;width: 50%">
                        <label class="labels" style="font-size: 16px;margin-left: 10px">过期时间:</label>
                        <input type="text" id="endTime" placeholder='过期时间'>
                        <!--<input type="text" class="nsmes" placeholder="结束时间"  value="" >-->
                    </div>

                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block">
                    <label class="col-sm-2 control-label">发放数量:</label>
                    <input type="text" id="num" placeholder="请输入" oninput="value=value.replace(/[^\d]/g,'')" class="form-control" style="margin-left: 102px" value="" >
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label" style="width: 23%">限制用户领取数量:</label>
                    <input type="text" id="limit_num" placeholder="1" oninput="value=value.replace(/[^\d]/g,'')" class="form-control" style="margin-left: 50px;width: 27%" value="" >
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block">
                    <label class="col-sm-2 control-label">是否发放:</label>

                    <input id="chec"  type="checkbox" class="js-switch_3"  />

                </div>
                <script>
                    var isz=0;
                    //                    console.log($(".switchery"));
                    $("#chec").change(function () {
                        console.log($(this)[0].checked);
                        if($(this)[0].checked==true){
                            isz=1;
                        }else{
                            isz=0;
                        }
//                        alert(isz);
                    });
                </script>
                <!--<script>-->
                    <!--var isz=0;-->
                    <!--//                    console.log($(".switchery"));-->
                    <!--$("#chec").change(function () {-->
                        <!--console.log($(this)[0].checked);-->
                        <!--if($(this)[0].checked==true){-->
                            <!--isz=1;-->
                        <!--}else{-->
                            <!--isz=0;-->
                        <!--}-->
<!--//                        alert(isz);-->
                    <!--});-->

                <!--</script>-->

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-3" style="height:329px">
                        <button class="btn btn-primary" style="width: 33%;height: 10%" onclick="add_goodsinfo()" type="button">添加内容</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" style="width: 20%;height: 10%" onclick="quxiao()">取消</button>
                    </div>
                </div>
            </div>
        </form>



    <div id="contentt-right"></div>

</div>
<script>
    /*function brand(obj){
     var brand_id = $(obj).find("option:selected").attr("brand-id");
     var url = "<?php echo url('Goods/model'); ?>";
     var that = $(obj);
     $.post(url, {id: brand_id}, function (data) {
     var html = "";
     html +='<option value="" model-id="">-请选择-</option>';
     if(data.length!=0){
     $.each(data, function (idx, obj) {
     html +='<option value="'+obj.id+'" model-id="'+obj.model_id+'" data-name="'+obj.name+'" data-category-name="'+obj.category_name+'">'+obj.name+'----'+obj.category_name+'</option>';
     })
     }
     that.parent().parent().find('.model').html(html);
     });
     }*/


</script>
<script type="text/javascript">
    $('[name=is_hot]').change(function () {
        var is_hotflag = $(this).val()
        if(is_hotflag == 0){
            $('.startEnd').css({
                display:'none'
            })
            $('.day_group').css({
                display:'inline-block'
            })
        }else {
            $('.startEnd').css({
                display:'inline-block'
            })
            $('.day_group').css({
                display:'none'
            })
        }
    });


    $('[name=line_type]').change(function () {
        var line_typeflag = $(this).val()
        console.log(line_typeflag);
        if(line_typeflag == 0){
            $('#where').css({
                display:'inline-block'
            })
            $('#whereinput').css({
                display:'inline-block'
            })
        }else {
            $('#where').css({
                display:'none'
            })
            $('#whereinput').css({
                display:'none'
            })
        }
    })
    var flag = 1;
    //添加优惠券
    function add_goodsinfo(){
        var status=$('#is_hot:checked').val();
        var line_type=$('#line_type:checked').val();
        // console.log(status);
        // console.log(line_type);
        // return;
        var limit_num=$("#limit_num").val();
        var end_time=$("#end_time").val();
        var start=$("#startTime").val();
        var end=$("#endTime").val();
        if(status==0){
           if(end_time == ""){
                layer.msg('请填写有效时间！', {icon: 2, shift: 6});
                return;
            }else if(parseFloat(end_time) <= 0){
                layer.msg('有效时间需大于0！', {icon: 2, shift: 6});
                return;
            }
        }else{
            if(start == ""){
                layer.msg('请填写开始时间！', {icon: 2, shift: 6});
                return;
            }
            if(end == ""){
                layer.msg('请填写过期时间！', {icon: 2, shift: 6});
                return;
            }
        }
        /*0天1时*/
//        var arr = [];
//        $.each($(".viewThumb img"),function(idnex, item){
//            arr.push(item.src)
//        })
        var name=$("#name").val();
        var limit_money=$("#limit_money").val();
        var limit_condition=$("#limit_condition").val();
        var num=$("#num").val();

        var type=$("#type option:selected").val();
        var grade=$("#grade option:selected").val();
        if(line_type==0){
            if(limit_condition == ""){
                layer.msg('请填写满减条件！', {icon: 2, shift: 6});
                return
            }
            if(parseFloat(limit_money)>=parseFloat(limit_condition)){
                layer.msg('满减金额需小于满减条件！', {icon: 2, shift: 6});
                return
            }
        }
        if(name == "" ){
            layer.msg('请填写优惠券名称！', {icon: 2, shift: 6});
            return
        }else if(limit_money == ""){
            layer.msg('满减金额！', {icon: 2, shift: 6});
            return
        }else if(type == ""){
            layer.msg('请选择优惠券类型！', {icon: 2, shift: 6});
            return
        }else{
            if(flag){
                flag = 0;
                $.ajax({
                    url: '<?php echo url("coupons/adds"); ?>',
                    type: "post",
                    data: {
                        is_putaway:isz,
                        name:name,
                        limit_money:limit_money,
                        limit_condition:limit_condition,
                        num:num,
                        end_time:end_time,
                        type:type,
                        grade:grade,
                        line_type:line_type,
                        status:status,
                        end:end,
                        start:start,
                        limit_num:limit_num
                    },
                    dataType: "json",
                    success: function (data) {
                        flag = 0;
                        console.log(data);
                        if (data.code === 1) {
                            layer.msg(data.msg, {icon: 1, shift: 6});
                            window.parent.location.reload();
                        } else {
                            layer.msg(data.msg, {icon: 2, shift: 6});
                        }
                    },
                    error: function (e) {
                        flag = 0;
                        layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
                    }
                });
            }

        }
//       alert(goods_id);

    }
    //输入框只能输入数字且小数点只能有两位
    $('._prices input').on('input',function () {
        console.log($(this).val())
        function num(obj){
            obj.val(obj.val().replace(/[^\d.]/g,"")); //清除"数字"和"."以外的字符
            obj.val(obj.val().replace(/^\./g,"")); //验证第一个字符是数字
            obj.val(obj.val().replace(/\.{2,}/g,".")); //只保留第一个, 清除多余的
            obj.val(obj.val().replace(".","$#$").replace(/\./g,"").replace("$#$","."));
            obj.val(obj.val().replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3')); //只能输入两个小数
        }
        num($(this))
    });
    //取消添加
    function quxiao(){
        window.parent.location.reload();
    }

    /*时间插件*/
    var startTime =laydate.render({
        elem: '#startTime',
        type: 'datetime',
        min: 0,
        max: '2035-12-31 12:30:00',
        done: function(value, date, endDate) {
            endLayDate.config.min = {
                year: date.year,
                month: date.month - 1,
                date: date.date,
                hours: date.hours,
                minutes: date.minutes,
                seconds: date.seconds +1
            };
        }
    });
    /*时间插件*/
    var endLayDate = laydate.render({
        elem: '#endTime',
        type: 'datetime',
        max: '2035-12-31 12:30:00',
        btns: ['clear', 'confirm'],  //clear、now、confirm
        done: function(value, date, endDate) {
            startTime.config.max = {
                year: date.year,
                month: date.month - 1,
                date: date.date,
                hours: date.hours,
                minutes: date.minutes,
                seconds: date.seconds -1
            };
        }
    });

    $('#test').diyUpload({

        url:"<?php echo url('goodsinfo/upload_image'); ?>",

        success:function( data ) {
            console.log("111")
            console.info( data );

        },

        error:function( err ) {

            console.info( err );

        }

    });


    $('#as').diyUpload({

        url:"<?php echo url('goodsinfo/upload_image'); ?>",

        success:function( data ) {
            console.log("222")
            console.info( data );

        },

        error:function( err ) {

            console.info( err );

        },

        buttonText : '选择文件',

        chunked:true,

        // 分片大小

        chunkSize:512 * 1024,

        //最大上传的文件数量, 总文件大小,单个文件大小(单位字节);

        fileNumLimit:50,

        fileSizeLimit:500000 * 1024,

        fileSingleSizeLimit:50000 * 1024,

        accept: {},

    });

</script>


</body>

</html>

