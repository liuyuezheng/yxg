<?php

namespace app\api\model;

use think\Model;
use think\Db;
use app\api\model\Wxpay as wxpay_model;
header("Content-Type: text/html; charset=UTF-8");
class Orders extends Model
{
    
   /**
    * 立即购买商品
    * @param  integer $attr_id  [商品的属性规格id]
    * @param  integer $id [当前的用户id]
    * @param  integer $count   [立即购买的购买数量]
    * @param  string $goods_specification [商品的属性规格]
    */
   public static function promptly_goods($id = 0,$attr_id = 0,$count = 0,$goods_specification = '',$address_id = 0){
       $user = Db::table('yx_user')->where(['id'=>$id])->find();
       $where = [
           'id'=>$attr_id
       ];
       $goods = Db::table('yx_goods_assessment_price')->where($where)->find();//查询商品信息
       $price = 0;  
       if($user['grade'] == 0){
          $price = $goods['price'];
       }else if($user['grade'] == 1){
          $price = $goods['general_price'];
       }else if($user['grade'] == 2){
          $price = $goods['director_price'];
       }
       $goodsinfo = Db::table('yx_goods')->where('id',$goods['g_id'])->find();//查询商品名称

       $list = [ //返回去的商品信息
           'attr_id' => $goods['id'],
           'goods_id'=>$goodsinfo['id'],
           'goods_image'=>$goods['img'],
           'goods_name'=>$goodsinfo['name'],
           'goods_specification'=>$goods_specification,
           // 'goods_price'=>$price * $count,
           'goods_price'=>$price,
           'goods_count'=>$count

       ];
        $where = [
            'user_id'=>$id
       ];
       if($address_id == 0){
           $address = Db::table('yx_address')->where($where)->select();//查询用户的全部地址
           $add = [];  //用户的默认地址
           foreach ($address as $k => $v) {
              if($v['is_default'] == 1){
                  $add = $v;
              }else{
                  $add = $address[0];
              }
           }
       }else{
        //dump($address_id);
          $add = Db::table('yx_address')->where(['id'=>$address_id])->find();
          //dump($add);
       }
       $freight_price = 0;
       if(empty($add)){
          // return 1;
         $data['address_id'] = '';
         $data['name'] = '';
         $data['telephone'] = '';
         $data['address'] = '';
         $data['freight_price'] = 0;
       }else{
           if($add['province'] == '重庆市' || $add['province'] == '北京市' || $add['province'] == '上海市'
            || $add['province'] == '天津市'){
                 $address = $add['province'].$add['area'].$add['detail'];
           }else{
                 $address = $add['province'].$add['city'].$add['area'].$add['detail'];
           }
         $data['address_id'] = $add['id'];
         $data['name'] = $add['name'];
         $data['telephone'] = $add['telephone'];
         $data['address'] = $address;
         $freight_price3 = 0;
          $freight_price2 = 0;
          
           $freight = Db::table('yx_freight')->where('goods_id',$goodsinfo['id'])->select();
           if(empty($freight)){
              $freight_price = $goodsinfo['freight'];
           }else{
                foreach ($freight as $key => $value) {
                   if($add['city'] == $value['city']){
                      $freight_price2 = $value['freight'];
                   }else{
                      $freight_price = $goodsinfo['freight'];
                   }
               } 
           }
              if($freight_price2!=0){
                    $freight_price3+=$freight_price2;
              }else{
                    $freight_price3+=$freight_price;
              }
              $data['freight_price'] = $freight_price3;
              //dump($data['freight_price']);
       }
      
       
       $data['goodsinfo'][] = $list;
       $data['goods_total_price'] = $list['goods_price']* $count+$freight_price;
       // $data['goods_total_price'] = $list['goods_price']+$freight_price;
       // dump($list['goods_price']);
       // dump($freight_price);
       // dump($data);die;
       //判断是否可使用优惠券
       $is_user_coupon = self::usable_coupon($id,$goodsinfo['id'],$data['goods_total_price']);
       if(empty($is_user_coupon)){
           $data['is_user_coupon'] = 0;
       }else{
           $data['is_user_coupon'] = 1;
       }
       
       return $data;
       
   }


