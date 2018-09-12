<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\GoodsCar;
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
		$list = $GoodsCar->where('user_id',$id)->with('productMsg') ->select();
		if($GoodsCar){
			$arrayName = Array('code'=>0,'data'=>$list,'msg'=>'加载成功');
		}else{
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'加载失败');
		}
		return json($arrayName);
	}
	// 更新购物车,参数是购物车id
	public function updateCar()
	{
		$id = $_REQUEST['id'];
		
	}
}
?>