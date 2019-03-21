<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/1/13
 * Time: 23:41
 */

namespace app\index\controller;


//use Workerman\Events\React\Base;

use app\index\model\Recharge;

class Recharges extends Base
{
    //充值
    public function index(){
        $recharge=new Recharge();
        $res=input('get.');
        (isset($res['time']) && !empty($res['time'])) ? $where2['r.time']= strtotime($res['time']):$where2=[];
        (isset($res['nameorder']) && !empty($res['nameorder'])) ? $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"]:$where3=[];
        (isset($res['status']) && !empty($res['status'])) ? $where1['r.status']= $res['status']:$where1=[];
             $data=$recharge->alias('r')->join('yx_user u','r.user_id=u.id')
                 ->where($where2)
                 ->where($where3)
                 ->field('u.nickname,u.telephone,r.*')
                 ->paginate(10,false,['query' => $this->request->get()]);
        $page=$data->render();
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }

}