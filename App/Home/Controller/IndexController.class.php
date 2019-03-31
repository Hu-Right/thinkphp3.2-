<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
	public function __construct(){
		//调用父类的构造函数
		parent::__construct();
		if(!session('mobile')){
			// $this->error('必须先登录！',U('Login/index'));
			// $this->ajaxReturn(array('status'=>0,'message'=>'请先登录'));
			$this->redirect("Login/index");
			// $this->error('必须先登录！',U('Login/index'));
		}else{
			$user = M("member")->where(array('mobile'=>session('mobile')))->find();
			if(!$user){
				$this->error('获取用户信息出错,请重新登陆',U('Login/index'));
			}else{
				$this->user = $user;
			}
		}
	}
	
	//系统框架
    public function index(){
		// $email=session('email');
	 	// $user = M("member")->where(array('email'=>$email))->find();
	 	// $psd=$user["erpsd"];
	 	// $time=date('Y-m-d',time());
	 	// $gain_money=M('daymoney_log')->where(array('time'=>$time,'email'=>$email))->find();

	 	// $zonggong=M('daymoney_log')->where(array('email'=>$email))->select();
	 	// $yahuo=array();
	 	// foreach($zonggong as $v){
	 	// 	$yahuo["liang_money"]+=$v["liang_money"];
	 	// 	$yahuo["tui_money"]+=$v["tui_money"];
	 	// 	$yahuo["ling_money"]+=$v["ling_money"];
	 	// 	$yahuo["fen_money"]+=$v["fen_money"];
	 	// 	$yahuo["credit"]+=$v["credit"];
	 	// 	$yahuo["expenses"]+=$v["expenses"];
	 	// 	$yahuo["manage"]+=$v["manage"];
	 	// 	$yahuo["totalmoney"]+=$v["totalmoney"];
	 	// }

	 	// $this->assign("yahuo",$yahuo);
		// $this->assign("gain_money",$gain_money);
	 	// $this->assign("psd",$psd);
		$this->display();
	}
//会员首页
public function main(){
		
		$this->display();
	}

///客服
public function service()
{

$this->display();
}

//关于
public function about()
{

$this->display();
}
//赚拥
public function what()
{

 $this->display();	
}
//资源
public function src()
{
 
  $this->display();	

}

//名片
public function card()
{
 
  $this->display();	

}
	
}