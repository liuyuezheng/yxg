<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"F:\ayxg\public/../application/index\view\category\add.html";i:1552299092;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="format-detection" content="telephone=no" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <title>添加栏目</title>

    <meta name="keywords" content="jQuery省市区三级联动" />

    <meta name="description" content="jQuery实现省、市、区三级联动的代码网上应该已经挺多了，今天群里一名成员投了篇关于省、市、区三级联动的实现代码，不同的一点是他将代码片段封装成了jQuery插件。" />

    <link rel="shortcut icon" href="/static/hplus/favicon.ico">
    <link href="/static/hplus/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/static/hplus/css/animate.min.css" rel="stylesheet">
    <link href="/static/hplus/css/style.min862f.css?v=4.1" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/static/hplus/diyUpload/css/webuploader.css">
    <link rel="stylesheet" type="text/css" href="/static/hplus/diyUpload/css/diyUpload.css">
    <script type="text/javascript" src="/static/hplus/js/jquery.min.js"></script>
    <script src="/static/hplus/layer/layer.js"></script>
    <script type="text/javascript" src="/static/hplus/diyUpload/js/webuploader.html5only.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/hplus/layui/css/layui.css">
    <script type="text/javascript" src="/static/hplus/layui/layui.all.js"></script>
    <script type="text/javascript" src="/static/hplus/diyUpload/js/diyUpload.js?v=111"></script>

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
        <div style="margin-top: 22px;font-size: larger;font-weight:bolder;margin-left: 17px">
            添加栏目<span style="color: red">注意：如不选择上级分类，默认为一级分类</span>
        </div>
        <form action="" class="form-horizontal" name="form1">

            <div class="ibox float-e-margins" style="margin-top: 40px;">

                <div class="hr-line-dashed"></div>
                <div style="display: inline-block;width: 433px;">
                    <label >上级分类:</label>

                    <select  style="width: 25%;margin-left: 33px"  id="supplier_id" name="cate_id" onchange="handleFirst()">
                        <option value="" >===请选择===</option>
                        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>

                        <option value="<?php echo $v['id']; ?>" ><?php echo $v['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </select>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block">
                    <label class="col-sm-2 control-label">栏目名称:</label>
                    <input type="text" id="name" name="name" class="form-control"  style="margin-left: 102px" placeholder="请输入栏目名称"  value="" >
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block">
                    <label class="col-sm-2 control-label">排序:</label>

                    <input type="text" id="sort" placeholder="请输入数字" class="form-control"  oninput="value=value.replace(/[^\d]/g,'')" style="margin-left: 102px" value="" >

                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">

                    <div class="layui-upload">
                        <button type="button" class="layui-btn" id="upload">单图片上传</button>
                        <div class="layui-upload-list" id="imgsrc" style="padding-left:70px;">
                            <!-- <img class="layui-upload-img"  style="border-style:none" src="" id="showImg" width="200">
                             <input type="hidden" name="pic" id="path">-->
                        </div>
                        <span style="color: red">注意:建议轮播图比例  348*200，不然会失真</span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-3" style="height:329px">
                        <button class="btn btn-primary" style="width: 10%;height: 10%" onclick="add_goodsinfo()" type="button">添加内容</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" style="width: 10%;height: 10%" onclick="quxiao()">取消</button>
                    </div>
                </div>
        </form>

    </div>

    <div id="contentt-right"></div>

</div>
<script>
    function handleFirst(){
        var checkText=$("#supplier_id").find("option:selected").text(); //获取Select选择的Text
        var checkValue=$("#supplier_id").val();
        //$("#tesetSelect").find("option:selected").text();//选中的文本

//       var is =$("#tesetSelect").find("option:selected").val();
//       alert(checkValue);
    }
</script>
<script type="text/javascript">
    layui.use(['form', 'upload'], function(){
        var form = layui.form, $ = layui.jquery, upload = layui.upload;
        upload.render({
            elem: '#upload'
            ,url: '<?php echo url("index/index/upload"); ?>'
            ,multiple: false
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
//                    $('#showImg').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                console.log(res);
                //如果上传失败
                if(res.code == 0){
                    return layer.msg('上传失败');
                }else{
                    var str='<img class="layui-upload-img"  style="border-style:none" src="'+res.name+'" id="showImg" width="200"><input type="hidden" name="pic" id="path" value="'+res.name+'">'
                    $('#imgsrc').html(str);
                }
                //上传成功
//                        $('#path').val(res.data.src); // 将上传后的图片路径赋值给隐藏域
            }
        });
    });
</script>
<script type="text/javascript">
    //添加供应商
    function add_goodsinfo(){
//        var arr = [];


        if($("#supplier_id option:selected").val() == "===请选择==="){
            layer.msg('分类名称不能为空！', {icon: 2, shift: 6});
            return;
        }else if($('#name').val() == ""){
            layer.msg('栏目名称不能为空！', {icon: 2, shift: 6});
            return;
        }//else if(arr.length == 0){
        //      layer.msg('商品图片不能为空！', {icon: 2, shift: 6});
        // }
        else if($('#sort').val() == ""){
            layer.msg('排序不能为空！', {icon: 2, shift: 6});
            return;
        }else if(parseFloat($('#sort').val()) > 999999){
            layer.msg('排序不能大于999999！', {icon: 2, shift: 6});
            return;
        }else if($('#path').val()==""){
            layer.msg('请选择图片！', {icon: 2, shift: 6});
            return;
        }else{
           var pid=$("#supplier_id option:selected").val();
           var name=$('#name').val();
            var sort=$('#sort').val();
            var pic=$("#path").val();
//            console.log(arr);
//            arr.push('pid',$("#supplier_id option:selected").val());
//            var data = $(".form-horizontal").serializeArray();
            $.ajax({
                url: '<?php echo url("category/adds"); ?>',
                type: "post",
                data: {
                    pid:pid,
                    name:name,
                    sort:sort,
                    pic:pic
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    if (data.code === 1) {
                        layer.msg(data.msg, {icon: 1, shift: 6});
                        window.parent.location.reload();
                    } else {
                        layer.msg(data.msg, {icon: 2, shift: 6});
                    }
                },
                error: function (e) {
                    layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
                }
            });
        }
    }


    //取消添加
    function quxiao(){
        window.parent.location.reload();
    }


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

