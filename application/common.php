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
function exportExcel($title = array(), $data = array(), $fileName = '', $savePath = './uploads/emport/', $isDown = true) {
    vendor('Classes.PHPExcel');
    $obj = new PHPExcel();
    //横向单元格标识
    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
    $fileName.="_" . date("Y_m_d", \think\Request::instance()->time());
    $obj->getActiveSheet(0)->setTitle($fileName);   //设置sheet名称
    $_row = 1;   //设置纵向单元格标识
    if ($title) {
        $_cnt = count($title);
        $obj->getActiveSheet(0)->mergeCells('A' . $_row . ':' . $cellName[$_cnt - 1] . $_row);   //合并单元格
        $obj->setActiveSheetIndex(0)->setCellValue('A' . $_row, '数据导出：' . date('Y-m-d H:i:s'));  //设置合并后的单元格内容
        $_row++;
        $i = 0;
        foreach ($title AS $v) {   //设置列标题
            $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i] . $_row, $v);
            $i++;
        }
        $_row++;
    }
    //填写数据
    if ($data) {
        $i = 0;
        foreach ($data AS $_v) {
            $j = 0;
            foreach ($_v AS $_cell) {
                $_cell .= ' ';
                $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + $_row), $_cell);
                $j++;
            }
            $i++;
        }
    }
    //文件名处理
    if (!$fileName) {
        $fileName = uniqid(time(), true);
    }
    $objWrite = new \PHPExcel_Writer_Excel5($obj);
    if ($isDown) {   //网页下载
        header('pragma:public');
        header("Content-Disposition:attachment;filename=$fileName.xls");
        $objWrite->save('php://output');
        exit;
    }
    //保存
    $order = date('Y-m-d', time());
    $_fileName = iconv("utf-8", "gb2312", $fileName);   //转码
    $savePath = $savePath . $order . '/';
    if (!file_exists($savePath)) {
        mkdir($savePath, 0777, true);
    }
    $_savePath = $savePath . $_fileName . '.xlsx';
    $objWrite->save($_savePath);
    return $savePath . $fileName . '.xlsx';
}
/**
 * 分享图片生成
 * @param $gData  商品数据，array
 * @param $codeName 二维码图片
 * @param $fileName string 保存文件名,默认空则直接输入图片
 */
function createSharePng($gData, $codeName, $fileName = '') {
    //创建画布
    $im = imagecreatetruecolor(618, 1000);
    //填充画布背景色
    $color = imagecolorallocate($im, 255, 255, 255);
    imagefill($im, 0, 0, $color);
    //字体文件
    $font_file = "code_png/MSYH.TTF";
    $font_file_bold = "code_png/msyh_bold.ttf";
    //设定字体的颜色
    $font_color_1 = ImageColorAllocate($im, 140, 140, 140);
    $font_color_2 = ImageColorAllocate($im, 28, 28, 28);
    $font_color_3 = ImageColorAllocate($im, 129, 129, 129);
    $font_color_red = ImageColorAllocate($im, 217, 45, 32);
    $fang_bg_color = ImageColorAllocate($im, 254, 216, 217);
    //Logo
    list($l_w, $l_h) = getimagesize("code_png/timg.gif");
    $logoImg = createImageFromFile("code_png/timg.gif");
    imagecopyresized($im, $logoImg, 274, 28, 0, 0, 70, 70, $l_w, $l_h);
    //温馨提示
    imagettftext($im, 14, 0, 100, 130, $font_color_1, $font_file, '温馨提示：喜欢长按图片识别二维码即可前往购买');
    //商品图片
    list($g_w, $g_h) = getimagesize($gData['pic']);
    $goodImg = createImageFromFile($gData['pic']);
    imagecopyresized($im, $goodImg, 0, 185, 0, 0, 618, 618, $g_w, $g_h);
    //二维码
    list($code_w, $code_h) = getimagesize($codeName);
    $codeImg = createImageFromFile($codeName);
    imagecopyresized($im, $codeImg, 440, 820, 0, 0, 170, 170, $code_w, $code_h);
    //商品描述
    $theTitle = cn_row_substr($gData['title'], 2, 19);
    imagettftext($im, 30, 0, 8, 845, $font_color_2, $font_file, $theTitle[1]);
    imagettftext($im, 30, 0, 8, 875, $font_color_2, $font_file, $theTitle[2]);
    imagettftext($im, 30, 0, 8, 935, $font_color_2, $font_file, "现价￥");
    imagettftext($im, 28, 0, 150, 935, $font_color_red, $font_file, $gData["price"]);
    //输出图片
    ob_clean ();
    Header("Content-Type: image/png");
    if ($fileName) {
        imagepng($im, $fileName);
    } else {
        imagepng($im);
    }
    //释放空间
    imagedestroy($im);
    imagedestroy($goodImg);
    imagedestroy($codeImg);
    return  'https://yxg.mumarenkj.com/' . $fileName;
}

