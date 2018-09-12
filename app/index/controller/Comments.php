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
		$page = $_REQUEST['page'];
		$rows = $_REQUEST['rows'];
		$commentlist = Array();
		$commentImglist = Array();
		$Comment = new Comment;
		$commentlist = $Comment ->where('product_id',$id)->with('commentImg,user') ->page($page,$rows) -> select();									//商品评论
		foreach ($commentlist as $key => $value) {
			if($value->comment_img){
				$commentImglist[$key] = $value;
			}
		}
		// 查询结果
		$data = array(
			'commentlist'		=>	$commentlist,
			'commentImglist' 	=> 	$commentImglist
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
		$count = $Comment ->where('product_id',$id)-> count();
		$counts = $Comment ->withCount('commentImg')->select();
		$countImg=0;
		foreach($counts as $user){
		    // 获取用户关联的card关联统计
		    if($user->comment_img_count){
		    	$countImg+=1;
		    }
		}
		$data = Array(
			'countImg'=>$countImg,
			'count'=>$count
		);
		if($Comment){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => -1,'data' => array('') ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
}
?>