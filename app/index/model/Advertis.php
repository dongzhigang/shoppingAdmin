<?php 
namespace app\index\Model;
use think\Model;
/**
 * 广告表模型
 */
class Advertis extends Model
{
	public function getImgAttr($value)
	{
		$val = 'shoppingAdmin/'.$value;
		return $val;
	}	
}
?>