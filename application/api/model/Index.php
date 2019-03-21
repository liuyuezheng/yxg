<?php
	
namespace app\api\model;

use think\Model;
use think\Db;
header("Content-type: text/html; charset=utf-8"); 
class Index extends Model{
    /**
     *轮播图列表
     * 
     */
    public static function 	slideshow_list(){
       $where = [
           'status'=>1
       ];
       $field = [
           'id,slideshow,goods_id,link,type'
       ];
       $data = Db::table('yx_describe')->field($field)->where($where)->select();
       return $data;
    }

    /**
     *首页昨日爆款商品
     * 
     */
    public static function yesterday_goods(){
    	$where = [
           'where_division'=>0,
           'is_putaway'=>0
    	];
        $field = [
           'id,logo_image,name,goods_price,original_price'
        ];
    	$data = Db::table('yx_goods')->field($field)->where($where)->limit(6)->select();
    	return $data;
    }

    /**
     *首页今日主推商品
     * 
     */
    public static function today_goods(){
    	$where = [
           'where_division'=>1,
           'is_putaway'=>0
    	];
      $field = 'id,logo_image,name,describe,goods_price,original_price';
    	$data = Db::table('yx_goods')->field($field)->where($where)->limit(3)->select();
    	return $data;
    }

     /**
      *查询商品一级分类
      * 
      */
     public static function first_classify(){
     	$where = [
            'pid'=>0
     	];
     	$field = [
            'id,name'
     	];
        $data = Db::table('yx_goods_category')->field($field)->where($where)->select();
        return $data;
     }

     /**
      *查询商品一级分类的商品
      * 
      */
     public static function goods_classify($id = 0){
     	$where = [
            'pid'=>$id
     	];
        $classify_id = Db::table('yx_goods_category')->field('id')->where($where)->select();
        $field =  'id,logo_image,name,describe,goods_price,original_price';
        $ids = '';
        foreach ($classify_id as $k => $v) {
           $ids .= $v['id'].',';
        }
        $ids = rtrim($ids,',');
        $where = [
            'classify_id'=>['in',$ids]
        ];
        $data = Db::table('yx_goods')->where($where)->field($field)->select();
        return $data;  
     }

     /**
      *昨日爆款和今日主推商品列表
      * 
      */
     public static function goods_list($classify_id = 0,$type = 0,$page = 1){

     	  $num = 10;
     	  $start = ($page - 1) * $num;
     	  $where = [
            'pid'=>$classify_id
     	  ];
     	  $classify_id = Db::table('yx_goods_category')->field('id')->where($where)->select();
     	  $field = [
             'id,logo_image,name,goods_price,original_price'
          ];
          $ids = '';
     	  foreach ($classify_id as $k => $v){
              $ids .= $v['id'].',';
     	  }
     	  $ids = rtrim($ids,',');
 	  	  $where = [
    	    'classify_id'=>['in',$ids],
          'where_division'=>$type,
          'is_putaway'=>0
       ];
       $join = [
          ['yx_orders_detail yod','yo.id = yod.order_id']
       ];
     	  $data['data'] = Db::table('yx_goods')->field($field)->where($where)->limit($start,$num)->select();
        $data['count'] = Db::table('yx_goods')->field($field)->where($where)->count();
     	  foreach ($data['data'] as $k => $v) {
     	  	  $where = [
                  'yod.goods_id'=>$v['id'],
     	  	  ];
     	      $data['data'][$k]['yesterday_count'] = Db::table('yx_orders')->alias('yo')->join($join)->where($where)->count();
     	  }  
     	  return $data;
     }

     /**
      *搜索商品列表
      * 
      */
     public static function goods_search($id = 0,$keywords = '',$type = 0,$page = 1){
     	  $num = 10;
     	  $start = ($page - 1) * $num;
     	  $field = [
             'id,logo_image,name,goods_price,original_price'
          ];
        $order = [];
        if($type == 1){
           $order = ['create_time desc'];
        }else if($type == 4){
           $order = ['goods_price desc'];
        }else if($type == 5){
           $order = ['goods_price asc'];
        }
        $where = [];
          if($keywords != ''){
          	 $list = [
          	     'user_id'=>$id,
                 'search'=>$keywords,
          	 ];
          	 if(!Db::table('yx_hotsearch')->where($list)->find()){
          	 	 Db::table('yx_hotsearch')->insert($list);
          	 }
          	
          	 $where['name'] = ['like',"%{$keywords}%"];
             $where['is_putaway'] = 0;
          }
          $join = [
             ['yx_orders_detail yod','yo.id = yod.order_id']
          ];
           //dump($where);die;
     	  $data['data'] = Db::table('yx_goods')->field($field)->where($where)->limit($start,$num)->order($order)->select();
        $data['count'] = Db::table('yx_goods')->field($field)->where($where)->order($order)->count();
     	  foreach ($data['data'] as $k => $v) {
     	  	  $where = [
                  'yod.goods_id'=>$v['id'],
     	  	  ];
     	      $data['data'][$k]['yesterday_count'] = Db::table('yx_orders')->alias('yo')->join($join)->where($where)->count();
     	  }  
        foreach ($data['data'] as $k => $v) {
           $arr[$k] = $v['yesterday_count'];
        }

        if($type == 2){
          array_multisort($arr,SORT_DESC,$data['data']);
        }else if($type == 3){
          array_multisort($arr,SORT_ASC,$data['data']);
        }
     	  return $data;
     }

