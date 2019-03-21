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
use think\Log;

class Goodslist extends Controller
{
   //首页展示
    public function index(){
        $res=input('get.');
        $goods_cate=new GoodsCategory();
        //更新警戒线状态
        $this->isCordon();
        $time=time();
        $newstart = mktime(0, 0, 0, date("m", $time), date("d", $time), date("Y", $time));
        $newend = mktime(23, 59, 59, date("m", $time), date("d", $time), date("Y", $time));
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
            if($res['goods_status']==4){
//                警戒
                $where1['g.cordon_status']=1;
                $where1['g.is_delete']=['eq',2];
                $where4=[];
            }elseif($res['goods_status']==3){
//                出售
                $where1['g.is_putaway']=0;
                $where1['g.is_delete']=['eq',2];
                $where4=[];
            }elseif($res['goods_status']==5){
//                仓库中
                $where1['g.is_putaway']=1;//下架
                $where1['g.start_time']=['>',time()];
                $where1['g.is_delete']=['eq',2];
                $where4=[];
            }elseif($res['goods_status']==6){
                //今日下架

                $where1['g.down_time']=['between', [$newstart, $newend]];
                $where1['g.is_delete']=['eq',2];
                $where4['g.end_time']=['between', [$newstart, $newend]];
                $where4['g.is_delete']=['eq',2];
            }elseif ($res['goods_status']==2){
//                待上架
                $where1['g.is_putaway']=1;
                $where1['g.is_delete']=['eq',2];
                $where4=[];
            }else{
//                已售罄
                $where1['g.nums']=0;
                $where1['g.is_delete']=['eq',2];
                $where4=[];
            }
            $this->assign('goods_status',$res['goods_status']);
        }else{
            $where1['g.is_delete']=['eq',2];
            $where4=[];
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
//        全部数量
        $count['all']=$goods->alias('g')
            ->join('yx_goods_category c','g.classify_id=c.id')
            ->where('g.is_delete',2)
            ->count();
//        已售罄数量
        $count['all1']=$goods->alias('g')
            ->join('yx_goods_category c','g.classify_id=c.id')
            ->where('g.nums',0)
            ->where('g.is_delete',2)
            ->count();
//        待上架数量
        $count['all2']=$goods->alias('g')
            ->join('yx_goods_category c','g.classify_id=c.id')
            ->where('g.is_putaway',1)
            ->where('g.is_delete',2)
            ->count();
//        出售中数量
        $count['all3']=$goods->alias('g')
            ->join('yx_goods_category c','g.classify_id=c.id')
            ->where('g.is_putaway',0)
            ->where('g.is_delete',2)
            ->count();
//        警戒数量cordon_status1
        $count['all4']=$goods->alias('g')
            ->join('yx_goods_category c','g.classify_id=c.id')
            ->where('g.cordon_status',1)
            ->where('g.is_delete',2)
            ->count();
//        仓库中数量  $where1['g.start_time']=['>',time()];
        $count['all5']=$goods->alias('g')
            ->join('yx_goods_category c','g.classify_id=c.id')
            ->where('g.is_putaway',1)
            ->where('g.start_time','>',time())
            ->where('g.is_delete',2)
            ->count();
//        今日下架数量
        $wherea['g.down_time']=['between', [$newstart, $newend]];
        $wherea['g.is_delete']=['eq',2];
        $whereb['g.end_time']=['between', [$newstart, $newend]];
        $whereb['g.is_delete']=['eq',2];
        $count['all6']=$goods->alias('g')
            ->join('yx_goods_category c','g.classify_id=c.id')
            ->where($wherea)
            ->whereOr(function($query)use($whereb){
                $query->where($whereb);
            })

            ->count();
        $list=$goods->alias('g')
           ->join('yx_goods_category c','g.classify_id=c.id')
            ->where($where1)
            ->where($where2)
            ->where($where3)
            ->whereOr(function($query)use($where4){
                $query->where($where4);
            })
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
        $this->assign('count',$count);
       $this->assign('cate',$first);
       $this->assign('page',$page);
       $this->assign('data',$list);
       return $this->fetch();
    }
    /*
     *
     * 商品导出
     * */
    public function excel(){
        $res=input('get.');
        $goods_cate=new GoodsCategory();
        //更新警戒线状态
        $this->isCordon();
        $time=time();
        $newstart = mktime(0, 0, 0, date("m", $time), date("d", $time), date("Y", $time));
        $newend = mktime(23, 59, 59, date("m", $time), date("d", $time), date("Y", $time));
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
        }else{
            $where2=[] ;
        }


        if(isset($res['goods_status']) && !empty($res['goods_status'])){
            if($res['goods_status']==4){
//                警戒
                $where1['g.cordon_status']=1;
                $where1['g.is_delete']=['eq',2];
                $where4=[];
                $str='警戒';
            }elseif($res['goods_status']==3){
//                出售
                $where1['g.is_putaway']=0;
                $where1['g.is_delete']=['eq',2];
                $where4=[];
                $str='出售中';
            }elseif($res['goods_status']==5){
//                仓库中
                $where1['g.is_putaway']=1;//下架
                $where1['g.is_delete']=['eq',2];
                $where1['g.start_time']=['>',time()];
                $where4=[];
                $str='仓库中';
            }elseif($res['goods_status']==6){
                //今日下架

                $where1['g.down_time']=['between', [$newstart, $newend]];
                $where1['g.is_delete']=['eq',2];
                $where4['g.end_time']=['between', [$newstart, $newend]];
                $where4['g.is_delete']=['eq',2];
                $str='今日下架';

            }elseif ($res['goods_status']==2){
//                待上架
                $where1['g.is_putaway']=1;
                $where1['g.is_delete']=['eq',2];
                $where4=[];
                $str='待上架';
            }else{
//                已售罄
                $where1['g.nums']=0;
                $where1['g.is_delete']=['eq',2];
                $where4=[];
                $str='已售罄';
            }

        }else{
//            全部
            $where1['g.is_delete']=['eq',2];
            $where4=[];
            $str='全部';

        }

