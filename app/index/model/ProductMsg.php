<?php 
namespace app\index\Model;
use think\Model;
/**
 * 商品信息表
 */
class ProductMsg extends Model
{
	
	//关联品牌表
    public function brand()
	{
		return $this->belongsTo('Brand','id','brand_id')->bind('brand_name'); //注意，此处的外键是Product表的外键字段名
	}
}
?>