<?php 
namespace app\index\Model;
use think\Model;
/**
 * 收藏表
 */
class Collect extends Model
{
	//关联商品表
    public function product()
	{
		return $this->belongsTo('ProductMsg','product_id','product_id'); 
	}
}
?>