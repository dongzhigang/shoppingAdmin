<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\Advertis;
use app\admin\Controller\Common;
/**
 * 广告接口
 */
class Advertiss extends Controller
{
	//广告列表
	public function advertisList()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Advertis = new Advertis;
		$page = $_REQUEST['page'];
		$rows = $_REQUEST['rows'];
		$list = $Advertis ->page($page,$rows) ->select();
		$count = $Advertis ->count();
		$data = Array(
			'list'	=>	$list,
			'count'	=>	$count
		);
		if($list){
			$arrayName = Array('code' => 0, 'data' => $data, 'msg' => '查询成功');
		}else{
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}
		return json($arrayName);
	}
	//广告添加
	public function createData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Advertis = new Advertis;
		$Common	= new Common;
		$advertisPath = '/advertis';

		$title	  =	$_REQUEST['title'];
		$content  = $_REQUEST['content'];
		$img	  =	$_REQUEST['img'];
		$path     = $_REQUEST['path'];
		$start    = $_REQUEST['start'];
		$location = $_REQUEST['location'];

		if($img){
			$img = $Common ->change($advertisPath,$img);
		}
		$data = Array(
			'advertis_id' => md5(uniqid(md5(microtime(true)),true)),
			'title' => $title,
			'content' => $content,
			'img' => $img,
			'path' => $path,
			'start' => $start,
			'location' => $location
		);
		$res = $Advertis ->save($data);
		if($res){
			$arrayName = Array('code' => 0, 'data' => $res, 'msg' => '查询成功');
		}else{
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}
		return json($arrayName);
	}
	//广告更新
	public function updateData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Advertis = new Advertis;
		$Common	= new Common;
		$advertisPath = '/advertis';

		$advertis_id = $_REQUEST['advertis_id'];
		$title	  =	$_REQUEST['title'];
		$content  = $_REQUEST['content'];
		$img	  =	$_REQUEST['img'];
		$path     = $_REQUEST['path'];
		$start    = $_REQUEST['start'];
		$location = $_REQUEST['location'];

		$findImg = $Advertis ->where('advertis_id',$advertis_id) ->find() ->img;
		if($findImg !== $img){
			$Common ->unlink($findImg);
			$img = $Common ->change($advertisPath,$img);
		}
		$data = Array(
			'title' => $title,
			'content' => $content,
			'img' => $img,
			'path' => $path,
			'start' => $start,
			'location' => $location
		);
		$res = $Advertis ->where('advertis_id',$advertis_id) ->update($data);
		if($res === false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '新增失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => Array(), 'msg' => '新增成功');
		}
		return json($arrayName);
	}
	//广告删除
	public function deleteData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Advertis = new Advertis;
		$Common	= new Common;
		$advertis_id = $_REQUEST['advertis_id'];
		$findImg = $Advertis ->where('advertis_id',$advertis_id) ->find() ->img;
		$Common ->unlink($findImg);
		$res = $Advertis ->where('advertis_id',$advertis_id) ->delete();
		if($res === false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '新增失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => Array(), 'msg' => '新增成功');
		}
		return json($arrayName);
	}
	
	//广告信息
	public function categoryMsg()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Advertis = new Advertis;
		$advertis_id = $_REQUEST['advertis_id'];

		$find = $Advertis ->where('advertis_id',$advertis_id) ->find();
		if($find){
			$arrayName = Array('code' => 0, 'data' => $find, 'msg' => '查询成功');
		}else{
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}
		return json($arrayName);
	}

	//模糊搜索，title，content
	public function grabbleData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$title 		 = $_REQUEST['title'];
		$content 	 = $_REQUEST['content'];
		$map['title']	 = ['like','%'.$title.'%'];
		$map['content']	 = ['like','%'.$content.'%'];
		$Advertis = new Advertis;
		$List = $Advertis ->where($map)->select();
		$count = $Advertis ->where($map)->count();
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