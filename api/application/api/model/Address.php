<?php

namespace app\api\model;

use think\Model;
use think\Db;

class Address extends Model
{
    
   /**
    *添加地址
    * 
    */
   public static function add_address($data){
       if($data['id'] == 0){
           $data['time'] = time();
           if($data['is_default'] == 1){
              Db::table('yx_address')->where('user_id',$data['user_id'])->update(['is_default'=>0]);
              if(Db::table('yx_address')->insert($data) === false){
                return 2;
              }else{
                return 1;
              }
              
           }else{
              if(Db::table('yx_address')->insert($data) === false){
                return 2;
              }else{
                return 1;
              }
           }
       }else{
           if($data['is_default'] == 1){
               Db::table('yx_address')->where('user_id',$data['user_id'])->update(['is_default'=>0]);
               if(Db::table('yx_address')->where('id',$data['id'])->update($data) === false){
                   return 2;
               }else{
                   return 3;
               }
           }else{
               if(Db::table('yx_address')->where('id',$data['id'])->update($data) === false){
                   return 2;
               }else{
                   return 3;
               }
           }
       }
      
   }
   //  /**
   //   *修改默认地址
   //   * 
   //   */
   // public static function default_address($id = 0){
   //      $address = Db::table('yx_address')->where('id',$id)->find();
   //      if($address['is_default'] == 1){
   //        if(Db::table('yx_address')->where('id',$id)->update(['is_default'=>0]) === false){
   //           return 2;
   //        }else{
   //           return 3;
   //        } 
   //      }else{
   //        if(Db::table('yx_address')->where('id',$id)->update(['is_default'=>1]) === false){
   //           return 2;
   //        }else{
   //           Db::table('yx_address')->where('')->update(['is_default']);
   //           return 1;
   //        } 
   //      }
   // }

   /**
    *地址列表
    * 
    */
   public static function address_list($id = 0){
      $where = [
        'user_id'=>$id 
      ];
      $field = [
        'id,name,telephone,province,city,area,detail,is_default,time'
      ];
      $data = Db::table('yx_address')->where($where)->field($field)->order('time desc')->select();
      foreach ($data as $k => $v) {
        if($v['province'] == '重庆市' || $v['province'] == '北京市' || $v['province'] == '上海市' || $v['province'] == '天津市'){
           $data[$k]['address_detail'] = $v['province'].$v['area'].$v['detail'];
        }else{
           $data[$k]['address_detail'] = $v['province'].$v['city'].$v['area'].$v['detail'];
        }
        
      }
      return $data;
   }



   /**
    *删除地址
    * 
    */
   public static function del_address($id = 0){
      $where = [
         'id'=>$id
      ];
      if(Db::table('yx_address')->where($where)->delete() === false){
         return 2;
      }else{
         return 1;
      }
   }

}
