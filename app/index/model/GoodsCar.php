<?php 
namespace app\index\Model;
use think\Model;
/**
 * 购物车表
 */
class GoodsCar extends Model
{
	//关联商品主图表
    public function productMsg()
	{
		return $this->belongsTo('ProductMsg','product_id','product_id'); 
	}

}
?>