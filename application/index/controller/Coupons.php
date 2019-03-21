<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/1/8
 * Time: 22:44
 */

namespace app\index\controller;


use app\index\model\Coupon;
use think\Controller;

class Coupons extends Base
{
    //优惠券
    public function index(){
        $coupon=new Coupon();
        $list=$coupon->where('is_delete',2)->order('id desc')->paginate(10,false,['query' => $this->request->get()]);
        $page=$list->render();
        $list=$list->items();
        foreach ($list as $k=>$v){
            $list[$k]['nums']=$v['num']+$v['get_num'];
            if($v['status']==0){
                $list[$k]['end_time']=$v['end_time'];
            }else{
                $list[$k]['end_time']=date("Y-m-d H:i:s",$v['start']).'~'.date("Y-m-d H:i:s",$v['end']);
            }
        }
        $this->assign('page',$page);
        $this->assign('data',$list);
        return $this->fetch();
    }
    //改变优惠券状态
    public function upstatus($id,$status){
        if($status==0){
            $status1=1;
        }else{
            $status1=0;
        }
        $res['is_putaway']=$status1;
        $coupon=new Coupon();
        $data=$coupon->where('id',$id)->update($res);
        if($data){
            return 1;
        }else{
            return 0;
        }
    }
    //添加优惠券页面展示
    public function add(){
        return $this->fetch();
    }
    //删除优惠券操作
    public function del($id){
        $coupon=new Coupon();
        $data=$coupon->where('id',$id)->update(['is_delete'=>1]);
        if($data){
            return 1;
        }else{
            return 0;
        }
    }
    //增加优惠券操作
    public function adds(){
        $arr=input('post.');
        (isset($arr['start']) && !empty($arr['start'])) ? $arr['start']=strtotime($arr['start']):$arr['start']=0;
        (isset($arr['end']) && !empty($arr['end'])) ? $arr['end']=strtotime($arr['end']):$arr['end']=0;
        (isset($arr['end_time']) && !empty($arr['end_time'])) ? $arr['end_time']:$arr['end_time']=0;
        (isset($arr['limit_num']) && !empty($arr['limit_num'])) ? $arr['limit_num']:$arr['limit_num']=1;

        $arr['time']=time();
        $coupon=new Coupon();
        $data = $coupon->insert($arr);
        if($data){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }
    }
    //编辑页面
    public function edit($did){
        $coupon=new Coupon();
        $data = $coupon->where('id',$did)
            ->find();
        if($data['end']!=0){
            $data['end']=date("Y-m-d H:i:s",$data['end']);
            $data['start']=date("Y-m-d H:i:s",$data['start']);
        }else{
            $data['end']='';
            $data['start']='';
        }

        $this->assign('data',$data);
        return $this->fetch();
    }
    //修改优惠券操作
    public function edits(){
        $coupon=new Coupon();
        $arr=input('post.');
        (isset($arr['start']) && !empty($arr['start'])) ? $arr['start']=strtotime($arr['start']):$arr['start']=0;
        (isset($arr['end']) && !empty($arr['end'])) ? $arr['end']=strtotime($arr['end']):$arr['end']=0;
        (isset($arr['end_time']) && !empty($arr['end_time'])) ? $arr['end_time']:$arr['end_time']=0;
        (isset($arr['limit_num']) && !empty($arr['limit_num'])) ? $arr['limit_num']:$arr['limit_num']=1;
        $num=$coupon->where('id',$arr['id'])->field('num')->find();
        if($arr['line_type']==1){
            $arr['limit_condition']=0;
//line_type0满减限制1无满减限制
        }else{
            $arr['limit_condition']=$arr['limit_condition'];
        }
        $arr['num']=$num['num']+(int)$arr['num'];
        $arr['time']=time();
        $data = $coupon->where('id',$arr['id'])
            ->update($arr);
        if($data){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }
    }

}