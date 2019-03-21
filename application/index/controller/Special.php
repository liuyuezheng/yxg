<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/9
 * Time: 9:31
 */

namespace app\index\controller;


use app\index\model\Goods;
use think\Controller;

class Special extends Base
{
    //商品专场
    public function index(){
        return $this->fetch();
    }
    //爆款商品
    public function hots(){
        $goods=new Goods();
        $list=$goods->alias('g')
            ->join('yx_goods_category c','g.classify_id=c.id')
            ->where('where_division',0)
            ->order('g.id desc')
            ->field('g.*,c.name as cate_name')
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$list->render();
        $this->assign('page',$page);
        $this->assign('data',$list);
        return $this->fetch();
    }
    //主推商品
    public function mains(){
        $goods=new Goods();
        $list=$goods->alias('g')
            ->join('yx_goods_category c','g.classify_id=c.id')
            ->where('where_division',1)
            ->order('g.id desc')
            ->field('g.*,c.name as cate_name')
            ->paginate(10,false,['query' => $this->request->get()]);
        $page=$list->render();
        $this->assign('page',$page);
        $this->assign('data',$list);
        return $this->fetch();
    }
    //取消
    public function cancel($id){
        $goods=new Goods();
        $data=$goods->where('id',$id)->update(['where_division'=>2,'update_time'=>time()]);
        if($data){
            return 1;
        }else{
            return 0;
        }
    }
    //批量取消
    public function allCancel($id){
        $goods=new Goods();
        foreach ($id as $k){
            $res=$goods->where('id',$k)->update(['where_division'=>2,'update_time'=>time()]);
        }
        if($res){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }
    }
}