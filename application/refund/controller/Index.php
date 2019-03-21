<?php
namespace app\refund\controller;

use app\refund\model\Kiting;
use app\refund\model\Orders;
use app\index\model\OrdersDetail;
use app\refund\model\PayDetail;
use app\refund\model\User;
use think\Controller;
use think\Db;
use think\Session;

class Index extends Base
{
    //首页
    public function index()
    {
        $data = Session::get('info1');
//        dump($data);
//        die();
        $this->assign('data',$data);
        return $this->fetch();
    }
    //上传图片
    public function upload(){
            $file = request()->file('file');
            if($file) {
                $info=$file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info) {

                    $pic=DS . 'uploads' . DS . $info->getSaveName();//替换"\"为"/"
//                    $res['name']='/uploads/goodstmp/'.$pic;
                    $goodspic=$_SERVER['DOCUMENT_ROOT'] .$pic;
                    $filePaths = uploadOss1($goodspic);
                    unset($info);
                    $imgurl = str_replace("\\", "/", $pic);
                    $imgurl = ltrim($imgurl, '/');
                    unlink($imgurl);
                    $res['code'] =1;
                    $res['name'] = 'https://chyxg.oss-cn-zhangjiakou.aliyuncs.com/'.$filePaths;
                    $res['msg']='上传成功';
//                    dump($filePaths);
//                $savename=$info->getsavename();
                } else {
//                    $filePaths="ddd";
                    $res['code'] = 0;
                    $res['msg'] = '上传失败！'.$file->getError();
//                $msg=$info->getError(); // 错误信息
                }
                return $res;
            }
    }

    //上传多图
    public function uploads()
    {
        if($this->request->isPost()){

            $file = $this->request->file('file');
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            //halt( $info)
            if($info){
//                $res['code']=1;
//                $res['msg'] = '上传成功！';
//                $res['name'] = $info->getFilename();
//                $pic=str_replace("\\","/",$info->getsavename());//替换"\"为"/"
                $pic=DS . 'uploads' . DS . $info->getSaveName();//替换"\"为"/"
//                    $res['name']='/uploads/goodstmp/'.$pic;
                $goodspic=$_SERVER['DOCUMENT_ROOT'] .$pic;
                $filePaths = uploadOss1($goodspic);
                unset($info);
                $imgurl = str_replace("\\", "/", $pic);
                $imgurl = ltrim($imgurl, '/');
                unlink($imgurl);
                $res['code'] =1;
                $res['filepath'] = 'https://chyxg.oss-cn-zhangjiakou.aliyuncs.com/'.$filePaths;
                $res['msg']='上传成功';
//                $res['filepath'] = '/uploads/picstmp/'.$pic;
            }else{
                $res['code'] = 0;
                $res['msg'] = '上传失败！'.$file->getError();
            }
            return $res;
        }
    }
    public function shiajian(){
        return $this->fetch();
    }

    //首页数据统计
    public function welcome(){
        $data=$this->consume();
        $kit=$this->kits();
//        var_dump($data);
//        dump($kit);
//        die();
        $this->assign('data',$data);
        $this->assign('kit',$kit);
        return $this->fetch();
    }
