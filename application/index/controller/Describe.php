<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/29
 * Time: 11:14
 */

namespace app\index\controller;


use app\index\model\Goods;
use app\index\model\GoodsCategory;
use think\Db;

class Describe extends Base
{
    //轮播图管理
    public function index(){
        $describe=new \app\index\model\Describe();
        $res=$describe->order('id desc')->paginate(10,false,['query' => $this->request->get()]);
        $page = $res->render();
        $this->assign('page',$page);
        $this->assign('data',$res);
        return $this->fetch();
    }

    //添加轮播图页面
    public function add(){
        $first=$this->first();
        $this->assign('first',$first);
        return $this->fetch();
    }

    //添加操作
    public function adds(){
        $arr['goods_id']=input('goods_id/d');
        $arr['describe']=input('describe/s');
        $arr['slideshow']=input('pic/s');
        $arr['link']=input('link/s');
        if(empty($arr['link'])){
            $arr['type']=1;
        }
        if(empty($arr['goods_id'])){
            $arr['type']=0;
        }
        if(!empty($arr['goods_id']) && !empty($arr['link'])){
            $arr['type']=1;
        }
        $arr['create_time']=time();
        $arr['updated_time']=time();
        $describe=new \app\index\model\Describe();
        $data = $describe->insert($arr);
        if($data){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }
    }

    //一级分类
    public function first(){
        $cate=new GoodsCategory();
        $first=$cate->where('pid',0)->order('sort,id')->select();
        return $first;
    }

    //二级分类
    public function second($cate_id){
        $cate=new GoodsCategory();
        $second=$cate->where('pid',$cate_id)->order('sort,id')->select();
        return $second;
    }

    //商品(添加)
    public function goods($goods){
        $where['name']=['like','%'.$goods.'%'];
        $where['is_delete']=2;
        $where['is_putaway']=0;
        $good=new Goods();
        $data=$good->where($where)->field('id,name,goods_price,goods_number')->select();
       return json(['code'=>1,'data'=>$data,'msg'=>'成功']);
    }
    //商品(修改)
    public function goods2($goods,$goods_id){
        $where['name']=['like','%'.$goods.'%'];
        $where['is_delete']=2;
        $where['is_putaway']=0;
        $where['id']=['neq',$goods_id];
        $good=new Goods();
        $data=$good->where($where)->field('id,name,goods_price,goods_number')->select();
        return json(['code'=>1,'data'=>$data,'msg'=>'成功']);
    }
    //改变轮播图状态
    public function upstatus($id,$status){
        if($status==0){
            $status1=1;
        }else{
            $status1=0;
        }
        $res['status']=$status1;
        $res['updated_time']=time();
        $describe=new \app\index\model\Describe();
        $data=$describe->where('id',$id)->update($res);
        if($data){
            return 1;
        }else{
            return 0;
        }
    }

    //删除操作
    public function del($id){
        $describe=new \app\index\model\Describe();
        $data=$describe->where('id',$id)->delete();
        if($data){
            return 1;
        }else{
            return 0;
        }
    }

    //编辑页面
    public function edit($did){

        $describe=new \app\index\model\Describe();
        $goods=new Goods();
        $first=$this->first();
        $this->assign('first',$first);
        $data = $describe->where('id',(int)$did)
            ->find();

        if($data['goods_id']!=0){
            $name=$goods->where('id',$data['goods_id'])->where('is_delete',2)->field('name,goods_number,goods_price')->find();
            if(!empty($name)){
                $data['name']=$name['name'];
                $data['goods_number']=$name['goods_number'];
                $data['goods_price']=$name['goods_price'];
            }else{
                $data['goods_id']=0;
                $data['name']='选择商品';
            }


        }else{
            $data['name']='选择商品';
        }

        $this->assign('data',$data);
        return $this->fetch();
    }

    //修改操作
    public function edits(){
        $id=input('did/d');
        $arr['goods_id']=input('goods_id/d');
        $arr['describe']=input('describe/s');
        $arr['slideshow']=input('pic/s');
        $arr['link']=input('link/s');
        if(empty($arr['link'])){
            $arr['type']=1;
        }
        if(empty($arr['goods_id'])){
            $arr['type']=0;
        }
        if(!empty($arr['goods_id']) && !empty($arr['link'])){
            $arr['type']=1;
        }
        $arr['updated_time']=time();
        $describe=new \app\index\model\Describe();
        $data = $describe->where('id',$id)->update($arr);
        if($data){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }
//        return $arr;
    }

}