<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Antistop;
use app\index\Model\ProductMsg;
/**
 * 关键词接口
 */
class Keyword extends Controller
{
	//热门关键词
	public function hotKeyword()
	{ 
		$Antistop = new Antistop;
		$hotKeywordList = $Antistop ->where('isHot',1) -> select();
		$defaultKeyword	= $Antistop ->where('isDefault',1) -> find();	//默认关键词
		$data = Array(
			'hotKeywordList'	=>	$hotKeywordList,
			'defaultKeyword'	=>	$defaultKeyword
		);
		if($Antistop){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => -1,'data' => array('') ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
	//搜索结果
	public function searchResult()
	{
		//模糊查询	
		$ProductMsg = new ProductMsg();	
		$where = ['sell'=>1];							//条件
		$page = $_REQUEST['page'];
		$rows = $_REQUEST['rows'];
		$productList = $ProductMsg ->where($where)->where('name|docs','like',$_REQUEST['keyword'].'%')->page($page,$rows)->select();			
		if(isset($_REQUEST['order'])){
			//价格at_price排序，请求参数order,asc上升，desc下降
			$productList = $ProductMsg ->where($where)-> order('at_price '.$_REQUEST['order'])->where('name|docs','like',$_REQUEST['keyword'].'%')->page($page,$rows)->select();
		}
		if(isset($_REQUEST['Sort_id'])){
			//子分类价格at_price排序，请求参数order,asc上升，desc下降
			$where = ['Sort_id'=>$_REQUEST['Sort_id'],'sell'=>1];
			$productList = $ProductMsg ->where($where)->where('name|docs','like',$_REQUEST['keyword'].'%')->page($page,$rows)->select();
		}
		if( isset($_REQUEST['Sort_id']) && isset($_REQUEST['order']) ){
			//子分类价格at_price排序，请求参数order,asc上升，desc下降
			$where = ['Sort_id'=>$_REQUEST['Sort_id'],'sell'=>1];
			$productList = $ProductMsg ->where($where)-> order('at_price '.$_REQUEST['order'])->where('name|docs','like',$_REQUEST['keyword'].'%')->page($page,$rows)->select();
		}
		//查找全部商品的子分类，请求参数无
		$res = $ProductMsg ->where(['sell'=>1])->where('name|docs','like',$_REQUEST['keyword'].'%')->field('Sort_id')->group('Sort_id')->buildSql();
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