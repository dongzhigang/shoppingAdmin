<?php 
namespace app\admin\Model;
use think\Model;
/**
 * 商品信息表
 */
class ProductMsg extends Model
{
	//关联商品主图表
    public function Master()
	{
		return $this->hasMany('ProductMaster','product_id','product_id'); 
	}
	//关联商品详情表
    public function Contents()
	{
		return $this->belongsTo('Contents','product_id','product_id'); 
	}
	//关联商品详情图表
    public function ContentsImg()
	{
		return $this->hasMany('ContentsImg','product_id','product_id'); 
	}
	//关联属性、属性值、商品关联表
    public function Property()
	{
		return $this->hasMany('Property','product_id','product_id'); 
	}
	//关联规格/属性表
    public function names()
	{
		return $this->hasMany('PropertyName','product_id','product_id'); 
	}
	//规格/属性表
 //    public function Value()
	// {
	// 	return $this->hasMany('PropertyValue','name_id','name_id'); 
	// }
	//关联库存表
    public function sku()
	{
		return $this->hasMany('ProductSku','product_id','product_id'); 
	}
	//关联商品参数表
    public function parameter()
	{
		return $this->hasMany('Parameter','product_id','product_id'); 
	}
	//关联商品一级分类表
    public function cate()
	{
		return $this->belongsTo('Cate','Cate_id','Cate_id'); 
	}
	//关联商品二级分类表
    public function sort()
	{
		return $this->belongsTo('Sort','Sort_id','Sort_id'); 
	}
}
?>