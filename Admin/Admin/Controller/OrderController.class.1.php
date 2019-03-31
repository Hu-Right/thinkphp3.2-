<?php 

namespace Admin\Controller;

use Admin\Controller\IndexController;

class OrderController extends IndexController {

    public function add(){

		if(IS_POST){

			$model = D('zhifu');

			if($model->create()){

				if($model->add()){

					$this->success('添加成功' ,U('lst'));

					exit;

				}else{

					$this->error('添加失败！请重试！');

				}

			}else{

				$this->error($model->getError());

			}

		}

		$this->display();

    }



    public function save($id){

		$model = D('zhifu');

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

		$this->assign('data',$data);

		$this->display();

    }


  //支付显示方法
    public function lst(){

		$model = D('zhifu');

		$data = $model->search();

		// foreach ($data['data'] as $key => $val) {
		// 	$info=M("goods")->where("id={$val['goods_id']}")->find();
		// 	$data['data'][$key]['goods_name']=$info['goods_name'];
		// }
		$this->assign(array(

			'data' =>$data['data'],

			'page' =>$data['page'],

		));

		$this->display();

    }

	

	public function del($id){

	

			$model = M('zhifu');

			$model->delete($id);

		$this->success('删除成功');

	}

	

	public function bdel(){

		$bid = I('post.id');

			$bid = implode(',',$bid);

			$model = D('zhifu');

			$model->delete($bid);

		$this->success('删除成功');

	}

}

	

?>