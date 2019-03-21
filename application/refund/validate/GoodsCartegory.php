<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 11:25
 */

namespace app\index\validate;


use think\Validate;

class GoodsCartegory extends Validate
{
    protected  $rule = [
        'sort'   => 'require|number',//手机号
        'plate' => ['regex'=>'/[京津沪渝冀豫云辽黑湘皖鲁新苏浙赣鄂桂甘晋蒙陕吉闽贵粤青藏川宁琼使领A-Z]{1}[A-Z]{1}[A-Z0-9]{4}[A-Z0-9挂学警港澳]{1}/'],//车牌号
    ];
    protected  $msg = [
        'sort.require' => '排序必须填写',
        'sort.number'     => '排序格式有误',
        'plate'   => '车牌号有误',
    ];
}