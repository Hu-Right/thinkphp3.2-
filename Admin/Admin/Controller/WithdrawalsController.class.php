<?php 
namespace Admin\Controller;
use Admin\Controller\IndexController;
class WithdrawalsController extends IndexController {
    public function add(){
		if(IS_POST){
			$model = D('Withdrawals');
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
		$model = D('Withdrawals');
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
		$model = D('Withdrawals');
		$data = $model->search();
		$this->assign(array(
			'data' =>$data['data'],
			'page' =>$data['page'],
		));
		$this->display();
    }
	function daochu() {//导出商家信息Excel
  		$times=date("Y-m-d",time());
        $xlsData=M("Withdrawals")->where("time LIKE '{$times}%'")->select();
        $excel=new ExcelController();
        $excel->indexs($xlsData,$times);
    }

    function daochus() {//导出商家信息Excel
  		$times=date("Y-m",time());
        $xlsData=M("Withdrawals")->where("time LIKE '{$times}%'")->select();
        $excel=new ExcelController();
        $excel->indexs($xlsData,$times);
    }
	public function del($id){
	
			$model = D('Withdrawals');
			$model->delete($id);

		$this->success('删除成功');
	}
	
	public function bdel(){
		$bid = I('post.id');
			$bid = implode(',',$bid);
			$model = D('Withdrawals');
			$model->delete($bid);
		$this->success('删除成功');
	}
}
	
?>