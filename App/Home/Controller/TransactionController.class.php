<?php
namespace Home\Controller;
use Home\Controller\IndexController;
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
	
	public function balancebd(){
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
			$order=M("order")->where(array("email"=>$user["email"],"state"=>1))->select();
			$money=0;
			
			$this->assign("moneys",$moneys);
			$this->assign("money",$money);
			$this->display();
		}
		
	}
	public function mpm(){
		if($_POST){
			$email=$_POST["email"];
			$user=M("member")->where(array("email"=>$email))->find();
			if($user){
				//$teamid=M("team")->where(array("userid"=>$user["id"],"isout"=>1))->find();
				echo $user["username"];
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
					
					$this->recordinfo(session('email'),$money,"余额","余额兑充提现","减少",session('email'));

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
	
	
	
	//奖金报单
	public function bonusbd(){
		$email=session('email');

		$is_center=M('member')->where(array('email'=>$email))->getField('is_decenter');
		$count =M('daymoney_log')->where(array('email'=>$email))->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$gain_list=M('daymoney_log')->where(array('email'=>$email))->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('is_center',$is_center);
		$this->assign('gain_list',$gain_list);
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
		
	}
	
	
	
	
	public function recordinfo($email,$money,$type,$info,$income,$xiaemail){
		// if($data['money'] % 2500 != 0){
		// 	$this->error("充值金额2500起，且必须是2500的倍数！");
		// }
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
	
	//财务列表
	public function financelist(){
		$User = M('userrecord');
		$data['email'] = session('email');
		$count = $User->where($data)->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}
	//推荐奖列表
	public function tj_log(){
    	$User = M('userrecord');
		$data['email'] = session('email');
		$data['info'] = ['like',"%".'推荐奖'."%"];
		$count = $User->where($data)->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('gain_list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
    	$this->display();
    }
    //分红记录(拆分奖)
	public function chaifen(){
    	$User = M('userrecord');
		$data['email'] = session('email');
		$data['info'] = ['like',"%".'拆分奖'."%"];
		$count = $User->where($data)->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('gain_list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
    	$this->display();
    }
    //消费积分
    public function xiaofei_credit(){
        $data['email'] = session('email');
		$data['payment'] = ['like',"%".'重销积分支付'."%"];
        $count = M('order')->where($data)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('order')->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        
        foreach ($gain_list as $k => $v) {
                $goods=M('goods')->where(array('id'=>$v['goods_id']))->find();
                $gain_list[$k]['goods_name']=$goods['goods_name'];
                $gain_list[$k]['goods_price']=$goods['shop_price'];
        }
        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    //消费积分
    public function withdrawal_list(){
        $data['email'] = session('email');
		$data['payment'] = ['like',"%".'提现操作'."%"];
        $count = M('order')->where($data)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('order')->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        
        foreach ($gain_list as $k => $v) {
                $goods=M('goods')->where(array('id'=>$v['goods_id']))->find();
                $gain_list[$k]['goods_name']=$goods['goods_name'];
                $gain_list[$k]['goods_price']=$goods['shop_price'];
        }
        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    //购物币
    public function gou_log(){
        $data['email'] = session('email');
		$data['type'] = ['like',"%".'购物币'."%"];
        $count = M('userrecord')->where($data)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('userrecord')->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    //保单提成记录
    public function baodan_log(){
        
        $data['email'] = session('email');
        $data['info'] = ['like',"报单激活会员提成"];
        $count = M('userrecord')->where($data)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('userrecord')->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
		
    }
    //余额转账（兑充提现）记录
    public function yu_log(){
    	$email = session('email');
		
    	$count = M('userrecord')->where("email='{$email}' and (info='余额兑充提现' or info='激活币转账') ")->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
    	$gain_list=M('userrecord')->where("email='{$email}' and (info='余额兑充提现' or info='激活币转账') ")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	foreach ($gain_list as $k => $v) {
    			$user=M("member")->where(array('email'=>$v['xiaemail']))->getField('username');
    			$gain_list[$k]['username']=$user;
    	}
    	$this->assign('gain_list',$gain_list);
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
	//积分转换
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
	//激活币转账
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
	//管理奖记录
    public function manage(){
        $data['email'] = session('email');
        $data['info'] = ['like',"%".'管理奖'."%"];
        $count = M('userrecord')->where($data)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('userrecord')->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
     //量碰奖记录
    public function liangpeng(){
        $data['email'] = session('email');
        $data['info'] = ['like',"%".'量碰奖'."%"];
        $count = M('userrecord')->where($data)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('userrecord')->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    public function announcement(){
    	$a=M("gonggao")->where(array("is_out"=>1))->select();
    	$this->assign("a",$a);
    	$this->display();
    	
    	
    	
  //   	$data=M("member")->where("id<5651 and id>4991")->select();
  //   	foreach($data as $k=>$v){
  //   		$l_money=0;
  //   		$r_money=0;
  //   		$rightxia=0;
  //   		$leftxia=0;
		// 	$xiashu=M("member")->where(array('node_id'=>$v["id"]))->select();
		// 	if($xiashu){
		// 		foreach($xiashu as $kk=>$vv){
		// 			if($vv["region"] == 1){//右区
		// 				$vvid=$vv['id'];
		// 				$rightxia=M("member")->where("class_id LIKE '%$vvid%'")->count();
		// 			}else{//左区
		// 				$vvid=$vv['id'];
		// 				$leftxia=M("member")->where("class_id LIKE '%$vvid%'")->count();
		// 			}
					
		// 		}
		// 	if($rightxia>0 || $leftxia>0){
		// 			if($rightxia>$leftxia){
		// 				$moneys=$rightxia-$leftxia;
		// 				$r_money=$moneys*3840;
		// 				$l_money=0;
		// 			}else if($leftxia>=$rightxia){
		// 				$moneys=$leftxia-$rightxia;
		// 				$l_money=$moneys*3840;
		// 				$r_money=0;
		// 			}
		// 		M("liangpeng")->where(array("user_id"=>$v["id"]))->save(array("l_money"=>$l_money,"r_money"=>$r_money));
		// 	}else{
		// 		M("liangpeng")->where(array("user_id"=>$v["id"]))->save(array("l_money"=>0,"r_money"=>0));
		// 	}
			
		// 	}
		// }


    }	
    public function xiaogonggao($id){
    	$a=M("gonggao")->where(array("id"=>$id))->find();
    	$this->assign("a",$a);
    	$this->display();
    }
}