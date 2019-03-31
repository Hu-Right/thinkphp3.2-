<?php
namespace Admin\Controller;
use Admin\Controller\IndexController;
class MemberController extends IndexController {

    public function add(){
		$user = M("member")->where(array('email'=>session('email')))->find();
		$levels=M('member_level')->select();

				if(IS_POST){
					$data = I();
					if(!$data['username']){$this->error("请输入真实姓名！");}
					if(!$data['email']){$this->error("会员ID出错请重新获取！");}
					if(!$data['erpsd']){$this->error("请输入二级密码！");}
					if(!$data['rerpsd']){$this->error("请确认二级密码！");}
					if(!$data['mobile']){$this->error("请输入电话号码！");}
					if(!$data['card']){$this->error("请输入身份证号码！");}
					// if(!$data['weixin']){$this->error("请输入微信号码！");}
					// if(!$data['zhifubao']){$this->error("请输入支付宝账户");}
					if(!$data['password']){$this->error("密码不能为空");}
					if($data['erpsd'] != $data['rerpsd']){
						$this->error("二级密码两次输入不匹配！请重新输入");
					}
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
					if($jiedian['is_activate']==1){
						$datass=array();
						$datass=$this->select_node($jiedian['id'],$data['region'],$tuijian['id']);
					}else{
						$this->error('节点会员已存在！');
					}

					if($datass['region']==3){
						$this->error('节点会员已存在！');
					}elseif($datass['region']==5){
						$this->error('区位选择错误，请重新选择！');
					}


					$levelInfo=M('member_level')->where(array('id'=>$data['level']))->find();

					if($data['level'] == ""){

						$this->error("报单会员出错！请刷新重试！");
						// if($useremail['currency'] < $levelInfo['money']){
						// 	$this->error("您的电子币不足！请充值后操作！");
						// }else{
						// 	$user->where(array('email'=>session('email')))->setDec('currency',$levelInfo['money']);
						// 	$this->recordinfo(session('email'),$levelInfo['money'],"电子币","报单注册会员","减少");
						// }
					}
					// $jiandianjib = 1;
					// $jiandian = $jiedian;
					// while ($jiandian) {
					// 	if($jiandianjib <=12){

					// 		$jiandian = $this->jiandian($jiandian,$jiandianjib);
					// 		$jiandianjib++;
					// 	}else{
					// 		$jiandian = false;
					// 	}
					// }
					$layer=M('member')->where(array('id'=>$datass['node_id']))->getField('layer');
					$userdata['ip'] = get_client_ip();
					$userdata['layer'] = $layer+1;
					$userdata['username'] = $data['username'];
					$userdata['email'] =$data['email'];
					$userdata['mobile'] =$data['mobile'];
					$userdata['card'] =$data['card'];
					$userdata['level'] =$data['level'];
					$userdata['baodan_id'] =$useremail['id'];
					$userdata['weixin'] =$data['weixin'];
					$userdata['gender'] =$data['gender'];
					$userdata['zhifubao'] =$data['zhifubao'];
					$userdata['parent_id'] =$tuijian['id'];
					$userdata['password'] =md5($data['password']);
					//$userdata['node_id'] =$jiedian['id'];
					//$userdata['region'] =$data['region'];
					$userdata['node_id']=$datass['node_id'];
					$userdata['region']=$datass['region'];
					$userdata['addtime'] =date("Y-m-d H:i:s", time());
					$userdata['fan_time'] =date("Y-m-d H:i:s", time());
					$userdata['day_money'] =0;
		            $userdata['is_activate'] =1;
					$userdata['day_time'] =time();
					$userdata['erpsd'] =$data['erpsd'];
					$add = M("member")->add($userdata);


					if($add){

						// $memberlevel = M("member_level")->where(array('id'=>$userdata['level']))->find();

						// $class=M('member')->where(array('id'=>$jiedian['id']))->getField('class_id');
						// //拼接class_id
						// $user_id=M('member')->where(array('email'=>$data['email']))->getField('id');
						// $class_id=$class.','.$user_id;
						// M('member')->where(array('id'=>$add))->save(array('class_id'=>$class_id));
						// $lianguser =  M("Member")->where(array('email'=>$data['email']))->find();
						// $liangp["user_id"]=$lianguser["id"];
						// $liangp["l_money"]=0;
						// $liangp["r_money"]=0;
						// $liangp["gain_money"]=0;
						// $liangp["gain_time"]=time();
						// $add = M("liangpeng")->add($liangp);


						// //赠送新注册会员等值的购物币
						// M('member')->where(array('email'=>$userdata['email']))->setInc('money',$memberlevel['money']);
						// //赠送购物币写入userrecord表
						// $data['email'] = $userdata['email'];
						// $data['money'] = $memberlevel['money'];
						// $data['type'] = '购物币';
						// $data['info'] = "注册赠送购物币";
						// $data['income'] = '增加';
						// $data['time'] = date("Y-m-d H:i:s", time());
						// M("userrecord")->add($data);

						// $this->userregion($userdata['email']);




			  //回调函数左右区人数统计；
			   $this->team_add($userdata['email']);

						$this->success("注册成功",U("Member/lst"));
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

		$email = I("get.email");
		$money = I("get.money");
		if(IS_POST){
			if(!I("post.recharge")){$this->error("充值类型不能为空");}
			$user = M("member")->where(array('email'=>I("post.email")))->find();
			if(!$user){
				$this->error("充值账号不存在");
			}
			if(I("post.recharge")==1){
			//购物币
				$recha = $user = M("member")->where(array('email'=>I("post.email")))->setInc('money',I("post.money"));
				$this->recordinfo(I("post.email"),I("post.money"),"购物币","管理员充值","增加");
			}elseif(I("post.recharge")==2){
			//订货币
				$recha = $user = M("member")->where(array('email'=>I("post.email")))->setInc('currency',I("post.money"));
				$this->recordinfo(I("post.email"),I("post.money"),"电子币","管理员充值","增加");
			}elseif(I("post.recharge")==3){
			//电子币
				$recha = $user = M("member")->where(array('email'=>I("post.email")))->setInc('activate_money',I("post.money"));
				$this->recordinfo(I("post.email"),I("post.money"),"激活币","管理员充值","增加");
			}else{
				$this->error("错误操作！");
			}

			if($recha){
				M('systembonus')->where(array('id'=>1))->setInc('chonzhi',I("post.money"));
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
		$data['email'] = I("get.email");

		$User = M('userrecord');
		$count      = $User->where($data)->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
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

	public function guanlijiang(){//管理将记录
		$User = M('userrecord');
		$count      = $User->where("info LIKE '%管理奖' ")->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where("info LIKE '%管理奖' ")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		// $this->email= $email;
		// $this->money= $money;
		$this->display();
	}
	// public function liangpengjiang(){//量碰奖记录
	// 	$User = M('userrecord');
	// 	$count      = $User->where("info LIKE '量碰奖' ")->count();// 查询满足要求的总记录数
	// 	$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	// 	$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
	// 	$list = $User->where("info LIKE '量碰奖' ")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
	// 	$this->assign('list',$list);// 赋值数据集
	// 	$this->assign('page',$show);// 赋值分页输出
	// 	// $this->email= $email;
	// 	// $this->money= $money;
	// 	$this->display();
	// }

	public function tuijianjiang(){//推荐奖记录
		$User = M('userrecord');
		$count      = $User->where("info LIKE '%推荐奖' ")->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->where("info LIKE '%推荐奖' ")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		// $this->email= $email;
		// $this->money= $money;
		$this->display();
	}

	// public function kzhi(){//K值记录
	// 	$User = M('kzhi');
	// 	$count      = $User->where()->count();// 查询满足要求的总记录数
	// 	$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	// 	$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
	// 	$list = $User->where()->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
	// 	$this->assign('list',$list);// 赋值数据集
	// 	$this->assign('page',$show);// 赋值分页输出
	// 	// $this->email= $email;
	// 	// $this->money= $money;
	// 	$this->display();
	// }

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
//执行消费分红方法
public function dobonus(){

	$member = M("member")->select();
	$time2 =time();//系统当前时间

if(!empty($member)){
foreach ($member as $value) {
$userrecord = M("userrecord")->where(array("email"=>$value['email'],"info"=>"分红"))->order('id desc')->find();

if(!empty($userrecord)){
	$time1=strtotime($userrecord['time']);
	//  $time = strtotime($time1[0]) - strtotime($time2);
	$time =$time2-$time1;
	$day7=3600*24*7;
	//var_dump($time1);
	//die;
	if($time<=$day7){
		$this->error("本周以执行分红！");
	}else {

	$bl=M("jiangli")->where(array("id"=>1))->find();

	$memberlevel=M("member_level")->where(array('member_level'=>$value['level']))->find();

	$money=$memberlevel['money']*$bl['baodanfei']/100;

		$money=$this->cf($money);

			$this->recordinfo1($value['email'],$money,"奖金","分红","增加",'admin',$time2);
			$this->success("分红成功",U("Member/bonuslist"));
	}

}else {
	$bl=M("jiangli")->where(array("id"=>1))->find();

	$memberlevel=M("member_level")->where(array('member_level'=>$value['level']))->find();

	$money=$memberlevel['money']*$bl['baodanfei']/100;

	$this->recordinfo1($value['email'],$money,"奖金","分红","增加",'admin',$time2);
	$this->success("分红成功",U("Member/bonuslist"));

}

}

}

}



//分享分红
public function sare($id,$money){

	$user=M("member")->where(array("id"=>$id))->find();

	$jiangli=M("jiangli")->where(array('id'=>1))->find();

		if($user["node_id"] != 0){//如果不等于零

			$users=$this->suoyou($user["node_id"]);//调用找上级方法

			if($users){

				foreach($users as $k=>$v){

		        $ppuser=M("member")->where(array("id"=>$v["id"]))->find();

				$level=M("member_level")->where(array("member_level"=>$ppuser["level"]))->find();

		 				$liangpeng=M("liangpeng")->where(array("user_id"=>$v["id"]))->find();//用户的量碰信息

		                 if($k == 1){//判断会员位置

							if($user["region"] == 1){//新添用户属于1是右区

							// $right=$liangpeng["r_money"]+$money;//消费分红的金额

							 $right=$liangpeng["r_money"];//会员右区的金额

							 $letf=$liangpeng["l_money"];//会员左区的金额

	      					   $lingyige=M("member")->where(array("region"=>0,"node_id"=>$v["id"]))->find();//查找是否在 左区||节点

								$lingyilevel=M("member_level")->where(array("member_level"=>$lingyige["level"]))->find();//查找会员级别是否相等

		 							if($right > $liangpeng["l_money"]){//右区是大区

		                             if($liangpeng["l_money"] == 0){//右区金额等于零则更新数据库

		                           M("liangpeng")->where(array("user_id"=>$v["id"]))->save(array("r_money"=>$right,"l_money"=>$liangpeng["l_money"]));

								}

								else{

					              if($v["is_activate"] > 0){//是否是激活状态

	  								$right=$liangpeng["l_money"];

								     if($letf<$right){

										 $fenxiang=$money*$jiangli['duipeng']/1000;

										  $this->recordinfo($v['email'],$fenxiang,"奖金","消费分红","增加",$user["email"]);

	 									}
									}
								}
							}
						}
					}

				}

			}
		}

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