/**
 * 从图片文件创建Image资源
 * @param $file 图片文件，支持url
 * @return bool|resource    成功返回图片image资源，失败返回false
 */
function createImageFromFile($file) {
    if (preg_match('/http(s)?:\/\//', $file)) {
        $fileSuffix = getNetworkImgType($file);
    } else {
        $fileSuffix = pathinfo($file, PATHINFO_EXTENSION);
    }
    if (!$fileSuffix)
        return false;
    switch ($fileSuffix) {
        case 'jpeg':
            $theImage = @imagecreatefromjpeg($file);
            break;
        case 'jpg':
            $theImage = @imagecreatefromjpeg($file);
            break;
        case 'png':
            $theImage = @imagecreatefrompng($file);
            break;
        case 'gif':
            $theImage = @imagecreatefromgif($file);
            break;
        default:
            $theImage = @imagecreatefromstring(file_get_contents($file));
            break;
    }
    return $theImage;
}

/**
 * 获取网络图片类型
 * @param $url  网络图片url,支持不带后缀名url
 * @return bool
 */
function getNetworkImgType($url) {
    $ch = curl_init(); //初始化curl
    curl_setopt($ch, CURLOPT_URL, $url); //设置需要获取的URL
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3); //设置超时
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //支持https
    curl_exec($ch); //执行curl会话
    $http_code = curl_getinfo($ch); //获取curl连接资源句柄信息
    curl_close($ch); //关闭资源连接
    if ($http_code['http_code'] == 200) {
        $theImgType = explode('/', $http_code['content_type']);

        if ($theImgType[0] == 'image') {
            return $theImgType[1];
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * 分行连续截取字符串
 * @param $str  需要截取的字符串,UTF-8
 * @param int $row  截取的行数
 * @param int $number   每行截取的字数，中文长度
 * @param bool $suffix  最后行是否添加‘...’后缀
 * @return array    返回数组共$row个元素，下标1到$row
 */
function cn_row_substr($str, $row = 1, $number = 10, $suffix = true) {
    $result = array();
    for ($r = 1; $r <= $row; $r++) {
        $result[$r] = '';
    }
    $str = trim($str);
    if (!$str)
        return $result;
    $theStrlen = strlen($str);
    //每行实际字节长度
    $oneRowNum = $number * 3;
    for ($r = 1; $r <= $row; $r++) {
        if ($r == $row and $theStrlen > $r * $oneRowNum and $suffix) {
            $result[$r] = mg_cn_substr($str, $oneRowNum - 6, ($r - 1) * $oneRowNum) . '...';
        } else {
            $result[$r] = mg_cn_substr($str, $oneRowNum, ($r - 1) * $oneRowNum);
        }
        if ($theStrlen < $r * $oneRowNum)
            break;
    }
    return $result;
}

/**
 * 按字节截取utf-8字符串
 * 识别汉字全角符号，全角中文3个字节，半角英文1个字节
 * @param $str  需要切取的字符串
 * @param $len  截取长度[字节]
 * @param int $start    截取开始位置，默认0
 * @return string
 */
function mg_cn_substr($str, $len, $start = 0) {
    $q_str = '';
    $q_strlen = ($start + $len) > strlen($str) ? strlen($str) : ($start + $len);

    //如果start不为起始位置，若起始位置为乱码就按照UTF-8编码获取新start
    if ($start and json_encode(substr($str, $start, 1)) === false) {
        for ($a = 0; $a < 3; $a++) {
            $new_start = $start + $a;
            $m_str = substr($str, $new_start, 3);
            if (json_encode($m_str) !== false) {
                $start = $new_start;
                break;
            }
        }
    }
    //切取内容
    for ($i = $start; $i < $q_strlen; $i++) {
        //ord()函数取得substr()的第一个字符的ASCII码，如果大于0xa0的话则是中文字符
        if (ord(substr($str, $i, 1)) > 0xa0) {
            $q_str .= substr($str, $i, 3);
            $i += 2;
        } else {
            $q_str .= substr($str, $i, 1);
        }
    }
    return $q_str;
}