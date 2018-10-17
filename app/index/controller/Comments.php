<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Comment;
use app\index\Controller\Common;
use app\index\Model\Order;
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
	//发表评论
	public function commentAdd()
	{
		$Comment = new Comment;
		$Common = new Common;
		$Order = new Order;
		$comments = '/comment';					//评论图片路径
		$user_id = $_REQUEST['user_id'];
		$product_id = $_REQUEST['product_id'];
		$content = $_REQUEST['content'];
		$picUrls = $_REQUEST['picUrls'];
		$grade   = $_REQUEST['grade'];
		$order_id = $_REQUEST['order_id'];
		$data = Array(
			'comment_id' => md5(uniqid(md5(microtime(true)),true)),
			'user_id' => $user_id,
			'product_id' => $product_id,
			'content'    => $content,
			'grade'		 =>	$grade,
			'add_date'	 => date('Y-m-d H:i:s')
		);
		if ($picUrls) {
			$CommentImg = explode(',',$picUrls);
			$arr = Array();
			foreach ($CommentImg as $k => $v) {
				$v = $Common ->change($comments,$v);
				$imgData = Array(
					'comment_id'	=>	$data['comment_id'],
					'pathUrl'		=>	$v,
					'add_date'	 => date('Y-m-d H:i:s')
				);
				$arr[$k] = $imgData;
			}
			$res = $Comment ->commentImg() ->insertAll($arr);
		}		
		$res = $Comment ->save($data);
		if($res){
			$res = $Order ->where('order_id', $order_id) ->update(['status'=>7]);
			$arrayName = Array('code' => 0, 'data' => Array(),'msg' => '发布成功');
		}else{
			$arrayName = Array('code' => -1, 'data' => Array(),'msg' => '发布失败');
		}
		return json($arrayName);

	}
}
?>