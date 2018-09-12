<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Advertis;
use app\index\Model\ProductMsg;
use app\index\Model\Cate;
/**
 * 首页接口
 */
class Home extends Controller
{	
	//广告列表		
	public function Advertis()
	{
		$Advertis = new Advertis;
		$list = $Advertis ->where('start',1)->select();									
		if($list){
			return $list;
		}else{
			return false;
		}
	}

	//一级分类列表
	public function cateList() 
	{
		$Cate = new Cate;	
		$list = $Cate ->select();
		if($list){
			return $list;
		}else{
			return false;
		}								
	}
	//分类商品列表
	public function productList()
	{
		$Cate = new Cate;
		$list = $Cate ->with('productMsg') ->select();
		// return json($list);
		// exit;
		if($Cate){
			return $list;
		}else{
			return false;
		}	
	}
	//品牌列表
	public function brandList()
	{
		$ProductMsg = new ProductMsg;
		$list = $ProductMsg -> Brand() -> limit(4)->select(); 	
		if($ProductMsg){
			return $list;
		}else{
			return false;
		}
	}
	//新品列表
	public function newProduct()
	{
		$ProductMsg = new ProductMsg;
		$list = $ProductMsg ->where('new_product',1)->order('time desc')->limit(4)->select();
		if($ProductMsg){
			return $list;
		}else{
			return false;
		}
	}
	//人气热卖列表
	public function hotSale()
	{
		$ProductMsg = new ProductMsg;
		$list = $ProductMsg ->where('hot_sale',1)->order('time desc')->limit(4)->select();
		if($ProductMsg){
			return $list;
		}else{
			return false;
		}	
	}

	//首页接口
	public function index()
	{
		//广告列表
		$Advertis = $this->Advertis();
		//分类列表
		$cateList = $this->cateList();
		//商品列表
		$productList = $this->productList();
		//品牌列表
		$brandList = $this->brandList();
		//新品列表
		$newProduct = $this->newProduct();
		//热卖列表
		$hotSale = $this->hotSale();

		$data = Array(
			'Advertis' 			=> $Advertis,
			'cateList' 			=> $cateList,
			'productList' 		=> $productList,
			'brandList' 		=> $brandList,
			'newProduct' 		=> $newProduct,
			'hotSale' 			=> $hotSale,
		);
		if ($Advertis===false || $cateList===false || $productList===false || $newProduct===false || $hotSale===false ) {
			$arrayName = array('code' => -1,'data' => array() ,'msg' => "加载失败" );
		}else{
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}
		return json($arrayName);	
	}

}
?>