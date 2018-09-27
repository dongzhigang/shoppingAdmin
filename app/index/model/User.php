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
		if($value){
			$value = 'shoppingAdmin/'.$value;
		}
		return $value;
	}
	public function getNickNameAttr($value)
	{
		if(!$value){
			$value = '游客';
		}
		return $value;
	}
}
?>