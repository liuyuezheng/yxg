<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use app\api\model\Cart as cart_model;

/**
 * 购物车接口
 */
class Cart extends controller
{


    /**
     * 添加商品到购物车
     * 
     */
    public function add_cart($user_id = 0,$goods_id = 0,$attr_id = 0,$goods_specification = '',$goods_price = 0,$count = 0,$type = 0){
       $res = cart_model::add_cart($user_id,$goods_id,$attr_id,$goods_specification,$goods_price,$count,$type);
       if($res == 1){
           return json_encode(['code'=>1,'msg'=>'添加购物车成功！']);
        }else if($res == 2){
           return json_encode(['code'=>2,'msg'=>'服务器异常！']);
        }else if($res == 3){
           return json_encode(['code'=>3,'msg'=>'亲，此商品有最低限购！']);
        }else if($res == 4){
           return json_encode(['code'=>4,'msg'=>'库存不足！']);
        }else if($res == 5){
           return json_encode(['code'=>5,'msg'=>'不能超过限购数量！']);
        }

    }

    /**
     *修改购物车的属性规格
     * 
     */
    public  function update_cart_attr(){
       $data = input();
       $res = cart_model::update_cart_attr($data);
       if($res == 1){
         return json_encode(['code'=>1,'msg'=>'改变商品属性规格成功！']);
      }else if($res == 2){
         return json_encode(['code'=>2,'msg'=>'服务器异常！']);
      }else{
         return json_encode(['code'=>3,'msg'=>'购物车已有该属性商品！']);
      }
    }

    /**
     *购物车列表
     * 
     */
    public function cart_list($id = 0,$type = 0){
      $data = cart_model::cart_list($id,$type);
      if($data){
         return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询购物车列表成功！']);
      }else{
         return json_encode(['code'=>2,'msg'=>'购物车空空如也！']);
      }
    }

    /**
     *删除购物车
     * 
     */
    public function del_cart($id = ''){
       $res = cart_model::del_cart($id);
      if($res == 1){
         return json_encode(['code'=>1,'msg'=>'删除购物车成功！']);
      }else{
         return json_encode(['code'=>2,'msg'=>'服务器异常！']);
      }
    }

}
