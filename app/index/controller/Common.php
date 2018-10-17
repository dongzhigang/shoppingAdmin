<?php 
namespace app\index\Controller;
use think\Controller;
/**
 * 公共函数
 */
class Common extends Controller
{
	
	
	//订单编号
	public function  orderNo()
	{
		$order_date  = date('YmdHis');
		//订单号码主体（YYYYMMDDHHIISSNNNNNNNN）
		$order_id_main = $order_date . rand(10000000,99999999);
		$order_id_len = strlen($order_id_main);
		$order_id_sum = 0; 
		for($i=0; $i<$order_id_len; $i++){
			$order_id_sum += substr($order_id_main,$i,1);
		} 
		//唯一订单号码（YYYYMMDDHHIISSNNNNNNNNCC） 
		$order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
		return $order_id;
	}

	//单个文件上传
	public function fileUploads()
	{

		// 获取表单上传文件 例如上传了001.jpg
		$images = array();
		$errors = array();
	    $files = request()->file();
	    if($files){
		    foreach ($files as $key => $file) {
		    	$info = $file->rule('uniqid')->move('public/images/tem/');
		        if($info){
		            // 成功上传后 获取上传信息
		            // 输出 jpg
		            // return $info->getExtension();
		            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
		            // return 'uploads/images/'.$info->getSaveName();
		            // 输出 42a79759f284b767dfcb2a0197904287.jpg
		            $str = $info->getSaveName();
		            $path = 'public/images/tem/'.str_replace('\\',"/",$str);
		        }else{
		            // 上传失败获取错误信息
		            $errors = $file->getError();
		        }
		    }
	    }
	    if(!$errors){
			$msg['code'] = 0;
			$msg['data'] = $path;
			return json($msg);
		}else{
			$msg['code'] = -1;
			$msg['data'] = $errors;
			$msg['msg'] = "上传出错";
			return json($msg);
		}
	}
	//更换目录
	public function change($name,$img) 
	{	
		$path = str_replace('/tem',$name,$img);
		$arr = explode('/',$path);
		// array_splice($arr,0,4);
		array_splice($arr,-1);
		$str  = implode('/',$arr);						//新的目录
		if(!is_dir($str)){
			mkdir($str);
		}
		//移动文件
		$img = explode('/',$img);
		array_splice($img,0,4);
		$img  = implode('/',$img);						//新的路径
		$path2 = explode('/',$path);
		array_splice($path2,0,4);
		$path2  = implode('/',$path2);					//新的路径
		if(file_exists($img)){
			rename($img,$path2);
		}
		return $path;
	}
}
?>