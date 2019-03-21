<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\config;
// 应用公共文件
 //上传图片到阿里云
 function upload_oss($char){
        preg_match('/^(data:\s*image\/(\w+);base64,)/', $char, $result);
        $logo = base64_decode(str_replace($result[0], '', $char));
        $imgname = time() . mt_rand(10, 99) . '.' . $result[2];
        $file = $_SERVER['DOCUMENT_ROOT'] . '/Uploads/' . $imgname;
        file_put_contents($file, $logo);
        \think\Loader::import('OSS.Oss', VENDOR_PATH, EXT);
        \think\Loader::import('OSS.OssClient', VENDOR_PATH, EXT);
        \think\Loader::import('OSS.Core.OssUtil', VENDOR_PATH, EXT);
        \think\Loader::import('OSS.Core.MimeTypes', VENDOR_PATH, EXT);
        \think\Loader::import('OSS.Http.RequestCore', VENDOR_PATH, EXT);
        \think\Loader::import('OSS.Http.ResponseCore', VENDOR_PATH, EXT);
        \think\Loader::import('OSS.Http.RequestCore_Exception', VENDOR_PATH, EXT);
        \think\Loader::import('OSS.Result.Result', VENDOR_PATH, EXT);
        \think\Loader::import('OSS.Result.PutSetDeleteResult', VENDOR_PATH, EXT);
        $oss = new \OSS\Oss(\think\Config::get('oss'));

        $config = config('oss');
        $accessKeyId = $config['accessKeyId'];//去阿里云后台获取秘钥
        $accessKeySecret = $config['accessKeySecret'];//去阿里云后台获取秘钥
        $endpoint = $config['endpoint'];//你的阿里云OSS地址
        $ossClient = new \OSS\OssClient($accessKeyId, $accessKeySecret, $endpoint);
        $bucket= $config['bucket'];//oss中的文件上传空间
        // $object = date('Y-m-d').'/'.$info['imgfile']['savename'];//想要保存文件的名称
        $object = $imgname;//想要保存文件的名称
                        
        // $file = './Public/uploads/'.$info['imgfile']['savepath'].$info['imgfile']['savename'];//文件路径，必须是本地的。
        try{
            $ossClient->uploadFile($bucket,$object,$file);
            //dump($ossClient);die;
            //上传成功，自己编码
            unlink($file); //这里可以删除上传到本地的文件\

        } catch(OssException $e) {
            //上传失败，自己编码
            printf($e->getMessage() . "\n");
             return;
        }

        return $imgname;

 }

 /**
 * $route 本地图片路径
 * 上传图片到阿里云
 */
