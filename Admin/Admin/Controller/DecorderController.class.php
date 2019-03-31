<?php 
namespace Admin\Controller;
use Admin\Controller\IndexController;
class DecorderController extends IndexController {
    public function add(){
		if(IS_POST){
			$model = D('Decorder');
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
		$model = D('Decorder');
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

    public function lst(){
		$model = D('Decorder');
		$data = $model->search();
		$this->assign(array(
			'data' =>$data['data'],
			'page' =>$data['page'],
		));
		$this->display();
    }
	
	public function del($id){
	
			$model = D('Decorder');
			$model->delete($id);

		$this->success('删除成功');
	}
	
	public function bdel(){
		$bid = I('post.id');
			$bid = implode(',',$bid);
			$model = D('Decorder');
			$model->delete($bid);
		$this->success('删除成功');
	}
}
	
?>