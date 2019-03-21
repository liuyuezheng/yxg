<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use app\api\model\Orders as orders_model;
class Callback extends Controller {   
    //支付异步回调 购物回调
    public function cost_asynNotify() {
        $result = file_get_contents('php://input', 'r');
        $result = (array)simplexml_load_string($result, null, LIBXML_NOCDATA);  
        $orders_no = $result['out_trade_no'];                
        $orders = Db::table('yx_orders')->where(['orders_num'=>$orders_no])->find();
        file_put_contents('test.txt', $orders_no);
        if($orders['status']==0){
            $data['status'] = 1;
            $data['pay_status'] = 1;
            $data['pay_time'] = time();
            $data['type'] = 1;
            Db::table('yx_orders')->where(['orders_num'=>$orders_no])->update($data);

             $list = [
                'user_id'=> $orders['user_id'],
                'title'=>'消费',
                'money'=>$orders['orders_total_price'],
                'type'=>1,
                'time'=>time()
             ];
             Db::table('yx_pay_detail')->insert($list);   
             orders_model::ordersinfo($orders['user_id'],$orders['orders_num'],1,1);  
        }               
        $config = Config::get('wechat');

        //验证参数
        (($result['result_code'] !== 'SUCCESS') || ($result['mch_id'] !== $config['mch_id']) || ($result['appid'] !== $config['appid'])) && $this->wechatResult('FAIL', 'invalid param');
        //验证签名
        $this->createSign($result, $config['key']) !== $result['sign'] && $this->wechatResult('FAIL', 'invalid sign');
        //修改状态
        $this->wechatResult('SUCCESS', 'OK');  
    }   
    //支付异步回调 购物回调
    public function cost_asynNotify1() {
        file_put_contents('caihua.txt','22222'); 
        $result = file_get_contents('php://input', 'r');
        $result = (array)simplexml_load_string($result, null, LIBXML_NOCDATA);  
        $orders_no = $result['out_trade_no'];                
        $data['pay_time'] = time();
        $data['status'] = 1;
        $recharge = Db::table('yx_recharge')->where(['order_num'=>$orders_no])->find();
        if($recharge['status'] == 0){
            Db::table('yx_recharge')->where(['order_num'=>$orders_no])->update($data);             
            $user = Db::table('yx_user')->where(['id'=>$recharge['user_id']])->find();
            Db::table('yx_user')->where(['id'=>$recharge['user_id']])->update(['balance'=>$user['balance']+$recharge['money']]);
            file_put_contents('hexin.txt',$recharge['money']);
            $list = [
                'user_id'=> $recharge['user_id'],
                'title'=>'充值',
                'money'=>$recharge['money'],
                'type'=>0,
                'time'=>time()
             ];
             
             Db::table('yx_pay_detail')->insert($list);  
        }   
        $config = Config::get('wechat');
        //验证参数
        (($result['result_code'] !== 'SUCCESS') || ($result['mch_id'] !== $config['mch_id']) || ($result['appid'] !== $config['appid'])) && $this->wechatResult('FAIL', 'invalid param');
        //验证签名
        $this->createSign($result, $config['key']) !== $result['sign'] && $this->wechatResult('FAIL', 'invalid sign');
        //修改状态
        $this->wechatResult('SUCCESS', 'OK');  
    }   
     /**
     * 生成签名
     * @author Steed
     * @param array $data
     * @param $key
     * @return string
     */
     function createSign($data = [], $key) {
        unset($data['sign']);
        //按ASCII字典序排序
        ksort($data);
        $str = '';
        foreach ($data as $k => $val) {
            $str .= $k . '=' . $val . '&';
        }
        $str .= 'key=' . $key;
        return strtoupper(md5($str));
    }

    //微信回调格式化信息输出
     function wechatResult($code, $msg)
    {
        $xml = '<xml>';
        $xml .= '<return_code><![CDATA[' . $code . ']]></return_code>';
        $xml .= '<return_msg><![CDATA[' . $msg . ']]></return_msg>';
        $xml .= '</xml>';
        echo $xml;
        die;
    }
    public function qrcodem() {  
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:POST');
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        vendor('Classes.jssdk');
        $jssdk = new \JSSDK("wx3165431bbf14a929", "93eed538a2ba9ec99fedad8f44aa65e4");
        $signPackage = $jssdk->GetSignPackage();        
        return json_encode($signPackage);
    }
}
