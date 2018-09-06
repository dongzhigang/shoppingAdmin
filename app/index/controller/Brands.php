<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Brand;
use app\index\Model\ProductMsg;
/**
 * 品牌接口
 */
class Brands extends Controller
{
	public function brandList()
	{
		$page = $_REQUEST['page'];
		$rows = $_REQUEST['rows'];
		$Brand = new Brand;
		$list = $Brand ->page($page,$rows)->select();
		if($list){
			$arrayName = array('code' => 0, 'data' => $list , 'msg' => "加载完成");
		}else{
			$arrayName = array('code' => -1, 'data' => Array() , 'msg' => "加载失败");
		}
		return json($arrayName);
	}
	public function brandInfo()
	{
		$id = $_REQUEST['id'];
		$Brand = new Brand;
		$ProductMsg = new ProductMsg;
		$find = $Brand ->where('id',$id)->find();
		$list = $ProductMsg -> where('brand_id',$id)->select();
		$data = Array(
			'brand' => $find,
			'goodsList' => $list
		);
		if($list){
			$arrayName = array('code' => 0, 'data' => $data , 'msg' => "加载完成");
		}else{
			$arrayName = array('code' => -1, 'data' => Array() , 'msg' => "加载失败");
		}
		return json($arrayName);
	}
}
?>