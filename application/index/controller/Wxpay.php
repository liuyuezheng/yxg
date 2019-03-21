<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/29
 * Time: 10:31
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
header("Content-type: text/html; charset=utf-8");
class Wxpay extends Base {
    public function callback(){ 
    
     $data = file_get_contents('php://input');
	$result = $this->xmlToArray($data);
	// 判断签名是否正确  判断支付状态
	if ($result['result_code']=='SUCCESS' && $result['return_code']=='SUCCESS') {
		 file_put_contents('test1111.txt','1111111');
		//更新数据库
         $list = DB::table('gxx_recharge')->where('order_num',$result['out_trade_no'])->find();
         $arr = Db::table('gxx_shopinfo')->where('id',$list['shop_id'])->find();
         Db::table('gxx_shopinfo')->where('id',$list['shop_id'])->update(['balance'=>$arr['balance']+$list['money']+$list['send_money']]);
         DB::table('gxx_recharge')->where('order_num',$result['out_trade_no'])->update(['status'=>1]);
         echo "success";
		
	}else{
		 file_put_contents('test22222.txt','2222222');
		  $this->error('支付失败！');

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
    //退款
    public function refund(){
                $appid = 'wx19f9b6be4310ebb1';//appid
                $mch_id = '1521412721'; //商户号
                $nonce_str = $this->nonce_str();//随机字符串
                $refund_fee = 0.01*100;
                $total_fee = 0.01*100;
                $KEY = 'caihongyixianggou111122223333444';
                $order_num='201901281809588218';
                //这里是按照顺序的 因为下面的签名是按照顺序 排序错误 肯定出错
                $parma = array(
                    'appid'=> $appid,
                    'mch_id'=> $mch_id,
                    'nonce_str'=> $nonce_str,
                    'op_user_id' => $mch_id,
                    'out_refund_no'=> $order_num,
                    'out_trade_no'=> $order_num,
                    'refund_fee'=> $refund_fee,
                    'total_fee'=> $total_fee,
                );
                $sign = $this->MakeSign($parma,$KEY);
                $post_xml = '<xml> 
          <appid>'.$appid.'</appid> 
          <mch_id>'.$mch_id.'</mch_id> 
          <nonce_str>'.$nonce_str.'</nonce_str> 
          <op_user_id>'.$mch_id.'</op_user_id> 
          <out_refund_no>'.$order_num.'</out_refund_no> 
          <out_trade_no>'.$order_num.'</out_trade_no> 
          <refund_fee>'.$refund_fee.'</refund_fee> 
          <total_fee>'.$total_fee.'</total_fee>
          <sign>'.$sign.'</sign> 
          </xml>';
                $xmlresult = $this->postXmlSSLCurl($post_xml,'https://api.mch.weixin.qq.com/secapi/pay/refund');
        $result = $this->xml($xmlresult);
        if($result['return_code']=='SUCCESS'){
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