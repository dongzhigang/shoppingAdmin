<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\ProductMsg;
/**
 * 新品接口
 */
class Goods extends Controller
{
	public function newGoods()
	{
		$ProductMsg = new ProductMsg;
		$list = $ProductMsg ->where("new_product",1)->page(1,10)->select();
		if($ProductMsg){
			$arrayName = array('code' => 0,'data' => $list ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => 0,'data' => Array() ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
}
?>