   /**
    * 
    *从购物车购买商品
    * @param  integer $id      [当前的用户id]
    * @param  string  $cart_id [购物车的id]
    * @return [type]           [description]
    */
   public static function cart_goods($id = 0,$cart_id = '',$address_id = 0){
       $user = Db::table('yx_user')->where(['id'=>$id])->find();
       $where = [
          'user_id'=>$id,
          'id'=>['in',$cart_id]
       ];
       $cartinfo = Db::table('yx_cart')->where($where)->select();
       $cartinfo2 = Db::table('yx_cart')->group('goods_id')->where($where)->select();
       $where = [
            'user_id'=>$id
       ];
       $goods_id = '';
      if($address_id == 0){
           $address = Db::table('yx_address')->where($where)->select();//查询用户的全部地址
           $add = [];  //用户的默认地址
           foreach ($address as $k => $v) {
              if($v['is_default'] == 1){
                  $add = $v;
              }else{
                  $add = $address[0];
              }
           }
       }else{
          $add = Db::table('yx_address')->where(['id'=>$address_id])->find();
       }
          $freight_price3 = 0;
       if(empty($add)){
        // 地址为空
          $data['address_id'] = '';
           $data['name'] = '';
           $data['telephone'] = '';
           $data['address'] = '';
           $data['freight_price'] =  0;
       }else{
        
           //dump($freight_price2); dump($freight_price1); dump($freight_price3);
           if($add['province'] == '重庆市' || $add['province'] == '北京市' || $add['province'] == '上海市'
            || $add['province'] == '天津市'){
                 $address = $add['province'].$add['area'].$add['detail'];
           }else{
                 $address = $add['province'].$add['city'].$add['area'].$add['detail'];
           }
           // 地址不为空
           $data['address_id'] = $add['id'];
           $data['name'] = $add['name'];
           $data['telephone'] = $add['telephone'];
           $data['address'] = $address;
           foreach ($cartinfo2 as $key1 => $value2) {
              $goods_id .= $value2['goods_id'].',';
              $freight_price1 = 0;
               $freight_price2 = 0;
               $attrinfo = Db::table('yx_goods_assessment_price')->where('id',$value2['attr_id'])->find();
               $goodsinfo = Db::table('yx_goods')->where('id',$value2['goods_id'])->find();
               $freight = Db::table('yx_freight')->where('goods_id',$goodsinfo['id'])->select();
               if(empty($freight)){
                  $freight_price1 = $goodsinfo['freight'];
               }else{
                 foreach ($freight as $key => $value) {
                     if($add['city'] == $value['city']){
                        $freight_price2 = $value['freight'];
                     }else{
                        $freight_price1 = $goodsinfo['freight'];
                     }
                 } 
               }
               if($freight_price2!=0){
                  $freight_price3+=$freight_price2;
               }else{
                  $freight_price3+=$freight_price1;
               }
           } 
           $data['freight_price'] = $freight_price3;
       }
       // 商品信息
           $list = [];
           $goods_total_price = 0;
           foreach ($cartinfo as $k => $v) {

               $freight_price1 = 0;
               $freight_price2 = 0;
               $attrinfo = Db::table('yx_goods_assessment_price')->where('id',$v['attr_id'])->find();
               $goodsinfo = Db::table('yx_goods')->where('id',$v['goods_id'])->find();
               $freight = Db::table('yx_freight')->where('goods_id',$goodsinfo['id'])->select();
               $list[$k]['attr_id'] = $attrinfo['id'];
               $list[$k]['goods_id'] = $v['goods_id'];
               $list[$k]['goods_image'] = $attrinfo['img'];
               $list[$k]['goods_name'] = $goodsinfo['name'];
               $list[$k]['goods_specification'] = $v['goods_specification'];
               // $list[$k]['goods_price'] = $v['count'] * $v['goods_price'];
               $list[$k]['goods_price'] = $v['goods_price'];
               $list[$k]['goods_count'] = $v['count'];
               $goods_total_price += $v['count'] * $v['goods_price'];
           }
           
           $data['goodsinfo'][] = $list; 
           $data['goods_total_price'] = $goods_total_price;
           
           //判断是否可使用优惠券
           $is_user_coupon = self::usable_coupon($id,rtrim($goods_id,','),$data['goods_total_price']);
           // dump(rtrim($goods_id,','));
           // dump($data['goods_total_price']);
           // dump($is_user_coupon);
           if(empty($is_user_coupon)){
               $data['is_user_coupon'] = 0;
           }else{
               $data['is_user_coupon'] = 1;
           }
           //dump($data);die;
            return $data;
   }

