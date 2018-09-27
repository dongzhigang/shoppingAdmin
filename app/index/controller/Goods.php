<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\ProductMsg;
/**
 * 新品，热门，接口
 */
class Goods extends Controller
{
	//新品
	public function newGoods()
	{
		$ProductMsg = new ProductMsg;
		$page = $_REQUEST['page'];
		$rows = $_REQUEST['rows'];
		//通过新品查找商品，请求参数new_product
		$where = ['new_product'=>1,'sell'=>1];
		$productList = $ProductMsg ->where($where) ->page($page,$rows) ->select();
		if(isset($_REQUEST['order'])){
			//价格at_price排序，请求参数order,asc上升，desc下降
			$where = ['sell'=>1,'new_product'=>1];
			$productList = $ProductMsg ->where($where)-> order('at_price '.$_REQUEST['order']) ->page($page,$rows) ->select();
		}
		if(isset($_REQUEST['Sort_id'])){
			//子分类价格at_price排序，请求参数order,asc上升，desc下降
			$where = ['Sort_id'=>$_REQUEST['Sort_id'],'sell'=>1,'new_product'=>1];
			$productList = $ProductMsg ->where($where)->page($page,$rows)-> select();
		}
		if( isset($_REQUEST['Sort_id']) && isset($_REQUEST['order']) ){
			//子分类价格at_price排序，请求参数order,asc上升，desc下降
			$where = ['Sort_id'=>$_REQUEST['Sort_id'],'new_product'=>1,'sell'=>1];
			$productList = $ProductMsg ->where($where)-> order('at_price '.$_REQUEST['order'])->page($page,$rows)->select();
		}
		//查找全部商品的子分类，请求参数无
		$res = $ProductMsg ->where(['new_product'=>1,'sell'=>1])->field('Sort_id')->group('Sort_id')->buildSql();
		$fieldSortList = $ProductMsg->sort()->alias('a')->join([$res =>'b'],'a.Sort_id = b.Sort_id')->select();
		$data = Array(
			'productList'	=>	$productList,
			'fieldSortList'	=>  $fieldSortList
		);
		if($ProductMsg){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => 0,'data' => Array() ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
	//热卖
	public function hotGoods()
	{
		$ProductMsg = new ProductMsg;	
		$page = $_REQUEST['page'];
		$rows = $_REQUEST['rows'];	
		//通过热卖查找商品，请求参数hot_sale
		$where = ['hot_sale'=>1,'sell'=>1];
		$productList = $ProductMsg ->where($where) ->page($page,$rows) ->select();
		if(isset($_REQUEST['order'])){
			//价格at_price排序，请求参数order,asc上升，desc下降
			$where = ['hot_sale'=>1,'sell'=>1];
			$productList = $ProductMsg ->where($where)-> order('at_price '.$_REQUEST['order']) ->page($page,$rows) ->select();
		}
		if(isset($_REQUEST['Sort_id'])){
			//子分类价格at_price排序，请求参数order,asc上升，desc下降
			$where = ['Sort_id'=>$_REQUEST['Sort_id'],'hot_sale'=>1,'sell'=>1];
			$productList = $ProductMsg ->where($where)->page($page,$rows)-> select();
		}
		if( isset($_REQUEST['Sort_id']) && isset($_REQUEST['order'])){
			//子分类价格at_price排序，请求参数order,asc上升，desc下降
			$where = ['Sort_id'=>$_REQUEST['Sort_id'],'hot_sale'=> 1,'sell'=>1];
			$productList = $ProductMsg ->where($where)-> order('at_price '.$_REQUEST['order'])->page($page,$rows)->select();
		}
		//查找全部商品的子分类，请求参数无
		$res = $ProductMsg ->where(['hot_sale'=>1,'sell'=>1])->field('Sort_id')->group('Sort_id')->buildSql();
		$fieldSortList = $ProductMsg->sort()->alias('a')->join([$res =>'b'],'a.Sort_id = b.Sort_id')->select();
		$data = Array(
			'productList'	=>	$productList,
			'fieldSortList'	=>  $fieldSortList
		);
		if($ProductMsg){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => 0,'data' => Array() ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
}
?>