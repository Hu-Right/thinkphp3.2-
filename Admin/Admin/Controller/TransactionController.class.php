<?php 
namespace Admin\Controller;
use Admin\Controller\IndexController;
class TransactionController extends IndexController {
    public function add(){
		if(IS_POST){
			$model = D('Transaction');
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
		$model = D('Transaction');
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
    	$User = M('userrecord');
		$count      = $User->where()->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where(array("info"=>"管理员充值"))->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
    }
	
	public function del($id){
	
			$model = D('Transaction');
			$model->delete($id);

		$this->success('删除成功');
	}
	
	public function bdel(){
		$bid = I('post.id');
			$bid = implode(',',$bid);
			$model = D('Transaction');
			$model->delete($bid);
		$this->success('删除成功');
	}
	
	public function accounts(){
		if(IS_POST){
			$filename = $_SERVER['DOCUMENT_ROOT'] . '/Admin/Common/Conf/accounts_config.php';
            $filename2 = $_SERVER['DOCUMENT_ROOT'] . '/App/Common/Conf/accounts_config.php';
            file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            file_put_contents($filename2, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            $this->success('编辑成功！');
		}else{
			$this->Bankname = C('Bankname');
			$this->Bankaccount = C('Bankaccount');
			$this->bankdeposit = C('bankdeposit');
			$this->bankuser	 = C('bankuser');
			$this->zhifubao = C('zhifubao');
			$this->weixin = C('weixin');
			$this->display();
		}
	}
	
	public function management(){
		if(IS_POST){
			$filename = $_SERVER['DOCUMENT_ROOT'] . '/Admin/Common/Conf/tixian_config.php';
            $filename2 = $_SERVER['DOCUMENT_ROOT'] . '/App/Common/Conf/tixian_config.php';
            file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            file_put_contents($filename2, strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>"));
            $this->success('编辑成功！');
			
		}else{
			$this->chongxiao = C('chongxiao');
			$this->guanlifei = C('guanlifei');
			$this->aixinjijin = C('aixinjijin');
			$this->display();
		}
	}
	

	
	
	
}
	
?>