<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\Cate;
use app\admin\Controller\Common;
/**
 * 类目接口
 */
class Category extends Controller
{
	//类目列表
	public function classList()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		
		$Cate = new Cate;
		$list = $Cate ->with('children') ->select();
		$count 		= 	$Cate -> count();
		$data 		= 	Array(
			'list'	=>	$list,
			'count'	=>	$count
		);
		if($list === false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $data, 'msg' => '查询成功');
		}
		return json($arrayName);
	}
	//类目添加
	public function createData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		
		$Cate 		=	new Cate;
		$Common		=	new Common;
		$grade 		=	$_REQUEST['grade'];
		$name		=	$_REQUEST['name'];
		$icon		=	$_REQUEST['icon'];
		$img		=	$_REQUEST['img'];
		$docs		=	$_REQUEST['docs'];

		$classify	=	'/classify';		//类目图片路径
		//保存到一级类目
		if($grade == 1){
			//保存类目图片
			if($img){
				$img = $Common ->change($classify,$img);
			}
			if($icon){
				$icon = $Common ->change($classify,$icon);
			}
			$data = Array(
				'Cate_id'	=>	md5(uniqid(md5(microtime(true)),true)),
				'Cate_name'	=>	$name,
				'icon'		=>	$icon, 
				'img'		=>	$img,
				'docs'		=>	$docs,
				'grade'		=>	$grade
			);
			$res = $Cate ->save($data);
		}else{//保存到二级类目
			//保存类目图片
			if($img){
				$img = $Common ->change($classify,$img);
			}
			if($icon){
				$icon = $Common ->change($classify,$icon);
			}
			$data = Array(
				'Cate_id'	=>	$_REQUEST['Cate_id'],
				'Sort_id'	=>	md5(uniqid(md5(microtime(true)),true)),
				'Sort_name'	=>	$name,
				'icon'		=>	$icon, 
				'img'		=>	$img,
				'docs'		=>	$docs,
				'grade'		=>	$grade
			);
			$res = $Cate ->children() ->insert($data);
		}
		if($res){
			$arrayName = Array('code' => 0, "data" => $res, "msg" => "添加成功");
		}else{
			$arrayName = Array('code' => -1, "data" => Array(), "msg" => "添加失败");
		}
		return json($arrayName);
	}
	//类目更新
	public function updateData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		
		$Cate 		=	new Cate;
		$Common		=	new Common;
		$grade 		=	$_REQUEST['grade'];
		$name		=	$_REQUEST['name'];
		$icon		=	$_REQUEST['icon'];
		$img		=	$_REQUEST['img'];
		$docs		=	$_REQUEST['docs'];
		//保存到一级类目
		if($grade == 1){
			$find	=	$Cate ->where('Cate_id',$_REQUEST['Cate_id']) ->find();
			if($find->img != $img){//判断是否有更新图片
				$Common ->unlink($find->img);
			}
			if($find->icon != $icon){//判断是否有更新图标
				$Common ->unlink($find->icon);
			}
			$data = Array(
				'Cate_name' =>	$name,
				'icon'		=>	$icon,
				'img'		=>	$img,
				'docs'		=>	$docs,
			);
			$res = $Cate ->where('Cate_id',$Cate_id) ->update($data);
		}else{//保存到二级类目
			$find	=	$Cate ->where('Sort_id',$_REQUEST['Sort_id']) ->find();
			if($find->img != $img){//判断是否有更新图片
				$Common ->unlink($find->img);
			}
			if($find->icon != $icon){//判断是否有更新图标
				$Common ->unlink($find->icon);
			}
			$data = Array(
				'Sort_name' =>	$name,
				'icon'		=>	$icon,
				'img'		=>	$img,
				'docs'		=>	$docs,
			);
			$res = $Cate ->where('Sort_id',$Sort_id) ->update($data);
		}
		return json($res);
		if($res===false){
			$arrayName = Array('code' => -1, "data" => Array(), "msg" => "添加失败");
		}else{
			$arrayName = Array('code' => 0, "data" => $res, "msg" => "添加成功");
		}
		return json($arrayName);
	}
	//一级类目删除
	public function deleteData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Cate = new Cate;
		$Common = new Common;
		$Cate_id = $_REQUEST['Cate_id'];
		$CateSelect = $Cate ->where('Cate_id',$Cate_id) ->select();
		$select = $Cate ->children() ->where('Cate_id',$Cate_id) ->select();
		if($select){
			foreach ($select as $k => $v) {
				if($v->img){
					$Common ->unlink($v->img);
				}
				if($v->icon){
					$Common ->unlink($v->icon);
				}
			}
		}
		if($CateSelect){
			foreach ($CateSelect as $k => $v) {
				if($v->img){
					$Common ->unlink($v->img);
				}
				if($v->icon){
					$Common ->unlink($v->icon);
				}
			}
		}
		$res = $Cate ->children() ->where('Cate_id',$Cate_id) ->delete();
		$res = $Cate ->where('Cate_id',$Cate_id) ->delete();
		if($res === false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => Array(), 'msg' => '查询成功');
		}
		return json($arrayName);
	}
	//二级类目删除
	public function twoDeleteData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Cate = new Cate;
		$Common = new Common;
		$Sort_id = $_REQUEST['Sort_id'];
		$select = $Cate ->children() ->where('Sort_id',$Sort_id) ->select();
		if($select){
			foreach ($select as $k => $v) {
				if($v->img){
					$Common ->unlink($v->img);
				}
				if($v->icon){
					$Common ->unlink($v->icon);
				}
			}
		}
		$res = $Cate ->children() ->where('Sort_id',$Sort_id) ->delete();
		if($res === false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => Array(), 'msg' => '查询成功');
		}
		return json($arrayName);
	}
	//类目信息
	public function categoryMsg()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Cate = new Cate;
		if(isset($_REQUEST['Cate_id'])){
			$find = $Cate ->where('Cate_id',$_REQUEST['Cate_id']) ->find();
		}
		if(isset($_REQUEST['Sort_id'])){
			$find = $Cate ->children() ->where('Sort_id',$_REQUEST['Sort_id']) ->find();
		}
		if($find){
			$arrayName = Array('code' => 0, 'data' => $find, 'msg' => '查询成功');
		}else{
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}
		return json($arrayName);
	}

	//模糊搜索，Cate_id，Cate_name
	public function grabbleData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$Cate_id 		 = $_REQUEST['Cate_id'];
		$Cate_name 			 = $_REQUEST['Cate_name'];
		$map['Cate_id']	 = ['like','%'.$Cate_id.'%'];
		$map['Cate_name']	 = ['like','%'.$Cate_name.'%'];
		$Cate = new Cate;
		$List = $Cate ->where($map)->select();
		$count = $Cate ->where($map)->count();
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