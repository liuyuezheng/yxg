<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/28
 * Time: 17:51
 */

namespace app\refund\controller;


use think\Controller;
use think\Session;

class Base extends Controller
{
    //是否开启验证登录
    protected $is_login = true;
    //用户信息
    protected $member = [];
    public function __construct(){
        parent::__construct();
        //验证登录
        $this->is_login && $this->check_login();
    }

    /**
     * 验证登录
     * @author Steed
     */
    protected function check_login() {
        //获取session信息
        $member = Session::get('info1');
        if (empty($member)) {
            //如果不存在session则验证cookie
            $this->redirect('login/login');
//            //验证成功重新获取session
//            $member = Session::get('info');
        }
    }
}