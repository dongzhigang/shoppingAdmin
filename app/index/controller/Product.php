<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\ProductMsg;
/**
 * 商品接口
 */
class Product extends Controller
{
	$ProductMsg = new ProductMsg();
	// 商品详情接口
	public function getProductInfo()
	{
		$res = $this -> $ProductMsg ->select();
		dump($res);
	}
}
?>