        if(isset($res['goods_name']) && !empty($res['goods_name'])){
            $where3['g.name'] = ['like',"%{$res['goods_name']}%"];

            $this->assign('goods_name',$res['goods_name']);
        }else{
            $where3=[];
            $this->assign('goods_name','');
        }
        $goods=new Goods();
        $cate=new GoodsCategory();
        $list=Db::table('yx_goods')->alias('g')
            ->join('yx_goods_category c','g.classify_id=c.id')
            ->where($where1)
            ->where($where2)
            ->where($where3)
            ->whereOr(function($query)use($where4){
                $query->where($where4);
            })
            ->order('g.id desc')
            ->field('g.name,c.name as cate_name,g.where_division,g.original_price,g.goods_price,g.nums,g.sales,g.is_putaway')
            ->select();
        foreach ($list as $k=>$v){
//            所属专区 默认0表示昨日爆款，1表示今日主推，2表示其他
            if($v['where_division']==0){
                $list[$k]['where_division']='昨日爆款';
            }elseif ($v['where_division']==1){
                $list[$k]['where_division']='今日主推';
            }else{
                $list[$k]['where_division']='其他';
            }
//            0上架 1下架
            if($v['is_putaway']==0){
                $list[$k]['is_putaway']='上架';
            }else{
                $list[$k]['is_putaway']='下架';
            }
        }
        $name=$str.'商品信息表';
        $header=['商品名称','分类','所属专区','原价','现价','总库存','销量','状态'];
        exportExcel($header,$list,$name);
    }
    /*
     * 判断商品是否警戒
     * */
    public function isCordon(){
       $goods=new Goods();
       $where=[
         'is_delete'=>2,
         'nums'=>['>',0]
       ];
       $goodsList=Db::table('yx_goods')->where($where)->field('id,nums,cordon,cordon_status')->select();
       foreach ($goodsList as $k=>$v){
           if($v['nums']<$v['cordon']){
               $goodsList[$k]['cordon_status']=1;
           }else{
               $goodsList[$k]['cordon_status']=0;
           }
           $goodsList[$k]['update_time']=time();
       }
        $res=$goods->isUpdate()->saveAll($goodsList);

//        var_dump($res);
//        die();
        return true;
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
            $res['is_putaway']=1;
            $res['down_time']=time();
        }else{
            $res['is_putaway']=0;
            $res['down_time']=0;

        }
//        $res['is_putaway']=$status1;
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
            $res['down_time']=0;
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
            $res['down_time']=time();
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
        $coupon=new Coupon();
//        is_putaway 默认0表示未发放，1表示发放
        $res=$coupon->where('type',1)
            ->where('num','>',0)
            ->where('is_delete',2)
            ->where('is_putaway',1)
            ->select();
        foreach ($res as $keys=>$vals){
            if ($vals['status']==1){
                if(time()>$vals['end']){
                    unset($res[$keys]);
                }
            }
        }
        $pro=$this->province();
//        $this->assign('allment',$allment);
        $this->assign('cate',$first);
        $this->assign('coupon',$res);
        $this->assign('province',$pro['province']);
        return $this->fetch();
    }
    //添加商品
    public function adds(Request $request){
        $data=input();
//        dump(json_decode($data['testArray']));
//        die();
        $shop=new Goods();
        $goods['goods_number']=$data['goods_bian'];
        $shops=$shop->where('goods_number',$data['goods_bian'])->find();
//        if(!empty($shops)){
//            $this->error('已有此商品编码的商品！');
//        }
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
            $goods['cordon']=(isset($data['cordon']) && !empty($data['cordon']))?$data['cordon'] : 1;
            $goods['name']=$data['goodsname'];
            $goods['is_return']=$data['is_return'];
            $goods['describe']=$data['goods_describe'];
            $goods['classify_id']=$data['cate_id'];
            $goods['goods_price']=$data['goods_price'];
            $goods['original_price']=$data['old_price'];
            $goods['limit_num']=(isset($data['limit_num']) && !empty($data['limit_num']))?$data['limit_num'] : 0;
            $goods['own_integral']=$data['integral'];
            $goods['where_division']=$data['division'];
            $goods['is_use_coupon']=$data['is_pons'];
            $goods['coupon_id']=$data['pons'];
            $goods['goods_images']=$data['pics'];
            $goods['goods_detail']=$data['detail'];
            $goods['use_type']=$data['identity'];
            $goods['is_up']=$data['is_up'];
//            $goods['freight']=$data['freights'];
            $goods['is_putaway']=$data['ishot'];
            $goods['one_integral']=$data['one'];
            $goods['two_integral']=$data['two'];
            $goods['three_integral']=$data['three'];
            $goods['create_time']=time();

            $goods['update_time']=time();

            $testArray=$data['testArray'];
//            dump($testArray);
//            die();
            $goodsValidate=new \app\index\validate\Goods();
            $result = $goodsValidate->check($goods);
            if (true !== $result) {
                return json(1001, '', $goodsValidate->getError());
            }

            $inId=$shop->insertGetId($goods);
//        dump($data);die;
            //插入其他运费
            if(isset($data['freight_pros']) && !empty($data['freight_pros'])){
                $freight=$this->if_pro($inId,$data['freight_pros']);
//                $freight=$this->if_pro($inId,$data['freight_pros'],$data['freight_moneys']);
            }else{
                $freight=false;
            }


            //插入商品属性
            $attr=$this->goods_attr($inId,$testArray,$images[0]);

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
    public function if_pro($id,$freight_pros){
        $freight=new Freight();
        $freight->where('goods_id',$id)->delete();
        foreach ($freight_pros as $k=>$v){
            foreach ($v['province'] as $val){
                $res['goods_id']=$id;
                $res['province']=$val;
                $res['freight']=$v['price'];
                $res['create_time']=time();
                $freight->insert($res);
            }
        }
        return true;
    }

    //二级分类
    public function second($cate_id){
        $cate=new GoodsCategory();
        $second=$cate->where('pid',$cate_id)->order('sort,id')->select();
        return $second;
    }
    //商品所属省运费
    public function province($gid=0){
        $pro=new Province();
        $freight=new Freight();
        $data=Db::table('yx_province')->field('name')->select();
        foreach ($data as $k=>$v){
            $data[$k]['name']=$v['name'];
            $data[$k]['status']=0;
        }
        if($gid==0){
            $res['province']=$data;
            $res['goods_province']=[];
        }else{
//            省
            $goods_province=Db::table('yx_freight')->where('goods_id',$gid)
                ->where('is_delete',0)
                ->group('province')
                ->field('province,id')
                ->select();
//            运费
            $goods_freight=Db::table('yx_freight')->where('goods_id',$gid)
                ->where('is_delete',0)
                ->group('freight')
                ->field('freight')
                ->select();
            $freights_goods=[];
            foreach ($goods_freight as $keys=>$vals){
                $provices=Db::table('yx_freight')->where('goods_id',$gid)
                    ->where('is_delete',0)
                    ->where('freight',$vals['freight'])
                    ->group('province')
                    ->field('province')
                    ->select();
                $provices_name=[];
                foreach ($provices as $kp=>$vp){
                    $provices_name[]=$vp['province'];
                }
                $freights_goods[$keys]['price']=$vals['freight'];
                $freights_goods[$keys]['province']=$provices_name;
            }
            foreach ($data as $k=>$v){
                $name[]=$v['name'];
            }

            foreach ($goods_province as $key=>$val){
                $array=array_flip($name);
                $keys=$array[$val['province']];
                    $data[$keys]['status']=1;
            }
            $res['province']=$data;
            $res['goods_province']=$freights_goods;
        }
        return $res;
    }
    //县
    public function city($pro_id){
        $city=new City();
        $res=$city->where('province_id',$pro_id)->select();
        return $res;
    }
    //添加地区时返回区名
    public function allname($province_id=5,$city_id=0){
        $city=new City();
        $pro=new Province();
        $res=[];
        $name=$pro->where('id',$province_id)->column('name');
        if($city_id==0){
           $citys=$city->where('province_id',$province_id)->field('name')->select();
           foreach ($citys as $key=>$val){
               $res[$key]['pro_name']=$name[0];
               $res[$key]['city_name']=$val['name'];
           }
        }else{
            $res['pro_name']=$name;
            $res['city_name']=$city->where('id',$city_id)->column('name');
        }
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
            $pic=DS . 'uploads' . DS . $info->getSaveName();//替换"\"为"/"
            $goodspic=$_SERVER['DOCUMENT_ROOT'] .$pic;
            $filePaths = uploadOss1($goodspic);
            unset($info);
            $imgurl = str_replace("\\", "/", $pic);
            $imgurl = ltrim($imgurl, '/');
            unlink($imgurl);
            $filePath = 'https://chyxg.oss-cn-zhangjiakou.aliyuncs.com/'.$filePaths;
            return $filePath;
        }else{
            return $file->getError();
        }
    }
    /**
     * 添加商品属性
     */
