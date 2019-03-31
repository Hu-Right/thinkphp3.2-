<?php
namespace Admin\Controller;
use Admin\Controller\IndexController;
class AdminController extends IndexController {
	
	//添加管理员
    public function add(){
		if(IS_POST){
			$model = D('Admin');
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
		$model = M('Role');
		$data = $model->select();
		$this->assign('data',$data);

		$this->display();
    }

	//修改管理员
    public function save($id){
		$model = D('Admin');
		if(IS_POST){
			if($model->create()){
				if($model->save() !== false){
					$this->success('管理员修改成功',U('lst'));
					exit;
				}else{
					$this->error('管理员修改失败！请重试！');
				}
			}else{
				$this->error($model->getError());
			}
		}
		$data = $model->find($id);
		$this->assign('data',$data);
		$model = M('Role');
		$datas = $model->select();
		$this->assign('datas',$datas);
		$this->display();
    }
	
	//管理员列表
    public function lst(){
		$model = D('Admin');
		$data = $model->search();
		$this->assign(array(
			'data' =>$data['data'],
			'page' =>$data['page'],
		));
		$this->display();
    }
	
	//删除管理员 //不能删除ID为1的管理员
	public function del($id){
		if($id>1){
			$model = D('Admin');
			$model->delete($id);
		}
		$this->success('删除成功');
	}
	//批量删除管理员	//不能删除ID为1的管理员
	public function bdel(){
		$bid = I('post.id');
		if($bid){
			$key = array_search(1,$bid);
			if($key !== false){
				unset($bid[$key]);
			}
			$bid = implode(',',$bid);
			$model = D('Admin');
			$model->delete($bid);
		}
		$this->success('删除成功');
	}
	
	//清空缓存
	public function cache(){
		$model = D('Admin');
		$model->cache();
		$this->success('缓存清理成功');
	}
	
	
}
	
?>