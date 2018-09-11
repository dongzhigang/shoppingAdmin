<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\ProductMsg;							//商品信息
use app\index\Model\GeneralIssue;						//常见问题
use app\index\Model\Sort;						//常见问题
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
		//新品
		else if(isset($_REQUEST['new_product'])){
			//通过新品查找商品，请求参数new_product
			$where = ['new_product'=>$_REQUEST['new_product'],'sell'=>1];
			$productList = $ProductMsg ->where($where) ->page($page,$rows) ->select();
			if(isset($_REQUEST['order'])){
				//价格at_price排序，请求参数order,asc上升，desc下降
				$where = ['sell'=>1,'new_product'=>$_REQUEST['new_product']];
				$productList = $ProductMsg ->where($where)-> order('at_price '.$_REQUEST['order']) ->page($page,$rows) ->select();
			}
			if(isset($_REQUEST['Sort_id'])){
				//子分类价格at_price排序，请求参数order,asc上升，desc下降
				$where = ['Sort_id'=>$_REQUEST['Sort_id'],'sell'=>1,'new_product'=>$_REQUEST['new_product']];
				$productList = $ProductMsg ->where($where)->page($page,$rows)-> select();
			}
			if( isset($_REQUEST['Sort_id']) && isset($_REQUEST['order']) ){
				//子分类价格at_price排序，请求参数order,asc上升，desc下降
				$where = ['Sort_id'=>$_REQUEST['Sort_id'],'new_product'=> $_REQUEST['new_product'],'sell'=>1];
				$productList = $ProductMsg ->where($where)-> order('at_price '.$_REQUEST['order'])->page($page,$rows)->select();
			}
			//查找全部商品的子分类，请求参数无
			$res = $ProductMsg ->where(['new_product'=>$_REQUEST['new_product'],'sell'=>1])->field('Sort_id')->group('Sort_id')->buildSql();
			$fieldSortList = $ProductMsg->sort()->alias('a')->join([$res =>'b'],'a.Sort_id = b.Sort_id')->select();
		}
		
		//热卖
		else if(isset($_REQUEST['hot_sale'])){
			//通过热卖查找商品，请求参数hot_sale
			$where = ['hot_sale'=>$_REQUEST['hot_sale'],'sell'=>1];
			$productList = $ProductMsg ->where($where) ->page($page,$rows) ->select();
			if(isset($_REQUEST['order'])){
				//价格at_price排序，请求参数order,asc上升，desc下降
				$where = ['hot_sale'=>$_REQUEST['hot_sale'],'sell'=>1];
				$productList = $ProductMsg ->where($where)-> order('at_price '.$_REQUEST['order']) ->page($page,$rows) ->select();
			}
			if(isset($_REQUEST['Sort_id'])){
				//子分类价格at_price排序，请求参数order,asc上升，desc下降
				$where = ['Sort_id'=>$_REQUEST['Sort_id'],'hot_sale'=>$_REQUEST['hot_sale'],'sell'=>1];
				$productList = $ProductMsg ->where($where)->page($page,$rows)-> select();
			}
			if( isset($_REQUEST['Sort_id']) && isset($_REQUEST['order'])){
				//子分类价格at_price排序，请求参数order,asc上升，desc下降
				$where = ['Sort_id'=>$_REQUEST['Sort_id'],'hot_sale'=> $_REQUEST['hot_sale'],'sell'=>1];
				$productList = $ProductMsg ->where($where)-> order('at_price '.$_REQUEST['order'])->page($page,$rows)->select();
			}
			//查找全部商品的子分类，请求参数无
			$res = $ProductMsg ->where(['hot_sale'=>$_REQUEST['hot_sale'],'sell'=>1])->field('Sort_id')->group('Sort_id')->buildSql();
			$fieldSortList = $ProductMsg->sort()->alias('a')->join([$res =>'b'],'a.Sort_id = b.Sort_id')->select();
		}
		
		//模糊查询
		else if(isset($_REQUEST['keyword'])){
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
			$Cate_id =  $ProductMsg -> sort() ->where('Sort_id',$id)->find()->Cate_id;		//二级分类数据
			$cateFind = $ProductMsg -> cate() ->where('Cate_id',$Cate_id)->find();	 		//一级的分类数据
			$sortFind = $ProductMsg -> sort() ->where('Sort_id',$id)->find();				//二级分类数据
			$sortList = $ProductMsg -> sort() ->where('Cate_id',$Cate_id)->select();	
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
		$productInfo = $ProductMsg ->where('product_id',$id)->with('Brand')->find();					//商品信息
		$master = $ProductMsg -> productMaster() -> where('product_id',$id) -> select();				//商品主图
		$property = $ProductMsg ->property() ->  where('product_id',$id) -> select();					//商品规格
		$parameter = $ProductMsg ->parameter() ->  where('product_id',$id) -> select();					//商品参数表
		$answer = $GeneralIssue  -> select();															//商品常见问题
		$comment = $ProductMsg  -> comment()->where('product_id',$id)->with('user')-> find();			//商品评论
		$img = $ProductMsg->comment()->where('product_id',$id)->find()->commentImg()->where('comment_id',$comment->id)-> select();//商品评论图片
		$commentlist = Array('list'=>$comment,'img'=>$img);
		// 查询结果
		$data = array(
			'productInfo' 	=> 	$productInfo,
			'master' 	  	=> 	$master,
			'property'    	=> 	$property,
			'parameter'	  	=> 	$parameter,
			'answer'	  	=> 	$answer,
			'commentlist'	=>	$commentlist
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