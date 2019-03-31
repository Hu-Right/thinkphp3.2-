<?php
namespace Mobile\Controller;
use Mobile\Controller\IndexController;
class TransactionController extends IndexController {
	public function recharge(){
		if(IS_POST){
			if(!I("post.mode")){$this->error("打款方式不能为空");}
			if(!I("post.accounts")){$this->error("打款帐号不能为空");}
			if(!I("post.name")){$this->error("打款人姓名不能为空");}
			if(!I("post.money")){$this->error("打款金额不能为空");}
			if(I("post.money")<=0){$this->error("请输入正确的打款金额");}
			$data['mode'] = I("post.mode");
			$data['accounts'] = I("post.accounts");
			$data['name'] = I("post.name");
			$data['money'] = I("post.money");
			$data['info'] = I("post.info");
			$data['time'] = date("Y-m-d H:i:s", time());
			$data['email'] = session("email");
			$add = M("transaction")->add($data);
			if($add){
				//M("systembonus")->where(array('id'=>1))->setInc('chonzhi',$data['money']);
				$this->success("打款信息提交成功，请等待客服人员审核");
			}else{
				$this->error("打款信息提交失败");
			}
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
	public function mpm(){
		if($_POST){
			$email=$_POST["email"];
			$user=M("member")->where(array("email"=>$email))->find();
			if($user){
				if($user['is_decenter']){
					echo $user["username"];
				}else{
					echo 1;	
				}
				//$teamid=M("team")->where(array("userid"=>$user["id"],"isout"=>1))->find();
				
			}else{
				echo "abc";
			}
		}
	}
	public function mpms(){
		if($_POST){
			$email=$_POST["email"];
			$user=M("member")->where(array("email"=>$email))->find();
			if($user){
				
				echo $user["username"];
			
				//$teamid=M("team")->where(array("userid"=>$user["id"],"isout"=>1))->find();
				
			}else{
				echo "abc";
			}
		}
	}
	public function gouwu(){
			if(IS_POST){
				$money = $_POST["money"];
				$emails=$_POST["email"];
				$erpsd=$_POST["erpsd"];
				$users = M("member")->where(array('email'=>$emails))->find();
				if($users['is_decenter']!=1){
					echo "此会员不是报单中心，不能执行转账操作！";
					exit;
				}
				if($users){
					$member = M("member");
					$user = $member->where(array('email'=>session('email')))->find();
					if($erpsd == ""){
						echo "二级密码不能为空";
					}else if($user["erpsd"] != $erpsd){
						echo "二级密码错误,请重试";
					}else if($user['currency']<$money){
						echo "您的帐号奖金不足，无法完成转账！请充值后操作。";
					}else{
						$member->where(array('email'=>session('email')))->setDec('currency',$money);
						$this->recordinfo(session('email'),$money,"余额","余额兑充提现","减少",$emails);
						$currency = $member->where(array('email'=>$emails))->setInc('currency',$money);
						$this->recordinfo($emails,$money,"余额","余额兑充提现","增加",session('email'));
						if($currency){
							echo 1;
						}else{
							echo "转账失败！";
						}
					}
				}else{
					echo "用户不存在,请确认用户账号";
				}
				
			}else{
				$this->display();
			}
			
		}

	public function activate_zz(){
			if(IS_POST){
				$money = $_POST["money"];
				$emails=$_POST["email"];
				$erpsd=$_POST["erpsd"];
				$users = M("member")->where(array('email'=>$emails))->find();
				
				if($users){
					$member = M("member");
					$user = $member->where(array('email'=>session('email')))->find();
					if($erpsd == ""){
						echo "二级密码不能为空";
					}else if($user["erpsd"] != $erpsd){
						echo "二级密码错误,请重试";
					}else if($user['activate_money']<$money){
						echo "您的帐号奖金不足，无法完成转账！请充值后操作。";
					}else{
						$member->where(array('email'=>session('email')))->setDec('activate_money',$money);
						$this->recordinfo(session('email'),$money,"激活币","激活币转账","减少",$emails);
						$currency = $member->where(array('email'=>$emails))->setInc('activate_money',$money);
						$this->recordinfo($emails,$money,"激活币","激活币转账","增加",session('email'));
						if($currency){
							echo 1;
						}else{
							echo "转账失败！";
						}
					}
				}else{
					echo "用户不存在,请确认用户账号";
				}
				
			}else{
				$this->display();
			}
			
		}

	
	public function rechargelist(){
		$User = M('transaction');
		$data['email'] = session('email');
		$count      = $User->where($data)->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}
	//余额报单
	
	// public function balancebd(){
	// 	if(IS_POST){
	// 		$money = I("post.money");
	// 		if($money <=0){
	// 			$this->error("请输入正确的转换金额！");
	// 		}
	// 		$member = M("member");
	// 		$user = $member->where(array('email'=>session('email')))->find();
	// 		if($user['money']<$money){
	// 			$this->error("您的帐号余额不足，无法完成转换！请充值后操作。");
	// 		}
	// 		$member->where(array('email'=>session('email')))->setDec('money',$money);
	// 		$this->recordinfo(session('email'),$money,"共享太极奖","共享太极奖转换电子币","减少");
	// 		$currency = $member->where(array('email'=>session('email')))->setInc('currency',$money);
	// 		$this->recordinfo(session('email'),$money,"健康币","共享太极奖转换电子币","增加");
	// 		if($currency){
	// 			$this->success("转换成功");
	// 		}else{
	// 			$this->error("转换失败！");
	// 		}
	// 	}else{
	// 		$this->display();
	// 	}
		
	// }
	
	public function balancebds(){
		if(IS_POST){
			$money = I("money");
			if($money <=0){
				$this->error("请输入正确的转换金额！");
			}

			if($money % 500 !=0){
				$this->error("转换额度必须是500的倍数！");
			}
			$member = M("member");
			$user = $member->where(array('email'=>session('email')))->find();
			if($user['currency']<$money){
				$this->error("您的帐号现金积分不足，无法完成转换！请充值后操作。");
			}
			$member->where(array('email'=>session('email')))->setDec('currency',$money);
			$this->recordinfo(session('email'),$money,"现金积分","现金积分转换激活币","减少",session('email'));
			$currency = $member->where(array('email'=>session('email')))->setInc('activate_money',$money);
			$this->recordinfo(session('email'),$money,"激活币","现金积分转换激活币","增加",session('email'));
			if($currency){
				$this->success("转换成功");
			}else{
				$this->error("转换失败！");
			}
		}else{
			$member = M("member");
			$user = $member->where(array('email'=>session('email')))->find();
			
			$this->assign("money",$money);
			$this->display();
		}
		
	}
	
	
	
	//奖金报单
	// public function bonusbd(){
	// 	if(IS_POST){
	// 		$money = I("post.money");
	// 		if($money <=0){
	// 			$this->error("请输入正确的转换金额！");
	// 		}
	// 		$member = M("member");
	// 		$user = $member->where(array('email'=>session('email')))->find();
	// 		if($user['bonus']<$money){
	// 			$this->error("您的帐号奖金不足，无法完成转换！请充值后操作。");
	// 		}
	// 		$member->where(array('email'=>session('email')))->setDec('bonus',$money);
	// 		$this->recordinfo(session('email'),$money,"奖金","奖金转换电子币","减少");
	// 		$currency = $member->where(array('email'=>session('email')))->setInc('currency',$money);
	// 		$this->recordinfo(session('email'),$money,"健康币","奖金转换电子币","增加");
	// 		if($currency){
	// 			$this->success("转换成功");
	// 		}else{
	// 			$this->error("转换失败！");
	// 		}
	// 	}else{
	// 		$this->display();
	// 	}
		
	// }
	
	
	
	
	public function recordinfo($email,$money,$type,$info,$income,$xiaemail){

		$data['email'] = $email;
		$data['xiaemail'] = $xiaemail;
		$data['money'] = $money;
		$data['type'] = $type;
		$data['info'] = $info;
		$data['income'] = $income;
		$data['time'] = date("Y-m-d H:i:s", time());
		M("userrecord")->add($data);
		if($info=='余额兑充提现'){
		    M('systembonus')->where('id=1')->setInc('tixian',$money);
		}
	}
	
	//奖金列表
	public function financelist(){
		$User = M('userrecord');
		$data['email'] = session('email');
		$count = $User->where("type='奖金' and email='{$data['email']}'")->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where("type='奖金' and email='{$data['email']}'")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}
	//奖金转换激活币
	public function zhbonus(){
		if(IS_POST){
			$money = I("post.money");
			if($money <=0){
				$this->error("请输入正确的转换金额！");
			}
			$member = M("member");
			$user = $member->where(array('email'=>session('email')))->find();
			if($user['bonus']<$money){
				$this->error("您的帐号奖金不足，无法完成转换！");
			}
			$member->where(array('email'=>session('email')))->setDec('bonus',$money);
			$this->recordinfo(session('email'),$money,"奖金","奖金转换激活币","减少",session('email'));
			$currency = $member->where(array('email'=>session('email')))->setInc('activate_money',$money);
			$this->recordinfo(session('email'),$money,"激活币","奖金转换激活币","增加",session('email'));
			if($currency){
				$this->success("转换成功");
			}else{
				$this->error("转换失败！");
			}
		}else{
			$this->display();
		}
		
	}

	public function announcement(){
    	$a=M("gonggao")->where(array("is_out"=>1))->select();
    	$this->assign("a",$a);
    	$this->display();
    }	
    public function xiaogonggao($id){
    	$a=M("gonggao")->where(array("id"=>$id))->find();
    	$this->assign("a",$a);
    	$this->display();
    }

}