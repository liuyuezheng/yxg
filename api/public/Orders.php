<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use app\api\model\Orders as orders_model;
/**
 * 搜索接口
 */
class Orders extends controller
{


    /**
     * 立即购买商品
     * 
     */
    public function promptly_goods($id = 0,$attr_id = 0,$count = 0,$goods_specification = '',$address_id = 0){
       $data = orders_model::promptly_goods($id,$attr_id,$count,$goods_specification,$address_id);
       if(is_array($data)){
          return json_encode(['code'=>1,'data'=>$data,'msg'=>'返回购买商品信息成功！']);
       }else if($data == 1){
          return json_encode(['code'=>2,'msg'=>'请先去添加地址！']);
       }else{
          return json_encode(['code'=>3,'msg'=>'服务器异常！']);
       }
    }

    /**
     * 从购物车购买
     * 
     */
    public function cart_goods($id = 0,$cart_id = '',$address_id = 0){
       $data = orders_model::cart_goods($id,$cart_id,$address_id);
       if(is_array($data)){
          return json_encode(['code'=>1,'data'=>$data,'msg'=>'返回购买商品信息成功！']);
       }else if($data == 1){
          return json_encode(['code'=>2,'msg'=>'请先去添加地址！']);
       }else{
          return json_encode(['code'=>3,'msg'=>'服务器异常！']);
       }
    }

    /**
      *可用优惠券查询
      * 
      */
   public  function usable_coupon($id = 0,$goods_id = '',$order_total_money = 0){
       $data = orders_model::usable_coupon($id,$goods_id,$order_total_money);
       if($data){
          return json_encode(['code'=>1,'data'=>$data,'msg'=>'返回可用优惠券成功！']);
       }else{
          return json_encode(['code'=>2,'msg'=>'目前没有可用优惠券！']);
       }
   }

    /**
     * 生成订单信息
     * 
     */
    public function create_orders(){
       $data = input();
       $data = orders_model::create_orders($data);
       if(is_string($data)){
          return json_encode(['code'=>2,'msg'=>"{$data}库存不足！"]);
       }else if(is_array($data)){
          return json_encode(['code'=>1,'data'=>$data,'msg'=>'生成订单信息成功！']);
       }else if($data == 2){
          return json_encode(['code'=>3,'msg'=>'服务器异常！']);
       }else if($data == 3){
          return json_encode(['code'=>4,'msg'=>'请先去添加地址！']);
       }
    }

    /**
     *确认生成订单信息
     * 
     */
    public function ordersinfo($id = 0,$orders_num = ''){
       $res = orders_model::ordersinfo($id,$orders_num);
       if($res == 1){
          return json_encode(['code'=>1,'msg'=>'付款成功！']);
       }else if($res == 2){
          return json_encode(['code'=>2,'msg'=>'服务器异常！']);
       }else{
          return json_encode(['code'=>3,'msg'=>'余额不足！']);
       }
    }

    /**
     *订单列表
     * 
     */
    public function orders_list($id = 0,$status = 0,$page = 1){
       $data = orders_model::orders_list($id,$status,$page);
       if($data){
          return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询订单列表成功！']);
       }else{
          return json_encode(['code'=>2,'msg'=>'目前没有订单！']);
       }
    }

    /**
     *订单详情
     * 
     */
    public function orders_detail($id = 0){
       $data = orders_model::orders_detail($id);
       if($data){
          return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询订单详情成功！']);
       }else{
          return json_encode(['code'=>2,'msg'=>'目前没有订单详情！']);
       }
    }

    /**
     *
     * 订单确认送达
     */
    public function orders_arrive($id = 0){
      $res = orders_model::orders_arrive($id);
      if($res){
        return json_encode(['code'=>1,'msg'=>'确认送达成功！']);
      }else{
        return json_encode(['code'=>2,'msg'=>'服务器异常！']);
      }
    }

     /**
     *申请退款的商品信息
     * 
     */
    public function goodsinfo($id = 0){
       $data = orders_model::goodsinfo($id);
      if($data){
        return json_encode(['code'=>1,'data'=>$data,'msg'=>'返回信息成功！']);
      }else{
        return json_encode(['code'=>2,'msg'=>'服务器异常！']);
      }
    }

    /**
     *申请退款
     * 
     */
    public function apply_refund(){
      $data = input();
      $res = orders_model::apply_refund($data);
      if($res){
        return json_encode(['code'=>1,'msg'=>'申请退款成功！']);
      }else{
        return json_encode(['code'=>2,'msg'=>'服务器异常！']);
      }
    }

    /**
     *评价商品
     * 
     */
    public function comment_goods(){
      $data = input('commentInfo/a');
      $res = orders_model::comment_goods($data);
      if($res){
        return json_encode(['code'=>1,'msg'=>'评价商品成功！']);
      }else{
        return json_encode(['code'=>2,'msg'=>'服务器异常！']);
      }
    }

    /**
     *退货退款列表
     * 
     */
    public function refund_order($id = 0,$page = 1){
      $data = orders_model::refund_order($id,$page);
      if($data){
        return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询退货退款列表成功！']);
      }else{
        return json_encode(['code'=>2,'msg'=>'目前没有退货退款列表！']);
      }
    }

     /**
     *退货退款详情
     * 
     */
    public function refund_detail($id = 0){
      $data = orders_model::refund_detail($id);
      if($data){
        return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询退货退款详情成功！']);
      }else{
        return json_encode(['code'=>2,'msg'=>'目前没有退货详情列表！']);
      }
    }

    /**
     *输入物流编号
     * 
     */
    public function tracking_num($id = 0,$tracking_num = ''){
      $res = orders_model::tracking_num($id,$tracking_num);
      if($res == 1){
        return json_encode(['code'=>1,'msg'=>'输入物流编号成功！']);
      }else{
        return json_encode(['code'=>2,'msg'=>'服务器异常！']);
      }
    }

    /**
     *取消订单
     * 
     */
    public function cancel_orders($id = 0){
       $res = orders_model::cancel_orders($id);
      if($res == 1){
        return json_encode(['code'=>1,'msg'=>'取消订单成功！']);
      }else{
        return json_encode(['code'=>2,'msg'=>'服务器异常！']);
      }
    }

    /**
     *评价的商品信息
     * 
     */
    public function comment_orders($id = 0){
      $data = orders_model::comment_orders($id);
      if($data){
        return json_encode(['code'=>1,'data'=>$data,'msg'=>'然后信息成功']);
      }else{
        return json_encode(['code'=>2,'msg'=>'服务器异常！']);
      }
    }

    /**
     *删除订单
     * 
     */
    public function del_order($id = 0){
       $res = orders_model::del_order($id);
      if($res == 1){
        return json_encode(['code'=>1,'msg'=>'删除订单成功！']);
      }else{
        return json_encode(['code'=>2,'msg'=>'服务器异常！']);
      }
    }
}
