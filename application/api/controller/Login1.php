<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
class Login extends Controller{
     /**
      * 微信小程序授权
      * 
      */
    public function checkUser($nickname='',$headimgurl='',$jscode='',$id = 0){
        $appid = 'wx19f9b6be4310ebb1';
        $appsecret = 'ccd3ecb49812f58f894b04a31e47214a';
        $str  = file_get_contents('https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$appsecret.'&js_code='.$jscode.'&grant_type=authorization_code');
        $userdata = json_decode($str,true);
        dump($userdata);die;
        $userinfo = Db::table('yx_user')->where(['unionID'=>$userdata['unionID']])->find();
        if(empty($userinfo)){
            $data = [
                'unionID'=>$userdata['unionID'],
                'head_image'=>$headimg,
                'nickname'=>$nickname,
                'pid'=>$id,
                'time'=>time()
            ];
            if(Db::table('yx_user')->insert($data)){
                $data =  Db::table('yx_user')->where(['unionID'=>$data['unionID']])->find();
                return json_encode(['data'=>$data,'code'=>1,'msg'=>'返回个人信息成功']);
            }else{
                $this->error('服务器繁忙');
            }
            
        }else{
            Db::table('yx_user')->where(['unionID'=>$userdata['unionID']])->update(['head_image'=>$headimg,'nickname'=>$nickname]);
            return json_encode(['data'=>$userinfo,'code'=>1,'msg'=>'返回个人信息成功']);
        }
    }
    
    /**
     * 公众号授权
     * 
     */
    public function openids($code = '') {
        $appid = "wx474dc15e39abdda7";
        $secret = "61510531b4b31109c43e7e30da881b02";
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=" . $code . "&grant_type=authorization_code";
        $abs = file_get_contents($url);
        $obj = json_decode($abs);
        $openid = $obj->openid;
        $access_token = $obj->access_token;
        $openid = $obj->openid;
        $abs_url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
        $abs_url_data = file_get_contents($abs_url);
        $obj_data = json_decode($abs_url_data);
        return $obj_data;
        // if (isset($obj_data->errcode)) {
        //     return returnjson('0', '', $obj_data->errmsg);
        // }
//        $data['openid'] = $obj_data->unionID;
//        if ($data['openid'] == '') {
//            return json_encode(['code'=>2,'msg'=>'服务器异常！']);
//        }
//        $data['nickname'] = $obj_data->nickname;
//        $data['head_image'] = $obj_data->headimgurl;
//        $info = Db::name('yx_user')->field('id,head_image,nickname,grade')->where(['unionID' => $data['unionID']])->find();
//        if (!empty($info)) {
//            return json_encode(['data'=>$info,'code'=>1,'msg'=>'返回个人信息成功']);
//        } else {
//            $id = Db::name('yx_user')->field('id,head_image,nickname,grade')->insertGetId($data);
//            if ($id) {
//                $info = Db::table('yx_user')->where('id',$id)->find();
//                return json_encode(['data'=>$info,'code'=>1,'msg'=>'返回个人信息成功']);
//            } else {
//                return json_encode(['code'=>2,'msg'=>'服务器异常！']);
//            }
//        }
    }
}
