<?php 

namespace Admin\Controller;

use Admin\Controller\IndexController;

class GoodsController extends IndexController {

	
//api 配置文件增加
    public function add(){

		if(IS_POST){

			$model = D('api');

			if($model->create()){

				if($model->add()){

					$this->success('管理员添加成功' ,U('lst'));

					exit;

				}else{

					$this->error('管理员添加失败！请重试！');

				}

			}else{

				$this->error($model->getError());

			}

		}
		$category=M('api')->select();

		$this->assign('category',$category);
		$this->display();

    }



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
			$a=Vendor('phpqrcode.phpqrcode');	 
		 var_dump($a);
		 die();
		 $QRcode = new \QRcode(); 
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
		$this->display();

	} 
//api 配置文件修改
    public function save($id){

		$model = D('api');
	   
	 
		if(IS_POST){
			
				if($model->create()){ 

				if($model->save() !== false){

					$this->success('修改成功',U('lst'));

					exit;

				}else{

					$this->error('修改失败！请重试！');

				}

				}else{

					$this->error($model->getError());

				}	
		}

		$data = $model->find($id);
		// $re=M('api')->where("id={$id}")->find();
		// $data['goods_name']=$re['goods_name'];
		$this->assign('data',$data);
		$this->display();

	}

	
//短信显示方法
    public function lst(){

		$model = D('api');

		$data = $model->search();

		$this->assign(array(

			'data' =>$data['data'],

			'page' =>$data['page'],

		));

		$this->display();

    }

	


  //短信删除方法
	public function del($id){
			$model = M('api');
			$model->delete($id);
		$this->success('删除成功');
	}

//二维码单删除
	public function specdel($id){		 
		
			 $model=M('qrcode')->where(array('id'=>$id))->delete();
			 
		    if($model!==false){ 
		
			 $this->success('删除成功');
			}
			else{

              $this->error('删除失败');

			}
	}



	public function bdel(){

		$bid = I('post.id');
	
			$bid = implode(',',$bid);

			$model = M('qrcode');

			$model->delete($bid);

		$this->success('删除成功');

	}

	//二维码批量删除
	public function sdel(){

		   $bid = I('post.id');

		 
			$bid = implode(',',$bid);

			$model = M('qrcode');

			$model->delete($bid);

		$this->success('删除成功');

	}
	/**
	 * 二维码方法显示
	 * @return [type] [description]
	 */
	public function spec(){

		$count = M('qrcode')->count();

		$Page  = new \Think\Page($count,10);

		$page=$Page->show();

		$data=M('qrcode')->limit($Page->firstRow.','.$Page->listRows)->order('id ASC')->select();
		// foreach ($data as $key => $val) {
		// 	$re=M('goods')->where("id={$val['goodsid']}")->find();
		// 	$data[$key]['goods_name']=$re['goods_name'];
		// }
		$this->assign(array(

			'data' =>$data,

			'page' =>$page,

		));

		$this->display();
	}

	//二维码修改方法
	 public function specsave($id){

		$model = D('qrcode');
	
         
		if(IS_POST){
			
				if($model->create()){ 

				if($model->save() !== false){

					$this->success('修改成功',U('spec'));

					exit;

				}else{

					$this->error('修改失败！请重试！');

				}

				}else{

					$this->error($model->getError());

				}	
		}
	 

		$data = M('qrcode')->where(array('id'=>$id))->find();
		// $re=M('api')->where("id={$id}")->find();
		// $data['goods_name']=$re['goods_name'];
		$this->assign('data',$data);
		$this->display();

	}
	


	public function category_list(){

		$count = M('goods_category')->count();

		$Page  = new \Think\Page($count,10);

		$page=$Page->show();

		$data=M('goods_category')->limit($Page->firstRow.','.$Page->listRows)->order('id ASC')->select();
		$this->assign(array(

			'data' =>$data,
			'page' =>$page,

		));

		$this->display();

    }
	//添加商品分类
	public function add_cate(){
		if(IS_POST){
			$name=I('goods_name');
			$is_show=I('is_on_sale');
			$rs=M('goods_category')->add(array('cg_name'=>$name,'is_show'=>$is_show));
			if($rs){
				$this->success('修改成功',U('category_list'));
			}

		}

		$this->display();
	}


	public function del_cate($id){

	

			$model = M('goods_category');

			$model->delete($id);



		$this->success('删除成功');

	}

	public function save_cate($id){

		

		if(IS_POST){
			$cg_name=I('cg_name');
			$is_show=I('is_show');
			$rs=M('goods_category')->where(array('id'=>$id))->save(array('cg_name'=>$cg_name,'is_show'=>$is_show));
			if($rs){
				$this->success('修改成功',U('category_list'));

				exit;

			}else{

				$this->error('修改失败！请重试！');

				exit;
			}

		}

		$data = M('goods_category')->where(array('id'=>$id))->find();

		$this->assign('data',$data);

		$this->display();

    }



}

	

?>