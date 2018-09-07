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

	//分类列表接口
	public function catalogList()
	{			
		$Cate = new Cate;					//实例化模型
		$getCate =$Cate -> select();
		$findCate = $Cate ->find();		
		$getSort = $Cate -> sort()->where('Cate_id',$findCate->id) -> select();					//获得一级分类下的二级分类
		$data = Array(
			'cateList'	=>	$getCate,
			'sortList'	=>	$getSort,
			'findCate'	=>	$findCate
		);
		if($Cate){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => 0,'data' => Array() ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
	//分类目录当前分类数据接口
	public function current()
	{
		$id = $_REQUEST['id'];					//一级分类id
		$Cate = new Cate;					//实例化模型
		$findCate = $Cate-> where('id',$id) ->find();		
		$getSort = $Cate -> sort()->where('Cate_id',$id) -> select();					//获得一级分类下的二级分类
		$data = Array(
			'sortList'	=>	$getSort,
			'findCate'	=>	$findCate
		);
		if($Cate){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => 0,'data' => Array() ,'msg' => "加载失败" );
		}
		return json($arrayName);

	}
	
}
?>