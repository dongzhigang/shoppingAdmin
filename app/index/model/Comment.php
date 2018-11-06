<?php 
namespace app\index\Model;
use think\Model;
/**
 * 评论表
 */
class Comment extends Model
{
	//关联评论图片表
    public function commentImg()
	{
		return $this->hasMany('CommentImg','comment_id','comment_id'); 
	}
	//关联用户表
    public function user()
	{
		return $this->belongsTo('User','user_id','user_id'); 
	}
}
?>