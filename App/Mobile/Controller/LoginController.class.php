<?php
namespace Mobile\Controller;
use Think\Controller;
class LoginController extends CommonController {
	//会员登录验证
    public function index(){
		if(IS_POST){
			if(!I("post.email") || !I("post.password") || !I("chk_code")){
				$this->error("请输入邮箱和密码和验证码");
			}
			$code=I("chk_code");
			$id='';
			$verify = new \Think\Verify();
      		$yanzheng=$verify->check($code, $id);
      		if(!$yanzheng){
      			$this->error("验证码错误");
      		}
			$member = M("member");
			$user = $member->where(array('email'=>I("post.email")))->find();
			if(!$user){
				$this->error("邮箱不存在");
			}elseif($user['password'] != md5(I("post.password"))){
				$this->error("密码错误！请重新输入");
			}else{
				session('email',$user['email']);
				$this->success("登录成功",U('Index/index'));
			}
		}else{
			$this->display();	
		}	
	}
	//会员注销
	public function logout(){
		session(null);
		$this->success("会员退出成功",U('Login/index'));
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