     /**
      *查询商品二级分类
      * 
      */
     public static function second_classify($id = 0){
        $where = [
            'pid'=>$id
        ];
        $field = [
           'id,cover,name'
        ];
        $data = Db::table('yx_goods_category')->field($field)->where($where)->select();
        return $data;
     }

     /**
      *根据二级分类查询商品
      * 
      */
     public static function second_goods($id = 0,$page = 1){
     	  $num = 10;
     	  $start = ($page - 1) * $num;
     	 $where = [
            'classify_id'=>$id,
            'is_putaway'=>0
     	 ];
     	 $field = [
             'id,logo_image,name,goods_price,original_price'
          ];
         $data['data'] = Db::table('yx_goods')->field($field)->where($where)->limit($start,$num)->select();
         $data['count'] = Db::table('yx_goods')->field($field)->where($where)->count();
          $join = [
             ['yx_orders_detail yod','yo.id = yod.order_id']
          ];
         foreach ($data['data'] as $k => $v) {
     	  	  $where = [
                  'yod.goods_id'=>$v['id'],
     	  	  ];
     	      $data['data'][$k]['yesterday_count'] = Db::table('yx_orders')->alias('yo')->join($join)->where($where)->count();
     	  }  
     	  return $data;
     }

     /**
      *热门搜索
      * 
      */
     public static function hot_search(){
     	$data = Db::table('yx_hotsearch')->field('search,count(search) as count')->group('search')->limit(6)->order('count desc')->select();
        return $data;
     }

    
    /**
     *商品的详情
     * 
     */
    public static function goods_detail($id = 0,$goods_id = 0){
    	$where = [
             'yg.id'=>$goods_id,
    	];
    	$field = 'yg.id,yg.goods_images,yg.goods_price,yg.original_price,yg.own_integral,yg.freight,yg.name,
      yg.describe,yg.goods_detail,yg.start_time,yg.end_time,ygap.sell_num,yg.sales';
      $join = [
          ['yx_goods_assessment_price ygap','ygap.g_id = yg.id']
      ];
    	$data = Db::table('yx_goods')->alias('yg')->join($join)->field($field)->where($where)->find();
      $data['diff_time'] = $data['end_time'] - $data['start_time'];
    	$data['goods_images'] = explode(',',$data['goods_images']);
      if($id == 0){
        $data['is_jump'] = 0;
      }else{
        $data['is_jump'] = 1;
      }
      $data['new_time'] = time();
    	$attribute = Db::table('yx_goods_assessment_price')->where('g_id',$data['id'])->find();
    	$data['num'] = $attribute['num'];
    	//$data['selected_goods'] = 
    	$where = [
            'yo.goods_id'=>$data['id']
    	];
      $join111 = [
            ['yx_goods yg','yg.id = yo.goods_id'],['yx_user yu','yu.id = yo.user_id']
      ];
    	$data['opinion_count'] = Db::table('yx_opinion')->alias('yo')->join($join111)->where($where)->count();
    	$data['collected_count'] = Db::table('yx_collected')->where('goods_id',$data['id'])->count();
    	$join = [
            ['yx_user yu','yo.user_id = yu.id'],['yx_orders_detail yod','yod.id = yo.sun_order_id']
    	];
    	$field = [
            'yu.nickname,yu.head_image,yo.content,yo.images,yo.goods_intro,yod.goods_specification'
    	];
    	$data['opinion_content'] = 	Db::table('yx_opinion')->alias('yo')->field($field)->join($join)->where($where)->limit(2)->select();
    	foreach ($data['opinion_content'] as $k => $v) {
    		 $data['opinion_content'][$k]['images'] = explode(',', $v['images']);
    	}
       
    	$where = [
            'user_id'=>$id,
            'goods_id'=>$goods_id
    	];
    	if(Db::table('yx_collected')->where($where)->find()){
    		$data['is_collected'] = 1;
    	}else{
    		$data['is_collected'] = 0;
    	}
        return $data;
    }

