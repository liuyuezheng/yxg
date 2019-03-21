<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/22
 * Time: 17:19
 */

namespace app\api\controller;

use think\Controller;
use wxpay\Refund;
class Wechat extends Controller
{
    const notify_url = 'https://yxg.mumarenkj.com/phone/Wechat/wechat_notify';

    const wx_key = 'caihongyixianggou111122223333444';
//    const mch_id = '1521412721';
//    static function wx_refund($transaction_id,$total_fee,$price,$type){
//       $type 0表示小程序，1表示公众号支付
    static function wx_refund(){
        vendor('yxgwxpay.lib.WxPayApi');
        $transaction_id="201901281131164435";
        $total_fee=677.00;
        $price=0.01;
        $type=1;
//        vendor('wxpay.example.WxPay#Config');
//        $merchid = \WxPayRefund::MCHID;
        $refund_no = time() . rand(10000, 99999);
        $input = new \WxPayRefund();
//        $config=new \WxPayConfig();

        $input->SetTransaction_id($transaction_id);
//        dump($input);//微信官方生成的订单流水号，在支付成功中有返回
        $input->SetOut_refund_no($refund_no);         //退款单号
//        dump($input);
        $input->SetTotal_fee($total_fee*100);           //订单标价金额，单位为分
//        dump($input);
        $input->SetRefund_fee($price*100);            //退款总金额，订单总金额，单位为分，只能为整数
//        dump($input);
        $input->SetOp_user_id('1521412721');
        if($type==1){
//
            $wxgzh_app_id = 'wx474dc15e39abdda7';
            $input->SetAppid($wxgzh_app_id);
        }else{
            $wx_app_id = 'wx19f9b6be4310ebb1';
            $input->SetAppid($wx_app_id);
        }
//        dump($input);
        $result = \WxPayApi::refund($input); //退款操作
        dump($result);
//        return json($result);
//        if ($result['return_code'] == "SUCCESS"){
//            return 1;
//        }else{
//            return -1;
//        }
    }
//    public function config($type){
//        if($type==1){
//
//            $wxgzh_app_id = 'wx474dc15e39abdda7';
////            $input->SetAppid($wxgzh_app_id);
//        }else{
//            $wx_app_id = 'wx19f9b6be4310ebb1';
////            $input->SetAppid($wx_app_id);
//        }
//    }
}