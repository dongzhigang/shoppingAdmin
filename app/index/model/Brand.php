<?php 
namespace app\index\Model;
use think\Model;
/**
 * 品牌表
 */
class Brand extends Model
{
	public function getImgAttr($value)
	{
		$val = 'shoppingAdmin/'.$value;
		return $val;
	}	
}
?>