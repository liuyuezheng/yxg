<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/29
 * Time: 10:31
 */
namespace app\api\controller;
use think\Controller;
use think\Db;
use app\api\model\Coupon as coupon_model;
class Coupon extends Controller{
    
    /**
    *未领取优惠券列表
    * 
    */
   public function coupon_list($id = 0){
       $data = coupon_model::coupon_list($id);
       if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查看未领取优惠券成功！']);
       }else{
           return json_encode(['code'=>2,'msg'=>'目前没有未领取优惠券！']);
       }
   }

   public function coupon_list1($id = 0){
       $data = coupon_model::coupon_list1($id);
       if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查看未领取优惠券成功！']);
       }else{
           return json_encode(['code'=>2,'msg'=>'目前没有未领取优惠券！']);
       }
   }

   /**
    *领取优惠券
    * 
    */
   public function coupon_get($user_id = 0,$coupon_id = 0){
      $res = coupon_model::coupon_get($user_id,$coupon_id);
      if($res == 1){
           return json_encode(['code'=>1,'msg'=>'领取优惠券成功！']);
      }else{
           return json_encode(['code'=>2,'msg'=>'服务器异常！']);
      }
   }

}