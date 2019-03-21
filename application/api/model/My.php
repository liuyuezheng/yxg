<?php
	
namespace app\api\model;

use think\Model;
use think\Db;
header("Content-type: text/html; charset=utf-8"); 
class My extends Model{
    /**
     *个人中心个人信息
     * 
     */
    public static function personalinfo($id = 0){
        $where = [
           'id'=>$id
        ];
        $field = [
            'id,head_image,nickname,telephone,time,grade,pid,brokerage,remain_brokerage,unbrokerage,balance,integral'
        ];
        $data = Db::table('yx_user')->field($field)->where($where)->find();
        $data['time'] = date('Y-m-d',$data['time']);
        $data['collect_count'] = Db::table('yx_collected')->where('user_id',$id)->count();
        $where = [
            'user_id'=>$id,
            'type'=>1
        ];
        $pay_detail = Db::table('yx_pay_detail')->where($where)->select();
        $consume_money = 0;
        foreach ($pay_detail as $k => $v) {
           $consume_money += $v['money'];
        }
        $data['consume_money'] =  $consume_money;
        $referrer = '';
        if($data['pid'] == 0){
          $referrer = '无';
        }else{
          $referrer = Db::table('yx_user')->where('id',$data['pid'])->value("nickname");
        }
        $data['referrer'] = $referrer;
         $join = [
            ['yx_coupon yc','yc.id = ymc.coupon_id']
        ];
        $field = [
            'ymc.id,yc.limit_money,yc.limit_condition,yc.name,yc.end_time,ymc.time,ymc.status'
        ];
        $where = [
          'ymc.user_id'=>$id,
          'ymc.status'=>0
        ];
        $data111 = Db::table('yx_my_coupon')->alias('ymc')->field($field)->join($join)->where($where)->select();
        foreach ($data111 as $k => $v) {
           $data111[$k]['end_time'] = $v['end_time']*3600*24+$v['time'];
           $data111[$k]['end_time1'] = date('Y-m-d H:i:s',$v['end_time']*3600*24+$v['time']);
        }
        $arr = [];
        foreach ($data111 as $k => $v) {
            if(time() > $v['end_time']){
                unset($k);
            }else{
                $arr[] = $v;
            }
            
        }
        $data['coupon_count'] = count($arr);
        //dump($data);die;    
        return $data;
    }

    /**
     *我的收藏列表
     * 
     */
    public static function my_collect($id = 0,$page = 1){
        $num = 10;
        $start = ($page - 1) * $num;
        $where = [
            'yc.user_id'=>$id
        ];
        $join = [
            ['yx_goods yg','yc.goods_id = yg.id']
        ];
        $field = [
           'yg.id,yg.logo_image,yg.name,yg.goods_price,yg.original_price,yg.is_putaway'
        ];
        $data['data'] = Db::table('yx_collected')->alias('yc')->field($field)->join($join)->where($where)->limit($start,$num)->select();
        $data['total_row'] = Db::table('yx_collected')->alias('yc')->field($field)->join($join)->where($where)->count();
        return $data;
    }

    /**
     *我的优惠券
     * 
     */
    public static function my_coupon($id = 0,$type = 0){
        $join = [
            ['yx_coupon yc','yc.id = ymc.coupon_id']
        ];
        $field = [
            'ymc.id,yc.limit_money,yc.limit_condition,yc.name,yc.end_time,ymc.time,ymc.status'
        ];
        $where = [
          'ymc.user_id'=>$id,
          'ymc.status'=>0
        ];
        $data = Db::table('yx_my_coupon')->alias('ymc')->field($field)->join($join)->where($where)->select();
        foreach ($data as $k => $v) {
           $data[$k]['end_time'] = $v['end_time']*3600*24+$v['time'];
           $data[$k]['end_time1'] = date('Y-m-d H:i:s',$v['end_time']*3600*24+$v['time']);
        }
        $arr = [];
        foreach ($data as $k => $v) {
            if($type == 0){
                if(time() > $v['end_time']){
                    unset($k);
                }else{
                    $arr[] = $v;
                }
            }else{

                if(time() > $v['end_time'] || $v['status'] == 1){
                    //dump($v);
                      $arr[] = $v; 
                }else{
                   
                     unset($k);
                }
            }
            
        }
        return $arr;
    }

