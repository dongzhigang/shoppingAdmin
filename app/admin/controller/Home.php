<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\ProductMsg;
use app\admin\Model\User;
use app\admin\Model\GoodsCar;
use app\admin\Model\Order;
/**
 * 首页接口
 */
class Home extends Controller
{
	
	public function home()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		
		$ProductMsg = new ProductMsg;
		$User = new User;
		$GoodsCar = new GoodsCar;
		$Order = new Order;
		$goodsCount = $ProductMsg ->count();
		$userCount = $User ->count();
		$CarCount = $GoodsCar ->count();
		$OrderCount = $Order ->count();

		$data = Array(
			'goodsCount' => $goodsCount,
			'userCount'	 => $userCount,
			'CarCount'   => $CarCount,
			'OrderCount' => $OrderCount
		);
		if($OrderCount === false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $data, 'msg' => '查询成功');
		}
		return json($arrayName);
	}
}
?>