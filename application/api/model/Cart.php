<?php

namespace app\api\model;

use think\Model;
use think\Db;

class Cart extends Model
{
    
   /**
    *添加到购物车
    * 
    */
   public static function add_cart($user_id = 0,$goods_id = 0,$attr_id = 0,$goods_specification = '',$goods_price = 0,$count=0){
       $where = [
            'user_id'=>$user_id,
            'goods_id'=>$goods_id,
            'attr_id'=>$attr_id,
       ];
       $data = [
            'user_id'=>$user_id,
            'goods_id'=>$goods_id,
            'attr_id'=>$attr_id,
            'goods_specification'=>$goods_specification,
            'goods_price'=>$goods_price,
            'count'=>$count
       ];

       $arr = Db::table('yx_cart')->where($where)->find();
       $attr = Db::table('yx_goods_assessment_price')->where('id',$attr_id)->find();
       if($arr){
            if($count < $attr['sell_num']){
                return 3;
            }else if($count > $attr['num']){
                return 4;
            }else{
               $list = [
                 'count'=>$count,
               ];
           } 
          $list['update_time'] = time(); 
          if(Db::table('yx_cart')->where($where)->update($list) === false){
             return 2;
          }else{
             return 1;
          }
       }else{
          $data['create_time'] = time();
          if(Db::table('yx_cart')->insert($data) === false){
             return 2;
          }else{
             return 1;
          }
         
       }
      
  }

  /**
   *修改购物车的属性规格
   * 
   */
  public static function update_cart_attr($data){
      $where = [
         'id'=>$data['id']
      ];
      $arr = [
          'goods_id'=>$data['goods_id'],
          'user_id'=>$data['user_id'],
          'attr_id'=>$data['attr_id'],
          'goods_specification'=>$data['goods_specification'],
          'goods_price'=>$data['goods_price'],
          'update_time'=> time()
      ];
      $list111 = [
         'user_id'=>$data['user_id'],
         'goods_id'=>$data['goods_id'],
         'attr_id'=>$data['attr_id']
      ];
      if(Db::table('yx_cart')->where($list111)->find()){
         return 3;
      }
      Db::table('yx_cart')->where('id',$data['id'])->update($arr);
      unset($arr['update_time']);
      $cart = Db::table('yx_cart')->where($arr)->select();
      //dump($cart);die;
      $enenene = 0;
      foreach ($cart as $k => $v) {
         $enenene += $v['count'];
      }
      foreach ($cart as $k => $v) {
        if($data['id'] != $v['id']){
           Db::table('yx_cart')->where('id',$v['id'])->delete();
        }else{
           $list = $v;
        }
      }
      $list['count'] = $enenene;
      if(Db::table('yx_cart')->where('id',$data['id'])->update($list) === false){
        return 2;
      }else{
        return 1;
      }
  }

  /**
   *购物车列表
   * 
   */
  public static function cart_list($id = 0,$type = 0){

      $join = [
          ['yx_goods_assessment_price ygap','ygap.id = yc.attr_id'],['yx_goods yg','yg.id = ygap.g_id']
      ];
      $field = [
          'yc.id,yc.goods_id,yc.attr_id,ygap.img,ygap.num as stock,yg.name,yc.goods_specification,yc.goods_price,yc.count,
          ygap.sell_num as min'
      ];
      if($type == 0){
          $where = [
             'yc.user_id'=>$id,
             'yg.is_putaway'=>0,
             'ygap.num'=>['gt',0]
          ];
          $data['count'] = Db::table('yx_cart')->alias('yc')->join($join)->field($field)->where($where)->count();
          $data['cartinfo'] = Db::table('yx_cart')->alias('yc')->join($join)->field($field)
          ->where($where)->order('yc.create_time desc')->select();
      }else{
          $where = [
              'yc.user_id'=>$id,
              'yg.is_putaway'=>0,
              'ygap.num'=>['eq',0]
          ];
         $data['count'] = Db::table('yx_cart')->alias('yc')->join($join)->field($field)->where("(yc.user_id = {$id} 
         and yg.is_putaway = 1) or (yc.user_id = {$id} and ygap.num = 0)")->count();
         $data['cartinfo'] = Db::table('yx_cart')->alias('yc')->join($join)->field($field)->where("(yc.user_id = {$id} 
         and yg.is_putaway = 1) or (yc.user_id = {$id} and ygap.num = 0)")->order('yc.create_time desc')->select();
      }

      foreach ($data['cartinfo'] as $k => $v) {
        // $data['cartinfo'][$k]['goods_price'] = $v['goods_price'];
        $data['cartinfo'][$k]['goods_checked'] = false;
        // $data['cartinfo'][$k]['min'] = 1;
        //$data[$k]['cover_image'] = 'https://gxx-image.oss-cn-hangzhou.aliyuncs.com/'.$v['cover_image'];
      }
      return $data;
  }

  /**
   *删除购物车
   * 
   */
  public static function del_cart($id = ''){
    $where = [
        'id'=>['in',$id]
    ];
    // $data = [
    //     'is_delete'=>1,
    //     'update_time'=>time()
    // ];
    if(Db::table('yx_cart')->where($where)->delete() === false){
        return 2;
    }else{
        return 1;
    }

  }

}
