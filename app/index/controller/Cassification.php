<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Cate;
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
		$getSort = $Cate -> sort()->where('Cate_id',$findCate->Cate_id) -> select();					//获得一级分类下的二级分类
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
		$Cate_id = $_REQUEST['Cate_id'];					//一级分类id
		$Cate = new Cate;					//实例化模型
		$findCate = $Cate-> where('Cate_id',$Cate_id) ->find();		
		$getSort = $Cate -> sort()->where('Cate_id',$Cate_id) -> select();					//获得一级分类下的二级分类
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