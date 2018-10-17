<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\User;
/**
 * 用户接口
 */
class Users extends Controller
{
	//查询用户列表,请求参数，page,rows
	public function fetchList()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$User 		=	new User;
		$page 		= $_REQUEST['page'];
		$rows 		= $_REQUEST['rows'];
		$list 		=	$User -> page($page,$rows)->select();
		$count 		= $User -> count();
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

		$user_id 			= md5(uniqid(md5(microtime(true)),true));
		$userName			=	$_REQUEST['userName'];
		$nickName			=	$_REQUEST['nickName'];
		$password 		= md5($_REQUEST['password']);
		$mobile				=	$_REQUEST['mobile'];
		$sex 					=	$_REQUEST['sex'];
		$birthday			=	$_REQUEST['birthday'];
		$userLevel 		= $_REQUEST['userLevel'];
		$state 				=	$_REQUEST['state'];
		$time_create	=	date('Y-m-d H-i-s');
		$data = Array(
			'user_id'			=>	$user_id,
			'userName'		=>	$userName,
			'nickName'		=>	$nickName,
			'password'		=>	$password,
			'mobile'			=>	$mobile,
			'sex'					=> 	$sex,
			'birthday'		=>	$birthday,
			'userLevel'		=>	$userLevel,
			'state'				=>	$state,
			'time_create'	=>	$time_create
		);
		$User 		=	new User;
		$res = $User -> isUpdate(false) ->save($data);
		$list = $User -> where('user_id',$User->user_id)->find();
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

		$user_id 		= 	$_REQUEST['user_id'];
		$userName		=	$_REQUEST['userName'];
		$nickName		=	$_REQUEST['nickName'];
		$password 		= 	md5($_REQUEST['password']);
		$mobile			=	$_REQUEST['mobile'];
		$sex 			=	$_REQUEST['sex'];
		$birthday		=	$_REQUEST['birthday'];
		$userLevel 		= 	$_REQUEST['userLevel'];
		$state 			=	$_REQUEST['state'];
		$time_update	=	date('Y-m-d H-i-s');
		$data = Array(
			'userName'		=>	$userName,
			'nickName'		=>	$nickName,
			'password'		=>	$password,
			'mobile'		=>	$mobile,
			'sex'			=> 	$sex,
			'birthday'		=>	$birthday,
			'userLevel'		=>	$userLevel,
			'state'				=>	$state,
			'time_update'	=>	$time_update
		);
		// return  json($data);
		$User 		=	new User;
		$res = $User ->save($data,['user_id'=>$user_id]);
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

		$user_id	= $_REQUEST['user_id'];
		$User 		=	new User;
		$res 		= $User ->where(['user_id'=>$user_id])->delete();
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

		$user_id	= $_REQUEST['user_id'];
		$User 		=	new User;
		$find 		= $User ->where('user_id',$user_id) ->find();
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

		$userName = $_REQUEST['userName'];
		$mobile = $_REQUEST['mobile'];
		$map['userName'] = ['like','%'.$userName.'%'];
		$map['mobile']	 = ['like','%'.$mobile.'%'];
		$User = new User;
		$List = $User ->where($map)->select();
		$count = $User ->where($map)->count();
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