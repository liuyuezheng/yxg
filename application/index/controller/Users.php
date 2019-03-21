<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/14
 * Time: 10:29
 */

namespace app\index\controller;


use app\index\model\BrokerageAllocation;
use app\index\model\Coupon;
use app\index\model\ExpectBrokerage;
use app\index\model\Integral;
use app\index\model\Kiting;
use app\index\model\MyCoupon;
use app\index\model\Orders;
use app\index\model\PayDetail;
use app\index\model\User;
use app\index\model\UserLink;
use think\Controller;
use think\Db;
use think\Model;

class Users extends Base
{
    //普通用户列表
    public function index(){
        $res=input('get.');
        $user=new User();
        $order=new Orders();
        $link=new UserLink();
        (isset($res['order_type']) && !empty($res['order_type'])) ? $status= $res['order_type']:$status=4;
        if($status==1){
            $where1['telephone']=['like',"%{$res['nameorder']}%"];
            $this->assign('types',$res['order_type']);
            $this->assign('names',$res['nameorder']);
        }elseif ($status==2){
            $where1['nickname']=['like',"%{$res['nameorder']}%"];
            $this->assign('types',$res['order_type']);
            $this->assign('names',$res['nameorder']);
        }elseif ($status==3){
            $where1['user_num']=['like',"%{$res['nameorder']}%"];
            $this->assign('types',$res['order_type']);
            $this->assign('names',$res['nameorder']);
        }else{
            if(isset($res['nameorder']) && !empty($res['nameorder'])){
                $where1['telephone|nickname|user_num'] = ['like',"%{$res['nameorder']}%"];
            }else{
                $where1=[];
            }


//            $where1=[];
            $this->assign('types','');
            $this->assign('names','');
        }
        $data=$user
            ->where('grade',0)
            ->where($where1)
            ->order('id desc')
            ->field('pid,id,nickname,user_num,head_image,telephone,grade,balance,integral')
//            ->field('pid,id,nickname,user_num,head_image,telephone,grade,balance,brokerage,remain_brokerage,integral,sales_count,retail_time,ceo_time,errorlogin_time')
            ->paginate(10,false,['query' => $this->request->get()]);

        $page=$data->render();
        $data=$data->items();

        foreach ($data as $k=>$v){
        //直属上级昵称
            if($v['pid']!=0){
                $ups=$user->where('id',$v['pid'])->find();
                if($ups){
                    $data[$k]['up_name']=$ups['nickname'];
                }else{
                    $data[$k]['up_name']='无';
                }
            }else{
                $data[$k]['up_name']='无';
            }
            //直属董事
            $links=$link->where('user_id',$v['id'])->find();
            $linkId=explode(',',$links['link_id']);
            $linkGrade=explode(',',$links['link_grade']);
            if(in_array('董事',$linkGrade)){

               $key=array_search('董事',$linkGrade);
                $uid=$linkId[$key];
                $fist=$user->where('id',(int)$uid)->field('nickname')->find();
                $data[$k]['manager_name']=$fist['nickname'];
                $data[$k]['first_manager']=(int)$uid;
            }else{
                $data[$k]['first_manager']=0;
                $data[$k]['manager_name']='无';
            }
            //消费总额
            $consumes=$this->consume($v['id']);
            $data[$k]['consumes']=$consumes['num'];
        }
//var_dump($data);
//        die();
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }

