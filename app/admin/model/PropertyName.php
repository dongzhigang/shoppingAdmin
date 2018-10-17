<?php 
namespace app\admin\Model;
use think\Model;
/**
 * 规格/属性表
 */
class PropertyName extends Model
{
	//规格/属性表
    public function Value()
	{
		return $this->hasMany('PropertyValue','name_id','name_id'); 
	}
}
?>