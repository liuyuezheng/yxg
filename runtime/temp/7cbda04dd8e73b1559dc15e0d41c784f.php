<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"F:\ayxg\public/../application/index\view\order\editopinion.html";i:1551168665;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改评论</title>
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
<body>
<div style="margin: 20px 82px;">
    评论内容：<textarea id="content"><?php echo $opinions['content']; ?></textarea>


</div>
<div style="margin: 10px 200px;">
    <div class="layui-upload">
        <button type="button" class="layui-btn layui-btn-primary pull-left" id="slide-pc">评论图</button>
        <div class="pic-more">
            <ul class="pic-more-upload-list" id="slide-pc-priview">

            <?php if(is_array($opinions['images']) || $opinions['images'] instanceof \think\Collection || $opinions['images'] instanceof \think\Paginator): $i = 0; $__LIST__ = $opinions['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;if(empty($v1) || (($v1 instanceof \think\Collection || $v1 instanceof \think\Paginator ) && $v1->isEmpty())): ?>
                 <li class="item_img" style="    padding: 26px;"></li>

                <?php else: ?>
                <li class="item_img">
                    <div class="operate">
                        <i class="toleft layui-icon"></i>
                        <i class="toright layui-icon"></i>
                        <i  class="close layui-icon" style="margin-right: 400px;"></i>
                    </div>
                    <img src="<?php echo $v1; ?>" style="width: 150px;height: 150px" class="img" >
                    <input type="hidden" name="pics[]" value="<?php echo $v1; ?>" />
                </li>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>

            </ul>


        </div>
    </div>

</div>
<!--goods_intro-->
<div style="margin: 10px 100px;">
    <input type="hidden" id="maijia" value="<?php echo $opinions['seller_server']; ?>">
    卖家服务：
    <?php if(($opinions['seller_server'] == 0)): ?>
    <img src="/static/icon_star2.svg" onclick="checked(1,this)" class="startshow1" showstart="1"/>
    <img src="/static/icon_star2.svg" onclick="checked(2,this)" class="startshow2" showstart="1"/>
    <img src="/static/icon_star2.svg" onclick="checked(3,this)" class="startshow3" showstart="1"/>
    <img src="/static/icon_star2.svg" onclick="checked(4,this)" class="startshow4" showstart="1"/>
    <img src="/static/icon_star2.svg" onclick="checked(5,this)" class="startshow5" showstart="1">
    <?php elseif(($opinions['seller_server'] == 1)): ?>
    <img src="/static/icon_star1.svg" onclick="checked(1,this)" class="startshow1" showstart="2"/>
    <img src="/static/icon_star2.svg" onclick="checked(2,this)" class="startshow2" showstart="1"/>
    <img src="/static/icon_star2.svg" onclick="checked(3,this)" class="startshow3" showstart="1"/>
    <img src="/static/icon_star2.svg" onclick="checked(4,this)" class="startshow4" showstart="1"/>
    <img src="/static/icon_star2.svg" onclick="checked(5,this)" class="startshow5" showstart="1">
    <?php elseif(($opinions['seller_server'] == 2)): ?>
    <img src="/static/icon_star1.svg" onclick="checked(1,this)" class="startshow1" showstart="2"/>
    <img src="/static/icon_star1.svg" onclick="checked(2,this)" class="startshow2" showstart="2"/>
    <img src="/static/icon_star2.svg" onclick="checked(3,this)" class="startshow3" showstart="1"/>
    <img src="/static/icon_star2.svg" onclick="checked(4,this)" class="startshow4" showstart="1"/>
    <img src="/static/icon_star2.svg" onclick="checked(5,this)" class="startshow5" showstart="1">
    <?php elseif(($opinions['seller_server'] == 3)): ?>
    <img src="/static/icon_star1.svg" onclick="checked(1,this)" class="startshow1" showstart="2"/>
    <img src="/static/icon_star1.svg" onclick="checked(2,this)" class="startshow2" showstart="2"/>
    <img src="/static/icon_star1.svg" onclick="checked(3,this)" class="startshow3" showstart="2"/>
    <img src="/static/icon_star2.svg" onclick="checked(4,this)" class="startshow4" showstart="1"/>
    <img src="/static/icon_star2.svg" onclick="checked(5,this)" class="startshow5" showstart="1">
    <?php elseif(($opinions['seller_server'] == 4)): ?>
    <img src="/static/icon_star1.svg" onclick="checked(1,this)" class="startshow1" showstart="2"/>
    <img src="/static/icon_star1.svg" onclick="checked(2,this)" class="startshow2" showstart="2"/>
    <img src="/static/icon_star1.svg" onclick="checked(3,this)" class="startshow3" showstart="2"/>
    <img src="/static/icon_star1.svg" onclick="checked(4,this)" class="startshow4" showstart="2"/>
    <img src="/static/icon_star2.svg" onclick="checked(5,this)" class="startshow5" showstart="1">
    <?php else: ?>
    <img src="/static/icon_star1.svg" onclick="checked(1,this)" class="startshow1" showstart="2"/>
    <img src="/static/icon_star1.svg" onclick="checked(2,this)" class="startshow2" showstart="2"/>
    <img src="/static/icon_star1.svg" onclick="checked(3,this)" class="startshow3" showstart="2"/>
    <img src="/static/icon_star1.svg" onclick="checked(4,this)" class="startshow4" showstart="2"/>
    <img src="/static/icon_star1.svg" onclick="checked(5,this)" class="startshow5" showstart="2">
    <?php endif; ?>

</div>
<div style="margin: 10px 100px;">
    <input type="hidden" id="wuliu" value="<?php echo $opinions['logistics_server']; ?>">
    物流服务：
    <?php if(($opinions['logistics_server'] == 0)): ?>
    <img src="/static/icon_star2.svg" onclick="checked2(1,this)" class="startsho1" showstart2="1"/>
    <img src="/static/icon_star2.svg" onclick="checked2(2,this)" class="startsho2" showstart2="1"/>
    <img src="/static/icon_star2.svg" onclick="checked2(3,this)" class="startsho3" showstart2="1"/>
    <img src="/static/icon_star2.svg" onclick="checked2(4,this)" class="startsho4" showstart2="1"/>
    <img src="/static/icon_star2.svg" onclick="checked2(5,this)" class="startsho5" showstart2="1">
    <?php elseif(($opinions['logistics_server'] == 1)): ?>
    <img src="/static/icon_star2.svg" onclick="checked2(1,this)" class="startsho1" showstart2="2"/><img src="/static/icon_star2.svg" onclick="checked2(2,this)" class="startsho2" showstart2="1"/><img src="/static/icon_star2.svg" onclick="checked2(3,this)" class="startsho3" showstart2="1"/><img src="/static/icon_star2.svg" onclick="checked2(4,this)" class="startsho4" showstart2="1"/><img src="/static/icon_star2.svg" onclick="checked2(5,this)" class="startsho5" showstart2="1">
    <?php elseif(($opinions['logistics_server'] == 2)): ?>
    <img src="/static/icon_star1.svg" onclick="checked2(1,this)" class="startsho1" showstart2="2"/>
    <img src="/static/icon_star1.svg" onclick="checked2(2,this)" class="startsho2" showstart2="2"/>
    <img src="/static/icon_star2.svg" onclick="checked2(3,this)" class="startsho3" showstart2="1"/>
    <img src="/static/icon_star2.svg" onclick="checked2(4,this)" class="startsho4" showstart2="1"/>
    <img src="/static/icon_star2.svg" onclick="checked2(5,this)" class="startsho5" showstart2="1">
    <?php elseif(($opinions['logistics_server'] == 3)): ?>
    <img src="/static/icon_star1.svg" onclick="checked2(1,this)" class="startsho1" showstart2="2"/>
    <img src="/static/icon_star1.svg" onclick="checked2(2,this)" class="startsho2" showstart2="2"/>
    <img src="/static/icon_star1.svg" onclick="checked2(3,this)" class="startsho3" showstart2="2"/>
    <img src="/static/icon_star2.svg" onclick="checked2(4,this)" class="startsho4" showstart2="1"/>
    <img src="/static/icon_star2.svg" onclick="checked2(5,this)" class="startsho5" showstart2="1">
    <?php elseif(($opinions['logistics_server'] == 4)): ?>
    <img src="/static/icon_star1.svg" onclick="checked2(1,this)" class="startsho1" showstart2="2"/>
    <img src="/static/icon_star1.svg" onclick="checked2(2,this)" class="startsho2" showstart2="2"/>
    <img src="/static/icon_star1.svg" onclick="checked2(3,this)" class="startsho3" showstart2="2"/>
    <img src="/static/icon_star1.svg" onclick="checked2(4,this)" class="startsho4" showstart2="2"/>
    <img src="/static/icon_star2.svg" onclick="checked2(5,this)" class="startsho5" showstart2="1">
    <?php else: ?>
    <img src="/static/icon_star1.svg" onclick="checked2(1,this)" class="startsho1" showstart2="2"/>
    <img src="/static/icon_star1.svg" onclick="checked2(2,this)" class="startsho2" showstart2="2"/>
    <img src="/static/icon_star1.svg" onclick="checked2(3,this)" class="startsho3" showstart2="2"/>
    <img src="/static/icon_star1.svg" onclick="checked2(4,this)" class="startsho4" showstart2="2"/>
    <img src="/static/icon_star1.svg" onclick="checked2(5,this)" class="startsho5" showstart2="2">
    <?php endif; ?>


</div>
<div style="margin: 10px 100px;">
    <input type="hidden" id="miaoshu" value="<?php echo $opinions['goods_intro']; ?>">
    商品描述：
    <?php if(($opinions['goods_intro'] == 0)): ?>
    <img src="/static/icon_star2.svg" onclick="checked3(1,this)" class="startshw1" showstart3="1"/>
    <img src="/static/icon_star2.svg" onclick="checked3(2,this)" class="startshw2" showstart3="1"/>
    <img src="/static/icon_star2.svg" onclick="checked3(3,this)" class="startshw3" showstart3="1"/>
    <img src="/static/icon_star2.svg" onclick="checked3(4,this)" class="startshw4" showstart3="1"/>
    <img src="/static/icon_star2.svg" onclick="checked3(5,this)" class="startshw5" showstart3="1">
    <?php elseif(($opinions['goods_intro'] == 1)): ?>
    <img src="/static/icon_star1.svg" onclick="checked3(1,this)" class="startshw1" showstart3="2"/>
    <img src="/static/icon_star2.svg" onclick="checked3(2,this)" class="startshw2" showstart3="1"/>
    <img src="/static/icon_star2.svg" onclick="checked3(3,this)" class="startshw3" showstart3="1"/>
    <img src="/static/icon_star2.svg" onclick="checked3(4,this)" class="startshw4" showstart3="1"/>
    <img src="/static/icon_star2.svg" onclick="checked3(5,this)" class="startshw5" showstart3="1">
    <?php elseif(($opinions['goods_intro'] == 2)): ?>
    <img src="/static/icon_star1.svg" onclick="checked3(1,this)" class="startshw1" showstart3="2"/>
    <img src="/static/icon_star1.svg" onclick="checked3(2,this)" class="startshw2" showstart3="2"/>
    <img src="/static/icon_star2.svg" onclick="checked3(3,this)" class="startshw3" showstart3="1"/>
    <img src="/static/icon_star2.svg" onclick="checked3(4,this)" class="startshw4" showstart3="1"/>
    <img src="/static/icon_star2.svg" onclick="checked3(5,this)" class="startshw5" showstart3="1">
    <?php elseif(($opinions['goods_intro'] == 3)): ?>
    <img src="/static/icon_star1.svg" onclick="checked3(1,this)" class="startshw1" showstart3="2"/>
    <img src="/static/icon_star1.svg" onclick="checked3(2,this)" class="startshw2" showstart3="2"/>
    <img src="/static/icon_star1.svg" onclick="checked3(3,this)" class="startshw3" showstart3="2"/>
    <img src="/static/icon_star2.svg" onclick="checked3(4,this)" class="startshw4" showstart3="1"/>
    <img src="/static/icon_star2.svg" onclick="checked3(5,this)" class="startshw5" showstart3="1">
    <?php elseif(($opinions['goods_intro'] == 4)): ?>
    <img src="/static/icon_star1.svg" onclick="checked3(1,this)" class="startshw1" showstart3="2"/>
    <img src="/static/icon_star1.svg" onclick="checked3(2,this)" class="startshw2" showstart3="2"/>
    <img src="/static/icon_star1.svg" onclick="checked3(3,this)" class="startshw3" showstart3="2"/>
    <img src="/static/icon_star1.svg" onclick="checked3(4,this)" class="startshw4" showstart3="2"/>
    <img src="/static/icon_star2.svg" onclick="checked3(5,this)" class="startshw5" showstart3="1">
    <?php else: ?>
    <img src="/static/icon_star1.svg" onclick="checked3(1,this)" class="startshw1" showstart3="2"/>
    <img src="/static/icon_star1.svg" onclick="checked3(2,this)" class="startshw2" showstart3="2"/>
    <img src="/static/icon_star1.svg" onclick="checked3(3,this)" class="startshw3" showstart3="2"/>
    <img src="/static/icon_star1.svg" onclick="checked3(4,this)" class="startshw4" showstart3="2"/>
    <img src="/static/icon_star1.svg" onclick="checked3(5,this)" class="startshw5" showstart3="2">
    <?php endif; ?>

</div>
<a class="btn btn-primary btn-rounded" style=" border-radius: 4px;margin-left: 96px;"   onclick="update_slidestatus(this)" data-status="2" data-id="<?php echo $opinions['id']; ?>">确认修改</a>
<a class="btn btn-primary btn-rounded" style=" border-radius: 4px;margin-left: 69px;"   onclick="quxiao(this)" data-status="2">取消</a>
</body>
<script>
    //同意退款 退货

    function checked(index,obj){
        var startshow = ' '
        var showstart = $(obj).attr('showstart')
        console.log(showstart)
        if(showstart==1){
            for(var i = index;i>=1;i--) {
//                console.log('startshow:',startshow)
                startshow = 'startshow' + i
                $(document.getElementsByClassName(startshow)).attr("src", "/static/icon_star1.svg")
                $(document.getElementsByClassName(startshow)).attr("showstart", "2")
            }

        }else {
            for(var i1 = index;i1<=5;i1++) {
//                console.log('startshow:',startshow)
                startshow = 'startshow' + i1
                $(document.getElementsByClassName(startshow)).attr("src", "/static/icon_star2.svg")
                $(document.getElementsByClassName(startshow)).attr("showstart", "1")

            }
            index=index-1
        }
        $('#maijia').attr('value',index);
        console.log(index)
    }
    function checked2(index,obj){
        var startshow = ' '
        var showstart = $(obj).attr('showstart2')
        console.log(showstart)
        if(showstart==1){
            for(var i2 = index;i2>=1;i2--) {
                console.log('startsho:',startshow)
                startshow = 'startsho' + i2
                $(document.getElementsByClassName(startshow)).attr("src", "/static/icon_star1.svg")
                $(document.getElementsByClassName(startshow)).attr("showstart2", "2")
            }

        }else {
            for(var i3 = index;i3<=5;i3++) {
                console.log('startshow:',startshow)
                startshow = 'startsho' + i3
                $(document.getElementsByClassName(startshow)).attr("src", "/static/icon_star2.svg")
                $(document.getElementsByClassName(startshow)).attr("showstart2", "1")

            }
            index=index-1
        }
        $('#wuliu').attr('value',index);
        console.log(index)
    }
    function checked3(index,obj){
        var startshow = ' '
        var showstart = $(obj).attr('showstart3')
//        console.log(showstart)
        if(showstart==1){
            for(var i4 = index;i4>=1;i4--) {
                startshow = 'startshw' + i4
                $(document.getElementsByClassName(startshow)).attr("src", "/static/icon_star1.svg")
                $(document.getElementsByClassName(startshow)).attr("showstart3", "2")
            }

        }else {
            for(var i5 = index;i5<=5;i5++) {
                startshow = 'startshw' + i5
                $(document.getElementsByClassName(startshow)).attr("src", "/static/icon_star2.svg")
                $(document.getElementsByClassName(startshow)).attr("showstart3", "1")

            }
            index=index-1
        }
        $('#miaoshu').attr('value',index);
        console.log(index)
    }
    function update_slidestatus(update_slidestatus){

        var content=$("#content").val();
        var valArr = new Array;
        $("input[name='pics[]']").each(function(i){
            valArr[i] = $(this).val();
        });
        var pics = valArr.join(',');
        var wuliu= $('#wuliu').val();
        var maijia= $('#maijia').val();
        var miaoshu= $('#miaoshu').val();
        var id = $(update_slidestatus).attr('data-id');
        var flag = 1;
            layer.msg("是否确认修改", {
                time: 0 //不自动关闭
                ,btn: ['确认', '取消']
                ,yes: function(index){
                    console.log(flag)
                    layer.close(index);
                    if(flag){
                        flag = 0
                        $.ajax({
                            url: '<?php echo url("order/opinions"); ?>',
                            data: {
                                id:id,content:content,pics:pics,logistics_server:wuliu,seller_server:maijia,goods_intro:miaoshu
                            },
                            dataType: "json",
                            type: "post",
                            success: function(data) {
                                console.log(data);
                                if(data.code==1){
                                    layer.msg(data.msg,{icon: 1, shift: 6},function () {
                                        window.parent.location.reload();
                                    });

                                }else{
                                    layer.msg('操作失败');
                                    window.parent.location.reload();
                                }
                            },
                            fail:function () {
                            }
                        });
                    }

                },
            });


//        var status = $(update_slidestatus).attr('data-status');
//        var str = $(update_slidestatus).text();
//        alert(str);


    }
    //取消添加
    function quxiao(){
        window.parent.location.reload();
    }
    layui.use('upload', function(){
        var $ = layui.jquery;
        var upload = layui.upload;
        upload.render({
            elem: '#slide-pc',
            url: "<?php echo url('index/uploads'); ?>",
            size: 60,
            exts: 'jpg|png|jpeg',
            multiple: true,
            before: function(obj) {
                layer.msg('图片上传中...', {
                    icon: 16,
                    shade: 0.01,
                    time: 0
                })
            },
            done: function(res) {
                console.log(res);
                layer.close(layer.msg());//关闭上传提示窗口
                if(res.status == 0) {
                    return layer.msg(res.message);
                }
                //$('#slide-pc-priview').append('<input type="hidden" name="pc_src[]" value="' + res.filepath + '" />');
                $('#slide-pc-priview').append('<li class="item_img"><div class="operate"><i class="toleft layui-icon"></i><i class="toright layui-icon"></i><i  class="close layui-icon" style="margin-right: 400px;"></i></div><img src="' + res.filepath + '" style="width: 150px;height: 150px" class="img" ><input type="hidden" name="pics[]" value="' + res.filepath + '" /></li>');
            }
        });
    });
    //点击多图上传的X,删除当前的图片
    $("body").on("click",".close",function(){
        $(this).closest("li").remove();
    });
    //多图上传点击<>左右移动图片
    $("body").on("click",".pic-more ul li .toleft",function(){
        var li_index=$(this).closest("li").index();
        if(li_index>=1){
            $(this).closest("li").insertBefore($(this).closest("ul").find("li").eq(Number(li_index)-1));
        }
    });
    $("body").on("click",".pic-more ul li .toright",function(){
        var li_index=$(this).closest("li").index();
        $(this).closest("li").insertAfter($(this).closest("ul").find("li").eq(Number(li_index)+1));
    });
</script>
</html>