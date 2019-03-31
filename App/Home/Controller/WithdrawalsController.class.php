<?php
namespace Home\Controller;
use Home\Controller\IndexController;
class WithdrawalsController extends IndexController {
	public function withdrawals(){
		if(IS_POST){
			if(!I("post.mode")){$this->error("银行名称不能为空");}
			if(!I("post.khhxx")){$this->error("开户行信息不能为空");}
			if(!I("post.accounts")){$this->error("提现帐号不能为空");}
			if(!I("post.name")){$this->error("提现人姓名不能为空");}
			if(!I("post.money")){$this->error("提现金额不能为空");}
			if(I("post.money")<=0){$this->error("请输入正确的提现金额");}
			$member = M("member");
			$user = $member->where(array('email'=>session('email')))->find();
			if($user['money'] < I("post.money")){
				$this->error("您的余额不足！请重新输入提现金额");
			}
			
			$member->where(array('email'=>session('email')))->setDec('money',I("post.money"));
			$this->recordinfo(session('email'),I("post.money"),"余额","提现操作","减少");
			
			
			
			// $chongxiao = I("post.money") * (C('chongxiao')/100);
			// $member->where(array('email'=>session('email')))->setInc('shopping',$chongxiao);
			// $this->recordinfo(session('email'),$chongxiao,"购物币","提现重消奖","增加");
			$money = I("post.money") * ((100 - (C('guanlifei')+C('chongxiao')+C('aixinjijin')))/100);
			$data['mode'] = I("post.mode");
			$data['accounts'] = I("post.accounts");
			$data['name'] = I("post.name");
			$data['money'] = $money;
			$data['khhxx'] = I("post.khhxx");
			$data['info'] = I("post.info");
			$data['time'] = date("Y-m-d H:i:s", time());
			$data['email'] = session("email");
			$add = M("withdrawals")->add($data);
			if($add){
				M("systembonus")->where(array('id'=>1))->setInc('tixian',$data['money']);
				$this->success("提现信息提交成功，请等待客服人员审核");
			}else{
				$this->error("提现信息提交失败");
			}
		}else{
			$this->display();
		}
	}


	
	public function bonuswithdrawals(){
		if(IS_POST){
			if(!I("post.mode")){$this->error("银行名称不能为空");}
			if(!I("post.khhxx")){$this->error("开户行信息不能为空");}
			if(!I("post.accounts")){$this->error("提现帐号不能为空");}
			if(!I("post.name")){$this->error("提现人姓名不能为空");}
			if(!I("post.money")){$this->error("提现金额不能为空");}
			if(!I("post.erpsd")){$this->error("请输入您的二级密码");}
			if(I("post.money")<=0){$this->error("请输入正确的提现金额");}
			if(I('post.money') % 500 !=0){
				$this->error("提现金额必须为500的倍数");
			}
			$shouxu=I('shouxu');
			$member = M("member");
			$user = $member->where(array('email'=>session('email')))->find();
			if($user["erpsd"] != I("post.erpsd")){
				$this->error("二级密码错误,请重试");
			}
			if($user['bonus'] < (I("post.money"))){
				$this->error("您的余额不足！请重新输入提现金额");
			}
			$member->where(array('email'=>session('email')))->setDec('bonus',I("post.money"));
			$this->recordinfo(session('email'),I("post.money"),"余额","提现操作","减少",session('email'));
			
			// $chongxiao = I("post.money") * (C('chongxiao')/100);
			// $member->where(array('email'=>session('email')))->setInc('money',$chongxiao);
			// $this->recordinfo(session('email'),$chongxiao,"余额","提现重消奖","增加");
			
			//$money = I("post.money") * ((100 - (C('guanlifei')+C('chongxiao')+C('aixinjijin')))/100);
			$jiangli=M('jiangli')->where('id=1')->getField('tixian');
			$money = I("post.money") * ((100 - $jiangli)/100);


			$data['mode'] = I("post.mode");
			$data['accounts'] = I("post.accounts");
			$data['name'] = I("post.name");
			$data['money'] = $money;
			$data['shouxu'] = I("post.money")*$jiangli/100;
			$data['khhxx'] = I("post.khhxx");
			$data['info'] = I("post.info");
			$data['time'] = date("Y-m-d H:i:s", time());
			$data['email'] = session("email");
			$add = M("withdrawals")->add($data);
			if($add){
				M("systembonus")->where(array('id'=>1))->setInc('tixian',$data['money']);
				$this->success("提现信息提交成功，请等待客服人员审核");
			}else{
				$this->error("提现信息提交失败");
			}
		}else{
			$puser=M("withdrawals")->where(array("email"=>session('email')))->order("time asc")->limit(1)->find();;
			if($user){
				$this->assign("puser",$puser);
			}else{
				$user="";
				$this->assign("puser",$puser);
			}
			$this->display();
		}
	}

	
	//添加财务记录
	public function recordinfo($email,$money,$type,$info,$income,$xiaemail){
		$data['email'] = $email;
		$data['xiaemail'] = $xiaemail;
		$data['money'] = $money;
		$data['type'] = $type;
		$data['info'] = $info;
		$data['income'] = $income;
		$data['time'] = date("Y-m-d H:i:s", time());
		M("userrecord")->add($data);
	}
	
	//提现列表
	public function withdrawalslist(){
		$User = M('withdrawals');
		$data['email'] = session('email');
		$count      = $User->where($data)->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}
	
	public function ajax_checkMoney(){
		if(IS_POST){

			$money=I('money');
			$jiangli=M('jiangli')->where('id=1')->getField('tixian');
			$shouxu=$money*$jiangli/100;
			echo $shouxu;
		}
	}
	
}