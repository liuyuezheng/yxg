<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/28
 * Time: 17:08
 */

namespace app\agent\controller;

use wxpay\Refund;

class Wechat extends base{

    const notify_url = 'https://qipei.mumarenkj.com/phone/Wechat/wechat_notify';
    const wx_app_id = 'wx68bcfcab6cfd4abb';
    const wx_secret = '1c7b352e1c57dc3b0674d65d881dbb40';
    const wx_key = 'sRY9u9MdftadWKy0G99NMFiCQW5pITBh';
    const mch_id = '1501990971';


    static function wx_refund($transaction_id,$total_fee,$price){
//    static function wx_refund(){
        vendor('wxpay.lib.WxPayApi');
        $merchid = \WxPayConfig::MCHID;
        $refund_no = time() . rand(10000, 99999);
        $input = new \WxPayRefund();
        $input->SetTransaction_id($transaction_id);     //微信官方生成的订单流水号，在支付成功中有返回
        $input->SetOut_refund_no($refund_no);         //退款单号
        $input->SetTotal_fee($total_fee*100);           //订单标价金额，单位为分
        $input->SetRefund_fee($price*100);            //退款总金额，订单总金额，单位为分，只能为整数
        $input->SetOp_user_id($merchid);
        $result = \WxPayApi::refund($input); //退款操作
        // 这句file_put_contents是用来查看服务器返回的退款结果 测试完可以删除了
        //file_put_contents(APP_ROOT.'/Api/wxpay/logs/log3.txt',arrayToXml($result),FILE_APPEND);
//        return json($result);
        if ($result['return_code'] == "SUCCESS"){
            return 1;
        }else{
            return -1;
        }
    }
}