<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/21
 * Time: 16:58
 */

namespace app\index\controller;


use Redis\RedisPackage;
use think\Controller;


class Redistest extends Controller
{
    public function reTest(){
        $redis=new RedisPackage();
        $redis->set('ten','111');
        $res=$redis->get('ten');
        echo $res;
    }

}