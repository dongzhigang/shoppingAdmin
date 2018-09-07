<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\ProductMsg;							//商品信息
use app\index\Model\GeneralIssue;						//常见问题
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
		// 查询结果
		$data = array(
			'productInfo' => $productInfo,
			'master' 	  => $master,
			'property'    => $property,
			'parameter'	  => $parameter,
			'answer'	  => $answer,
		);
		if($productInfo && $answer){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => -1,'data' => array('') ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}

	//查询商品列表
	public function productList()
	{
		$ProductMsg = new ProductMsg();
		$id = $_REQUEST['id'];						//一级分类id	
		if(isset($_REQUEST['sortId'])){
			$sortId = $_REQUEST['sortId'];
			$sortFind = $ProductMsg -> sort() ->where(['Cate_id'=>$id,'id'=>$sortId])->find();	//二级分类数据
		}else{
			$sortFind = $ProductMsg -> sort() ->where('Cate_id',$id)->find();	//二级分类数据
			$sortId = $sortFind->id;
		}
		$page = $_REQUEST['page'];
		$rows = $_REQUEST['rows'];
		$productList = $ProductMsg ->where(['Cate_id'=>$id,'Sort_id'=>$sortId]) ->page($page,$rows)->select();
		$data = Array(
			'productList'	=>	$productList,
			'sortFind'		=>	$sortFind			
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
		$id = $_REQUEST['id'];								//一级分类id
		$ProductMsg = new ProductMsg();
		$cateFind = $ProductMsg -> cate() ->where('id',$id)->find();	//一级的分类数据
		$sortFind = $ProductMsg -> sort() ->where('Cate_id',$id)->find();	//二级分类数据
		$sortList = $ProductMsg -> sort() ->where('Cate_id',$id)->select();								//二级分类列表
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
}
?>