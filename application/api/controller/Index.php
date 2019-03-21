<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/29
 * Time: 10:31
 */
namespace app\api\controller;
use think\Controller;
use think\Db;
use app\api\model\Index as index_model;
class Index extends Controller{
    /**
     *轮播图列表
     * 
     */
     public function slideshow_list(){
        $data = index_model::slideshow_list();
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询轮播图成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有轮播图！']);
        }
     }

     /**
      *首页昨日爆款商品
      * 
      */
     public function yesterday_goods(){
        $data = index_model::yesterday_goods();
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询爆款商品成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有爆款商品！']);
        }
     }

     /**
      *首页今日主推商品
      * 
      */
     public function today_goods(){
        $data = index_model::today_goods();
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询主推商品成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有主推商品！']);
        }
     }

     /**
      *查询商品一级分类
      * 
      */
     public function first_classify(){
        $data = index_model::first_classify();
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询一级分类成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有一级分类！']);
        }
     }

     /**
      *查询商品一级分类的商品
      * 
      */
     public function goods_classify($id = 0){
        $data = index_model::goods_classify($id);
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询商品信息成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有商品信息！']);
        }
     }

     /**
      *昨日爆款和今日主推商品列表
      * 
      */
     public function goods_list($classify_id = 0,$type = 0,$page = 1){
        $data = index_model::goods_list($classify_id,$type,$page);
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询商品信息成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有商品信息！']);
        }
     }

     /**
      *搜索商品列表
      * 
      */
     public function goods_search($id = 0,$keywords = '',$type = 0,$page = 1){
        $data = index_model::goods_search($id,$keywords,$type,$page);
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询商品信息成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有商品信息！']);
        }
     }

     /**
      *查询商品二级分类
      * 
      */
     public function second_classify($id = 0){
        $data = index_model::second_classify($id);
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询二级分类成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有二级分类商品！']);
        }
     }

     /**
      *根据二级分类查询商品
      * 
      */
     public function second_goods($id = 0,$page = 1){
         $data = index_model::second_goods($id,$page);
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询二级分类商品成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有二级分类商品！']);
        }
     }

     /**
      *热门搜索
      * 
      */
     public function hot_search(){
        $data = index_model::hot_search();
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询热门搜索成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有热门搜索！']);
        }
     }

     /**
     *商品的详情
     * 
     */
    public function goods_detail($id = 0,$goods_id = 0){
        $data = index_model::goods_detail($id,$goods_id);
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询商品详情成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有商品详情！']);
        }
    }

    /**
     *收藏商品和取消收藏商品
     * 
     */
    public function goods_collected($id = 0,$goods_id = 0){
        $res = index_model::goods_collected($id,$goods_id);
        if($res == 1){
           return json_encode(['code'=>1,'msg'=>'收藏商品成功！']); 
        }else if($res == 2){
           return json_encode(['code'=>2,'msg'=>'服务器异常！']);
        }else if($res == 3){
           return json_encode(['code'=>3,'msg'=>'取消收藏商品成功！']);
        }
    }

     /**
     *商品的规格属性
     * 
     */
    public function goods_attribute($id = 0){
        $data = index_model::goods_attribute($id);
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询商品规格属性成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有商品规格属性！']);
        }
    }

    /**
     *商品的全部评价列表
     * 
     */
    public function goods_opinion($id = 0,$page = 1){
       $data = index_model::goods_opinion($id,$page);
        if($data){
           return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询商品评论列表成功！']);
        }else{
           return json_encode(['code'=>2,'msg'=>'目前没有商品评论！']);
        }
    }
    
}