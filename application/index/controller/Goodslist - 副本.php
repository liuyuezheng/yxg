<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 16:32
 */

namespace app\index\controller;


use app\index\model\Assessment;
use app\index\model\AssessmentPrice;
use app\index\model\Attribute;
use app\index\model\AttributeCate;
use app\index\model\City;
use app\index\model\Coupon;
use app\index\model\Freight;
use app\index\model\Goods;
use app\index\model\GoodsCategory;
use app\index\model\Province;
use think\Controller;
use think\Db;
use think\Request;

class Goodslist extends Base
{
   //首页展示
    public function index(){
        $res=input('get.');
        $goods_cate=new GoodsCategory();
        //商品分类
        if(isset($res['cate_type']) && !empty($res['cate_type'])){
            $cate=$goods_cate->where('id',$res['cate_type'])->find();
            if($cate['pid']==0){
                $cates=$goods_cate->where('pid',$cate['id'])->select();
                $cate_ids=[];
                foreach ($cates as $key=>$val){
                    $cate_ids[$key]=$val['id'];
                }
                $str_id=implode(',',$cate_ids);
                $where2['c.id']=['in',$str_id];
            }else{
                $where2['g.classify_id']=$res['cate_type'];
            }
            $this->assign('cate_id',$cate['id']);
            $this->assign('cate_name',$cate['name']);
        }else{
            $where2=[] ;
            $this->assign('cate_id','');
            $this->assign('cate_name','');
        }
        if(isset($res['goods_status']) && !empty($res['goods_status'])){
            if($res['goods_status']==3){
                $where1['g.is_putaway']=0;
            }elseif ($res['goods_status']==2){
                $where1['g.is_putaway']=1;
            }else{
                $where1['g.nums']=0;
            }
            $this->assign('goods_status',$res['goods_status']);
        }else{
            $where1=[];
            $this->assign('goods_status','');
        }
/*        (isset($res['goods_name']) && !empty($res['goods_name'])) ? $where3['g.name'] = ['like',"%{$res['goods_name']}%"]:$where3=[];*/
        if(isset($res['goods_name']) && !empty($res['goods_name'])){
            $where3['g.name'] = ['like',"%{$res['goods_name']}%"];
            $this->assign('goods_name',$res['goods_name']);
        }else{
            $where3=[];
            $this->assign('goods_name','');
        }
        $goods=new Goods();
        $cate=new GoodsCategory();
        $list=$goods->alias('g')
           ->join('yx_goods_category c','g.classify_id=c.id')
            ->where($where1)
            ->where($where2)
            ->where($where3)
            ->where('g.is_delete',2)
           ->order('g.id desc')
           ->field('g.*,c.name as cate_name')
           ->paginate(10,false,['query' => $this->request->get()]);
        $page=$list->render();
        $first=$cate->where('pid',0)->order('sort,id')->select();
        foreach ($first as $k=>$v){
            $second=$this->second($v['id']);
            $first[$k]['second']=$second;
        }
       $this->assign('cate',$first);
        $this->assign('page',$page);
       $this->assign('data',$list);
       return $this->fetch();
    }
    //批量爆款
    public function hotstyle($id){
        $goods=new Goods();
        foreach ($id as $k){
           $res=$goods->where('id',$k)->update(['where_division'=>0,'update_time'=>time()]);
        }
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }

    }
    //批量今日主推
    public function mainly($id){
        $goods=new Goods();
        foreach ($id as $k){
            $res=$goods->where('id',$k)->update(['where_division'=>1,'update_time'=>time()]);
        }
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }
    }
    //商品上下架
    public function putaway($id,$status){
        if($status==0){
            $status1=1;
        }else{
            $status1=0;
        }
        $res['is_putaway']=$status1;
        $res['update_time']=time();
        $goods=new Goods();
        $data=$goods->where('id',$id)->update($res);
        if($data){
            return 1;
        }else{
            return 0;
        }
    }
    //批量上架
    public function putaways($id){
        foreach ($id as $k=>$v){
            $res['is_putaway']=0;
            $res['update_time']=time();
            $goods=new Goods();
            $data=$goods->where('id',$v)->update($res);
        }
        if($data){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
//批量下架
    public function downaways($id){
        foreach ($id as $k=>$v){
            $res['is_putaway']=1;
            $res['update_time']=time();
            $goods=new Goods();
            $data=$goods->where('id',$v)->update($res);
        }
        if($data){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
    //删除商品
    public function del($id){
        $goods=new Goods();
        $data=$goods->where('id',$id)->update(['is_delete'=>1]);
//        Db::table('yx_describe')->where('goods_id',$id)->where('type',1)->update();
        if($data){
            return 1;
        }else{
            return 0;
        }
    }
    //添加商品页面
    public function add(){
        $cate=new GoodsCategory();
        $attcate=new AttributeCate();
        $attr=new Attribute();
        $first=$cate->where('pid',0)->order('sort,id')->select();
        foreach ($first as $k=>$v){
            $second=$this->second($v['id']);
            $first[$k]['second']=$second;
        }
        $allment=$attcate->limit(3)->select();
        foreach ($allment as $key=>$val){
            $allment[$key]['attr']=$attr->where('c_id',$val['id'])->field('name')->select();
        }
        $coupon=new Coupon();
        $res=$coupon->where('type',1)->where('is_delete',2)->select();
        $pro=$this->province();
        $this->assign('allment',$allment);
        $this->assign('cate',$first);
        $this->assign('coupon',$res);
        $this->assign('province',$pro);
        return $this->fetch();
    }
    //添加商品
    public function adds(Request $request){
        $data=$request->post();
        $shop=new Goods();
        $goods['goods_number']=$data['goods_bian'];
        $shops=$shop->where('goods_number',$data['goods_bian'])->find();
        if(!empty($shops)){
            $this->error('已有此商品编码的商品！');
        }
        if(empty($data['startTime'])){
            $goods['start_time']=time();
            $goods['end_time']=strtotime($data['endTime']);
        }else{
            $goods['start_time']=strtotime($data['startTime']);
            $goods['end_time']=strtotime($data['endTime']);
            if($goods['end_time']<=$goods['start_time']){
                $this->error('开始时间需小于结束时间！');
            }
        }

//
//        if($goods['end_time']<=$goods['start_time']){
//            $this->error('开始时间需小于结束时间！');
//        }else{

            $images=explode(",",$data['pics']);
            $goods['logo_image']=$images[0];
            $goods['name']=$data['goodsname'];
            $goods['is_return']=$data['is_return'];
            $goods['describe']=$data['goods_describe'];
            $goods['classify_id']=$data['cate_id'];
            $goods['goods_price']=$data['goods_price'];
            $goods['original_price']=$data['old_price'];
            $goods['limit_num']=$data['limit_num'];
            $goods['own_integral']=$data['integral'];
            $goods['where_division']=$data['division'];
            $goods['is_use_coupon']=$data['is_pons'];
            $goods['coupon_id']=$data['pons'];
            $goods['goods_images']=$data['pics'];
            $goods['goods_detail']=$data['detail'];
            $goods['use_type']=$data['identity'];
            $goods['is_up']=$data['is_up'];
            $goods['freight']=$data['freights'];
            $goods['is_putaway']=$data['ishot'];
            $goods['one_integral']=$data['one'];
            $goods['two_integral']=$data['two'];
            $goods['three_integral']=$data['three'];
            $goods['create_time']=time();

            $goods['update_time']=time();

            $testArray=$data['testArray'];
            $goodsValidate=new \app\index\validate\Goods();
            $result = $goodsValidate->check($goods);
            if (true !== $result) {
                return json(1001, '', $goodsValidate->getError());
            }

            $inId=$shop->insertGetId($goods);
//        dump($data);die;
            //插入其他运费
            if(isset($data['freight_pros']) && !empty($data['freight_pros'])){
                $freight=$this->if_pro($inId,$data['freight_pros'],$data['freight_citys'],$data['freight_moneys']);
            }else{
                $freight=false;
            }

            //插入商品属性
            $attr=$this->goods_attr($inId,json_encode($testArray),$images[0]);

            if($freight || $attr){
                $goods_num=Db::table('yx_goods_assessment_price')->where('g_id',$inId)->where('is_delete',0)->field('num')->select();
                $gnum=0;
                foreach ($goods_num as $key=>$val){
                    $gnum+=$val['num'];
                }
                Db::table("yx_goods")->where(['id'=>$inId])->update(['nums'=>$gnum]);
                $this->success('操作成功');
            }else{
                $shop->where('id',$inId)->delete();
                $this->error('操作失败！');
            }
//        }
    }
    //插入其他运费
    public function if_pro($id,$freight_pros,$freight_citys,$freight_moneys){
        $pros=substr($freight_pros,0,-1);
        $citys=substr($freight_citys,0,-1);
        $moneys=substr($freight_moneys,0,-1);
        $prosA=explode(",",$pros);
        $citysA=explode(",",$citys);
        $moneysA=explode(",",$moneys);
        $res=[];
        $res['goods_id']=$id;
        $freight=new Freight();
        for ($i=0;$i<count($prosA);$i++){
            $res['province']=$prosA[$i];
            $res['city']=$citysA[$i];
            $res['freight']=$moneysA[$i];
            $res['create_time']=time();
            $res['update_time']=time();
            $type=$freight->insert($res);
        }
        return true;
    }
 /*   public function test(){
        $aa=$this->if_pro("浙江省,","浙江省,杭州圣,","浙江省,杭州圣,");
        return json($aa);
    }*/
    //二级分类
    public function second($cate_id){
        $cate=new GoodsCategory();
        $second=$cate->where('pid',$cate_id)->order('sort,id')->select();
        return $second;
    }
    //省
    public function province(){
        $pro=new Province();
        $res=$pro->select();
        return $res;
    }
    //县
    public function city($pro_id){
        $city=new City();
        $res=$city->where('province_id',$pro_id)->select();
        return $res;
    }
    //添加地区时返回区名
    public function allname($province_id,$city_id){
        $city=new City();
        $pro=new Province();
        $res=[];
        $res['pro_name']=$pro->where('id',$province_id)->column('name');
        $res['city_name']=$city->where('id',$city_id)->column('name');
        return $res;
    }
    //添加商品属性图
    public function uploadSxImg(){
        $file = request()->file('file');
        if($file==''){
            return '';
        }
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
//            $filePath = DS . 'uploads' . DS . $info->getSaveName();
            $pic=DS . 'uploads' . DS . $info->getSaveName();//替换"\"为"/"
//                    $res['name']='/uploads/goodstmp/'.$pic;
            $goodspic=$_SERVER['DOCUMENT_ROOT'] .$pic;
            $filePaths = uploadOss1($goodspic);
            unset($info);
            $imgurl = str_replace("\\", "/", $pic);
            $imgurl = ltrim($imgurl, '/');
            unlink($imgurl);
//            $res['code'] =1;
            $filePath = 'https://chyxg.oss-cn-zhangjiakou.aliyuncs.com/'.$filePaths;
            return $filePath;
        }else{
            return $file->getError();
        }
    }

    /**
     * 添加商品属性
     */
    protected function goods_attr($goods_id,$shuxing,$image=''){
        $shuxing=json_decode($shuxing,true);
        //dump($shuxing);die;
        $cate=array_column($shuxing,'propnames');
        $cate_zhi=array_column($shuxing,'propvalnames');
//        var_dump($cate_zhi);exit;
        if($cate){
            //属性分类
            $cate_array=explode(';',$cate[0]);//print_r($cate_array);exit;
            $atrcounts=Db::table('yx_goods_assessment')->where('g_id',$goods_id)->where('is_delete',0)->field('atr_id')->select();
            foreach ($atrcounts as $kl=>$vl){
                $cates_name=Db::table('yx_goods_attribute_category')
                    ->where('id',$vl['atr_id'])
                    ->field('name')
                    ->find();
                $cates_names[]=$cates_name['name'];
            }
            if(count($cate_array)>count($atrcounts)){
                Db::table('yx_goods_assessment')->where('g_id',$goods_id)->update(['is_delete'=>1]);
                Db::table('yx_goods_assessment_price')->where('g_id',$goods_id)->update(['is_delete'=>1]);
            }
            if(count($cate_array)<count($atrcounts)){
                Db::table('yx_goods_assessment')->where('g_id',$goods_id)->update(['is_delete'=>1]);
                Db::table('yx_goods_assessment_price')->where('g_id',$goods_id)->update(['is_delete'=>1]);
            }
            if(count($cate_array)==count($atrcounts)){
                foreach ($cate_array as $kc=>$vc){
                    if(in_array($vc,$cates_names)){
                        $pan=1;
                    }else{
                        $this->error('属性与以上规格不符！');
                    }
                }
            }
            $shuxing_num=0;
            foreach($cate_array as $c_k=>$c_v) {
                //判断属性分类是否已经在表中，没有添加，有则获取id
                $cate_ids=Db::table('yx_goods_attribute_category')->field('id')->where(['name'=>$c_v])->find();
//                var_dump($cate_ids);exit;
                if(!empty($cate_ids)){
                    //一级属性存在（例如颜色、尺寸）
                    $cate_id[$c_k]=$cate_ids['id'];
//                                print_r( $cate_id[$c_k]);
//                             exit();
                }else{
                    //一级属性不存在（例如颜色、尺寸）
                    $cate_id[$c_k]=Db::table('yx_goods_attribute_category')->insertGetId(['name'=>$c_v]);
                }
//                var_dump($cate_zhi);exit;
                //属性值
                foreach ($cate_zhi as $cz_k => $cz_z) {
                    $cz_z_array = explode(';', $cz_z);
                    $cate_zhis=Db::table('yx_goods_attribute')->field(['id'])->where(['name'=>['like',$cz_z_array[$c_k]],'c_id'=>$cate_id[$c_k]])->find();

                    if(!empty($cate_zhis)){
                        $cate_zhi_id[$c_k][$cz_k]=$cate_zhis['id'];
                    }else{
                        $cate_zhi_id[$c_k][$cz_k]=Db::table('yx_goods_attribute')->insertGetId(['name'=>$cz_z_array[$c_k],'c_id'=>$cate_id[$c_k]]);
                    }

//                    if(){
//
//                    }
                    unset($cate_zhis);
                    $goods_zhi_id[$cz_k][$c_k]=(string)$cate_zhi_id[$c_k][$cz_k];
//                    var_dump($cz_z_array);
//                    var_dump($cate_id);

                }

                $cate_zhi_id[$c_k]=array_unique($cate_zhi_id[$c_k]);
//                var_dump( $cate_zhi_id[$c_k]);

//                var_dump($goods_zhi_id[$cz_k][$c_k]);

                foreach($cate_zhi_id[$c_k] as $kk=>$vv){
                    $cate_zhi_ids[$c_k][]=(string)($vv);
                }
//                print_r($cate_zhi_ids[$c_k]);
//                print_r(json_encode($cate_zhi_ids[$c_k]));

                $cate_zhi_idss[$c_k]=json_encode($cate_zhi_ids[$c_k]);
//                var_dump($cate_id[$c_k]);
//              商品一级属性下有哪些二级属性
                $assessments=Db::table('yx_goods_assessment')->where('g_id',$goods_id)->where('atr_id',$cate_id[$c_k])->where('is_delete',0)->field('id,g_id,atr_id,ids')->find();
//                var_dump($assessments);
//                var_dump(json_decode($assessments['ids']));
                if(!empty($assessments)){
                    $arry2=json_decode($assessments['ids']);

                    $str1=implode($arry2);

                    $str2=implode($cate_zhi_ids[$c_k]);
//                var_dump($str1);
//                var_dump($str2);
//                var_dump();
                    if($str1===$str2){
//                    true
                        $cate_zhi_idss[$c_k]=json_encode($cate_zhi_ids[$c_k]);
//                        print_r(  $cate_zhi_idss[$c_k]);
                    }else{
                        //                    false
//                    去重
//                        print_r($cate_zhi_ids[$c_k]);
//                        print_r($arry2);
//                        $diff[$c_k]=array_diff($cate_zhi_ids[$c_k],$arry2);
//                        print_r( $diff[$c_k]);
//                        $arry3=array_values($diff[$c_k]);
                        $merges=array_merge($arry2,$cate_zhi_ids[$c_k]);
                        $arry3=array_values($merges);
//                        print_r($arry3);
                        $uniques=array_unique($merges);
//                        print_r($uniques);
//                        print_r($uniques);
//                        var_dump($cate_zhi_idss[$c_k]);
                        $cate_zhi_idss[$c_k]=json_encode($uniques);
//                        print_r(  $cate_zhi_idss[$c_k]);

                    }
//                    var_dump($cate_zhi_idss[$c_k]);
//                    exit;
                    $shuxing_nums=Db::table('yx_goods_assessment')->where('id',$assessments['id'])->update(['ids'=>$cate_zhi_idss[$c_k]]);
                }else{
                    $shuxing_nums=Db::table('yx_goods_assessment')->insert(['g_id'=>$goods_id,'atr_id'=>$cate_id[$c_k],'ids'=>$cate_zhi_idss[$c_k]]);
                }

                unset($cate_ids);
                //商品属性表
//                $goods_addr = Db::table('yx_goods_assessment')->field(['id'])->where(['g_id'=>$goods_id,'atr_id'=>$cate_id[$c_k],'is_delete'=>0])->find();
//
//                Db::table('yx_goods_assessment')->where(['g_id'=>$goods_id])->update(['is_delete'=>1]);
                $shuxing_num+=$shuxing_nums;
                //var_dump($shuxing_num);exit;
            }
//            dump($shuxing);exit;
            //商品属性价格表
            $goods_num=0;
//            $go_num=0;
//            dump($goods_zhi_id);
//            print_r()
            if($shuxing_num){

                foreach($goods_zhi_id as $gz_k=>$gz_v){
                    $insertsss[$gz_k]['ids']=json_encode($gz_v);

//                    $assessprice=Db::table('yx_goods_assessment_price')->where('g_id',$goods_id)->where('ids',json_encode($gz_v))->where('is_delete',0)->find();
//                    if(empty($assessprice)){
                    $insertsss[$gz_k]['g_id']=$goods_id;//商品id
                    $insertsss[$gz_k]['num']=$shuxing[$gz_k]['num'];//属性库存
                    if(empty($shuxing[$gz_k]['proImg']) || $shuxing[$gz_k]['proImg']=='' || !isset($shuxing[$gz_k]['proImg']) || $shuxing[$gz_k]['proImg']=='undefined'){
                          $images=$image;
                    }else{
                        $images=$shuxing[$gz_k]['proImg'];
                    }
                    $insertsss[$gz_k]['img']=$images;//图片
                    $insertsss[$gz_k]['cost_price']=(isset($shuxing[$gz_k]['cost_price']) && !empty($shuxing[$gz_k]['cost_price']))?$shuxing[$gz_k]['cost_price'] : 1;//规格原价
                    $insertsss[$gz_k]['price']=(isset($shuxing[$gz_k]['price']) && !empty($shuxing[$gz_k]['price']))?$shuxing[$gz_k]['price'] : 1;//售价
                    $insertsss[$gz_k]['sell_num']=(isset($shuxing[$gz_k]['sell_num']) && !empty($shuxing[$gz_k]['sell_num']))?$shuxing[$gz_k]['sell_num'] : 1;//起卖量
                    $insertsss[$gz_k]['general_price']=(isset($shuxing[$gz_k]['general_price']) && !empty($shuxing[$gz_k]['general_price']))?$shuxing[$gz_k]['general_price'] : 1;//总代价
                    $insertsss[$gz_k]['director_price']=(isset($shuxing[$gz_k]['director_price']) && !empty($shuxing[$gz_k]['director_price']))?$shuxing[$gz_k]['director_price'] : 1;//董事价
//                    $insertsss[$gz_k]['one_agent']=$shuxing[$gz_k]['one_agent'];//一级佣金
                    $insertsss[$gz_k]['two_agent']=$shuxing[$gz_k]['two_agent'];//二级佣金
                    $insertsss[$gz_k]['three_agent']=$shuxing[$gz_k]['three_agent'];//三级佣金
                    $insertsss[$gz_k]['manager']=$shuxing[$gz_k]['manager'];//董事奖金

                }
//                var_dump($insertsss);
//                exit();

//                    Db::table("yx_goods")->where(['id'=>$goods_id])->update(['nums'=>$goods_num]);

                if(isset($insertsss) && !empty($insertsss)){
//                    print_r($insertsss);
                    $datass=Db::table('yx_goods_assessment_price')->insertAll($insertsss);
                }else{
                    $datass=true;
                }

            }else{
                $datass=false;
            }
//            exit();
            return $datass;
        }
//        exit();
    }
//    修改商品页面删除属性操作
    public function delatr($id){
        $mentprice=new AssessmentPrice();
        $ment=new Assessment();
        $prices=$mentprice->where('id',$id)->field('g_id,ids')->find();
        $ments=$ment->where('g_id',$prices['g_id'])->where('is_delete',0)->field('id,ids')->select();
        $priceatrs=$mentprice->where('g_id',$prices['g_id'])->where('is_delete',0)->field('id,ids')->select();
        $str='';

        foreach ($priceatrs as $key=>$val){
            $arr=json_decode($val['ids']);
            $str=$str.",".implode(',',$arr);
        }
//var_dump(ltrim($str, ","));'4,11,5,10,5,11,7,10,7,11'
        $dump=explode(',',ltrim($str, ","));
        $aids=array_count_values($dump);
        foreach ($aids as $ak=>$av){
            if($av==1){
                $arr3[]=$ak;
            }else{
                $arr4=[];

            }
        }

        if(isset($arr3) && !empty($arr3)){
            $idsprice=json_decode($prices['ids']);
            $arr4=array_intersect($arr3,$idsprice);
            foreach ($ments as $k=>$v){
                $atrids=json_decode($v['ids']);
                $atrprices=$arr4;
                $diffs=array_diff($atrids,$atrprices);
                if(count($diffs)===0){
                    $res=$ment->where('id',$v['id'])->update(['is_delete'=>1]);
                }else{
                    $ids=array_values($diffs);
                    $res=$ment->where('id',$v['id'])->update(['ids'=>json_encode($ids)]);
                }
            }
        }else{
            $res=1;
        }
        $res=1;
//        print_r($res);
//        die;
        $data=$mentprice->where('id',$id)->update(['is_delete'=>1]);
        if($res && $data){
            return 1;
        }else{
            return 0;
        }
    }
    //修改商品页面
    public function edit($goods_id){
        $goods=new Goods();
        $freight=new Freight();
        $goods_id=(int)$goods_id;
        //商品信息coupon_id
        $info=$goods->alias('g')->join('yx_goods_category c','g.classify_id=c.id')
//            ->join('yx_coupon p','p.id=g.coupon_id')
            ->where('g.id',$goods_id)->field('g.*,c.name as cate_name')->find();
//        $uploade=substr($info['goods_images'],0,-1);
        $coupons=Db::table('yx_coupon')->where('id',$info['coupon_id'])->where('is_delete',2)->field('name')->find();
        $images=explode(",",$info['goods_images']);
        $cate=new GoodsCategory();
        $pname=$cate->where('id',$info['classify_id'])->field('pid')->find();
        $pnames=$cate->where('id',$pname['pid'])->field('id,name')->find();
        $first=$cate->where('pid',0)->order('sort,id')->select();
        foreach ($first as $k=>$v){
            $second=$this->second($v['id']);
            $first[$k]['second']=$second;
        }
        //运费信息
        $freights=$freight->where('goods_id',$goods_id)->select();
        //属性信息
        $attr=$this->assess($goods_id);
//        return json($info);
        $coupon=new Coupon();
        $res=$coupon->where('type',1)->where('is_delete',2)->select();
        $pro=$this->province();
//        return json($attr);$coupons
        $this->assign('pnames',$pnames);
        $this->assign('coupons',$coupons);
        $this->assign('cate',$first);
        $this->assign('coupon',$res);
        $this->assign('province',$pro);
        $this->assign('attr',$attr);
        $this->assign('freights',$freights);
        $this->assign('info',$info);
        $this->assign('images',$images);
        return $this->fetch();
    }
    //修改操作
    public function edits(){
        $data=input('post.');
        //更新商品信息
        $good=new Goods();
        $shops=$good->where('goods_number',$data['goods_number'])->find();
        if(!empty($shops) && $shops['id']!=$data['goods_id']){
            $this->error('已有此商品编码的商品！');
        }
        if(empty($data['startTime'])){
            $goods['start_time']=time();
            $goods['end_time']=strtotime($data['endTime']);
        }else{
            $goods['start_time']=strtotime($data['startTime']);
            $goods['end_time']=strtotime($data['endTime']);
            if($goods['start_time']>=$goods['end_time']){
                $this->error('开始时间需小于结束时间！');
            }
        }

//        else{
            $images=explode(",",$data['goods_images']);
            $goods['logo_image']=$images[0];
            $goods['name']=$data['name'];
            $goods['describe']=$data['describe'];
            $goods['is_return']=$data['is_return'];
            $goods['classify_id']=$data['classify_id'];
            $goods['goods_price']=(isset($data['goods_price']) && !empty($data['goods_price']))?$data['goods_price'] : 1;
            $goods['original_price']=(isset($data['original_price']) && !empty($data['original_price']))?$data['original_price'] : 1;
            $goods['limit_num']=$data['limit_num'];
            $goods['goods_number']=$data['goods_number'];
            $goods['own_integral']=$data['own_integral'];
            $goods['where_division']=$data['where_division'];
            $goods['is_use_coupon']=$data['is_use_coupon'];
            $goods['coupon_id']=$data['coupon_id'];
            $goods['goods_images']=$data['goods_images'];
            $goods['goods_detail']=$data['goods_detail'];
            $goods['use_type']=$data['use_type'];
            $goods['is_up']=$data['is_up'];
            $goods['freight']=$data['freight'];
            $goods['is_putaway']=$data['is_putaway'];
            $goods['one_integral']=$data['one_integral'];
            $goods['two_integral']=$data['two_integral'];
            $goods['three_integral']=$data['three_integral'];

            $goods['update_time']=time();
            if(isset($data['freight_pros']) && !empty($data['freight_pros'])){
                if(isset($data['freight_ids']) && !empty($data['freight_ids'])){
                    $freight=$this->editFreight($data['goods_id'],$data['freight_ids'],$data['freight_pros'],$data['freight_citys'],$data['freight_moneys']);
                }else{
                    $freight_ids=[];
                    $freight=$this->editFreight($data['goods_id'],$freight_ids,$data['freight_pros'],$data['freight_citys'],$data['freight_moneys']);
                }

//            $freight=$this->if_pro($inId,$data['freight_pros'],$data['freight_citys'],$data['freight_moneys']);
            }else{
                $freight=false;
            }

            if(isset($data['atr_ids']) && !empty($data['atr_ids'])){
                $atr_ids=$data['atr_ids'];
                $prices=$data['prices'];
                $nums=$data['nums'];
                $cost_prices=$data['cost_prices'];
                $director_prices=$data['director_prices'];
                $general_prices=$data['general_prices'];
//                $one_agents=$data['one_agents'];
                $two_agents=$data['two_agents'];
                $three_agents=$data['three_agents'];

                $setting_imgs=$data['setting_imgs'];
                $sell_nums=$data['sell_nums'];
                $managers=$data['managers'];
                $type=0;

                $this->attrPrice($type,$atr_ids,$cost_prices,$prices,$nums,$director_prices,$general_prices,$two_agents,$three_agents,$sell_nums,$setting_imgs,$managers,$data['goods_id'],$images[0]);
            }
            $attrReturn=1;
            if(isset($data['testArray']) && !empty($data['testArray'])){
                $testArray=$data['testArray'];
                $attrReturn=$this->goods_attr($data['goods_id'],json_encode($testArray),$images[0]);
            }
//            if($attrReturn!=1){
//                $this->error('属性与以上规格不符！');
//            }else{
                $res=$good->where('id',$data['goods_id'])->update($goods);
                $goods_num=Db::table('yx_goods_assessment_price')->where('g_id',$data['goods_id'])->where('is_delete',0)->field('num')->select();
                $gnum=0;
                foreach ($goods_num as $key=>$val){
                    $gnum+=$val['num'];
                }
                Db::table("yx_goods")->where(['id'=>$data['goods_id']])->update(['nums'=>$gnum]);
                if($res){
                    $this->success('操作成功');
                }else{
                    $this->error('操作失败！');
                }
//            }
//        }


//        return $atr_ids;
    }
    //其他运费
    public function editFreight($gid,$freight_ids,$freight_pros,$freight_citys,$freight_moneys){
        $freight=new Freight();
        for ($i=0;$i<count($freight_ids);$i++){
            $arr['province']=$freight_pros[$i];
            $arr['city']=$freight_citys[$i];
            $arr['freight']=$freight_moneys[$i];
            $arr['update_time']=time();
            $freight->where('id',$freight_ids[$i])->update($arr);
        }
        $arr2['goods_id']=$gid;
        $num=count($freight_pros)-count($freight_ids);
        if($num!=0){
            for ($i1=count($freight_ids);$i1<count($freight_pros);$i1++){
                $arr2['province']=$freight_pros[$i1];
                $arr2['city']=$freight_citys[$i1];

                $arr2['freight']=$freight_moneys[$i1];
                $arr2['update_time']=time();
                $freight->insert($arr2);
            }
            return true;
        }

        return true;

    }
    //属性价格修改
    public function attrPrice($type,$atr_ids,$cost_prices,$prices,$nums,$director_prices,$general_prices,$two_agents,$three_agents,$sell_nums,$setting_imgs,$managers,$id,$images=''){
        if($type==1){
            //删除原先属性价格
            $art['is_delete']=1;
        }else{
            //不删除原先属性价格
            $art['is_delete']=0;
        }
        $mentprice=new AssessmentPrice();
        $num=0;
        for ($i=0;$i<count($atr_ids);$i++){
            $art['price']=$prices[$i];
            $art['cost_price']=$cost_prices[$i];
            $art['num']=$nums[$i];
//            $art['one_agent']=$one_agents[$i];
            $art['general_price']=$director_prices[$i];
            $art['director_price']=$general_prices[$i];
            $art['two_agent']=$two_agents[$i];
            $art['three_agent']=$three_agents[$i];
            $art['sell_num']=$sell_nums[$i];

            if(empty($setting_imgs[$i]) || !isset($setting_imgs[$i]) || $setting_imgs[$i]==''||$setting_imgs[$i] =='undefined'){
                $att_images=$images;

            }else{
                $att_images=$setting_imgs[$i];
            }
            $art['img']=$att_images;
            $art['manager']=$managers[$i];
            $num+=$nums[$i];
            $mentprice->where('id',(int)$atr_ids[$i])->update($art);
        }
        Db::table("yx_goods")->where(['id'=>$id])->update(['nums'=>$num]);
        return true;

    }
    //商品属性价格软删除
    public function attrPrices($atr_ids){
        $mentprice=new AssessmentPrice();
        for ($i=0;$i<count($atr_ids);$i++){
            $mentprice->where('id',(int)$atr_ids[$i])->update(['is_delete'=>1]);
        }
    }
    //属性信息
    public function assess($goods_id){
        $price=new AssessmentPrice();
        $attr=new Attribute();
        $ment=new Assessment();
        $attcate=new AttributeCate();
        $prices=$price->where('g_id',(int)$goods_id)->where('is_delete',0)->select();//价格表
        $ments=$ment->alias('m')->join('yx_goods_attribute_category c','m.atr_id=c.id')
            ->where('m.is_delete',0)->where('m.g_id',$goods_id)->field('c.name')->select();//属性分类名颜色、规格
//        print
        $allments=Db::table('yx_goods_assessment')->where('g_id',$goods_id)->where('is_delete',0)->field('atr_id')->select();
        if(isset($allments) && !empty($allments)){
            foreach ($allments as $key=>$val){
                $allment[]=$attcate->where('id',$val['atr_id'])->find();
            }
        }else{
            $allment=$attcate->limit(3)->select();
        }

//        print_r($allment);
//        exit();
//        $ment->join('yx_goods_att')->where('g_id',$goods_id)->where('is_delete',0)->group('atr_id')->select();
//        $allment=$attcate->select();
//        $allment=$attcate->limit(3)->select();
        foreach ($allment as $k=>$v){
            $allment[$k]['attr']=$attr->where('c_id',$v['id'])->field('name')->select();
        }
//        print_r()
        foreach ($prices as $k=>$v){
            $ids=json_decode($v['ids']);
            foreach ($ids as $k2){
                $arr1=$attr->where('id',(int)$k2)->field('name')->find();//属性名
                $arr[]=$arr1['name'];
            }
            $prices[$k]['ments']=implode(',',$arr);
            unset($arr);
        }
//        $gment=[];
        $gment['ment']=$ments;
        $gment['prices']=$prices;
        $gment['allment']=$allment;
        return $gment;
    }

    //删除运费
    public function delfre($id){
        $freight=new Freight();
        $res=$freight->where('id',$id)->delete();
        if($res){
            return 1;
        }else{
            return 0;
        }
    }


}