    //总代董事
    public function superior(){
        $res=input('get.');
        $user=new User();
        $order=new Orders();
      /*  (isset($res['grade_type']) && !empty($res['grade_type'])) ? $where2['grade']= $res['grade_type']:$where2['grade']=['in','1,2'];*/
        if(isset($res['grade_type']) && !empty($res['grade_type'])){
            $where2['grade']= $res['grade_type'];
            $this->assign('grades',$res['grade_type']);
        }else{
            $where2['grade']=['in','1,2'];
            $this->assign('grades','');
        }
        (isset($res['order_type']) && !empty($res['order_type'])) ? $status= $res['order_type']:$status=4;
        if($status==1){
            $where1['telephone']=['like',"%{$res['nameorder']}%"];
            $this->assign('types',$res['order_type']);
            $this->assign('names',$res['nameorder']);
        }elseif ($status==2){
            $where1['nickname']=['like',"%{$res['nameorder']}%"];
            $this->assign('types',$res['order_type']);
            $this->assign('names',$res['nameorder']);
        }elseif ($status==3){
            $where1['user_num']=['like',"%{$res['nameorder']}%"];
            $this->assign('types',$res['order_type']);
            $this->assign('names',$res['nameorder']);
        }else{
            if(isset($res['nameorder']) && !empty($res['nameorder'])){
                $where1['telephone|nickname|user_num'] = ['like',"%{$res['nameorder']}%"];
            }else{
                $where1=[];
            }
            $this->assign('types','');
            $this->assign('names','');
        }
        $data=$user->where($where2)
            ->where($where1)
            ->order('id desc')
            ->field('pid,id,nickname,user_num,head_image,telephone,grade,balance,integral')
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$data->render();
        $data=$data->items();
        foreach ($data as $k=>$v){
            //直属上级昵称
            if($v['pid']!=0){
                $ups=$user->where('id',$v['pid'])->find();
                if($ups){
                    $data[$k]['up_name']=$ups['nickname'];
                }else{
                    $data[$k]['up_name']='无';
                }

            }else{
                $data[$k]['up_name']='无';
            }
            //消费总额
            $consumes=$this->consume($v['id']);
            $data[$k]['consumes']=$consumes['num'];
        }
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }
//    用户详情页
    public function indexdetail($id){
      $data=$this->detail($id);
//      print_r($data);
//      exit();
      $this->assign('data',$data);
        $this->assign('id',$id);
      return $this->fetch();
    }
//    董事总代信息详情页
    public function superiordetail(){
        $id=input('id/d');
        if(isset($id) && !empty($id)){
            session('userid',$id);
        }else{
            $id=session('userid');
        }
        $data=$this->detail($id);

//        提现记录
        $kit=new Kiting();
        $kits=$kit->where('user_id',$id)
            ->where('is_delete',2)
            ->where('status',1)
            ->field('money,update_time')
            ->paginate(5,false,['query' => $this->request->get()]);
        $page=$kits->render();
        $this->assign('page',$page);
        $this->assign('kits',$kits);
        $this->assign('data',$data);
        $this->assign('id',$id);
        return $this->fetch();
    }
//    用户详情数据
    public function detail($id){
        $user=new User();
        $order=new Orders();
        $link=new UserLink();
        $my_coupon=new MyCoupon();
        $data=$user->where('id',$id)
            ->find();
        if($data['pid']!=0){
            $ups=$user->where('id',$data['pid'])->find();
            $data['up_name']=$ups['nickname'];
            //直属董事
            $links=$link->where('user_id',(int)$id)->find();
            $linkId=explode(',',$links['link_id']);
            $linkGrade=explode(',',$links['link_grade']);
            if(in_array('董事',$linkGrade)){
                $key1=array_search('董事',$linkGrade);
                $key2=array_search($id,$linkGrade);
                if($key1==$key2){
                    $key=$key1+1;
                }else{
                    $key=$key1;
                }
                if($linkGrade[$key]=='董事'){
                    $uid=$linkId[$key];
                    $fist=$user->where('id',(int)$uid)->field('nickname')->find();
                    $data['manager_name']=$fist['nickname'];
                }else{
                    $data['manager_name']='无';
                }
            }else{
                $data['manager_name']='无';
            }
        }else{
            $data['up_name']='无';
            $data['manager_name']='无';
        }
        //        优惠券
        $data['my_coupon']=$my_coupon->alias('m')->join('yx_coupon c','c.id=m.coupon_id')
            ->where('c.is_delete',2)
            ->where('m.user_id',$id)
            ->count();
        //余额变动记录
        $info=$this->balances($id);
        $data['balance_num']=$info['balance_num'];
        //消费总额  总订单 月消费总额  月消费订单
        $consumes=$this->consume($id);
        $data['consumes']=$consumes['num'];
        $data['order_nums']=$consumes['order_num'];
        $data['month_consumes']=$consumes['month_num'];
        $data['month_order_nums']=$consumes['month_order_num'];
        return $data;
    }
    //余额变动记录列表
    public function changebalance($id){
        $info=$this->balances($id);
        $data=$info['balance'];
        $page=$info['page'];
        $this->assign('data',$data);
        $this->assign('page',$page);
        return $this->fetch();
    }
    //余额变动记录
    public function balances($id){
        $detail=new PayDetail();
        $balance_count=$detail->where('status',0)
            ->where('user_id',$id)->count();
        $balance=$detail->where('status',0)
            ->where('user_id',$id)
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$balance->render();
        $balance_num=$balance_count;
        $data=[];
        $data['balance']=$balance;
        $data['balance_num']=$balance_num;
        $data['page']=$page;
        return $data;
    }

//    consume用户消费总价
    public function consume($id){

        $order=new Orders();
        $start_time = date( 'Y-m-1 00:00:00', time() );
        $mdays = date( 't', time() );
        $end_time = date( 'Y-m-' . $mdays . ' 23:59:59', time() );
//        总订单
        $orders=Db::table('yx_orders')->join('yx_orders_detail d','yx_orders.id=d.order_id')
            ->where('d.status','in','9,1,4')
            ->where('yx_orders.user_id',$id)
            ->where('yx_orders.status',3)
            ->field('d.real_pay')
            ->select();
        $num=0;

        foreach ($orders as $key=>$val){
            $num=$num+$val['real_pay'];
        }
        //本月订单
        $month_orders=Db::table('yx_orders')->alias('o')->join('yx_orders_detail d','o.id=d.order_id')->where('o.user_id',$id)
            ->where('d.status','in','9,1,4')
            ->where('o.create_time','between time', [$start_time, $end_time])
            ->where('o.status',3)
            ->field('d.real_pay')
            ->select();
//       print_r($month_orders);
//       exit;
        $month_num=0;
        foreach ($month_orders as $k=>$v){
            $month_num=$month_num+$v['real_pay'];
        }
        $month_nums=count($month_orders);
        $count['month_num']=$month_num;
        $count['month_order_num']=$month_nums;
        $nums=count($orders);

        $count['num']=$num;
        $count['order_num']=$nums;
        return $count;
    }
    //预计佣金
    public function expect(){
        $id=input('id/d');
        if(isset($id) && !empty($id)){
            session('userid',$id);
        }else{
            $id=session('userid');
        }
        $expect=new ExpectBrokerage();
        $orders=new Orders();
        $data=$expect->alias('b')->join('yx_orders_detail o','o.id=b.order_id')
            ->where('b.status',2)
            ->where('b.user_id',$id)
            ->where('b.is_delete',2)
            ->field('b.*,o.goods_name,o.order_id as dorder_id')
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$data->render();
//        哪个用户购买商品分得的佣金
        $data=$data->items();
        foreach ($data as $k=>$v){
            $names=$orders->alias('d')->join('yx_user u','u.id=d.user_id')
                ->where('d.id',$v['dorder_id'])
                ->field('u.nickname')
                ->find();
            $data[$k]['nickname']=$names['nickname'];
        }
//        dump($data);
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }
//    导出预计佣金
    public function excel_pay($id){

    }
    //导出下级用户
    public function excel($id){
        $data=Db::table('yx_user')->where('pid',$id)
            ->field('id,nickname,user_num,grade')
            ->select();
        foreach ($data as $k=>$v){

            if($v['grade']==0){
                $data[$k]['grade']="普通用户";
            }elseif ($v['grade']==1){
                $data[$k]['grade']="总代";
            }else{
                $data[$k]['grade']="董事";
            }

        }
        $name='直属下级用户';
        $header=['ID','昵称','用户编号','身份'];
        exportExcel($header,$data,$name);
    }
    //用户编辑页面
    public function edits($id){
//        dump($id);
//        die();
        $users=new User();
        $coupon=new Coupon();
        $myCoupons=new MyCoupon();
        $user=$users->where('id',$id)->field('id,balance,integral,brokerage,grade')->find();
        //发放优惠券 优惠券表0全部 1普通 2 总代 3 董事   用户表 0表示普通用户，1表示总代，2表示董事
        if($user['grade']==0){
            $where['grade']=['in','0,1'];
        }elseif ($user['grade']==1){
            $where['grade']=['in','0,2'];
        }else{
            $where['grade']=['in','0,3'];
        }
        $coupons=$coupon->where('type',1)
            ->where('num','>',0)
            ->where($where)
            ->where('is_delete',2)
            ->where('is_putaway',1)
            ->field('id,line_type,name,limit_condition,limit_money,limit_num,status,end')
            ->select();
        $where2['user_id']=$id;
        foreach ($coupons as $k=>$v){
          $where2['coupon_id']=$v['id'];
          $mycous=$myCoupons->where($where2)->count();
          if($mycous>=$v['limit_num']){
              unset($coupons[$k]);
          }elseif ($v['status']==1){
              if(time()>$v['end']){
                  unset($coupons[$k]);
              }
              if($v['line_type']==1){
                  $coupons[$k]['id']=$v['id'];
                  $coupons[$k]['name']=$v['name'];
                  $coupons[$k]['limit_condition']=$v['limit_condition'];
                  $coupons[$k]['limit_money']=$v['limit_money'];
                  $coupons[$k]['line_type']='无满减限制';
              }else{
                  $coupons[$k]['name']=$v['name'];
                  $coupons[$k]['limit_condition']=$v['limit_condition'];
                  $coupons[$k]['limit_money']=$v['limit_money'];
                  $coupons[$k]['id']=$v['id'];
                  $coupons[$k]['line_type']='满减限制';
              }
          }else{
              $coupons[$k]['id']=$v['id'];
              $coupons[$k]['name']=$v['name'];
              $coupons[$k]['limit_condition']=$v['limit_condition'];
              $coupons[$k]['limit_money']=$v['limit_money'];
              if($v['line_type']==1){
                  $coupons[$k]['line_type']='无满减限制';
              }else{
                  $coupons[$k]['line_type']='满减限制';
              }
          }

        }
//        var_dump($coupons);
//        die();
        $this->assign('coupons_info',$coupons);
        $this->assign('user_info',$user);
        return $this->fetch();
//        return $user;
    }
    //用户修改
    public function edit(){
        $arr=input('post.');
        //用户旧信息
        $user=new User();
        $my_coupon=new MyCoupon();
        $allfen=new BrokerageAllocation();
        $tableIntegral=new Integral();
        $old_user=$user->where('id',(int)$arr['user_id'])->field('id,pid,grade,balance,brokerage,remain_brokerage,integral')->find();
        $allfens=$allfen->where('user_id',(int)$arr['user_id'])->find();
//        是否改变内容 1 无改变 2赠送优惠券 3 用户信息改变
        $upedit_type=$this->upedit($arr,$old_user);
        if($upedit_type==1){
           $this->success('无改变');
        }elseif ($upedit_type==2){
            $res=$this->addcoupon($arr['coupons'],$arr['user_id']);
            if($res){
                $this->success('操作成功');
            }else{
                $this->error('操作失败');
            }

        }else{
            $res1=$this->addcoupon($arr['coupons'],$arr['user_id']);
            //用户积分
//            $users['integral']=$arr['integral'];
            /*      addintegral:addintegral,
                    jianintegral:jianintegral,
                    whyaddintegral:whyaddintegral,
                    whyjianintegral:whyjianintegral,*/
//            积分调整
            (isset($arr['addintegral']) && !empty($arr['addintegral']))?$addintegral=(float)$arr['addintegral'] : $addintegral=0;
            (isset($arr['jianintegral']) && !empty($arr['jianintegral']))?$jianintegral=(float)$arr['jianintegral'] : $jianintegral=0;
            if($addintegral!=0){
                $integral=$old_user['integral']+$addintegral;
                $users['integral']=$integral;
                $integrals['user_id']=(int)$arr['user_id'];
                $integrals['integral']=$addintegral;
                (isset($arr['whyaddintegral']) && !empty($arr['whyaddintegral']) )? $integrals['title']=$arr['whyaddintegral'] : $integrals['title']="调整积分增加";
            }
            if($jianintegral != 0){
                $integral=$old_user['integral']-$jianintegral;
                if($integral<0){
                    $users['integral']=0;
                    $integrals['user_id']=(int)$arr['user_id'];
                    $integrals['integral']=$old_user['integral'];

                }else{
                    $users['integral']=$integral;
                    $integrals['user_id']=(int)$arr['user_id'];
                    $integrals['integral']=$jianintegral;
                }
                (isset($arr['whyjianintegral']) && !empty($arr['whyjianintegral']) )? $integrals['title']=$arr['whyjianintegral'] : $integrals['title']="调整积分减少";
            }
            if($addintegral==0 && $jianintegral==0){
                $integrals=[];
            }
            if(!empty($integrals)){
                $tableIntegral->insert($integrals);
            }
//            判断余额或佣金减少还是增加
            (isset($arr['addbrokerage']) && !empty($arr['addbrokerage']))?$addmoney=(float)$arr['addbrokerage'] : $addmoney=0;
            (isset($arr['jianbrokerage']) && !empty($arr['jianbrokerage']))?$jianmoney=(float)$arr['jianbrokerage'] : $jianmoney=0;
            (isset($arr['addbrokerage2']) && !empty($arr['addbrokerage2']))?$addmoney2=(float)$arr['addbrokerage2'] : $addmoney2=0;
            (isset($arr['jianbrokerage2']) && !empty($arr['jianbrokerage2']))?$jianmoney2=(float)$arr['jianbrokerage2'] : $jianmoney2=0;
            //用户余额 佣金
            if($old_user['grade']==0){
                //        调整用户余额
                if($addmoney!=0){
                    $users['balance']=$old_user['balance']+$addmoney;
                    $pay['user_id']=(int)$arr['user_id'];
                    $pay['money']=$addmoney;
                    $pay['status']=0;
                    $pay['type']=0;
                    $pay['time']=time();
                    (isset($arr['why1']) && !empty($arr['why1'])) ? $pay['title']=$arr['why1'] : $pay['title']="调整余额增加";
                }
                if($jianmoney!=0){
                    //余额修改后是否小于0
                    $jianMon=$old_user['balance']-$jianmoney;
                    if($jianMon<0){
                        $users['balance']=0;
                    }else{
                        $users['balance']=$jianMon;
                    }
                    $pay['user_id']=(int)$arr['user_id'];
                    $pay['money']=$jianmoney;
                    $pay['status']=0;
                    $pay['type']=1;
                    $pay['time']=time();
                    (isset($arr['why2']) && !empty($arr['why2']) )? $pay['title']=$arr['why2'] : $pay['title']="调整余额减少";
                }
                if($addmoney==0 && $jianmoney==0){
                    $pay=[];
                }

            }else{
                //调整佣金
                if($addmoney!=0){
                    $users['brokerage']=$old_user['brokerage']+$addmoney;
                    $pay['user_id']=(int)$arr['user_id'];
                    $pay['money']=$addmoney;
                    $pay['status']=1;
                    $pay['type']=0;
                    $users['remain_brokerage']=$old_user['remain_brokerage']+$addmoney;
                    $pay['time']=time();
                    isset($arr['why1']) && !empty($arr['why1']) ? $pay['title']=$arr['why1'] : $pay['title']="调整佣金增加";
                    $bros['time']=time();
                    $bros['type']=0;
                    $bros['money']=$addmoney;
                    $bros['user_id']=(int)$arr['user_id'];
                    isset($arr['why']) && !empty($arr['why1']) ? $bros['title']=$arr['why1'] : $bros['title']="调整佣金增加";
                }
                if($jianmoney!=0){
                    $jianMon=$old_user['brokerage']-$jianmoney;
                    if($jianMon<0){
                        $users['brokerage']=0;
                    }else{
                        $users['brokerage']=$jianMon;
                    }
                    $pay['user_id']=(int)$arr['user_id'];
                    $pay['money']=$jianmoney;
                    $pay['status']=1;
                    $pay['type']=1;
                    $pay['time']=time();
                    isset($arr['why2']) && !empty($arr['why2']) ? $pay['title']=$arr['why2'] : $pay['title']="调整佣金减少";
//                    $pay['title']="现佣金减少";
                    $bros['time']=time();
                    $bros['type']=1;
                    $bros['money']=$jianmoney;
                    $bros['user_id']=(int)$arr['user_id'];
                    isset($arr['why2']) && !empty($arr['why2']) ? $bros['title']=$arr['why2'] : $bros['title']="调整佣金减少";
//                    isset($arr['why2']) && !empty($arr['why2']) ? $pay['title']=$arr['why2'] : $pay['title']="调整余额减少";
                }
           //调整余额
                //        调整用户余额
                if($addmoney2!=0){
                    $users['balance']=$old_user['balance']+$addmoney2;
                    $pay1['user_id']=(int)$arr['user_id'];
                    $pay1['money']=$addmoney2;
                    $pay1['status']=0;
                    $pay1['type']=0;
                    $pay1['time']=time();
                    isset($arr['title']) && !empty($arr['title']) ? $pay1['title']=$arr['title'] : $pay1['title']="调整余额增加";
                }
                if($jianmoney2!=0){
//                    $users['balance']=$old_user['balance']-$jianmoney2;
                    $jianMon2=$old_user['balance']-$jianmoney2;
                    if($jianMon2<0){
                        $users['balance']=0;
                    }else{
                        $users['balance']=$jianMon2;
                    }
                    $pay1['user_id']=(int)$arr['user_id'];
                    $pay1['money']=$jianmoney2;
                    $pay1['status']=0;
                    $pay1['type']=1;
                    $pay1['time']=time();
                    isset($arr['title2']) && !empty($arr['title2']) ? $pay1['title']=$arr['title2'] : $pay1['title']="调整余额减少";
                }
                if($addmoney==0 && $jianmoney==0){
                    $pay=[];
                }
                if($addmoney2==0 && $jianmoney2==0){
                    $pay1=[];
                }

            }
//            print_r($pay1);
//            exit();
            if(isset($pay) && !empty($pay)){
                Db::table('yx_pay_detail')->insert($pay);
            }
            if(isset($pay1) && !empty($pay1)){
                Db::table('yx_pay_detail')->insert($pay1);
            }
            if(isset($bros) && !empty($bros)){
                Db::table('yx_brokerage')->insert($bros);
            }

            //身份权限
            $users['grade']=(int)$arr['grade'];
                        if((int)$arr['grade']==1){
                            //         总代
                            $users['retail_time']=time();
                            $users['ceo_time']=0;
                        }else if((int)$arr['grade']==2){
                            //董事
                            $users['ceo_time']=time();
                            $users['retail_time']=0;
                        }else{
                            //普通用户
                            $users['ceo_time']=0;
                            $users['retail_time']=0;
                        }
            $res=$user->where('id',$old_user['id'])->update($users);

            //      身份分配表更新
            if($arr['grade']!=$old_user['grade']){
                $ee=$this->upuser((int)$arr['user_id'],(int)$arr['grade']);
            }
            if($res || $res1){
                $this->success('操作成功');
            }else{
                $this->error('操作失败');
            }
        }


    }
    //修改上下级
    public function editup(){
        $arr=input('get.');
        //用户旧信息
        $user=new User();
        $olduser=$user->where('id',(int)$arr['id'])->field('id,pid,nickname,grade')->find();
//        原上级
        $oldpid=$user->where('id',$olduser['pid'])->field('id,nickname')->find();
        if($olduser['grade']==0){
            $olduser['grade']='普通用户';
            $where['grade']=['in','0,1,2'];
        }elseif ($olduser['grade']==1){
            $olduser['grade']='总代';
            $where['grade']=['in','1,2'];
        }else{
            $olduser['grade']='董事';
            $where['grade']=['eq',2];
        }
        //可选上级
        $puser=$user->where($where)->where('id','NEQ',(int)$arr['id'])->field('id,nickname')->select();
        $this->assign('puser',$puser);
        $this->assign('oldpid',$oldpid);
        $this->assign('olduser',$olduser);
        return $this->fetch();
    }
    //查询用户
    public function showup($phone,$id,$pid){
        $user=new User();
        $users=$user->where('id',$id)->field('telephone,grade')->find();
        if($users['grade']==0){
            $arr=[0,1,2];
        }elseif ($users['grade']==1){
            $arr=[1,2];
        }else{
            $arr=[2];
        }
        $pusers=$user->where('id',$pid)->field('telephone')->find();
        if($users['telephone']===$phone){
            return json(['code'=>0,'msg'=>'用户自己的手机号']);
        }
        if($pusers['telephone']===$phone){
            return json(['code'=>0,'msg'=>'用户原上级的手机号']);
        }
        if( preg_match("/^1[3456789]{1}\d{9}$/",$phone)){
            $res=$user->where('telephone',$phone)->field('head_image,nickname,id,grade')->find();
            if(empty($res)){
                return json(['code'=>0,'data'=>$res,'msg'=>'无此用户']);
            }else{
                if(!in_array($res['grade'],$arr)){
                    return json(['code'=>0,'msg'=>'需高于或等于用户的身份']);
                }else{
                    return json(['code'=>1,'data'=>$res,'msg'=>'成功']);
                }
            }
        }else{
            $res=[];
            return json(['code'=>0,'data'=>$res,'msg'=>'手机号规则有误']);
        }

    }
    //更改关系
    public function uplink($id,$pid){
        $user=new User();
        $link=new UserLink();
        $res=Db::table('yx_user_link')->whereOr('link_id','like','%,'.$id.',%')
            ->whereOr('link_id','like',$id.',%')
            ->whereOr('link_id','like','%,'.$id)
            ->whereOr('link_id',(string)$id)
//            ->fetchSql()
            ->select();
        $pidlink=$link->where('user_id',(int)$pid)->field('link_id,link_grade')->find();
        $list=$this->isloop($pidlink['link_id'],$id);
        if($list){
            foreach ($res as $k=>$v){
                $linkId=explode(',',$v['link_id']);
                $linkGrade=explode(',',$v['link_grade']);
//            count($linkId);
                $array=array_flip($linkId);
                $key=$array[$id];
                $num=count($linkId);
//            var_dump(count($linkId));
                for($i=$key+1;$i<$num;$i++){
                    unset($linkId[$i]);
                    unset($linkGrade[$i]);
                }
//            var_dump($linkId);
//            var_dump($linkGrade);
                $res[$k]['link_grade']= implode(',',$linkGrade).','.$pidlink['link_grade'];
                $res[$k]['link_id']= implode(',',$linkId).','.$pidlink['link_id'];
            }
//        var_dump($res);exit();
            $isup=$link->isUpdate()->saveAll($res);
            $isid=$user->where('id',(int)$id)->update(['pid'=>(int)$pid]);
            if($isup && $isid){
                $this->success('操作成功');
            }else{
                $this->error('操作失败');
            }
        }

//        var_dump($res);
    }
    //p判断是否形成闭环
    public function isloop($pidlink,$id){
        $linkArr=explode(',',$pidlink);
        if(in_array($id,$linkArr)){
            $this->error('操作有误，形成闭环');
        }else{
            return true;
        }
    }
//    每周财务数据
    public function week_user($id){
//      订单金额
//        订单数
//        佣金金额
        //本周每日注册人数
        $arr[0] = time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600;
        $arr[1] = time() - ((date('w') == 0 ? 7 : date('w')) - 2) * 24 * 3600;
        $arr[2] = time() - ((date('w') == 0 ? 7 : date('w')) - 3) * 24 * 3600;
        $arr[3] = time() - ((date('w') == 0 ? 7 : date('w')) - 4) * 24 * 3600;
        $arr[4] = time() - ((date('w') == 0 ? 7 : date('w')) - 5) * 24 * 3600;
        $arr[5] = time() - ((date('w') == 0 ? 7 : date('w')) - 6) * 24 * 3600;
        $arr[6] = time() - ((date('w') == 0 ? 7 : date('w')) - 7) * 24 * 3600;
        $new = array();
        foreach ($arr as $k => $v) {//一天开始到结束的时间戳
        $arr[$k] = date('Y/m/d', $v);
        $new[$k]['start'] = mktime(0, 0, 0, date("m", $v), date("d", $v), date("Y", $v));
        $new[$k]['end'] = mktime(23, 59, 59, date("m", $v), date("d", $v), date("Y", $v));
        }
        foreach ($new as $k1=>$v1){
//      订单金额
//        订单数
//        佣金收入
            $where=[
                'user_id'=>$id,
                'status'=>3,
                'accomplish_time'=>['between', [$v1['start'], $v1['end']]]
            ];
            $where1=[
                'user_id'=>$id,
                'type'=>0,
                'time'=>['between', [$v1['start'], $v1['end']]]
            ];
            $order_money=Db::table('yx_orders')->where($where)->select();
            $price=0;
            foreach ($order_money as $key=>$val){
                $price+=$val['orders_total_price'];
            }
            $num=Db::table('yx_orders')->where($where)->count();
            $bro_price=Db::table('yx_brokerage')->where($where1)->select();
            $bro_prices=0;
            foreach ($bro_price as $key=>$val){
                $bro_prices+=$val['money'];
            }
            $week_pay['orders_prices'][]=$price;
            $week_pay['num'][]=$num;
            $week_pay['bro_prices'][]=$bro_prices;
        }
       return ['code'=>1,'data'=>$week_pay];
//        return json($week_pay);
    }
//    身份分配表更新
    //用户更换身份传用户id 以及身份type 0普通用户 1总代 2董事
    public function upuser($id,$type){
        $user=new User();
        $link=new UserLink();
        $res=Db::table('yx_user_link')->whereOr('link_id','like','%,'.$id.',%')
            ->whereOr('link_id','like',$id.',%')
            ->whereOr('link_id','like','%,'.$id)
            ->whereOr('link_id',(string)$id)
            ->select();
        //用户更换身份传用户id 以及身份type 0普通用户 1总代 2董事
        foreach ($res as $k=>$v){
            $linkId=explode(',',$v['link_id']);
            $linkGrade=explode(',',$v['link_grade']);
            $array=array_flip($linkId);
            $key=$array[$id];
            if($type==1){
                $linkGrade[$key]='总代';
            }elseif($type==2){
                $linkGrade[$key]='董事';
            }else{
                $linkGrade[$key]='普通用户';
            }

            $res[$k]['link_grade']= implode(',',$linkGrade);
        }
        $up=$link->isUpdate()->saveAll($res);
    }
/*    public function update_brokerage(){
        $user=new User();
        $bro=new BrokerageAllocation();
        $bro->where('id','>',0)->delete();
        $info=$user->field('id,pid,grade')->order('id asc')->select();
        foreach ($info as $k=>$v){
            if($v['pid']!=0){
                //上级用户信息
                $up_grade=$user->where('id',$v['pid'])->field('id,grade')->find();
                $pid_bro=$bro->where('user_id',$v['pid'])->find();
                if($up_grade['grade']==0){
//                    普通用户
//                    $aa=['user_id'=>$v['id'],
//                     'first_agent'=>$pid_bro['first_agent'],
//                     'second_agent'=>$pid_bro['second_agent'],
//                     'three_agent'=>$pid_bro['three_agent'],
//                     'first_manager'=>$pid_bro['first_manager'],
//                     'second_manager'=>$pid_bro['second_manager']
//                    ];
//                    ];
//                    print_r($aa);
//                    exit();
                    $bro->insert(['user_id'=>$v['id'],
                                  'first_agent'=>$pid_bro['first_agent'],
                                  'second_agent'=>$pid_bro['second_agent'],
                                  'three_agent'=>$pid_bro['three_agent'],
                                  'first_manager'=>$pid_bro['first_manager'],
                                  'second_manager'=>$pid_bro['second_manager']
                                  ]);

                }elseif($up_grade['grade']==1){
//                    总代
//                    $aa=['user_id'=>$v['id'],
//                         'first_agent'=>$v['pid'],
//                         'second_agent'=>$pid_bro['first_agent'],
//                         'three_agent'=>$pid_bro['second_agent'],
//                         'first_manager'=>$pid_bro['first_manager'],
//                         'second_manager'=>$pid_bro['second_manager']
//                    ];
//                    print_r($aa);
//                    exit();
                    $bro->insert(['user_id'=>$v['id'],
                                  'first_agent'=>$v['pid'],
                                  'second_agent'=>$pid_bro['first_agent'],
                                  'three_agent'=>$pid_bro['second_agent'],
                                  'first_manager'=>$pid_bro['first_manager'],
                                  'second_manager'=>$pid_bro['second_manager']
                                ]);
                }else{
//                    董事
//                    $aa=['user_id'=>$v['id'],
//                         'first_manager'=>$v['pid'],
//                         'second_manager'=>$pid_bro['first_manager']
//                    ];
//                    print_r($aa);
//                    exit();
                    $bro->insert(['user_id'=>$v['id'],
                                  'first_manager'=>$v['pid'],
                                  'second_manager'=>$pid_bro['first_manager']
                                 ]);
                }
            }else{
                $bro->insert(['user_id'=>$v['id']]);
            }
        }
        return 1;
    }*/
//    对比用户信息是否改变
    public function upedit($arr,$users){
        //            判断余额或佣金减少还是增加
        /*    addintegral:addintegral,
                    jianintegral:jianintegral,
                    whyaddintegral:whyaddintegral,
                    whyjianintegral:whyjianintegral,*/
        (isset($arr['addintegral']) && !empty($arr['addintegral']))?$addintegral=(float)$arr['addintegral'] : $addintegral=0;
        (isset($arr['jianintegral']) && !empty($arr['jianintegral']))?$jianintegral=(float)$arr['jianintegral'] : $jianintegral=0;
        (isset($arr['addbrokerage']) && !empty($arr['addbrokerage']))?$addmoney=(float)$arr['addbrokerage'] : $addmoney=0;
        (isset($arr['jianbrokerage']) && !empty($arr['jianbrokerage']))?$jianmoney=(float)$arr['jianbrokerage'] : $jianmoney=0;
        (isset($arr['addbrokerage2']) && !empty($arr['addbrokerage2']))?$addmoney2=(float)$arr['addbrokerage2'] : $addmoney2=0;
        (isset($arr['jianbrokerage2']) && !empty($arr['jianbrokerage2']))?$jianmoney2=(float)$arr['jianbrokerage2'] : $jianmoney2=0;
        $price=0;
        $price2=0;
        $money2=0;
        $integral=0;
        $userintegral=$users['integral'];
        if($addintegral!=0){
            $integral=$users['integral']+$addintegral;
        }
        if($jianintegral != 0){
            $integral=$users['integral']-$jianintegral;
        }
        if($users['grade']==0){
            $money=$users['balance'];
            if($addmoney!=0){
                $price=$users['balance']+$addmoney;
            }
            if($jianmoney!=0){
                $price=$users['balance']-$jianmoney;
            }
        }else{
            $money2=$users['balance'];
            $money=$users['brokerage'];
            if($addmoney!=0){
                $price=$users['brokerage']+$addmoney;
            }
            if($jianmoney!=0){
                $price=$users['brokerage']-$jianmoney;
            }
            if($addmoney2!=0){
                $price2=$users['balance']+$addmoney2;
            }
            if($jianmoney2!=0){
                $price2=$users['balance']-$jianmoney2;
            }
//            $price=$users['brokerage'];
        }
//        var_dump($money2);
//        dump($price2);
//        die();
        if($arr['grade']==$users['grade'] && $integral==$users['integral'] && $money==$price && $money2==$price2 && empty($arr['coupons'])){
           return 1;
        }elseif($arr['grade']==$users['grade'] && $integral==$users['integral'] && $money==$price && $money2==$price2 && !empty($arr['coupons'])){
           return 2;
        }else{
           return 3;
        }
    }
//    用户增加优惠券
    public function addcoupon($coupon,$id){
        $my_coupon=new MyCoupon();
        $coupons=new Coupon();
        if(!empty($coupon)){
            //优惠券
//            $arr=[];
            foreach ($coupon as $k=>$v){
                $couponNum=$coupons->where('id',(int)$v)->field('num,get_num')->find();
                $newNum=$couponNum['num']-1;
                $newGetNum=$couponNum['get_num']+1;
                if($newNum>=0){
//                    $arr[]
                    $my_coupon->insert(['user_id'=>$id,
                                        'coupon_id'=>(int)$v,
                                        'time'=>time()]);
                    $coupons->where('id',$v)->update([
                                                      'num'=>$newNum,
                                                      'get_num'=>$newGetNum,
                                                      'time'=>time()]);
                }

            }
        }

        return true;
    }
    //测试
    public function adduser(){
        for($i = 0 ; $i < 10000 ; $i++){
            $d = [];
            for ($j = 0 ;$j < 1000;$j++){
                $d[] = [
                    "nickname" => rand(10,10000),
                    "unionID" => rand(10,1000000),
                    "openID" => rand(10,1000000),
                    "telephone" => rand(10,1212321)
                ];
            }
            dump($d);die;
            Db::name("user")->insertAll($d);
            unset($d);
        }
    }

}