//    订单数据
    public function consume(){
        $order=new Orders();
        $start_time = date( 'Y-m-1 00:00:00', time() );
        $mdays = date( 't', time() );
        $end_time = date( 'Y-m-' . $mdays . ' 23:59:59', time() );
        $orders=Db::table('yx_orders')->alias('o')->join('yx_orders_detail d','o.id=d.order_id')
            ->where('d.status','in','9,1,4')
            ->where('o.status',3)
            ->field('d.real_pay')
            ->select();
//        $order->where('status',3)
//            ->field('orders_total_price')
//            ->select();
        $num=0;
        foreach ($orders as $key=>$val){
            $num+=$val['real_pay'];
        }
        //本月订单
        $month_orders=Db::table('yx_orders')->alias('o')->join('yx_orders_detail d','o.id=d.order_id')
            ->where('d.status','in','9,1,4')
            ->where('o.create_time','between time', [$start_time, $end_time])
            ->where('o.status',3)
            ->field('d.real_pay')
            ->select();
//            $order->where('create_time','between time', [$start_time, $end_time])
//            ->field('orders_total_price')
//            ->select();
        $month_num=0;
        foreach ($month_orders as $k=>$v){
            $month_num+=$v['real_pay'];
        }
        $month_nums=count($month_orders);
        $count['month_num']=$month_num;
        $count['month_order_num']=$month_nums;
        $nums=count($orders);
        $count['num']=$num;
        $count['order_num']=$nums;
        return $count;
    }
    //财务数据
    public function kits(){
        $kit=new Kiting();
        $pay=new PayDetail();
        $user=new User();
        $data=[];
        //提现次数
        $data['kit_num']=$kit->count();
        //支出佣金
        $info=$pay->where('type',1)
            ->where('status',1)
            ->field('money')
            ->select();
        $out_price=0;
        foreach($info as $k=>$v){
            $out_price+=$v['money'];
        }
        $data['out_price']=$out_price;

        $users=$user->field('brokerage,unbrokerage')->select();
        //佣金余额
        $brokerage=0;
        //待结算佣金余额
        $unbrokerage=0;
        foreach($users as $key=>$val){
            $brokerage+=$val['brokerage'];
            $unbrokerage+=$val['unbrokerage'];
        }
        $data['brokerage']=$brokerage;
        $data['unbrokerage']=$unbrokerage;
        return $data;
    }
    //总订单 总代董事总订单 普通用户总订单 今天 昨天 7天前 30天前
    public function user_order($grade=3){
        $times=$this->show_time();
        if($grade==4){
//            销量
            $where2=[
                'd.is_delete'=>0,
                'd.orders_status'=>['in','1,2,3,4,5,6']
            ];
            foreach ($times['time'] as $k=>$v){
                $where=[
                    'o.pay_time'=>['between', [$v['start'], $v['end']]]
                ];
                $res=Db::table('yx_orders_detail')->alias('d')
                    ->join('yx_orders o','o.id=d.order_id','left')
                    ->where($where)
                    ->where($where2)
                    ->field('d.goods_count,d.real_pay')
                    ->select();
//                var_dump($res);
//                die();
                $num=0;
                foreach ($res as $key=>$val){
                  $num+=$val['goods_count'];
                }
                $data[]=$num;
            }
        }elseif ($grade==5){
//销量总金额
            $where2=[
                'd.is_delete'=>0,
                'd.orders_status'=>['in','1,2,3,4,5,6']
            ];
            foreach ($times['time'] as $k=>$v){
                $where=[
                    'o.pay_time'=>['between', [$v['start'], $v['end']]]
                ];
                $res=Db::table('yx_orders_detail')->alias('d')
                    ->join('yx_orders o','o.id=d.order_id','left')
                    ->where($where)
                    ->where($where2)
                    ->field('d.goods_count,d.real_pay')
                    ->select();
//                var_dump($res);
//                die();
                $num=0;
                foreach ($res as $key=>$val){
                    $num+=$val['real_pay'];
                }
                $data[]=$num;
            }

        }elseif($grade==3){
//            全部
            $where1=[
                'u.grade'=>['in','0,1,2'],
                'o.status'=>3
            ];

        }elseif ($grade==2){
//            总代董事
            $where1=[
                'u.grade'=>['in','1,2'],
                'o.status'=>3
            ];
        }else{
//            普通用户
            $where1=[
                'u.grade'=>0,
                'o.status'=>3
            ];
        }
        if(!empty($where1) && isset($where1)){
            foreach ($times['time'] as $k=>$v){
                $where=[
                    'o.accomplish_time'=>['between', [$v['start'], $v['end']]]
                ];
                $data[]=Db::table('yx_orders')->alias('o')
                    ->join('yx_user u','u.id=o.user_id','left')
                    ->where($where)
                    ->where($where1)
                    ->count();
            }
        }

//        dump($data);
//        die();
       return ['code'=>1,'data'=>$data,'days'=>$times['day']];

    }
    //处理时间戳
    public function show_time(){
        $arr[0] = time() -6* 24 * 3600;
        $arr[1] = time() -5* 24 * 3600;
        $arr[2] = time() -4* 24 * 3600;
        $arr[3] = time() -3 * 24 * 3600;
        $arr[4] = time() -2 * 24 * 3600;
        $arr[5] = time() -1 * 24 * 3600;
        $arr[6] = time();
        $new=[];
        foreach ($arr as $k=>$v){
            $arr[$k] = date('m.d', $v);
            $new[$k]['start'] = mktime(0, 0, 0, date("m", $v), date("d", $v), date("Y", $v));
            $new[$k]['end'] = mktime(23, 59, 59, date("m", $v), date("d", $v), date("Y", $v));
        }
        $data['day']=$arr;
        $data['time']=$new;
        return $data;
//        return
    }
}
