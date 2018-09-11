<?php 
namespace app\index\Controller;
use think\Controller;
use app\index\Model\Antistop;
/**
 * 关键词接口
 */
class Keyword extends Controller
{
	//热门关键词
	public function hotKeyword()
	{ 
		$Antistop = new Antistop;
		$hotKeywordList = $Antistop ->where('isHot',1) -> select();
		$defaultKeyword	= $Antistop ->where('isDefault',1) -> find();	//默认关键词
		$data = Array(
			'hotKeywordList'	=>	$hotKeywordList,
			'defaultKeyword'	=>	$defaultKeyword
		);
		if($Antistop){
			$arrayName = array('code' => 0,'data' => $data ,'msg' => "加载成功" );
		}else{
			$arrayName = array('code' => -1,'data' => array('') ,'msg' => "加载失败" );
		}
		return json($arrayName);
	}
}
?>