    /**
    *生成订单信息
    * 
    */
   public static function create_orders($data){
      $redis = new \Redis();
      $redis->connect('127.0.0.1');
      $redis->lPush('user_id:'.$data['user_id'],$data['user_id']);
      $user_id = $redis->rPop('user_id:'.$data['user_id']);
      //$user_id = $data['user_id']; //$redis->rPop('user_id:'.$data['user_id'],$data['user_id']);
      $user = Db::table('yx_user')->where(['id'=>$user_id])->find();
      $orders_num = date('YmdHis',time()).mt_rand(1000,9999);
      $data['orders_num'] = $orders_num;
       $freight_price3 = 0;
       $goods_total_price = 0;
       $gid=[];
      foreach ($data['goodsinfo'] as $k => $v) {
        
         $attr = Db::table('yx_goods_assessment_price')->where(['id'=>$v['attr_id']])->find();
         $gid[]=$v['goods_id'];
             if($user['grade'] == 0){
                $goods_total_price += $attr['price'] * $v['goods_count'];//计算商品总价格
             }else if($user['grade'] == 1){
                $goods_total_price += $attr['general_price'] * $v['goods_count'];//计算商品总价格
             }else if($user['grade'] == 2){
                $goods_total_price += $attr['director_price'] * $v['goods_count'];//计算商品总价格
             } 
         
      }
      $g_id = array_unique($gid);
      //dump($gid);dump($g_id);
      foreach ($g_id as $k => $v) {
        $freight_price1 = 0;
        $freight_price2 = 0;
        $goods = Db::table('yx_goods')->where('id',$v)->find();
         $freight = Db::table('yx_freight')->where('goods_id',$v)->select();
         $add = Db::table('yx_address')->where('id',$data['address_id'])->find();
           if(empty($freight)){
                  $freight_price1 = $goods['freight'];
               }else{
                 foreach ($freight as $key => $value) {
                     if($add['city'] == $value['city']){
                        $freight_price2 = $value['freight'];
                     }else{
                        $freight_price1 = $goods['freight'];
                     }
                 } 
           }
           if($freight_price2!=0){
                  $freight_price3+=$freight_price2;
            }else{
                  $freight_price3+=$freight_price1;
            }
      }
      if($data['coupon_id'] == 0){
         $coupon_id = 0;
         $coupon = 0;
         $orders_total_price = $goods_total_price + $freight_price3;
      }else{
        $join = [
           ['yx_coupon yc','yc.id = ymc.coupon_id']
        ];
        $coupon = Db::table('yx_my_coupon')->alias('ymc')->join($join)->field('yc.limit_money')
        ->where(['ymc.id'=>$data['coupon_id']])->find();
        $coupon_id = $data['coupon_id'];
        $coupon = $coupon['limit_money'];
        $orders_total_price = $goods_total_price + $freight_price3 - $coupon;
        Db::table('yx_my_coupon')->where(['id'=>$coupon_id])->update(['status'=>1]);
      }

         $list = [
            'orders_num'=>$orders_num,
            'cart_id'=>$data['cart_id'],
            'user_id'=>$user_id,
            'address_id'=>$data['address_id'],
            'address'=>$data['address'],
            'name'=>$data['name'],
            'telephone'=>$data['telephone'],
            'freight_price'=>$freight_price3,
            'coupon_id'=>$coupon_id,
            'coupon'=>$coupon,
            'goods_total_price'=>$goods_total_price,
            'orders_total_price'=>$orders_total_price,
            'remark'=>$data['remark'],
            'create_time'=>time()
         ];
         $address = Db::table('yx_address')->where('user_id',$user_id)->find();
         if(empty($address)){
             return 3;
         } 
         //dump($list);die;
      if($data['cart_id'] != ''){
          $cart_id = explode(',', $data['cart_id']);
          $order_id = Db::table('yx_orders')->insertGetId($list);
          //dump($order_id);die;
         
          foreach ($cart_id as $k => $v) {

              $cartinfo = Db::table('yx_cart')->where('id',$v)->find();
              $goods_price = $cartinfo['goods_price'] * $cartinfo['count'];
              $attrinfo = Db::table('yx_goods_assessment_price')->where('id',$cartinfo['attr_id'])->find();
              $goods = Db::table('yx_goods')->where('id',$cartinfo['goods_id'])->find();
              if($attrinfo['num'] >= $cartinfo['count']){
                  if($order_id > 0){
                       $freight = Db::table('yx_freight')->where('goods_id',$cartinfo['goods_id'])->select();
                       $add = Db::table('yx_address')->where('id',$data['address_id'])->find();
                       $freight_price11=0;
                       $freight_price12=0;
                         if(empty($freight)){
                                $freight_price12 = $goods['freight'];
                             }else{
                               foreach ($freight as $key => $value) {
                                   if($add['city'] == $value['city']){
                                      $freight_price11 = $value['freight'];
                                   }else{
                                      $freight_price12 = $goods['freight'];
                                   }
                               }
                           
                         }
                         if($freight_price11!=0){
                              $ordergoods['freight_price']=$freight_price11;
                            }else{
                              $ordergoods['freight_price']=$freight_price12;
                            }

                      $ordergoods['sub_order_num'] = date('YmdHis',time()).mt_rand(1000,9999);
                      $ordergoods['order_id'] = $order_id;
                      $ordergoods['goods_id'] = $cartinfo['goods_id'];
                      $ordergoods['attr_id'] = $cartinfo['attr_id'];
                      $ordergoods['goods_image'] = $attrinfo['img'];
                      $ordergoods['goods_name'] = $goods['name'];
                      $ordergoods['goods_specification'] = $cartinfo['goods_specification'];
                      $ordergoods['goods_price'] = $cartinfo['goods_price'];
                      $ordergoods['goods_count'] = $cartinfo['count'];
                      $ordergoods['real_pay'] = $goods_price - ($goods_price/$goods_total_price*$coupon);
                      $ordergoods['create_time'] = time();
                      $attr_data = Db::table('yx_goods_assessment_price')->where('id',$cartinfo['attr_id'])->find();
                      Db::table('yx_cart')->where('id',$v)->delete();
                      Db::table('yx_orders_detail')->insert($ordergoods);
                      Db::table('yx_goods_assessment_price')->where('id',$cartinfo['attr_id'])
                      ->update(['num'=>$attr_data['num'] - $cartinfo['count']]);
                      Db::table('yx_goods')->where('id',$goods['id'])->update(['nums'=>$goods['nums']
                       - $cartinfo['count']]);
                  }else{
                     return 2;
                  }
            }else{
                  Db::table('yx_orders')->where('id',$order_id)->delete();
                  Db::table('yx_orders_detail')->where('order_id',$order_id)->delete();
                  return $goods['name'];
               }
            }
      }else{
             $attrinfo = Db::table('yx_goods_assessment_price')->where('id',$data['attr_id'])->find();
             $price = 0;  
             if($user['grade'] == 0){
                $price = $attrinfo['price'];
             }else if($user['grade'] == 1){
                $price = $attrinfo['general_price'];
             }else if($user['grade'] == 2){
                $price = $attrinfo['director_price'];
             } 
           $goods = Db::table('yx_goods')->where('id',$attrinfo['g_id'])->find();
           if($attrinfo['num'] >= $data['count']){
             $order_id = Db::table('yx_orders')->insertGetId($list);
             if($order_id > 0){
                 $ordergoods['sub_order_num'] = date('YmdHis',time()).mt_rand(1000,9999);
                 //$goodsinfo = Db::table('yx_goodsinfo')->where('id',$data['goods_id'])->find();
                 $ordergoods['order_id'] = $order_id;
                 $ordergoods['goods_id'] = $attrinfo['g_id'];
                 $ordergoods['attr_id'] = $data['attr_id'];
                 $ordergoods['goods_image'] = $attrinfo['img'];
                 $ordergoods['goods_name'] = $goods['name'];
                 $ordergoods['goods_specification'] = $data['goods_specification'];
                 $ordergoods['goods_price'] = $price;
                 $ordergoods['goods_count'] = $data['count'];
                 $ordergoods['freight_price'] = $freight_price3;
                 $ordergoods['real_pay'] = $goods_total_price - $coupon;
                 $ordergoods['create_time'] = time();
                 //dump($ordergoods);die;
                 $attr_data = Db::table('yx_goods_assessment_price')->where('id',$data['attr_id'])->find();
                 Db::table('yx_orders_detail')->insert($ordergoods);
                 Db::table('yx_goods_assessment_price')->where('id',$attr_data['id'])
                 ->update(['num'=>$attr_data['num']-$data['count']]);
                 Db::table('yx_goods')->where('id',$goods['id'])->update(['nums'=>$goods['nums']
                 - $data['count']]);
         }else{
            return 2;
         }
       }else{

         return $goods['name'];
       }
      }   
        return $list;
   }

