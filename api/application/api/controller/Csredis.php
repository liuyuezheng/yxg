<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/24
 * Time: 17:09
 */

namespace app\index\controller;


use think\Controller;

class Csredis extends Controller
{
    public function index(){
    	dump(123);exit;
        // $redis = new \Redis();
        // $redis->connect('127.0.0.1');
        // $redis->set('aa',1);
        // $a=$redis->get('aa');
        // dump($a);exit;
    }

}