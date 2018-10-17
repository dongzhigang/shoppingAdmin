<?php 
namespace app\admin\Model;
use think\Model;
/**
 * 收货地址表
 */
class Address extends Model
{
	//性别
	public function getDefaultAttr($value)
	{
		if($value==0){
			$value = '默认';
		}else{
			$value = '';
		}
		return $value;
	}

}
?>