    /**
    *确认生成订单信息
    * 
    */
   public static function ordersinfo($id = 0,$orders_num = '',$type = 0,$pay_status = 0){
        //dump(getNewTime());
        $where = [
            'orders_num'=>$orders_num
        ];
        $userinfo = Db::table('yx_user')->where('id',$id)->find();//查询用户信息
        $ordersinfo = Db::table('yx_orders')->where($where)->find();//查询订单信息
        $data = [
            'pay_time'=>time(),
            'status'=>1,
            'type'=>$type,
            'pay_status'=>$pay_status
        ];
         // dump(getNewTime());
         // dump($data);die;
        if($ordersinfo['orders_total_price'] <= $userinfo['balance']){
            if(Db::table('yx_orders')->where($where)->update($data) === false){
              return 2;
            }else{
              //修改账号余额
             Db::table('yx_user')->where('id',$id)->update(['balance'=>$userinfo['balance']-$ordersinfo['orders_total_price']]);
              $order_detail = Db::table('yx_orders_detail')->where('order_id',$ordersinfo['id'])->select();//查询订单详细信息
              $user_brokerage = Db::table('yx_brokerage_allocation')->where('user_id',$userinfo['id'])->find();//查询用户佣金分配表
             
             foreach ($order_detail as $k => $v) {
                  $one_agent = Db::table('yx_user')->where('id',$user_brokerage['first_agent'])->find();
                 //二级总代的用户信息
                 $two_agent = Db::table('yx_user')->where('id',$user_brokerage['second_agent'])->find();
                 //三级总代的用户信息
                 $three_agent = Db::table('yx_user')->where('id',$user_brokerage['three_agent'])->find();
                 //一级董事用户信息
                 $one_manager = Db::table('yx_user')->where('id',$user_brokerage['first_manager'])->find();
                 //二级董事用户信息
                 $two_manager = Db::table('yx_user')->where('id',$user_brokerage['second_manager'])->find();
                 $goods_assessment = Db::table('yx_goods_assessment_price')->where('id',$v['attr_id'])->find();//查询商品属性
                 $goods = Db::table('yx_goods')->where('id',$v['goods_id'])->find();
                 $aa['money'] = 0;
                 if(!empty($one_agent)){
                    $aa['money'] = $v['real_pay'] - ($goods_assessment['general_price'] * $v['goods_count']); //查询一级总代所分佣金
                    $aa['user_id']=$one_agent['id'];
                    $aa['order_id']=$v['id'];
                    $aa['time']=time();

                    Db::table('yx_expect_brokerage')->insert($aa);
                    $unbrokerage['unbrokerage'] = $one_agent['unbrokerage'] + $aa['money'];
                    Db::table('yx_user')->where('id',$one_agent['id'])->update($unbrokerage);
                 }
                 $aa2['money'] = 0;
                 if(!empty($two_agent)){
                    $aa2['money'] = $goods_assessment['two_agent'] * $v['goods_count']; //查询二级级总代所分佣金
                    $aa2['user_id']=$two_agent['id'];
                    $aa2['order_id']=$v['id'];   
                    $aa2['time']=time();
                    Db::table('yx_expect_brokerage')->insert($aa2);
                    $unbrokerage['unbrokerage'] = $two_agent['unbrokerage'] + $aa2['money'];
                    Db::table('yx_user')->where('id',$two_agent['id'])->update($unbrokerage);
                 }
                 $aa3['money'] = 0;
                 if(!empty($three_agent)){

                    $aa3['money'] = $goods_assessment['three_agent'] * $v['goods_count']; //查询三级总代所分佣金
                    $aa3['user_id']=$three_agent['id'];
                    $aa3['order_id']=$v['id'];
                    $aa3['time']=time();
                    Db::table('yx_expect_brokerage')->insert($aa3);
                    $unbrokerage['unbrokerage'] = $three_agent['unbrokerage'] + $aa3['money'];
                    Db::table('yx_user')->where('id',$three_agent['id'])->update($unbrokerage);
                 }
                 if(!empty($one_manager)){
                     //一级董事的所分佣金
                    $aa4['money'] = $v['real_pay'] - $aa['money'] - $aa2['money'] - $aa3['money'] - 
                    ($goods_assessment['director_price'] * $v['goods_count']);
                    $aa4['user_id']=$one_manager['id'];
                    $aa4['order_id']=$v['id'];                               
                    $aa4['time']=time();
                    Db::table('yx_expect_brokerage')->insert($aa4);
                    $unbrokerage['unbrokerage'] = $one_manager['unbrokerage'] + $aa4['money'];
                    Db::table('yx_user')->where('id',$one_manager['id'])->update($unbrokerage);
                 }
                 if(!empty($two_manager)){
                    $aa5['money'] = $goods_assessment['manager'] * $v['goods_count'];//二级董事所分佣金
                    $aa5['user_id']=$two_manager['id'];
                    $aa5['order_id']=$v['id'];
                    $aa5['time']=time();
                    Db::table('yx_expect_brokerage')->insert($aa5);
                    $unbrokerage['unbrokerage'] = $two_manager['unbrokerage'] + $aa5['money'];
                    Db::table('yx_user')->where('id',$two_manager['id'])->update($unbrokerage);
                 } 
             }
           
              return 1;
            }
       }else{
            return 3;
       }
   }