    /**
     *收藏商品和取消收藏商品
     * 
     */
    public static function goods_collected($id = 0,$goods_id = 0){
    	$data = [
           'user_id'=>$id,
           'goods_id'=>$goods_id   
    	];
    	if(Db::table('yx_collected')->where($data)->find()){
             if(Db::table('yx_collected')->where($data)->delete() === false){
    			return 2;
    		}else{
    			return 3;
    		}
    	}else{
    		$data['time'] = time();
    		if(Db::table('yx_collected')->insert($data) === false){
    			return 2;
    		}else{
    			return 1;
    		}
    	}   
    }

    /**
     *商品的规格属性
     * 
     */
    public static function goods_attribute($id = 0){
    	 $where = [
             'yga.g_id'=>$id
    	 ];
    	 $join = [
             ['yx_goods_attribute_category ygac','yga.atr_id = ygac.id']
    	 ];
    	 $field = [
             'ygac.name,yga.ids'
    	 ];
         $data['assessment'] = Db::table('yx_goods_assessment')->alias('yga')->join($join)->field($field)
         ->where($where)->select();
         foreach ($data['assessment'] as $k => $v) {
         	$ids = json_decode($v['ids']);
         	foreach ($ids as $key => $value) {
         		$data['assessment'][$k]['attribute'][] = Db::table('yx_goods_attribute')->field('name')->where('id',$value)->find();
         	}
         	 
         }
         $field = [
             'id,g_id,ids,price,num,img,sell_num'
         ];	
         $data['assessment_detail'] = Db::table('yx_goods_assessment_price')->field($field)->where('g_id',$id)->select();
         foreach ($data['assessment_detail'] as $k => $v) {
         	 $ids = json_decode($v['ids']);
	         foreach ($ids as $key => $value) {
	            $data['assessment_detail'][$k]['assessment_detail'][] = Db::table('yx_goods_attribute')->field('name')
	            ->where('id',$value)->find();
	         }
         }
         foreach ($data['assessment_detail'] as $k => $v) {
           $guige_detail = '';
          foreach ($v['assessment_detail'] as $key => $value) {
              $guige_detail .= $value['name'].',';
          }
           $guige_detail = rtrim($guige_detail,',');
           $data['assessment_detail'][$k]['assessment_detail'] = $guige_detail;

      }
          return $data;
         //dump($data);die;
    }

    /**
     *商品的全部评价列表
     * 
     */
    public static function goods_opinion($id = 0,$page = 1){
      $num = 10;
      $start = ($page - 1) * $num;
    	$where = [
            'yo.goods_id'=>$id
    	];
    	$join = [
           ['yx_user yu','yo.user_id = yu.id'],
           ['yx_goods yg','yg.id = yo.goods_id'],
           ['yx_orders_detail yod','yod.id = yo.sun_order_id']
    	];
    	$field = [
           'yo.id,yu.nickname,yu.head_image,yo.logistics_server,yo.seller_server,yo.goods_intro,yo.content,
           yo.images,yg.name,yod.goods_specification,yo.time'
        ];
        $opinion = Db::table('yx_opinion')->alias('yo')->join($join)->field($field)->where($where)->order('yo.time desc')
        ->count();
    	$data['goods_opinion'] = Db::table('yx_opinion')->alias('yo')->join($join)->field($field)->where($where)->order('yo.time desc')->limit($start,$num)->select();
      $data['total_row'] = Db::table('yx_opinion')->alias('yo')->join($join)->field($field)->where($where)->order('yo.time desc')->count();
    	$logistics_server = 0;
    	$seller_server = 0;
    	$goods_intro = 0;
        foreach ($data['goods_opinion'] as $k => $v) {
        	$data['goods_opinion'][$k]['images'] = explode(',',$v['images']);
        	$data['goods_opinion'][$k]['time'] = date("Y-m-d",$v['time']);
            $logistics_server += $v['logistics_server'];
            $seller_server += $v['seller_server'];
            $goods_intro += $v['goods_intro'];
        }
        if(!empty($data['goods_opinion'])){
          $data['logistics_server'] = round($logistics_server/$opinion,1);
          $data['seller_server'] = round($seller_server/$opinion,1);
          $data['goods_intro'] = round($goods_intro/$opinion,1);
        }else{
          $data['logistics_server'] = 0;
          $data['seller_server'] = 0;
          $data['goods_intro'] = 0;
        }
        return $data;
    }

}
