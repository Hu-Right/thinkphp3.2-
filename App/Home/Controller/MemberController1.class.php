<?php
namespace Home\Controller;
use Home\Controller\IndexController;
class MemberController extends IndexController {
	

	public function team(){
		$user = M("member")->where(array('email'=>session('email')))->find();
		$getid = I('get.id');
		$id = !$getid?$user['id']:$getid;
		$this->id = $id;
		$data = $this->catelist();
		$userdataA = array();
		foreach($data as $v){
			if($v['region'] == 0){
				$userdataA[] = $v;
			}
		}
		$userdataB = array();
		foreach($data as $v){
			if($v['region'] == 1){
				$userdataB[] = $v;
			}
		}
		$data = array_merge($userdataA,$userdataB);
		$this->assign('data',$data);
		$this->display();
	}
	
	
	
	public function catelist(){
		$data = M("Member")->select();
		
		return $this->_Cadigui($data);
	}
	
	
	

	private function _Cadigui($data,$parent_id = 0 ,$leve = 0){
		static $var = array();
		
		foreach($data as $v){
			if($v['parent_id'] == $parent_id){
				$v['leve'] = $leve;
				$var[] = $v;
				$this->_Cadigui($data,$v['id'],$leve+1);
			}
		}
		return $var;
	}
	
	
	//注册下级会员
	public function useradd(){
		
		if(IS_POST){
			$data = I();
			if(!$data['username']){$this->error("请输入真实姓名！");}
			if(!$data['email']){$this->error("会员ID出错请重新获取！");}
			if(!$data['mobile']){$this->error("请输入电话号码！");}
			if(!$data['card']){$this->error("请输入身份证号码！");}
			if(!$data['weixin']){$this->error("请输入微信号码！");}
			if(!$data['zhifubao']){$this->error("请输入支付宝账户");}
			if(!$data['password']){$this->error("密码不能为空");}
			if($data['password'] != $data['rpassword']){
				$this->error("两次密码不正确！请重新输入");
			}
			if(strlen($data['card']) < 18){
				$this->error("身份证不正确");
			}
			/**
			if($this->check_email($data['email'])){
			}else{
				$this->error("请输入正确的电子邮箱");
			}
			**/
			if($this->check_Mobile($data['mobile'])){
			}else{
				$this->error("请输入正确的手机号码");
			}
			$user = M("member");
			$useremail = $user->where(array('email'=>session('email')))->find();
			$leftregion = M("member")->where("parent_id='{$useremail['id']}' and region = 0")->find();
			if(empty($leftregion) && $data['region'] == 1){
				$this->error("有先添加左区会员后，才可以在添加右区");
			}
			
			$email = $user->where(array('email'=>$data['email']))->find();
			if($email){$this->error("登录ID已存在！请重新获取！");}
			$mobile = $user->where(array('mobile'=>$data['mobile']))->find();
			if($mobile){$this->error("手机号码已存在！请重新输入！");}
			$tuijian=$user->where(array('email'=>$data['tuijian']))->find();
			$jiedian=$user->where(array('email'=>$data['jiedian']))->find();
			if(!$tuijian){$this->error("直推会员不存在！请重新输入！");}
			if(!$jiedian){$this->error("节点会员不存在！请重新输入！");}
			$jiediancount=$user->where(array('node_id'=>$jiedian['id']))->count();
			if($jiediancount>=2){
				$this->error("节点会员已满！请重新输入！");
			}
			$xiamian = $user->where(array('node_id'=>$jiedian['id']))->find();
			if($xiamian){
				if($xiamian['region'] == $data['region']){
					$this->error("节点选择错误！请重新选择！");
				}
			}
			
			
			
			
			if($data['type'] == 1){
				$jibeimoney = C("jinkabaodan");
				
				if($useremail['currency'] < C("jinkabaodan")){
					$this->error("您的健康币不足！请充值后操作！");
				}else{
					if($useremail['zhengsong']==0){
						$user->where(array('email'=>session('email')))->setDec('currency',C("jinkabaodan"));
						$this->recordinfo(session('email'),C("jinkabaodan"),"健康币","报单注册会员","减少");
					}else{
						$xianyou = $useremail['currency'] - $useremail['zhengsong'] + 2500;
						if($xianyou >= C("jinkabaodan")){
							$user->where(array('email'=>session('email')))->setDec('currency',C("jinkabaodan"));
							$user->where(array('email'=>session('email')))->setDec('zhengsong',2500);
							$this->recordinfo(session('email'),C("jinkabaodan"),"健康币","报单注册会员","减少");
						}else{
							$this->error("您的健康币不足！每次只能用赠送电子的25%,请充值后操作！！");
						}
					}
					$userdata['type'] = 1;
				}
			}elseif($data['type'] == 2){
				$jibeimoney = C("zuankabaodan");
				if($useremail['currency'] < C("zuankabaodan")){
					$this->error("您的健康币不足！请充值后操作！");
				}else{
					if($useremail['zhengsong']==0){
						$user->where(array('email'=>session('email')))->setDec('currency',C("zuankabaodan"));
						$this->recordinfo(session('email'),C("zuankabaodan"),"健康币","报单注册会员","减少");
					}else{
						$xianyou = $useremail['currency'] - $useremail['zhengsong'] + 2500;
						if($xianyou >= C("zuankabaodan")){
							$user->where(array('email'=>session('email')))->setDec('currency',C("zuankabaodan"));
							$user->where(array('email'=>session('email')))->setDec('zhengsong',2500);
							$this->recordinfo(session('email'),C("zuankabaodan"),"健康币","报单注册会员","减少");
						}else{
							$this->error("您的健康币不足！每次只能用赠送电子的25%,请充值后操作！");
						}
					}
					//$userdata['currency'] = C("zuankabaodan");
					//$userdata['zhengsong'] = C("zuankabaodan");
					$userdata['type'] = 2;
					//$this->recordinfo($data['email'],C("zuankabaodan"),"电子币","报单送电子币","增加");
				}
			}else{
				$this->error("报单会员出错！请稍后再试！");
			}
			
			
			$jiandianjib = 1;
			$jiandian = $jiedian;
			while ($jiandian) {
				//if($jiandianjib <=10){
				if($jiandianjib <= C("jiandianceng")){
					$jiandian = $this->jiandian($jiandian,$jiandianjib);
					$jiandianjib++;
				}else{
					$jiandian = false;
				}
			}
		
			$userdata['ip'] = get_client_ip();
			$userdata['layer'] = $jiedian['layer']+1;
			$userdata['username'] = $data['username'];
			$userdata['email'] =$data['email'];
			$userdata['mobile'] =$data['mobile'];
			$userdata['card'] =$data['card'];
			$userdata['weixin'] =$data['weixin'];
			$userdata['gender'] =$data['gender'];
			$userdata['zhifubao'] =$data['zhifubao'];
			$userdata['parent_id'] =$tuijian['id'];
			$userdata['password'] =md5($data['password']);
			$userdata['node_id'] =$jiedian['id'];
			$userdata['region'] =$data['region'];
			$userdata['addtime'] =date("Y-m-d H:i:s", time());
			$add = M("member")->add($userdata);
			if($add){
				$this->userregion($userdata['email']);
				$this->cenpeng($userdata['email']);
				$this->cenpenga($userdata['email']);
				$this->liangpenga($userdata['email']);
				$this->lingdaoxing($userdata['email'],$jibeimoney);
				M("systembonus")->where(array('id'=>1))->setInc('baodan',$jibeimoney);
				$this->success("注册成功",U("Member/team"));
			}else{
				$this->error("注册失败");
			}
		}else{
			$id = I("get.id");
			$jiedian =  M("Member")->where(array('id'=>$id))->find();
			$jiediancount=M("Member")->where(array('node_id'=>$jiedian['id']))->count();
			if($jiediancount>=2){
				$this->error("会员节点已满！请重新选择！");
			}
			$this->jiedianemail = $jiedian['email'];
			$this->display();
		}
	}

