<?php
namespace Home\Controller;
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


 ///登录方法
 public function ajaxlogin()
 {
   if(IS_AJAX&&IS_POST)//判断是否符合提交方式
   {
	 if(!("post.mobile") ||!I("post.password"))
	 {
         $this->error("请输入手机号与密码");//验证过滤                       
	 }
	 //接收view值
	 $mobile=I('post.mobile');  
     $password=I('post.password');
      //连接数据库查找是否有符合的用户名
    $data=M("member")->where(array('mobile'=>$mobile))->find();
	if(!$data)
	{
       $this->ajaxReturn(array('status'=>1,'message'=>'您输入的手机号不存在'));//返回前台对应得ajax数组值

	}elseif($data['password'] != md5($password))
	{
		
		$this->ajaxReturn(array('status'=>2,'message'=>'密码错误,请重试!'));

	}else
	{   session('mobile',$data['mobile']);
		session('id',$data['id']);
        $this->ajaxReturn(array('status'=>0,'message'=>'登陆成功'));
		 
	} 

}
 
   $this->display();
 
}


	//会员注销
	public function logout(){
		session(null);
		$this->success("退出成功",U('Login/index'));
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