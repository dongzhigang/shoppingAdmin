<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\ProductMsg;							//商品信息
use app\index\Model\GeneralIssue;						//常见问题
use app\index\Model\Sort;								//常见问题
/**
 * 商品接口
 */
class Product extends Controller
{
	//查询商品列表
	public function productList()
	{
		$ProductMsg = new ProductMsg();
		$where = ['sell'=>1];							//条件
		$page = $_REQUEST['page'];
		$rows = $_REQUEST['rows'];
		$fieldSortList = Array();
		if(isset($_REQUEST['id'])){
			// 通过二级分类查找商品,请求参数子分类id
			$where = ['Sort_id'=>$_REQUEST['id'],'sell'=>1];
			$productList = $ProductMsg ->where($where) ->page($page,$rows) ->select();
		}		
		//全部商品
		else {
			$productList = $ProductMsg ->where($where) ->page($page,$rows)->select();
			//查找全部商品的子分类，请求参数无
			$res = $ProductMsg ->where(['sell'=>1])->field('Sort_id')->group('Sort_id')->buildSql();
			$fieldSortList = $ProductMsg->sort()->alias('a')->join([$res =>'b'],'a.Sort_id = b.Sort_id')->select();
		}
		//查询有多少条记录
		$count = $ProductMsg ->count();
		$data = Array(
			'count'			=>	$count,
			'productList'	=>	$productList,
			'fieldSortList'	=>  $fieldSortList
		);
		if(!$ProductMsg){
			$arrayName = array('code' => -1,'data' => Array() ,'msg' => "加载失败" );
		}else{
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}
		return json($arrayName);
	}
	//商品分类数据接口
	public function currentList()
	{	
		//请求参数，分类id cate_id，子分类id sort_id
		$id = $_REQUEST['id'];								//一级分类id
		$ProductMsg = new ProductMsg();
		$cateFind = $ProductMsg -> cate() ->where('Cate_id',$id)->find();	  //一级的分类数据
		//判断传入值是否分类id，则是子分类id
		if(!$cateFind){
			// $cateFind = $ProductMsg -> cate() ->with('sort') ->where('Sort_id',$id)->select();
			// dump($cateFind);
			// exit;
			$Cate_id =  $ProductMsg -> sort() ->where('Sort_id',$id)->find()->Cate_id;		//分类id
			$cateFind = $ProductMsg -> cate() ->where('Cate_id',$Cate_id)->find();	 		//一级的分类数据
			$sortFind = $ProductMsg -> sort() ->where('Sort_id',$id)->find();				//二级分类默认数据
			$sortList = $ProductMsg -> sort() ->where('Cate_id',$Cate_id)->select();		//二级分类数据
		}else{
			$sortFind = $ProductMsg -> sort() ->where('Cate_id',$id)->find();			//二级分类数据
			$sortList = $ProductMsg -> sort() ->where('Cate_id',$id)->select();			//二级分类列表
		}
		// dump($res);exit;
		$data = Array(
			'currentList'	=>	$sortList,
			'cateFind'		=>	$cateFind,
			'sortFind'		=>	$sortFind,
		);
		if($ProductMsg){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => 0,'data' => Array() ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
	// 商品详情接口
	public function getProductInfo()
	{
		$id = $_REQUEST['product_id'];
		$ProductMsg = new ProductMsg();
		$GeneralIssue = new GeneralIssue();
		$productInfo = $ProductMsg ->where('product_id',$id)->with(['productMaster','Brand','propertyName'=>['values'],'parameter','contents','comment'=>['commentImg','user']])->find();	//商品信息
		$master = $productInfo->product_master;																							//商品主图
		$property = $productInfo ->property_name;																						//商品规格
		$parameter = $productInfo ->parameter;
		$contents = $productInfo ->contents;
		$property_arr = array();		
		foreach ($property as $k => $v) {
			if(isset($property_arr[$v['name']])){
				$arr = array_merge_recursive($property_arr[$v['name']]['values'],$v['values']);
				$property_arr[$v['name']]['value'] = $arr;
			}else{
				$property_arr[$v['name']] = $v;
				$property_arr[$v['name']]['value'] = $v['values'];
			}
		}
		sort($property_arr);
		if($productInfo  ->comment){
			$commentlist[0] = $productInfo  ->comment[0];																				//商品评论
		}else{
			$commentlist = Array();																										//商品评论
		}
		$answer = $GeneralIssue  -> select();																							//商品常见问题
		// 查询结果
		$data = array(
			'productInfo' 	=> 	$productInfo,
			'master'		=>	$master,
			'property'		=>	$property_arr,
			'parameter'		=>	$parameter,
			'commentlist'	=>	$commentlist,
			'answer'	  	=> 	$answer,
			'contents'		=>	$contents
		);
		if($ProductMsg && $GeneralIssue){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => -1,'data' => array('') ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
	//商品总数接口
	public function productCount()
	{
		//查询有多少条记录
		$ProductMsg = new ProductMsg();
		$count = $ProductMsg ->count();
		if($ProductMsg){
			$arrayName = array('code' => 0,'data' => $count ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => -1,'data' => array('') ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
}
?>