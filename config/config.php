<?php
	return [
		//开启调试，
		'app_debug' => true,
		'view_replace_str'  =>  [
		    '__PUBLIC__'=>dirname($_SERVER['SCRIPT_NAME']).'/public',
		    '__ROOT__' => '/thinkPHP/',			//目录
		],
	]

?>