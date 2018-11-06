<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\Brand;
use app\admin\Controller\Common;
/**
 * 品牌接口
 */
class Brands extends Controller
{
	//品牌列表
	public function brandList()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Brand = new Brand;
		if(isset($_REQUEST['page']) && isset($_REQUEST['rows'])){
			$page = $_REQUEST['page'];
			$rows = $_REQUEST['rows'];
		}else{
			$page = 0;
			$rows = 0;
		}
		$list = $Brand ->page($page,$rows) ->select();
		$count 		= 	$Brand -> count();
		$data 		= 	Array(
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
	//添加品跑商
	public function createData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Brand  = new Brand;
		$Common = new Common;
		$brandPath = '/brand';

		$brand_name = $_REQUEST['brand_name'];
		$docs = $_REQUEST['docs'];
		$icon = $_REQUEST['icon'];
		$img = $_REQUEST['img'];
		$bot_price = $_REQUEST['bot_price'];

		if($img){
			$img = $Common ->change($brandPath,$img);
		}
		if($icon){
			$icon = $Common ->change($brandPath,$icon);
		}
		$data = Array(
			'brand_id' => md5(uniqid(md5(microtime(true)),true)),
			'brand_name' => $brand_name,
			'docs' =>$docs,
			'icon' => $icon,
			'img' => $img,
			'bot_price' => $bot_price
		);
		$res = $Brand ->save($data);
		if($res){
			$arrayName = Array('code' => 0, 'data' => Array(), 'msg' => '查询成功');
		}else{
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}
		return json($arrayName);
	}
	//品牌商更新
	public function updateData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Brand = new Brand;
		$Common = new Common;
		$brandPath = '/brand';

		$brand_id = $_REQUEST['brand_id'];
		$brand_name = $_REQUEST['brand_name'];
		$docs = $_REQUEST['docs'];
		$icon = $_REQUEST['icon'];
		$img = $_REQUEST['img'];
		$bot_price = $_REQUEST['bot_price'];

		$imgUrl = $Brand -> where('brand_id',$brand_id) ->find();
		if($imgUrl->img !== $img){
			$Common ->unlink($imgUrl->img);
			$img = $Common ->change($brandPath,$img);
		}
		if($imgUrl->icon !== $icon){
			$Common ->unlink($imgUrl->icon);
			$icon = $Common ->change($brandPath,$icon);
		}
		$data = Array(
			'brand_name' => $brand_name,
			'docs' =>$docs,
			'icon' => $icon,
			'img' => $img,
			'bot_price' => $bot_price
		);		
		$res = $Brand ->where('brand_id',$brand_id) ->update($data);
		if($res === false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '新增失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => Array(), 'msg' => '新增成功');
		}
		return json($arrayName);
	}
	//品牌商删除
	public function deleteData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Brand  = new Brand;
		$Common = new Common;

		$brand_id = $_REQUEST['brand_id'];
		$imgUrl = $Brand -> where('brand_id',$brand_id) ->find();
		if($imgUrl->img){
			$Common ->unlink($imgUrl->img);
		}
		if($imgUrl->icon){
			$Common ->unlink($imgUrl->icon);
		}
		$res = $Brand ->where('brand_id',$brand_id) ->delete();
		if($res === false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '删除失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => Array(), 'msg' => '删除成功');
		}
		return json($arrayName);
	}
	//品牌商信息
	public function categoryMsg()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Brand = new Brand;
		$brand_id = $_REQUEST['brand_id'];
		$find = $Brand -> where('brand_id',$brand_id) ->find();
		if($find){
			$arrayName = Array('code' => 0, 'data' => $find, 'msg' => '查询成功');
		}else{
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}
		return json($arrayName);
	}
	//模糊搜索，brand_id，brand_name
	public function grabbleData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$brand_id 		 = $_REQUEST['brand_id'];
		$brand_name 	 = $_REQUEST['brand_name'];
		$map['brand_id']	 = ['like','%'.$brand_id.'%'];
		$map['brand_name']	 = ['like','%'.$brand_name.'%'];
		$Brand = new Brand;
		$List = $Brand ->where($map)->select();
		$count = $Brand ->where($map)->count();
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