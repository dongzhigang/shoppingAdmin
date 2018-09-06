<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Cate;
use app\index\Controller\Product;
/**
 * 商品分类接口
 */
class Cassification extends Controller
{
	// 一级分类
	public function getCate()
	{
		$Cate = new Cate;					//实例化模型
		$List =$Cate -> select();
		return $List;
	}
	// 一级分类
	public function getSort($id=1)
	{
		$Cate = new Cate;					//实例化模型
		$List =$Cate -> sort()->where('Cate_id',$id) -> select();
		return $List;
	}
	//分类目录当前分类数据接口
	public function current()
	{	
		$id = $_REQUEST['id'];
		$page = $_REQUEST['page'];
		$rows = $_REQUEST['rows'];
		$getSort = $this -> getSort();					//获取二级分类
		$Product = new Product;
		$list = $Product -> sortProduct($id,$page,$rows);
		$data = Array(
			'currentList'	=>	$getSort,
			'productList'	=>	$list
		);
		if($getSort){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => 0,'data' => Array() ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
	public function catalogList()
	{

	}
}
?>