   /**
    *可用优惠券查询
    * 
    */
   public static function usable_coupon($id = 0,$goods_id = '',$order_total_money = 0){
        $where = [
            'id'=>['in',$goods_id]
        ];
        $where1 = [
            'user_id'=>$id,
            'status'=>0,
            'is_putaway'=>1,
            'is_delete'=>2
        ];
        $field = [
            'ymc.id,yc.limit_money,yc.limit_condition,yc.name,yc.end_time,ymc.time,ymc.status'
        ];
        $join = [
            ['yx_coupon yc','yc.id = ymc.coupon_id']
        ];
        $data = Db::table('yx_goods')->where($where)->select();
        $coupon = Db::table('yx_my_coupon')->alias('ymc')->field($field)->join($join)->where($where1)->select();
         foreach ($coupon as $k => $v) {
           $coupon[$k]['end_time'] = $v['end_time']*3600*24+$v['time'];
           $coupon[$k]['end_time1'] = date('Y-m-d H:i:s',$v['end_time']*3600*24+$v['time']);
        }
        $arr = [];
        $is_coupon = [];
        foreach ($data as $key => $value) {
           $is_coupon[] = $value['is_use_coupon'];
        }
         if(in_array(1,$is_coupon)){
             foreach ($coupon as $k => $v) {
              if(time() > $v['end_time'] || ($v['limit_condition'] > $order_total_money && $v['limit_condition']>0)){
                  unset($k);
              }else{
                  $arr[] = $v;
                
              }

            }
          return $arr;    
         }else{
           return $arr;
         }

   }
   
   /**
    *订单信息列表
    * 
    */
   public static function orders_list($id = 0,$status = 0,$page = 1){
      $num = 3;
      $start = ($page - 1) * $num;
      $where = [
          'yo.user_id'=>$id,
          'yo.status'=>['neq',4],
          'yo.is_delete'=>0
      ];
      if($status != 0){
          $where['yo.status'] = $status - 1;
      }
      if($status == 4){
         $where['yo.status'] = 3;
         $where['yod.status'] = 9;
      }
      $join = [
           ['yx_orders_detail yod','yo.id = yod.order_id']
      ];
      $field = [
          'yo.id as b_id,yo.orders_num,yo.user_id,yo.status,yo.orders_total_price,yo.freight_price,
          yod.status as status1,yo.create_time'
      ];
      $data['orders'] = Db::table('yx_orders')->alias('yo')->group('b_id')->join($join)->field($field)->where($where)
      ->order('yo.create_time desc')->select();
      // $data['total_row'] = Db::table('yx_orders')->alias('yo')->group('b_id')->join($join)->field($field)->where($where)->count();   
      $field = [
          'yod.id as s_id,yod.order_id,yod.sub_order_num,yod.goods_image,yod.goods_name,yod.goods_specification,
           yod.goods_price,yod.goods_count,yod.status as status1'
      ];
      $join = [
           ['yx_orders yo','yo.id = yod.order_id']
      ];
 
      foreach ($data['orders'] as $k => $v) {
           $where1 = [];
          // $where1['yod.status'] = 0;  
           if($status == 4){
               // $where1['yo.status'] = 3;
               $where1 = [
                'yod.status'=>9,
                'order_id'=>$v['b_id']
              ];

          }else{
              if($status == 0){
                $where1 = [
                //'yod.status'=>['in','9,1'],
                'order_id'=>$v['b_id']
                 ];
              }else{
                 $where1 = [
                'yod.status'=>['in','9,1'],
                'order_id'=>$v['b_id']
                ];
              }
              
          }

          //dump($where1);
          $data['orders'][$k]['orders_count'] = Db::table('yx_orders_detail')->where('order_id',$v['b_id'])->count();
          $data['orders'][$k]['order_detail'] = Db::table('yx_orders_detail')->alias('yod')->where($where1)
          ->join($join)->field($field)->select();
          
      }
       
      foreach ($data['orders'] as $k => $v) {
         if(!empty($v['order_detail'])){
          $arr = [];
            foreach ($v['order_detail'] as $key => $value) {
              // if($value['status1'] == 2 || $value['status1'] == 3 || $value['status1'] == 4){
              //   unset($data['orders'][$k]);
              // }
              if($v['status'] == 3 && $v['b_id'] == $value['order_id']){
                $arr[]=$value['status1'];
                   
                } 

            }
            //dump($arr);
            if($arr){
                if(in_array(9, $arr)){
                    $data['orders'][$k]['status'] = 3;
                }else{
                   if(in_array(2,$arr) || in_array(3,$arr) || in_array(4,$arr)){
                      $data['orders'][$k]['status'] = 7;
                   }else{
                      $data['orders'][$k]['status'] = 5;
                   }
                   
                }
            }  
         }else{
           unset($data['orders'][$k]);
         }         
      }
      //$data['orders'] = array_values($data['orders']);
      $data['total_row'] = count($data['orders']);
      $data['orders'] = array_slice($data['orders'],$start,3);
      //dump($data);die;
      return $data;
   }

   /**
    *订单详情
    * 
    */
   public static function orders_detail($id = 0){
        $where = [
           'id'=>$id
       ];
       $field = [
           'id as b_id,orders_num,address,name,telephone,coupon,freight_price,status,orders_total_price,remark,pay_time,create_time'
       ];
       $data = Db::table('yx_orders')->where($where)->field($field)->find();
       $data['create_time'] = date('Y-m-d H:i:s',$data['create_time']);
       $data['pay_time'] = date('Y-m-d H:i:s',$data['pay_time']);
       $data['orders_count'] = Db::table('yx_orders_detail')->where('order_id',$id)->count();
       $join = [
          ['yx_goods yg','yg.id = yod.goods_id']
       ];
       $field = [
          'yod.id as s_id,yod.goods_image,yod.goods_name,yod.goods_specification,yod.goods_price,yod.goods_count,
          yod.status as status1,yg.is_return'
       ];
       $data['orders_detail'] = Db::table('yx_orders_detail')->alias('yod')->join($join)->where('yod.order_id',$id)
       ->field($field)->select();
       //dump($data);die;
       $arr = [];
       foreach ($data['orders_detail'] as $key => $value) {
            $arr[] = $value['status1'];  
           if($value['status1'] == 9 && $data['status'] == 3){
              $data['orders_detail'][$key]['status1'] = 0;
           } 
       }
        if($data['status'] == 3){
             if($arr){
             if(in_array(9, $arr)){
              $data['status'] = 3;
           }else{
             if(in_array(2,$arr) || in_array(3,$arr) || in_array(4,$arr)){
                $data['status'] = 7;
             }else{
                $data['status'] = 5;
             }
             
          }
       }   
           }
            
       // // }
       // dump($data);die;
       return $data;
   }

