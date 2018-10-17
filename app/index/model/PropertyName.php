<?php 
namespace app\index\Model;
use think\Model;
/**
 * 属性名表
 */
class PropertyName extends Model
{
	//关联属性值表
    public function values()
	{
		return $this->hasMany('PropertyValue','name_id','name_id'); 
	}
}
?>