	public function __nodetop($node_id){
		$member = M("member");
		$user = $member->where(array('id'=>$node_id))->find();
		if($user){
			return $user['node_id'];
		}else{
			return false;
		}
	}


	
	public function userregion($email){
		$member = M("member");
		$user = $member->where(array('email'=>$email))->find();//当前会员
		if($user['node_id']){
			$nodeX = array('node_id'=>$user['node_id'],'region'=>$user['region'],$user['layer']);
			while($nodeX){
				$node = $member->where(array('id'=>$nodeX['node_id']))->find();
				if($node){
					$userregion = M("userregion")->where(array('email'=>$node['email'],'region'=>$nodeX['region'],'layer'=>$user['layer']))->find();
					if($userregion){
						M("userregion")->where(array('email'=>$node['email'],'region'=>$nodeX['region'],'layer'=>$user['layer']))->setInc('usernumber');
					}else{
						M("userregion")->add(array('email'=>$node['email'],'region'=>$nodeX['region'],'layer'=>$user['layer'],'usernumber'=>1));
					}
					$nodeX = array('node_id'=>$node['node_id'],'region'=>$node['region'],$user['layer']);
				}else{
					$nodeX = false;
				}
			}
		}
	}
	
	public function liangpeng($email){
		$member = M("member");
		$user = $member->where(array('email'=>$email))->find();//当前会员
		//一级量碰
		$syeuserss = $member->where(array('layer'=>$user['layer'],'node_id'=>$user['node_id']))->order('type asc')->find();//查找同一节点所有的会员
		
		if($syeuserss['type'] ==1){
			$moneys = C("jinkabaodan");
		}else{
			$moneys = C("zuankabaodan");
		}
		//查询本节点会员
		$nodeuserS = $member->where(array('layer'=>$user['layer'],'email'=>array("neq",$email),'node_id'=>$user['node_id']))->find();//查询同节点的单个会员
		
		if($nodeuserS){
			$niuniu = $member->where(array('id'=>$nodeuserS['node_id']))->find();
			if($niuniu['type'] ==1){
				//$money = $moneys * 0.13;
				$money = $moneys  * (C("amountjin")/100);
				$xiange = C("jinkarixiane");
			}else{
				//$money = $moneys * 0.15;
				$money = $moneys  * (C("amountzuan")/100);
				$xiange = C("zuankarixiane");
			}
			//获取今日统计
			$statistics = M("userstatistics")->where(array("email"=>$niuniu['email'],'time'=>date("Y-m-d",time())))->find();
			if(!$statistics){
				M("userstatistics")->add(array("email"=>$niuniu['email'],'time'=>date("Y-m-d",time())));
				M("userstatistics")->where(array("email"=>$niuniu['email'],'time'=>date("Y-m-d",time())))->setInc('amount_money',$money);
				$member->where(array('email'=>$niuniu['email']))->setInc('bonus',$money);
				
				if($niuniu['shifoliang'] == 0){
					$this->recordinfo($niuniu['email'],$money,"奖金","会员". "1层量碰奖","增加");
					M("member")->where(array('email'=>$niuniu['email']))->save(array('shifoliang'=>1));
				}
				
				
				
				M("systembonus")->where(array('id'=>1))->setInc('liangpeng',$money);//后台数据添加统计
				//紧缩奖
				$this->jinsou($niuniu['email'],$money);
				//感恩奖
				$this->ganen($niuniu['email'],$money);
			}else{
				if($statistics['amount_money']>=$xiange){
						$this->recordinfo($niuniu['email'],0,"奖金","会员". "1层量碰奖(已封顶)","增加");
				}else{
					M("userstatistics")->where(array("email"=>$niuniu['email'],'time'=>date("Y-m-d",time())))->setInc('amount_money',$money);
					$member->where(array('email'=>$niuniu['email']))->setInc('bonus',$money);
					
					if($niuniu['shifoliang'] == 0){
						$this->recordinfo($niuniu['email'],$money,"奖金","会员". "1层量碰奖","增加");
						M("member")->where(array('email'=>$niuniu['email']))->save(array('shifoliang'=>1));
					}
					
					M("systembonus")->where(array('id'=>1))->setInc('liangpeng',$money);//后台数据添加统计
					//紧缩奖
					$this->jinsou($niuniu['email'],$money);
					//感恩奖
					$this->ganen($niuniu['email'],$money);
				}
			}
			
		}
	
	}

	
	public function jinsou($email,$money){
		$member = M("member");
		$user = $member->where(array('email'=>$email))->find();//当前会员
		$node_count = $member->where(array('node_id'=>$user['id']))->count();//下面的会员数量
		$node_arr = $member->where(array('node_id'=>$user['id']))->select();//下面的会员信息
		if($node_count == 2){
			$node_money = ($money * (C('jinsuo')/100))/2;
			foreach($node_arr as $v){
				$member->where(array('email'=>$v['email']))->setInc('bonus',$node_money);
				$this->recordinfo($v['email'],$node_money,"奖金","会员". "紧缩奖","增加");
			}
		}elseif($node_count == 1){
			$node_money = ($money * (C('jinsuo')/100));
			foreach($node_arr as $v){
				$member->where(array('email'=>$v['email']))->setInc('bonus',$node_money);
				$this->recordinfo($v['email'],$node_money,"奖金","会员". "紧缩奖","增加");
			}
		}
		
	}
	
