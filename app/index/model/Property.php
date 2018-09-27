<?php 
namespace app\index\Model;
use think\Model;
/**
 * 属性，属性值，商品关联表
 */
class Property extends Model
{
	//关联属性值表
    public function name()
	{
		return $this->hasMany('PropertyName','name_id','name_id'); 
	}
}

?>