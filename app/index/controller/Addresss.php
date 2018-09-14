<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Address;
/**
 * 收货地址接口
 */
class Addresss extends Controller
{
	//查询地址
	public function addressList()
	{
		$user_id = $_REQUEST['user_id'];
		$data = Array(
			'user_id'	=>	$user_id
		);
		$Address = new Address;
		$list = $Address -> where($data) -> select();
		if($Address){
			$arrayName = Array('code'=>0,'data'=>$list,'msg'=>'添加成功');
		}else{
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'添加失败');
		}
		return json($arrayName);
	}
	//添加地址
	public function addAddress()
	{
		$user_id = $_REQUEST['user_id'];
		$name    = $_REQUEST['name'];
		$mobile	 = $_REQUEST['mobile'];
		$phone   = $_REQUEST['phone'];
		$address = $_REQUEST['address'];
		$Default = $_REQUEST['Default'];
		$provinceName = $_REQUEST['provinceName'];
		$cityName = $_REQUEST['cityName'];
		$areaName = $_REQUEST['areaName'];
		$code = $_REQUEST['code'];
		$data = Array(
			'user_id'		=>	$user_id,
			'name'			=>	$name,
			'phone'			=>	$phone,
			'mobile'		=>	$mobile,
			'provinceName'	=>	$provinceName,
			'cityName'		=>	$cityName,
			'areaName'		=>	$areaName,
			'address'		=>	$address,
			'code'			=>	$code,
			'Default'		=>	$Default
		);
		$Address = new Address;
		//判断是否有默认地址
		$res = $Address -> where(['user_id'=>$user_id,'Default'=>1]) -> find();
		//判断地址id是否有值，有值为更新，则为新增
		if(isset($_REQUEST['id'])){	
			$id = $_REQUEST['id'];
			//判断是否有默认地址;
			if($res){
				//只能存在一个默认地址，如果存在默认地址，就不能设置默认地址
				if(empty($Default)){
					$res = $Address -> save($data,['address_id'=>$id]);
				}else{
					$res = Array();
				}
			}else{
				$res = $Address -> save($data,['address_id'=>$id]);
			}
			if($res === false){
				$arrayName = Array('code'=>-1,'data'=>Array(),'msg'=>'保存失败');
			}else{
				if (count($res)===0) {
					$arrayName = Array('code'=>1,'data'=>Array(),'msg'=>'保存失败，已存在默认地址');
				}else{
					$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'保存成功');
				}
			}
		}else{
			//判断是否有默认地址
			if($res){
				//只能存在一个默认地址，如果存在默认地址，就不能设置默认地址
				if($Default == 1){
					$res = Array();
				}else{
					$data['address_id'] = md5(uniqid(md5(microtime(true)),true));
					$res = $Address -> save($data);
				}
			}else{
				$data['address_id'] = md5(uniqid(md5(microtime(true)),true));
				$res = $Address -> save($data);
			}
			if($res === false){
				$arrayName = Array('code'=>-1,'data'=>Array(),'msg'=>'添加失败');
			}else{
				if (count($res)===0) {
					$arrayName = Array('code'=>1,'data'=>Array(),'msg'=>'添加失败，已存在默认地址');
				}else{
					$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'添加成功');
				}
			}
		}
		return json($arrayName);
	}
	//地址详情,请求参数地址id  addressId
	public function detailAddress()
	{
		$id = $_REQUEST['addressId'];
		$data = Array('address_id'=>$id);
		$Address = new Address;
		$list = $Address -> where($data) -> find();
		if($list){
			$arrayName = Array('code'=>0,'data'=>$list,'msg'=>'添加成功');
		}else{
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'添加失败');
		}
		return json($arrayName);
	}
	//删除地址,请求参数，地址id
	public function delAddress()
	{
		$id = $_REQUEST['id'];
		$data = Array(
			'address_id'	=>	$id
		);
		// dump($data);
		// exit;
		$Address = new Address;
		$list = $Address -> where($data) ->delete();
		if($list === false){
			$arrayName = Array('code'=>0,'data'=>$list,'msg'=>'添加成功');
		}else{
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'添加失败');
		}
		return json($arrayName);
	}
}
?>