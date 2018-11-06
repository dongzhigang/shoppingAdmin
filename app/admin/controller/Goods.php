<?php 
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\ProductMsg;
use app\admin\Controller\Common;
/**
 * 商品接口
 */
class Goods extends Controller
{
	
	//查询商品列表,请求参数，page,rows
	public function fetchList()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$ProductMsg = 	new ProductMsg;
		$page 		=	$_REQUEST['page'];
		$rows		=	$_REQUEST['rows'];
		$list 		=	$ProductMsg ->with('Master') ->page($page,$rows)->select();
		$count 		= 	$ProductMsg -> count();
		$data 		= 	Array(
			'list'	=>	$list,
			'count'	=>	$count
		);
		if($list = false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '查询失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $data, 'msg' => '查询成功');
		}
		return json($arrayName);
	}
	//新增商品
	public function createData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		$ProductMsg = 	new ProductMsg;
		$Common		=	new Common;
		$product_id =	md5(uniqid(md5(microtime(true)),true));
		$number		=	$_REQUEST['number'];							//商品编号
		$name   	=   $_REQUEST['name'];								//商品名称
		$shop_price =   $_REQUEST['shop_price'];						//专柜价格（原价）
		$at_price	=	$_REQUEST['at_price'];							//当前价格
		$docs		=	$_REQUEST['docs'];								//商品简介
		$unit		=	$_REQUEST['unit'];								//商品單位
		$img		=	$_REQUEST['img'];								//商品缩略图
		$master		=	$_REQUEST['master'];							//商品宣传图
		$antistop	=	$_REQUEST['antistop'];							//关键词
		$Cate_id	=	$_REQUEST['Cate_id'];							//一类目id
		$Sort_id	=	$_REQUEST['Sort_id'];							//二类目id
		$brand_id	=	$_REQUEST['brand_id'];							//品牌id
		$new_product=	$_REQUEST['new_product'];						//新品
		$hot_sale	=	$_REQUEST['hot_sale'];							//热卖
		$sell		=	$_REQUEST['sell'];								//在售
		$speci		=	$_REQUEST['speci'];								//商品规格
		$sku		=	$_REQUEST['sku'];								//商品库存
		$parameter	=	$_REQUEST['parameter'];							//商品参数
		$contents	=	$_REQUEST['contents'];							//商品详情
		$contentsPath	=	$_REQUEST['contentsPath'];					//商品详情图片路径

		$thumbnail         = "/thumbnail";								//缩略图目录
		$masterName   = "/master";                                      //宣传图目录
		$contentsName = "/contents";                                    //详情图目录
		$propertyName = "/property";									//规格图片目录
		$skuName	  = "/sku";											//库存图片目录
		if(!empty($img)){
			$img = $Common ->change($thumbnail,$img);                   //更新缩略图路径
		}
		//数组转字符串
		if(!empty($antistop)){
			$antistop = implode(',',$antistop);
		}
		//保存商品信息
		$data = Array(
			'product_id'	=>	$product_id,
			'Cate_id'		=>	$Cate_id,
			'Sort_id'		=>	$Sort_id,
			'number'		=>	$number,
			'name'			=>	$name,
			'shop_price'	=>	$shop_price,
			'at_price'		=>	$at_price,
			'docs'			=>	$docs,
			'unit'			=>	$unit,
			'img'			=>	$img,
			'new_product'	=>	$new_product,
			'hot_sale'		=>	$hot_sale,
			'sell'			=>	$sell,
			'antistop'		=>	$antistop,
			'brand_id'		=>	$brand_id,
			'time_create'	=>	date('Y-m-d H-i-s')
		);
		$res = $ProductMsg ->save($data);
		if($res){
			//保存主图
			if(!empty($master)){
				$Master = [];
				foreach ($master as $key => $value) {
					$value = $Common ->change($masterName,$value);
					$data  = Array(
						'master_id'		=>	md5(uniqid(md5(microtime(true)),true)),
						'product_id'	=>	$product_id,
						'path_img'		=>	$value,
						'time_create'	=>	date('Y-m-d H-i-s'),
					);
					$Master[$key]	=	$data;
				}
				$res = $ProductMsg ->Master() ->insertAll($Master);
			}
			//保存详情图
			if(!empty($contentsPath)){
				$ContentsImg = [];
				foreach ($contentsPath as $key => $value) {
					$value = $Common ->change($contentsName,$value);
					$data = Array(
						'product_id'	=>	$product_id,
						'imgPath'		=>	$value,
						'time_create'	=>	date('Y-m-d H-i-s')
					);
					$ContentsImg[$key]	=	$data;
				}
				$res = $ProductMsg ->ContentsImg() ->insertAll($ContentsImg);
			}
			$contents = str_replace("/tem",$contentsName,$contents);
			$data = Array(
				'product_id'	=>	$product_id,
				'contents'		=>	$contents
			);
			$res = $ProductMsg ->Contents() ->save($data);
			//保存规格
			if(!empty($speci)){
				$PropertyData = [];
				$nameData = [];
				$valueData = [];
				$skuData = [];
				foreach ($speci as $key => $value) {
					$name = Array(
						'product_id'	=>	$product_id,
						'name'			=>	$value['name'],
						'name_id'		=>	md5(uniqid(md5(microtime(true)),true))
					);
					$propertyImg = $value['img'];
					//保存规格图片
					if(!empty($propertyImg)){
						$propertyImg = $Common ->change($propertyName,$propertyImg);
					}
					$value = Array(
						'value_id'		=>	md5(uniqid(md5(microtime(true)),true)),
						'name_id'		=>	$name['name_id'],
						'value'			=>	$value['value'],
						'img'			=>	$propertyImg
					);
					$Property = Array(
						'property_id'	=>	md5(uniqid(md5(microtime(true)),true)),
						'product_id'	=>	$product_id,
						'name_id'		=>	$name['name_id'],
						'value_id'		=>	$value['value_id']
					);
					$nameData[$key] = $name;
					$PropertyData[$key] = $Property;
					$valueData[$key] = $value;
					//保存库存
					if(!empty($sku)){
						$skuImg =$sku[$key]['img'];
						//保存库存图片
						if(!empty($skuImg)){
							$skuImg = $Common ->change($skuName,$skuImg);
						}
						$skuArr = Array(
							'sku_id'		=>	md5(uniqid(md5(microtime(true)),true)),
							'product_id'	=>	$product_id,
							'property_id'	=>	$Property['property_id'],
							'selling_price'	=>	$sku[$key]['selling_price'],
							'count'			=>	$sku[$key]['count'],
							'img'			=>	$skuImg,
							'name'			=>	$sku[$key]['name']
						);
						$skuData[$key] = $skuArr;
					}
				}
				$Property = $ProductMsg ->Property() ->insertAll($PropertyData);
				$name = $ProductMsg ->names() ->insertAll($nameData);
				$value = $ProductMsg ->names()->find() ->Value() ->insertAll($valueData);
				$skuRes = $ProductMsg ->sku() ->insertAll($skuData);

			}
			//保存参数
			if(!empty($parameter)){
				$parameterData = [];
				foreach ($parameter as $key => $value) {
					$parameterArr = Array(
						'parameter_id'	=>	md5(uniqid(md5(microtime(true)),true)),
						'product_id'	=>	$product_id,
						'name'			=>	$value['name'],
						'value'			=>	$value['value'],
					);
					$parameterData[$key] = $parameterArr;
				}
				$parameterRes = $ProductMsg ->parameter() ->insertAll($parameterData);
			}
			$arrayName = Array('code' => 0, 'data' => Array('product_id' => $product_id), 'msg' => '新增成功');
		}else{
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '新增失败');
		}
		return json($arrayName);
	}
	//更新商品
	public function updateData(){
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		$ProductMsg = 	new ProductMsg;
		$Common		=	new Common;

		$product_id =	$_REQUEST['product_id'];
		$number		=	$_REQUEST['number'];							//商品编号
		$name   	=   $_REQUEST['name'];								//商品名称
		$shop_price =   $_REQUEST['shop_price'];						//专柜价格（原价）
		$at_price	=	$_REQUEST['at_price'];							//当前价格
		$docs		=	$_REQUEST['docs'];								//商品简介
		$unit		=	$_REQUEST['unit'];								//商品單位
		$img		=	$_REQUEST['img'];								//商品缩略图
		$master		=	$_REQUEST['master'];							//商品宣传图
		$antistop	=	$_REQUEST['antistop'];							//关键词
		$Cate_id	=	$_REQUEST['Cate_id'];							//一类目id
		$Sort_id	=	$_REQUEST['Sort_id'];							//二类目id
		$brand_id	=	$_REQUEST['brand_id'];							//品牌id
		$new_product=	$_REQUEST['new_product'];						//新品
		$hot_sale	=	$_REQUEST['hot_sale'];							//热卖
		$sell		=	$_REQUEST['sell'];								//在售
		$speci		=	$_REQUEST['speci'];								//商品规格
		$sku		=	$_REQUEST['sku'];								//商品库存
		$parameter	=	$_REQUEST['parameter'];							//商品参数
		$contents	=	$_REQUEST['contents'];							//商品详情
		$contentsPath	=	$_REQUEST['contentsPath'];					//商品详情图片路径

		$thumbnail         = "/thumbnail";								//缩略图目录
		$masterName   = "/master";                                      //宣传图目录
		$contentsName = "/contents";                                    //详情图目录
		$propertyName = "/property";									//规格图片目录
		$skuName	  = "/sku";											//库存图片目录

		$term = ['product_id'=>$product_id];
		//关键词数组转字符串
		if(!empty($antistop)){
			$antistop = implode(',',$antistop);
		}
		$find =  $ProductMsg ->where(['product_id'=>$product_id]) ->find();
		//判断商品缩略图是否有上传
		if($find->img != $img){
			//删除图片
            $Common -> unlink($find->img);
			$img = $Common ->change($thumbnail,$img);                   //更新缩略图路径
		}
		//更新商品信息数据
		$data = Array(
			'Cate_id'		=>	$Cate_id,
			'Sort_id'		=>	$Sort_id,
			'number'		=>	$number,
			'name'			=>	$name,
			'shop_price'	=>	$shop_price,
			'at_price'		=>	$at_price,
			'docs'			=>	$docs,
			'unit'			=>	$unit,
			'img'			=>	$img,
			'new_product'	=>	$new_product,
			'hot_sale'		=>	$hot_sale,
			'sell'			=>	$sell,
			'antistop'		=>	$antistop,
			'brand_id'		=>	$brand_id,
			'time_create'	=>	date('Y-m-d H-i-s')
		);
		//更新商品信息
		$res = $ProductMsg ->save($data,$term);
		if($res){
			//获取宣传图数据
			$MasterList = $ProductMsg ->Master() ->where($term) ->select();
			//存放数据库的图片路径临时数组  
			$Master = [];
			$myArray = [];
			if($MasterList){
				foreach ($MasterList as $key => $value) {
					array_push($myArray,$value->path_img);
				}
				if(!$master){
					$master = [];
				}
				//合并两个数组用来查询
				$result = array_unique(array_merge($master,$myArray));
				//取数据库图片的路径数组与合并数组的差集，得到上传图片的路径
				$diffUp = array_diff($result,$myArray);
				//取更新图片的路径与合并数组的差集，得到更新数据库图片的路径
				$diffDel = array_diff($result,$master);
				//删除数据库图片和数据
				if($diffDel){
					foreach ($diffDel as $key => $value) {
						//删除数据库图片和数据
					    $Common -> unlink($value);
					    $delete = Array(
							'path_img'	=>	$value
						);
						$res = $ProductMsg ->Master() ->where($delete)->delete();					
						
					}
				}
				//更新图片和数据
				if($diffUp){
					foreach ($diffUp as $key => $value) {
						//更新图片和数据
						$value = $Common ->change($masterName,$value);
						$data  = Array(
							'master_id'		=>	md5(uniqid(md5(microtime(true)),true)),
							'product_id'	=>	$product_id,
							'path_img'		=>	$value,
							'time_create'	=>	date('Y-m-d H-i-s'),
						);
						$Master[$key]	=	$data;
					}
				}
				$res = $ProductMsg ->Master() ->insertAll($Master);
			}else{//第一次保存
				//保存宣传图
				if(!empty($master)){
					foreach ($master as $key => $value) {
						$value = $Common ->change($masterName,$value);
						$data  = Array(
							'master_id'		=>	md5(uniqid(md5(microtime(true)),true)),
							'product_id'	=>	$product_id,
							'path_img'		=>	$value,
							'time_create'	=>	date('Y-m-d H-i-s'),
						);
						$Master[$key]	=	$data;
					}
					$res = $ProductMsg ->Master() ->insertAll($Master);
				}
			}
			//保存详情图
			$ContentsList = $ProductMsg ->ContentsImg() ->where($term) ->select();
			$ContentsArray = [];
			$ContentsImg = [];
			if($ContentsList){
				foreach ($ContentsList as $key => $value) {
					array_push($ContentsArray,$value->imgPath);
				}
				// if(!$contentsPath){
				// 	$contentsPath = [];
				// }
				//合并两个数组用来查询
				$result = array_unique(array_merge($contentsPath,$ContentsArray));
				//取数据库图片的路径数组与合并数组的差集，得到上传图片的路径
				$diffUp = array_diff($result,$ContentsArray);
				//取更新图片的路径与合并数组的差集，得到更新数据库图片的路径
				$diffDel = array_diff($result,$contentsPath);
				//删除数据库图片和数据
				if($diffDel){		
					foreach ($diffDel as $key => $value) {
						//删除数据库图片和数据
					    $Common -> unlink($value);
					    $delete = Array(
							'imgPath'	=>	$value
						);
						$res = $ProductMsg ->ContentsImg() ->where($delete)->delete();			
					}
				}
				//更新图片和数据
				if($diffUp){
					foreach ($diffUp as $key => $value) {
						//更新图片和数据
						$value = $Common ->change($contentsName,$value);
						$data  = Array(
							'product_id'	=>	$product_id,
							'imgPath'		=>	$value,
							'time_create'	=>	date('Y-m-d H-i-s'),
						);
						$ContentsImg[$key]	=	$data;
					}
					$res = $ProductMsg ->ContentsImg() ->insertAll($ContentsImg);
				} 
			}else{	//第一次保存图片
				if(!empty($contentsPath)){
					foreach ($contentsPath as $key => $value) {
						$value = $Common ->change($contentsName,$value);
						$data = Array(
							'product_id'	=>	$product_id,
							'imgPath'		=>	$value,
							'time_create'	=>	date('Y-m-d H-i-s')
						);
						$ContentsImg[$key]	=	$data;
					}
					$res = $ProductMsg ->ContentsImg() ->insertAll($ContentsImg);
				}
			}
			$contents = str_replace("/tem",$contentsName,$contents);
			$data = Array(
				'contents'		=>	$contents
			);
			$res = $ProductMsg ->Contents() ->where($term) ->update($data);  

			// 更新规格属性值
			$list = $ProductMsg ->Property() ->where($term) ->select();
			if($list){//$list查询不到说明没有属性
				$nameidArr = [];
				$nameidSpeci = [];
				foreach ($list as $k => $v) {
					array_push($nameidArr,$v->name_id);					
				}
				if($speci){					
					foreach ($speci as $key => $value) {
						//判断是否有属性id，没有是新增属性
						if($value['name_id']){
							array_push($nameidSpeci,$value['name_id']);
							//更新库存
							$skuRes = $ProductMsg ->sku() ->where('img',$sku[$key]['img']) ->find();
							//判断是否更新库存图片,$skuImg为false有更新
							if($skuRes === false){
								$skuImg = $ProductMsg ->sku() ->where('sku_id',$sku[$key]['sku_id']) ->find() ->img;
								//删除库存图片
					    		$Common -> unlink($skuImg);
					    		$skuImg =$sku[$key]['img'];
							}else{
								$skuImg =$sku[$key]['img'];
								//保存库存图片
								if(!empty($skuImg)){
									$skuImg = $Common ->change($skuName,$skuImg);
								}
							}
							$skuArr = Array(
								'selling_price'	=>	$sku[$key]['selling_price'],
								'count'			=>	$sku[$key]['count'],
								'img'			=>	$skuImg,
								'name'			=>	$sku[$key]['name']
							);
							$skuRes = $ProductMsg ->sku() ->where('sku_id',$sku[$key]['sku_id']) ->update($skuArr);
						}else{//新增属性
							$nameData = Array(
								'product_id'	=>	$product_id,
								'name'			=>	$value['name'],
								'name_id'		=>	md5(uniqid(md5(microtime(true)),true))
							);
							$propertyImg = $value['img'];
							//保存规格图片
							if(!empty($propertyImg)){
								$propertyImg = $Common ->change($propertyName,$propertyImg);
							}
							$valueData = Array(
								'value_id'		=>	md5(uniqid(md5(microtime(true)),true)),
								'name_id'		=>	$nameData['name_id'],
								'value'			=>	$value['value'],
								'img'			=>	$propertyImg
							);
							$Property = Array(
								'property_id'	=>	md5(uniqid(md5(microtime(true)),true)),
								'product_id'	=>	$product_id,
								'name_id'		=>	$nameData['name_id'],
								'value_id'		=>	$valueData['value_id']
							);
							//保存库存
							if(!empty($sku)){
								$skuImg =$sku[$key]['img'];
								//保存库存图片
								if(!empty($skuImg)){
									$skuImg = $Common ->change($skuName,$skuImg);
								}
								$skuArr = Array(
									'sku_id'		=>	md5(uniqid(md5(microtime(true)),true)),
									'product_id'	=>	$product_id,
									'property_id'	=>	$Property['property_id'],
									'selling_price'	=>	$sku[$key]['selling_price'],
									'count'			=>	$sku[$key]['count'],
									'img'			=>	$skuImg,
									'name'			=>	$sku[$key]['name']
								);
							}
							$res = $ProductMsg ->Property() ->insert($Property);
							$res = $ProductMsg ->names() ->insert($nameData);
							$res = $ProductMsg ->names()->find() ->Value() ->insert($valueData);
							$skuRes = $ProductMsg ->sku() ->insert($skuArr);
						}
					}
				}else{
					$nameidSpeci = Array();
				}
				//判断提交是否有删除属性库存，
				$result=array_diff($nameidArr,$nameidSpeci);
				if($result){
					foreach ($result as $key => $value) {
						$name_id = Array('name_id'=>$value);
						$img = $ProductMsg ->names() ->where($name_id) ->find() ->Value() ->where($name_id) ->find() ->img;
						$PropertyId = $ProductMsg ->Property() ->where($name_id) ->find() ->property_id;
						$skuImg = $ProductMsg ->sku() ->where('property_id',$PropertyId) ->find() ->img;
						if($img){
							//删除属性图片
					    	$Common -> unlink($img);
						}
						if($skuImg){
							//删除库存图片
					    	$Common -> unlink($skuImg);
						}
						//删除数据库数据
						$Property = $ProductMsg ->Property() ->where($name_id) ->delete();  
						$value = $ProductMsg ->names() ->where($name_id) ->find() ->Value() ->where($name_id) ->delete(); 
						$name = $ProductMsg ->names() ->where($name_id) ->delete();
						$sku = $ProductMsg ->sku() ->where('property_id',$PropertyId) ->delete();
					}
				}
			}else{	//第一次添加属性
				foreach ($speci as $key => $value) {
					$name = Array(
						'product_id'	=>	$product_id,
						'name'			=>	$value['name'],
						'name_id'		=>	md5(uniqid(md5(microtime(true)),true))
					);
					$propertyImg = $value['img'];
					//保存规格图片
					if(!empty($propertyImg)){
						$propertyImg = $Common ->change($propertyName,$propertyImg);
					}
					$value = Array(
						'value_id'		=>	md5(uniqid(md5(microtime(true)),true)),
						'name_id'		=>	$name['name_id'],
						'value'			=>	$value['value'],
						'img'			=>	$propertyImg
					);
					$Property = Array(
						'property_id'	=>	md5(uniqid(md5(microtime(true)),true)),
						'product_id'	=>	$product_id,
						'name_id'		=>	$name['name_id'],
						'value_id'		=>	$value['value_id']
					);
					$nameData[$key] = $name;
					$PropertyData[$key] = $Property;
					$valueData[$key] = $value;
					//保存库存
					if(!empty($sku)){
						$skuImg =$sku[$key]['img'];
						//保存库存图片
						if(!empty($skuImg)){
							$skuImg = $Common ->change($skuName,$skuImg);
						}
						$skuArr = Array(
							'sku_id'		=>	md5(uniqid(md5(microtime(true)),true)),
							'product_id'	=>	$product_id,
							'property_id'	=>	$Property['property_id'],
							'selling_price'	=>	$sku[$key]['selling_price'],
							'count'			=>	$sku[$key]['count'],
							'img'			=>	$skuImg,
							'name'			=>	$sku[$key]['name']
						);
						$skuData[$key] = $skuArr;
					}
				}
				$Property = $ProductMsg ->Property() ->insertAll($PropertyData);
				$name = $ProductMsg ->names() ->insertAll($nameData);
				$value = $ProductMsg ->names()->find() ->Value() ->insertAll($valueData);
				$skuRes = $ProductMsg ->sku() ->insertAll($skuData);
				// 更新库存
				$skuRes = $ProductMsg ->sku() ->insertAll($skuArr);
			}
			//更新参数
			if($parameter){
				$arr = Array();
				$myArr = Array();
				$list = $ProductMsg ->parameter() ->where($term) ->select();
				foreach ($list as $k => $v) {
					array_push($myArr,$v->parameter_id);
				}
				$parameterData = [];
				foreach ($parameter as $k => $v) {
					if(!$v['parameter_id']){
						$parameterArr = Array(
							'parameter_id'	=>	md5(uniqid(md5(microtime(true)),true)),
							'product_id'	=>	$product_id,
							'name'			=>	$v['name'],
							'value'			=>	$v['value'],
						);
						$parameterData[$k] = $parameterArr;
					}else{
						array_push($arr,$v['parameter_id']);
					}
				}
				//判断提交是否有删除参数，
				$result=array_diff($myArr,$arr);
				if($result){
					foreach ($result as $k => $v) {
						$del = $ProductMsg ->parameter() ->where('parameter_id',$v) ->delete();
					}
				}
				$parameterRes = $ProductMsg ->parameter() ->insertAll($parameterData);
			}			
			$arrayName = Array('code' => 0, 'data' => Array(), 'msg' => '更新成功');
		}else{
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '更新失败');
		}
		return json($arrayName);
	}
	//删除商品
	public function deleteData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$ProductMsg = 	new ProductMsg;
		$Common		=	new Common;
		$product_id = $_REQUEST['product_id'];
		$data = Array("product_id"=>$product_id);
		$res = $ProductMsg ->where($data)->find();
		//删除缩略图文件
		if($res->img){
			$Common -> unlink($res->img);
		}
		//删除商品信息
		$res = $ProductMsg -> where($data)->delete();
		if($res === false){
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '删除失败');
		}else{
			//删除宣传图文件
			$res = $ProductMsg ->Master() ->where($data)->select();
			if($res){
				foreach ($res as $key => $value) {
					if($value->path_img){
						$Common -> unlink($value->path_img);
					}
				}
			}
			//删除详情图文件
			$res = $ProductMsg ->ContentsImg() ->where($data) ->select();
			if($res){
				foreach ($res as $key => $value) {
					if($value->imgPath){
						$Common -> unlink($value->imgPath);
					}
				}
			}
			//删除规格图文件
			$res = $ProductMsg ->Property() ->where($data) ->select();
			if($res){
				foreach ($res as $key => $value) {
					$valueData = Array("value_id"=>$value->value_id);
					$val = $ProductMsg ->names() ->where("name_id",$value->name_id)->find() ->Value() ->where($valueData) ->find();
					if($val){
						if($val->img){
							$Common -> unlink($val->img);
						}
					}
					//删除规格值数据
					$val = $ProductMsg ->names() ->where("name_id",$value->name_id)->find() ->Value() ->where($valueData)->delete();
				}
			}
			//删除库存图文件
			$res = $ProductMsg ->sku() ->where($data) ->select();
			if($res){
				foreach ($res as $key => $value) {
					if($value->img){
						$Common -> unlink($value->img);
					}
				}
			}

			//删除主图数据
			$res = $ProductMsg ->Master() ->where($data)->delete();
			//删除详情图数据
			$res = $ProductMsg ->ContentsImg() ->where($data)->delete();
			//删除详情数据
			$res = $ProductMsg ->Contents() ->where($data)->delete();
			//删除属性、属性值、商品关联
			$Property = $ProductMsg ->Property()  ->where($data)->delete();
			//删除规格数据
			$name = $ProductMsg ->names()  ->where($data)->delete();
			//删除库存数据
			$skuRes = $ProductMsg ->sku()  ->where($data)->delete();
			//删除参数数据
			$parameterRes = $ProductMsg ->parameter() ->where($data)->delete();

			$arrayName = Array('code' => 0, 'data' => Array(), 'msg' => '删除成功');
		}
		return json($arrayName);

	}
	//商品信息
	public function goodsMsg()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$ProductMsg = 	new ProductMsg;
		$Common		=	new Common;
		$product_id	= $_REQUEST['product_id'];
		$list = $ProductMsg ->where('product_id',$product_id) ->with(['Master','Contents','ContentsImg','names'=>['value'],'parameter','sku']) ->find();
		if(!$list){
			$arrayName = Array('code' => 0, 'data' => Array(), 'msg' => '失败');
		}else{
			$arrayName = Array('code' => 0, 'data' => $list, 'msg' => '成功');
		}
		return json($arrayName);
	}

	// 商品详情
	public function goodsInfo()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$ProductMsg = 	new ProductMsg;
		$product_id = $_REQUEST['product_id'];
		$info = $ProductMsg ->Contents() ->where('product_id',$product_id) ->find();
		// return json($info);
		if($info){
			$arrayName = Array('code' => 0, 'data' => $info, 'msg' => '新增成功');
		}else{			
			$arrayName = Array('code' => -1, 'data' => Array(), 'msg' => '新增失败');
		}
		return json($arrayName);

	}

	//模糊搜索，user_id，name
	public function grabbleData()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$number 		 = $_REQUEST['number'];
		$name 			 = $_REQUEST['name'];
		$product_id		 = $_REQUEST['product_id'];
		$map['number']	 = ['like','%'.$number.'%'];
		$map['name']	 = ['like','%'.$name.'%'];
		$map['product_id']	 = ['like','%'.$product_id.'%'];
		$ProductMsg = new ProductMsg;
		$List = $ProductMsg ->where($map)->select();
		$count = $ProductMsg ->where($map)->count();
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