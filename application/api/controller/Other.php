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
use app\api\model\Other as other_model;
class Other extends Controller{
    
    /**
     *发送验证码
     * 
     */
    public function code($telephone = ''){
        $code = other_model::code($telephone);
        if(!empty($code)){
           return json_encode(['code'=>1,'data'=>$code,'msg'=>'发送验证码成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'服务器异常！']);
        }
    }

    /**
     *
     * 绑定手机号
     */
    public function binding_telephone($id = 0,$telephone = '',$code = ''){
        $res = other_model::binding_telephone($id,$telephone,$code);
        if($res == 1){
            return json_encode(['code'=>1,'msg'=>'绑定手机号成功！']);
        }else if($res == 2){
            return json_encode(['code'=>2,'msg'=>'服务器异常！']);
        }
         //else if($res == 3){
        //     return json_encode(['code'=>3,'msg'=>'验证码错误！']);
        // }
        else{
            return json_encode(['code'=>4,'msg'=>'该手机号已经绑定！']);
        }
    }

}