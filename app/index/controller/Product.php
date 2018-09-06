<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\ProductMsg;
use app\index\Model\GeneralIssue;
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
		$GeneralIssue = new GeneralIssue();
		$productInfo = $ProductMsg ->where('product_id',$id)->with('Brand')->find();					//商品信息
		$master = $ProductMsg -> productMaster() -> where('product_id',$id) -> select();				//商品主图
		$property = $ProductMsg ->property() ->  where('product_id',$id) -> select();					//商品规格
		$parameter = $ProductMsg ->parameter() ->  where('product_id',$id) -> select();					//商品常见问题
		$answer = $GeneralIssue  -> select();					//商品常见问题

		// dump($answer);exit;

		// 查询结果
		$data = array(
			'productInfo' => $productInfo,
			'master' 	  => $master,
			'property'    => $property,
			'parameter'	  => $parameter,
			'answer'	  => $answer,
		);
		if($productInfo && $master && $property && $parameter && $answer){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => -1,'data' => array('') ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}

	//通过一级分类查询商品
	public function cateProduct($id)
	{
		$ProductMsg = new ProductMsg();
		$res = $ProductMsg ->where('Cate_id',$id) ->limit(10)->select();
		if($res){
			return $res;
		}
		return false;
	}

	//通过二级分类查询商品
	public function sortProduct($id,$page,$rows)
	{
		$ProductMsg = new ProductMsg();
		$res = $ProductMsg ->where('Sort_id',$id) ->page($page,$rows)->select();
		if($res){
			return $res;
		}
		return false;
	}
}
?>