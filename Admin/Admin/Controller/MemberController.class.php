<?php
namespace Admin\Controller;
use Admin\Controller\IndexController;
class MemberController extends IndexController {
    public function add(){

    $user = M("member")->where(array('mobile'=>session('mobile')))->find();

		$levels=M('member_level')->select();

	 
				if(IS_POST){
					$data = I();
					if(!$data['username']){$this->error("请输入真实姓名！");}
					// if(!$data['email']){$this->error("会员ID出错请重新获取！");}
					if(!$data['mobile']){$this->error("请输入电话号码！");}
					 
					if(!$data['password']){$this->error("密码不能为空");}
					if($data['password'] != $data['rpassword']){
						$this->error("两次密码不正确！请重新输入");
					}

					// if(strlen($data['card']) < 18){
					// 	$this->error("身份证不正确");
					// }
					// $cardcount = M("member")->where(array('card'=>$data['card']))->count();
					// if($cardcount >=3){
					// 	$this->error("一个身份证最多注册3个");
					// }

					if($this->check_Mobile($data['mobile'])){
					}else{
						$this->error("请输入正确的手机号码");
					}
					$mobilecount = M("member")->where(array('mobile'=>$data['mobile']))->count();
					if($mobilecount >=1){
						$this->error("一个电话号码最多注册1个");
					}
					$user = M("member");
					$useremail = $user->where(array('email'=>session('email')))->find();
					// $email = $user->where(array('email'=>$data['email']))->find();
					// if($email){$this->error("登录ID已存在！请重新获取！");}
					$tuijian=$user->where(array('id'=>$data['tuijian']))->find();

					// $jiedian=$user->where(array('email'=>$data['jiedian']))->find();
					if(!$tuijian){$this->error("直推会员不存在！请重新输入！");}
					 
					$userdata['ip'] = get_client_ip();
					$userdata['layer'] = $layer+1;
					$userdata['username'] = $data['username'];
					// $userdata['email'] =$data['email'];
					$userdata['mobile'] =$data['mobile'];
					 
					$userdata['gender'] =$data['gender'];
					// $userdata['zhifubao'] =$data['zhifubao'];
					$userdata['parent_id'] =$tuijian['id'];
					$userdata['password'] =md5($data['password']);
					 
					$userdata['addtime'] =date("Y-m-d H:i:s", time());
					$userdata['fan_time'] =date("Y-m-d H:i:s", time());
					$userdata['day_money'] =0;
					$userdata['day_time'] =time();
					$add = M("member")->add($userdata);

					if($add){

						// $class=M('member')->where(array('id'=>$jiedian['id']))->getField('class_id');
						//拼接class_id

						$user_id=M('member')->where(array('email'=>$data['email']))->getField('id');

						$class_id=$userdata['parent_id'].','.$user_id;

						M('member')->where(array('id'=>$add))->save(array('class_id'=>$class_id));

					// 	$lianguser =  M("Member")->where(array('email'=>$data['email']))->find();


					//    $levels=M('member_level')->where(array('member_level'=>$lianguser['level']))->find();

						// $liangp["user_id"]=$lianguser["id"];
						// $liangp["gain_money"]=0;
						// $liangp["gain_time"]=time();

						// $liangp["l_money"] = 0;
						// $liangp["r_money"] = 0;

						// if($lianguser['region']==0){//左区金额

						// 	$liangp["l_money"]=$levels["money"];

						// }else{//右区金额

						// 	$liangp["r_money"]=$levels["money"];
						// }

						// //写入数据库
						// $add = M("liangpeng")->add($liangp);
						// $this->userregion($userdata['email']);
						$this->success("注册成功",U("Member/team"));

					}else{
						$this->error("注册失败");
					}
				}
				 
		$this->assign('levels',$levels);
		$this->display();
	
	
	} 



	

	 
	//推荐奖
	public function tui_jian($id,$money){//推荐奖
		$member=M("member")->where(array("id"=>$id))->find();
		$jiangli=M("jiangli")->where(array("id"=>1))->find();
		if($member["parent_id"] > 0){//推荐奖一代存在  发放奖励
			$onep_member=M("member")->where(array("id"=>$member["parent_id"]))->find();
			$totalmoney=$money*$jiangli["tuijian1"]/100;//10%
			$fenpei=$this->fenpei($onep_member["email"],$totalmoney,"一代推荐奖","动态奖励",$member["email"]);

			if($onep_member["parent_id"] > 0){//推荐奖二代存在  发放奖励
				$twop_member=M("member")->where(array("id"=>$member["parent_id"]))->find();
				$totalmoneys=$money*$jiangli["tuijian2"]/100;//5%
				$fenpei=$this->fenpei($twop_member["email"],$totalmoneys,"二代推荐奖","动态奖励",$member["email"]);
			}

		}

	}
//选择节点方法
 public function select_node($id,$region,$parent_id){
   $id=M('member')->where("id=$id")->find();
   $count=M('member')->where(array('node_id'=>$id['id']))->count();
   if($count>=2){
	 $datas['region']=3;
	 return $datas;
   }else if($count == 1){

	 if($region == 1){
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



public function check_Mobile($mobile) {
	 if (!is_numeric($mobile)) {
		 return false;
	 }
	 return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
 }


 public function save($id){
	$model = M('Member')->where(array('id'=>$id))->find();
    $user = M('member');
	if(IS_POST){
   $data=array();
   $data['id']=$id;
  //var_dump($data);die;
  $data['username'] = I('post.username');
  $data['mobile'] = I('post.mobile');
  $data['level'] = I('post.level');
  $data['gender'] = I('post.gender');
  $data['card'] = I('post.card');
  if(I('post.password')){
	if(preg_match("/^\d*$/",I('post.password'))){
	  $data['password']=md5(I('post.password'));
	}else{
	   $this->error("密码格式不正确");
	}
  }

  //print_r($data);die;
			if($user->save($data) !==false){
				$this->success('修改成功',U('lst'));
				exit;
			}else{
				$this->error('修改失败！请重试！');
			}
	}
	$model = M('Member');
	 $data = $model->find($id);
	$this->assign('data',$data);
	$this->display();
}
    public function gain(){
    	$money=I('post.money');
    	$id=I('post.id');
    	$user=M('member')->where(array('id'=>$id))->find();
    	if($money>$user['enter_credit']){
    		echo 3;
    		exit;
    	}
    	$data['bonus']=$money+$user['bonus'];
    	$data['enter_credit']=$user['enter_credit']-$money;
    	$data['chongxiao_credit']=$user['chongxiao_credit']+$money;
    	$rs=M('member')->where(array('id'=>$id))->save($data);
    	if($rs){
    		echo 1;
    		exit;
    	}else{
    		echo 2;
    		exit;
    	}

    }

	function daochu() {//导出商家信息Excel
  		$times=date("Y-m-d",time());
        $xlsData=M("userrecord")->where("time LIKE '{$times}%'")->select();
        $excel=new ExcelController();
        $excel->index($xlsData,$times);
    }
    function daochus() {//导出商家信息Excel
  		$times=date("Y-m",time());
        $xlsData=M("userrecord")->where("time LIKE '{$times}%'")->select();
        $excel=new ExcelController();
        $excel->index($xlsData,$times);
    }

    public function lst(){
		$model = D('Member');
		$data = $model->search();
		$this->assign(array(
			'data' =>$data['data'],
			'page' =>$data['page'],
		));
		$this->display();
    }


	public function del($id){

			$model = M('Member');
			$model->delete($id);

		$this->success('删除成功');
	}


	public function bdel(){
		$bid = I('post.id');
			$bid = implode(',',$bid);
			$model = M('Member');
			$model->delete($bid);
		$this->success('删除成功');
	}

	//会员树形结构
	public function Genealogy(){

		$id = I('get.id');
		$id = !$id?1:$id;
		$this->id = $id;
		$model = D('Member');
		$data = $model->catelist();


		$userdataA = array();
		foreach($data as $v){
			if($v['parent_id'] == 0){
				$userdataA[] = $v;
			}
		}
		// $userdataB = array();
		// foreach($data as $v){
		// 	if($v['region'] == 1){
		// 		$userdataB[] = $v;
		// 	}
		// }
		// $data = array_merge($userdataA,$userdataB);
		$this->assign('data',$data);
		$this->display();

	}

	//会员树形结构
	public function Genealogys(){

		$id = I('get.id');
		$data=M("team")->where(array("teamid"=>$id,"isout"=>1))->select();
		foreach($data as $k=>$v){
			$data[$k]["user"]=M("member")->where(array("id"=>$v["userid"]))->find();
		}
		$datas=M("team")->where(array("teamid"=>$id,"level"=>3,"isout"=>1))->count();
		$this->assign("count",$datas);
		$this->assign('data',$data);
		$this->display();

	}
	//会员登录
	public function userlogin(){
		$id = I('get.id');
		$user = M("member")->where(array('id'=>$id))->find();

		session('email',$user['email']);
		$this->success("登录成功","/index.php/Home/Index/index.html");


	}

	//购物币充值

	public function userrecharge(){

		$email = I("mobile");
		 
		$money = I("money");
		if(IS_POST){
			if(!I("post.recharge")){$this->error("充值类型不能为空");}
			$user = M("member")->where(array('mobile'=>$email))->find();

			if(!$user){
				$this->error("充值账号不存在");
			}
			if(I("post.recharge")==1){
			//购物币
				$recha = $user = M("member")->where(array('mobile'=>I("post.mobile")))->setInc('money',I("post.money"));
				$this->recordinfo($email 
				,I("post.money"),"奖金","管理员充值","增加");
			}elseif(I("post.recharge")==2){
			//订货币
				$recha = $user = M("member")->where(array('mobile'=>I("post.mobile")))->setInc('day_money',I("post.money"));
				$this->recordinfo($email,I("post.money"),"每日收益","管理员充值","增加");
			// }elseif(I("post.recharge")==3){
			// //电子币
			// 	$recha = $user = M("member")->where(array('email'=>I("post.email")))->setInc('activate_money',I("post.money"));
			// 	$this->recordinfo(I("post.email"),I("post.money"),"激活币","管理员充值","增加");
			}else{
				$this->error("错误操作！");
			}

			if($recha){
				// M('systembonus')->where(array('id'=>1))->setInc('chonzhi',I("post.money"));
				$this->success("充值成功",U('transaction/lst'));
			}else{
				$this->error("充值失败");
			}
		}else{


			$this->display();
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


	public function Finance(){
		$data['id'] = I("get.id");
		$User = M('userrecord');
		$count      = $User->where($data)->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where(array('email'=>$data['id']))->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出

		$this->display();


	}

	public function adddecenter(){
		
		$this->display();
	}

	public function editdecenter(){
		$email = I('post.email');
		$is_decenter = I('post.is_decenter');
		$member = D('Member');
		$user = $member->where(array('email'=>$email))->find();
		if(!empty($user)){

			$id = $member->where(array('email'=>$email))->setField('is_decenter',$is_decenter);

				if($id){
					$this->success('修改成功',U('lst'));
					exit;
				}else{
					$this->error('修改失败！请重试！');
				}

		}else{
			$this->error("会员不存在");
		}



	}
  //提交任务--首页
  public function toexamine()
  {
	  $model=D('statk');//模型方法
	  $data=$model->search();//调用模型里面的方法
	  $this->assign(
      array(
		 'data'=>$data['data'],
		 'page'=>$data['page'],
	  ));
    $this->display();
  }


//提交任务批量删除--方法
public function tobdel()
{
	$id=I('post.id');//获取id
	$aid=implode(',',$id); //将字符串转化成数组
	$model=M('statk')->delete($aid);//获取数组字符串id传入数据库将其删除
	$this->success('删除成功');
}
//单删除--方法
public function todel($id)
{
	$model = M('statk');
	$model->delete($id);
    $this->success('删除成功');
	
}
//任务状态修改--方法--- 判断状态是否为3
/***   
 * 会员id,级别,奖励，记录，
 * 
 * */
public function rema_is($id){

	 $statk=M('statk')->where(array('id'=>$id))->find();
	 $members=M('member')->where(array('id'=>$statk['userid']))->find();//通过session会话取出会员id及会员名称
     $moneys=M('jiangli')->where(array('id'=>1))->find();//日常---奖励 发圈 的钱加在 每日钱day
	 $user=$this->suoyou($members["parent_id"]);//父级id 拿钱
if($user)
    {    
     foreach($user as $k=>$v)
     {
     //一代 上级拿钱 存money
if($k==1)
{
    $member=M('member')->where(array("id"=>$members['id']))->find();//通过session会话取出会员id及会员名称
 
    $level=M("member_level")->where(array("member_level"=>$member["level"]))->find();    
 
if($member['level']==1)//推荐 一代普通会员 level 为 1
 {
	$toones= $moneys['recommendptask'];//取出一代奖励的金额 //6元  
	M("member")->where(array("id"=>$v['id']))->setInc("money",$toones);//每日会员发圈任务的钱加在会员表中
	$fenpei=$this->fenpei($v["id"], $toones,"一代推荐普通会员任务奖","任务奖励",$member["id"]);//存放记录中
}



if($member['level']==2)//推荐 一代vip 会员 等级2    
 {
  $totalmoneys= $moneys['recommendvtask'];//取出一代奖励的金额 12元     
  M("member")->where(array("id"=>$v['id']))->setInc("money",$totalmoneys);//每日vip会员发圈任务的钱加在会员表中
  $fenpei=$this->fenpei($v["id"],$totalmoneys,"一代推荐vip会员任务奖","任务奖励",$member["id"]);//存放记录中

  }           

}
//二代 自身拿钱 存 day_money  
elseif($k==2)
{
  $member=M('member')->where(array("id"=>$member['id']))->find();//通过session会话取出会员id及会员名称
  $level=M("member_level")->where(array("member_level"=>$member["level"]))->find();
if($member['level']==1)//二代推荐普通会员 完成任务的奖励
 {     
	$mones=$moneys['twogeneration'];//普通会员完成任务奖励 //3元
	
	// $fenpei=$this->fenpei($v["id"],$mones,"二代普通会员任务奖","分享朋友圈",$member["id"]);//存入记录中

	M("member")->where(array("id"=>$member['id']))->setInc("day_money",$mones);//每日vip会员发圈任务的钱加在会员表中
	$fenpei=$this->fenpei($member["id"],$mones,"二代普通会员任务奖","分享朋友圈",$v["id"]);//存入记录中

}
elseif($member['level']==2)//二代vip会员 完成 任务的奖励
{
	$mone=$moneys['twogenerations'];//vip会员完成任务奖励  4//元
	M("member")->where(array("id"=>$member['id']))->setInc("day_money",$mone);//每日vip会员发圈任务的钱加在会员表中
  $fenpei=$this->fenpei($member["id"],$mone,"二代vip会员任务奖","分享朋友圈",$v["id"]);//存入记录中
   }        		
}                                

//二代 自身拿钱
 elseif($k==2)
  {
		   $level=M("member_level")->where(array("member_level"=>$member["level"]))->find();

 if($level['member_level']==1)//二代推荐普通会员 完成任务的奖励
  {     
		$mones=$moneys['twogenerp'];//普通会员完成任务奖励 //6元
		M("member")->where(array("id"=>$member['id']))->setInc("day_money",$mones);//每日vip会员发圈任务的钱加在会员表中
	    $fenpei=$this->fenpei($member["id"],$mones,"二代普通会员任务奖","分享朋友圈",$v["id"]);//存入记录中
 }elseif($level['member_level']==2)//二代vip会员 完成 任务的奖励
  {
		$mone=$moneys['twogenerv'];//vip会员完成任务奖励  8//元
		M("member")->where(array("id"=>$member['id']))->setInc("day_money",$mone);//每日vip会员发圈任务的钱加在会员表中
		$fenpei=$this->fenpei($member["id"],$mone,"二代vip会员任务奖","分享朋友圈",$v["id"]);//存入记录中
       }        							
      }    	
    }   
 } 

}
//黄金会员满足五十人直推一代至二代奖励
public function glodes($id)
{
	$statk=M('statk')->where(array('id'=>$id))->find();
	$moneys=M('jiangli')->where(array('id'=>1))->find();//日常---奖励 发圈 的钱加在 每日钱day
	$members=M('member')->where(array('id'=>$statk['userid']))->find();//通过session会话取出会员id及会员名称

	$user=$this->suoyou($members["parent_id"]);//父级id 拿钱
if($user)
	  {    
 foreach($user as $k=>$v)
	   {
	   //一代 上级拿钱 存money 
if($k==1)
  {
	$list=M('member')->where(array('parent_id'=>$members['id']))->count();  
	
if($list>=50 && $list['level']==3){ 

	  $member=M('member')->where(array("id"=>$members['id']))->find();//通过session会话取出会员id及会员名称
	 
	  $level=M("member_level")->where(array("member_level"=>$member["level"]))->find();    
   
if($member['level']==1)//黄金会员推荐 一代普通会员完成任务奖 level 为 3
   {
	  $toones= $moneys['goldmemberones'];//取出一代奖励的金额 //12元  
	  M("member")->where(array("id"=>$v['id']))->setInc("money",$toones);//每日会员发圈任务的钱加在会员表中
	  $fenpei=$this->fenpei($v["id"], $toones,"黄金会员推荐一代普通会员任务奖","任务奖励",$member["id"]);//存放记录中
  }
  
}
  
if($member['level']==1)//黄金会员推荐 一代普通会员 等级1   自身拿钱  日收益
   {
	$totalmoneys= $moneys['goldmemberone'];//取出一代奖励的金额 6元     
	M("member")->where(array("id"=>$member['id']))->setInc("day_money",$totalmoneys);//每日vip会员发圈任务的钱加在会员表中
	$fenpei=$this->fenpei($member["id"],$totalmoneys,"黄金会员推荐一代普通会员任务奖","发圈任务奖励",$v["id"]);//存放记录中 
	}           
  }

     }
   } 
 }
public function tosave($id)
{   
 
	 if(IS_POST){		 
	  $date=I(); 
	  $statk=M('statk')->where(array('id'=>$id))->save($date);
	  $data = M('statk')->where(array('id'=>$id))->find();
	//    $members=M('member')->where(array('mobile'=>session('mobile')))->find();//通过session会话取出会员id及会员名称
	   $member=M('member')->where(array("id"=>$data['userid']))->find();//通过session会话取出会员id及会员名称
	   $moneys=M('jiangli')->where(array('id'=>1))->find();//日常---奖励 发圈 的钱加在 每日钱day
		if($data['taskstatus']==3)//完成后发钱
		{		
			$this->rema_is($id); 
			 		   
				 $lev_money=M("member_level")->where(array("member_level"=>$member["level"]))->find();  
				 if($lev_money['member_level']<=0)
				  {
					 $money=0;   
				  }	     
				  else if($lev_money['member_level']==1)
				  {       
					   $mone=$moneys['pumoney'];//普通会员完成任务奖励  --14
					   M("member")->where(array("id"=>$member['id']))->setInc("day_money",$mone);//每日普通会员发圈任务的钱加在会员表中    
					$fenpei=$this->fenpei($member["id"],$mone,"普通会员任务奖","分享朋友圈",$member["id"]);//存入记录中
					}		
				else if($lev_money['member_level']==2){
					 $mvip=$moneys['vipmoney'];//vip奖会员完成任务奖励  --30
					  M("member")->where(array("id"=>$member['id']))->setInc("day_money",$mvip);//每日vip会员发圈任务的钱加在会员表中	 
					 $fenpei=$this->fenpei($member["id"],$mvip,"vip会员任务奖","分享朋友圈",$member["id"]);//存入记录中 
				}
				else if($lev_money['member_level']==3)
				{
					$mvipp=$moneys['vipmoney'];//黄金员完成任务奖励  --30
					M("member")->where(array("id"=>$member['id']))->setInc("day_money",$mvip);//每日vip会员发圈任务的钱加在会员表中	 
				   $fenpei=$this->fenpei($member["id"],$mvipp,"黄金会员任务奖","分享朋友圈",$member["id"]);//存入记录中 

				} 			
			 	
		 } 
		 
	 if($statk!==false){
 		   $this->success('修改成功',U('toexamine')); 
 	   }
 	   else{
        $this->error('修改失败,请重新再试');
	  }	
	}
			$data = M('statk')->where(array('id'=>$id))->find();//否则查找一条记录显示			 
			$this->assign('data',$data);//渲染数据集
			$this->display();//渲染模板   
}

//分配方法 记录
	public function fenpei($email,$totalmoney,$type,$info,$son_email){//分配金额,添加记录   参数  用户的email   总钱数   奖励类型   奖励描述   触发的下级用户的email
		$jiangli=M("jiangli")->where(array("id"=>1))->find();
    //  $fuxiao_credit=$totalmoney*$jiangli["chongxiao"]/100;//重复消费
  	// $manage=$totalmoney*$jiangli["manage"]/100;//管理费
  	$money=$totalmoney;//重复消费 减去 管理费 减去总金额 在写入数据库
    $date=array();
		$date["email"]=$email;
		$date["type"]=$type;
		$date["income"]="增加";
		$date["money"]=$money;//最终得到的金额
		$date["info"]=$info;
		$date["time"]=date("Y-m-d H:i:s", time());
		$date["xiaemail"]=$son_email;//触发者

        $date["totalmoney"]=$totalmoney;
		$date["fuxiao_credit"]=$fuxiao_credit;
		$date["manage"]=$manage;
		$adds=M("userrecord")->add($date);
		// if($adds){
			// M("member")->where(array("email"=>$email))->setInc("chongxiao_credit",$fuxiao_credit);//复销积分
			// M("member")->where(array("email"=>$email))->setInc("day_money",$money);// 把奖金加到会员表中
			// if($info=="消费分红"){
			// 	M("member")->where(array("email"=>$email))->setInc("jingtai_money",$money);//奖金
			// }
		// 	return true;
		// }else{
		// 	return false;
		// }


	}



	//任务中心方法--首页
	public function taskcenter()
	{
		$model=D('center');//模型方法
		$data=$model->search();		   
		$this->assign(
		array( 		
		'data'=>$data['data'],
		'page'=>$data['page'],         
		));
        $this->display();
	}

  //任务中心--增加方法
  public function tadds()
  {
   
	if(IS_POST){
		$data['cname']=I('cname');
		$data['content']=I('content');
		$data['status']=I('status');
		$dtime=time();//当前时间戳写入成功时增加数据库
		$data['btime']=$dtime;		 
 
	if(empty($_FILES['logo']['name'][0]))
		  {
			$this->error('至少上传一张图片');
                
		  }

		  var_dump($_FILES);
    // foreach($_FILES['logo']['size'] as $key=>$value)
	//   {  
	// 		if($value>=9000000)
	// 		{
    //             $this->error('图片大小超出限制');     
	// 		}
	// 	}
	 
	 
	 

 
		
    if(empty($_FILES['logo']['name'][0])){

			$return=$uploads = $this->upload();//调用上传图片方法 //路径拼接上传 图片名字

			// $b = '/Public/Upload/logo' . $uploads['logo']['savepath'].$uploads['logo']['savename'];
			$b = '/Public/Upload/logo' . $return['0']['savepath'].$return['0']['savename'];

	foreach($return as $key=>$v)//循环并分割 
			{
                        
				$a.="#".'/Public/Upload/logo'.$return[$key]['savepath'].$return[$key]['savename'];  			 
			}  
		}

			
		 $data['logo']=$b; 
		
		   var_dump($data);
		   var_dump($b);  
		
		 die();
		
           
	// 		}else{
		
	// 			unset($data['logo']);
		
	// 		}
    // $model = M('center')->add($data);//多图上传
         
	// 		if($model!==false){

	// 			$this->success('添加成功' ,U('taskcenter'));

	// 			exit;

	// 		}else{

	// 			$this->error('添加失败！请重试！');
	// 		}
 }
	$category=M('center')->select();

	$this->assign('category',$category);
	$this->display();

}
///////////////////////////
 


           

//上传图片方法

public function upload(){

	$upload = new \Think\Upload();

	$upload->maxSize   =  9000000;

	$upload->rootPath  ='./Public/Upload/logo/';

	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg'); 

	$upload->savePath  =      '/';

	$info   =   $upload->upload();    

	if(!$info) {  

	return $upload->getError();    

	}else{       

		return $info;    

	}

}


//修改方法

public function tsave($id)
{
	$model = D('center');
	
         
	if(IS_POST){
		
			if($model->create()){ 

			if($model->save() !== false){

				$this->success('修改成功',U('taskcenter'));

				exit;

			}else{

				$this->error('修改失败！请重试！');

			}

			}else{

				$this->error($model->getError());

			}	
	}
 

	$data = M('center')->where(array('id'=>$id))->find();
	// $re=M('api')->where("id={$id}")->find();
	// $data['goods_name']=$re['goods_name'];
	$this->assign('data',$data);
	$this->display();


}

///删除方法
public function tdel($id)
{

	$model = M('center');
	$model->delete($id);

$this->success('删除成功');

}
//批量删除

public function bdels()
{
	$bid = I('post.id'); 
	$bid = implode(',',$bid);
	$model = M('center');
	$model->delete($bid);
    $this->success('删除成功');

}

	public function accountlist(){
		$User = M('userrecord');
		$count      = $User->where()->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where()->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		// $this->email= $email;
		// $this->money= $money;
		$this->display();


	}

	public function taskaward(){//任务奖记录
		$User = M('userrecord');
		$count      = $User->where("info LIKE '%任务奖' ")->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where("info LIKE '%分享朋友圈' ")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出

		$this->display();
	}

	public function tuijianjiang(){//推荐奖记录
		$User = M('userrecord');
		$count      = $User->where("info LIKE '%动态奖励' ")->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where("info LIKE '%动态奖励' ")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		// $this->email= $email;
		// $this->money= $money;
		$this->display();
	}



//消费分红记录
public function bonuslist(){
	$User = M('userrecord');
	$count      = $User->where()->count();// 查询满足要求的总记录数
	$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
	$data['info'] = ['like',"%".'分红'."%"];
	$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
	$this->assign('list',$list);// 赋值数据集
	$this->assign('page',$show);// 赋值分页输出
	$this->display();
}

//无限找上级
public function node_suoyou($id){//无限找上级
		$zishen=$this->zishen($id);
		$shuzu=array();
		if($zishen){
			if($zishen["node_id"] != 0){
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
//找上级
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

//自身
public function zishen($id){
	$lists = M("member")->where(array("id"=>$id))->find();
	return $lists;
}

//重复消费
public function cf($money)
{
	$jianli=M("jiangli");

	$list=$jianli->where(array('id'=>1))->find();

	$xf=$money*$list['chongxiao']/100;

	$gl=$xf+$money*$list['manage']/100;

    return $gl;

}


//存入--记录中方法[向数据库增加 字段值]
public function recordinfo1($email,$money,$type,$info,$income,$xiaemail,$time3){

	if($money > 0){//当money大于零时执行下面语句

		$jianglis=M("jiangli")->where(array('id'=>1))->find();
		//奖励添加到userrecord表中
		$data['email'] = $email;

		$data['xiaemail'] = $xiaemail;

		$data['money'] = $money;

		$data['type'] = $type;

		$data['info'] = $info;

		$data['income'] = $income;

		// $data['time'] = $time3;
   $data['time'] =  date("Y-m-d H:i:s", $time3);

	 //var_dump($data['time']);
     //	 die;
		//增加数据表名
	 $a=	M("userrecord")->add($data);

		$rs=M('daymoney_log')->where(array('email'=>$email))->order("time desc")->limit(1)->find();

		$time=$rs['time'];

		$timess=date('Y-m-d',time());

		if($timess==$time){

			$datas=array();

			if($info=='见点奖'){

				$datas['totalmoney']=$money+$rs['totalmoney'];
				$datas['yu_money']=$money+$rs['yu_money'];

				M('daymoney_log')->where(array('email'=>$email,'time'=>$rs['time']))->save($datas);

			}elseif(mb_stripos($info, '推荐奖') !== false){
				$datas['totalmoney']=$money+$rs['totalmoney'];
				$datas['tui_money']=$money+$rs['tui_money'];
				M('daymoney_log')->where(array('email'=>$email,'time'=>$rs['time']))->save($datas);

			}elseif($info=='分红'){

				$datas['totalmoney']=$money+$rs['totalmoney'];

				$datas['fen_money']=$money+$rs['fen_money'];

				M('daymoney_log')->where(array('email'=>$email,'time'=>$rs['time']))->save($datas);
			}
			// }elseif(mb_stripos($info, '复消奖') !== false){
			// 	$datas['totalmoney']=$money+$rs['totalmoney'];
			// 	$datas['rebuy_money']=$money+$rs['rebuy_money'];
			// 	M('daymoney_log')->where(array('email'=>$email,'time'=>$rs['time']))->save($datas);
			// }

			}elseif(mb_stripos($info, '推荐奖') !== false){
				$datas['email']=$email;
				$datas['totalmoney']=$money;
				$datas['tui_money']=$money;
				$datas['time']=date("Y-m-d",time());
				M('daymoney_log')->add($datas);

			}elseif($info=='分红'){
				$datas['email']=$email;
				$datas['totalmoney']=$money;
				$datas['fen_money']=$money;
				$datas['time']=date("Y-m-d",time());
				M('daymoney_log')->add($datas);

			}
		}


	}
}


?>
