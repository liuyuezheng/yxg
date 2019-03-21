<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"F:\ayxg\public/../application/index\view\users\edits.html";i:1553046479;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>修改用户信息</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/static/hplus/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="/static/hplus/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <script src="/static/hplus/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/hplus/laydate/laydate.js"></script>
    <script src="/static/hplus/layer/layer.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/hplus/layui2/css/layui.css">
    <script type="text/javascript" src="/static/hplus/layui2/layui.js"></script>
    <link href="/static/hplus/jquerySelect/css/select-addl.min.css" rel="stylesheet">
    <link href="/static/hplus/jquerySelect/css/select.min.css" rel="stylesheet">

</head>
<script type="text/javascript">
    var s2options_c4acac00 = {"themeCss":".select2-container--krajee","sizeCss":"","doReset":true,"doToggle":true,"doOrder":false};
    window.select2_5eaa6d36 = {"theme":"krajee","width":"100%","placeholder":"请选择优惠券","language":"zh-CN"};
</script>
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
    .select2-search__field{
        width:100% !important;
    }
</style>
<style>

    *{ margin:0; padding:0;}

    #box{width:540px; min-height:400px; background:#FF9}


</style>
<body>



<div id="content-wrap">

    <div id="content-left" class="demo">
        <div style="margin-top: 22px;font-size: larger;margin-left:15px;font-weight:bolder">
            修改用户信息
        </div>
        <form action="" class="form-horizontal" name="form1">
            <div class="ibox float-e-margins" style="margin-top: 40px;">

                <div class="hr-line-dashed"></div>
                <div class="form-group" style="width:100%;display: inline-block">
                    <label class="col-sm-2 control-label">权限调整设置:</label>
                    <select  style="width: 11%;margin-left: -1px"  id="grade" name="grade">
                        <?php if($user_info['grade'] == '0'): ?>
                        <option value="0" selected="selected" >普通用户</option>
                        <option value="1" >总代</option>
                        <option value="2" >董事</option>
                        <?php endif; if($user_info['grade'] == '1'): ?>
                        <option value="1"  selected="selected">总代</option>
                        <option value="0"  >普通用户</option>
                        <option value="2"  >董事</option>
                        <?php endif; if($user_info['grade'] == '2'): ?>
                        <option value="2"  selected="selected">董事</option>
                        <option value="0" >普通用户</option>
                        <option value="1" >总代</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block">
                    <label class="col-sm-2 control-label">用户积分:</label>
                    <?php echo $user_info['integral']; ?>

                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">增加积分:</label>
                    <input type="text" id="addintegral" class="form-control _prices" placeholder="0" oninput="value=value.replace(/[^0-9]/g,'')" style="margin-left: 102px;width: 100px" value="" >
                    <input type="text" id="whyaddintegral"  class="form-control" placeholder="积分调整备注" style="margin-left: 249px;margin-top: -32px;width: 200px" value="" >
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">减少积分:</label>
                    <input type="text" id="jianintegral" class="form-control _prices" placeholder="0" oninput="value=value.replace(/[^0-9]/g,'')" style="margin-left: 102px;width: 100px" value="" >
                    <input type="text" id="whyjianintegral"  class="form-control" placeholder="积分调整备注" style="margin-left: 249px;margin-top: -32px;width: 200px" value="" >
                </div>
                <?php if(($user_info['grade'] == 0)): ?>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">

                    <label class="col-sm-2 control-label">用户余额:</label>
                    ￥<?php echo $user_info['balance']; ?>

                </div>
                <?php else: ?>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">

                    <label class="col-sm-2 control-label">用户余额:</label>
                    ￥<?php echo $user_info['balance']; ?>

                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">

                    <label class="col-sm-2 control-label">用户佣金:</label>

                    ￥<?php echo $user_info['brokerage']; ?>


                </div>
                <?php endif; ?>
                <!--<?php echo $user_info['balance']; ?>-->
                <?php if(($user_info['grade'] == 0)): ?>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">增加余额:</label>
                    <input type="text" id="addbrokerage" class="form-control _prices" placeholder="0" style="margin-left: 102px;width: 100px" value="" >
                    <input type="text" id="why1"  class="form-control" placeholder="余额调整备注" style="margin-left: 249px;margin-top: -32px;width: 200px" value="" >
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">减少余额:</label>
                    <input type="text" id="jianbrokerage" class="form-control _prices" placeholder="0" style="margin-left: 102px;width: 100px" value="" >
                    <input type="text" id="why2"  class="form-control" placeholder="余额调整备注" style="margin-left: 249px;margin-top: -32px;width: 200px" value="" >
                </div>
                <?php else: ?>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">增加余额:</label>
                    <input type="text" id="addbrokerage2" class="form-control _prices" placeholder="0" style="margin-left: 102px;width: 100px" value="" >
                    <input type="text" id="title"  class="form-control" placeholder="余额调整备注" style="margin-left: 249px;margin-top: -32px;width: 200px" value="" >
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">减少余额:</label>
                    <input type="text" id="jianbrokerage2" class="form-control _prices" placeholder="0" style="margin-left: 102px;width: 100px" value="" >
                    <input type="text" id="title2"  class="form-control" placeholder="余额调整备注" style="margin-left: 249px;margin-top: -32px;width: 200px" value="" >
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">增加佣金:</label>

                    <input type="text" id="addbrokerage" class="form-control _prices" placeholder="0" style="margin-left: 102px;width: 100px" value="" >
                    <input type="text" id="why1" class="form-control" placeholder="佣金调整备注" style="margin-left: 249px;margin-top: -32px;width: 200px" value="" >

                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">减少佣金:</label>

                    <input type="text" id="jianbrokerage" class="form-control _prices" placeholder="0" style="margin-left: 102px;width: 100px" value="" >
                    <input type="text" id="why2" class="form-control" placeholder="佣金调整备注" style="margin-left: 249px;margin-top: -32px;width: 200px" value="" >


                </div>
                <?php endif; ?>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block;width: 100%">
                    <div style="float: left; width: 20%">
                        <label class="font-noraml">选择优惠券：</label>
                    </div>
                    <div style="float: left; width: 75%;margin-top: -10px">

                        <select id="w1" class="form-control" name="category_id[]" multiple size="4" placeholder="请选择优惠券" data-s2-options="s2options_c4acac00" data-krajee-select2="select2_5eaa6d36" style="display:none;width:100%;">
                            <?php if(empty($coupons_info) || (($coupons_info instanceof \think\Collection || $coupons_info instanceof \think\Paginator ) && $coupons_info->isEmpty())): ?>

                            <option value="" >无</option>

                            <?php else: if(is_array($coupons_info) || $coupons_info instanceof \think\Collection || $coupons_info instanceof \think\Paginator): if( count($coupons_info)==0 ) : echo "" ;else: foreach($coupons_info as $key=>$vl): ?>
                            <option value="<?php echo $vl['id']; ?>" ><?php echo $vl['name']; ?>--满<?php echo $vl['limit_condition']; ?>减<?php echo $vl['limit_money']; ?>--（<?php echo $vl['line_type']; ?>）</option>
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>


                        </select>
