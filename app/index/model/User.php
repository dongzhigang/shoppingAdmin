<?php 
namespace app\index\Model;
use think\Model;
/**
 * 用户表
 */
class User extends Model
{
	public function getImgUrlAttr($value)
	{
		$val = 'shoppingAdmin/'.$value;
		return $val;
	}
}
?>