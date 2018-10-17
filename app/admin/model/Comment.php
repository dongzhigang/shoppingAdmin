<?php 
namespace app\admin\Model;
use think\Model;
/**
 * 商品评论表
 */
class Comment extends Model
{
	public function commentImg()
	{
		return $this->hasMany('CommentImg','comment_id','comment_id');
	}
}
?>