    /**
     *我的积分明细
     * 
     */
    public static function integral_detail($id = 0){
        $where = [
           'yi.user_id'=>$id
        ];
        $join = [
           ['yx_orders_detail yod','yod.id = yi.order_id']
        ];
        $field = [
           'yod.goods_image,yi.title,yi.integral,yi.time'
        ];
        $data['integral'] = Db::table('yx_user')->where('id',$id)->value('integral');
        $data['data'] = Db::table('yx_integral')->alias('yi')->join($join)->field($field)->where($where)->select();
        foreach ($data['data'] as $k => $v) {
            $data['data'][$k]['time'] = date('Y-m-d',$v['time']);
        }
        return $data;
    }

    /**
     *用户提现
     * 
     */
    public static function withdraw_deposit($data){
        $data['time']  = time();
        if(Db::table('yx_kiting')->insert($data) === false){
            return 2;
        }else{
            return 1;
        }
    }
    /**
     *用户取消提现
     *
     */
    public static function withdraw_cancel($id=0){

        $res=Db::table('yx_kiting')->where('id',$id)->update(['is_delete'=>1,'update_time'=>time()]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    /**
     *用户提现列表
     * type2  0余额提现，1佣金提现
     */
    public static function withdraw_deposit_list($id = 0,$type=1){
        if($type==1){
            $where = [
                'user_id'=>$id,
                'type2'=>0,
                'status'=>0,
                'is_delete'=>2
            ];
        }else{
            $where = [
                'user_id'=>$id,
                'type2'=>1,
                'status'=>0,
                'is_delete'=>2
            ];
        }

         $res=Db::table('yx_user')->where('id',$id)->field('balance,brokerage')->find();
         $field = [
             'id,user_id,time,money,status,type1'
         ];
         $data = Db::table('yx_kiting')->where($where)->order('id desc')->field($field)->find();
         if(!empty($data)){
             /*提现中*/
            $data['time'] = date('Y-m-d H:i:s',$data['time']);
            $data['status']='提现申请中';
            $data['type']=1;
         }else{
             /*无提现数据*/
            $data['type']=2;
        }
        $data['balance']=$res['balance'];
        $data['brokerage']=$res['brokerage'];
         return $data;
    }
    /**
     *用户账单明细
     * id用户id
     */
    public static function withdraw_deposit_lists($id=0,$page=1){
        $num = 10;
        $start = ($page - 1) * $num;
        $where = [
            'user_id'=>$id,
            'status'=>0
        ];
        $field = [
            'id,user_id,time,money,type,title'
        ];
        $data['data']=Db::table('yx_pay_detail')
            ->where($where)
            ->field($field)
            ->order('time desc')
            ->limit($start,$num)
            ->select();
        foreach ($data['data'] as $k => $v) {
            $data['data'][$k]['time'] = date('Y-m-d H:i',$v['time']);
        }
        $data['total_row']=Db::table('yx_pay_detail')
            ->where($where)
            ->field($field)
            ->order('time desc')
            ->limit($start,$num)
            ->count();
        return $data;
    }
    /**
     *佣金明细
     * 
     */
    public static function brokerage_detail($id = 0,$type = 0,$page = 1){
        $num = 10;
        $start = ($page - 1) * $num;
        if($type == 0){
            $where = [
              'user_id'=>$id,
            ];
        }else if($type == 1){
            $where = [
              'user_id'=>$id,
              'yb.order_id'=>['gt',0]
            ];
        }else if($type == 2){
            $where = [
              'user_id'=>$id,
              'yb.order_id'=>['eq',0]
            ];
        }
        $join = [
            ['yx_orders_detail yod','yod.id = yb.order_id','left']
        ];
        $field = [
            'yb.time,yb.title,yod.goods_name,type,yb.money'
        ];
        $data['data'] = Db::table('yx_brokerage')->alias('yb')->join($join)->field($field)->limit($start,$num)->where($where)
        ->order('yb.time desc')->select();
        $data['total_row'] = Db::table('yx_brokerage')->alias('yb')->join($join)->field($field)->limit($start,$num)->where($where)
        ->order('yb.time desc')->count();
        foreach ($data['data'] as $k => $v) {
            if($v['goods_name'] != ''){
                $data['data'][$k]['title'] = $v['goods_name'];
            }
            $data['data'][$k]['time'] = date('m-d H:i',$v['time']);
        }
        //dump($data);die;
        return $data;

    }

    /**
     *我的分销商/我的会员
     * 
     */
    public static function my_distributor($id = 0,$type = 0){
        if($type == 0){
           $where = [
                'pid'=>$id,
                'grade'=>['neq',0]
           ];
        }else{
           $where = [
            'pid'=>$id,
            'grade'=>['eq',0]
           ];
        }
      
        $field = [
            'id,head_image,nickname,telephone,brokerage,remain_brokerage,grade,unbrokerage,time'
        ];
        $user = Db::table('yx_user')->where('id',$id)->field($field)->find();
        $data['agent_count'] = Db::table('yx_user')->where($where)->count();
        $data['total_brokerage'] = $user['remain_brokerage'];
        $data['userinfo'] = Db::table('yx_user')->field($field)->where($where)->select();
        foreach ($data['userinfo'] as $k => $v) {
             $data['userinfo'][$k]['time'] = date('Y-m-d',$v['time']);
             $add = Db::table('yx_address')->where('user_id',$v['id'])->select();
             $address = [];
             foreach ($add as $key => $value) {
                 if($value['is_default'] == 1){
                    $address = $value;
                 }else{
                    $address = $add[0];
                 }
             }
             if($address){
                 if($address['province'] == "重庆市" && $address['province'] == "北京市" && $address['province'] == "上海市" 
                    && $address['province'] == "天津市"){
                    $data['userinfo'][$k]['address'] = $address['province'].$address['area'].$address['detail'];
                 }else{
                    $data['userinfo'][$k]['address'] = $address['province'].$address['city'].$address['area'].$address['detail'];
                 } 
             }
            
        }
        $data = array_merge($user,$data);
        //dump($data);die;
        return $data;
    }

    /**
     *分销订单明细
     * 
     */
    public static function distributor_detail_list($id = 0){
        $where = [
            'yb.user_id'=>$id
        ];
        $join = [
            ['yx_orders_detail yod','yod.id = yb.order_id']
        ];
        $field = [
            'yb.time,yod.goods_image,yod.goods_name,yod.goods_price,yb.money'
        ];
        $data = Db::table('yx_brokerage')->alias('yb')->field($field)->join($join)->where($where)->select();
        foreach ($data as $k => $v) {
            $data[$k]['time'] = date('Y-m-d H:i:s',$v['time']);
        }
        return $data;
    }

    /**
     *佣金收入排行榜
     * 
     */
    public static function  brokerage_ranking($page = 1){
        $num = 10;
        $start = ($page - 1) * $num;
        $field = [
           'id,head_image,nickname,brokerage'
        ];
        $data['data'] = Db::table('yx_user')->field($field)->order('brokerage desc')->limit($start,$num)->select();
        $data['total_row'] = Db::table('yx_user')->field($field)->order('brokerage desc')->count();
        return $data;
    }

    /**
     *个人销量排行榜
     * 
     */
    public static function sales_ranking($page = 1){
        $num = 10;
        $start = ($page - 1) * $num;
        $field = [
           'id,head_image,nickname,sales_count'
        ];
        $data['data'] = Db::table('yx_user')->field($field)->order('sales_count desc')->limit($start,$num)->select();
        $data['total_row'] = Db::table('yx_user')->field($field)->order('sales_count desc')->count();
        return $data;
    }

    /**
     *团队业绩排行榜
     * 
     */
    public static function achievememt_ranking($page = 1){
        $num = 10;
        $start = ($page - 1) * $num;
        $where = [
           'grade'=>2
        ];
        $field = [
           'id,head_image,nickname,remain_brokerage'
        ];
        $data['data'] = Db::table('yx_user')->field($field)->where($where)->order('remain_brokerage desc')
        ->limit($start,$num)->select();
        $data['total_row'] = Db::table('yx_user')->field($field)->where($where)->order('remain_brokerage desc')->count();
        return $data;
    }


}
