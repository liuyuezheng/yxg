<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/1/13
 * Time: 22:00
 */

namespace app\index\controller;


use app\index\model\PayDetail;
use think\Controller;
use think\Db;

class Adjust extends Base
{
    //财务监控日志
    public function index(){
        $pay=new PayDetail();

        $res=input('get.');
//        (isset($res['time']) && !empty($res['time'])) ? $where2['p.time']= strtotime($res['time']):$where2=[];
        (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
        if(isset($times) && $times!=0){
            $timesArr=explode("~",$times);

            if(trim($timesArr[0])==trim($timesArr[1])){
                $start_time = trim($timesArr[0]);
                $mdays = date( 'd', strtotime(trim($timesArr[1])));
                $end_time = date( 'Y-m-' . $mdays . ' 23:59:59', strtotime(trim($timesArr[1])));
                $where2['p.time']=['between time',[$start_time,$end_time]];
//                    $where2['yx_orders.create_time']=['between time',[$start_time,$end_time]];
//                dump($where3);
            }else{
                $where2['p.time']=['between time',$timesArr];
//                dump($where3);
            }
            $this->assign('times',$res['time']);
        }else{
            $where2=[];
            $this->assign('times','');
        }
//        (isset($res['nameorder']) && !empty($res['nameorder'])) ? $where3['u.user_num|u.telephone'] = ['like',"%{$res['nameorder']}%"]:$where3=[];
        if(isset($res['nameorder']) && !empty($res['nameorder'])){
            $where3['u.user_num|u.telephone'] = ['like',"%{$res['nameorder']}%"];
            $this->assign('nameorder',$res['nameorder']);
        }else{
            $where3=[];
            $this->assign('nameorder','');
        }
        (isset($res['type']) && !empty($res['type'])) ?$type= $res['type']:$type=3;
        if ($type==2){
            $where1['p.status']= 0;
            $this->assign('types',$res['type']);
        }elseif ($type==1){
            $where1['p.status']= 1;
            $this->assign('types',$res['type']);
        }else{
            $where1= [];
            $this->assign('types','');
        }
        $data=$pay->alias('p')->join('user u','u.id=p.user_id')
            ->where($where2)
            ->where($where3)
            ->where($where1)
            ->order('p.id desc')
            ->field('u.nickname,u.user_num,u.telephone,p.*')
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$data->render();
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }
    //导出
    public function excel() {

        $data=Db::table('yx_pay_detail')->alias('p')->join('yx_user u','u.id=p.user_id')
            ->field('u.nickname,u.user_num,u.telephone,p.money,p.status,p.time,p.title')
            ->select();
        foreach ($data as $k=>$v){
            if($v['status']==0){
                $data[$k]['status']='余额';
            }else{
                $data[$k]['status']='佣金';
            }
            $data[$k]['time']=date('Y-m-d H:i:s',$v['time']);
        }
        $name='财务调整日志';
        $header=['昵称','用户编号','手机号','调整金额','调整类型','调整时间','调整原因'];
        exportExcel($header,$data,$name);
    }

}