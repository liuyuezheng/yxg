<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/7
 * Time: 10:43
 */

//namespace app\api\controller\v1;
namespace app\api\controller;




use think\cache\driver\Redis;

class Indexre
{
    public function index(){
//        $redis = new \Redis();
        $redis = new Redis();
//        dump($redis);exit;
        $redis->connect('39.98.171.207',6379);
        echo "Connection to server sucessfully";
        exit;
        //查看服务是否运行
        echo "Server is running: " . $redis->ping();
    }
}