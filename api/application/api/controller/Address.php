<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use app\api\model\Address as Address_model;
/**
 * 地址接口
 */
class Address extends controller
{


    /**
     * 添加地址
     * 
     */
    public function add_address(){
       $data = input();
       $res = Address_model::add_address($data);
       if($res == 1){
          return json_encode(['code'=>1,'msg'=>'添加地址成功！']);
       }else if($res == 2){
          return json_encode(['code'=>2,'msg'=>'服务器异常！']);
       }else if($res == 3){
          return json_encode(['code'=>3,'msg'=>'编辑地址成功！']);
       }
    }

    // /**
    //  *
    //  * 修改默认地址
    //  */
    // public function default_address($id = 0){
    //    $res = Address_model::default_address($id);
    //    if($res == 1){
    //       return json_encode(['code'=>1,'msg'=>'设置默认地址成功！']);
    //    }else if($res == 2){
    //       return json_encode(['code'=>2,'msg'=>'服务器异常！']);
    //    }else if($res == 2){
    //       return json_encode(['code'=>3,'msg'=>'取消默认地址成功！']);
    //    }
    // }

    /**
     *地址列表
     * 
     */
    public function address_list($id = 0){
       $data = Address_model::address_list($id);
       if($data){
          return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询地址列表成功！']);
       }else{
          return json_encode(['code'=>2,'msg'=>'目前没有添加地址！']);
       }
    }


    /**
     *
     * 删除地址
     */
    public function del_address($id = 0){
       $res = Address_model::del_address($id);
       if($res == 1){
          return json_encode(['code'=>1,'msg'=>'删除地址成功！']);
       }else{
          return json_encode(['code'=>2,'msg'=>'服务器异常！']);
       }
    }

}
