<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\GoodsCar;
use app\index\Model\Address;
/**
 * 购物车接口
 */
class Shopcar extends Controller
{
	//查询购物车列表
	public function carList()
	{
		$id = $_REQUEST['user_id'];
		$GoodsCar = new GoodsCar;
		$list = $GoodsCar->where('user_id',$id)->with(['productMsg'=>['brand']]) ->select();
		if($GoodsCar){
			$arrayName = Array('code'=>0,'data'=>$list,'msg'=>'加载成功');
		}else{
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'加载失败');
		}
		return json($arrayName);
	}
	//添加购物车,请求参数，product_id，user_id,num,property_val
	public function addCart()
	{
		$GoodsCar = new GoodsCar;
		$product_id = $_REQUEST['product_id'];
		$user_id = $_REQUEST['user_id'];
		$num = $_REQUEST['num'];
		$property_val = $_REQUEST['property_val'];
		$hasCart = $GoodsCar -> where(['product_id'=>$product_id,'user_id'=>$user_id])->find();
		//如果购物车已存在商品，只增加数量
		if($hasCart){
			$num+=$hasCart->num;
			$list = $GoodsCar -> save(['num'=>$num,'time_update' =>	date('Y-m-d H:i:s')],['product_id'=>$product_id]);
		}else{
			$data = Array(
				'product_id'	=>	$product_id,
				'user_id'		=>	$user_id,
				'cart_id'		=>	md5(uniqid(md5(microtime(true)),true)),
				'property_val'	=>	$property_val,
				'num'			=>	$num,
				'time_create'	=>	date('Y-m-d H:i:s'),
				'time_update'	=>	date('Y-m-d H:i:s')
			);
			$list = $GoodsCar -> save($data);
		}
		if($list === false){
			$arrayName = array('code' =>-1 ,'data'=>Array(),'msg'=>'添加失败' );
		}else{
			$arrayName = array('code' =>0 ,'data'=>$list,'msg'=>'添加成功' );
		}
		return json($arrayName);
	}
	// 更新购物车,参数是购物车id、数量num
	public function updateCar()
	{
		//接收string
		$arrId = explode(',',$_REQUEST['id']);
		$arrNum = explode(',',$_REQUEST['num']);
		$GoodsCar = new GoodsCar;
		foreach ($arrId as $key => $id) {
			$array = Array('num' => $arrNum[$key],'time_update'	=>	date('Y-m-d H:i:s'));
			$list = $GoodsCar ->where(['cart_id'=>$id])-> update($array);
		}
		if($list === false){
			$arrayName = array('code' =>-1 ,'data'=>Array(),'msg'=>'更新失败' );
		}else{
			$arrayName = array('code' =>0 ,'data'=>$list,'msg'=>'更新成功' );
		}
		return json($arrayName);		
	}
	// 删除购物车,参数是购物车id
	public function deleteCar()
	{
		//接收string
		$arrId = explode(',',$_REQUEST['id']);
		$GoodsCar = new GoodsCar;
		foreach ($arrId as $key => $id) {
			$list = $GoodsCar -> where(['cart_id'=>$id])-> delete();
		}
		if($list){
			$arrayName = array('code' =>0 ,'data'=>Array(),'msg'=>'删除成功' );
		}else{
			$arrayName = array('code' =>-1 ,'data'=>Array(),'msg'=>'删除失败' );
		}
		return json($arrayName);
	}
	//购物车总数
	public function cartCount()
	{
		$id = $_REQUEST['user_id'];
		$GoodsCar = new GoodsCar;
		$count = $GoodsCar->where('user_id',$id) ->count();
		if($GoodsCar){
			$arrayName = Array('code'=>0,'data'=>$count,'msg'=>'加载成功');
		}else{
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'加载失败');
		}
		return json($arrayName);
	}

	//下单之前信息确认,请求参数，user_id,product_id,addressId,cart_id
	public function cartCheckout(){
		$user_id = $_REQUEST['user_id'];
		$Address = new Address;
		$GoodsCar = new GoodsCar;
		//判断是否有地址id，没有就用默认地址
		if(isset($_REQUEST['addressId'])){
			//查询地址
			$AddressData = $Address -> where(['user_id'=>$user_id,'address_id'=>$_REQUEST['addressId']]) ->find();
		}else{
			//查询默认地址
			$AddressData = $Address -> where(['user_id'=>$user_id,'Default'=>1]) ->find();
			if(!$AddressData){
				//没有默认地址就用第一个
				$AddressData = $Address -> where(['user_id'=>$user_id]) ->find();
			}
		}
		//查询商品
		if (isset($_REQUEST['cart_id'])) {			
			//通过购物车查询下单
			$cart_id = explode(',',$_REQUEST['cart_id']);
			foreach ($cart_id as $key => $value) {
				$goodsList[$key] = $GoodsCar ->where('cart_id',$value) ->with(['productMsg'=>['propertyName','brand']])->find();
			}
		}else{			
			//通过商品详情查询下单
			$product_id = $_REQUEST['product_id'];
			$goodsList[0] =	Array('product_msg' => $GoodsCar -> productMsg()->with('propertyName,brand') ->where('product_id',$product_id) ->find());
		}
		$data = Array(
			'AddressData' => $AddressData,
			'goodsList'	  => $goodsList
		);
		if($Address && $GoodsCar){
			$arrayName = Array('code'=>0,'data'=>$data,'msg'=>'加载成功');
		}else{
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'加载失败');
		}
		return json($arrayName);
	}
}
?>