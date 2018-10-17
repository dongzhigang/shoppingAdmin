<?php 
namespace app\admin\Controller;;
use think\Controller;
class Common extends Controller
{
	//单个文件上传
	public function fileUploads()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		// 获取表单上传文件 例如上传了001.jpg
		$images = array();
		$errors = array();
	    $files = request()->file();
	    // dump($files);
	    // exit;
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
		            array_push($images,$path);
		        }else{
		            // 上传失败获取错误信息
		            array_push($errors,$file->getError());
		        }
		    }
	    }
	    if(!$errors){
			$msg['code'] = 0;
			$msg['data'] = $images;
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
	//删除文件
	public function unlink($path)
	{
		if(isset($path)){
			$arr = explode('/',$path);
			array_splice($arr,0,4);
			$str  = implode('/',$arr);						//新的目录
			if(file_exists($str)){
				unlink($str);
			}
		}
	}
}
?>