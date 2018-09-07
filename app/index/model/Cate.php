<?php 
namespace app\index\Model;
use think\Model;
/**
 * 商品一级分类表
 */
class Cate extends Model
{
	public function getIconAttr($value)
	{
		$val = 'shoppingAdmin/'.$value;
		return $val;
	}	
	public function getImgAttr($value)
	{
		$val = 'shoppingAdmin/'.$value;
		return $val;
	}	
	//关联二级分类表
    public function sort()
	{
		return $this->belongsTo('Sort','Cate_id','id')->bind('Sort_name,id'); 				//('关联模型名','外键名','主键名',['模型别名定义'])
	}
}
?>