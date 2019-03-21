<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/12
 * Time: 14:11
 */

namespace app\index\controller;


use app\index\model\AssessmentPrice;
use app\index\model\Attribute;
use app\index\model\BrokerageAllocation;
use app\index\model\ExpectBrokerage;
use app\index\model\Goods;
use app\index\model\Opinion;
use app\index\model\Orders;
use app\index\model\OrdersDetail;
use app\index\model\Refund;
use app\index\model\User;
use think\Controller;
use think\Db;
use think\Request;

class Order extends Base
{
    //订单列表
    public function index(){
        $res=input('get.');
//        (isset($res['time']) && !empty($res['time'])) ? $where2['o.create_time']= strtotime($res['time']):$where2=[];
        (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
        if(isset($times) && $times!=0){
            $this->assign('times',$res['time']);
            $timesArr=explode("~",$times);
            if(trim($timesArr[0])==trim($timesArr[1])){
                $start_time = trim($timesArr[0]);
                $mdays = date( 'd', strtotime(trim($timesArr[1])));
                $end_time = date( 'Y-m-' . $mdays . ' 23:59:59', strtotime(trim($timesArr[1])));
                $where2['yx_orders.pay_time']=['between time',[$start_time,$end_time]];
//                dump($where2);
            }else{
                $where2['yx_orders.pay_time']=['between time',$timesArr];
//                dump($where2);
            }

        }else{
            $this->assign('times','');
            $where2=[];
        }
        if(isset($res['nameorder']) && !empty($res['nameorder'])){
            $where3['yx_orders.telephone|yx_orders.name|yx_orders.orders_num|yx_orders.logistics_num|d.goods_name|g.goods_number'] = ['like',"%{$res['nameorder']}%"];
            $this->assign('nameorder',$res['nameorder']);
        }else{
            $where3=[];
            $this->assign('nameorder','');
        }
        if(isset($res['order_type']) && !empty($res['order_type'])){
            $this->assign('order_type',$res['order_type']);
            switch ((int)$res['order_type']) {
                case 7:
                    $where['d.orders_status']=0;
                    $where['d.is_delete']=0;
                    break;
                case 1:
                    $where['d.orders_status']=1;
                    $where['d.is_delete']=0;
                    break;
                case 2:
                    $where['d.orders_status']=2;
                    $where['d.is_delete']=0;
                    break;
                case 3:
                    $where['d.orders_status']=['in','3,5,6'];
                    $where['d.is_delete']=0;
                    break;
                case 4:
                    $where['d.orders_status']=4;
                    $where['d.is_delete']=0;
                    break;
                case 5:
                    $where['d.orders_status']=['in','1,2,3'];
                    $where['d.is_delete']=1;
                    break;
                case 6:
                    $where['d.orders_status']=0;
                    $where['d.is_delete']=1;
                    break;
                default:
                    $where=[];
                    break;
            }
        }else{
            $this->assign('order_type','');
            $where=[];
        }
        $order=new Orders();
        $detail=new OrdersDetail();
        $where5=['d.status'=>['not in','2,3']];
        //全部
        $count['all']=$detail->alias('d')
            ->join('yx_orders','d.order_id=yx_orders.id')
            ->join('yx_goods g','g.id=d.goods_id')
            ->where($where5)
            ->count();

//        代付款
        $wherecount['d.orders_status']=0;
        $wherecount['d.is_delete']=0;
        $count['all1']=$detail->alias('d')
            ->join('yx_orders','d.order_id=yx_orders.id')
            ->join('yx_goods g','g.id=d.goods_id')
            ->where($wherecount)
            ->where($where5)
            ->count();
//        待发货
        $wherecount1['d.orders_status']=1;
        $wherecount1['d.is_delete']=0;
        $count['all2']=$detail->alias('d')
            ->join('yx_orders','d.order_id=yx_orders.id')
            ->join('yx_goods g','g.id=d.goods_id')
            ->where($wherecount1)
            ->where($where5)
            ->count();
//        待收货
        $wherecount2['d.orders_status']=2;
        $wherecount2['d.is_delete']=0;
        $count['all3']=$detail->alias('d')
            ->join('yx_orders','d.order_id=yx_orders.id')
            ->join('yx_goods g','g.id=d.goods_id')
            ->where($wherecount2)
            ->where($where5)
            ->count();
//        交易完成
        $wherecount3['d.orders_status']=['in','3,5,6'];
        $wherecount3['d.is_delete']=0;
        $count['all4']=$detail->alias('d')
            ->join('yx_orders','d.order_id=yx_orders.id')
            ->join('yx_goods g','g.id=d.goods_id')
            ->where($wherecount3)
            ->where($where5)
            ->count();
//        交易关闭
        $wherecount4['d.orders_status']=4;
        $wherecount4['d.is_delete']=0;
        $count['all5']=$detail->alias('d')->join('yx_orders','d.order_id=yx_orders.id')
            ->join('yx_goods g','g.id=d.goods_id')
            ->where($wherecount4)
            ->where($where5)
            ->count();
//        已付款删除
        $wherecount5['d.orders_status']=['in','1,2,3'];
        $wherecount5['d.is_delete']=1;
        $count['all6']=$detail->alias('d')->join('yx_orders','d.order_id=yx_orders.id')
            ->join('yx_goods g','g.id=d.goods_id')
            ->where($wherecount5)
            ->where($where5)
            ->count();
//        未付款删除
        $wherecount6['d.orders_status']=0;
        $wherecount6['d.is_delete']=1;
        $count['all7']=$detail->alias('d')
            ->join('yx_orders','d.order_id=yx_orders.id')
            ->join('yx_goods g','g.id=d.goods_id')
            ->where($where5)
            ->where($wherecount6)
            ->count();


//        $where6=['d.status'=>null];

        $data=$detail->alias('d')->join('yx_orders','d.order_id=yx_orders.id')->join('yx_goods g','g.id=d.goods_id')
            ->where($where2)
            ->where($where)
            ->where($where3)
            ->where($where5)
//            ->where($where6)
            ->field('d.status as detail_status,d.is_delete as deletes,d.id as detail_id,d.*,yx_orders.id as order_id,yx_orders.status as order_status,yx_orders.*,g.goods_number')
            ->order(['yx_orders.id'=>'desc'])
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$data->render();
        $this->assign('page',$page);
        $data=$data->items();
        foreach ($data as $k=>$v){
            $data[$k]['goods_specification']=explode(',',$v['goods_specification']);
        }
        $this->assign('count',$count);
        $this->assign('data',$data);
        return $this->fetch();
    }
    //删除
    public function orderdel($id){
        $detail=new OrdersDetail();
        $res=$detail->where('id',$id)->update(['is_delete'=>1,'update_time'=>time()]);
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
    //发货页面
    public function adddeliver($id){
        $order=new OrdersDetail();
        $data=$order->where('id',$id)->field('logistics_num,logistics')->find();
        $this->assign('data',$data);
        $this->assign('order_id',$id);
        return $this->fetch();
    }
    //编辑页面
    public function editorders($id){
        $detail=new OrdersDetail();
        $order=new Orders();
        $arr=$detail->where('id',$id)->field('order_note,attr_id,goods_id,order_id,id,goods_specification,goods_count')->find();
        $orders=$order->where('id',$arr['order_id'])->field('address,telephone,name')->find();
        $arr['address']=$orders['address'];
        $arr['telephone']=$orders['telephone'];
        $arr['name']=$orders['name'];
        $attrs=$this->goodsAttr($arr['goods_id'],$arr['attr_id']);
        $this->assign('data',$arr);
        $this->assign('attrs',$attrs);
//        $data=[];goods_count
//        $data['order_note']=$arr[]
        return $this->fetch();
    }
    //商品的属性规格值
    public function goodsAttr($goods_id=0,$attr_id){
        $attrPrice=new AssessmentPrice();
        $attr=new Attribute();
        $attrPrices=Db::table('yx_goods_assessment_price')->where('id','neq',$attr_id)->where('g_id',$goods_id)->where('is_delete',0)->field('id,ids')->select();
        foreach ($attrPrices as $k=>$v){
            $arr=json_decode($v['ids']);
            $str="";
            foreach ($arr as $key=>$val){
                $attr_name=$attr->where('id',(int)$val)->field('name')->find();
                $str=$str.','.$attr_name['name'];
            }
            $attrPrices[$k]['attr_name']=ltrim($str,',');
        }
        return $attrPrices;
    }
    //编辑操作
    public function editorder(){
        $data=input('post.');
        $details['order_note']=$data['order_note'];
        $price=new AssessmentPrice();
        $details['goods_count']=$data['goods_count'];
        $id=$data['id'];
        $orders['name']=$data['name'];
        $orders['telephone']=$data['telephone'];
        $orders['address']=$data['address'];
        $detail=new OrdersDetail();
        $attr=new Attribute();
        $res=$detail->where('id',$id)->field('order_id,goods_id,attr_id,goods_count')->find();
        $arr=$this->upattr($id,$data['attr'],$res['goods_id'],$res['attr_id'],$res['goods_count'],$data['goods_count']);
        dump($arr);
        exit();
        //修改属性对应库存
        $details['attr_id']=(int)$data['attr'];
        $rids=$price->where('id',(int)$data['attr'])->field('ids')->find();
        $idadd=json_decode($rids['ids']);
        $str="";
        foreach ($idadd as $key=>$val){
            $attr_name=$attr->where('id',(int)$val)->field('name')->find();
            $str=$str.','.$attr_name['name'];
        }
        $details['goods_specification']=ltrim($str,',');
        $details['update_time']=time();
//        $res=$detail->where('id',$id)->field('order_id')->find();
        $info=$detail->where('id',$id)->update($details);
        $order=new Orders();
        $list=$order->where('id',$res['order_id'])->update($orders);
        if($info || $list){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
    //修改属性对应库存
    public function upattr($id=0,$attr='',$goods_id,$attr_id=0,$oldnum=0,$newnum=0){
        $details=new OrdersDetail();
        $price=new AssessmentPrice();
        $attribute=new Attribute();
        $goods=new Goods();
        $attrPriceNum=$price->where('id',$attr_id)->field('num')->find();
        $newPriceNum=$price->where('id',(int)$attr)->field('num')->find();
        $nums=$goods->where('id',$goods_id)->field('nums')->find();
        if((int)$attr==$attr_id && $oldnum==$newnum){
            return 1;
        }
        if ((int)$attr==$attr_id && $oldnum!=$newnum){
            if ($newnum<$oldnum){
                //购买商品新数量比原先少
                $new_count=$oldnum-$newnum;
//                        小订单的数量
//                        $goodsDetail['goods_count']=$newnum;
                //商品库存
                $good['nums']=$nums['nums']+$new_count;
                //商品对应sku库存
                $attrAssment['num']=$attrPriceNum['num']+$new_count;
            }
            if($newnum>$oldnum){
                //购买商品新数量比原先多
                $new_count=$newnum-$oldnum;
                //商品库存
                $goodNum=$nums['nums']-$new_count;
                //商品对应sku库存
                $attrNum=$attrPriceNum['num']-$new_count;
                if($goodNum<0){
                    $good['nums']=0;
                }else{
                    $good['nums']=$goodNum;
                }
                if($attrNum<0){
                    $attrAssment['num']=0;
                }else{
                    $attrAssment['num']=$attrNum;
                }
            }

            if(isset($good) && !empty($good)){
                $goods->where('id',$goods_id)->update($good);
            }
            if(isset($attrAssment) && !empty($attrAssment)){
                $price->where('id',$attr_id)->update($attrAssment);
            }
            return 1;
        }
        if((int)$attr!=$attr_id){
//            $good['nums']=$nums['nums']-$newnum+$oldnum;
            $num=$newPriceNum['num']-$newnum;
            if($num<0){
                $attrAssment2['num']=0;
                $good['nums']=$nums['nums']-$newPriceNum['num']+$oldnum;
            }else{
                $attrAssment2['num']=$newPriceNum['num']-$newnum;
                $good['nums']=$nums['nums']-$newnum+$oldnum;
            }

            $attrAssment['num']=$attrPriceNum['num']+$oldnum;
            var_dump($good);
            var_dump($attrAssment2);
            dump($attrAssment);
            exit();
            if(isset($good) && !empty($good)){
                $goods->where('id',$goods_id)->update($good);
            }
            if(isset($attrAssment2) && !empty($attrAssment2)){
                $price->where('id',(int)$attr)->update($attrAssments2);
            }
            if(isset($attrAssment) && !empty($attrAssment)){
                $price->where('id',$attr_id)->update($attrAssment);
            }

        }
/*        $nums=$goods->where('id',$goods_id)->field('nums')->find();
        $attrPriceNum=$price->where('id',$attr_id)->field('num')->find();
        //查询原有属性
        $assments=$price->where('g_id',$goods_id)->where('is_delete',0)->field('id,ids,num')->select();
//        判断修改属性是否有变化和数量的改变
        foreach ($assments as $key=>$val){
            $ids=json_decode($val['ids']);
            $str='';
            foreach ($ids as $v){
                $attr_name=$attribute->where('id',$v)->field('name')->find();
                $str.=$attr_name['name'].',';
            }
            $attrs=rtrim($str, ',');
            if(strtoupper($attr)==strtoupper($attrs)){
//                属性规格相等
                if($val['id']==$attr_id){
                    $orderdetail['goods_count']=$newnum;
                    if($newnum>$oldnum){
                        //购买商品新数量比原先多
                        $new_count=$newnum-$oldnum;
                        //商品库存
                        $goodNum=$nums['nums']-$new_count;
                        //商品对应sku库存
                        $attrNum=$val['num']-$new_count;
                        if($goodNum<0){
                            $good['nums']=0;
                        }else{
                            $good['nums']=$goodNum;
                        }
                        if($attrNum<0){
                            $attrAssment['num']=0;
                        }else{
                            $attrAssment['num']=$attrNum;
                        }
                    }
                    if ($newnum<$oldnum){
                        //购买商品新数量比原先少
                        $new_count=$oldnum-$newnum;
//                        小订单的数量
//                        $goodsDetail['goods_count']=$newnum;
                        //商品库存
                        $good['nums']=$nums['nums']+$new_count;
                        //商品对应sku库存
                        $attrAssment['num']=$val['num']+$new_count;
                    }
                }else{
                    //属性规格与原先不同但此商品有对应的修改规格id

                  $orderdetail['attr_id']=$val['id'];
                  $orderdetail['goods_count']=$newnum;
                   //商品总库存+原先规格下的数量   判断此次修改的规格库存数据库中是否比填写数量多
                    $attr_num=$val['num']-$newnum;
                    if($attr_num>0){
                        //商品库存
                        if($attr_id==0){
                            $good['nums']=$nums['nums']-$newnum;
                        }else{
                            $good['nums']=$nums['nums']+$oldnum-$newnum;
                        }

                        //商品原先对应sku库存
                        $attrAssment['num']=$attrPriceNum['num']+$oldnum;
                        //商品现在对应sku库存
                        $attrAssment2['num']=$attr_num;
                    }else{
                        //商品库存
                        $jian=$newnum-$val['num'];
                        if($attr_id==0){
                            $good['nums']=$nums['nums']-$jian;
                        }else{
                            $good['nums']=$nums['nums']+$oldnum-$jian;
                        }

                        //商品原先对应sku库存
                        $attrAssment['num']=$attrPriceNum['num']+$oldnum;
                        //商品现在对应sku库存
                        $attrAssment2['num']=0;
                    }
                }
                if(isset($good) && !empty($good)){
                    $goods->where('id',$goods_id)->update($good);
                }
                if(isset($attrAssment) && !empty($attrAssment)){
                    $price->where('id',$attr_id)->update($attrAssment);
                }
                if(isset($attrAssment2) && !empty($attrAssment2)){
                    $price->where('id',$val['id'])->update($attrAssment2);
                }
                if(isset($orderdetail) && !empty($orderdetail)){
                    $details->where('id',$id)->update($orderdetail);
                }
                return 1;
            }else{
                //商品库存
                $good2['nums']=$nums['nums']+$oldnum;
                //商品原先对应sku库存
                $attrAssments2['num']=$attrPriceNum['num']+$oldnum;
                $orderdetail['attr_id']=0;
            }

        }
        if(isset($good2) && !empty($good2)){
            $goods->where('id',$goods_id)->update($good2);
        }
        if(isset($attrAssments2) && !empty($attrAssments2)){
            $price->where('id',$attr_id)->update($attrAssments2);
        }
        if(isset($orderdetail) && !empty($orderdetail)){
            $details->where('id',$id)->update($orderdetail);
        }
       return 1;*/
//        $details->where('id',$id)->field('');
    }
    //添加发货单号 发货操作
    public function deliver($id,$logistics_num,$logistics){
//        $id小订单id
        $order=new Orders();
        $detail=new OrdersDetail();
        $details=$detail->where('id',$id)->field('order_id')->find();

        $res['logistics_num']=$logistics_num;
        $res['logistics']=$logistics;
        $res['orders_status']=2;
        $res['update_time']=time();
        $res['shipments_time']=time();
        $data=$detail->where('id',$id)->update($res);
        $where1['orders_status']=['in','1,2,3,4,5,6'];
        $where1['status']=['in','2,3,4'];
        $where1['order_id']=['eq',$details['order_id']];
        $where1['is_delete']=['eq',0];
        $where2['orders_status']=['in','2,3,4,5,6'];
        $where2['status']=['in','9,1,2,3,4'];
        $where2['order_id']=['eq',$details['order_id']];
        $where2['is_delete']=['eq',0];
       /* ->where($wherea1)
            ->whereOr(function ($query) use ($wherea3) {
                $query->where($wherea3);
            });*/
        $detailAll=$detail->where($where1)
            ->whereOr(function ($query) use ($where2) {
                $query->where($where2);
            })->count();
        $detailAlls=$detail->where('order_id',$details['order_id'])->where('is_delete',0)->count();
        if($detailAll===$detailAlls){
           $order->where('id',$details['order_id'])->update(['status'=>2]);
        }
        if($data){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
    //查看物流
    public function showdeliver($id){
        $order=new OrdersDetail();
        $data=$order->where('id',$id)->field('logistics_num,logistics')->find();
        $this->assign('data',$data);
        return $this->fetch();
    }
//    查看订单信息
    public function showorder(){
        $detail=new OrdersDetail();
        $order=new Orders();
        $user=new User();
        $goods=new Goods();
        $price=new AssessmentPrice();
        $opinion=new Opinion();
        $broAll=new BrokerageAllocation();
        $detail_id=input('detail_id/d');
        if(isset($detail_id) && !empty($detail_id)){
            session('detail_id',$detail_id);
        }else{
            $detail_id=session('detail_id');
        }
        //小订单信息
        $details=$detail->where('id',$detail_id)->find();
//        商品规格
        $details['goods_specification']=explode(',',$details['goods_specification']);

        $details['zmoneys']=$details['goods_price']*$details['goods_count'];
//        积分
        $integral=$goods->where('id',$details['goods_id'])->field('own_integral')->find();
        //大订单信息
        $orders=$order->where('id',$details['order_id'])->find();
        //会员信息
        $users=$user->where('id',$orders['user_id'])->field('id,telephone')->find();
        //会员上级分佣
        $broAlls=$broAll->where('id',$orders['user_id'])->find();
        //商品佣金明细
        $agent=$price->where('id',$details['attr_id'])->field('one_agent,two_agent,three_agent,manager,cost_price,general_price,director_price')->find();
//      佣金分配信息
        $expects=new ExpectBrokerage();
        $expectBros=$expects->alias('e')
            ->join('yx_user u','u.id=e.user_id')
            ->where('e.order_id',$detail_id)
            ->field('e.grade,u.nickname,u.telephone')
            ->select();
        $arr1=[];
        $arr2=[];
        $arr3=[];
        $arr4=[];
        $arr5=[];
        foreach ($expectBros as $key=>$val){
            if($val['grade']==1){
                $arr1['gradename1']=$val['nickname'];
                $arr1['telephone1']=$val['telephone'];
            }
            if($val['grade']==2){
                $arr2['gradename2']=$val['nickname'];
                $arr2['telephone2']=$val['telephone'];
            }
            if($val['grade']==3){
                $arr3['gradename3']=$val['nickname'];
                $arr3['telephone3']=$val['telephone'];
            }
            if($val['grade']==4){
                $arr4['gradename4']=$val['nickname'];
                $arr4['telephone4']=$val['telephone'];
            }
            if($val['grade']==5){
                $arr5['gradename5']=$val['nickname'];
                $arr5['telephone5']=$val['telephone'];
            }
        }
        $agent['one_agent']=($details['goods_price']*$details['goods_count'])-($agent['general_price']*$details['goods_count']);
        $agent['two_agent']=$agent['two_agent']*$details['goods_count'];
        $agent['three_agent']=$agent['three_agent']*$details['goods_count'];
        $agent['manager']=$agent['manager']*$details['goods_count'];
        if($agent['one_agent']<0){
            $agent['one_agent']=0;
        }else{
            $agent['one_agent']=$agent['one_agent'];
        }
        $prices=$agent['one_agent']+$agent['two_agent']+$agent['three_agent'];
        $agent['one_manager']=($details['goods_price']*$details['goods_count'])-$prices-($agent['director_price']*$details['goods_count']);
        if($agent['one_manager']<0){
            $agent['one_manager']=0;
        }else{
            $agent['one_manager']= $agent['one_manager'];
        }
        //评论
        $opinions=$opinion->alias('p')->join('yx_user u','u.id=p.user_id')->where('p.goods_id',$details['goods_id'])->field('u.nickname,p.*')->paginate(3,false,['query' => $this->request->get()]);
        $page=$opinions->render();
        $opinions=$opinions->items();
        foreach($opinions as $k=>$v){
            $opinions[$k]['images']=explode(',',$v['images']);
        }
//        return json($opinions);
        $this->assign('arr1',$arr1);
        $this->assign('arr2',$arr2);
        $this->assign('arr3',$arr3);
        $this->assign('arr4',$arr4);
        $this->assign('arr5',$arr5);
        $this->assign('page',$page);
        $this->assign('opinions',$opinions);
        $this->assign('detail',$details);
        $this->assign('integral',$integral);
        $this->assign('orders',$orders);
        $this->assign('users',$users);
        $this->assign('agent',$agent);
        return $this->fetch();
    }
    //修改评论页面
    public function editopinion($id){
        $opinion=new Opinion();
        $opinions=$opinion->where('id',$id)->find();
        $opinions['images']=explode(',',$opinions['images']);
        $this->assign('opinions',$opinions);
        return $this->fetch();
    }
//    修改评论操作
    public function opinions($id,$content,$pics,$logistics_server=0,$seller_server=0,$goods_intro=0){
        $opinion=new Opinion();
        $res=$opinion->where('id',$id)->update(['content'=>$content,'images'=>$pics,'logistics_server'=>$logistics_server,'seller_server'=>$seller_server,'goods_intro'=>$goods_intro]);
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
//    导出
    public function excel() {
        $res=input('get.');
//        (isset($res['time']) && !empty($res['time'])) ? $where2['o.create_time']= strtotime($res['time']):$where2=[];
        (isset($res['time']) && !empty($res['time'])) ? $times=$res['time']:$times=0;
        if(isset($times) && $times!=0){
//            $this->assign('times',$res['time']);
            $timesArr=explode("~",$times);
            if(trim($timesArr[0])==trim($timesArr[1])){
                $start_time = trim($timesArr[0]);
                $mdays = date( 'd', strtotime(trim($timesArr[1])));
                $end_time = date( 'Y-m-' . $mdays . ' 23:59:59', strtotime(trim($timesArr[1])));
                $where2['yx_orders.pay_time']=['between time',[$start_time,$end_time]];
//                dump($where2);
            }else{
                $where2['yx_orders.pay_time']=['between time',$timesArr];
//                dump($where2);
            }

        }else{
            $where2=[];
        }
        if(isset($res['nameorder']) && !empty($res['nameorder'])){
            $where3['yx_orders.telephone|yx_orders.name|yx_orders.orders_num|yx_orders.logistics_num|d.goods_name|g.goods_number'] = ['like',"%{$res['nameorder']}%"];
//            $this->assign('nameorder',$res['nameorder']);
        }else{
            $where3=[];
//            $this->assign('nameorder','');
        }
//        $where5=['d.status'=>['not in','2,3']];
        $orders=new Orders();
        $data=Db::table('yx_orders_detail')->alias('d')->join('yx_orders','d.order_id=yx_orders.id')
            ->join('yx_goods g','g.id=d.goods_id')
            ->where('d.orders_status',1)
            ->where('yx_orders.is_delete',0)
            ->where('d.status','in','9,1,4')
            ->where($where2)
            ->where($where3)
//            ->group('o.id')
            ->field('d.id,yx_orders.orders_num,yx_orders.name,yx_orders.telephone,yx_orders.address,d.goods_name,d.goods_count,d.goods_specification,d.logistics,d.logistics_num,d.orders_status,yx_orders.remark')->select();
//        dump($where3);
        foreach ($data as $k=>$v){
//            $details=Db::table('yx_orders_detail')->where('order_id',$v['id'])->where('status','in','9,1,4')->field('goods_name,goods_count,goods_specification')->select();
             $data[$k]['orders_status']='待发货';
//             $str='';
//             $str2='';
//             $str3='';
//            $str4='';
//            foreach ($details as $key=>$val){
//                $str=$str.$val['goods_name'].'/';
//                $str2=$str2.$val['goods_count'].'/';
//                $str3=$str3.$val['goods_specification'].'/';
////                $str4=$str4.$val['goods_specification'].'/';
//            }
//            $str=rtrim($str, "/");
//            $str2=rtrim($str2, "/");
//            $str3=rtrim($str3, "/");
//            $str4=rtrim($str4, "/");
//            $data[$k]['goods_name']=$str;
//            $data[$k]['goods_count']=$str2;
//            $data[$k]['goods_specification']=$str3;
//            $data[$k]['did']=$str4;
        }
        $name='订单物流信息表';
        $header=['小订单id','订单号','收货人姓名','联系方式','收货人地址','商品名称','商品数量','商品规格','物流公司','物流编号','状态','买家留言' ];
//,'商品名称','商品数量','商品规格'
        exportExcel($header,$data,$name);
    }

    //导入
    public function excelin(Request $request){

        if($request->isPost()){
            vendor('Classes.PHPExcel');
            $objPHPExcel = new \PHPExcel();
            $file = $request->file('excel');
            $info = $file->move(ROOT_PATH . 'public' . DS . 'excel');
//            return json($info);
            if($info){
                $exclePath = $info->getSaveName();  //获取文件名
                $extension = pathinfo($exclePath, PATHINFO_EXTENSION);
                $file_name = ROOT_PATH . 'public' . DS . 'excel' . DS . $exclePath;   //上传文件的地址
                if($extension == 'xlsx'){
                    $objReader =\PHPExcel_IOFactory::createReader('excel2007');
                }else{
                    $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                }
                $obj_PHPExcel =$objReader->load($file_name, $encode = 'utf-8');  //加载文件内容,编码utf-8
                echo "<pre>";

                $excel_array=$obj_PHPExcel->getsheet(0)->toArray();   //转换为数组格式
                array_shift($excel_array);  //删除第一个数组(标题);
                $data = [];
                $shuju = [];
                $shuju2=[];
                $i=0;
                $j=0;
//                dump($excel_array);die;
                foreach($excel_array as $k=>$v) {
                    $exists = Db::table('yx_orders')->where(['orders_num'=>$v[1]])->find();
                    if(isset($exists)){
//                        $shuju[$j]['orders_num'] = trim($v[1]);
//                        $shuju[$j]['address'] = $v[2];
//                        $shuju[$j]['name'] = $v[3];
//                        $shuju[$j]['telephone'] = $v[4];
                        $shuju2[$j]['id']=(int)trim($v[0]);
                        $shuju2[$j]['logistics']=trim($v[8]);
//                        $shuju2[$j]['order_id']=(int)trim($v[0]);
                        $shuju2[$j]['logistics_num']= trim((string)$v[9]);
                        //发货
                        $shuju2[$j]['update_time']=time();
                        if(!empty(trim((string)$v[8])) && !empty(trim((string)$v[9]))){
                            $shuju2[$j]['orders_status']=2;
                        }


//                        $shuju[$j]['update_time']=time();
                        $j++;
                    }
                }
//                        dump($shuju2);die;
                Db::startTrans();
                try{


//                    if(!empty($shuju)){
//                        foreach($shuju as $k=>$v){
////                            dump($v);die;
//                            $succes=Db::table('yx_orders')->where(['orders_num'=>$v['orders_num']])->update($v);
////                            $succes2=Db::table('yx_orders_detail')->where(['order_id'=>$v['order_id']])->update($v);
//                            if(empty($succes)){
//                                Db::rollback();
//                            }
//                        }

                        if(!empty($shuju2)){
//                            foreach($shuju2 as $k1=>$v1){
//                            $succes=Db::table('yx_orders')->where(['orders_num'=>$v['orders_num']])->update($v);
//                                dump($v1);die;
//                                $arr['logistics']=$v1['logistics'];
////                                $shuju2[$j]['id']=(int)trim($v1[0]);
//
//                                $arr['logistics_num']= $v1['logistics_num'];
//                                $arr['update_time']=time();
//                            $ups=array_chunk($shuju2, 500);

//var_dump($shuju2);
                            $details=new OrdersDetail();
                            $order=new Orders();
                                $succes2=$details->isUpdate()->saveAll($shuju2);

//                                    dump($deta);
//                                    exit();
                                if(!$succes2){
                                    Db::rollback();
                                }else{
                                    $deta=Db::table('yx_orders_detail')
                                        ->whereTime('update_time','-1 hours')
                                        ->where('orders_status',2)
                                        ->group('order_id')
                                        ->field('order_id,orders_status')->select();
//                                    dump($deta);
//                                    $detail=new OrdersDetail();
                                    foreach ($deta as $key=>$val){
                                        $where1['orders_status']=['in','1,2,3,4,5,6'];
                                        $where1['status']=['in','2,3,4'];
                                        $where1['order_id']=['eq',$val['order_id']];
                                        $where1['is_delete']=['eq',0];
                                        $where3['orders_status']=['in','2,3,4,5,6'];
                                        $where3['status']=['in','9,1,2,3,4'];
                                        $where3['order_id']=['eq',$val['order_id']];
                                        $where3['is_delete']=['eq',0];
//                                        $where=[
//                                            'is_delete'=>0,
//                                            'order_id'=>$val['order_id'],
//                                            'orders_status'=>2
//                                        ];
                                        $where2=[
                                            'is_delete'=>0,
                                            'order_id'=>$val['order_id'],
                                        ];
                                        $num=$details->where($where1)
                                            ->whereOr(function ($query) use ($where3) {
                                                $query->where($where3);
                                            })->count();
//                                        dump($num);
//                                        exit();
                                        $nums=$details->where($where2)->count();
                                        if($nums==$num){
                                            $order->where('id',$val['order_id'])->update(['status'=>2,'update_time'=>time()]);
                                        }
                                    }
                                }
                            }
//                        }
//                    }

                    Db::commit();
                    $url=url('index/order/index');
                    echo <<<AAA
          <script type='text/javascript'>
            alert('导入成功');
            window.parent.location.href="$url";
          </script>
AAA;

                }catch(\Exception $e){
                    Db::rollback();
                }
            }
        }else{
            return $this->fetch();
        }


    }


}