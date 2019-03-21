<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"F:\ayxg\public/../application/index\view\order\editorders.html";i:1552030610;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>核对订单</title>
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
<div style="margin-top: 83px ;margin-left: 82px;">
    收货地址：<input style="width: 25%;margin-left: 16px" id="address" name="address" placeholder="收货地址" value="<?php echo $data['address']; ?>">

</div>
<div style="margin: 20px 82px;">
    收货人姓名:<input  style="margin-left: 16px" id="name" placeholder="收货人姓名" class="name" value="<?php echo $data['name']; ?>">
</div>
<div style="margin: 20px 82px;">
    规格:
    <select  style="width: 10%;margin-left: 16px"  id="attr" name="goods_specification">
        <?php if(empty($data['goods_specification']) || (($data['goods_specification'] instanceof \think\Collection || $data['goods_specification'] instanceof \think\Paginator ) && $data['goods_specification']->isEmpty())): ?>
        <option value="0" selected="selected" >无</option>
        <?php else: ?>
        <option value="<?php echo $data['attr_id']; ?>" selected="selected" ><?php echo $data['goods_specification']; ?></option>
        <?php endif; if(is_array($attrs) || $attrs instanceof \think\Collection || $attrs instanceof \think\Paginator): if( count($attrs)==0 ) : echo "" ;else: foreach($attrs as $key=>$v): ?>
        <option value="<?php echo $v['id']; ?>" ><?php echo $v['attr_name']; ?></option>
        <?php endforeach; endif; else: echo "" ;endif; ?>

    </select>

<!--
    <input style="margin-left: 16px" id="goods_specification" placeholder="规格" class="goods_specification" value="<?php echo $data['goods_specification']; ?>">-->
</div>
<div style="margin: 20px 82px;">
    数量:<input style="margin-left: 16px" id="goods_count" placeholder="数量" oninput="value=value.replace(/[^1-9]/g,'')" class="goods_count" value="<?php echo $data['goods_count']; ?>">
</div>
<div style="margin: 20px 82px;">
    收货人手机号:<input style="margin-left: 16px" id="telephone" placeholder="收货人手机号" class="telephone" value="<?php echo $data['telephone']; ?>">
</div>
<div style="margin: 20px 82px;">
    备注:  <textarea style="width:30%;
    height: 20%;" placeholder="请输入备注" id="order_note">
    <?php if(empty($data['order_note']) || (($data['order_note'] instanceof \think\Collection || $data['order_note'] instanceof \think\Paginator ) && $data['order_note']->isEmpty())): ?>
      无
    <?php else: ?>
     <?php echo $data['order_note']; endif; ?>
</textarea>
</div>
<!--</div>-->
<a class="btn btn-primary btn-rounded" style=" border-radius: 4px;margin-left: 96px;"   onclick="update_slidestatus(this)" data-id="<?php echo $data['id']; ?>">确认</a>
<a class="btn btn-primary btn-rounded" style=" border-radius: 4px;margin-left: 69px;"   onclick="quxiao(this)" data-status="2">取消</a>
</body>
<script>
    //同意退款 退货
    function update_slidestatus(update_slidestatus){
        var myreg=/^[1][3,4,5,6,7,8][0-9]{9}$/;
        /*  var reg = RegExp(/~/);
         console.log(reg.test(time));goods_count
         if (!myreg.test($poneInput.val())) goods_specification{*/
        var attr=$("#attr option:selected").val();
//        var goods_specification=$("#goods_specification").val();
        var address=$("#address").val();
        var goods_count=$("#goods_count").val();
        var telephone=$("#telephone").val();
        var name=$("#name").val();
        var order_note=$('#order_note').val();
        var id = $(update_slidestatus).attr('data-id');
        if(!myreg.test(telephone)){
            layer.msg('手机号格式有误');
            return;
        }else if(goods_count==""){
            layer.msg('数量不能为空');
            return;
        }else{
            layer.msg("是否确认修改", {
                time: 0 //不自动关闭
                ,btn: ['确认', '取消']
                ,yes: function(index){
                    layer.close(index);
                    $.ajax({
                        url: '<?php echo url("order/editorder"); ?>',
                        data: {
                            id:id,address:address,telephone:telephone,name:name,order_note:order_note,attr:attr,goods_count:goods_count
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
                            }
                        }
                    });
                }
            });
        }

//        var status = $(update_slidestatus).attr('data-status');
//        var str = $(update_slidestatus).text();
//        alert(str);


    }
    //取消添加
    function quxiao(){
        window.parent.location.reload();
    }
</script>
</html>