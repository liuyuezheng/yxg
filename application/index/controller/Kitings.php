<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/1/13
 * Time: 18:37
 */

namespace app\index\controller;



use app\index\model\Brokerage;
use app\index\model\Kiting;
use app\index\model\PayDetail;
use app\index\model\User;
use think\Controller;
use think\Db;

class Kitings extends Base
{
    //提现申请
    public function index(){
        $kiting=new Kiting();
        $res=input('get.');
//        (isset($res['time']) && !empty($res['time'])) ? $where2['k.time']= strtotime($res['time']):$where2=[];
        (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
        if(isset($times) && $times!=0){
            $timesArr=explode("~",$times);
            if(trim($timesArr[0])==trim($timesArr[1])){
                $start_time = trim($timesArr[0]);
                $mdays = date( 'd', strtotime(trim($timesArr[1])));
                $end_time = date( 'Y-m-' . $mdays . ' 23:59:59', strtotime(trim($timesArr[1])));
                $where2['k.time']=['between time',[$start_time,$end_time]];
//                    $where2['yx_orders.create_time']=['between time',[$start_time,$end_time]];
//                dump($where3);
            }else{
                $where2['k.time']=['between time',$timesArr];
//                dump($where3);
            }

            $this->assign('times',$res['time']);
        }else{
            $where2=[];
            $this->assign('times','');
        }
/*        (isset($res['nameorder']) && !empty($res['nameorder'])) ? $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"]:$where3=[];*/
        if(isset($res['nameorder']) && !empty($res['nameorder'])){
            $this->assign('nameorder',$res['nameorder']);
            $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"];
        }else{
            $where3=[];
            $this->assign('nameorder','');
        }
        $data=$kiting->alias('k')->join('yx_user u','k.user_id=u.id')
            ->where($where2)
            ->where($where3)
            ->where('k.is_delete',2)
            ->where('k.status',0)
            ->order('k.id desc')
            ->field('u.nickname,u.telephone,k.*')
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$data->render();
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }
    //同意页面
    public function agree(){
        $kiting=new Kiting();
        $res=input('get.');
//        (isset($res['time']) && !empty($res['time'])) ? $where2['k.time']= strtotime($res['time']):$where2=[];
        (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
        if(isset($times) && $times!=0){
            $timesArr=explode("~",$times);
            $where2['k.time']=['between time',$timesArr];
            $this->assign('times',$res['time']);
        }else{
            $where2=[];
            $this->assign('times','');
        }
      /*  (isset($res['nameorder']) && !empty($res['nameorder'])) ? $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"]:$where3=[];*/
        if(isset($res['nameorder']) && !empty($res['nameorder'])){
            $this->assign('nameorder',$res['nameorder']);
            $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"];
        }else{
            $where3=[];
            $this->assign('nameorder','');
        }
        $data=$kiting->alias('k')->join('yx_user u','k.user_id=u.id')
            ->where($where2)
            ->where($where3)
            ->where('k.status',1)
            ->where('k.is_delete',2)
//            ->where('k.id desc')
            ->field('u.nickname,u.telephone,k.*')
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$data->render();
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }
    //拒绝页面
    public function reject(){
        $kiting=new Kiting();
        $res=input('get.');
//        (isset($res['time']) && !empty($res['time'])) ? $where2['k.time']= strtotime($res['time']):$where2=[];
        (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
        if(isset($times) && $times!=0){
            $timesArr=explode("~",$times);
            $where2['k.time']=['between time',$timesArr];
            $this->assign('times',$res['time']);
        }else{
            $where2=[];
            $this->assign('times','');
        }
  /*      (isset($res['nameorder']) && !empty($res['nameorder'])) ? $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"]:$where3=[];*/
        if(isset($res['nameorder']) && !empty($res['nameorder'])){
            $this->assign('nameorder',$res['nameorder']);
            $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"];
        }else{
            $where3=[];
            $this->assign('nameorder','');
        }
        $data=$kiting->alias('k')->join('yx_user u','k.user_id=u.id')
            ->where($where2)
            ->where($where3)
            ->where('k.is_delete',2)
            ->where('k.status',2)
            ->order('k.id desc')
            ->field('u.nickname,u.telephone,k.*')
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$data->render();
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }
    //拒绝原因页面
    public function wherereject($id){
        $this->assign('id',$id);
        return $this->fetch();
    }
//    拒绝原因
    public function uptstatus($id,$content){
        $kiting=new Kiting();
        $user=new User();
        $pay_detail=new PayDetail();
        $bro=new Brokerage();
        $kit=$kiting->where('id',$id)->find();
        $user_detail=$user->where('id',$kit['user_id'])->field('brokerage,balance,unbrokerage')->find();
        if($kit['type2']==1){
//佣金提现
            $brokerage=$user_detail['brokerage']+$kit['money'];
             $user->where('id',$kit['user_id'])->update(['brokerage'=>$brokerage]);
        }else{
//             余额提现
             $balance=$user_detail['balance']+$kit['money'];
             $user->where('id',$kit['user_id'])->update(['balance'=>$balance]);
        }
        $res=$kiting->where('id',$id)->update(['reason'=>$content,'status'=>2,'update_time'=>time()]);
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
    public function allreject($ids){
        foreach ($ids as $k=>$v){
            $kiting=new Kiting();
            $user=new User();
            $pay_detail=new PayDetail();
            $bro=new Brokerage();
            $kit=$kiting->where('id',$v)->find();
            $user_detail=$user->where('id',$kit['user_id'])->field('brokerage,balance,unbrokerage')->find();
            if($kit['type2']==1){
//佣金提现
                $brokerage=$user_detail['brokerage']+$kit['money'];
                $user->where('id',$kit['user_id'])->update(['brokerage'=>$brokerage]);
            }else{
//             余额提现
                $balance=$user_detail['balance']+$kit['money'];
                $user->where('id',$kit['user_id'])->update(['balance'=>$balance]);
            }
            $res=$kiting->where('id',$v)->update(['status'=>2,'update_time'=>time()]);

        }
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
    //同意
    public function agrees($id){
        $kiting=new Kiting();
        $user=new User();
        $pay_detail=new PayDetail();
        $bro=new Brokerage();
        $kit=$kiting->where('id',$id)->find();
        $user_detail=$user->where('id',$kit['user_id'])->field('brokerage,balance,unbrokerage')->find();
        if($kit['type1']==0){//提现到支付宝

         if($kit['type2']==1){
             //佣金提现
             $bro->insert(['user_id'=>$kit['user_id'],'money'=>$kit['money'],'type'=>1,'time'=>time(),'title'=>'佣金提现到支付宝']);
             $pay['title']='佣金提现到支付宝';
             $pay['status']=1;
         }else{
//             余额提现
             $pay['status']=0;
             $pay['title']='余额提现到支付宝';
         }
            $pay['user_id']=$kit['user_id'];
            $pay['money']=$kit['money'];
            $pay['type']=1;
            $pay['time']=time();
            $pay_detail->insert($pay);
        }else{//提现到余额
            //佣金提现
            if($kit['type2']==1){
//                $brokerage=$user_detail['brokerage']-$kit['money'];
                $balance=$user_detail['balance']+$kit['money'];
                $user->where('id',$kit['user_id'])->update(['balance'=>$balance]);
                $pay['user_id']=$kit['user_id'];
                $pay['money']=$kit['money'];
                $pay['type']=1;
                $pay['status']=1;
                $pay['title']='佣金提到余额';
                $pay['time']=time();
                $pay1['user_id']=$kit['user_id'];
                $pay1['money']=$kit['money'];
                $pay1['type']=0;
                $pay1['status']=0;
                $pay1['title']='佣金提到余额';
                $pay1['time']=time();
                $pay_detail->insert($pay);
                $pay_detail->insert($pay1);
                $bro->insert(['user_id'=>$kit['user_id'],'money'=>$kit['money'],'time'=>time(),'type'=>1,'title'=>'佣金提现到余额']);
            }
        }
        $res=$kiting->where('id',$id)->update(['status'=>1,'update_time'=>time()]);
        if($res){
          $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
    //批量同意
    public function allagree($ids){
        foreach ($ids as $k=>$v){
            $kiting=new Kiting();
            $user=new User();
            $pay_detail=new PayDetail();
            $bro=new Brokerage();
            $kit=$kiting->where('id',$v)->find();
            $user_detail=$user->where('id',$kit['user_id'])->field('brokerage,balance,unbrokerage')->find();
            if($kit['type1']==0){//提现到支付宝

                if($kit['type2']==1){
                    //佣金提现
                    $bro->insert(['user_id'=>$kit['user_id'],'money'=>$kit['money'],'type'=>1,'time'=>time(),'title'=>'佣金提现到支付宝']);
                    $pay['title']='佣金提现到支付宝';
                    $pay['status']=1;
                }else{
//             余额提现
                    $pay['status']=0;
                    $pay['title']='余额提现到支付宝';
                }
                $pay['user_id']=$kit['user_id'];
                $pay['money']=$kit['money'];
                $pay['type']=1;
                $pay['time']=time();
                $pay_detail->insert($pay);
            }else{//提现到余额
                //佣金提现
                if($kit['type2']==1){
//                $brokerage=$user_detail['brokerage']-$kit['money'];
                    $balance=$user_detail['balance']+$kit['money'];
                    $user->where('id',$kit['user_id'])->update(['balance'=>$balance]);
                    $pay['user_id']=$kit['user_id'];
                    $pay['money']=$kit['money'];
                    $pay['type']=1;
                    $pay['status']=1;
                    $pay['title']='佣金提到余额';
                    $pay['time']=time();
                    $pay1['user_id']=$kit['user_id'];
                    $pay1['money']=$kit['money'];
                    $pay1['type']=0;
                    $pay1['status']=0;
                    $pay1['title']='佣金提到余额';
                    $pay1['time']=time();
                    $pay_detail->insert($pay);
                    $pay_detail->insert($pay1);
                    $bro->insert(['user_id'=>$kit['user_id'],'money'=>$kit['money'],'time'=>time(),'type'=>1,'title'=>'佣金提现到余额']);
                }
            }
            $res=$kiting->where('id',$v)->update(['status'=>1,'update_time'=>time()]);
        }
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
    //导出
    public function upexcel(){
        $kiting=new Kiting();
        $res=input('get.');
//        (isset($res['time']) && !empty($res['time'])) ? $where2['k.time']= strtotime($res['time']):$where2=[];
        (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
        if(isset($times) && $times!=0){
            $timesArr=explode("~",$times);
            if(trim($timesArr[0])==trim($timesArr[1])){
                $start_time = trim($timesArr[0]);
                $mdays = date( 'd', strtotime(trim($timesArr[1])));
                $end_time = date( 'Y-m-' . $mdays . ' 23:59:59', strtotime(trim($timesArr[1])));
                $where2['k.time']=['between time',[$start_time,$end_time]];
//                    $where2['yx_orders.create_time']=['between time',[$start_time,$end_time]];
//                dump($where3);
            }else{
                $where2['k.time']=['between time',$timesArr];
//                dump($where3);
            }

        }else{
            $where2=[];

        }
        /*        (isset($res['nameorder']) && !empty($res['nameorder'])) ? $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"]:$where3=[];*/
        if(isset($res['nameorder']) && !empty($res['nameorder'])){

            $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"];
        }else{
            $where3=[];
        }
        $data=$kiting->alias('k')->join('yx_user u','k.user_id=u.id')
            ->where($where2)
            ->where($where3)
            ->where('k.is_delete',2)
            ->where('k.status',0)
            ->order('k.id desc')
            ->field('u.nickname,u.telephone,k.alipay,k.wechat,k.time,k.money,k.type1,k.type2,k.status')
            ->select();
//        dump($where3);
        foreach ($data as $k=>$v){
            $data[$k]['time']=date('Y-m-d H:i:s',$v['time']);
            if($v['type1']==0){
                $data[$k]['type1']='支付宝';
            }else{
                $data[$k]['type1']='余额';
            }
            if($v['type2']==0){
                $data[$k]['type2']='余额';
            }else{
                $data[$k]['type2']='佣金';
            }
            if($v['status']==0){
                $data[$k]['status']='申请中';
            }elseif ($v['status']==1){
                $data[$k]['status']='同意';
            }else{
                $data[$k]['status']='拒绝';
            }
        }
        $name='用户提现记录表';
        $header=['昵称','手机号','支付宝用户名','支付宝账号','申请时间','申请金额','提现去向','提现类型','状态' ];
//,'商品名称','商品数量','商品规格'
        exportExcel($header,$data,$name);
    }
    //同意提现导出
    public function upexcel1(){
        $kiting=new Kiting();
        $res=input('get.');
//        (isset($res['time']) && !empty($res['time'])) ? $where2['k.time']= strtotime($res['time']):$where2=[];
        (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
        if(isset($times) && $times!=0){
            $timesArr=explode("~",$times);
            $where2['k.time']=['between time',$timesArr];

        }else{
            $where2=[];

        }
        /*  (isset($res['nameorder']) && !empty($res['nameorder'])) ? $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"]:$where3=[];*/
        if(isset($res['nameorder']) && !empty($res['nameorder'])){

            $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"];
        }else{
            $where3=[];

        }
        $data=$kiting->alias('k')->join('yx_user u','k.user_id=u.id')
            ->where($where2)
            ->where($where3)
            ->where('k.status',1)
            ->where('k.is_delete',2)
            ->field('u.nickname,u.telephone,k.alipay,k.wechat,k.time,k.money,k.type1,k.update_time')
            ->select();
        foreach ($data as $k=>$v){
            $data[$k]['time']=date('Y-m-d H:i:s',$v['time']);
            if($v['type1']==0){
                $data[$k]['type1']='支付宝';
            }else{
                $data[$k]['type1']='余额';
            }

            $data[$k]['update_time']=date('Y-m-d H:i:s',$v['update_time']);
        }
        $name='同意提现记录表';
        $header=['昵称','手机号','支付宝用户名','支付宝账号','申请时间','申请金额','支付类型','支付日期' ];
//,'商品名称','商品数量','商品规格'
        exportExcel($header,$data,$name);
    }
    //拒绝提现导出
    public function upexcel2(){
        $kiting=new Kiting();
        $res=input('get.');
//        (isset($res['time']) && !empty($res['time'])) ? $where2['k.time']= strtotime($res['time']):$where2=[];
        (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
        if(isset($times) && $times!=0){
            $timesArr=explode("~",$times);
            $where2['k.time']=['between time',$timesArr];

        }else{
            $where2=[];

        }
        /*      (isset($res['nameorder']) && !empty($res['nameorder'])) ? $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"]:$where3=[];*/
        if(isset($res['nameorder']) && !empty($res['nameorder'])){

            $where3['u.telephone|u.user_num'] = ['like',"%{$res['nameorder']}%"];
        }else{
            $where3=[];

        }
        $data=$kiting->alias('k')->join('yx_user u','k.user_id=u.id')
            ->where($where2)
            ->where($where3)
            ->where('k.is_delete',2)
            ->where('k.status',2)
            ->order('k.id desc')
            ->field('u.nickname,u.telephone,k.alipay,k.wechat,k.time,k.money,k.type2,k.reason')
            ->select();
        foreach ($data as $k=>$v){
            $data[$k]['time']=date('Y-m-d H:i:s',$v['time']);
            if($v['type2']==0){
                $data[$k]['type2']='余额';
            }else{
                $data[$k]['type2']='佣金';
            }
            if(empty($v['reason'])){
                $data[$k]['reason']='无';
            }
        }
        $name='驳回提现记录表';
        $header=['昵称','手机号','支付宝用户名','支付宝账号','申请时间','申请金额','支付类型','驳回原因' ];
//,'商品名称','商品数量','商品规格'
        exportExcel($header,$data,$name);
    }
}