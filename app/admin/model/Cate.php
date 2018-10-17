<?php 
namespace app\admin\Model;
use think\Model;
/**
 * 一类目表
 */
class Cate extends Model
{
	//性别
	// public function getGradeAttr($value)
	// {
	// 	if($value == 1 ){
	// 		$value = '一级类目';
	// 	}else{
	// 		$value = '二级类目';
	// 	}
	// 	return $value;
	// }
	public function children()
	{
		return $this->hasMany('Sort','Cate_id','Cate_id'); 
	}
}
?>