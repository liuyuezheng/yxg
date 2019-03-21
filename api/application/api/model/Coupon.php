<?php

namespace app\api\model;

use think\Model;
use think\Db;
class Coupon extends Model{
   
   /**
    *未领取优惠券列表
    * 
    */
   public static function coupon_list($id = 0){
      $ids = '';
      $list = Db::table('yx_my_coupon')->where('user_id',$id)->select();
      foreach ($list as $k => $v) {
        $ids .= $v['coupon_id'].',';

      }
      $ids = rtrim($ids,',');
      $where = [
          'id'=>['not in',$ids],
          'is_putaway'=>1,
          'is_delete'=>2,
          'type'=>0
      ];
      $field = [
          'id,name,limit_money,limit_condition'
      ];
      $data = Db::table('yx_coupon')->field($field)->where($where)->select();
      return $data;
    } 

    public static function coupon_list1($id = 0){
      $ids = '';
      $list = Db::table('yx_my_coupon')->where('user_id',$id)->select();
      foreach ($list as $k => $v) {
        $ids .= $v['coupon_id'].',';

      }
      $ids = rtrim($ids,',');
      $where = [
          'id'=>['not in',$ids],
          'is_putaway'=>1,
          'is_delete'=>2,
          'type'=>1
      ];
      $field = [
          'id,name,limit_money,limit_condition'
      ];
      $data = Db::table('yx_coupon')->field($field)->where($where)->select();
      return $data;
    } 

    /**
     *领取优惠券
     * 
     */
    public static function coupon_get($user_id = 0,$coupon_id = 0){
        $data = [
           'user_id'=>$user_id,
           'coupon_id'=>$coupon_id,
           'time'=>time()
        ];
        if(Db::table('yx_my_coupon')->insert($data) === false){
           return 2;
        }else{
           return 1;
        }
    }
}
