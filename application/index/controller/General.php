<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/1/13
 * Time: 22:36
 */

namespace app\index\controller;


use app\index\model\Brokerage;
use app\index\model\Kiting;
use app\index\model\Orders;
use app\index\model\OrdersDetail;
use app\index\model\User;
use think\Db;

class General extends Base
{
//    总代佣金
    public function index(){
        $res=input('get.');
//        (isset($res['nameorder']) && !empty($res['nameorder'])) ? $where3['user_num|telephone'] = ['like',"%{$res['nameorder']}%"]:$where3=[];
        if(isset($res['nameorder']) && !empty($res['nameorder'])){
            $where3['user_num|telephone'] = ['like',"%{$res['nameorder']}%"];
            $this->assign('nameorder',$res['nameorder']);
        }else{
            $where3=[];
            $this->assign('nameorder','');
        }
        $user=new User();
        $kit=new Kiting();
        $res=$user->where($where3)
            ->where('grade',1)
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$res->render();
        $res=$res->items();
        foreach($res as $k=>$v){
            $status=$kit->where('user_id',$v['id'])->order('id desc')->field('status')->limit(1)->find();
            $res[$k]['kit_status']=$status['status'];
        }
        $this->assign('page',$page);
        $this->assign('data',$res);
        return $this->fetch();
//        return json($res);
    }
//    佣金记录
    public function details(){
        $id=input('id/d');
        if(isset($id) && !empty($id)){
            session('userid',$id);
        }else{
            $id=session('userid');
        }
        $brokerage=new Brokerage();
        $detail=new OrdersDetail();
        $order=new Orders();
        $user=new User();
        $data=$brokerage->where('user_id',$id)->order('id desc')->paginate(10,false,['query' => $this->request->get()]);
        $page=$data->render();
        $data=$data->items();
        foreach($data as $k=>$v){
            $details=$detail->where('id',$v['order_id'])->field('goods_name,goods_id,order_id')->find();
            $users=$user->where('id',$v['user_id'])->field('nickname,telephone')->find();
            $orders=$order->where('id',$details['order_id'])->field('orders_num')->find();
            $data[$k]['goods_name']=$details['goods_name'];
            $data[$k]['nickname']=$users['nickname'];
            $data[$k]['telephone']=$users['telephone'];
            $data[$k]['orders_num']=$orders['orders_num'];
        }
        $this->assign('id',$id);
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }
    //导出总代佣金记录
    public function excel1(){
        $id=input('id/d');
        $brokerage=new Brokerage();
        $detail=new OrdersDetail();
        $order=new Orders();
        $user=new User();
        $data=$brokerage->where('user_id',$id)->order('id desc')->field('order_id,user_id,money,title,time')->select();
        $names=$user->where('id',$id)->field('nickname')->find();
        $res=[];
        foreach($data as $k=>$v){
            $details=$detail->where('id',$v['order_id'])->field('goods_name,goods_id,order_id')->find();
            $users=$user->where('id',$v['user_id'])->field('nickname,telephone')->find();
            $orders=$order->where('id',$details['order_id'])->field('orders_num')->find();
//            $user
            $res[$k]['nickname']=$users['nickname'];
            $res[$k]['telephone']=$users['telephone'];
            $res[$k]['money']=$v['money'];
            $res[$k]['time']=date('Y-m-d H:i:s',$v['time']);
            if(empty($orders['orders_num'])){
                $res[$k]['orders_num']='无';
            }else{
                $res[$k]['orders_num']=$orders['orders_num'];
            }
            $res[$k]['goods_name']=$details['goods_name'];
            $res[$k]['title']=$v['title'];
        }
        $name=$names['nickname'].'佣金记录';
        $header=['昵称','手机号','交易金额','交易时间','订单编号','商品名称','备注'];
        exportExcel($header,$res,$name);
    }
    //导出
    public function excel() {
        $res=input('get.');
//        (isset($res['nameorder']) && !empty($res['nameorder'])) ? $where3['user_num|telephone'] = ['like',"%{$res['nameorder']}%"]:$where3=[];
        if(isset($res['nameorder']) && !empty($res['nameorder'])){
            $where3['user_num|telephone'] = ['like',"%{$res['nameorder']}%"];
        }else{
            $where3=[];

        }
        $data=Db::table('yx_user')->where($where3)->where('grade',1)
            ->field('id,nickname,user_num,remain_brokerage,brokerage')
            ->select();
        foreach ($data as $k=>$v){
            $info=Db::table('yx_kiting')->where('user_id',$v['id'])
                ->order('id desc')
                ->field('status')
                ->limit(1)->find();
            if(empty($info)){
                $data[$k]['kit_status']="无";
            }else{
                if($info['status']==0){
                    $data[$k]['kit_status']="未审核";
                }elseif ($info['status']==1){
                    $data[$k]['kit_status']="已通过";
                }else{
                    $data[$k]['kit_status']="已驳回";
                }
            }


        }
        $name='总代佣金';
        $header=['ID','昵称','用户编号','总佣金金额','剩余佣金金额','提现状态'];
        exportExcel($header,$data,$name);
    }
}