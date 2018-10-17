<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\Collect;
/**
 * 收藏接口
 */
class Collects extends Controller
{
	//收藏列表
	public function fetchList()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Collect = new Collect;
		$page 		=	$_REQUEST['page'];
		$rows		=	$_REQUEST['rows'];
		$list 		=	$Collect -> page($page,$rows)->select();
		$count 		= 	$Collect -> count();
		$data 		= 	Array(
			'list'	=>	$list,
			'count'	=>	$count
		);
		if($list = false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $data, 'msg' => '查询成功');
		}
		return json($arrayName);
	}
	//模糊搜索
	public function grabbleData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$user_id 		 = $_REQUEST['user_id'];
		$product_id 	 = $_REQUEST['product_id'];
		$map['user_id']	 = ['like','%'.$user_id.'%'];
		$map['product_id']	 = ['like','%'.$product_id.'%'];
		$Collect = new Collect;
		$List = $Collect ->where($map)->select();
		$count = $Collect ->where($map)->count();
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