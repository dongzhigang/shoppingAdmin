<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\Comment;
use app\admin\Controller\Common;
/**
 * 商品评论接口
 */
class Comments extends Controller
{
	
	//评论列表
	public function goodsComment()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Comment = new Comment;
		$page 		= $_REQUEST['page'];
		$rows 		= $_REQUEST['rows'];
		$list 		=	$Comment ->with('commentImg') ->page($page,$rows)->select();
		$count 		= $Comment -> count();
		$data 		= Array(
			'list'	=>	$list,
			'count'	=>	$count
		);
		if($list = false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $data, 'msg' => '查询成功');
		}
		return json($arrayName);
	}
	//删除评论
	public function deleteComment()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Comment = new Comment;
		$Common = new Common;
		$comment_id 	 = $_REQUEST['comment_id'];
		$res = $Comment ->commentImg() ->where('comment_id',$comment_id) ->select();
		if($res){
			foreach ($res as $k => $v) {
				 $Common ->unlink($v->pathUrl);
			}
		}
		$res = $Comment ->commentImg() ->where('comment_id',$comment_id) ->delete();
		$res = $Comment ->where('comment_id',$comment_id) ->delete();
		if($res = false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '删除失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => Array(), 'msg' => '删除成功');
		}
		return json($arrayName);

		// $res = $Comment ->where('comment_id',$comment_id) ->delete();
	}
	//模糊查询
	public function grabbleData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$user_id 		 = $_REQUEST['user_id'];
		$product_id 	 = $_REQUEST['product_id'];
		$page 		= $_REQUEST['page'];
		$rows 		= $_REQUEST['rows'];
		$map['user_id']	 = ['like','%'.$user_id.'%'];
		$map['product_id']	 = ['like','%'.$product_id.'%'];
		$Comment = new Comment;
		$List = $Comment ->with('commentImg') ->where($map) ->page($page,$rows) ->select();
		$count = $Comment ->where($map)->count();
		$data = Array(
			'list'	=>	$List,
			'count'	=>	$count
		);
		if($List===false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '新增失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $data, 'msg' => '新增成功');
		}
		return json($arrayName);
	}
}
?>