   /**
    *确认收货
    * 
    */
   public static function orders_arrive($id = 0){
      $where = [
          'id'=>$id,  
      ];
      $data = [
         'status'=>3,
         'accomplish_time'=>time()
      ];
      if(Db::table('yx_orders')->where($where)->update($data) === false){
         return 2;
      }else{
         $order = Db::table('yx_orders')->where($where)->find();//查询订单信息
         $user = Db::table('yx_user')->where('id',$order['user_id'])->find();//查询用户信息
         $user_brokerage = Db::table('yx_brokerage_allocation')->where('user_id',$user['id'])->find();//查询用户佣金分配表
         $where = [
             'order_id'=>$order['id'],
             'status'=>['not in','2,3,4']
         ];
         $order_detail = Db::table('yx_orders_detail')->where($where)->select();//查询订单详细信息
      
         foreach ($order_detail as $k => $v) {
          $user = Db::table('yx_user')->where('id',$order['user_id'])->find();
          Db::table('yx_user')->where(['id'=>$user['id']])->update(['sales_count'=>$user['sales_count']+$v['goods_count']]);
            $one_integral = Db::table('yx_user')->where('id',$user['first_intrgral'])->find();
         //二级积分用户信息
         $two_integral = Db::table('yx_user')->where('id',$user['second_intrgral'])->find();
         //三级积分用户信息
         $three_integral = Db::table('yx_user')->where('id',$user['three_intrgral'])->find();
             $goods_assessment = Db::table('yx_goods_assessment_price')->where('id',$v['attr_id'])->find();//查询商品属性
             $goods = Db::table('yx_goods')->where('id',$v['goods_id'])->find();
             //$own_integral = $goods['own_integral'] * $v['goods_count'];
             $one_pid_integral = $goods['one_integral'] * $v['goods_count'];//一级积分
             $two_pid_integral = $goods['two_integral'] * $v['goods_count'];//二级积分
             $three_pid_integral = $goods['three_integral'] * $v['goods_count'];//三级积分
             $is_up[] = $goods['is_up'];
             if($goods['coupon_id'] != 0){ //领取优惠券
               $coupon = [
                   'user_id'=>$user['id'],
                   'coupon_id'=>$goods['coupon_id'], 
                   'time'=>time()
               ];
               Db::table('yx_my_coupon')->insert($coupon);
             }
             Db::table('yx_goods')->where('id',$goods['id'])->update(['sales'=>$goods['sales'] + $v['goods_count']]);
             Db::table('yx_orders_detail')->where('id',$v['id'])->update(['status'=>$v['status']]);
              // dump($user['integral']+$goods['own_integral'] * $v['goods_count']);
              Db::table('yx_user')->where('id',$user['id'])->
               update(['integral'=>$user['integral']+$goods['own_integral'] * $v['goods_count']]);
               //添加到一级用户积分明细
               $list5 = [
                  'user_id'=>$user['id'],
                  'title'=>'购买商品',
                  'order_id'=>$v['id'],
                  'integral'=>$goods['own_integral'] * $v['goods_count'],
                  'time'=>time()
               ];
  
               Db::table('yx_integral')->insert($list5);
               $list55 = [
                  'user_id'=>$user['id'],
                  'title'=>'购买商品',
                  'money'=>$order['orders_total_price'],
                  'type'=>1,
                  'time'=>time()
               ];
               Db::table('yx_pay_detail')->insert($list55);

               //修改一级用户积分
             Db::table('yx_user')->where('id',$user['first_intrgral'])->
             update(['integral'=>$one_integral['integral'] + $goods['one_integral'] * $v['goods_count']]);
             //添加到一级用户积分明细
             $list6 = [
                'user_id'=>$one_integral['id'],
                'title'=>'购买商品',
                'order_id'=>$v['id'],
                'integral'=>$one_pid_integral,
                'time'=>time()
             ];
             Db::table('yx_integral')->insert($list6);
        
         //修改二级用户积分
             Db::table('yx_user')->where('id',$user['second_intrgral'])->
             update(['integral'=>$two_integral['integral'] + $goods['two_integral'] * $v['goods_count']]);
             //添加到一级用户积分明细
             $list7 = [
                'user_id'=>$two_integral['id'],
                'title'=>'购买商品',
                'order_id'=>$v['id'],
                'integral'=>$two_pid_integral,
                'time'=>time()
             ];
             Db::table('yx_integral')->insert($list7);
        
         //修改三级用户积分
             Db::table('yx_user')->where('id',$user['three_intrgral'])->
             update(['integral'=>$three_integral['integral'] +$goods['three_integral'] * $v['goods_count']]);
              //添加到三级用户积分明细
             $list8 = [
                'user_id'=>$three_integral['id'],
                'title'=>'购买商品',
                'order_id'=>$v['id'],
                'integral'=>$three_pid_integral,
                'time'=>time()
             ];
             Db::table('yx_integral')->insert($list8);

         }

         //一级积分用户信息
       
         //dump($user_brokerage);die;
          //修改一级总代佣金
          $join = [
              ['yx_orders_detail yod','yod.id = yeb.order_id']
          ];
          $field = [
             'yeb.id,yeb.order_id,user_id,yeb.money,yeb.is_delete,yeb.status'
          ];
          $where = [
             'yod.order_id'=>$id,
             'yeb.is_delete'=>2,
             'yod.status'=>['not in','2,3,4']
          ];
          $data = Db::table('yx_expect_brokerage')->alias('yeb')->join($join)->field($field)->where($where)->select();
          // dump($data);die;
          foreach ($data as $k => $v) {
              $agent = Db::table('yx_user')->where('id',$v['user_id'])->find();
              $update = [
                  'brokerage'=>$agent['brokerage'] + $v['money'],
                  'unbrokerage'=>$agent['unbrokerage'] - $v['money'],
                  'remain_brokerage'=>$agent['remain_brokerage'] + $v['money']
              ];
              Db::table('yx_user')->where('id',$v['user_id'])->update($update);
             //添加到一级总代佣金明细
             $list1 = [
                 'title'=>'购买商品',
                 'user_id'=>$v['user_id'],
                 'order_id'=>$v['order_id'],
                 'money'=>$v['money'],
                 'time'=>time()

             ];
             Db::table('yx_brokerage')->insert($list1);
             unset($list1['order_id']);
             $list1['status'] = 1;
             Db::table('yx_pay_detail')->insert($list1);
             Db::table('yx_expect_brokerage')->where('id',$v['id'])->update(['status'=>1]);

          }

          //修改自己积分/添加自己的积分明细
          // if($user){
          //    if($own_integral > 0){
              
          //    }
             
          // }
              
         

         //是否升级为总代
         // Db::table('yx_')
         if($user['grade'] == 0){
          //升级为总代
            if(in_array('1',$is_up)){
              if($user['pid'] != 0){
                 // $user_brokerage分配
                  if($user_brokerage['first_agent'] != 0){
                     //一级总代存在pid为一级总代否则为一级董事
                     $users['pid'] = $user_brokerage['first_agent'];
                  }else{
                     if($user_brokerage['first_manager'] != 0){
                        $users['pid'] = $user_brokerage['first_manager'];
                      }else{
                        $users['pid'] = 0;
                      }
                   }
                     $users['grade']=1;
                  
              }else{
                  $users['grade']=1;
              }
            
              Db::table('yx_user')->where('id',$user['id'])->update($users);
              self::update_brokerages();
            }

         }
         return 1;
      }
   }
   /*
     改变身份删分配表，更新分配表
    */
    public function update_brokerages(){
        $user=new User();
        $bro=new BrokerageAllocation();
        $bro->where('id','>',0)->delete();
        $info=$user->field('id,pid,grade')->order('id asc')->select();
        foreach ($info as $k=>$v){
            if($v['pid']!=0){
                //上级用户信息
                $up_grade=$user->where('id',$v['pid'])->field('id,grade')->find();
                $pid_bro=$bro->where('user_id',$v['pid'])->find();
                if($up_grade['grade']==0){
//                    普通用户
                    $bro->insert(['user_id'=>$v['id'],
                                  'first_agent'=>$pid_bro['first_agent'],
                                  'second_agent'=>$pid_bro['second_agent'],
                                  'three_agent'=>$pid_bro['three_agent'],
                                  'first_manager'=>$pid_bro['first_manager'],
                                  'second_manager'=>$pid_bro['second_manager']
                                  ]);

                }elseif($up_grade['grade']==1){
//                    总代
                    $bro->insert(['user_id'=>$v['id'],
                                  'first_agent'=>$v['pid'],
                                  'second_agent'=>$pid_bro['first_agent'],
                                  'three_agent'=>$pid_bro['second_agent'],
                                  'first_manager'=>$pid_bro['first_manager'],
                                  'second_manager'=>$pid_bro['second_manager']
                                ]);

                }else{
//                    董事
                    $bro->insert(['user_id'=>$v['id'],
                                  'first_manager'=>$v['pid'],
                                  'second_manager'=>$pid_bro['second_manager']
                                 ]);
                }
            }else{
                $bro->insert(['user_id'=>$v['id']]);
            }
        }
        return 1;
    }

