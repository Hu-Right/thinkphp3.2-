<?php
namespace Mobile\Controller;
use Think\Controller;
class IndexController extends CommonController {
	public function __construct(){
		//调用父类的构造函数
		parent::__construct();
		if(!session('email')){
			$this->error('必须先登录！',U('Login/index'));
		}else{
			$user = M("member")->where(array('email'=>session('email')))->find();
			if(!$user){
				$this->error('获取用户信息出错,请重新登陆',U('Login/index'));
			}else{
				$this->user = $user;
			}
		}
	}
	
	//系统框架
    public function index(){
		$User = M('goods');
		$data['is_on_sale'] = "是";
		$email=session('email');
		$category=M('goods_category')->where("is_show='是'")->order('id asc')->select();
		//$list= M('goods')->where($data)->order('id desc')->limit(6)->select();
		foreach($category as $k=>$v){
			$category[$k]['goods'] = M('goods')->where(array('cate_id'=>$v['id'],'is_on_sale'=>'是'))->order('id desc')->limit(100)->select();
		}
	 	$user = M("member")->where(array('email'=>$email))->find();
	 	$psd=$user["erpsd"];
	 	$this->assign("psd",$psd);
	 	$this->assign("category",$category);
		//$this->assign('list',$list);// 赋值数据集
		$this->display();
	}
	//会员首页
	public function main(){
		
		$this->display();
	}
	
	
	
}