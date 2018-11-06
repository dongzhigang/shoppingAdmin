<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\Order;
/**
 * 订单接口
 */
class Orders extends Controller
{
	
	//订单列表
	public function orderList()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Order = new Order;
		$page = $_REQUEST['page'];
		$rows = $_REQUEST['rows'];

		$list = $Order ->with(['goods','Shipping']) ->page($page,$rows) ->select();
		$count 		= 	$Order -> count();
		$data 		= 	Array(
			'list'	=>	$list,
			'count'	=>	$count
		);
		if($list){
			$arrayName = Array('code' => 0, 'data' => $data, 'msg' => '查询成功');
		}else{
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}
		return json($arrayName);
	}
	//模糊搜索，user_id，order_number
	public function grabbleData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$user_id 		 = $_REQUEST['user_id'];
		$order_number 	 = $_REQUEST['order_number'];
		$map['user_id']	 = ['like','%'.$user_id.'%'];
		$map['order_number']	 = ['like','%'.$order_number.'%'];
		$Order = new Order;
		$List = $Order ->where($map)->select();
		$count = $Order ->where($map)->count();
		$data = Array(
			'list'	=>	$List,
			'count'	=>	$count
		);
		if($List===false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '新增失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $data, 'msg' => '新增成功');
		}
		return json($arrayName);
	}
}
?>