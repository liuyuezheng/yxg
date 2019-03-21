<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/7
 * Time: 15:53
 */

namespace app\index\validate;


use think\Validate;

class Goods extends Validate
{/*/(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/*/
    protected $rule = [
        'name' => 'require',
        'classify_id' => 'require',
        'goods_price' => 'float',
        'original_price' => 'float',
        'limit_num' => 'number',
        'own_integral' => 'number',
        'freight' => 'float',
        'one_integral' => 'number',
        'two_integral' => 'number',
        'three_integral' => 'number',
    ];
    protected $message = [
        'name' => '商品名称必填',
        'classify_id' => '分类必选',
        'goods_price' => '价格填写有误',
        'original_price' => '价格填写有误',
        'limit_num' => '限购数量填写有误',
        'own_integral' => '自身所得积分填写有误',
        'freight' => '商品运费格式有误',
        'one_integral' => '积分填写有误',
        'two_integral' => '积分填写有误',
        'three_integral' => '积分填写有误',
    ];

}