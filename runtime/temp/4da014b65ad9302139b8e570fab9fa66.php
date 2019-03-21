<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"F:\ayxg\public/../application/index\view\describe\add.html";i:1552478797;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="format-detection" content="telephone=no" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <title>新增轮播图</title>

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
      <div style="margin-top: 22px;margin-left: 15px;font-size: larger;font-weight:bolder">
        新增轮播图<span style="color: red">注意：如同时选择内部商品和填写外部链接，默认内部商品为准</span>
      </div>
        <form action="" class="form-horizontal" name="form1">

            <div class="ibox float-e-margins" style="margin-top: 40px;">
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
                <div class="form-group" style="display: inline-block">
                    <label class="col-sm-2 control-label">描述:</label>
                    <input type="text"  class="form-control"  id="describe" style="margin-left: 102px" placeholder="请输入描述"  value="" >
                </div>
                <div class="hr-line-dashed"></div>
                <div style="display: inline-block;width: 100%">
                   <!-- <label >关联商品:</label>-->
                    <label class="col-sm-2 control-label">关联商品:</label>
                    <input type="text"    id="goods" style="width: 20%;height: 30px" placeholder="请输入商品名称"  value="" >
                <!--    <input placeholder="请输入商品名称" id="goods" value="" style="width: 17%">-->
                    <button type="button" onclick="search()" style=" margin-left: 14px; width: 8%;height: 30px" class="btn btn-sm btn-primary">
                        搜索
                    </button>
                </div>
                <div class="form-group " id="goodsList" style="display: inline-block;width: 100%">

                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group" style="display: inline-block;width: 100%">
                    <label class="col-sm-2 control-label">关联链接:</label>

                     <!--   <input type="text" id="link" placeholder="请输入链接" class="form-control" style="margin-left: 102px" value="" >-->
                    <input type="text" id="link" placeholder="请输入链接" class="form-control" style="margin-left: 102px;width: 25%" value="" > &nbsp;&nbsp;<span style="color: red">注意:此为外部链接（小程序中无法使用，公众号可使用）</span>

                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-3" style="height:329px">
                        <button class="btn btn-primary" style="width: 10%;height: 10%" onclick="add_goodsinfo()" type="button">添加内容</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" style="width: 10%;height: 10%" onclick="quxiao()">取消</button>
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
//    $('#showImg').disabled="none";
    function handleFirst(obj){
        var cate_id = $(obj).find("option:selected").val();
//        alert(cate_id);
        var url = "<?php echo url('describe/second'); ?>";
        var that = $(obj);
        $.post(url, {cate_id: cate_id}, function (data) {
            var html = "";
            html +='<option value="">二级分类</option>';
            if(data.length!=0){
                $.each(data, function (idx, obj) {
                    html +='<option value="'+obj.id+'">'+obj.name+'</option>';
                })
            }
            that.parent().find('#supplier_id2').html(html);
        });
    }
    function handleSecond(obj){
        var cate_id = $(obj).find("option:selected").val();
//        alert(cate_id);
        var url = "<?php echo url('describe/goods'); ?>";
        var that = $(obj);
        $.post(url, {cate_id: cate_id}, function (data) {
            var html = "";
            html +='<option value="">选择商品</option>';
            if(data.length!=0){
                $.each(data, function (idx, obj) {
                    html +='<option value="'+obj.id+'">'+obj.name+'</option>';
                })
            }
            that.parent().find('#supplier_id3').html(html);
        });
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
    function search() {
        var goods=$('#goods').val();
         if(goods==""){
             layer.msg('请填写商品名！', {icon: 2, shift: 6});
             return;
         }else{

             $.ajax({
                 url: '<?php echo url("describe/goods"); ?>',
                 type: "post",
                 data: {
                     goods:goods
                 },
                 dataType: "json",
                 success: function (data) {
//                        flag2 = 0;
                     console.log(data);
                     if (data.code === 1){
                         var html="";
                         data.data.forEach(function (val,index) {
                             html+= ' <div style="margin: 10px 0;"><input type="radio" name="name" value="'+val.id+'"> <div style="display: inline-block">'+val.name+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;商品编号：'+val.goods_number+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价格：'+val.goods_price+'</div></div>'
                         })
                         $("#goodsList").html(html);
                     }else {
                         layer.msg(data.msg, {icon: 2, shift: 6});
                     }
                 },
                 error: function (e) {
//                        flag2 = 0;
                     layer.msg('服务器异常，请重试', {icon: 2, shift: 6});
                 }
             });
         }


    }
</script>
<script type="text/javascript">
    //添加轮播图
    function add_goodsinfo(){
//        var arr = [];
//        $.each($(".viewThumb img"),function(idnex, item){
//            arr.push(item.src)
//        })
//        console.log($('input:radio:checked').val());
//        return
        var pic=$("#path").val();
        var describe=$("#describe").val();
        var goods_id=$('input:radio:checked').val();
        var link=$("#link").val();
        if(goods_id == "" && link == ""){
            layer.msg('请填写商品或链接！', {icon: 2, shift: 6});
        }else if(describe == ""){
            layer.msg('请填写描述！', {icon: 2, shift: 6});
        }else if(pic == ""){
            layer.msg('请选择轮播图！', {icon: 2, shift: 6});
        }else{
            $.ajax({
                url: '<?php echo url("describe/adds"); ?>',
                type: "post",
                data: {
                    pic:pic,
                    describe:describe,
                    goods_id:goods_id,
                    link:link
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

