<?php 
namespace app\index\Model;
use think\Model;
/**
 * 商品信息表
 */
class ProductMsg extends Model
{
	public function getImgAttr($value)
	{
		$val = 'shoppingAdmin/'.$value;
		return $val;
	}
	//关联商品主图表
    public function productMaster()
	{
		return $this->belongsTo('ProductMaster','product_id','product_id')->bind('path_img'); 
	}
	//关联品牌表
    public function brand()
	{
		return $this->belongsTo('Brand','brand_id','id')->bind('brand_name'); //注意，此处的外键是Product表的外键字段名、('关联模型名','外键名','主键名',['模型别名定义'])
	}
	//关联属性表
    public function property()
	{
		return $this->belongsTo('Property','product_id','product_id')->bind('value'); 
	}
	//关联商品参数表
    public function parameter()
	{
		return $this->belongsTo('Parameter','product_id','product_id')->bind('value'); 
	}
	//关联商品一级分类表
    public function cate()
	{
		return $this->belongsTo('Cate','Cate_id','Cate_id')->bind('Cate_name'); 
	}
	//关联商品二级分类表
    public function sort()
	{
		return $this->belongsTo('Sort','Sort_id','Sort_id')->bind('Sort_name'); 
	}
	//关联评论表
    public function comment()
	{
		return $this->belongsTo('Comment','product_id','product_id')->bind('content'); 
	}
}
?>