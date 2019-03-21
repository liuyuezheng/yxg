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
header("Content-type: text/html; charset=utf-8");
class Pay extends Controller{
    /**
     * 公众号支付
     * @param type $order_no
     * @return type
     */
    public function pay($orders_num) {  
        $orders = Db::table('yx_orders')->where(['orders_num'=>$orders_num])->find();
        $user = Db::table('yx_user')->where(['id'=>$orders['user_id']])->find();
        vendor('wxpay.lib.WxPayApi');
        vendor('wxpay.example.WxPayJsApiPay');
        //准备数据
        $tools = new \JsApiPay();
        //②、统一下单
        $input = new \WxPayUnifiedOrder();
        $input->SetBody('购买');
        $input->SetOut_trade_no($orders_num);
        $input->SetTotal_fee($orders['orders_total_price']*100);
        // $input->SetTime_start(date("YmdHis"));
        // $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetNotify_url("https://yxg.mumarenkj.com/api/callback/cost_asynNotify");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($user['openID1']);
        $order = \WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->GetJsApiParameters($order);

       // $jsApiParameters['code'] = 1;
        return json($jsApiParameters);
        // $this->assign('jsApiParameters',$jsApiParameters); 
        // return $this->fetch();
    }

    /**
     *公众号充值
     * 
     */
    public function recharge($id = 0,$money = 0){
        $user = Db::table('yx_user')->where(['id'=>$id])->find();
        vendor('wxpay.lib.WxPayApi');
        vendor('wxpay.example.WxPayJsApiPay');
        $orders_num = rand(100,9999).time();
        //准备数据
        $tools = new \JsApiPay();
        //②、统一下单
        $input = new \WxPayUnifiedOrder();
        $input->SetBody('充值');
        $input->SetOut_trade_no($orders_num);
        $input->SetTotal_fee($money*100);
        // $input->SetTime_start(date("YmdHis"));
        // $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetNotify_url("https://yxg.mumarenkj.com/api/callback/cost_asynNotify1");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($user['openID1']);
        $order = \WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->GetJsApiParameters($order);
        $list = [
            'order_num'=> $orders_num,
            'title'=>'充值',
            'user_id'=>$id,
            'money'=>$money,
            'time'=>time()
         ];
         Db::table('yx_recharge')->insert($list);
       // $jsApiParameters['code'] = 1;
        return json($jsApiParameters);
    }
}