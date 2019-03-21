<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"F:\ayxg\public/../application/index\view\users\editup.html";i:1552878697;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>修改上级</title>
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
            修改上级
        </div>

        <form action="" class="form-horizontal" name="form1">
            <div class="ibox float-e-margins" style="margin-top: 40px;">

                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">用户原上级:</label>
                    <?php if(empty($oldpid) || (($oldpid instanceof \think\Collection || $oldpid instanceof \think\Paginator ) && $oldpid->isEmpty())): ?>
                     无
                    <?php else: ?>
                     <?php echo $oldpid['nickname']; endif; ?>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">设置上级用户:</label>
                    <input type="hidden" id="user_id" value="<?php echo $olduser['id']; ?>">
                    <input type="hidden" id="puser_id" value="<?php echo $olduser['pid']; ?>">
                    <input placeholder="请输入修改的上级用户手机号" id="phone" value="" style="width: 17%"> <button type="button" onclick="search()" style=" margin-left: 14px; width: 10%" class="btn btn-sm btn-primary">
                    搜索
                </button>
                </div>
                <div class="form-group " id="head" style="display: inline-block;width: 100%">
                    <!--kkkk-->
                    <!--<label class="col-sm-2 control-label"></label>-->
                </div>
            <!--    <div class="form-group" style="    text-align: center;">
                    <div class="col-sm-4 col-sm-offset-3" style="height:329px">
                        <button class="btn btn-primary" style="width: 16%;height: 10%" onclick="edit_user(this)" data-pid="<?php echo $olduser['pid']; ?>"  data-id="<?php echo $olduser['id']; ?>" type="button">确认</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" style="width: 16%;height: 10%" onclick="quxiao()">取消</button>
                    </div>
                </div>-->
         <!--       <div class="form-group" style="width:100%;display: inline-block">
                    <label class="col-sm-2 control-label">选择上级:</label>
                    <select  style="width: 11%;margin-left: -1px"  id="grade" name="grade">
                        <?php if(empty($oldpid) || (($oldpid instanceof \think\Collection || $oldpid instanceof \think\Paginator ) && $oldpid->isEmpty())): ?>
                        <option value="0" selected="selected" >无</option>
                        <?php else: ?>
                        <option value="<?php echo $oldpid['id']; ?>" selected="selected" ><?php echo $oldpid['nickname']; ?></option>
                        <?php endif; if(is_array($puser) || $puser instanceof \think\Collection || $puser instanceof \think\Paginator): if( count($puser)==0 ) : echo "" ;else: foreach($puser as $key=>$v1): ?>
                        <option value="<?php echo $v1['id']; ?>" ><?php echo $v1['nickname']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>-->
                <div class="hr-line-dashed"></div>
                <div class="form-group " style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">用户名称:</label>
                    <?php echo $olduser['nickname']; ?>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">用户身份:</label>
                    <?php echo $olduser['grade']; ?>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="    text-align: center;">
                    <div class="col-sm-4 col-sm-offset-3" style="height:329px">
                        <button class="btn btn-primary" style="width: 16%;height: 10%" onclick="edit_user(this)" data-pid="<?php echo $olduser['pid']; ?>"  data-id="<?php echo $olduser['id']; ?>" type="button">确认</button>
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
    });
    var flag2 = 1;
    function search() {
        var phone=$('#phone').val();
        var user_id=$('#user_id').val();
        var puser_id=$('#puser_id').val();

//        var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
        var pattern = /^1[3456789]\d{9}$/;
//        console.log(phone);
        console.log(pattern.test(phone));
        if(pattern.test(phone)){
//            if(flag2){
//                flag2 = 0;
//            return
                $.ajax({
                    url: '<?php echo url("users/showup"); ?>',
                    type: "post",
                    data: {
                        phone:phone,
                        id:user_id,
                        pid:puser_id
                    },
                    dataType: "json",
                    success: function (data) {
//                        flag2 = 0;
                        console.log(data);
                        if (data.code === 1){
                            var html="<img style='margin-left: 112px;width: 50px' src='"+data.data.head_image+"'><span>"+data.data.nickname+"</span><input type='hidden' id='pid' value='"+data.data.id+"'>";
                            $("#head").html(html);
                        }else {
                            layer.msg(data.msg, {icon: 2, shift: 6});
                        }
                    },
                    error: function (e) {
//                        flag2 = 0;
                        layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
                    }
                });
//            }

        }else{
            layer.msg('手机号格式有误', {icon: 2, shift: 6});
        }

    }
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

//        选择上级
        var pid=$("#pid").val();
//        用户
        var user_id = $(edit_user).attr('data-id');
        var user_oldpid=$(edit_user).attr('data-pid');
        if(user_oldpid==pid){
            layer.msg('无改变', {icon: 1, shift: 6});
            window.parent.location.reload();
            return;
        }
        console.log(flag)
        if(flag){
            flag = 0
//            return
            $.ajax({
                url: '<?php echo url("users/uplink"); ?>',
                type: "post",
                data: {
                    id:user_id,
                    pid:pid
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

