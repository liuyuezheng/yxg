<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/23
 * Time: 14:39
 */

namespace app\api\controller;


use think\Controller;
use think\Db;

class Wxshare extends Controller
{
    /**
     * 生成图片
     * @return type
     */
    public function index($g_id=0,$uid=0) {
//        $id = 7;
        $info = Db::table('yx_goods')->where('id',$g_id)->field('name,logo_image,goods_price')->find();
        //数据格式
        $gData = [
            'pic' => $info['logo_image'],
            'title' =>substr($info['name'],0,32)."...",
            'price' => $info['goods_price'],
        ];
        //二维码生成
        $url = 'https://yxg.mumarenkj.com/dist/index.html?id='.$g_id.','.$uid;

        $qr_code = $this->good_qrcode($url);
        $pic='upload/share'.time().'.png';
        //输出到图片
//        return(createSharePng($gData,$qr_code,'share.png'));
        $res=createSharePng($gData,$qr_code,$pic);
        if($res){
            return json_encode(['code'=>1,'data'=>$res,'msg'=>'生成分享二维码成功']);
        }else{
            return json_encode(['code'=>2,'msg'=>'生成分享二维码失败']);
        }
    }
    /**
     * 生成二维码
     */
    public function good_qrcode($url)
    {
//       $auto_increment_id = input('auto_increment_id');
        Vendor('PHPQRcode.phpqrcode');
        $object = new \QRcode();

        // 链接地址
//         $url = $_SERVER['SERVER_NAME']. '/public/index.php/wap/Share/index.html?mobile=' . $auto_increment_id;
//        $url = $url;
        // 容错级别
        $errorCorrectionLevel = intval(3);
        // 生成图片大小
        $matrixPointSize = intval(6);
        // 生成二维码图片
        $path = ROOT_PATH . 'public/upload/share';
        $fileName = $path . '/share'.time().'.png';
        $qrcode = $object->png($url, $fileName, $errorCorrectionLevel, $matrixPointSize);
        return $fileName;
    }
   /**
     * [getXcxCode 获取微信小程序二维码]
     * @return [type] [小程序二维码图片]
     */
    public function getXcxCode() {
        //获取参数值
        $kid = input('scene');
        $page = input('page');
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $this->_getAccessToken();
        $data = [
            'scene' => $kid,
            'width' => 100,
            'path'  => $page,
            'auto_color' => false,
        ];
        $data = json_encode($data);
        $result = $this->_requestPost($url, $data);
        if (!$result) {
            return false;
        }
        $fileName = time();
        //判断file文件中是否存在数据库当中
        file_put_contents("./Uploads/temporary/" . $fileName . ".png", $result);
        return "/Uploads/temporary/" . $fileName . ".png";
    }

    /**
     * 获取 access_tonken
     * @param string $token_file 用来存储token的临时文件
     */
    private function _getAccessToken($token_file = './access_token') {
        // 考虑过期问题，将获取的access_token存储到某个文件中
        $life_time = 7200;
        if (file_exists($token_file) && time() - filemtime($token_file) < $life_time) {
            // 存在有效的access_token
            return file_get_contents($token_file);
        }
        // 目标URL：
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx19f9b6be4310ebb1&secret=ccd3ecb49812f58f894b04a31e47214a";
        //向该URL，发送GET请求
        $result = $this->_requestGet($url);
        if (!$result) {
            return false;
        }
        // 存在返回响应结果
        $result_obj = json_decode($result);
        // 写入
        file_put_contents($token_file, $result_obj->access_token);
        return $result_obj->access_token;
    }
    /**
     * 发送GET请求的方法
     * @param string $url URL
     * @param bool $ssl 是否为https协议
     * @return string 响应主体Content
     */
    protected function _requestGet($url, $ssl = true) {
        // curl完成
        $curl = curl_init();
        //设置curl选项
        curl_setopt($curl, CURLOPT_URL, $url); //URL
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '
Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0 FirePHP/0.7.4';
        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent); //user_agent，请求代理信息
        curl_setopt($curl, CURLOPT_AUTOREFERER, true); //referer头，请求来源
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); //设置超时时间
        //SSL相关
        if ($ssl) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //禁用后cURL将终止从服务端进行验证
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); //检查服务器SSL证书中是否存在一个公用名(common name)。
        }
        curl_setopt($curl, CURLOPT_HEADER, false); //是否处理响应头
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //curl_exec()是否返回响应结果
        // 发出请求
        $response = curl_exec($curl);
        if (false === $response) {
            echo '<br>', curl_error($curl), '<br>';
            return false;
        }
        curl_close($curl);
        return $response;
    }
    /**
     * 发送GET请求的方法
     * @param string $url URL
     * @param bool $ssl 是否为https协议
     * @return string 响应主体Content
     */
    protected function _requestPost($url, $data, $ssl = true) {
        //curl完成
        $curl = curl_init();
        //设置curl选项
        curl_setopt($curl, CURLOPT_URL, $url); //URL
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '
    Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0 FirePHP/0.7.4';
        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent); //user_agent，请求代理信息
        curl_setopt($curl, CURLOPT_AUTOREFERER, true); //referer头，请求来源
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); //设置超时时间
        //SSL相关
        if ($ssl) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //禁用后cURL将终止从服务端进行验证
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); //检查服务器SSL证书中是否存在一个公用名(common name)。
        }
        // 处理post相关选项
        curl_setopt($curl, CURLOPT_POST, true); // 是否为POST请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // 处理请求数据
        // 处理响应结果
        curl_setopt($curl, CURLOPT_HEADER, false); //是否处理响应头
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //curl_exec()是否返回响应结果
        // 发出请求
        $response = curl_exec($curl);
        if (false === $response) {
            echo '<br>', curl_error($curl), '<br>';
            return false;
        }
        curl_close($curl);
        return $response;
    }

}