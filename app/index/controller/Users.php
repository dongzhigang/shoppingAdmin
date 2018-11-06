<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\User;
/**
 * 用户接口
 */
class Users extends Controller
{
	//账号登录
	public function login()
	{
		$userName = $_REQUEST['userName'];
		$password = $_REQUEST['password'];
		$User = new User;
		$res = $User -> where(['userName'=>$userName,'password'=>md5($password)]) -> find();
		if ($res) {
			if($res->state==1){
				$arrayName = Array('code'=>1,'data'=>$res,'msg'=>'账号禁用');
			}else if($res->state==2){
				$arrayName = Array('code'=>2,'data'=>$res,'msg'=>'账号注销');
			}else{
				$arrayName = Array('code'=>0,'data'=>$res,'msg'=>'登录成功');
			}
		}else{
			$arrayName = Array('code'=>-1,'data'=>Array(),'msg'=>'账号或密码错误');
		}
		return json($arrayName);
	}
	//账号注册
	public function register()
	{
		$userName = $_REQUEST['userName'];
		$password = $_REQUEST['password'];
		$data = Array(
			'user_id'	=>	md5(uniqid(md5(microtime(true)),true)),
			'userName'	=>	$userName,
			'password'	=> 	md5($password)
		);
		$User = new User;
		$res = $User -> save($data);
		if ($res) {
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'登录成功');
		}else{
			$arrayName = Array('code'=>-1,'data'=>Array(),'msg'=>'登录失败');
		}
		return json($arrayName);
	}
}
?>