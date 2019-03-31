<?php 
namespace Admin\Controller;
use Admin\Controller\IndexController;
class PrivilegeController extends IndexController {
    public function add(){
		if(IS_POST){
			$model = D('Privilege');
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

		$model = D('Privilege');
		$data = $model->catelist();
		$this->assign('data',$data);
		$this->display();
    }

    public function save($id){
		$model = D('Privilege');
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
		
		$model = D('Privilege');
		$datas = $model->catelist();
		$this->assign('datas',$datas);


		$this->display();
    }

	 public function lst(){
		$model = D('Privilege');
		$data = $model->catelist();
		$this->assign('data',$data);
		
		$this->display();
    }
	
	public function del($id){
	
			$model = D('Privilege');
			$model->delete($id);

		$this->success('删除成功');
	}
	
	public function bdel(){
		$bid = I('post.id');
			$bid = implode(',',$bid);
			$model = D('Privilege');
			$model->delete($bid);
		$this->success('删除成功');
	}
}
	
?>