//    protected function goods_attr($goods_id,$shuxing,$image=''){
//        $myfile = fopen("newfile.txt",'w');
//        fwrite($myfile,$shuxing);
//        fclose($myfile);
//        $shuxing=json_decode($shuxing,true);
//
//        //dump($shuxing);die;
//        $cate=array_column($shuxing,'propnames');
//        $cate_zhi=array_column($shuxing,'propvalnames');
////        var_dump($cate_zhi);exit;
//        if($cate){
//            //属性分类
//            $cate_array=explode(';',$cate[0]);//print_r($cate_array);exit;
//            $atrcounts=Db::table('yx_goods_assessment')->where('g_id',$goods_id)->where('is_delete',0)->field('atr_id')->select();
//            foreach ($atrcounts as $kl=>$vl){
//                $cates_name=Db::table('yx_goods_attribute_category')
//                    ->where('id',$vl['atr_id'])
//                    ->field('name')
//                    ->find();
//                $cates_names[]=$cates_name['name'];
//            }
//            if(count($cate_array)>count($atrcounts)){
//                Db::table('yx_goods_assessment')->where('g_id',$goods_id)->update(['is_delete'=>1]);
//                Db::table('yx_goods_assessment_price')->where('g_id',$goods_id)->update(['is_delete'=>1]);
//            }
//            if(count($cate_array)<count($atrcounts)){
//                Db::table('yx_goods_assessment')->where('g_id',$goods_id)->update(['is_delete'=>1]);
//                Db::table('yx_goods_assessment_price')->where('g_id',$goods_id)->update(['is_delete'=>1]);
//            }
//            if(count($cate_array)==count($atrcounts)){
//                foreach ($cate_array as $kc=>$vc){
//                    if(in_array($vc,$cates_names)){
//                        $pan=1;
//                    }else{
//                        $this->error('属性与以上规格不符！');
//                    }
//                }
//            }
//            $shuxing_num=0;
//            foreach($cate_array as $c_k=>$c_v) {
//                //判断属性分类是否已经在表中，没有添加，有则获取id
//                $cate_ids=Db::table('yx_goods_attribute_category')->field('id')->where(['name'=>$c_v])->find();
////                var_dump($cate_ids);exit;
//                if(!empty($cate_ids)){
//                    //一级属性存在（例如颜色、尺寸）
//                    $cate_id[$c_k]=$cate_ids['id'];
////                                print_r( $cate_id[$c_k]);
////                             exit();
//                }else{
//                    //一级属性不存在（例如颜色、尺寸）
//                    $cate_id[$c_k]=Db::table('yx_goods_attribute_category')->insertGetId(['name'=>trim($c_v)]);
//                }
////                var_dump($cate_zhi);exit;
//                //属性值
//                foreach ($cate_zhi as $cz_k => $cz_z) {
//                    $cz_z_array = explode(';', $cz_z);
//                    $cate_zhis=Db::table('yx_goods_attribute')->field(['id'])->where(['name'=>['like',$cz_z_array[$c_k]],'c_id'=>$cate_id[$c_k]])->find();
//
//                    if(!empty($cate_zhis)){
//                        $cate_zhi_id[$c_k][$cz_k]=$cate_zhis['id'];
//                    }else{
//                        $cate_zhi_id[$c_k][$cz_k]=Db::table('yx_goods_attribute')->insertGetId(['name'=>trim($cz_z_array[$c_k]),'c_id'=>$cate_id[$c_k]]);
//                    }
//
////                    if(){
////
////                    }
//                    unset($cate_zhis);
//                    $goods_zhi_id[$cz_k][$c_k]=(string)$cate_zhi_id[$c_k][$cz_k];
////                    var_dump($cz_z_array);
////                    var_dump($cate_id);
//
//                }
//
//                $cate_zhi_id[$c_k]=array_unique($cate_zhi_id[$c_k]);
////                var_dump( $cate_zhi_id[$c_k]);
//
////                var_dump($goods_zhi_id[$cz_k][$c_k]);
//
//                foreach($cate_zhi_id[$c_k] as $kk=>$vv){
//                    $cate_zhi_ids[$c_k][]=(string)($vv);
//                }
////                print_r($cate_zhi_ids[$c_k]);
////                print_r(json_encode($cate_zhi_ids[$c_k]));
//
//                $cate_zhi_idss[$c_k]=json_encode($cate_zhi_ids[$c_k]);
////                var_dump($cate_id[$c_k]);
////              商品一级属性下有哪些二级属性
//                $assessments=Db::table('yx_goods_assessment')->where('g_id',$goods_id)->where('atr_id',$cate_id[$c_k])->where('is_delete',0)->field('id,g_id,atr_id,ids')->find();
////                var_dump($assessments);
////                var_dump(json_decode($assessments['ids']));
//                if(!empty($assessments)){
//                    $arry2=json_decode($assessments['ids']);
//
//                    $str1=implode($arry2);
//
//                    $str2=implode($cate_zhi_ids[$c_k]);
////                var_dump($str1);
////                var_dump($str2);
////                var_dump();
//                    if($str1===$str2){
////                    true
//                        $cate_zhi_idss[$c_k]=json_encode($cate_zhi_ids[$c_k]);
////                        print_r(  $cate_zhi_idss[$c_k]);
//                    }else{
//                        //                    false
////                    去重
////                        print_r($cate_zhi_ids[$c_k]);
////                        print_r($arry2);
////                        $diff[$c_k]=array_diff($cate_zhi_ids[$c_k],$arry2);
////                        print_r( $diff[$c_k]);
////                        $arry3=array_values($diff[$c_k]);
//                        $merges=array_merge($arry2,$cate_zhi_ids[$c_k]);
//                        $arry3=array_values($merges);
////                        print_r($arry3);
//                        $uniques=array_unique($merges);
////                        print_r($uniques);
////                        print_r($uniques);
////                        var_dump($cate_zhi_idss[$c_k]);
//                        $cate_zhi_idss[$c_k]=json_encode($uniques);
////                        print_r(  $cate_zhi_idss[$c_k]);
//
//                    }
////                    var_dump($cate_zhi_idss[$c_k]);
////                    exit;
//                    $shuxing_nums=Db::table('yx_goods_assessment')->where('id',$assessments['id'])->update(['ids'=>$cate_zhi_idss[$c_k]]);
//                }else{
//                    $shuxing_nums=Db::table('yx_goods_assessment')->insert(['g_id'=>$goods_id,'atr_id'=>$cate_id[$c_k],'ids'=>$cate_zhi_idss[$c_k]]);
//                }
//
//                unset($cate_ids);
//                //商品属性表
////                $goods_addr = Db::table('yx_goods_assessment')->field(['id'])->where(['g_id'=>$goods_id,'atr_id'=>$cate_id[$c_k],'is_delete'=>0])->find();
////
////                Db::table('yx_goods_assessment')->where(['g_id'=>$goods_id])->update(['is_delete'=>1]);
//                $shuxing_num+=$shuxing_nums;
//                //var_dump($shuxing_num);exit;
//            }
////            dump($shuxing);exit;
//            //商品属性价格表
//            $goods_num=0;
////            $go_num=0;
////            dump($goods_zhi_id);
////            print_r()
//            if($shuxing_num){
//                foreach($goods_zhi_id as $gz_k=>$gz_v){
//                    $insertsss[$gz_k]['ids']=json_encode($gz_v);
////                    $assessprice=Db::table('yx_goods_assessment_price')->where('g_id',$goods_id)->where('ids',json_encode($gz_v))->where('is_delete',0)->find();
////                    if(empty($assessprice)){
//                    $insertsss[$gz_k]['g_id']=$goods_id;//商品id
//                    $insertsss[$gz_k]['num']=$shuxing[$gz_k]['num'];//属性库存
//                    if(empty($shuxing[$gz_k]['proImg']) || $shuxing[$gz_k]['proImg']=='' || !isset($shuxing[$gz_k]['proImg']) || $shuxing[$gz_k]['proImg']=='undefined'){
//                        $images=$image;
//                    }else{
//                        $images=$shuxing[$gz_k]['proImg'];
//                    }
//                    $insertsss[$gz_k]['img']=$images;//图片
//                    $insertsss[$gz_k]['cost_price']=(isset($shuxing[$gz_k]['cost_price']) && !empty($shuxing[$gz_k]['cost_price']))?$shuxing[$gz_k]['cost_price'] : 1;//规格原价
//                    $insertsss[$gz_k]['price']=(isset($shuxing[$gz_k]['price']) && !empty($shuxing[$gz_k]['price']))?$shuxing[$gz_k]['price'] : 1;//售价
//                    $insertsss[$gz_k]['sell_num']=(isset($shuxing[$gz_k]['sell_num']) && !empty($shuxing[$gz_k]['sell_num']))?$shuxing[$gz_k]['sell_num'] : 1;//起卖量
//                    $insertsss[$gz_k]['general_price']=(isset($shuxing[$gz_k]['general_price']) && !empty($shuxing[$gz_k]['general_price']))?$shuxing[$gz_k]['general_price'] : 1;//总代价
//                    $insertsss[$gz_k]['director_price']=(isset($shuxing[$gz_k]['director_price']) && !empty($shuxing[$gz_k]['director_price']))?$shuxing[$gz_k]['director_price'] : 1;//董事价
////                    $insertsss[$gz_k]['one_agent']=$shuxing[$gz_k]['one_agent'];//一级佣金
//                    $insertsss[$gz_k]['two_agent']=$shuxing[$gz_k]['two_agent'];//二级佣金
//                    $insertsss[$gz_k]['three_agent']=$shuxing[$gz_k]['three_agent'];//三级佣金
//                    $insertsss[$gz_k]['manager']=$shuxing[$gz_k]['manager'];//董事奖金
//
//                }
////                var_dump($insertsss);
////                exit();
////                Db::table("yx_goods")->where(['id'=>$goods_id])->update(['nums'=>$goods_num]);
//
//                if(isset($insertsss) && !empty($insertsss)){
////                    print_r($insertsss);
//                    $datass=Db::table('yx_goods_assessment_price')->insertAll($insertsss);
//                }else{
//                    $datass=true;
//                }
//
//            }else{
//                $datass=false;
//            }
////            exit();
//            return $datass;
//        }
////        exit();
//    }

    /**
     *添加修改商品属性
     * @param goods_id 商品id
     * @param shuxing 属性json
     * @param image  图片
     **/
    protected function goods_attr($goods_id,$shuxing,
                                            $image=''){
        //    与原先属性做对比
        $this->isAttrContrast($shuxing,$goods_id);
        //        exit;
        Log::record('判断价格去重');        //插入一级分类
        $this->InsertAttributeCategory($goods_id,$shuxing);
        Log::record('一级分类插入成功');
        //获取当前商品一级分类
        $category = $this->GetGoodsAttributeCategoty($goods_id);
        Log::record('一级分类获取成功');
        //获取当前一二级分类全部
        $category = $this->GetAllAttribute($category);

        Log::record('全部属性获取成功');

        //插入二级属性
        $this->InsertAttribute($category,$shuxing);
        Log::record('二级属性插入成功');

        //插入更新assessment
        $dataIds = $this->AttributeStr2Array($shuxing);
        $this->InsertOrUpdateAssesment($shuxing,$goods_id,$dataIds);
        Log::record('assessment插入成功');

        //插入价格
        $this->InsertPrice($shuxing,$goods_id,$image);
        Log::record('价格插入成功');

    }
    /***
     *与原先属性做对比
     *
     */
    public function isAttrContrast($shuxing,$goods_id=0){
        //判断分类与现有分类差别
        $cate=array_column(json_decode($shuxing,true),'propnames');
        $cate_array=explode(';',$cate[0]);
        $atrcounts=Db::table('yx_goods_assessment')->where('g_id',$goods_id)->where('is_delete',0)->field('atr_id')->select();
        $Attr_id=array_column($atrcounts,'atr_id');
        $AtteCate=Db::table('yx_goods_attribute_category')
            ->where('id','in',$Attr_id)
            ->select();
        if(count($cate_array)>count($atrcounts)){
            Db::table('yx_goods_assessment')->where('g_id',$goods_id)->update(['is_delete'=>1]);
            Db::table('yx_goods_assessment_price')->where('g_id',$goods_id)->update(['is_delete'=>1]);
        }
        if(count($cate_array)<count($atrcounts)){
            Db::table('yx_goods_assessment')->where('g_id',$goods_id)->update(['is_delete'=>1]);
            Db::table('yx_goods_assessment_price')->where('g_id',$goods_id)->update(['is_delete'=>1]);
        }
        $name=[];
        foreach ($AtteCate as $d=>$e){
            $name[]= $e['name'];
        }
        if(count($cate_array)==count($atrcounts)){
            foreach ($cate_array as $kc=>$vc){
                if(!in_array($vc,$name)){
                    $this->error('属性与以上规格不符！');
                }else{
                    true;
                }

            }
        }
    }
    /***
     *获取当前商品的属性
     * @param goods_id
     **/
    protected function GetGoodsAssesment($goods_id){
        $where = [
            "is_delete" => 0,
            'g_id' => $goods_id
        ];
        $dataAssesment = Db::table("yx_goods_assessment")->where($where)->select();
        return $dataAssesment;
    }
    /**
     *插入当前一级分类
     * @param goods_id
     * @param shuxing 属性json字符串
     *返回一级属性
     **/
    protected function InsertAttributeCategory($goods_id,$shuxing){
        $c = new AttributeCate();
        $InsertArray = [];
        $dataArray = [];
        $data = json_decode($shuxing,true);
        //转义成数组
        $cate = array_column($data,"propnames");

        //获取一级分类数组
        foreach ($cate as $c => $a){
            $d = explode(";",$a);
            foreach ($d as $k => $j){
                $dataArray[] = $j;
            }
            unset($d);
           // $dataArray[] = $a['propnames'];
        }

        //去重
        $dataArray = array_unique($dataArray);
        $category = $this->GetGoodsAttributeCategoty($goods_id);
        $category = array_column($category,"name");
        if(is_array($dataArray)){
            foreach ($dataArray as $d => $a){
                if(!in_array($a,$category)){
                    //如果没有在数组中则插入
                    $InsertArray[] = array(
                        "name" => $a
                    );
                }
            }
            //print_r($InsertArray);die;
            //插入
            if(!empty($InsertArray)){
                $result =  Db::table("yx_goods_attribute_category")->insertAll($InsertArray);
                if(empty($result))
                    return 0;
                else{
                    $result = Db::table("yx_goods_attribute_category")->where("name","in",$dataArray)->select();
                    return $result;
                }
            }
        }
        //return $dataArray;
    }
    /***
     *获取当前商品一级分类
     * @param goods_id
     **/
    protected function GetGoodsAttributeCategoty($goods_id){
//        $assesment = $this->GetGoodsAssesment($goods_id);
//        $attrIds = array_column($assesment,"atr_id");
//        $category = Db::table("yx_goods_attribute_category")->where("id","in",$attrIds)->select();
        $category = Db::table("yx_goods_attribute_category")->select();
        return $category;
    }
    /***
     *获取当前商品所有一级分类
     * @param goods_id
     **/
    protected function GetGoodsAttributeAllCategoty($goods_id){
        $assesment = $this->GetGoodsAssesment($goods_id);
        $attrIds = array_column($assesment,"atr_id");
        $category = Db::table("yx_goods_attribute_category")->where("id","in",$attrIds)->select();
        return $category;
    }

    /***
     *获取一级分类与二级属性全部
     * @param category 一级分类
     **/
    protected function GetAllAttribute($category = []){
        $a = new Attribute();
        $CateIds = array_column($category,"id");
        $Attribute = Db::table("yx_goods_attribute")->where("c_id",'in',$CateIds)->select();
        //组成数组
        foreach ($category as $a => $b){
            $category[$a]['attribute'] = [];
            foreach ($Attribute as $c => $d){
                if($d['c_id'] == $b["id"]){
                    $category[$a]['attribute'][] = $d;
                }
            }
        }
        //dump($category);die;
        return $category;
    }
    /**
     *插入二级属性
     * @param category 当前一级分类全部属性
     * @param shuxing
     **/
    protected function InsertAttribute($category = [],
                                      $shuxing = ''){
        //dump($category);die;
        $s = [];
        $data = [];
        $status = 0;
        $c_id = 0;
        $a = new Attribute();
        $shuxin = json_decode($shuxing,true);
        //判断
        foreach ($shuxin as $a => $b){
            //分类
            //print_r($b['propnames']);die;
            $propnames = explode(";",$b['propnames']);
            //$propnamesIds =
            //属性
            $propvalnames = explode(";",$b['propvalnames']);
            foreach ($propvalnames as $c => $d){
                //属性分类判断
                if(is_array($category)){
                    //修改情况
                    foreach ($category as $e => $f){
                        if ($f['name'] == $propnames[$c]){
                            $c_id = $f['id'];
                            //属性分类相同判断属性相同
                            foreach ($f['attribute'] as $g => $h){
                                if($h['name'] == $propvalnames[$c]){
                                    //属性相同
                                    $status ++;
                                }
                            }
                            if ($status == 0){
                                //插入
                                $data[] = array(
                                    "c_id" => $c_id,
                                    "name" => $propvalnames[$c]
                                );
                            }else{
                                $status = 0;
                                $c_id = 0;
                            }
                        }
                    }
                }else{

                }

            }
        }
        //dump($data);die;
        for($i = 0; $i < sizeof($data); $i ++){
            $s[] = json_encode($data[$i]);
        }
        $data = array_merge(array_unique($s));
        //dump($data);die;
        for($i = 0; $i < sizeof($data); $i ++){
            $data[$i] = json_decode($data[$i],true);
        }
      //  dump($data);die;
        if(!empty($data)){
           // print_r($data);die;
           $r = Db::table("yx_goods_attribute")->insertAll($data);
        }
    }

    /**
     *插入或修改assessment
     * @param category 一二级全部
     * @param shuxing 属性
     * @param goods_id 商品id
     **/
    protected function InsertOrUpdateAssesment($shuxing = '',
                                               $goods_id = '',
                                               $array = []){
        $AssmentModel=new Assessment();
        //插入数组
        $dataInsert = [];
        //更新数组
        $dataUpdate = [];
        $nowAssesment = $this->GetGoodsAssesment($goods_id);
       // dump($nowAssesment);die;
        //属性转换为数组
        //$array = $this->AttributeStr2Array($shuxing);
        $a = new Assessment();
        //更新
        if(is_array($nowAssesment)){
            foreach ($nowAssesment as $a => $b){
                foreach ($array as $c => $d){
                    if($b['atr_id'] == $d['atr_id']){
                        //分类id相同
                        $i = json_encode($d['attribute']);
                        if($i != $b['ids']){
                            //更新内容
                            $r = json_encode(array_unique(array_merge($d['attribute'],json_decode($b['ids'],true))));
                            $dataUpdate[] = array(
                                'id' => $b['id'],
                                'ids' => $r
                            );
                            unset($r);
                        }
                    }
                }
            }
            if(!empty($dataUpdate)){
                //更新
                $AssmentModel->saveAll($dataUpdate);
            }
        }

        //新增
        foreach ($array as $a => $b) {
            $status = 0;
            foreach ($nowAssesment as $c => $d) {
                if($b['atr_id'] == $d['atr_id']){
                    $status++;
                }
            }
            if($status == 0){
                //新增
                $dataInsert[] = array(
                    'g_id' => $goods_id,
                    'atr_id' => $b['atr_id'],
                    'ids' => json_encode($b['attribute'])
                );
            }
        }
        //dump($dataInsert);die;
        if(!empty($dataInsert)){
            Db::table("yx_goods_assessment")->insertAll($dataInsert);
        }
    }
    /**
     *属性字符串转换数组
     * @param shuxing
     **/
    protected function AttributeStr2Array($shuxing){
        $Category = [];
        $Attribute = [];
        $Array = [];
        $data = [];
        $ds = [];
        $attrArry=[];
        $shuxing = json_decode($shuxing,true);
        foreach ($shuxing as $a => $b){
            $Category = array_merge($Category,explode(";",$b['propnames']));
            $Attribute = array_merge($Attribute,explode(";",$b['propvalnames']));
        }

        //转换id
//        dump($Category);
        $Array = Db::table("yx_goods_attribute_category")->where("name","in",$Category)->select();
        //顺序要与传来的顺序一致
        foreach ($Category as $k=>$v){
            foreach ($Array as $key=>$val){
                if($v==$val['name']){
                    $attrArry[]=$val['id'];
                }
            }

        }
        //去重
        $attrArry=array_unique($attrArry);
//        dump($attrArry);
//        die();
        $ArrayAttr = Db::table("yx_goods_attribute")->where("name",'in',$Attribute)->select();

        //$Array = $this->Array2Ids($Category ,$Attribute , 0);
      //  $Attribute = $this->Array2Ids($Category ,$Attribute , 1);
        //数组去重
//        foreach ($Category as $a => $b){
//            foreach ($b as $c => $d){
//                $Array[] = $d;
//            }
//        }
//        $Array = array_unique($Array);
        //组成数组
        foreach($attrArry as $a => $b){
            foreach ($ArrayAttr as $c => $d ){
                if($b == $d['c_id']){
                    //$Array[$a]["attribute"] = $Attribute[$c];
                    $ds[] = $d["id"];
                }
            }
            $data[] = array(
                'atr_id' => $b,
                'attribute' => $ds
            );
            unset($ds);
        }
//        dump($data);die;

        return $data;
}

 /***
  *数组转换为id
  * @param Category 分类
  * @param Attribute 属性
  * @param status 0分类 1属性
  **/
 protected function Array2Ids($category = [],$attribute = [], $status = 0){
     if($status == 0){
         //分类
         $cIds = Db::table("yx_goods_attribute_category")->where('name','in',$category)->field('id')->select();
         $cIds =array_column($cIds,"id");
     }else{
         //属性
         $cIds = Db::table("yx_goods_attribute")->where('name','in',$attribute)->field('id')->select();
         $cIds =array_column($cIds,"id");
     }
     return $cIds;
 }

 /**
  *插入价格表
  * @param shuxing
  * @param goods_id
  **/
 protected function InsertPrice($shuxing = '',$goods_id = 0,$image=''){
     //删除原先价格
     $a = new AssessmentPrice();
     //插入数组
     $InsertData = [];
     $dc = [];
     $Attribute = [];
     $shuxing = json_decode($shuxing,true);
     foreach ($shuxing as $a => $b){
         $Attribute = array_merge($Attribute,explode(";",$b['propvalnames']));
     }
     $Attribute = array_unique($Attribute);
     $field = [
         "a.id",
         "a.c_id",
        "a.name" => "attr",
         "b.name" => "cate"
     ];
     $Attribute = Db::table("yx_goods_attribute")->alias("a")->join("yx_goods_attribute_category b",'a.c_id=b.id')->field($field)->where("a.name",'in',$Attribute)->select();

    // $Attribute = $this->Array2Ids($Attribute ,$Attribute , 1);
     foreach ($shuxing as $a => $b){
         //传入的属性值
         $b['propvalnames'] = explode(";",$b['propvalnames']);
        // dump( $b['propvalnames']);
         $b['propnames'] = explode(";",$b['propnames']);
        // dump( $b['propnames']);
         if(is_array($b['propvalnames'])){
             foreach ($b['propvalnames'] as $c => $d){
                 foreach ($Attribute as $e => $f){
                     if($f['attr'] == $d && $f['cate'] == $b['propnames'][$c]){
                         $dc[] = $f['id'];
                     }
                 }
             }
             $InsertData[] = array(
                 "g_id" => $goods_id,
                 'ids' => json_encode($dc),
                 'price' => (isset($b['price']) && !empty($b['price']))?$b['price'] : 1,
                 'num' => $b['num'],
                 'sell_num' => (isset($b['sell_num']) && !empty($b['sell_num']))?$b['sell_num'] : 1,
                 'general_price' => (isset($b['general_price']) && !empty($b['general_price']))?$b['general_price'] : 1,
                 'cost_price' => (isset($b['cost_price']) && !empty($b['cost_price']))?$b['cost_price'] : 1,
                 'director_price' => (isset($b['director_price']) && !empty($b['director_price']))?$b['director_price'] : 1,
                 'two_agent' => $b['two_agent'],
                 'three_agent' => $b['three_agent'],
                 'manager' => $b['manager'],
                 'img' => (empty($b['proImg']) || $b['proImg']=='' || !isset($b['proImg']) || $b['proImg']=='undefined')?$image : $b['proImg']
             );
         }
         unset($dc);
     }
//     dump($InsertData);
//     die;
     if(!empty($InsertData)){
         //删除
//         $a->where("g_id",$goods_id)->update(['is_delete'=>1]);
         //插入
         Db::table('yx_goods_assessment_price')->insertAll($InsertData);
     }
 }






































