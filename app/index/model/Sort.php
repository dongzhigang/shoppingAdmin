<?php 
namespace app\index\Model;
use think\Model;
/**
 * 商品二级分类表
 */
class Sort extends Model
{
	public function getImgAttr($value)
	{
		$val = 'shoppingAdmin/'.$value;
		return $val;
	}	
}
?>