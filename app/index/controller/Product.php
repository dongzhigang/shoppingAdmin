<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\ProductMsg;
/**
 * 商品接口
 */
class Product extends Controller
{
	// 商品详情接口
	public function getProductInfo()
	{
		$id = $_REQUEST['id'];
		$ProductMsg = new ProductMsg();
		$productInfo = $ProductMsg ->where('product_id',$id)->with('Brand')->find();					//商品信息
		$master = $ProductMsg -> productMaster() -> where('product_id',$id) -> select();				//商品主图
		$property = $ProductMsg ->property() ->  where('product_id',$id) -> select();					//商品规格
		$parameter = $ProductMsg ->parameter() ->  where('product_id',$id) -> select();					//商品规格

		// dump($parameter);exit;

		// 查询结果
		$data = array(
			'productInfo' => $productInfo,
			'master' 	  => $master,
			'property'    => $property,
			'parameter'	  => $parameter
		);
		if($productInfo || $Master){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => -1,'data' => array('') ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
}
?>