	public function s(){
		$this->liangpenga("61486457166");
		
	}

	
	
	
	public function liangpenga($email){
		$member = M("member");
		$user = $member->where(array('email'=>$email))->find();//当前会员信息
		
		if($user['region'] ==1){
			$moneys = $this->__tongzx($user);//查询分配比例
			//会员量碰次数
			
			$dscs = $user['layer']-1;
			
			$quanbu = $member->where(array('layer'=>$user['layer'],'region'=>$user['region'],'email'=>array('neq',$email)))->select();//当前层会员信息
			//当前会员上级
			while($user['node_id']){
				$usertop[] = $user['node_id'];
				$user['node_id'] = $this->__nodetop($user['node_id']);
			}
			
			if($quanbu){
				//遍历全部会员
				foreach($quanbu as $v){
					//个个会员上级
					while($v['node_id']){
						$userquanb[] = $v['node_id'];
						$v['node_id'] = $this->__nodetop($v['node_id']);
					}
					
					foreach($userquanb as $k=>$s){
						if($s == $usertop[$k]){
							$topuser = $member->where(array('id'=>$s['id']))->find();
							if($topuser['type'] ==1){
								$money = $moneys  * (C("amountjin")/100);
							}else{
								$money = $moneys  * (C("amountzuan")/100);
							}
							
							$liangps = M("userpair")->where(array('user'=>$v['email'],'userthis'=>$topuser['email']))->find();
						    
							if(!$liangps){
								M("userpair")->add(array('user'=>$quanbu['email'],'userthis'=>$topuser['email']));
								$member->where(array('email'=>$topuser['email']))->setInc('bonus',$money);
								$this->recordinfo($topuser['email'],$money,"奖金","会员". $user['layer'] . "层量碰奖","增加");
								M("systembonus")->where(array('id'=>1))->setInc('liangpeng',$money);//后台数据添加统计
								$niuniu = $member->where(array('id'=>$topuser['node_id']))->find();
								//紧缩奖
								$this->jinsou($niuniu['email'],$money);
								//感恩奖
								$this->ganen($topuser['email'],$money);
							}
							
							
							
							break;
						}	
					}
					$userquanb = array();	
				}
			}
		}
	}
	
	
	