    /**
     *申请退款的商品信息
     * 
     */
    public static function goodsinfo($id = 0){
       $where = [
          'yod.id'=>$id
       ];
       $join = [
          ['yx_goods yg','yg.id = yod.goods_id']
       ];
       $field = [
          'yod.id,yod.goods_image,yod.goods_name,yod.goods_specification,yod.goods_price,yod.goods_count,yg.is_return'
       ];
       $data = Db::table('yx_orders_detail')->alias('yod')->join($join)->field($field)->where($where)->find();
       return $data;
    }

   /**
    *申请退款
    * 
    */
   public static function apply_refund($data){
        $refund_num = mt_rand(1000,9999).date('YmdHis',time());
        $order = Db::table('yx_orders_detail')->where('id',$data['order_id'])->find();
        $Border = Db::table('yx_orders')->where('id',$order['order_id'])->find();
        if($Border['status'] == 1){
          $where=[
            'status'=>['not in','0,1,2,3'],
            'goods_id'=>$order['goods_id'],
            'order_id'=>$order['order_id']
          ];
          $num=Db::table('yx_orders_detail')->where($where)->count();
          if($num==1){
            $data['refund_money'] = $order['real_pay'] + $order['freight_price'];
          }else{
            $data['refund_money'] = $order['real_pay'] ;
          }
        }else{
          $data['refund_money'] = $order['real_pay'] ;
        }
        
        $data['refund_num'] = $refund_num;
        $data['create_time'] = time();
        $list = [
           'user_id'=>$data['user_id'],
           'order_id'=>$data['order_id'],
           'refund_status'=>['in','0,2']
        ];
        //dump(Db::table('yx_refund')->where($list)->find());die;
        if(Db::table('yx_refund')->where($list)->find()){
          return 3;
        }else{
            if(Db::table('yx_refund')->insert($data) === false){
                return 2;
            }else{
                Db::table('yx_orders_detail')->where('id',$data['order_id'])->update(['status'=>2]);
                return 1;
            }
        }
        

   }

   /**
    *评价商品
    * 
    */
   public static function comment_goods($data){

        foreach ($data as $k => $v) {
           $v['time'] = time();
           Db::table('yx_orders_detail')->where(['id'=>$v['sun_order_id']])->update(['status'=>1]);
           $res1 = Db::table('yx_opinion')->insert($v);
        }
        if($res1 > 0){

          return 1;
        }else{
          return 2;
        }
   }

