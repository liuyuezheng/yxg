<?php
namespace app\index\controller;

use app\index\model\PkUser;
//use function Sodium\crypto_aead_aes256gcm_is_available;
use app\index\model\User;
use app\index\model\UserLink;
use app\index\validate\PkUserVal;
use think\Controller;
use think\Db;

class Test extends Controller
{
    //所有用户关系链条插入
    public function inlink(){
       $user=new User();
       $users=$user->field('id,grade,pid')->select();
       $userLink=new UserLink();
       foreach ($users as $k=>$v){
           if($v['pid']==0){
               $link['user_id']=$v['id'];
               $link['link_id']=$v['id'];
               if($v['grade']==0){
                   $link['link_grade']='普通用户';
               }elseif ($v['grade']==1){
                   $link['link_grade']='总代';
               }else{
                   $link['link_grade']='董事';
               }
//               $link['pid']=0;
           }else{
               $userLinks=$userLink->where('user_id',$v['pid'])->find();
               $link['user_id']=$v['id'];
               $link_id=$v['id'].','.$userLinks['link_id'];
               $link['link_id']=rtrim($link_id, ',');
               if($v['grade']==0){
                   $link_grade='普通用户'.','.$userLinks['link_grade'];
               }elseif ($v['grade']==1){
                   $link_grade='总代'.','.$userLinks['link_grade'];
               }else{
                   $link_grade='董事'.','.$userLinks['link_grade'];
               }
               $link['link_grade']=rtrim($link_grade, ',');
//               $link['pid']=$v['pid'];
           }
           $userLink->insert($link);
       }
    }
    //用户更换身份传用户id 以及身份type 0普通用户 1总代 2董事
    public function upuser($id,$type){
         $user=new User();
         $link=new UserLink();
         $res=Db::table('yx_user_link')->whereOr('link_id','like','%,'.$id.',%')
             ->whereOr('link_id','like',$id.',%')
             ->whereOr('link_id','like','%,'.$id)
             ->whereOr('link_id',(string)$id)
             ->select();
        //用户更换身份传用户id 以及身份type 0普通用户 1总代 2董事
            foreach ($res as $k=>$v){
                $linkId=explode(',',$v['link_id']);
                $linkGrade=explode(',',$v['link_grade']);
                $array=array_flip($linkId);
                $key=$array[$id];
              if($type==1){
                  $linkGrade[$key]='总代';
              }elseif($type==2){
                  $linkGrade[$key]='董事';
              }else{
                  $linkGrade[$key]='普通用户';
              }

                $res[$k]['link_grade']= implode(',',$linkGrade);
            }
        $up=$link->isUpdate()->saveAll($res);
    }
    //更改关系
    public function uplink($id=212,$pid=201){
        $user=new User();
        $link=new UserLink();
        $res=Db::table('yx_user_link')->whereOr('link_id','like','%,'.$id.',%')
            ->whereOr('link_id','like',$id.',%')
            ->whereOr('link_id','like','%,'.$id)
            ->whereOr('link_id',(string)$id)
//            ->fetchSql()
            ->select();

        $pidlink=$link->where('user_id',$pid)->field('link_id,link_grade')->find();
        foreach ($res as $k=>$v){
            $linkId=explode(',',$v['link_id']);
            $linkGrade=explode(',',$v['link_grade']);
            $array=array_flip($linkId);
            $key=$array[$id];
            for($i=$key+1;$i<count($linkId);$i++){
                unset($linkId[$i]);
                unset($linkGrade[$i]);
            }

            $res[$k]['link_grade']= implode(',',$linkGrade).','.$pidlink['link_grade'];
            $res[$k]['link_id']= implode(',',$linkId).','.$pidlink['link_id'];
        }
        var_dump($res);
//        var_dump($res);
        exit();
        $link->isUpdate()->saveAll($res);
//        var_dump($res);
    }
    //董事
   public function test(){
        $arr=[];
       $link=new UserLink();
        for($i=0;$i<50000;$i++){
           $arr[$i]['user_id']=rand(100,1000);
           $arr[$i]['link_id']=$arr[$i]['user_id'];
           $arr[$i]['link_grade']='董事';
        }
//        var_dump($arr);
       $link->insertAll($arr);
   }
   //总代
    public function ztest(){
        $arr=[];
        $link=new UserLink();
        $where = [
            'link_grade'=>'董事'
        ];
        $data = $link->where($where)->limit(0,1000)->field('user_id')->select();
//        dump($data);exit;
        foreach ($data as $k=>$v){
            unset($arr);
            for($i=0;$i<50000;$i++){
                $arr[$i]['user_id']=rand(100,1000);
                $arr[$i]['link_id']=$arr[$i]['user_id'].','.$v['user_id'];
                $arr[$i]['link_grade']='总代,董事';
            }
            $link->insertAll($arr);
        }

//        var_dump($arr);exit;
    }


}


