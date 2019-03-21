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
            'id,head_image,nickname,telephone,time,grade,referees_id,brokerage,remain_brokerage,unbrokerage,balance,integral'
        ];
        $data = Db::table('yx_user')->field($field)->where($where)->find();
        $data['time'] = date('Y-m-d',$data['time']);
        $join = [
           ['yx_goods yg','yg.id = yc.goods_id']
        ];
        $where = [
            'user_id'=>$id,
            'yg.is_delete'=>2
        ];
        $data['collect_count'] = Db::table('yx_collected')->alias('yc')->join($join)->where($where)->count();
        $where = [
            'user_id'=>$id,
            'type'=>1
        ];
        
        $join = [
           ['yx_orders_detail yod','yod.order_id = yo.id']
        ];
        $where = [
           'yo.user_id'=>$id,
           'yo.status'=>3,
           'yod.status'=>['not in' , '2,3'],
        ];
        $pay_detail = Db::table('yx_orders')->alias('yo')->join($join)->where($where)->field('yod.real_pay')->select();
        $consume_money = 0;
        foreach ($pay_detail as $k => $v) {
           $consume_money += $v['real_pay'];
        }
        $data['consume_money'] =  $consume_money;
        $referrer = '';
        if($data['referees_id'] == 0){
          $referrer = '无';
        }else{
          $referrer = Db::table('yx_user')->where('id',$data['referees_id'])->value("nickname");
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
          'ymc.status'=>0,
          'yc.is_delete'=>2
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
        $join = [
            ['yx_orders_detail yod','yod.order_id = yo.id']
        ];
        $where = [
           'yo.user_id'=>$id,
           'yo.status'=>0,
           'yo.is_delete'=>0
        ];
        $data['Fu_count'] = Db::table('yx_orders')->alias('yo')->group('yo.id')->join($join)->where($where)->count();
        $where = [
           'yo.user_id'=>$id,
           'yo.status'=>1,
           'yo.is_delete'=>0,
           'yod.status'=>['not in','2,3,4']
        ];
        $data['Fa_count'] = Db::table('yx_orders')->alias('yo')->group('yo.id')->join($join)->where($where)->count();
        $where = [
           'yo.user_id'=>$id,
           'yo.status'=>2,
           'yo.is_delete'=>0,
           'yod.status'=>['not in','2,3,4']
        ];
        $data['Shou_count'] = Db::table('yx_orders')->alias('yo')->group('yo.id')->join($join)->where($where)->count();
        $join = [
           ['yx_orders yo','yo.id = yod.order_id']
        ];
        $where = [
           'yo.user_id'=>$id,
           'yo.status'=>3,
           'yod.status'=>9,
           'yo.is_delete'=>0
        ];
        $data['Ping_count'] = Db::table('yx_orders_detail')->alias('yod')->group('yo.id')->join($join)->where($where)->count();
        $where = [
           'user_id'=>$id,
           'refund_status'=>['in','0']
        ];
        $data['Tui_count'] = Db::table('yx_refund')->where($where)->count(); 
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
            'yc.user_id'=>$id,
            'yg.is_delete'=>2
        ];
        $join = [
            ['yx_goods yg','yc.goods_id = yg.id'],
        ];
        $field = [
           'yg.id,yg.logo_image,yg.name,yg.goods_price,yg.original_price,yg.is_putaway'
        ];
        $data['data'] = Db::table('yx_collected')->alias('yc')->field($field)->join($join)->where($where)->limit($start,$num)->select();
        $data['total_row'] = Db::table('yx_collected')->alias('yc')->field($field)->join($join)->where($where)->count();
        //dump($data);die;
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
          //'ymc.status'=>0,
          'yc.is_delete'=>2
        ];
        $data = Db::table('yx_my_coupon')->alias('ymc')->field($field)->join($join)->where($where)->select();
        foreach ($data as $k => $v) {
           $data[$k]['end_time'] = $v['end_time']*3600*24+$v['time'];
           $data[$k]['end_time1'] = date('Y-m-d H:i:s',$v['end_time']*3600*24+$v['time']);
        }
        $arr = [];
        foreach ($data as $k => $v) {
            if($type == 0){
                if(time() > $v['end_time'] || $v['status'] == 1){
                    unset($k);
                }else{
                    $arr[] = $v;
                }
            }else{
                if($v['status'] || time() > $v['end_time']){
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
           'yod.id,yod.goods_image,yi.title,yi.integral,yi.time'
        ];
        $data['integral'] = Db::table('yx_user')->where('id',$id)->value('integral');
        $data['data'] = Db::table('yx_integral')->alias('yi')->join($join)->field($field)->where($where)
        ->order('yi.time desc')->select();
        foreach ($data['data'] as $k => $v) {
            $data['data'][$k]['time'] = date('Y-m-d',$v['time']);
        }
        //dump($data);die;
        return $data;
    }

    /**
     *用户提现
     * 
     */
    public static function withdraw_deposit($data){
        $data['time']  = time();

        $user = Db::table('yx_user')->where(['id'=>$data['user_id']])->find();
        if($data['type2'] == 0){

            if($data['money'] > $user['balance']){
                return 3;
            }else if(preg_match('/^\d+(\.\d+)?$/',$data['money']) == 0){
                return 5;
            }else{
                if(Db::table('yx_kiting')->insert($data) === false){
                    return 2;
                }else{
                   Db::table('yx_user')->where(['id'=>$data['user_id']])->update(['balance'=>$user['balance']
                    - $data['money']]); 
                    return 1;
                } 
            }
        }else{
            if($data['money'] > $user['brokerage']){
                return 4;
            }else if(preg_match('/^\d+(\.\d+)?$/',$data['money']) == 0){
                return 5;
            }else{
                if(Db::table('yx_kiting')->insert($data) === false){
                    return 2;
                }else{
                    Db::table('yx_user')->where(['id'=>$data['user_id']])->update(['brokerage'=>$user['brokerage']
                     - $data['money']]);
                    return 1;
                } 
            }
        }
        
    }
    /**
     *用户取消提现
     *
     */
    public static function withdraw_cancel($id=0){
        $kiting = Db::table('yx_kiting')->where(['id'=>$id])->find();
        $user = Db::table('yx_user')->where(['id'=>$kiting['user_id']])->find();
        if( $kiting['status'] == 2){
            return 4;
        }else if($kiting['status'] == 1){
            return 3;
        }else{
            $res=Db::table('yx_kiting')->where(['id'=>$id])->update(['is_delete'=>1,'update_time'=>time()]);
            if($res){
                if($kiting['type2'] == 0){
                   Db::table('yx_user')->where(['id'=>$kiting['user_id']])->update(['balance'=>$user['balance'] + $kiting['money']]); 
               }else{
                   Db::table('yx_user')->where(['id'=>$kiting['user_id']])->update(['brokerage'=>$user['brokerage'] 
                    + $kiting['money']]);
               }
                return 1;
            }else{
                return 2;
            }
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
        $field = [
            'yb.time,yb.title,yu.nickname,yb.type,yb.money,yb.user_id'
        ];
        if($type == 1){
            $where = [
              'yb.user_id'=>$id,
              'yb.order_id'=>['gt',0]
            ];
            $join = [
                ['yx_orders_detail yod','yod.id = yb.order_id'],
                ['yx_orders yo','yo.id = yod.order_id'],
                ['yx_user yu','yu.id = yo.user_id']
            ];
            $data['data'] = Db::table('yx_brokerage')->alias('yb')->join($join)->field($field)->limit($start,$num)->where($where)
            ->order('yb.time desc')->select();  
            $data['total_row'] = Db::table('yx_brokerage')->alias('yb')->join($join)->field($field)->where($where)
            ->order('yb.time desc')->count();
           foreach ($data['data'] as $k => $v) {
                if($v['nickname'] != ''){
                    $data['data'][$k]['title'] = $v['nickname'];
                }
                $data['data'][$k]['time'] = date('m-d H:i',$v['time']);
            }

        }else if($type == 2){
             $where = [
              'yb.user_id'=>$id,
              'yb.order_id'=>['eq',0]
            ];
             $join = [
                ['yx_user yu','yu.id = yb.user_id']
            ];
            $data['data'] = Db::table('yx_brokerage')->alias('yb')->join($join)->field($field)->limit($start,$num)->where($where)
            ->order('yb.time desc')->select();
            $data['total_row'] = Db::table('yx_brokerage')->alias('yb')->join($join)->field($field)->where($where)
            ->order('yb.time desc')->count();

            foreach ($data['data'] as $k => $v) {
                $data['data'][$k]['time'] = date('m-d H:i',$v['time']);
            }
             //dump($data);die;
        }else{
             $where = [
              'yb.user_id'=>$id,
              'yb.order_id'=>['eq',0]
            ];
             $join = [
                ['yx_user yu','yu.id = yb.user_id']
            ];
            $data1 = Db::table('yx_brokerage')->alias('yb')->join($join)->field($field)->where($where)
            ->order('yb.time desc')->select();
             foreach ($data1 as $k => $v) {
                $data1[$k]['time'] = date('m-d H:i',$v['time']);
            }
            $where = [
              'yb.user_id'=>$id,
              'yb.order_id'=>['gt',0]
            ];
            $join = [
                ['yx_orders_detail yod','yod.id = yb.order_id','right'],
                ['yx_orders yo','yo.id = yod.order_id'],
                ['yx_user yu','yu.id = yo.user_id']
            ];
            $data2= Db::table('yx_brokerage')->alias('yb')->join($join)->field($field)->where($where)
            ->order('yb.time desc')->select();
             foreach ($data2 as $k => $v) {
                if($v['nickname'] != ''){
                    $data2[$k]['title'] = $v['nickname'];
                }
                $data2[$k]['time'] = date('m-d H:i',$v['time']);
            }

            $data['data'] = array_merge($data1,$data2);
             foreach ($data['data'] as $k => $v) {
                $score1[$k] = $v['time'];
            }
           array_multisort($score1, SORT_DESC,$data['data']);
           $data['total_row'] = count($data['data']);
           $data['data'] = array_slice($data['data'],$start,10);
             //dump(array_slice($data,$start,10));
            

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
    public static function distributor_detail_list($id = 0,$page = 1){
        $num = 10;
        $start = ($page - 1) * $num;
        $where = [
            'yb.user_id'=>$id
        ];
        $join = [
            ['yx_orders_detail yod','yod.id = yb.order_id']
        ];
        $field = [
            'yb.time,yod.goods_image,yod.goods_name,yod.goods_price,yb.money'
        ];
        $data = Db::table('yx_brokerage')->alias('yb')->field($field)->join($join)->limit($start,$num)->where($where)->order('time desc')->select();
        foreach ($data as $k => $v) {
            $data[$k]['time'] = date('Y-m-d H:i:s',$v['time']);
        }
        //dump($data);die;
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
           'id,head_image,nickname,brokerage,remain_brokerage'
        ];
        $where = [
           'grade'=>['in','1,2']
        ];
        $data['data'] = Db::table('yx_user')->group('id')->field($field)->order('remain_brokerage desc')->where($where)
        ->limit($start,$num)->select();
        $data['total_row'] = Db::table('yx_user')->field($field)->where($where)->count();
        //dump($data);die;
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
        $where = [
           'grade'=>['in','1,2']
        ];
        $data['data'] = Db::table('yx_user')->group('id')->field($field)->order('sales_count desc')->where($where)
        ->limit($start,$num)->select();
        $data['total_row'] = Db::table('yx_user')->field($field)->where($where)->count();
        //dump($data);die;
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