//    修改商品页面删除属性操作
    public function delatr($id){
        ini_set('max_execution_time','0');
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
        $data=$mentprice->where('id',$id)->update(['is_delete'=>1,'num'=>0]);
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
            ->where('g.id',$goods_id)->field('g.*,c.name as cate_name')->find();
        $coupons=Db::table('yx_coupon')->where('id',$info['coupon_id'])
            ->where('num','>',0)
            ->where('is_delete',2)
            ->where('end','<',time())
            ->where('is_putaway',1)
            ->field('name,id')
            ->find();
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
        $attr=$this->goods_assess($goods_id);
//        dump($attr);
//        die();
//        return json($info);
        $coupon=new Coupon();
        $res=$coupon->where('type',1)
            ->where('num','>',0)
            ->where('is_delete',2)
            ->where('is_putaway',1)
            ->select();
        foreach ($res as $keys=>$vals){
            if ($vals['status']==1){
                if(time()>$vals['end']){
                    unset($res[$keys]);
                }
            }
        }
        $pro=$this->province($goods_id);
        $this->assign('pnames',$pnames);
        $this->assign('coupons',$coupons);
        $this->assign('cate',$first);
        $this->assign('coupon',$res);
        $this->assign('province',$pro['province']);
        $this->assign('haves',$pro['goods_province']);
        $this->assign('attr',$attr);
        $this->assign('freights',$freights);
        $this->assign('info',$info);
        $this->assign('images',$images);
        return $this->fetch();
    }
    //修改操作
    public function edits(){
        $data=input('post.');
//        dump($data);
//        die();
        //更新商品信息
        $good=new Goods();
        $shops=$good->where('goods_number',$data['goods_number'])->find();
//        if(!empty($shops) && $shops['id']!=$data['goods_id']){
//            $this->error('已有此商品编码的商品！');
//        }
        if(empty($data['startTime'])){
            $goods['start_time']=time();
            $goods['end_time']=strtotime($data['endTime']);
        }elseif (!empty($data['startTime']) && empty($data['endTime'])){
            $goods['start_time']=strtotime($data['startTime']);
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
            $goods['cordon']=(isset($data['cordon']) && !empty($data['cordon']))?$data['cordon'] : 1;
            $goods['name']=$data['name'];
            $goods['describe']=$data['describe'];
            $goods['is_return']=$data['is_return'];
            $goods['classify_id']=$data['classify_id'];
            $goods['goods_price']=(isset($data['goods_price']) && !empty($data['goods_price']))?$data['goods_price'] : 1;
            $goods['original_price']=(isset($data['original_price']) && !empty($data['original_price']))?$data['original_price'] : 1;
            $goods['limit_num']=(isset($data['limit_num']) && !empty($data['limit_num']))?$data['limit_num'] : 0;
            $goods['goods_number']=$data['goods_number'];
            $goods['own_integral']=$data['own_integral'];
            $goods['where_division']=$data['where_division'];
            $goods['is_use_coupon']=$data['is_use_coupon'];
            $goods['coupon_id']=$data['coupon_id'];
            $goods['goods_images']=$data['goods_images'];
            $goods['goods_detail']=$data['goods_detail'];
            $goods['use_type']=$data['use_type'];
            $goods['is_up']=$data['is_up'];
//            $goods['freight']=$data['freight'];
            $goods['is_putaway']=$data['is_putaway'];
            $goods['one_integral']=$data['one_integral'];
            $goods['two_integral']=$data['two_integral'];
            $goods['three_integral']=$data['three_integral'];

            $goods['update_time']=time();
            if(isset($data['freight_pros']) && !empty($data['freight_pros'])){
                //修改运费
                $this->if_pro($data['goods_id'],$data['freight_pros']);
            }else{
                $freight=false;
            }
             //修改属性

            if(isset($data['atr_ids']) && !empty($data['atr_ids'])){
                $atr_ids=$data['atr_ids'];
                $prices=$data['prices'];
                $nums=$data['nums'];
                $cost_prices=$data['cost_prices'];
                $director_prices=$data['director_prices'];
                $general_prices=$data['general_prices'];
                $two_agents=$data['two_agents'];
                $three_agents=$data['three_agents'];
                $setting_imgs=$data['setting_imgs'];
                $sell_nums=$data['sell_nums'];
                $managers=$data['managers'];
                $type=0;
                $this->attrPrice($type,$atr_ids,$cost_prices,$prices,$nums,$director_prices,$general_prices,$two_agents,$three_agents,$sell_nums,$setting_imgs,$managers,$data['goods_id'],$images[0]);
            }
            $attrReturn=1;
//            dump(json_decode($data['testArray']));
//            die();
            if(isset($data['testArray']) && !empty(json_decode($data['testArray']))){
                $testArray=$data['testArray'];
                $attrReturn=$this->goods_attr($data['goods_id'],$testArray,$images[0]);
            }
                $res=$good->where('id',$data['goods_id'])->update($goods);
                $goods_num=Db::table('yx_goods_assessment_price')
                    ->where('g_id',$data['goods_id'])
                    ->where('is_delete',0)
                    ->field('num')
                    ->select();
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
//    修改商品销量
    public function editsale($did){
        $goods=new Goods();
        $list=$goods->where('id',$did)->field('id,sales')->find();
        $this->assign('info',$list);
        return $this->fetch();
    }
    //修改商品销量操作
    public function editsalenum(){
        $data=input('post.');
        $id=$data['did'];
        $sales=$data['sales'];
        $goods=new Goods();
        $res=$goods->where('id',$id)->update(['sales'=>$sales,'update_time'=>time()]);
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }
    }
    //属性价格修改
    public function attrPrice($type,$atr_ids,$cost_prices,$prices,$nums,$director_prices,$general_prices,$two_agents,$three_agents,$sell_nums,$setting_imgs,$managers,$id,$images=''){
        ini_set('max_execution_time','0');
        $atr_ids=json_decode($atr_ids);
        $cost_prices=json_decode($cost_prices);
        $prices=json_decode($prices);
        $nums=json_decode($nums);
        $director_prices=json_decode($director_prices);
        $general_prices=json_decode($general_prices);
        $two_agents=json_decode($two_agents);
        $three_agents=json_decode($three_agents);
        $sell_nums=json_decode($sell_nums);
        $setting_imgs=json_decode($setting_imgs);
        $managers=json_decode($managers);
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
    public function goods_assess($goods_id){
        $price=new AssessmentPrice();
        $attr=new Attribute();
        $ment=new Assessment();
        $attcate=new AttributeCate();
        $allments=Db::table('yx_goods_assessment')->where('g_id',$goods_id)->where('is_delete',0)->field('atr_id,ids')->select();

        if(isset($allments) && !empty($allments)){
            foreach ($allments as $key=>$val){
                $allment=$attcate->where('id',$val['atr_id'])->field('name')->find();
                $ids=json_decode($val['ids'],true);
                $arr=[];
                foreach ($ids as $k=>$v){
                    $name=$attr->where('id',(int)$v)->field('name')->find();
                    $arr[]=$name['name'];
//                    $ids[$k]['name']=$arr;
                }
                $allments[$key]['atrname']=$allment['name'];
                $allments[$key]['name']=$arr;
            }
        }else{
            $allments=[];
        }
//        var_dump($allments);
//        die();
        return $allments;
    }
    //属性信息
    public function assess($goods_id){
        //属性id数组
        $dataIds = [];
        $dataAttr = [];
        ini_set('max_execution_time','0');
        $price=new AssessmentPrice();
        $attr=new Attribute();
        $prices=Db::table("yx_goods_assessment_price")->where('g_id',(int)$goods_id)->where('is_delete',0)->select();//价格表

        foreach ($prices as $k=>$v){
            $ids=json_decode($v['ids']);
            foreach ($ids as $k2){
                //组装属性id
                $dataIds[] = $k2;
//                $arr1=$attr->where('id',(int)$k2)->field('name')->find();//属性名
//                $arr[]=$arr1['name'];
            }
//            $prices[$k]['ments']=implode(',',$arr);
//            unset($arr);
        }
        //获取属性
        $dataIds = array_unique($dataIds);
        $attributes = Db::table("yx_goods_attribute")->where("id","in",$dataIds)->select();
        //组装属性
        foreach ($prices as $k=>$v) {
            $dataIds  =json_decode($v['ids']);
            foreach ($dataIds as $d => $a) {
                foreach ($attributes as $ar => $tr) {
                    if ($a == $tr['id']) {
                        $prices[$k]['ments'][] = $tr['name'];
                    }
                }
            }
            unset($dataIds);
        }
      //  dump($prices);die;
        $gment['prices']=$prices;
        return json(['code'=>1,'data'=>$gment]);
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