	public function __tongzx($user){
		$member = M("member");
		$syeuserss = $member->where(array('layer'=>$user['layer']))->order('type asc')->find();//查找同一节点所有的会员
		if($syeuserss['type'] ==1){
			return C("jinkabaodan");
		}else{
			return C("zuankabaodan");
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function liangpengaoff($email){
		$member = M("member");
		$user = $member->where(array('email'=>$email))->find();//当前会员
		
		//查询本会员的所以上级ID(数组)
		while($user['node_id']){
			$usertop[] = $user['node_id'];
			$user['node_id'] = $this->__nodetop($user['node_id']);
		}
		
		
		unset($usertop[$user['node_id']]);
		$syeuserss = $member->where(array('layer'=>$user['layer']))->order('type asc')->find();//查找同一节点所有的会员
	
		if($syeuserss['type'] ==1){
			$moneys = C("jinkabaodan");
		}else{
			$moneys = C("zuankabaodan");
		}
		
		
			foreach($usertop as $v){
				$topuser = $member->where(array('id'=>$v['id']))->find();
			
				$userregion0 = M("userregion")->where(array('email'=>$topuser['email'],'region'=>0,'layer'=>$user['layer']))->find();
				$userregion1 = M("userregion")->where(array('email'=>$topuser['email'],'region'=>1,'layer'=>$user['layer']))->find();
				if($userregion0['usernumber'] && $userregion1['usernumber']){
					if($userregion0['usernumber'] > $userregion1['usernumber']){
						$chishuo = $userregion0['usernumber']-$userregion1['usernumber'];
						$zuida = $userregion0['usernumber'];
						$zuixiao = $userregion1['usernumber'];
					}else{
						$chishuo = $userregion1['usernumber']-$userregion0['usernumber'];//1
						$zuida = $userregion1['usernumber'];//1
						$zuixiao = $userregion0['usernumber'];//0
					}
					
					if($user['region'] ==1){
							if($chishuo%2==0 || $chishuo ==1){
								if($chishuo >=0 ){
									if($userregion0['liang'] < $zuixiao){
										if($topuser['type'] ==1){
											//$money = $moneys * 0.13;
											$money = $moneys  * (C("amountjin")/100);
											$xiange = C("jinkarixiane");
										}else{
											//$money = $moneys * 0.15;
											$money = $moneys  * (C("amountzuan")/100);
											$xiange = C("zuankarixiane");
										}
										$statistics = M("userstatistics")->where(array("email"=>$topuser['email'],'time'=>date("Y-m-d",time())))->find();
										if(!$statistics){
											M("userstatistics")->add(array("email"=>$topuser['email'],'time'=>date("Y-m-d",time())));
											M("userstatistics")->where(array("email"=>$topuser['email'],'time'=>date("Y-m-d",time())))->setInc('amount_money',$money);
											
											M("userregion")->where(array('email'=>$topuser['email'],'layer'=>$user['layer']))->setInc("liang");
											$member->where(array('email'=>$topuser['email']))->setInc('bonus',$money);
											
												$this->recordinfo($topuser['email'],$money,"奖金","会员". $user['layer'] . "层量碰奖","增加");
												M("member")->where(array('email'=>$topuser['email']))->save(array('shifoliang'=>1));
											
											M("systembonus")->where(array('id'=>1))->setInc('liangpeng',$money);//后台数据添加统计
											//紧缩奖
											$this->jinsou($niuniu['email'],$money);
											//感恩奖
											$this->ganen($topuser['email'],$money);
										}else{
											if($statistics['amount_money']>=$xiange){
													$this->recordinfo($topuser['email'],0,"奖金","会员". "1层量碰奖(已封顶)","增加");
											}else{
												M("userstatistics")->where(array("email"=>$topuser['email'],'time'=>date("Y-m-d",time())))->setInc('amount_money',$money);
												M("userregion")->where(array('email'=>$topuser['email'],'layer'=>$user['layer']))->setInc("liang");
												$member->where(array('email'=>$topuser['email']))->setInc('bonus',$money);
												
													$this->recordinfo($topuser['email'],$money,"奖金","会员". $user['layer'] . "层量碰奖","增加");
													M("member")->where(array('email'=>$topuser['email']))->save(array('shifoliang'=>1));
											
												M("systembonus")->where(array('id'=>1))->setInc('liangpeng',$money);//后台数据添加统计
												//紧缩奖
												$this->jinsou($niuniu['email'],$money);
												//感恩奖
												$this->ganen($topuser['email'],$money);
											}
										}
									}
								}
							}
							
					}
				}
				
			}
		
	}
	
	
	
	
	public function cenpenga($email){
		$member = M("member");
		$user = $member->where(array('email'=>$email))->find();//当前会员
		
		while($user['node_id']){
			$usertop[] = $user['node_id'];
			$user['node_id'] = $this->__nodetop($user['node_id']);
		}
		
		unset($usertop[$user['node_id']]);
		
		$syeuserss = $member->where(array('layer'=>$user['layer']))->order('type asc')->find();//查找同一节点所有的会员
		
		if($syeuserss['type'] ==1){
			$money = C("jinkabaodan") * (C("touchtwo")/100);
		}else{
			$money = C("zuankabaodan") * (C("touchtwo")/100);
		}
		if($user['region'] ==0){
			
			foreach($usertop as $v){
				$topuser = $member->where(array('id'=>$v['id']))->find();
				$userregion0 = M("userregion")->where(array('email'=>$topuser['email'],'region'=>0,'layer'=>$user['layer'],'type'=>0))->find();
				$userregion1 = M("userregion")->where(array('email'=>$topuser['email'],'region'=>1,'layer'=>$user['layer'],'type'=>0))->find();
				if($userregion0['usernumber'] && $userregion1['usernumber']){
					M("userregion")->where(array('email'=>$topuser['email'],'layer'=>$user['layer']))->save(array("type"=>1));
					$member->where(array('email'=>$topuser['email']))->setInc('bonus',$money);
					$this->recordinfo($topuser['email'],$money,"奖金","会员". $user['layer'] . "层层碰奖","增加");
					M("systembonus")->where(array('id'=>1))->setInc('cengpeng',$money);//后台数据添加统计
				}else{
				}
			}
		}
		
	}

		
	public function cenpeng($email){
		$member = M("member");
		$user = $member->where(array('email'=>$email))->find();//当前会员
		//一级层碰
		$syeuserss = $member->where(array('layer'=>$user['layer'],'node_id'=>$user['node_id']))->order('type asc')->find();//查找同一节点所有的会员
		//判断级别最低的会员如果最低的能与金卡会员是5000
		if($syeuserss['type'] ==1){
			$money = C("jinkabaodan") * (C("touchone")/100);
		}else{
			$money = C("zuankabaodan") * (C("touchone")/100);
		}
	
			//查询本节点会员
			$nodeuserS = $member->where(array('layer'=>$user['layer'],'email'=>array("neq",$email),'node_id'=>$user['node_id']))->find();//查询同节点的单个会员
			if($nodeuserS){
				
					$niuniu = $member->where(array('id'=>$nodeuserS['node_id']))->find();
					$member->where(array('email'=>$niuniu['email']))->setInc('bonus',$money);
					$this->recordinfo($niuniu['email'],$money,"奖金","会员". "1层层碰奖","增加");
					M("systembonus")->where(array('id'=>1))->setInc('cengpeng',$money);//后台数据添加统计
					//$this->liangpeng($user['email']);
					//$this->liangpenga($user['email']);
				
			}
			
		
		
		
	}	
		
		
		
	
	public function lingdaoxing($email,$money){
		$member = M("member");
		$user = $member->where(array('email'=>$email))->find();
		$lingdao = $user;
		while ($lingdao) {
			$lingdao = $this->__lingdaoxingtop($lingdao);
			$member->where(array('email'=>$lingdao['email']))->setInc('achievement',$money);
			if($lingdao['level']==0){
				$syeuserss = $member->where(array('node_id'=>$lingdao['id']))->order('achievement asc')->find();
				//if($syeuserss['achievement']>=200000){
				if($syeuserss['achievement']>=C("yixingmoney")){
					$member->where(array('email'=>$lingdao['email']))->save(array('level'=>1));
					$this->usergive($lingdao['email'],$lingdao['mobile'],1);//添加奖品赠送
				}
			}elseif($lingdao['level']==1){
				$xiajiuser = $member->where(array('node_id'=>$lingdao['id'],'level'=>C("erxingmoney")))->count();
				//$moneyyi = $money * 0.02;
				$moneyyi = $money * (C("yixingtc")/100);
				$member->where(array('email'=>$lingdao['email']))->setInc('bonus',$moneyyi);
				$this->recordinfo($lingdao['email'],$moneyyi,"奖金","会员". "新生业绩奖","增加");
				M("systembonus")->where(array('id'=>1))->setInc('lingdao',$moneyyi);//添加统计
				if($xiajiuser >=2 ){
					$member->where(array('email'=>$lingdao['email']))->save(array('level'=>2));
					$this->usergive($lingdao['email'],$lingdao['mobile'],2);//添加奖品赠送
				}
			}elseif($lingdao['level']==2){
				$xiajiuser = $member->where(array('node_id'=>$lingdao['id'],'level'=>C("sanxingmoney")))->count();
				//$moneyyi = $money * 0.03;
				$moneyyi = $money  * (C("erxingtc")/100);
				$member->where(array('email'=>$lingdao['email']))->setInc('bonus',$moneyyi);
				$this->recordinfo($lingdao['email'],$moneyyi,"奖金","会员". "新生业绩奖","增加");
				M("systembonus")->where(array('id'=>1))->setInc('lingdao',$moneyyi);//添加统计
				if($xiajiuser >=2 ){
					$member->where(array('email'=>$lingdao['email']))->save(array('level'=>3));
					$this->usergive($lingdao['email'],$lingdao['mobile'],3);//添加奖品赠送
				}
			}elseif($lingdao['level']==3){
				//$moneyyi = $money * 0.04;
				$moneyyi = $money  * (C("sanxingtc")/100);
				$member->where(array('email'=>$lingdao['email']))->setInc('bonus',$moneyyi);
				$this->recordinfo($lingdao['email'],$moneyyi,"奖金","会员". "新生业绩奖","增加");
				M("systembonus")->where(array('id'=>1))->setInc('lingdao',$moneyyi);//添加统计
				$xiajiuser = $member->where(array('node_id'=>$lingdao['id'],'level'=>C("sixingmoney")))->count();
				if($xiajiuser >=2 ){
					$member->where(array('email'=>$lingdao['email']))->save(array('level'=>4));
					$this->usergive($lingdao['email'],$lingdao['mobile'],4);//添加奖品赠送
				}
			}elseif($lingdao['level']==4){
				$xiajiuser = $member->where(array('node_id'=>$lingdao['id'],'level'=>C("wuxingmoney")))->count();
				//$moneyyi = $money * 0.05;
				$moneyyi = $money  * (C("sixingtc")/100);
				$member->where(array('email'=>$lingdao['email']))->setInc('bonus',$moneyyi);
				$this->recordinfo($lingdao['email'],$moneyyi,"奖金","会员". "新生业绩奖","增加");
				M("systembonus")->where(array('id'=>1))->setInc('lingdao',$moneyyi);//添加统计
				if($xiajiuser >=2 ){
					$member->where(array('email'=>$lingdao['email']))->save(array('level'=>5));
					$this->usergive($lingdao['email'],$lingdao['mobile'],5);//添加奖品赠送
				}
			}elseif($lingdao['level']==5){
				//$moneyyi = $money * 0.06;
				$moneyyi = $money  * (C("wuxingtc")/100);
				$member->where(array('email'=>$lingdao['email']))->setInc('bonus',$moneyyi);
				$this->recordinfo($lingdao['email'],$moneyyi,"奖金","会员". "新生业绩奖","增加");
				M("systembonus")->where(array('id'=>1))->setInc('lingdao',$moneyyi);//添加统计
			}
			
		}
	}
	
	
	public function usergive($email,$mobile,$xing){
		$data['email'] = $email;
		$data['mobile'] = $mobile;
		$data['xing'] = $xing;
		$data['time'] = date("Y-m-d H:i:s", time());
		M("usergive")->add($data);
	}
	
	
	
	
	
	
	public function __lingdaoxingtop($lingdao){
		$member = M("member");
		$user = $member->where(array('id'=>$lingdao['node_id']))->find();
		if($user){
			return $user;
		}else{
			return false;
		}
	}
	
	



	

	
	public function ganen($email,$moeny){
		$member = M("member");
		$user = $member->where(array('email'=>$email))->find();//当前会员
		//$moenyyi = $moeny * 0.1;
		$moenyyi = $moeny * (C("zhituiyi")/100);
		if($user['parent_id']){
			$parent = $member->where(array('id'=>$user['parent_id']))->find();//领导人
			$member->where(array('email'=>$parent['email']))->setInc('bonus',$moenyyi);
			$this->recordinfo($parent['email'],$moenyyi,"奖金","一级直感恩奖","增加");
			M("systembonus")->where(array('id'=>1))->setInc('ganen',$moenyyi);//添加统计
			if($parent['parent_id']){
				$parenter = $member->where(array('id'=>$parent['parent_id']))->find();//二领导人
				$parentcount = $member->where(array('parent_id'=>$parenter['id']))->count();
				if($parentcount < 2){
					//$moenyer = $moeny * 0.5;
					$moenyer = $moeny * (C("zhituier")/100);
					$member->where(array('email'=>$parenter['email']))->setInc('bonus',$moenyer);
					$this->recordinfo($parenter['email'],$moenyer,"奖金","二级直感恩奖","增加");
					M("systembonus")->where(array('id'=>1))->setInc('ganen',$moenyer);//添加统计
				}
				if($parenter['parent_id']){
					$parentsan = $member->where(array('id'=>$parenter['parent_id']))->find();//二领导人
					$parentcount = $member->where(array('parent_id'=>$parentsan['id']))->count();
					if($parentcount < 2){
						//$moenysan = $moeny * 0.05;
						$moenysan = $moeny * (C("zhituisan")/100);
						$member->where(array('email'=>$parentsan['email']))->setInc('bonus',$moenysan);
						$this->recordinfo($parentsan['email'],$moenysan,"奖金","三级直感恩奖","增加");
						M("systembonus")->where(array('id'=>1))->setInc('ganen',$moenysan);//添加统计
					}
				}
			}
		}
	}
	

	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function jiandian($jiedian,$jiandianjib){
		$user = M("member");
		if($jiedian['type'] == 1){
			$user->where(array('email'=>$jiedian['email']))->setInc('bonus',C("jiandianjin"));
			$this->recordinfo($jiedian['email'],C("jiandianjin"),"奖金",$jiandianjib . "级会员见点奖","增加");
			M("systembonus")->where(array('id'=>1))->setInc('jiandian',C("jiandianjin"));//添加统计
		}elseif($jiedian['type'] == 2){
			$user->where(array('email'=>$jiedian['email']))->setInc('bonus',C("jiandianzuan"));
			$this->recordinfo($jiedian['email'],C("jiandianzuan"),"奖金",$jiandianjib . "级会员见点奖","增加");
			M("systembonus")->where(array('id'=>1))->setInc('jiandian',C("jiandianzuan"));//添加统计
		}
		if($jiedian['node_id']){
			$jiedian = $user->where(array('id'=>$jiedian['node_id']))->find();
			return $jiedian;
		}else{
			return false;
		}
	}
	
	
	
	public function recordinfo($email,$money,$type,$info,$income){
		$data['email'] = $email;
		$data['money'] = $money;
		$data['type'] = $type;
		$data['info'] = $info;
		$data['income'] = $income;
		$data['time'] = date("Y-m-d H:i:s", time());
		M("userrecord")->add($data);
	}
	
	public function recommend(){
		$User = M('member');
		$user =  M("member")->where(array('email'=>session('email')))->find();
		$data['parent_id'] =$user['id'];
		$count      = $User->where($data)->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}
	
	
	
	public function membersave(){
		if(IS_POST){
			$data = I();
			if(!$data['username']){$this->error("请输入真实姓名！");}
			//if(!$data['email']){$this->error("请输入邮箱地址！");}
			if(!$data['mobile']){$this->error("请输入电话号码！");}
			if(!$data['card']){$this->error("请输入你的身份证号码！");}
			if(!$data['weixin']){$this->error("请输入你的微信号码！");}
			if(!$data['zhifubao']){$this->error("请输入你的支付宝账户");}
			/*
			if($this->check_email($data['email'])){
			}else{
				$this->error("请输入正确的电子邮箱");
			}*/
			
			if($this->check_Mobile($data['mobile'])){
			}else{
				$this->error("请输入正确的手机号码");
			}
			
			$user = M("Member");
			$email = $user->where(array('email'=>$data['email']))->find();
			if($email){$this->error("邮箱已存在！请重新输入！");}
			$mobile = $user->where(array('mobile'=>$data['mobile']))->find();
			if($mobile){$this->error("手机号码已存在！请重新输入！");}
			
			$userdata['username'] = $data['username'];
			$userdata['email'] =$data['email'];
			$userdata['mobile'] =$data['mobile'];
			$userdata['card'] =$data['card'];
			$userdata['weixin'] =$data['weixin'];
			$userdata['zhifubao'] =$data['zhifubao'];
		
			
			$save = M("member")->where(array('email'=>session('email')))->save($userdata);
			if($save){
				$this->success("修改成功");
			}else{
				$this->error("修改失败");
			}
		}else{
			$this->display();
		}
	}
	
	
	public function updatepassword(){
		if(IS_POST){
			$data = I();
			$user = M("member")->where(array('email'=>session('email')))->find();
			if($data['xpassword'] != $data['xxpassword']){
				$this->error("确认密码不正确，请重新输入");
			}
			if(md5($data['password'])!=$user['password']){
				$this->error("原登录密码不正确，请重新输入");
			}
			$password = md5($data['xpassword']);
			$save = M("member")->where(array('email'=>session('email')))->save(array('password'=>$password));
			if($save){
				$this->success("修改成功");
			}else{
				$this->error("修改失败");
			}
		}else{
			$this->display();
		}
	}
	
	
	public function check_email($email){
		 if (ereg('^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+',$email)){
			return true;
		}else{
			return false;
		}
	}
	function check_Mobile($mobile) {
		if (!is_numeric($mobile)) {
			return false;
		}
		return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
	}
	
}