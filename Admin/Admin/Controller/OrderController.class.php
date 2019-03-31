<?php 

namespace Admin\Controller;

use Admin\Controller\IndexController;

class OrderController extends IndexController {


//二维码添加方法
public function addss($url="http://www.xxoo.com/oo/id/",$level=L,$size=3)
{
	
  
		// if(IS_POST){

		 
        	// $model['name']=I('name');
			// $size=I('size'); 
			// $url=I('href');
			// $model['size']=$size;
			// $model['href']=$url;
			// $model['is_on_sale']=I('is_on_sale');
 			// $model = D('qrcode');

			  
			// $id=I('get.id');
			// $url="http://www.xxoo.com/oo/id/".$id;
			$url="http://www.xxoo.com/oo/id/";
			$level=L;
			$size=3;
			$errorCorrectionLevel =intval($level) ;//容错级别
			$matrixPointSize = intval($size);//生成图片大小
			//生成二维码图片
			// $object = new \QRcode(); 
			// $object::png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
			// $a=Vendor('phpqrcode.phpqrcode');	
		
			// $a=import(Vendor.Phpqrcode);
			$a=include('Vendor\Phpqrcode\Phpqrcode');
			 var_dump($a);
			 die();
		 $QRcode = new \QRcode(); 
		 var_dump($QRcode);
		 die();
		 $QRcode->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
		 
	 

			// var_dump($model);
			// die();
			 
			// if($model->create()){

			// 	if($model->add()){

			// 		$this->success('管理员添加成功' ,U('spec'));

			// 		exit;

			// 	}else{

			// 		$this->error('管理员添加失败！请重试！');

			// 	}

			// }else{

			// 	$this->error($model->getError());

			// }

		// }


		// $category=M('qrcode')->select();


		// $this->assign('category',$category);
	 
	} 

}

?>