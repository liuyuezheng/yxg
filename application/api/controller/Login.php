<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
class Login extends Controller{
     /**
      * 微信小程序授权
      * 
      */
    public function checkuser($nickname='',$headimg='',$jscode='',$id = 0,$encryptedData = '',$iv = ''){
        $appid = 'wx19f9b6be4310ebb1';
        $appsecret = 'ccd3ecb49812f58f894b04a31e47214a';
        $str  = file_get_contents('https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$appsecret.'&js_code='.$jscode.'&grant_type=authorization_code');
        $userdata = json_decode($str,true);
        $session_key = $userdata['session_key'];
        vendor('lib.wxBizDataCrypt');
        $pc = new \WXBizDataCrypt($appid, $session_key);
        $errCode = $pc->decryptData($encryptedData, $iv, $data );
        $userdata = json_decode(rtrim(ltrim($errCode,'"'),'"'),true); 
        $userinfo = Db::table('yx_user')->where(['unionID'=>$userdata['unionId']])->find();
        if(empty($userinfo)){
            $data = [
                'user_num'=> mt_rand(1000,9999).time(),
                'unionID'=>$userdata['unionId'],
                'openID'=>$userdata['openId'],
                'head_image'=>$headimg,
                'nickname'=>$nickname,
                'pid'=>$id,
                'time'=>time()
            ];
            $ids = Db::table('yx_user')->insert($data);
            if($ids){
                $data =  Db::table('yx_user')->where(['unionID'=>$data['unionID']])->find();
                   if($id!=0){
                // 佣金分配查询上级用户信息
                $pid_grade=Db::table('yx_user')->where('id',$id)->field('grade,pid')->find();
                // 上级用户的分配信息
                $pid_res=Db::table('yx_brokerage_allocation')->where('user_id',$id)->find();
                
                if($pid_grade['grade']==0){
                // 上级普通用户一级积分
                   $data['first_intrgral']=$id;
                // 佣金分配信息
                $broker['user_id']=$ids;
                $broker['first_agent']=$pid_res['first_agent'];
                $broker['second_agent']=$pid_res['second_agent'];
                $broker['three_agent']=$pid_res['three_agent'];
                $broker['first_manager']=$pid_res['first_manager'];
                $broker['second_manager']=$pid_res['second_manager'];
                // 上二级用户
                $pid_grade2=Db::table('yx_user')->where('id',$pid_grade['pid'])->field('grade,pid')->find();
                   if($pid_grade2['grade']==0){

                    $data['second_intrgral']=$pid_grade['pid'];
                    // 上三级用户
                     $pid_grade3=Db::table('yx_user')->where('id',$pid_grade2['pid'])->field('grade,pid')->find();
                     if($pid_grade3['grade']==0){
                       $data['second_intrgral']=$pid_grade2['pid'];
                     }
                   }
                }elseif($pid_grade['grade']==1){
                    // 总代
                    $broker['user_id']=$ids;
                    $broker['first_agent']=$id;
                    $broker['second_agent']=$pid_res['first_agent'];
                    $broker['three_agent']=$pid_res['second_agent'];
                    $broker['first_manager']=$pid_res['first_manager'];
                    $broker['second_manager']=$pid_res['second_manager'];
                }else{
                   // 董事
                    $broker['user_id']=$ids;
                    $broker['first_manager']=$id;
                    $broker['second_manager']=$pid_res['first_manager'];
                }
                if(!empty($broker)){
                  Db::table('yx_brokerage_allocation')->insert($broker);
                }
            }
                unset($data['unionID']);
                unset($data['openID']);
                return json_encode(['data'=>$data,'code'=>1,'msg'=>'返回个人信息成功']);
            }else{
                $this->error('服务器繁忙');
            }
            
        }else{
            Db::table('yx_user')->where(['unionID'=>$userdata['unionId']])
            ->update(['head_image'=>$headimg,'nickname'=>$nickname,'openID'=>$userdata['openId']]);
            unset($userdata['unionID']);
            unset($userdata['openID']);
            return json_encode(['data'=>$userinfo,'code'=>1,'msg'=>'返回个人信息成功']);
        }
    }


    
    /**
     * 公众号授权
     * 
     */
    public function openids($code = '',$id = 0) {
        $appid = "wx474dc15e39abdda7";
        $secret = "61510531b4b31109c43e7e30da881b02";
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=" . $code . "&grant_type=authorization_code";
        $abs = file_get_contents($url);
        $obj = json_decode($abs);
//        $openid = $obj->openid;
        $access_token = $obj->access_token;
        $openid = $obj->openid;
        $abs_url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
        $abs_url_data = file_get_contents($abs_url);
        $obj_data = json_decode(rtrim(ltrim($abs_url_data,'"'),'"'),true);

//        return json($obj_data);
        if (isset($obj_data['errcode'])) {
            return json('0', '', $obj_data->errmsg);
        }
        $data['unionID'] = $obj_data['unionid'];
        if ($data['unionID'] == '') {
            return json_encode(['code'=>2,'msg'=>'服务器异常！']);
        }


        $info = Db::name('yx_user')->field('id,head_image,nickname,grade,telephone')->where(['unionID' => $data['unionID']])->find();

        if (!empty($info)) {
            //dump($obj_data);die;
            Db::table('yx_user')->where(['unionID'=>$data['unionID']])
                ->update(['head_image'=>$obj_data['headimgurl'],'nickname'=>$obj_data['nickname'],'openID1'=>$obj_data['openid']]);
            Db::name('yx_user')->field('id,head_image,nickname,grade,telephone')->where(['unionID' => $data['unionID']])->find();
            return json_encode(['data'=>$info,'code'=>1,'msg'=>'返回个人信息成功']);
        } else {
            $data['openID1'] = $obj_data['openid'];
            $data['nickname'] = $obj_data['nickname'];
            $data['head_image'] = $obj_data['headimgurl'];
            $data['user_num']= mt_rand(1000,9999).time();
            $data['pid']= $id;
            $data['time']= time();
            $ids = Db::name('yx_user')->insertGetId($data);
            if ($ids) {
                    if($id!=0){
                // 佣金分配查询上级用户信息
                $pid_grade=Db::table('yx_user')->where('id',$id)->field('grade,pid')->find();
                // 上级用户的分配信息
                $pid_res=Db::table('yx_brokerage_allocation')->where('user_id',$id)->find();
                
                if($pid_grade['grade']==0){
                // 上级普通用户一级积分
                   $data['first_intrgral']=$id;
                // 佣金分配信息
                $broker['user_id']=$ids;
                $broker['first_agent']=$pid_res['first_agent'];
                $broker['second_agent']=$pid_res['second_agent'];
                $broker['three_agent']=$pid_res['three_agent'];
                $broker['first_manager']=$pid_res['first_manager'];
                $broker['second_manager']=$pid_res['second_manager'];
                // 上二级用户
                $pid_grade2=Db::table('yx_user')->where('id',$pid_grade['pid'])->field('grade,pid')->find();
                   if($pid_grade2['grade']==0){

                    $data['second_intrgral']=$pid_grade['pid'];
                    // 上三级用户
                     $pid_grade3=Db::table('yx_user')->where('id',$pid_grade2['pid'])->field('grade,pid')->find();
                     if($pid_grade3['grade']==0){
                       $data['second_intrgral']=$pid_grade2['pid'];
                     }
                   }
                }elseif($pid_grade['grade']==1){
                    // 总代
                    $broker['user_id']=$ids;
                    $broker['first_agent']=$id;
                    $broker['second_agent']=$pid_res['first_agent'];
                    $broker['three_agent']=$pid_res['second_agent'];
                    $broker['first_manager']=$pid_res['first_manager'];
                    $broker['second_manager']=$pid_res['second_manager'];
                }else{
                   // 董事
                    $broker['user_id']=$ids;
                    $broker['first_manager']=$id;
                    $broker['second_manager']=$pid_res['first_manager'];
                }
          
            }else{
                $broker=[];
            }
            if(!empty($broker)){
              Db::table('yx_brokerage_allocation')->insert($broker);
            }
                $info = Db::table('yx_user')->where('id',$ids)->field('id,head_image,nickname,grade,telephone')->find();
                return json_encode(['code'=>1,'data'=>$info,'msg'=>'返回个人信息成功']);
            } else {
                return json_encode(['code'=>2,'msg'=>'服务器异常！']);
            }
        }
    }
}
