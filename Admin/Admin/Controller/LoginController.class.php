<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

	public function login(){
		if(IS_POST){
			$model = D('Admin');
			if($model->create($_POST,4)){
				$ret = $model->login();
				if($ret === true){
					$this->success('登录成功',U('Index/index'));
					exit;
				}else{
					$ret == 1 ? $this->error('用户名不存在'):$this->error('密码错误');
				}
			}else{
				$this->error($model->getError());
			}
		}
		$this->display();
	}
	
	public function logout(){
		$model = D('Admin');
		$model->logout();
		$this->success('退出成功',U('Admin/Login/login'));
	}
	
	public function code(){
		$config =    array(
		'length'      =>    3,     // 验证码位数    
		'useNoise'    =>    false, // 关闭验证码杂点
		'useCurve' =>    false, // 关闭验证码杂点
		'codeSet'	  => '0123456789',
		);
		$Verify = new \Think\Verify($config);
		$Verify->entry();
	}
	
	 
	
	
}