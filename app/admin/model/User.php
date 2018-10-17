<?php 
namespace app\admin\Model;
use think\Model;
/**
 * 用户表
 */
class User extends Model
{
	//性别
	public function getSexAttr($value)
	{
		if($value==0){
			$value = '未知';
		}else if($value == 1 ){
			$value = '女';
		}else{
			$value = '男';
		}
		return $value;
	}
	//用户状态
	public function getStateAttr($value)
	{
		if($value==0){
			$value = '可用';
		}else if($value == 1 ){
			$value = '禁用';
		}else{
			$value = '注销';
		}
		return $value;
	}
	//用户等级
	public function getUserLevelAttr($value)
	{
		if($value==0){
			$value = '普通用户';
		}else if($value == 1 ){
			$value = 'VIP用户';
		}else{
			$value = '高级VIP用户';
		}
		return $value;
	}
}
?>