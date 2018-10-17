<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\Brand;
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
		$list = $Brand ->select();
		if($list === false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $list, 'msg' => '查询成功');
		}
		return json($arrayName);

	}
}
?>