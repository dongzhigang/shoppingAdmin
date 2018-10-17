<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Controller\Common;
use app\index\Model\Order;
use app\index\Model\OrderItem;
use app\index\Model\OrderShipping;
use app\index\Model\ProductMsg;
use app\index\Model\Address;
use app\index\Model\GoodsCar;
/**
 * 订单接口
 */
class Orderport extends Controller
{
	//查询订单列表
	public function OrderList()
	{
		$Order = new Order;
		$status =  $_REQUEST['status'];
		$user_id =  $_REQUEST['user_id'];
		if(!$status){
			$list = $Order ->where(['user_id'=>$user_id]) ->with('item')->select();
		}else{
			$list = $Order -> where(['user_id'=>$user_id,'status'=>$status])->with('item')->select();
		}
		$data = Array(
			'OrderList'	=>	$list
		);
		if($list===false){
			$areaName = Array('code' => 0,'data' => Array(), 'msg' => '加载失败');
		}else{
			$areaName = Array('code' => 0,'data' => $data, 'msg' => '加载完成');
		}
		return json($areaName);
	}
	//生成订单，请求参数商品id(product_id)是、购买商品数量(num)是、订单状态(status)否、支付类型(payment)否、邮费(post_fee)是、用户id(user_id)是、买家留言(buyer_message)否、
	public function submitOrder()
	{	
		$Common 		= new Common;
		$address_id 	= $_REQUEST['address_id'];
		$user_id		= $_REQUEST['user_id'];
		$goodsPrice		= $_REQUEST['goodsPrice'];
		$actualPrice	= $_REQUEST['actualPrice'];
		$order_id		= md5(uniqid(md5(microtime(true)),true));
		$Order 			= new Order;
		$OrderItem		= new OrderItem;
		$OrderShipping 	= new OrderShipping;
		$ProductMsg 	= new ProductMsg;
		$Address 		= new Address;
		$GoodsCar 		= new GoodsCar;
		//添加订单表
		$data = Array(
			'order_id'		=>	$order_id,
			'order_number'	=>	$Common->orderNo(),
			'status'		=>	1,
			'post_fee'		=>	0,
			'add_time'		=>	date('YmdHis'), 
			'user_id'		=>	$user_id, 
			'goodsPrice'	=>	$goodsPrice,
			'actualPrice'	=>	$actualPrice
		);
		$res = $Order ->save($data);
		//判断是否从购物车下单
		if(isset($_REQUEST['cart_id'])){
			$cart_id = explode(',',$_REQUEST['cart_id']);
			foreach ($cart_id as $key => $value) {
				$cartFind = $GoodsCar -> where('cart_id',$value)->find();
				//添加订单商品表
				$find = $ProductMsg -> where('product_id',$cartFind->product_id) ->find();
				$total_fee = $cartFind->num * $find->at_price;
				$data = Array(
					'product_id'	=>	$find->product_id,
					'order_id'		=>	$order_id,
					'num'			=>	$cartFind->num,
					'title'			=>	$find->name,
					'price'			=>	$find->at_price,
					'total_fee'		=>	$total_fee,
					'pic_path'		=>	$find->img,
					'property_val'	=>	$cartFind ->property_val
				);
				if($res){
					$res = $OrderItem ->isUpdate(false)-> save($data);
					//下单成功删除购物车的数据
					$res = $GoodsCar ->where(['cart_id'=>$value])->delete();
				}
			}
		}else{
			$num = $_REQUEST['num'];
			$product_id = $_REQUEST['product_id'];
			$property_val = $_REQUEST['property_val'];
			//添加订单商品表
			$find = $ProductMsg -> where('product_id',$product_id) ->find();
			$total_fee = $num * $find->at_price;
			$data = Array(
				'product_id'	=>	$find->product_id,
				'order_id'		=>	$order_id,
				'num'			=>	$num,
				'title'			=>	$find->name,
				'price'			=>	$find->at_price,
				'total_fee'		=>	$total_fee,
				'pic_path'		=>	$find->img,
				'property_val'	=>	$property_val
			);
			if($res){
				$res = $OrderItem -> save($data);
			}			
		}
		//添加物流表
		$find = $Address -> where('address_id',$address_id)->find();
		$data = Array(
			'order_id'		=>	$order_id,
			'name'			=>	$find->name,
			'phone'			=>	$find->phone,
			'mobile'		=>	$find->mobile,
			'address'		=>	$find->provinceName.$find->cityName.$find->areaName.$find->address,
			'code'			=>	$find->code
		);
		if($res){
			$res = $OrderShipping -> save($data);
			if($res){
				$areaName = Array('code'=>0,'data'=>Array('order_id'=>$order_id),'msg' => '提交成功');
			}else{
				$areaName = Array('code'=>-1,'data'=>Array(),'msg' => '提交失败');
			}
			return json($areaName);
		}
	}
	//订单详情
	public function OrderDetail()
	{
		$orderId = $_REQUEST['orderId'];
		$Order = new Order;
		$find = $Order -> where('order_id',$orderId) ->with('item,shipping') ->find();
		$data = Array(
			'OrderDetail'	=>	$find
		);
		if($find===false){
			$areaName = Array('code' => 0,'data' => Array(), 'msg' => '加载失败');
		}else{
			$areaName = Array('code' => 0,'data' => $data, 'msg' => '加载完成');
		}
		return json($areaName);
	}
}
?>