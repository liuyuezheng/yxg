<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/28
 * Time: 17:50
 */

namespace app\refund\controller;


use app\refund\model\Admin;
use app\refund\model\AdminRefund;
use think\Controller;
use think\Session;

class Login extends Controller
{
    //登录
    public function login(){
        return $this->fetch();
    }
    //点击登录
    public function goindex($name,$password,$code){
        $pwd= sha1($password);
        $where = [
            'admin'=>$name,
            'password'=>$pwd
        ];
        $list = AdminRefund::where('admin',$name)->find();
        if(empty($list)){
            $this->error('该管理员不存在！');
        }
        $data = AdminRefund::where($where)->find();
        if($data){
//            ($time % (3600*24)) / 3600
            $hours=floor((time()-$data['errorlogin_time'])/3600);
//            if($hours<24){
//                $this->error('该管理员不存在！');
//            }
            if($data['error_count']>=5 && $hours<24){
                $this->error('今日次数已用完,请24小时后再试');
            }else{

                if(!captcha_check($code)) {
                    // 校验失败
                    if($hours>24){
                        $data['error_count']=0;
                    }
                    $users['error_count']=$data['error_count']+1;
                    $users['errorlogin_time']=time();
                    AdminRefund::where(['id'=>$data['id']])->update($users);
                    $this->error('验证码不正确');

                }
                $users['error_count']=0;
                AdminRefund::where(['id'=>$data['id']])->update($users);
//                $users['errorlogin_time']=time();
//                $users['errorlogin_time']=time();
                Session::set('info1',$data);
                $this->success('登录成功');
            }

        }else{
            $hours=floor((time()-$list['errorlogin_time'])/3600);
            $aaa=time()-$list['errorlogin_time'];
//            $bbb=50000437%86400;
            if($list['error_count']>=5 && $hours<24){
                $this->error('今日次数已用完,请24小时后再试');
            }else{
                if($hours>24){
                    $list['error_count']=0;
                }
                $users['error_count']=$list['error_count']+1;
                $users['errorlogin_time']=time();
                AdminRefund::where(['id'=>$list['id']])->update($users);
                $this->error('密码不正确！');
            }

        }




    }
    //验证码
    public function get_verify($id = 1) {
        $config = [
            'expire' => 30, // 验证码过期时间（s）
            'fontSize' => 15, // 验证码字体大小(px)
            'useCurve' => true, // 是否画混淆曲线
            'useNoise' => false, // 是否添加杂点
            'imageH' => 30, // 验证码图片高度
            'imageW' => 130, // 验证码图片宽度
            'length' => 5
        ];
        $verify = new \think\captcha\Captcha($config);
        return $verify->entry($id);
    }
    //退出登录
    public function logout(){
        Session::set('info1','');
        $this->success('退出登录成功！');
    }
    //修改密码
    public function changepwd(){
        return $this->fetch();
    }
    public function changepwds($oldpwd = '' , $pwd = '' , $repwd = ''){
        $data = Session::get('info1');
        if ($pwd != '') {
            $mima = '/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,16}$/';
            if (!preg_match($mima, $pwd)) {
                $arr['msg']='密码有数字.字母组成且6-16位!';
                $arr['code']=2;
                return json($arr);
            }
            if($data['password'] !== sha1($oldpwd)){
//                $arr['msg'] = '原密码错误!';
                $arr['msg']='原密码错误!';
                $arr['code']=2;
                return json($arr);
            }
            if($pwd !== $repwd){
                $arr['msg']='两次密码不一致!';
                $arr['code']=2;
                return json($arr);
            }
            if(sha1($pwd) == sha1($oldpwd)){
//                $arr['msg'] = '原密码错误!';
                $arr['msg']='与原密码一致!';
                $arr['code']=2;
                return json($arr);

            }
        }
        $admin=new AdminRefund();
        $res=$admin->where('id',$data['id'])->update(['password'=>sha1($pwd),'time'=>time()]);
        if($res){
            $arr['msg']='修改成功!';
            $arr['code']=1;
            return json($arr);
        }else{
            $arr['msg']='修改失败!';
            $arr['code']=2;
            return json($arr);
        }

    }
}