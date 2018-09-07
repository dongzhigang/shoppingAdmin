<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Advertis;
use app\index\Model\ProductMsg;
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
		$ProductMsg = new ProductMsg;	
		$list = $ProductMsg -> cate() ->select();
		if($list){
			return $list;
		}else{
			return flase;
		}								
	}
	//分类商品列表
	public function productList()
	{
		$ProductMsg = new ProductMsg;
		$list = $ProductMsg -> cate() ->select();
		if($ProductMsg){
			foreach ($list as $key => $value) {
				$res = $ProductMsg ->where('Cate_id',$value->id) ->limit(10)->select();
				if($res){
					$arrayName = Array('name' => $value->Cate_name,'id' => $value->id ,'list' => $res);
					$array[$key] = $arrayName;
				}
			}
			return $array;
		}else{
			return flase;
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
			return flase;
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
			return flase;
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
			return flase;
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
		if ($Advertis && $cateList && $productList && $newProduct && $hotSale ) {
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => -1,'data' => array() ,'msg' => "加载失败" );
		}
		return json($arrayName);	
	}

}
?>