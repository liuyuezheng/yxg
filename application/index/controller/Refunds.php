<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10
 * Time: 14:16
 */

namespace app\index\controller;


use app\index\model\AssessmentPrice;
use app\index\model\Coupon;
use app\index\model\ExpectBrokerage;
use app\index\model\Goods;
use app\index\model\MyCoupon;
use app\index\model\Orders;
use app\index\model\OrdersDetail;
use app\index\model\PayDetail;
use app\index\model\Refund;
use app\index\model\User;
use think\Controller;
use think\Db;

// class Refunds extends Base
class Refunds extends Controller
{
    //售后列表
    public function index(){
        $res=input('get.');
//        (isset($res['order_type']) && !empty($res['order_type'])) ? $rtype = $res['order_type']:$rtype=4;
        if(isset($res['order_type']) && !empty($res['order_type'])){
            if($res['order_type']==3){
                $where1['yx_refund.type'] = ['eq', 0];
            }else{
                $where1['yx_refund.type']=$res['order_type'];
            }
            $this->assign('order_type',$res['order_type']);
        }else{
            $this->assign('order_type','');
            $where1=[];
        }
//        (isset($res['order_status']) && !empty($res['order_status'])) ? $where2['r.refund_status']= ['eq',$res['order_status']]:$where2=[];
        if(isset($res['order_status']) && !empty($res['order_status'])){
            if($res['order_status']==3){
                $where2['yx_refund.refund_status'] = ['eq', 0];
            }else{
                $where2['yx_refund.refund_status']=$res['order_status'];
            }
            $this->assign('order_status',$res['order_status']);
        }else{
            $this->assign('order_status','');
            $where2=[];
        }
        (isset($res['time_type']) && !empty($res['time_type'])) ? $time_type = $res['time_type']:$time_type=2;
        if($time_type==3){
//            订单申请退款时间refund
            (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
            if(isset($times) && $times!=0){
                $timesArr=explode("~",$times);
                if(trim($timesArr[0])==trim($timesArr[1])){
                    $start_time = trim($timesArr[0]);
                    $mdays = date( 'd', strtotime(trim($timesArr[1])));
                    $end_time = date( 'Y-m-' . $mdays . ' 23:59:59', strtotime(trim($timesArr[1])));
                    $where3['yx_refund.create_time']=['between time',[$start_time,$end_time]];
//                    $where2['yx_orders.create_time']=['between time',[$start_time,$end_time]];
//                dump($where3);
                }else{
                    $where3['yx_refund.create_time']=['between time',$timesArr];
//                dump($where3);
                }
            }else{
                $where3=[];
            }
            $this->assign('time_type',$res['time_type']);
            $this->assign('times',$res['time']);
        }elseif ($time_type==1){
//            订单下单购买时间orders_detail
            /*  (isset($res['time']) && !empty($res['time'])) ? $where3['d.create_time']= ['eq',strtotime($res['order_status'])]:$where3=[];*/
            (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
            if(isset($times) && $times!=0){
                $timesArr=explode("~",$times);
                if(trim($timesArr[0])==trim($timesArr[1])){
                    $start_time = trim($timesArr[0]);
                    $mdays = date( 'd', strtotime(trim($timesArr[1])));
                    $end_time = date( 'Y-m-' . $mdays . ' 23:59:59', strtotime(trim($timesArr[1])));
                    $where3['yx_orders_detail.create_time']=['between time',[$start_time,$end_time]];
                }else{
                    $where3['yx_orders_detail.create_time']=['between time',$timesArr];

                }

            }else{
                $where3=[];
            }
            $this->assign('time_type',$res['time_type']);
            $this->assign('times',$res['time']);
        }else{
            //全部
            (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
            if(isset($times) && $times!=0){
                $timesArr=explode("~",$times);
                if(trim($timesArr[0])==trim($timesArr[1])){
                    $start_time = trim($timesArr[0]);
                    $mdays = date( 'd', strtotime(trim($timesArr[1])));
                    $end_time = date( 'Y-m-' . $mdays . ' 23:59:59', strtotime(trim($timesArr[1])));
                    $where3['yx_refund.create_time']=['between time',[$start_time,$end_time]];
                }else{
                    $where3['yx_refund.create_time']=['between time',$timesArr];

                }
//                $where3['yx_refund.create_time']=['between time',$timesArr];
                $this->assign('times',$res['time']);
            }else{
                $this->assign('times','');
                $where3=[];
            }
            $this->assign('time_type','');

        }
//        dump($where3);

        /*商品名称/退货单号/订单号/收件人姓名/手机号/会员ID*/
        if(isset($res['nameorder']) && !empty($res['nameorder'])){
            $where4['yx_orders_detail.goods_name|yx_refund.refund_num|o.user_id|o.name|o.telephone|o.user_id|o.orders_num'] = ['like',"%{$res['nameorder']}%"];
            $this->assign('nameorder',$res['nameorder']);
        }else{
            $where4=[];
            $this->assign('nameorder','');
        }
        $refund=new Refund();
        $ordersDetail=new OrdersDetail();
//         $data=$refund->alias('r')->join('yx_orders_detail','r.order_id=yx_orders_detail.id')
        $data=$ordersDetail->join('yx_refund','yx_refund.order_id=yx_orders_detail.id')->join('yx_orders o','o.id=yx_orders_detail.order_id')
            ->where($where1)
            ->where($where2)
            ->where($where3)
            ->where($where4)
            ->order('yx_refund.id desc')
            ->field('yx_refund.order_id as reorder_id,yx_refund.id as refund_id,yx_refund.*,yx_orders_detail.*,o.orders_num')
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$data->render();
        $data=$data->items();
        $deatil=new OrdersDetail();
        foreach($data as $k=>$v){
            $res=$deatil->alias('d')->join('yx_orders o','d.order_id=o.id')
                ->where('o.id',$v['order_id'])
                ->field('o.name,o.telephone,o.address')->find();
            $data[$k]['telephone']=$res['telephone'];
            $data[$k]['address']=$res['address'];
            $data[$k]['goods_specification']=explode(',',$v['goods_specification']);
        }
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
        //         return json($data);
    }
    //退款详情
    public function detail($refund_id){
        $detail=new OrdersDetail();
        $refund=new Refund();
        $order=new Orders();
        $user=new User();
        $goods=new Goods();
        //退款信息
        $refunds=$refund->where('id',$refund_id)->find();
        $refunds['refund_images']=explode(',',$refunds['refund_images']);
        //小订单信息
        $details=$detail->where('id',$refunds['order_id'])->find();
//        商品规格
        $details['goods_specification']=explode(',',$details['goods_specification']);
        $details['zmoneys']=$details['goods_price']*$details['goods_count'];
//        积分
        $integral=$goods->where('id',$details['goods_id'])->field('own_integral')->find();
        //大订单信息
        $orders=$order->where('id',$details['order_id'])->find();
        //会员信息
        $users=$user->where('id',$orders['user_id'])->field('id,nickname,user_num,telephone')->find();
        $this->assign('refunds',$refunds);
        $this->assign('detail',$details);
        $this->assign('integral',$integral);
        $this->assign('orders',$orders);
        $this->assign('users',$users);
//        return $refunds;
        return $this->fetch();
    }
    //同意退款 退货
    public function upstatus($id,$status){
        $refund=new Refund();
        $detail=new OrdersDetail();
        $user=new User();
        $pay=new PayDetail();
        $ecpect=new ExpectBrokerage();
        $goods=new Goods();
        $attr_price=new AssessmentPrice();
        $coupon=new Coupon();
        $mycoupon=new MyCoupon();
        $refunds=$refund->where('id',$id)->field('order_id,refund_money,refund_status')->find();
        if($refunds['refund_status']==$status){
            $this->error('此订单已操作，请刷新页面！');
        }elseif($refunds['refund_status']==1 && $status==2){
            $this->error('此订单已操作，请刷新页面！');
        }elseif($refunds['refund_status']==4 && $status==3){
            $this->error('此订单已操作，请刷新页面！');
        }else{
            // 启动事务
            if($status==2){
//                $refunds=$refund->where('id',$id)->field('order_id,refund_money')->find();
                $details=$detail->alias('d')->join('yx_orders o','d.order_id=o.id')
                    ->where('d.id',$refunds['order_id'])
                    ->field('o.id,o.orders_num,o.orders_total_price,o.coupon_id,o.mycoupon_id,o.pay_status,o.user_id,o.type,d.goods_id,d.attr_id,d.goods_count')
                    ->find();
                if($details['type']==0){
//          余额
                    $users=$user->where('id',$details['user_id'])->field('id,balance')->find();
                    $money=$refunds['refund_money']+$users['balance'];
                    $user->where('id',$users['id'])->update(['balance'=>$money]);
                    $refund_status=$pay->insert(['user_id'=>$users['id'],'title'=>'退款到账','order_id'=>$details['id'],'money'=>$refunds['refund_money'],'type'=>0,'status'=>0,'time'=>time()]);
                }else{
                    if($details['pay_status']==0){
//                        小程序
                        $appid='wx19f9b6be4310ebb1';
                    }else{
                        //公众号
                        $appid='wx474dc15e39abdda7';
                    }
                    //                     201901290939563613  0.01 0.01 appid 付款多少钱  退款多少钱  订单编号
                    $refund_status=$this->refund($appid,$refunds['refund_money'],$details['orders_total_price'],$details['orders_num']);
                    // return $refund_status;
                }
//            库存变化
                if($refund_status==1){
                    Db::startTrans();
                    try{
                        $goods_num=$goods->where('id',$details['goods_id'])->field('nums')->find();
                        $attr_num=$attr_price->where('id',$details['attr_id'])->field('num')->find();
                        $up_nums=$goods_num['nums']+$details['goods_count'];
                        $up_num=$attr_num['num']+$details['goods_count'];
                        //商品库存更新
                        $goods->where('id',$details['goods_id'])->update(['nums'=>$up_nums,'update_time'=>time()]);
                        //属性库存更新
                        $attr_price->where('id',$details['attr_id'])->update(['num'=>$up_num,'update_time'=>time()]);
//            更新小订单表状态
                        $detail->where('id',$refunds['order_id'])->update(['status'=>3,'update_time'=>time()]);
//            待结算佣金变化
                        $info=$ecpect->where('order_id',$refunds['order_id'])->select();
                        //优惠券是否退还
                        if($details['coupon_id']!=0){
                            $refundcount=$detail->where('order_id',$details['id'])
                                ->where('is_delete',0)
                                ->where('status',3)
                                ->count();
                            $mycoupons=$mycoupon->where('id',$details['coupon_id'])
                                ->field('time,status,coupon_id')
                                ->find();
                            $detailcount=$detail->where('order_id',$details['id'])
                                ->where('is_delete',0)
                                ->count();
                            if($refundcount==$detailcount){
                                $coupons=$coupon->where('id',$mycoupons['coupon_id'])
                                    ->field('status,start,end,end_time')
                                    ->find();
                                if($coupons['status']==0){
//                                    天
                                    $time=$coupons['end_time']*24*3600+$mycoupons['time'];
                                    if(time()<$time){
                                        $myCou['status']=0;
                                        $mycoupon->where('id',$details['coupon_id'])->update($myCou);
                                    }
                                }else{
//                                    时
                                    if(time()<$coupons['end']){
                                        $myCou['status']=0;
                                        $mycoupon->where('id',$details['coupon_id'])->update($myCou);
                                    }
                                }
                            }
                        }
                        foreach($info as $key=>$val){
                            $ecpect->where('id',$val['id'])->update(['is_delete'=>1]);
                            $list=$user->where('id',$val['user_id'])->field('id,unbrokerage')->find();
                            $unbrokerage=$list['unbrokerage']-$val['money'];
                            $user->where('id',$list['id'])->update(['unbrokerage'=>$unbrokerage]);
                        }
                        // 提交事务
                        Db::commit();
                    } catch (\Exception $e) {
                        // 回滚事务
                        Db::rollback();
                    }
                    $res=$refund->where('id',$id)->update(['refund_status'=>$status,'update_time'=>time()]);
                }else{
                    $res=false;
                }
            }else{

                if($status==1 || $status==4){
                    $detail->where('id',$refunds['order_id'])->update(['status'=>4,'update_time'=>time()]);
                }else{
                    $detail->where('id',$refunds['order_id'])->update(['status'=>2,'update_time'=>time()]);
                }

                $res=$refund->where('id',$id)->update(['refund_status'=>$status,'update_time'=>time()]);
            }

            if($res){
                $this->success('操作成功');
            }else{
                $this->error('操做失败');
            }
        }
    }
//    核对订单页面
    public function checkorder($refunds_id){
        $refund=new Refund();
        $res=$refund->where('id',$refunds_id)->field('id,refund_status,return_num,logistics_name')->find();
        $this->assign('info',$res);
        return $this->fetch();
    }
    //批量同意
    public function allstatus($ids){
        //type=1 同意  2不同意
        $refund=new Refund();
        $detail=new OrdersDetail();
        $user=new User();
        $pay=new PayDetail();
        $ecpect=new ExpectBrokerage();
        $goods=new Goods();
        $attr_price=new AssessmentPrice();
        $coupon=new Coupon();
        $mycoupon=new MyCoupon();
//        try{
            foreach ($ids as $k){
                $res=$refund->where('id',$k)->field('refund_status,type')->find();
                if($res['refund_status']==0 && $res['type']<2){
                    $where['refund_status']=2;
//               $where1['refund_status']=1;
                }
                if($res['refund_status']==0 && $res['type']==2){
//                $status=3;
                    $where['refund_status']=3;
//                $where1['refund_status']=4;
                }
                if($res['refund_status']==3 && $res['type']==2){
//                $status=2;
                    $where['refund_status']=2;
//                $where1['refund_status']=1;
                }
                $where['update_time']=time();
//            $where1['update_time']=time();
                if(isset($where['refund_status']) && !empty($where['refund_status'])){
                    if($where['refund_status']==2){
                        //同意退款
                        $refunds=$refund->where('id',$k)->field('order_id,refund_money')->find();
                        $details=$detail->alias('d')->join('yx_orders o','d.order_id=o.id')
                            ->where('d.id',$refunds['order_id'])
                            ->field('o.id,o.orders_num,o.orders_total_price,o.coupon_id,o.mycoupon_id,o.pay_status,o.user_id,o.type,d.goods_id,d.attr_id,d.goods_count')
                            ->find();
                        if($details['type']==0){
//          余额
                            $users=$user->where('id',$details['user_id'])->field('id,balance')->find();
                            $money=$refunds['refund_money']+$users['balance'];
                            $user->where('id',$users['id'])->update(['balance'=>$money]);
                            $refund_status=$pay->insert(['user_id'=>$users['id'],'title'=>'退款到账','order_id'=>$details['id'],'money'=>$refunds['refund_money'],'type'=>0,'status'=>0,'time'=>time()]);
                        }else{
                            //                微信
                            if($details['pay_status']==0){
//                        小程序
                                $appid='wx19f9b6be4310ebb1';
                            }else{
                                //公众号
                                $appid='wx474dc15e39abdda7';
                            }
                            //                     201901290939563613  0.01 0.01 appid 付款多少钱  退款多少钱  订单编号
                            $refund_status=$this->refund($appid,$details['orders_total_price'],$refunds['refund_money'],$details['orders_num']);
                        }
                        if($refund_status==1){

                            //            库存变化
                            Db::startTrans();
                            try{
                                //            更新小订单表状态
                                $goods_num=$goods->where('id',$details['goods_id'])->field('nums')->find();
                                $attr_num=$attr_price->where('id',$details['attr_id'])->field('num')->find();
                                $up_nums=$goods_num['nums']+$details['goods_count'];
                                $up_num=$attr_num['num']+$details['goods_count'];
                                $goods->where('id',$details['goods_id'])->update(['nums'=>$up_nums,'update_time'=>time()]);
                                $attr_price->where('id',$details['attr_id'])->update(['num'=>$up_num,'update_time'=>time()]);
//            更新小订单表状态
                                $detail->where('id',$refunds['order_id'])->update(['status'=>3,'update_time'=>time()]);
                                //优惠券是否退还
                                if($details['coupon_id']!=0){
                                    $refundcount=$detail->where('order_id',$details['id'])
                                        ->where('is_delete',0)
                                        ->where('status',3)
                                        ->count();
                                    $mycoupons=$mycoupon->where('id',$details['coupon_id'])
                                        ->field('time,status,coupon_id')
                                        ->find();
                                    $detailcount=$detail->where('order_id',$details['id'])
                                        ->where('is_delete',0)
                                        ->count();
                                    if($refundcount==$detailcount){
                                        $coupons=$coupon->where('id',$mycoupons['coupon_id'])
                                            ->field('status,start,end,end_time')
                                            ->find();
                                        if($coupons['status']==0){
//                                    天
                                            $time=$coupons['end_time']*24*3600+$mycoupons['time'];
                                            if(time()<$time){
                                                $myCou['status']=0;
                                                $mycoupon->where('id',$details['coupon_id'])->update($myCou);
                                            }
                                        }else{
//                                    时
                                            if(time()<$coupons['end']){
                                                $myCou['status']=0;
                                                $mycoupon->where('id',$details['coupon_id'])->update($myCou);
                                            }
                                        }
                                    }
                                }
//            待结算佣金变化
                                $infos=$ecpect->where('order_id',$refunds['order_id'])->select();
                                foreach($infos as $key=>$val){
                                    $ecpect->where('id',$val['id'])->update(['is_delete'=>1]);
                                    $list=$user->where('id',$val['user_id'])->field('id,unbrokerage')->find();
                                    $unbrokerage=$list['unbrokerage']-$val['money'];
                                    if($unbrokerage<0){
                                        $unbrokerages=0;
                                    }else{
                                        $unbrokerages=$unbrokerage;
                                    }
                                    $user->where('id',$list['id'])->update(['unbrokerage'=>$unbrokerages]);
                                }
                                // 提交事务
                                Db::commit();
                            }catch (\Exception $e) {
                                // 回滚事务
                                Db::rollback();
                            }
                            $info=$refund->where('id',$k)->update(['refund_status'=>$where['refund_status'],'update_time'=>time()]);
                        }else{
                            $info=false;
                        }
//                    $res=$refund->where('id',$id)->update(['refund_status'=>$where['refund_status'],'update_time'=>time()]);
                    }else{
                        $refunds=$refund->where('id',$k)->field('order_id,refund_money')->find();
                        if($where['refund_status']==1 || $where['refund_status']==4){
                            $detail->where('id',$refunds['order_id'])->update(['status'=>4,'update_time'=>time()]);
                        }else{
                            $detail->where('id',$refunds['order_id'])->update(['status'=>2,'update_time'=>time()]);
                        }

                        $info=$refund->where('id',$k)->update(['refund_status'=>$where['refund_status'],'update_time'=>time()]);
//                    $info=$refund->where('id',$k)->update($where);
                    }
                }else{
                    $info=1;
                }


            }
        if($info){
            return 1;
        }else{
            return 0;
        }
    }
    //批量拒绝
    public function allrefuse($ids,$type){
        $refund=new Refund();
        $detail=new OrdersDetail();
        foreach ($ids as $k){
            $res=$refund->where('id',$k)->field('refund_status,type')->find();
            $where1['refund_status']=$res['refund_status'];
            if($res['refund_status']==0 && $res['type']<2){
//                $where['refund_status']=2;
                $where1['refund_status']=1;
            }
            if($res['refund_status']==0 && $res['type']==2){
//                $status=3;
//                $where['refund_status']=3;
                $where1['refund_status']=4;
            }
            if($res['refund_status']==3 && $res['type']==2){
//                $status=2;
//                $where['refund_status']=2;
                $where1['refund_status']=1;
            }
            if(isset($where1['refund_status']) && !empty($where1['refund_status'])){
                if($where1['refund_status']==1){
                    $refunds=$refund->where('id',$k)->field('order_id')->find();
                    //            更新小订单表状态
                    $detail->where('id',$refunds['order_id'])->update(['status'=>4,'update_time'=>time()]);
                }
//          $where['update_time']=time();
                $where1['update_time']=time();
                $info=$refund->where('id',$k)->update($where1);
            }else{
                $info=1;
            }

        }
        if($info){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
    //拒绝页面
    public function refuse($id,$status){
        $this->assign('status',$status);
        $this->assign('id',$id);
        return $this->fetch();
    }
    //拒绝操作
    public function uptstatus($id,$status,$content){
//        refund_reject
        $refund=new Refund();
        $detail=new OrdersDetail();
        $refunds=$refund->where('id',$id)->field('order_id,refund_status')->find();
        if($refunds['refund_status']==$status){
            $this->error('此订单已操作，请刷新页面！');
        } if($refunds['refund_status']==$status){
            $this->error('此订单已操作，请刷新页面！');
        }elseif($refunds['refund_status']==2 && $status==1){
            $this->error('此订单已操作，请刷新页面！');
        }elseif($refunds['refund_status']==3 && $status==4){
            $this->error('此订单已操作，请刷新页面！');
        }else{
            //            更新小订单表状态
            $detail->where('id',$refunds['order_id'])->update(['status'=>4,'update_time'=>time()]);
            $res=$refund->where('id',$id)->update(['refund_status'=>$status,'refund_reject'=>$content,'update_time'=>time()]);
            if($res){
                $this->success('操作成功');
            }else{
                $this->error('操作失败！');
            }
        }
    }

//    public function callback(){
//        $data = file_get_contents('php://input');
//        $result = $this->xmlToArray($data);
//        // 判断签名是否正确  判断支付状态
//        if ($result['result_code']=='SUCCESS' && $result['return_code']=='SUCCESS') {
//            file_put_contents('test1111.txt','1111111');
//            //更新数据库
//            $list = DB::table('gxx_recharge')->where('order_num',$result['out_trade_no'])->find();
//            $arr = Db::table('gxx_shopinfo')->where('id',$list['shop_id'])->find();
//            Db::table('gxx_shopinfo')->where('id',$list['shop_id'])->update(['balance'=>$arr['balance']+$list['money']+$list['send_money']]);
//            DB::table('gxx_recharge')->where('order_num',$result['out_trade_no'])->update(['status'=>1]);
//            echo "success";
//        }else{
//            file_put_contents('test22222.txt','2222222');
//            $this->error('支付失败！');
//
//        }
//
//
//    }

    /**
     * [arrtoxml 格式化返回给微信的数据格式]
     * @Author zhengmingzhou
     * @DateTime 2018-05-22
     * @param [type] $arr [description]
     * @return [type]  [description]
     */
    private function arrtoxml( $arr ){
        if(!$arr){
            return '';
        }else{
            $xml = "<xml>";
            foreach ($arr as $key=>$val){
                if (is_numeric($val)){
                    $xml.="<".$key.">".$val."</".$key.">";
                }else{
                    $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
                }
            }
            $xml.="</xml>";
            return $xml;
        }
    }

//随机32位字符串
    private function nonce_str(){
        $result = '';
        $str = 'QWERTYUIOPASDFGHJKLZXVBNMqwertyuioplkjhgfdsamnbvcxz';
        for ($i=0;$i<32;$i++){
            $result .= $str[rand(0,48)];
        }
        return $result;
    }


//生成订单号
    private function order_number($openid){
        //date('Ymd',time()).time().rand(10,99);//18位
        return md5($openid.time().rand(10,99));//32位
    }


//签名 $data要先排好顺序
    public function MakeSign( $params,$KEY){
        //签名步骤一：按字典序排序数组参数
        ksort($params);
        $string = $this->ToUrlParams($params);  //参数进行拼接key=value&k=v
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=".$KEY;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }
    public function ToUrlParams( $params ){
        $string = '';
        if( !empty($params) ){
            $array = array();
            foreach( $params as $key => $value ){
                $array[] = $key.'='.$value;
            }
            $string = implode("&",$array);
        }
        return $string;
    }

//curl请求
    public function http_request($url,$data = null,$headers=array()){
        $curl = curl_init();
        if( count($headers) >= 1 ){
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($curl, CURLOPT_URL, $url);


        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);


        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }


//获取xml
    private function xml($xml){
        $p = xml_parser_create();
        xml_parse_into_struct($p, $xml, $vals, $index);
        xml_parser_free($p);
        $data = [];
        foreach ($index as $key=>$value) {
            if($key == 'xml' || $key == 'XML') continue;
            $tag = $vals[$value[0]]['tag'];
            $value = $vals[$value[0]]['value'];
            $data[$tag] = $value;
        }
        return $data;
    }

    private function xmlToArray($xml){

        //禁止引用外部xml实体

        libxml_disable_entity_loader(true);

        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

        $val = json_decode(json_encode($xmlstring),true);

        return $val;

    }
    //退款 appid 付款多少钱  退款多少钱  订单编号
    public function refund($appid,$refund_fee,$total_fee,$order_num){
//        $appid = 'wx19f9b6be4310ebb1';//appid
        $mch_id = '1521412721'; //商户号
        $nonce_str = $this->nonce_str();//随机字符串
        $refund_fee = $refund_fee*100;
        $total_fee = $total_fee*100;
        $KEY = 'caihongyixianggou111122223333444';
//        $order_num='201901290933062333';  //0.01 0.01
        //这里是按照顺序的 因为下面的签名是按照顺序 排序错误 肯定出错
         $a = time();
        $parma = array(
            'appid'=> $appid,
            'mch_id'=> $mch_id,
            'nonce_str'=> $nonce_str,
            'op_user_id' => $mch_id,
            'out_refund_no'=> $a,
            'out_trade_no'=> $order_num,
            'refund_fee'=> $refund_fee,
            'total_fee'=> $total_fee,
        );
        //dump($parma);
        $sign = $this->MakeSign($parma,$KEY);
        $post_xml = '<xml> 
          <appid>'.$appid.'</appid> 
          <mch_id>'.$mch_id.'</mch_id> 
          <nonce_str>'.$nonce_str.'</nonce_str> 
          <op_user_id>'.$mch_id.'</op_user_id> 
          <out_refund_no>'.$a.'</out_refund_no> 
          <out_trade_no>'.$order_num.'</out_trade_no> 
          <refund_fee>'.$refund_fee.'</refund_fee> 
          <total_fee>'.$total_fee.'</total_fee>
          <sign>'.$sign.'</sign> 
          </xml>';
        $xmlresult = $this->postXmlSSLCurl($post_xml,'https://api.mch.weixin.qq.com/secapi/pay/refund');
        $result = $this->xml($xmlresult);
        //dump($result);exit;
        if($result['RETURN_CODE']=='SUCCESS'){
            return 1;
        }else{
            return -1;
        }
    }

    //需要使用证书的请求
    function postXmlSSLCurl($xml,$url,$second=30){
        $ch = curl_init();
        //超时时间
        curl_setopt($ch,CURLOPT_TIMEOUT,$second);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        //以下两种方式需选择一种
        //第一种方法，cert 与 key 分别属于两个.pem文件
        //默认格式为PEM，可以注释
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        //curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/cert/apiclient_cert.pem');//getcwd()=》当前工作目录，不含最下级的/
        //curl_setopt($ch,CURLOPT_SSLCERT,S_ROOT.'x**ay/wxzf/cert/apiclient_cert.pem');//这种获取绝对路径，请使用文件根目录E:\putuu\WWW\你的项目放置文件夹名\，而非站点目录
        curl_setopt($ch,CURLOPT_SSLCERT,$_SERVER['DOCUMENT_ROOT'].'/cert'.DIRECTORY_SEPARATOR.'apiclient_cert.pem');
        //默认格式为PEM，可以注释
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        //curl_setopt($ch,CURLOPT_SSLKEY,getcwd().'/cert/apiclient_key.pem');
        //curl_setopt($ch,CURLOPT_SSLKEY,S_ROOT.'x**ay/wxzf/cert/apiclient_key.pem');
        curl_setopt($ch,CURLOPT_SSLKEY,$_SERVER['DOCUMENT_ROOT'].'/cert'.DIRECTORY_SEPARATOR.'apiclient_key.pem');
        //第二种方式，两个文件合成一个.pem文件
        //curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');

        // if( count($aHeader) >= 1 ){
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        // }

        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$xml);
        $data = curl_exec($ch); //返回xml
        if($data){
            curl_close($ch);
            return $data;
        }
        else {
            $error = curl_errno($ch);
            echo "call faild, errorCode:$error\n";
            curl_close($ch);
            return false;
        }
    }


}