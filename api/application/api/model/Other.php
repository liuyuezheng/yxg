<?php

namespace app\api\model;

use think\Model;
use think\Db;
use think\Session;
class Other extends Model{
    /**
     *发送验证码
     * 
     */ 
    public static function code($telephone){
        $str = '1234567890';
        $randStr = str_shuffle($str);//打乱字符串
        $code = substr($randStr, 0, 4);//substr(string,start,length);返回字符串的一部分
        vendor('alidayu.api_demo.SmsDemo');
        $content = ['code' => $code];
        $response = \SmsDemo::sendSms($telephone, $content,'SMS_157255092');
        if(!empty($response)){
        	Session::set('code',$code);
            return $code;
        }else{
            return "";
        }
   }
   
   /**
    *绑定手机号
    * 
    */
   public static function binding_telephone($id = 0,$telephone = '',$code = ''){
   	    $where = [
           'id'=>$id
   	    ];
   	    $data = [
            'telephone'=>$telephone
   	    ];
   	    $code1 = Session::get('code');
   	    $code = intval($code);
   	    $code1 = intval($code1);
   	     // dump($code);
   	     // dump($code1);die;
   	    // if($code != $code1){
   	    // 	return 3;
   	    // }
   	    if(Db::table('yx_user')->where($data)->find()){
   	    	return 4;
   	    }
        if(Db::table('yx_user')->where($where)->update($data) === false){
             return 2;
        }else{
             return 1;
           
        }
   }
    
}
