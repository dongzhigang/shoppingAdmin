<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\Admin;
/**
 * 登录注册接口
 */
class Login extends Controller
{
	
	public function LoginByAdminname()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Admin = new Admin;
		$adminName = $_REQUEST['adminName'];
		$password = md5($_REQUEST['password']);
		$res = $Admin ->where(['adminName'=>$adminName,'password'=>$password]) ->find();
		if($res){
			$arrayName = Array('code' => 0, 'data' => $res, 'msg' => '登录成功');
		}else{
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '登录失败');
		}
		return json($arrayName);
	}
}
?>