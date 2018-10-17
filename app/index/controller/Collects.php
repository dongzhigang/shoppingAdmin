<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Collect;
/**
 * 收藏接口
 */
class Collects extends Controller
{
	//收藏列表,请求参数user_id,page,rowa
	public function collectList()
	{
		$Collect 	=	new Collect;
		$page		=	$_REQUEST['page'];	
		$rows		=	$_REQUEST['rows'];
		$user_id	=	$_REQUEST['user_id'];
		$list = $Collect ->where(['user_id'=>$user_id]) ->page($page,$rows) ->with('product') ->select();
		if($list === false){
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'查询失败');
		}else{
			$arrayName = Array('code'=>0,'data'=>$list,'msg'=>'查询成功');
		}
		return json($arrayName);
	}
	//添加收藏,user_id,product_id
	public function addCollect()
	{
		$Collect 	=	new Collect;
		$user_id	=	$_REQUEST['user_id'];
		$product_id	=	$_REQUEST['product_id'];
		$data = Array(
			'collect_id'	=>	md5(uniqid(md5(microtime(true)),true)),
			'user_id'		=>	$user_id,
			'product_id'	=>	$product_id,
			'add_time'		=>	date('Y-m-d H-i-s')
		);
		$res = $Collect -> save($data);
		if($res === false){
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'添加失败');
		}else{
			$arrayName = Array('code'=>0,'data'=>Array('collect_id'=>$Collect->collect_id),'msg'=>'添加成功');
		}
		return json($arrayName);
	}
	//取消收藏,collect_id,product_id
	public function deleteCollect()
	{
		$Collect 	=	new Collect;
		$collect_id	=	$_REQUEST['collect_id'];
		$product_id	=	$_REQUEST['product_id'];
		$res = $Collect -> where(['collect_id'=>$collect_id,'product_id'=>$product_id]) ->delete();
		if($res === false){
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'取消失败');
		}else{
			$arrayName = Array('code'=>0,'data'=>Array(),'msg'=>'取消成功');
		}
		return json($arrayName);
	}
	//判断商品是否收藏,product_id,user_id
	public function hasCollect()
	{
		$product_id = 	$_REQUEST['product_id'];
		$user_id	=	$_REQUEST['user_id'];
		if(!empty($_REQUEST['user_id'])){
			$Collect 	=	new Collect;
			$res = $Collect ->where(['product_id'=>$product_id,'user_id'=>$user_id])->find();
			if($res===null){
				$arrayName = Array('code'=>-1,'data'=>Array(),'msg'=>'未收藏');
			}else{
				$arrayName = Array('code'=>0,'data'=>Array('collect_id'=>$res->collect_id),'msg'=>'已收藏');
			}
			return json($arrayName);
		}
	}
}
?>