   /**
    *退货退款
    * 
    */
   public static function refund_order($id = 0,$page = 1){
       $num = 10;
       $start = ($page - 1) * $num;
       $where = [
           'yr.user_id'=>$id,
           'yr.is_delete'=>0
       ];
       $field = [
           'yod.id,yr.id as refund_id,yod.goods_image,yod.goods_name,yod.goods_specification,yod.goods_count,yr.type,
           yr.refund_status'
       ];
       $join = [
           ['yx_refund yr','yr.order_id = yod.id']
       ];
       $data['refund_data'] = Db::table('yx_orders_detail')->alias('yod')->field($field)->where($where)
       ->join($join)->limit($start,$num)->order('yr.create_time desc')->select();
       $data['total_row'] = Db::table('yx_orders_detail')->alias('yod')->field($field)->where($where)->join($join)->count();
       foreach ($data['refund_data'] as $k => $v) {
          if($v['type'] == 0 || $v['type'] == 1){
              $data['refund_data'][$k]['type'] = '仅退款';
          }else{
              $data['refund_data'][$k]['type'] = '退货退款';
          }
          if($v['refund_status'] == 0){
              $data['refund_data'][$k]['refund_status'] = '退款中';
          }else if($v['refund_status'] == 1){
              $data['refund_data'][$k]['refund_status'] = '退款失败';
          }else if($v['refund_status'] == 2){
              $data['refund_data'][$k]['refund_status'] = '退款成功';
          }else if($v['refund_status'] == 3){
              $data['refund_data'][$k]['refund_status'] = '同意退货';
          }else if($v['refund_status'] == 4){
              $data['refund_data'][$k]['refund_status'] = '退货失败';
          }

       }
       return $data;
   }

   /**
    *退款详情
    * 
    */
   public static function refund_detail($id = 0){
        $where = [
           'yr.id'=>$id
       ];
       $field = [
           'yod.id,yr.id as refund_id,yr.id as refund_id,yr.refund_num,yr.create_time,yod.goods_image,yod.goods_name,yod.goods_specification,yod.goods_price,yod.goods_count,yr.refund_money,yr.type,yr.refund_status,
           yr.refund_reason,yr.refund_intro,yr.refund_reject,yr.update_time,yo.status'
       ];
       $join = [
           ['yx_refund yr','yr.order_id = yod.id'],['yx_orders yo','yo.id = yod.order_id']
       ];
       $data = Db::table('yx_orders_detail')->alias('yod')->field($field)->where($where)->join($join)->find();
       $data['create_time']  = date('Y-m-d H:i:s',$data['create_time']);
       $data['update_time']  = date('Y-m-d H:i:s',$data['update_time']);
       if($data['type'] == 0 || $data['type'] == 1){
          $data['type'] = '仅退款';
      }else{
          $data['type'] = '退货退款';
      }
       // if($data['refund_status'] == 0){
       //        $data['refund_status'] = '退款中';
       //    }else if($data['refund_status'] == 1){
       //        $data['refund_status'] = '退款失败';
       //    }else if($data['refund_status'] == 2){
       //        $data['refund_status'] = '退款成功';
       //    }else if($data['refund_status'] == 3){
       //        $data['refund_status'] = '同意退货';
       //    }else if($data['refund_status'] == 4){
       //        $data['refund_status'] = '退货成功';
       //    }
      return $data;
   }

   /**
    *输入物流编号
    * 
    */
   public static function tracking_num($id = 0,$tracking_num = 0,$logistics_name = ''){
       $where = [
           'id'=>$id
       ];
       $update = [
            'id'=>$id,
            'return_num'=>$tracking_num,
            'logistics_name'=>$logistics_name,
            'refund_status'=>0
       ];
       if(Db::table('yx_refund')->where($where)->update($update) === false){
          return 2;
       }else{
          return 1;
       }
   }
   
   /**
    *取消订单
    * 
    */
   public static function cancel_orders($id = 0){
      $where = [
        'id'=>$id
      ];
      $data = [
        'status'=>4,
        'update_time'=>time()
      ];
      if(Db::table('yx_orders')->where($where)->update($data) === false){
         return 2;
      }else{
         $orderinfo = Db::table('yx_orders')->where($where)->find();
         if($orderinfo['coupon_id'] != 0){
           Db::table('yx_my_coupon')->where(['id'=>$orderinfo['coupon_id']])->update(['status'=>0]);
         }
         $order = Db::table('yx_orders_detail')->where('order_id',$id)->select();
         foreach ($order as $k => $v) {
            $attr = Db::table('yx_goods_assessment_price')->where('id',$v['attr_id'])->find();
            $goods = Db::table('yx_goods')->where('id',$attr['g_id'])->find();
            Db::table('yx_goods_assessment_price')->where('id',$v['attr_id'])->update(['num'=>$attr['num'] + $v['goods_count']]);
            Db::table('yx_goods')->where('id',$goods['id'])->update(['nums'=>$goods['nums'] + $v['goods_count']]);

         }
         return 1;
      }
   } 

   /**
    *评价的商品信息
    * 
    */
   public static function comment_orders($id = 0){
       $field = [
           'id,goods_id,goods_image,goods_name'
       ];
       $where = [
          'order_id'=>$id,
          'status'=>['not in','2,3,4']
       ];
       $data = Db::table('yx_orders_detail')->field($field)->where($where)->select();
       //dump($data);die;
       return $data;
   }
  
   /**
    *删除订单
    * 
    */
   public static function del_order($id = 0){
      if(Db::table('yx_orders')->where('id',$id)->update(['is_delete'=>1]) === false){
         return 2;
      }else{
         Db::table('yx_orders_detail')->where('order_id',$id)->update(['is_delete'=>1]);
         return 1;
      }
   }
}