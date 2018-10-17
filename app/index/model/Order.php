<?php 
namespace app\index\Model;
use think\Model;
/**
 * 订单表
 */
class Order extends Model
{
	public function getStatusAttr($value)
	{
		switch ($value)
		{
		case 1:
			$value = '未付款';
		    break;
		case 2:
			$value = '待发货';
	    	break;
	    case 3:
	    	$value = '待收货';
		    break;
	    case 4:
	    	$value = '待评价';
		    break;
	    case 5:
	    	$value = '已付款';
		    break;
		case 6:
	    	$value = '已发货';
		    break;
		case 7:
	    	$value = '交易成功';
		    break;
		default:
			$value = '交易关闭';
		    
		}
		return $value;
	}
	//关联订单商品表
    public function item()
	{
		return $this->hasMany('OrderItem','order_id','order_id'); 
	}
	//关联物流表
    public function shipping()
	{
		return $this->belongsTo('OrderShipping','order_id','order_id'); 
	}
}
?>