<div>
                </div>
                </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="    text-align: center;">
                    <div class="col-sm-4 col-sm-offset-3" style="height:329px">
                        <button class="btn btn-primary" style="width: 16%;height: 10%" onclick="edit_user(this)" data-id="<?php echo $user_info['id']; ?>" type="button">确认</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" style="width: 16%;height: 10%" onclick="quxiao()">取消</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <script src="/static/hplus/js/jquery.min.js?v=2.1.4"></script>
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
    <script src="/static/hplus/jquerySelect/js/select2.full.min.js"></script>
    <script src="/static/hplus/jquerySelect/js/select2-krajee.min.js"></script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    <script src="/static/hplus/js/plugins/layer/laydate/laydate.js"></script>
    <script src="/static/hplus/layer/layer.js"></script>
    <div id="contentt-right"></div>

</div>
<script>
    if (jQuery('#w1').data('select2')) { jQuery('#w1').select2('destroy'); }
    jQuery.when(jQuery('#w1').select2(select2_5eaa6d36)).done(initS2Loading('w1','s2options_c4acac00'));

    /*获取选中的id值*/
   /* $("#Btn").click(function(){
        var val = $("#w1").val();
        console.log($("#w1"));
        console.log(val);
        // alert(val);
    })*/
</script>

<script type="text/javascript">
    //输入框只能输入数字且小数点只能有两位
    $('._prices').on('input',function () {
        console.log($(this).val())
        function num(obj){
            obj.val(obj.val().replace(/[^\d.]/g,"")); //清除"数字"和"."以外的字符
            obj.val(obj.val().replace(/^\./g,"")); //验证第一个字符是数字
            obj.val(obj.val().replace(/\.{2,}/g,".")); //只保留第一个, 清除多余的
            obj.val(obj.val().replace(".","$#$").replace(/\./g,"").replace("$#$","."));
            obj.val(obj.val().replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3')); //只能输入两个小数
        }
        num($(this))
    })
    function show_coupons(show_coupons) {
        var coupon=$(".chosen-choices li span").text();
        console.log(coupon);
    }
    var flag = 1
    //修改用户信息
    function edit_user(edit_user){
//        优惠券
        var coupons = $("#w1").val();
         console.log(coupons);

//        权限身份
        var grade=$("#grade option:selected").val();
//        积分
//        var integral=$("#integral").val();
//        积分 增加数据
        var addintegral=$("#addintegral").val();
//        积分 减少数据
        var jianintegral=$("#jianintegral").val();
//        积分 增加数据备注
        var whyaddintegral=$("#whyaddintegral").val();
//        积分 减少数据备注
        var whyjianintegral=$("#whyjianintegral").val();
//        佣金 余额增加数据
        var addbrokerage=$("#addbrokerage").val();
//        佣金 余额增加原因
        var why1=$("#why1").val();
//       佣金 余额减少数据
        var jianbrokerage=$("#jianbrokerage").val();
//        佣金 余额减少原因
        var why2=$("#why2").val();
        //      余额减少数据
        var jianbrokerage2=$("#jianbrokerage2").val();
        //     余额增加数据
        var addbrokerage2=$("#addbrokerage2").val();
        var title=$("#title").val();
        var title2=$("#title2").val();
        if(addintegral!="" && jianintegral!=""){
            layer.msg("请选填增加和减少其中一项", {icon: 2, shift: 6});
            return;
        }
        if(whyaddintegral!="" && whyjianintegral!=""){
            layer.msg("请选填增加和减少备注之一", {icon: 2, shift: 6});
            return;
        }
        if (typeof jianbrokerage2 != "undefined") {
            if(addbrokerage2!="" && jianbrokerage2!=""){
                layer.msg("请选填增加和减少其中一项", {icon: 2, shift: 6});
                return;
            }
            if(title!="" && title2!=""){
                layer.msg("请选填增加和减少备注之一", {icon: 2, shift: 6});
                return;
            }
        }
        if (typeof addbrokerage2 != "undefined") {
            if(addbrokerage2!="" && jianbrokerage2!=""){
                layer.msg("请选填增加和减少其中一项", {icon: 2, shift: 6});
                return;
            }
            if(title!="" && title2!=""){
                layer.msg("请选填增加和减少备注之一", {icon: 2, shift: 6});
                return;
            }
        }

        if(addbrokerage!="" && jianbrokerage!=""){
            layer.msg("请选填增加和减少其中一项", {icon: 2, shift: 6});
            return;
        }
        if(why1!="" && why2!=""){
            layer.msg("请选填增加和减少备注之一", {icon: 2, shift: 6});
            return;
        }
//        用户
        var user_id = $(edit_user).attr('data-id');
        if(coupons !=null){
            if(coupons.length>3){
                layer.msg("优惠券最多选择三张", {icon: 2, shift: 6});
                return;
            }
        }
        console.log(flag)
        if(flag){
            flag = 0
//            return
            $.ajax({
                url: '<?php echo url("users/edit"); ?>',
                type: "post",
                data: {
                    coupons:coupons,
                    grade:grade,
                    addintegral:addintegral,
                    jianintegral:jianintegral,
                    whyaddintegral:whyaddintegral,
                    whyjianintegral:whyjianintegral,
                    addbrokerage:addbrokerage,
                    why1:why1,
                    jianbrokerage:jianbrokerage,
                    why2:why2,
                    addbrokerage2:addbrokerage2,
                    title:title,
                    jianbrokerage2:jianbrokerage2,
                    title2:title2,
                    user_id:user_id
                },
                dataType: "json",
                success: function (data) {
                    flag = 1
                    console.log(data);
                    if (data.code === 1) {
                        layer.msg(data.msg, {icon: 1, shift: 6});
                        window.parent.location.reload();
                    } else {
                        layer.msg(data.msg, {icon: 2, shift: 6});
                    }
                },
                error: function (e) {
                    flag = 1
                    layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
                }
            });
        }
        /*  if(name == "" ){
            layer.msg('请填写优惠券名称！', {icon: 2, shift: 6});
        }else if(limit_money == ""){
            layer.msg('满减金额！', {icon: 2, shift: 6});
        }else if(limit_condition == ""){
            layer.msg('请填写满减条件！', {icon: 2, shift: 6});
        }else if(type == ""){
            layer.msg('请选择优惠券类型！', {icon: 2, shift: 6});
        }else if(end_time == ""){
            layer.msg('请填写有效时间！', {icon: 2, shift: 6});
        }else if(num == ""){
            layer.msg('请填写发放数量！', {icon: 2, shift: 6});
        }else{*/

//        }

    }

    //取消修改
    function quxiao(){
        window.parent.location.reload();
    }







</script>


</body>

</html>

