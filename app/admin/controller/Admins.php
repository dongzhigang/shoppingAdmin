<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\Admin;
use app\admin\Controller\Common;
/**
 * 管理员接口
 */
class Admins extends Controller
{
	//查询列表
	public function fetchList()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Admin 		=	new Admin;
		$page 		= $_REQUEST['page'];
		$rows 		= $_REQUEST['rows'];
		$list 		=	$Admin -> page($page,$rows)->select();
		$count 		= $Admin -> count();
		$data 		= Array(
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
	//新增数据
	public function createData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Admin 	=	new Admin;
		$Common	=	new Common;
		$adminP = "/admin";
		$admin_id 			= 	md5(uniqid(md5(microtime(true)),true));
		$adminName			=	$_REQUEST['adminName'];
		$password 			= 	md5($_REQUEST['password']);
		$adminPath 			=	$_REQUEST['adminPath'];
		$time_create		=	date('Y-m-d H-i-s');
		if($adminPath){
			$adminPath = $Common ->change($adminP,$adminPath);
		}
		$data = Array(
			'admin_id'		=>	$admin_id,
			'adminName'		=>	$adminName,
			'password'		=>	$password,
			'adminPath'		=>	$adminPath,			
			'time_create'	=>	$time_create
		);
		$res = $Admin -> isUpdate(false) ->save($data);
		$list = $Admin -> where('admin_id',$Admin->admin_id)->find();
		if($res === false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '新增失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $list, 'msg' => '新增成功');
		}
		return json($arrayName);
	}
	//更新
	public function updateData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		$Admin 	=	new Admin;
		$Common	=	new Common;
		$adminP = "/admin";
		$admin_id 			= 	$_REQUEST['admin_id'];
		$adminName			=	$_REQUEST['adminName'];
		$password 			= 	md5($_REQUEST['password']);
		$adminPath 			=	$_REQUEST['adminPath'];
		$time_create		=	date('Y-m-d H-i-s');
		$findImg = $Admin ->where('admin_id',$admin_id) ->find() ->adminPath;
		if($findImg !== $adminPath){
			$Common ->unlink($findImg);
			$adminPath = $Common ->change($adminP,$adminPath);
		}
		$data = Array(
			'admin_id'		=>	$admin_id,
			'adminName'		=>	$adminName,
			'password'		=>	$password,
			'adminPath'		=>	$adminPath,			
			'time_create'	=>	$time_create
		);
		$Admin 		=	new Admin;
		$res = $Admin ->save($data,['admin_id'=>$admin_id]);
		if($res===false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '更新失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $res, 'msg' => '更新成功');
		}
		return json($arrayName);
	}
	//删除
	public function deleteData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		$Admin 	=	new Admin;
		$Common	=	new Common;
		$admin_id	= $_REQUEST['admin_id'];
		$findImg	= $Admin ->where(['admin_id'=>$admin_id])->find() ->adminPath;
		if($findImg){
			$Common ->unlink($findImg);
		}
		$res 		= $Admin ->where(['admin_id'=>$admin_id])->delete();
		if($res===false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '删除失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $res, 'msg' => '删除成功');
		}
		return json($arrayName);
	}
	//详情
	public function detailData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Admin 		=	new Admin;
		$admin_id	= 	$_REQUEST['admin_id'];
		$find 		= 	$Admin ->where('admin_id',$admin_id) ->find();
		if($find===false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '新增失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $find, 'msg' => '新增成功');
		}
		return json($arrayName);
	}
	//模糊搜索，userName，mobile
	public function grabbleData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$adminName = $_REQUEST['adminName'];
		$map['adminName'] = ['like','%'.$adminName.'%'];
		$Admin = new Admin;
		$List = $Admin ->where($map)->select();
		$count = $Admin ->where($map)->count();
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