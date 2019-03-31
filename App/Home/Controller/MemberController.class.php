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
		$this->assign('leftxia',$leftxia);
		$this->assign('rightxia',$rightxia);
		$data = array_merge($userdataA,$userdataB);

		foreach($data as $k=>$v){
			$xiashu=M("member")->where(array('node_id'=>$v["id"]))->select();
			if($xiashu){
				foreach($xiashu as $kk=>$vv){
					if($vv["region"] == 1){//右区
						$vvid=$vv['id'];
						$rightxia=M("member")->where("class_id LIKE '%$vvid%'")->count();
						if($rightxia > 0){
							$data[$k]["rightxia"]=$rightxia;
						}else{
							$data[$k]["rightxia"]=0;
						}
					}else{//左区
						$vvid=$vv['id'];
						$leftxia=M("member")->where("class_id LIKE '%$vvid%'")->count();
						if($leftxia > 0){
							$data[$k]["leftxia"]=$leftxia;
						}else{
							$data[$k]["leftxia"]=0;
						}
					}
				}
			}
		}
		$this->assign('data',$data);
		$this->display();
	}
	//查看会员email是否已经存在
	public function checkuser(){
		$email=I('post.email');
		$rs=M('member')->where(array('email'=>$email))->find();
		if($rs){
			echo 1;
		}
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
//选择节点
	public function select_node($id,$region,$parent_id){
		$id=M('member')->where("id=$id")->find();
		$count=M('member')->where(array('node_id'=>$id['id']))->count();
		if($count>=2){
			$datas['region']=3;
			return $datas;
		}else if($count == 1){

			if($region == 1){
				// Admin必须推荐一个人才能注册/
				$users=M('member')->where(array('parent_id'=>$id['id']))->count();
				

					$user=M('member')->where(array('node_id'=>$id['id'],'region'=>1))->find();
					if($user){
					$datas['region']=3;
					return $datas;
					}else{
					$datas['node_id']=$id['id'];
					$datas['region']=1;
					return $datas;
					}

			}else{
				$datas['region']=5;
				return $datas;
			}

		}else{

			if($region < 1){
				$users=M('member')->where(array('parent_id'=>$id['id']))->count();

					$user=M('member')->where(array('node_id'=>$id['id'],'region'=>0))->find();
					if(!empty($user)){
					$datas['region']=3;
					return $datas;
					}else{
					$datas['node_id']=$id['id'];
					$datas['region']=0;
					return $datas;
					}

			}else{
				$datas['region']=5;
				return $datas;
			}

		}
	}

 

	//注册下级会员
	public function useradd(){
		 
		$user = M("member")->where(array('email'=>session('email')))->find();

		$levels=M('member_level')->select();

		if(!empty($user) ){
			if($user['is_decenter'] == 1){
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
					$cardcount = M("member")->where(array('card'=>$data['card']))->count();
					if($cardcount >=3){
						$this->error("一个身份证最多注册3个");
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
					$mobilecount = M("member")->where(array('mobile'=>$data['mobile']))->count();
					if($mobilecount >=3){
						$this->error("一个电话号码最多注册3个");
					}
					$user = M("member");
					$useremail = $user->where(array('email'=>session('email')))->find();

					$email = $user->where(array('email'=>$data['email']))->find();
					if($email){$this->error("登录ID已存在！请重新获取！");}
					// $mobile = $user->where(array('mobile'=>$data['mobile']))->find();
					// if($mobile){$this->error("手机号码已存在！请重新输入！");}
					$tuijian=$user->where(array('email'=>$data['tuijian']))->find();

					$jiedian=$user->where(array('email'=>$data['jiedian']))->find();
					if(!$tuijian){$this->error("直推会员不存在！请重新输入！");}
					if(!$jiedian){$this->error("节点会员不存在！请重新输入！");}
					// if($jiedian['is_activate']==1){
						$datass=array();
						$datass=$this->select_node($jiedian['id'],$data['region'],$tuijian['id']);
					// }else{
					// 	$this->error('节点会员未激活！');
					// }

					if($datass['region']==3){
						$this->error('节点会员已存在！');
					}elseif($datass['region']==4){
						$this->error('安置节点没有直推，无法注册!');
					}elseif($datass['region']==5){
						$this->error('区位选择错误，请重新选择！');
					}
					 

                                                                   
					$levelInfo=M('member_level')->where(array('id'=>$data['type']))->find();

					if($data['type'] == ""){
						$this->error("报单会员出错！请刷新重试！");
						// if($useremail['currency'] < $levelInfo['money']){
						// 	$this->error("您的电子币不足！请充值后操作！");
						// }else{
						// 	$user->where(array('email'=>session('email')))->setDec('currency',$levelInfo['money']);
						// 	$this->recordinfo(session('email'),$levelInfo['money'],"电子币","报单注册会员","减少");
						// }
					}
				 
					$layer=M('member')->where(array('id'=>$datass['node_id']))->getField('layer');
					$userdata['ip'] = get_client_ip();
					$userdata['layer'] = $layer+1;
					$userdata['username'] = $data['username'];
					$userdata['email'] =$data['email'];
					$userdata['mobile'] =$data['mobile'];
					$userdata['card'] =$data['card'];
					$userdata['level'] =$data['type'];
					$userdata['baodan_id'] =$useremail['id'];
					$userdata['weixin'] =$data['weixin'];
					$userdata['gender'] =$data['gender'];
					$userdata['zhifubao'] =$data['zhifubao'];
					$userdata['parent_id'] =$tuijian['id'];
					$userdata['password'] =md5($data['password']);
					$userdata['node_id'] =$jiedian['id'];
					$userdata['region'] =$data['region'];
					$userdata['node_id']=$datass['node_id'];
					$userdata['region']=$datass['region'];
					$userdata['addtime'] =date("Y-m-d H:i:s", time());
					$userdata['fan_time'] =date("Y-m-d H:i:s", time());
					$userdata['day_money'] =0;
					$userdata['day_time'] =time();
					$add = M("member")->add($userdata);

					if($add){

						$class=M('member')->where(array('id'=>$jiedian['id']))->getField('class_id');
						//拼接class_id 节点id --class—_id

						$user_id=M('member')->where(array('email'=>$data['email']))->getField('id');
                   
						$class_id=$class.','.$user_id;

						M('member')->where(array('id'=>$add))->save(array('class_id'=>$class_id));

						$lianguser =  M("Member")->where(array('email'=>$data['email']))->find();


					   $levels=M('member_level')->where(array('member_level'=>$lianguser['level']))->find();

						$liangp["user_id"]=$lianguser["id"];
						$liangp["gain_money"]=0;
						$liangp["gain_time"]=time();
						$liangp["l_money"] = 0;
						$liangp["r_money"] = 0;
						if($lianguser['region']==0){
							$liangp["l_money"]=$levels["money"];
						}else{
							$liangp["r_money"]=$levels["money"];
						}

						//写入数据库

						$add = M("liangpeng")->add($liangp);


						$this->userregion($userdata['email']);

						$this->success("注册成功",U("Member/team"));
						//$members=M("Member")->where("addtime > '2018-02-14 17:33:18' and is_activate=0 and is_out=0")->save(array("bonus"=>100));
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
					$this->assign('levels',$levels);
					$this->display();
				}
			}else{
				$this->error("对不起您不是报单中心资格，暂时无法注册会员");

			}

		}

	}


//推荐奖方法
	// public function tuijians($id,$omoney){//推荐奖,第二个参数是原点位升级的话原点位的价钱
public function tuijians($id){

	    $rs=M('member')->where(array('id'=>$baodan_user['id']))->save($data);//链接--会员数据库，

		$user=M("member")->where(array("id"=>$id))->find();

		$users=$this->suoyou($user["parent_id"]);

		$jiangli=M("jiangli")->where(array('id'=>1))->find();

		if($users){

			foreach($users as $k=>$v){
				if($k == 1){
					$member=M("member")->where(array("id"=>$v["id"]))->find();
					if($member["is_activate"] > 0){
						if($user["level"] >= $member["level"]){
 								    $level= M("member_level")->where(array('member_level'=>$member["level"]))->find();
									$lmoney=$level["money"];
									$moneys=$lmoney*$jiangli["tuijian1"]/100;
									// $money=$this->fuxiao($v["id"],$moneys,$user["email"]);复效奖
								$this->recordinfo($v['email'],$moneys,"奖金","一代推荐奖","增加",$user["email"]);
						}
				}else if($k == 2){
					$member=M("member")->where(array("id"=>$v["id"]))->find();
					if($member["is_activate"] > 0){
									if($user["level"] >= $member["level"]){
										$level= M("member_level")->where(array('member_level'=>$member["level"]))->find();
										$lmoney=$level["money"];
										$moneys=$lmoney*$jiangli["tuijian2"]/100;
										$this->recordinfo($v['email'],$moneys,"奖金","二代推荐奖","增加",$user["email"]);
									// 	// $money=$this->fuxiao($v["id"],$moneys,$user["email"]);
									// 	if($money > 0){
									// 	M("Member")->where(array("id"=>$v["id"]))->save(array("bonus"=>$v["bonus"]+$money));
									// 	}
									// }else{
									// 	$level= M("member_level")->where(array('member_level'=>$user["level"]))->find();
									// 	$lmoney=$level["money"];
									// 	$moneys=$lmoney*$jiangli["tuijian2"]/100;
									// 	// $money=$this->fuxiao($v["id"],$moneys,$user["email"]);
									// 	if($money > 0){
									// 	M("Member")->where(array("id"=>$v["id"]))->save(array("bonus"=>$v["bonus"]+$money));
									// 	}
									// }
									// if($money > 0){
									// 	$fuxiao_credit=$moneys-$money;

									// $this->recordinfo($v['email'],$money,"奖金","二代推荐奖","增加",$user["email"],$moneys,$fuxiao_credit);
									//$this->lingdao($v["id"],$money);
							}


						}

				 }
				//else if($k == 3){
				// 	$member=M("member")->where(array("id"=>$v["id"]))->find();
				// 		if($member["is_activate"] > 0){
				// 				if($user["level"] >= $member["level"]){
				// 					$level= M("member_level")->where(array('member_level'=>$member["level"]))->find();
				// 					$lmoney=$level["money"]-$omoney;
				// 					$moneys=$lmoney*$jiangli["tuijian3"]/100;
				// 					$money=$this->fuxiao($v["id"],$moneys,$user["email"]);
				// 					if($money > 0){
				// 					M("Member")->where(array("id"=>$v["id"]))->save(array("bonus"=>$v["bonus"]+$money));
				// 					}
				// 				}else{
				// 					$level= M("member_level")->where(array('member_level'=>$user["level"]))->find();
				// 					$lmoney=$level["money"]-$omoney;
				// 					$moneys=$lmoney*$jiangli["tuijian3"]/100;
				// 					$money=$this->fuxiao($v["id"],$moneys,$user["email"]);
				// 					if($money > 0){
				// 					M("Member")->where(array("id"=>$v["id"]))->save(array("bonus"=>$v["bonus"]+$money));
				// 					}
				// 				}
				// 				if($money > 0){
				// 					$fuxiao_credit=$moneys-$money;
				// 				$this->recordinfo($v['email'],$money,"奖金","三代推荐奖","增加",$user["email"],$moneys,$fuxiao_credit);
				// 				//$this->lingdao($v["id"],$money);
				// 			}
				// 	}
			         	}

				}
			}
	}


	// public function lingdao($id,$lmoney){//管理奖
	// 	$user=M("member")->where(array("id"=>$id))->find();
	// 	$users=$this->suoyou($user["parent_id"]);
	// 	$jiangli=M("jiangli")->where(array('id'=>1))->find();
	// 		if($users){
	// 			foreach($users as $k=>$v){
	// 				$level= M("member_level")->where(array('member_level'=>$v["level"]))->find();
	// 				if($k == 1){
	// 					if($v["level"] > 1 && $v["is_activate"] > 0){

	// 						if($user["level"] >= $v["level"]){
	// 							$moneysss=$level["money"]*$jiangli["duipeng"]*$jiangli["guanli1"]/10000;
	// 							$pmoney=$lmoney*$jiangli["guanli1"]/100;
	// 							if($moneysss >= $pmoney){
	// 								$moneys=$pmoney;
	// 							}else{
	// 								$moneys=$moneysss;
	// 							}
	// 						}else{
	// 							$moneys=$lmoney*$jiangli["guanli1"]/100;
	// 						}

	// 						$money=$this->fuxiao($v["id"],$moneys,$user["email"]);
	// 						if($money > 0){
	// 							$fuxiao_credit=$moneys-$money;
	// 						M("Member")->where(array("id"=>$v["id"]))->save(array("bonus"=>$v["bonus"]+$money));//奖励
	// 						$this->recordinfo($v['email'],$money,"奖金","一代管理奖","增加",$user["email"],$moneys,$fuxiao_credit);
	// 						}
	// 					}
	// 				}else if($k == 2){
	// 					if($v["level"] > 1 && $v["is_activate"] > 0){

	// 						if($user["level"] >= $v["level"]){
	// 							$moneys=$level["money"]*$jiangli["duipeng"]*$jiangli["guanli2"]/10000;
	// 							$pmoney=$lmoney*$jiangli["guanli2"]/100;
	// 							if($moneysss >= $pmoney){
	// 								$moneys=$pmoney;
	// 							}else{
	// 								$moneys=$moneysss;
	// 							}
	// 						}else{
	// 							$moneys=$lmoney*$jiangli["guanli2"]/100;
	// 						}

	// 						$money=$this->fuxiao($v["id"],$moneys,$user["email"]);
	// 						if($money > 0){
	// 							$fuxiao_credit=$moneys-$money;
	// 							M("Member")->where(array("id"=>$v["id"]))->save(array("bonus"=>$v["bonus"]+$money));//奖励
	// 							$this->recordinfo($v['email'],$money,"奖金","二代管理奖","增加",$user["email"],$moneys,$fuxiao_credit);
	// 						}
	// 					}
	// 				}else if($k == 3){
	// 					if($v["level"] > 1 && $v["is_activate"] > 0){

	// 						if($user["level"] >= $v["level"]){
	// 							$moneys=$level["money"]*$jiangli["duipeng"]*$jiangli["guanli3"]/10000;
	// 							$pmoney=$lmoney*$jiangli["guanli3"]/100;
	// 							if($moneysss >= $pmoney){
	// 								$moneys=$pmoney;
	// 							}else{
	// 								$moneys=$moneysss;
	// 							}
	// 						}else{
	// 							$moneys=$lmoney*$jiangli["guanli3"]/100;
	// 						}

	// 						$money=$this->fuxiao($v["id"],$moneys,$user["email"]);
	// 						if($money > 0){
	// 							$fuxiao_credit=$moneys-$money;
	// 							M("Member")->where(array("id"=>$v["id"]))->save(array("bonus"=>$v["bonus"]+$money));//奖励
	// 							$this->recordinfo($v['email'],$money,"奖金","三代管理奖","增加",$user["email"],$moneys,$fuxiao_credit);
	// 						}
	// 					}
	// 				}
	// 			}
	// 		}
	// }


	public function suoyou($id){//无限找上级
		$zishen=$this->zishen($id);
		$shuzu=array();
		if($zishen){
			if($zishen["parent_id"] != 0){
				$shuzu[1]=$zishen;
				$preferral=$zishen["parent_id"];
				$count=M("member")->count();
				$i=1;
				do{
					if($preferral != 0){
							$zishens=$this->zishen($preferral);
							$preferral=$zishens["parent_id"];
							$i++;
							$shuzu[$i]=$zishens;
						}else{
							$i=$count+1;
						}
				}while($i<$count);
			}else{
				$shuzu[1]=$zishen;
			}
		}
		return $shuzu;
	}

	public function zishen($id){
		$lists = M("member")->where(array("id"=>$id))->find();
		return $lists;
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

//找上级
	public function suoyounode($id){
		$zishen=$this->zishen($id);
		$shuzu=array();
		if($zishen){
			if($zishen["parent_id"] != 0){
				$shuzu[1]=$zishen;
				$preferral=$zishen["node_id"];
				$count=M("member")->count();
				$i=1;
				do{
					if($preferral != 0){
							$zishens=$this->zishen($preferral);
							$preferral=$zishens["node_id"];
							$i++;
							$shuzu[$i]=$zishens;
						}else{
							$i=$count+1;
						}
				}while($i<$count);
			}else{
				$shuzu[1]=$zishen;
			}
		}
		return $shuzu;
	}


//见点奖方法【拿左市场的/ 0.5%】
public function jiandian()
{

  $user=M("");




}



	public function gld(){
		if($_POST){
			$liu="tj".$_POST["liu"];
			$suoyou=M("member")->where(array("email"=>$liu))->find();
			if($suoyou){
				$r=mt_rand(1,99);
				$sasa=$liu.$r;
			}else{
				$sasa=$liu;
			}
			echo $sasa;
		}
	}
	public function member(){
		$user=M("member")->where(array('email'=>session('email')))->find();

		$uuser=M("member")->where(array('id'=>$user["parent_id"]))->find();
		$this->assign('uuser',$uuser);
		$this->assign('user',$user);

		$this->display("member");
	}


	public function usergive($email,$mobile,$xing){
		$data['email'] = $email;
		$data['mobile'] = $mobile;
		$data['xing'] = $xing;
		$data['time'] = date("Y-m-d H:i:s", time());
		M("usergive")->add($data);
	}

	//记录方法
	public function recordinfo($email,$money,$type,$info,$income,$xiaemail,$totalmoney,$fuxiao_credit){
	       
			$data['email'] = $email;
			$data['xiaemail'] = $xiaemail;
			$data['money'] = $money;
			$data['totalmoney'] = $totalmoney;
			// $data['fuxiao_credit'] = $fuxiao_credit;复销积分

			$data['expenses'] = $expenses;
			$data['manage'] = $manage;

			$data['type'] = $type;
			$data['info'] = $info;
			$data['income'] = $income;
			$data['time'] = date("Y-m-d H:i:s", time());
			M("userrecord")->add($data);

			$rs=M('daymoney_log')->where(array('email'=>$email))->order("time desc")->limit(1)->find();
			$time=$rs['time'];
			$timess=date('Y-m-d',time());

			if($timess==$time){

				$datas=array();

				if(mb_stripos($info, '管理奖') !== false){
					$datas['credit']=$fuxiao_credit+$rs['credit'];
					$datas['ling_money']=$money+$rs['ling_money'];
					$datas['totalmoney']=$totalmoney+$rs['totalmoney'];
					$datas['expenses']=$expenses+$rs['expenses'];
					$datas['manage']=$manage+$rs['manage'];
					M('daymoney_log')->where(array('email'=>$email,'time'=>$rs['time']))->save($datas);

				// }elseif($info=='量碰奖'){
				// 	M("member")->where(array("email"=>$email))->setInc("bonus",$money);
				// 	$datas['credit']=$fuxiao_credit+$rs['credit'];
				// 	$datas['liang_money']=$money+$rs['liang_money'];
				// 	$datas['totalmoney']=$totalmoney+$rs['totalmoney'];
				// 	$datas['expenses']=$expenses+$rs['expenses'];
				// 	$datas['manage']=$manage+$rs['manage'];
				// 	M('daymoney_log')->where(array('email'=>$email,'time'=>$rs['time']))->save($datas);

				// }
				}elseif(mb_stripos($info, '推荐奖')!==false){
					$datas['credit']=$fuxiao_credit+$rs['credit'];
					$datas['tui_money']=$money+$rs['tui_money'];
					$datas['totalmoney']=$totalmoney+$rs['totalmoney'];

					$datas['expenses']=$expenses+$rs['expenses'];
					$datas['manage']=$manage+$rs['manage'];

					M('daymoney_log')->where(array('email'=>$email,'time'=>$rs['time']))->save($datas);

				}
			}elseif($timess>$time){
				$datas=array();
				if(mb_stripos($info, '管理奖') !== false){

					$datas['ling_money']=$money;
					// $datas['credit']=$fuxiao_credit;
					$datas['email']=$email;
					$datas['totalmoney']=$totalmoney;

					$datas['expenses']=$expenses;
					$datas['manage']=$manage;

					$datas['time']=date("Y-m-d",time());
					M('daymoney_log')->add($datas);

				}

				// elseif($info=='量碰奖'){
				// 	M("member")->where(array("email"=>$email))->setInc("bonus",$money);
				// 	$datas['liang_money']=$money;
				// 	$datas['credit']=$fuxiao_credit;
				// 	$datas['email']=$email;
				// 	$datas['totalmoney']=$totalmoney;

				// 	$datas['expenses']=$expenses;
				// 	$datas['manage']=$manage;

				// 	$datas['time']=date("Y-m-d",time());
				// 	M('daymoney_log')->add($datas);

				// }

				elseif(mb_stripos($info, '推荐奖')!==false){

					$datas['tui_money']=$money;
					// $datas['credit']=$fuxiao_credit;
					$datas['email']=$email;
					$datas['totalmoney']=$totalmoney;

					$datas['expenses']=$expenses;
					$datas['manage']=$manage;

					$datas['time']=date("Y-m-d",time());
					M('daymoney_log')->add($datas);

				}
			}
			// $ztime=date('Y-m-d',time());
			// $zhi=M("kzhi")->where(array("time"=>$ztime))->find();
			// if(mb_stripos($info, '管理奖') !== false){

			// 	M('systembonus')->where('id=1')->setInc('lingdao',$totalmoney);

			// 	if($zhi){
			// 		$zcmoney=$zhi["zcmoney"]+$totalmoney;
			// 		$srmoney=$zhi["srmoney"];
			// 		$percentage=round($zcmoney/$srmoney,4)*100;
			// 		$zzdate["zcmoney"]=$zcmoney;
			// 		$zzdate["percentage"]=$percentage;
			// 		M('kzhi')->where(array("time"=>$ztime))->save($zzdate);
			// 	}else{
			// 		$zdatas["time"]=$ztime;
			// 		$zdatas["zcmoney"]=$totalmoney;
			// 		$zdatas["srmoney"]=0;
			// 		$zdatas["percentage"]=0;
			// 		$tianjia=M('kzhi')->add($zdatas);
			// 	}

			// }
			// elseif($info=='量碰奖'){

			// 	M('systembonus')->where('id=1')->setInc('liangpeng',$totalmoney);

			// 	if($zhi){
			// 		$zcmoney=$zhi["zcmoney"]+$totalmoney;
			// 		$srmoney=$zhi["srmoney"];
			// 		$percentage=round($zcmoney/$srmoney,4)*100;
			// 		$zzdate["zcmoney"]=$zcmoney;
			// 		$zzdate["percentage"]=$percentage;
			// 		M('kzhi')->where(array("time"=>$ztime))->save($zzdate);
			// 	}else{
			// 		$zdatas["time"]=$ztime;
			// 		$zdatas["zcmoney"]=$totalmoney;
			// 		$zdatas["srmoney"]=0;
			// 		$zdatas["percentage"]=0;
			// 		$tianjia=M('kzhi')->add($zdatas);
			// 	}

			//  }
			 //elseif($info=='报单激活会员提成' || $info=='拆分奖' || mb_stripos($info, '推荐奖')!==false){

			// 	M('systembonus')->where('id=1')->setInc('jiandian',$totalmoney);


			// 	if($info != '拆分奖'){
			// 		if($zhi){
			// 			$zcmoney=$zhi["zcmoney"]+$totalmoney;
			// 			$srmoney=$zhi["srmoney"];
			// 			$percentage=round($zcmoney/$srmoney,4)*100;
			// 			$zzdate["zcmoney"]=$zcmoney;
			// 			$zzdate["percentage"]=$percentage;
			// 			M('kzhi')->where(array("time"=>$ztime))->save($zzdate);
			// 		}else{
			// 			$zdatas["time"]=$ztime;
			// 			$zdatas["zcmoney"]=$totalmoney;
			// 			$zdatas["srmoney"]=0;
			// 			$zdatas["percentage"]=0;
			// 			$tianjia=M('kzhi')->add($zdatas);
			// 		}
			// 	}
			//  }
			//elseif($info=='报单激活会员' || $info=='报单激活会员资料费' || $info=='会员升级'){

			// 	M('systembonus')->where('id=1')->setInc('baodan',$totalmoney);


			// 		if($zhi){
			// 			$zcmoney=$zhi["zcmoney"];
			// 			$srmoney=$zhi["srmoney"]+$totalmoney;
			// 			$percentage=round($zcmoney/$srmoney,4)*100;
			// 			$zzdate["srmoney"]=$srmoney;
			// 			$zzdate["percentage"]=$percentage;
			// 			M('kzhi')->where(array("time"=>$ztime))->save($zzdate);
			// 		}else{
			// 			$zdatas["time"]=$ztime;
			// 			$zdatas["zcmoney"]=0;
			// 			$zdatas["srmoney"]=$totalmoney;
			// 			$zdatas["percentage"]=0;
			// 			$tianjia=M('kzhi')->add($zdatas);
			// 		}

			// }




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
			if(!$data['erpsd']){$this->error("请输入二级密码！");}
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
			$userdata['erpsd'] =$data['erpsd'];
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
			if($data['xerpassword'] != $data['xxerpassword']){
				$this->error("确认二级密码不正确，请重新输入");
			}
			if($data['erpassword']!=$user['erpsd']){
				$this->error("原二级密码不正确，请重新输入");
			}
			$password = md5($data['xpassword']);
			$save = M("member")->where(array('email'=>session('email')))->save(array('password'=>$password,'erpsd'=>$data['xerpassword']));
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
	public function check_Mobile($mobile) {
		if (!is_numeric($mobile)) {
			return false;
		}
		return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
	}
	//报单中心激活自身报单会员
	public function user_activate(){
		$user = M("member")->where(array('email'=>session('email')))->find();
		if($user['is_decenter']){
			if(IS_POST){
				$id=I('id');

			    $this->active_money($user['id'],$id);
				$rs=M('member')->where(array('id'=>$id))->save(array('is_activate'=>1));
				if($rs){
					$this->tuijians($id);
					// $this->tuijians($id,$money=0);
					// $this->chaifen($id,$money=0);
					// $this->liangpeng($id,$money=0);

					$result=array('status'=>1,'msg'=>'会员账号激活成功。');
					exit(json_encode($result));
				}else{
					$result=array('status'=>0,'msg'=>'操作失败，请重试！');
					exit(json_encode($result));
				}

			}else{
				$users=M('member')->where(array('baodan_id'=>$user['id'],'is_activate'=>0))->order("id asc")->select();
				$this->assign('list',$users);
				$this->display();
			}
		}else{
			$this->error('对不起您不是报单中心资格，暂时没有此权限！');
		}
	}
	//激活会员扣费
	public function active_money($baodan_id,$id){
		$baodan_user=M('member')->where(array('id'=>$baodan_id))->find();
		$user=M('member')->where(array('id'=>$id))->find();
		$level_money=M('member_level')->where(array('id'=>$user['level']))->find();
		$jiangli=M('jiangli')->where("id=1")->find();
		$ziliaomoney=$jiangli['ziliaomoney'];//资料费
		$active_money=$level_money['money']/2;//需要激活币
		$currency=$level_money['money']/2+$ziliaomoney;//需要现金币
		$currencys=$level_money['money']/2;
		if($baodan_user['currency']<$currency){
			$result=array('statsu'=>0,'msg'=>'您的现金币不足，请充值后操作！');
			exit(json_encode($result));
		}elseif($active_money>$baodan_user['activate_money']){
			$result=array('statsu'=>0,'msg'=>'您的激活币不足，请充值后操作！');
			exit(json_encode($result));
		}else{
			$data['activate_money']=$baodan_user['activate_money']-$active_money;
			$data['currency']=$baodan_user['currency']-$currency;
			//M('member')->where(array('id'=>$baodan_user['id']))->save($data);
			$baodantc=$level_money['money']*$jiangli['baodanfei']/100;//报单提成
			$baodan_tc=$baodantc;
			// $baodanchongxiao=$baodantc*$jiangli['chongxiao']/100;
			$data['bonus']=$baodan_tc+$baodan_user['bonus'];//保单提成奖励
			// $data['fuxiao_credit']=$baodanchongxiao+$baodan_user['fuxiao_credit'];//报单重消积分
			M('member')->where(array('id'=>$baodan_user['id']))->save($data);
			//扣除报单中心报单费用
			$this->recordinfo($baodan_user['email'],$currencys,"现金币","报单激活会员","减少",$user["email"],$currency,0);
			$this->recordinfo($baodan_user['email'],$active_money,"激活币","报单激活会员","减少",$user["email"],$active_money,0);
			$this->recordinfo($baodan_user['email'],$ziliaomoney,"现金币","报单激活会员资料费","减少",$user["email"],$ziliaomoney,0);
			$this->recordinfo($baodan_user['email'],$baodan_tc,"奖金","报单激活会员提成","增加",$user["email"],$baodantc,0);
			//$this->recordinfo($baodan_user['email'],$baodanchongxiao,"复销积分","复销积分奖","增加",$user["email"]);
		}

	}
	// /*
	//  * 会员升级
	// */
	// public function upgrade(){
	// 	$user = M("member")->where(array('email'=>session('email')))->find();
	// 	$upgrade=M('jiangli')->where("id=1")->getField('grade_num');
	// 	if($user['grade_num']<$upgrade && $user['is_activate']==1){
	// 		if(IS_POST){
	// 			$money=I('money');//个人升级需消费金额
	// 			$shengji=I('shengji');//升级后的级别对应的钱
	// 			$currency=$user['currency'];
	// 			$moneyss=$shengji-$money;
	// 			if($currency<$money){
	// 				echo 2;
	// 			}else{

	// 				$re=M("member")->where(array('email'=>session('email')))->setDec('currency',$money);

	// 				if($re){
	// 					M("member")->where(array('email'=>session('email')))->setInc('grade_num',1);
	// 					$suolevel= M("member_level")->where("member_level>{$user['level']}")->select();
	// 					foreach ($suolevel as $v){
	// 						if($shengji==$v['money']){
	// 							$res=M("member")->where(array('email'=>session('email')))->save(array('level'=>$v['member_level']));
	// 						}
	// 					}
	// 					if($res){
	// 						$this->tuijians($user['id'],$moneyss);
	// 						$this->chaifen($user['id'],$moneyss);
	// 						$this->liangpeng($user['id'],$money);
	// 						if($user['isout']==1){
	// 							M("member")->where(array('email'=>session('email')))->save(array('is_out'=>0));
	// 						}
	// 						$this->recordinfo(session('email'),$money,"电子币","会员升级","减少",session('email'),$money,0);
	// 						echo 1;
	// 					}
	// 				}
	// 			}
	// 		}else{
	// 			$level = M("member_level")->where(array('member_level'=>$user['level']))->find();

	// 			$suolevel= M('member_level')->where(array("member_level >{$user['level']}"))->select();


	// 			$this->assign('suolevel',$suolevel);
	// 			$this->assign('level',$level);
	// 			$this->display();
	// 		}
	// 	}elseif($user['is_activate']!=1){
	// 		$this->error('您的账号未激活,无法升级！');
	// 	}else{
	// 		$this->error('您的升级次数已用完,无法再次升级！');
	// 	}
	// }

	//报单中心删除会员
	public function del_user(){
		if(IS_POST){
			$id=I('id');

			$rs=M('member')->where(array('id'=>$id))->delete();
			if($rs){
				$result=array('status'=>1,'msg'=>'会员删除成功。');
				exit(json_encode($result));
			}else{
				 $result=array('status'=>0,'msg'=>'操作失败，请重试！');
				exit(json_encode($result));
			}

		}
	}
}
