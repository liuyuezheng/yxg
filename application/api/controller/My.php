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
use app\api\model\My as my_model;
class My extends Controller{
     /**
      *个人中心个人信息
      * 
      */
     public function personalinfo($id = 0){
         $data = my_model::personalinfo($id);
         if($data){
            return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询个人信息成功！']);
         }else{
            return json_encode(['code'=>2,'msg'=>'服务器异常！']);
         }
       }

       /**
        *我的收藏列表
        * 
        */
       public function my_collect($id = 0,$page = 1){
           $data = my_model::my_collect($id,$page);
           if($data){
              return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询我的收藏成功！']);
           }else{
              return json_encode(['code'=>2,'msg'=>'目前没有收藏！']);
           }
       }

       /**
        *我的优惠券
        * 
        */
       public function my_coupon($id = 0,$type = 0){
           $data = my_model::my_coupon($id,$type);
           if($data){
              return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询我的优惠券成功！']);
           }else{
              return json_encode(['code'=>2,'msg'=>'目前没有优惠券！']);
           }
       }

      /**
       *我的积分明细
       * 
       */
      public static function integral_detail($id = 0){
           $data = my_model::integral_detail($id);
           if($data){
              return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询我的积分明细成功！']);
           }else{
              return json_encode(['code'=>2,'msg'=>'目前没有积分明细！']);
           }
      }

       /**
        *用户提现
        * 
        */
       public function withdraw_deposit(){
           $data = input();
           $res = my_model::withdraw_deposit($data);
           if($res == 1){
              return json_encode(['code'=>1,'msg'=>'提现申请成功！']);
           }else{
              return json_encode(['code'=>2,'msg'=>'服务器异常！！']);
           }
       }
        /**
         *用户取消提现
         *
         */
       public function withdraw_cancel($id=0){
           $res = my_model::withdraw_cancel($id);
           if($res == 1){
               return json_encode(['code'=>1,'msg'=>'提现取消成功！']);
           }else{
               return json_encode(['code'=>2,'msg'=>'服务器异常！！']);
           }
       }
       /**
        *用户提现进度
        * type 1余额 2佣金
        */
       public function withdraw_deposit_list($id = 0,$type=1){
           $data = my_model::withdraw_deposit_list($id,$type);
           if($data){
              return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询我的提现进度成功！']);
           }else{
              return json_encode(['code'=>2,'msg'=>'目前没有提现申请！']);
           }
       }
        /**
         *用户账单明细
         * id 用户id
         */
        public function withdraw_deposit_lists($id = 0,$page=1){
            $data = my_model::withdraw_deposit_lists($id,$page);
            if($data){
                return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询我的账单明细成功！']);
            }else{
                return json_encode(['code'=>2,'msg'=>'目前没有账单！']);
            }
        }

    /**
     *佣金明细
     * 
     */
    public  function brokerage_detail($id = 0,$type = 0,$page = 1){
         $data = my_model::brokerage_detail($id,$type,$page);
         if($data){
            return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询我的佣金明细成功！']);
         }else{
            return json_encode(['code'=>2,'msg'=>'目前没有佣金明细！']);
         }      
    }

    /**
     *我的分销商/我的会员
     * 
     */
    public function my_distributor($id = 0,$type = 0){
         $data = my_model::my_distributor($id,$type);
         if($data){
            return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询我的分销商成功！']);
         }else{
            return json_encode(['code'=>2,'msg'=>'目前没有分销商！']);
         }
    } 

    /**
     *分销订单明细
     * 
     */
     public function distributor_detail_list($id = 0){
         $data = my_model::distributor_detail_list($id);
         if($data){
            return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询我的分销订单成功！']);
         }else{
            return json_encode(['code'=>2,'msg'=>'目前没有分销订单！']);
         }
     }

    /**
     *佣金收入排行榜
     * 
     */
    public function  brokerage_ranking($page = 1){

         $data = my_model::brokerage_ranking($page);
         if($data){
            return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询佣金收入排行榜成功！']);
         }else{
            return json_encode(['code'=>2,'msg'=>'目前没有佣金收入排行榜！']);
         }
     }

     /**
     *个人销量排行榜
     * 
     */
    public  function sales_ranking($page = 1){
         $data = my_model::sales_ranking($page);
         if($data){
            return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询个人销量排行榜成功！']);
         }else{
            return json_encode(['code'=>2,'msg'=>'目前没有个人销量排行榜！']);
         }
    }

    /**
     *团队业绩排行榜
     * 
     */
    public function achievememt_ranking($page = 1){
         $data = my_model::achievememt_ranking($page);
         if($data){
            return json_encode(['code'=>1,'data'=>$data,'msg'=>'查询团队业绩排行榜成功！']);
         }else{
            return json_encode(['code'=>2,'msg'=>'目前没有团队业绩排行榜！']);
         }
    }

     //图片上传
    public function uploadSxImg(){
           $file = request()->file('file');

        if ($file == '') {
            return '';
        }
        $info = $file->move(ROOT_PATH . 'public' . DS . 'Uploads');
        if ($info) {
            $filePath = DS . 'Uploads' . DS . $info->getSaveName();
            $route = $_SERVER['DOCUMENT_ROOT'] . $filePath;
            $filePaths = uploadOss1($route);
            unset($info);
            $imgurl = str_replace("\\", "/", $filePath);
            $imgurl = ltrim($imgurl, '/');
            unlink($imgurl);
            //dump($filePaths);die;
            return json_encode(['code'=>1,'data'=>'https://chyxg.oss-cn-zhangjiakou.aliyuncs.com/'.$filePaths,'msg'=>'上传图片成功！']);
        } else {
            return json_encode(['code'=>1,'msg'=>'服务器异常！']);
        }
    }  

}