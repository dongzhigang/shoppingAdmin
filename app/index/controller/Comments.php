<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Comment;
/**
 * 评论接口
 */
class Comments extends Controller
{
	//评论全部列表
	public function commentList()
	{
		$id = $_REQUEST['product_id'];
		$Comment = new Comment;
		if(isset($_REQUEST['stats'])){
			$comment = $Comment ->where('product_id',$id)->with('user') -> select();									//商品评论
			// $count = $Comment ->withCount('commentImg');
			$commentlist = Array();
			foreach ($comment as $key => $value) {
				$img = $Comment->commentImg()->where('comment_id',$value->id)-> select();//商品评论图片
				if($img){
					$commentlist[$key] = Array('list'=>$value,'img'=>$img);
				}
			}
		}else{
			$comment = $Comment ->where('product_id',$id)->with('user') -> select();									//商品评论
			$count = $Comment ->count();
			$commentlist = Array();
			foreach ($comment as $key => $value) {
				$img = $Comment->commentImg()->where('comment_id',$value->id)-> select();//商品评论图片
				$commentlist[$key] = Array('list'=>$value,'img'=>$img);
			}
		}
		// 查询结果
		$data = array(
			'commentlist'	=>	$commentlist,
			'count'			=>	$count
		);
		if($Comment){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => -1,'data' => array('') ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
	//评论总数
	public function commentCount()
	{
		$id = $_REQUEST['product_id'];
		$Comment = new Comment;
		$count = $Comment -> count();
		if($Comment){
			$arrayName = array('code' => 0,'data' => $count ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => -1,'data' => array('') ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
}
?>