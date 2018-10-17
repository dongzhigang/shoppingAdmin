<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\Address;
/**
 * 地址接口
 */
class Addresss extends Controller
{
	//查询用户列表,请求参数，page,rows
	public function fetchList()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Address 	= 	new Address;
		$page 		=	$_REQUEST['page'];
		$rows		=	$_REQUEST['rows'];
		$list 		=	$Address -> page($page,$rows)->select();
		$count 		= 	$Address -> count();
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
	//模糊搜索，user_id，name
	public function grabbleData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$user_id 		 = $_REQUEST['user_id'];
		$name 			 = $_REQUEST['name'];
		$map['user_id']	 = ['like','%'.$user_id.'%'];
		$map['name']	 = ['like','%'.$name.'%'];
		$Address = new Address;
		$List = $Address ->where($map)->select();
		$count = $Address ->where($map)->count();
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