function uploadOss1($route) {
    \think\Loader::import('OSS.Oss', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.OssClient', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Core.OssUtil', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Core.MimeTypes', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Core.OssException', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Http.RequestCore', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Http.ResponseCore', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Http.RequestCore_Exception', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Result.Result', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Result.PutSetDeleteResult', VENDOR_PATH, EXT);
    $oss = new \OSS\Oss(\think\Config::get('oss'));
    $config = config('oss');
    $accessKeyId = $config['accessKeyId']; //去阿里云后台获取秘钥
    $accessKeySecret = $config['accessKeySecret']; //去阿里云后台获取秘钥
    $endpoint = $config['endpoint']; //你的阿里云OSS地址
    $ossClient = new \OSS\OssClient($accessKeyId, $accessKeySecret, $endpoint);
    $bucket = $config['bucket']; //oss中的文件上传空间
    $info2 = explode(".", $route);
    $object =  time() . mt_rand(10, 99) . '.' . end($info2); //想要保存文件的名称
    try {
        $ossClient->uploadFile($bucket, $object, $route);
        //unlink($route); //这里可以删除上传到本地的文件
    } catch (OssException $e) {
        //上传失败，自己编码
        printf($e->getMessage() . "\n");
        return;
    }
    return $object;
}
 function uploadOss($file, $rootpath) {
    $data = [];
    if (count($file) < 1) {
        return ['status' => false, 'msg' => '上传文件不存在！'];
    }
    $savepath = '/' . date('Ymd');
    \think\Loader::import('OSS.Oss', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.OssClient', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Core.OssUtil', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Core.MimeTypes', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Http.RequestCore', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Http.ResponseCore', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Result.Result', VENDOR_PATH, EXT);
    \think\Loader::import('OSS.Result.PutSetDeleteResult', VENDOR_PATH, EXT);

    $oss = new \OSS\Oss(\think\Config::get('oss'));
    //单文件上传
    if (is_object($file)) {
        $file = $file->getInfo();
        //获取文件后缀
        $file['ext'] = pathinfo($file['name'], PATHINFO_EXTENSION);
        /* 检查文件后缀 */
        if (!$oss->checkExt($file['ext'])) return ['status' => false, 'msg' => $oss->getError()];
        /* 检查文件大小 */
        if (!$oss->checkSize($file['size'])) return ['status' => false, 'msg' => $oss->getError()];
        $file['savepath'] = $rootpath . $savepath . '/';
        /* 生成文件名 */
        $file['savename'] = time() . rand(1, 10000) . '.' . $file['ext'];
        /* 上传文件 */
        if (!$oss->save($file)) return ['status' => false, 'msg' => $oss->getError()];

        $data = ['savepath' => $file['savepath'] . $file['savename'], 'savename' => $file['savename']];

    } else if (is_array($file)) {

        //多文件上传
        foreach ($file as $key => $value) {
            $value = $value->getInfo();
            //获取文件后缀
            $value['ext'] = pathinfo($value['name'], PATHINFO_EXTENSION);
            /* 检查文件后缀 */
            if (!$oss->checkExt($value['ext'])) {
                return ['status' => false, 'msg' => $oss->getError()];
            }
            /* 检查文件大小 */
            if (!$oss->checkSize($value['size'])) {
                return ['status' => false, 'msg' => $oss->getError()];
            }
            $value['savepath'] = $rootpath . $savepath . '/';
            /* 生成文件名 */
            $value['savename'] = time() . rand(1, 10000) . '.' . $value['ext'];
            /* 上传文件 */
            if (!$oss->save($value)) {
                return ['status' => false, 'msg' => $oss->getError()];
            }
            $data[$key] = ['savepath' => $value['savepath'], 'savename' => $value['savename'], 'ext' => $value['ext'], 'size' => $value['size'], 'name' => $value['name']];
        }
    }
    return ['status' => true, 'msg' => '', 'data' => $data];
}
 // 按照首字母查询
 function getFirstChart($str){
     if( empty($str) ){
        return '';
     }
    $char=ord($str[0]);
    if( $char >= ord('A') && $char <= ord('z') ){
       return strtoupper($str[0]);
    } 
    $s1=iconv('UTF-8','gb2312',$str);
    $s2=iconv('gb2312','UTF-8',$s1);
    $s=$s2==$str?$s1:$str;
    $asc=ord($s{0})*256+ord($s{1})-65536;
    if($asc>=-20319&&$asc<=-20284) return 'A';
    if($asc>=-20283&&$asc<=-19776) return 'B';
    if($asc>=-19775&&$asc<=-19219) return 'C';
    if($asc>=-19218&&$asc<=-18711) return 'D';
    if($asc>=-18710&&$asc<=-18527) return 'E';
    if($asc>=-18526&&$asc<=-18240) return 'F';
    if($asc>=-18239&&$asc<=-17923) return 'G';
    if($asc>=-17922&&$asc<=-17418) return 'H';
    if($asc>=-17417&&$asc<=-16475) return 'J';
    if($asc>=-16474&&$asc<=-16213) return 'K';
    if($asc>=-16212&&$asc<=-15641) return 'L';
    if($asc>=-15640&&$asc<=-15166) return 'M';
    if($asc>=-15165&&$asc<=-14923) return 'N';
    if($asc>=-14922&&$asc<=-14915) return 'O';
    if($asc>=-14914&&$asc<=-14631) return 'P';
    if($asc>=-14630&&$asc<=-14150) return 'Q';
    if($asc>=-14149&&$asc<=-14091) return 'R';
    if($asc>=-14090&&$asc<=-13319) return 'S';
    if($asc>=-13318&&$asc<=-12839) return 'T';
    if($asc>=-12838&&$asc<=-12557) return 'W';
    if($asc>=-12556&&$asc<=-11848) return 'X';
    if($asc>=-11847&&$asc<=-11056) return 'Y';
    if($asc>=-11055&&$asc<=-10247) return 'Z';
    return null;
}
//个推-透传
function pushMessageToSingles($cid ,$content,$type=0){
        vendor('GETUI_PHP_SDK.phpDemo.toPush');
        $getui = new \toPush;
        $res = $getui->pushMessageToSingle($cid,$content,$type);

        return $res;
}
//计算时间差
function timeago( $ptime ) {
    $etime = time() - $ptime;
    if ($etime < 59) return '刚刚'; 
    $interval = array ( 
        12 * 30 * 24 * 60 * 60 => '年前',// ('.date('Y-m-d', $ptime).')
        30 * 24 * 60 * 60 => '个月前 ',//('.date('Y-m-d', $ptime).')
        7 * 24 * 60 * 60 => '周前 ',//('.date('m-d', $ptime).'),
        24 * 60 * 60 => '天前',
        60 * 60 => '小时前',
        60 => '分钟前',
        1 => '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    }
}
//计算相隔时间
function timeago1( $ptime ) {
    $etime = time() - $ptime;
    $interval = array ( 
          12 * 30 * 24 * 60 * 60 => '年',// ('.date('Y-m-d', $ptime).')
        30 * 24 * 60 * 60 => '个月 ',//('.date('Y-m-d', $ptime).')
        7 * 24 * 60 * 60 => '周 ',//('.date('m-d', $ptime).'),
        24 * 60 * 60 => '天',
        60 * 60 => '小时',
        60 => '分钟',
        1 => '秒'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    }

}

 /**
     *获取两地间的距离
     */
     function getDistance($longitude1, $latitude1, $longitude2, $latitude2, $unit=2, $decimal=2){

          $EARTH_RADIUS = 6370.996; // 地球半径系数
          $PI = 3.1415926;

          $radLat1 = $latitude1 * $PI / 180.0;
          $radLat2 = $latitude2 * $PI / 180.0;

          $radLng1 = $longitude1 * $PI / 180.0;
          $radLng2 = $longitude2 * $PI /180.0;

          $a = $radLat1 - $radLat2;
          $b = $radLng1 - $radLng2;

          $distance = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
          $distance = $distance * $EARTH_RADIUS * 1000;

          if($unit==2){
              $distance = $distance / 1000;
          }

          return round($distance, $decimal);

    }

    function sendGetRequest($url,$headers,$host,$method='GET'){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    return curl_exec($curl);
}