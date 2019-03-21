<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/2
 * Time: 10:00
 */

namespace app\index\controller;


use app\index\model\GoodsCategory;
use think\Controller;

class Category extends Base
{
    //商品分类列表
   public function index(){
       return $this->fetch();
   }
   public function lists(){

       $data = GoodsCategory::order('sort')->select();
       $res['code']=1;
       $res['data']=$data;
       return json($res);
   }
//   增加栏目页面
    public function add(){

        $data = GoodsCategory::where('pid',0)->select();
//        $res['code']=0;
//        $res['data']=$data;
        $this->assign('data',$data);
        return $this->fetch();
    }
    //   增加栏目
    public function adds(){
          $arr['sort']=input('sort/d');
        $arr['name']=input('name/s');
        $arr['cover']=input('pic/s');
        $arr['pid']=input('pid/d');
        $arr['create_time']=time();
        $arr['update_time']=time();
        $data = GoodsCategory::insert($arr);
        if($data){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }
    }
    //修改页面
    public function edit($id){

        $data = GoodsCategory::where('id',$id)->find();
        $this->assign('data',$data);
        return $this->fetch();
    }
    //修改操作
    public function edits(){
        $id=input('id/d');
        $arr['sort']=input('sort/d');
        $arr['name']=input('name/s');
        $arr['cover']=input('pic/s');
        $arr['update_time']=time();
        $cate=new GoodsCategory();
        $res=$cate->where('id',$id)->update($arr);
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }
    }
    //删除操作
    public function del(){
        $id=input('id/d');
        $cate=new GoodsCategory();
        $res=$cate->where('id',$id)->delete();
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }
    }

}