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
class Wxpay extends Controller{
    public function callback(){ 
     $data = file_get_contents('php://input');
	$result = $this->xmlToArray($data);
    file_put_contents('test1.txt',$result);
	// 判断签名是否正确  判断支付状态
	if ($result['result_code']=='SUCCESS' && $result['return_code']=='SUCCESS') {
		 file_put_contents('test2.txt',$result['out_trade_no']);
         $where = [
            'orders_num'=>$result['out_trade_no']
         ];
        $data = [
            'pay_time'=>time(),
            'status'=>1,
            'pay_status'=>0,
            'type'=>1
        ];
         Db::table('yx_orders')->where($where)->update($data);
         $orders = Db::table('yx_orders')->where($where)->find();
         $list = [
            'user_id'=> $orders['user_id'],
            'title'=>'消费',
            'money'=>$orders['orders_total_price'],
            'type'=>1,
            'time'=>time()
         ];
         Db::table('yx_pay_detail')->insert($list);
		//更新数据库
         // $list = DB::table('gxx_recharge')->where('order_num',$result['out_trade_no'])->find();
         // $arr = Db::table('gxx_shopinfo')->where('id',$list['shop_id'])->find();
         // Db::table('gxx_shopinfo')->where('id',$list['shop_id'])->update(['balance'=>$arr['balance']+$list['money']+$list['send_money']]);
         // DB::table('gxx_recharge')->where('order_num',$result['out_trade_no'])->update(['status'=>1]);
         echo "success";
		
	}else{
		 file_put_contents('test3.txt','2222222');
		  $this->error('支付失败！！！！');

	}


 } 
  
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
  
//微信支付 
public function pay(){ 
     //获取openid  //用code获取openid 
     $arr = input();
     $where = [
        'orders_num'=>$arr['orders_num']
     ];
     $order = Db::table('yx_orders')->where($where)->find();
     $WX_APPID = 'wx19f9b6be4310ebb1';//appid 
     $WX_SECRET = 'ccd3ecb49812f58f894b04a31e47214a';//AppSecret 
     // $url = "https://api.weixin.qq.com/sns/jscode2session?appid=" . $WX_APPID . "&secret=" . $WX_SECRET . "&js_code=" . $arr['code'] . "&grant_type=authorization_code"; 
     // $infos = json_decode(file_get_contents($url)); 
     //dump($infos);die;
     $user = Db::table('yx_user')->where(['id'=>$arr['id']])->find();
     $openid = $user['openID']; 
     //$openid = $infos->openid; 
     $fee = $arr['money'];//举例充值0.01 
     $appid = 'wx19f9b6be4310ebb1';//appid 
     $body =  '消费'; 
     $mch_id = '1521412721'; //商户号 
     $nonce_str = $this->nonce_str();//随机字符串 
     $notify_url = 'https://yxg.mumarenkj.com/api/wxpay/callback'; //回调的url【自己填写】 
     $openid = $openid; 
     $out_trade_no = $arr['orders_num'];//商户订单号 
     $spbill_create_ip = '39.98.171.207';//服务器的ip【自己填写】; 
     $total_fee = 0.01*100;$order['orders_total_price'] * 100;//这里需要*100 
     $trade_type = 'JSAPI';//交易类型 默认 
     $KEY = 'caihongyixianggou111122223333444';
      
     //这里是按照顺序的 因为下面的签名是按照顺序 排序错误 肯定出错 
     $post['appid'] = $appid; 
     $post['body'] = $body; 
     $post['mch_id'] = $mch_id; 
     $post['nonce_str'] = $nonce_str;//随机字符串 
     $post['notify_url'] = $notify_url; 
     $post['openid'] = $openid; 
     $post['out_trade_no'] = $out_trade_no; 
     $post['spbill_create_ip'] = $spbill_create_ip;//终端的ip 
     $post['total_fee'] = $total_fee;//总金额 
     $post['trade_type'] = $trade_type; 

     $sign = $this->MakeSign($post,$KEY);//签名 
     $post_xml = '<xml> 
      <appid>'.$appid.'</appid> 
      <body>'.$body.'</body> 
      <mch_id>'.$mch_id.'</mch_id> 
      <nonce_str>'.$nonce_str.'</nonce_str> 
      <notify_url>'.$notify_url.'</notify_url> 
      <openid>'.$openid.'</openid> 
      <out_trade_no>'.$out_trade_no.'</out_trade_no> 
      <spbill_create_ip>'.$spbill_create_ip.'</spbill_create_ip> 
      <total_fee>'.$total_fee.'</total_fee> 
      <trade_type>'.$trade_type.'</trade_type> 
      <sign>'.$sign.'</sign> 
     </xml>'; 
     //统一接口prepay_id 
     $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder'; 
     $xml = $this->http_request($url,$post_xml); 
     $array = $this->xml($xml);//全要大写 

     if($array['RETURN_CODE'] == 'SUCCESS' && $array['RESULT_CODE'] == 'SUCCESS'){ 
     $time = time(); 
     $tmp=[];//临时数组用于签名 
     $tmp['appId'] = $appid; 
     $tmp['timeStamp'] = (String)$time; 
     $tmp['nonceStr'] = $nonce_str; 
     $tmp['package'] = 'prepay_id='.$array['PREPAY_ID']; 
     $tmp['signType'] = 'MD5'; 
    

     $data['state'] = 200; 
     //$data['appid'] = $appid;
     $data['timeStamp'] = (String)$time;//时间戳 
     $data['nonceStr'] = $nonce_str;//随机字符串 
     $data['package'] = 'prepay_id='.$array['PREPAY_ID'];//统一下单接口返回的 prepay_id 参数值，提交格式如：prepay_id=* 
     $data['signType'] = 'MD5';//签名算法，暂支持 MD5 
     $data['paySign'] = $this->MakeSign($tmp,$KEY);//签名,具体签名方案参见微信公众号支付帮助文档; 
     $data['out_trade_no'] = $out_trade_no; 
   
     }else{ 
     $data['state'] = 0; 
     $data['text'] = "错误"; 
     $data['RETURN_CODE'] = $array['RETURN_CODE']; 
     $data['RETURN_MSG'] = $array['RETURN_MSG']; 
     } 
     echo json_encode($data); 
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

}