<?php
 namespace Home\Controller;
 use Think\Controller;
 class PerinfoController extends IndexController{
/** save
 * 1.支付金额
 * 2.支付等级
 * 3.触发推荐奖
 * 改变 day_money 的值  
 * 在显示 总金额
 */ 
	//信息方法       
    public function info(){

	$day_times=$this->dayt();//调用时间戳方法	 
	$list=M("member")->where(array('mobile'=>session('mobile')))->find();
	// $map['day_time'] = array('lt',$day_times);
    // $map['mobile'] =session('mobile'); 	
	// $lists=M("member")->where($map)->find();
	$a=$list['day_money'];//日任务收益			
    $count=$list['money'];//总收益 = 每日推荐任务+每日上级推荐完成任务+推荐
	 
  if($list)
  {
	 if($list['day_time']<$day_times)//
		{
		    M("member")->where("id=".$list['id'])->setInc('money',$a);//日收益，存进总收益里面
     		M("member")->where(array("id"=>$list["id"]))->save(array("day_money"=>0));//更新 会员数据库 中的 每日收益 为0的数据			
		}
			  	
 if($list['day_money']>0)//日收益--如果大于零 
	 {		
		M("member")->where(array('id'=>$list['id']))->save(array("day_time"=>$day_times));//存进时间
	      }
           
  }
    // $list=M("member")->where(array('mobile'=>session('mobile')))->find();
    //  $a=$list['day_money'];//日任务收益			
    // $count=$a+=$list['money'];//总收益 = 每日推荐任务+每日上级推荐完成任务+推荐
	$d=M("withdrawals")->where(array('email'=>$list['mobile']))->sum('money');//以提现收益总计  
	
	$this->assign([            
			          'list' =>$list,           
					   'd'=>$d, 
					   'count'=>$count   
				   ]); 
		$this->display();
	}
//时间判断
private function dayt()
{
	$now=time();//当前时间戳
	$begin="1537113601";//初始时间戳昨天凌晨1秒 
	$time2=$now-$begin;//两个时间相减得时差
	$day=3600*24;//一天时间 86400 /60/60 	  
	$day_ones=ceil($time2/$day);//时间
    return $day_ones;	  
}


 
///支付宝对接
public function apliy()
{
	$member=M("member")->where(array('mobile'=>session('mobile')))->find();//前
	
	if($_POST){	
		$dat=I('post.');
		$users=M("member")->where(array('id'=>$member['id']))->save($dat);	 
    if($member["level"]==1)//再次升级的时候
		{
			require_once ("ThinkPHP/Library/Vendor/Alipay/wappay/service/AlipayTradeService.php");
			require_once ("ThinkPHP/Library/Vendor/Alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php");
			$config=C('Alipay');
			$mes=M("member")->where(array('mobile'=>session('mobile')))->find();
			$member_leverl=M("member_level")->where(array('member_level'=>$mes['levels']))->find(); //后
            $le=M("member_level")->where(array('member_level'=>1))->find();//折半    
			$money=$member_leverl['money']-$le['money'];
			$id=$mes['id']; //会员id 
			$out_trade_no=$id.time();//订单用户号
			$subject='会员升级';//订单名称
			$totalAmount=$money;//订单金额
		 //    $data=array(
		 // 		'id'=>$id,
		 // 		'type'=>$data,
		 // 		'trade_code'=>$out_trade_no,
		 // 		'trade_name'=>$subject,
		 // 		'trade_money'=>$totalAmount,
		 // 	 );
	 
		 $data=array(
			 'userid'=>$id,
			 'otype'=>$dat,
			 'orders'=>$out_trade_no,
			 'orname'=>$subject,
			 'ormoney'=>$totalAmount,
		  );	 
			$payRequestBuilder=new \AlipayTradeWapPayContentBuilder();
			$payRequestBuilder->setOutTradeNo($out_trade_no);
			$payRequestBuilder->setSubject($subject);
			$payRequestBuilder->setTotalAmount($totalAmount);
			$payRequestBuilder->setTimeExpress($timeout_express);
			$payResponse = new \AlipayTradeService($config);
			//$this->recordinfo($id,$totalAmount,$type,$subject,$income,$out_trade_no)
			$res=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']); 

		}else{
		$dat=I('post.');  
	    $users=M("member")->where(array('id'=>$member['id']))->save($dat);	
	   require_once ("ThinkPHP/Library/Vendor/Alipay/wappay/service/AlipayTradeService.php");
	   require_once ("ThinkPHP/Library/Vendor/Alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php");
	   $config=C('Alipay');
	   $mes=M("member")->where(array('mobile'=>session('mobile')))->find();
	   $member_leverl=M("member_level")->where(array('member_level'=>$mes['levels']))->find(); //后
	   $money=$member_leverl['money'];       
	//    $money=100;
	   $id=$mes['id']; //会员id 
	   $out_trade_no=$id.time();//订单用户号
	   $subject='会员升级';//订单名称
	   $totalAmount=$money;//订单金额
	//    $data=array(
	// 		'id'=>$id,
	// 		'type'=>$data,
	// 		'trade_code'=>$out_trade_no,
	// 		'trade_name'=>$subject,
	// 		'trade_money'=>$totalAmount,
	// 	 );

	$data=array(
		'userid'=>$id,
		'otype'=>$dat,
		'orders'=>$out_trade_no,
		'orname'=>$subject,
		'ormoney'=>$totalAmount,
	 );	 
	   $payRequestBuilder=new \AlipayTradeWapPayContentBuilder();
	   $payRequestBuilder->setOutTradeNo($out_trade_no);
	   $payRequestBuilder->setSubject($subject);
	   $payRequestBuilder->setTotalAmount($totalAmount);
	   $payRequestBuilder->setTimeExpress($timeout_express);
	   $payResponse = new \AlipayTradeService($config);
	 //$this->recordinfo($id,$totalAmount,$type,$subject,$income,$out_trade_no)
	   $res=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']); 
	    
   }

    }

   $member=M("member")->where(array('mobile'=>session('mobile')))->find();
   $data=M('member')->where(array('id'=>$member['id']))->find();
	$this->assign('data',$data);		 
}
 public function notify_url(){//买家付完款后商家
	echo "收款成功";
 }
 public function return_url(){
	//  echo "付款成功";  点击触发方法
	$me=M("member")->where(array('mobile'=>session('mobile')))->find();
	$leveles=M("member")->where(array('id'=>$me['id']))->save(array('level'=>$me['levels']));
	if($leveles){
	  $this->read();
	//    var_dump($a);
	//    die();
	}
  $this->success('付款成功',(U('Index/index')));

 }

 
public function read()
{

 //会员id-pid
 $member=M("member")->where(array('mobile'=>session('mobile')))->find();
	  
 //推荐奖励  
 $award=M("jiangli")->where(array('id'=>1))->find();
   
//  $user=$this->suoyou($member["id"]);
$user=$this->suoyou($member["parent_id"]);
 
if($user)
 {    
	foreach($user as $k=>$v)//$v 上级id
	{
	  //一代
	  if($k==1)
	   {
		$member=M("member")->where(array("id"=>$member["id"]))->find();
		$level=M("member_level")->where(array("member_level"=>$member["level"]))->find();     
if($member['level']==1)//推荐 一代普通会员 level 为 
		{
		//  $one=M("member")->where(array("id"=>$v["parent_id"]))->find();//id ==pid 		   
		 $totalmoney=$award['recommendpcard'];//取出一代奖励的金额 //14元    
		 $fenpei=$this->fenpei($v["id"],$totalmoney,"一代推荐普通会员奖","动态奖励",$member["id"]);//存放记录中
		}    

 if($member['level']==2)//推荐 一代vip 会员 等级2    
		{  
		//  $one=M("member")->where(array("id"=>$v["parent_id"]))->find();//id ==pid		   
		 $totalmoney=$award['recommendvip'];//取出一代奖励的金额    
		 $fenpei=$this->fenpei($v["id"],$totalmoney,"一代推荐vip会员奖","动态奖励",$member["id"]);//存放记录中
		        
           }
	    }
     }	
	
 }
 return $user;

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

//记录表
public function fenpei($email,$totalmoney,$type,$info,$son_email=0){//分配金额,添加记录   参数  用户的email   总钱数   奖励类型   奖励描述   触发的下级用户的email
   $jiangli=M("jiangli")->where(array("id"=>1))->find();  
 $money=$totalmoney;//重复消费 减去 管理费 减去总金额 在写入数据库
$date=array();
   $date["email"]=$email; // 
   $date["type"]=$type;
   $date["income"]="增加";
   $date["money"]=$money;//最终得到的金额
   $date["info"]=$info;
   $date["time"]=date("Y-m-d H:i:s", time());
   $date["xiaemail"]=$son_email;//触发者
   $date["totalmoney"]=$totalmoney; 
   $adds=M("userrecord")->add($date);
  if($adds){
// 	// 把奖金加到会员表中去	->setInc("day_money",$money)
// 	// 	M("member")->where(array("email"=>$email))->setInc("jingtai_money",$money);//奖金
M("Member")->where(array("id"=>$email))->setInc("money",$totalmoney );
// ->save(array("day_money"=>$v["day_money"]+$totalmoney));
// // 	return true;
// // }else{
// // 	return false;
 }
}
 

  
//支付宝 --前台真坑
public function alipay(){
	if(IS_GET){
	  $id=session('mobile');
	  $data=M('member')->where('mobile='.$id)->find();
	  $this->assign('data',$data);
	  $this->display();		
	}else{
	   $data=I('post.');
	   $id=session('mobile');
	   $list=M('member')->where('mobile='.$id)->find(); 
	  
	//    if($list['zhifubao']){
	// 	   $this->ajaxReturn(array('status'=>0,'msg'=>'支付宝已经绑定'));
	//    }
			$res=M('member')->where(array('id'=>$list['id']))->save($data);
			 
			if($res===false){
				$this->ajaxReturn(array('status'=>0,'msg'=>'绑定失败'));
			}else{
			   $this->ajaxReturn(array('status'=>1,'msg'=>'绑定成功'));
		 }
	  
	}
}


//银行卡
public function bank(){
	if(IS_GET){
		$id=session('mobile');
		$data=D('member')->where('mobile='.$id)->find();
		$this->assign('data',$data);
	  $this->display();	
	}else{
		 $data=I('post.');
		 
		 $id=session('mobile');
		 $da=D('member')->where('mobile='.$id)->find();
		 $data['id']=$da['id'];
	 
	   $res=D('member')->where($data)->find();
	   if($res["bank_account"]){
		   $this->ajaxReturn(array('status'=>0,'msg'=>'银行卡已经绑定'));
	   }
	   $res=D('member')->where('id='.$data['id'])->save($data);

	  
	   if($res===false){
		   $this->ajaxReturn(array('status'=>0,'msg'=>'绑定失败'));
	   }else{
		   $this->ajaxReturn(array('status'=>1,'msg'=>'绑定成功'));
	   }
	}
   
  
}
//统计 伞下 一代  二代人数
//会员团队
	public function team(){
		
	 
		$f_data=array();
		//一级会员
		  $norsql=" select count from( select  level_name, count(*) as count from t_member_level tml left join t_member tm on tm.level=tml.member_level where tm.region=1 group by level_name) yiji where level_name ='普通会员' ";
		  $normal=M('member')->query($norsql);

		  $vipsql=" select count from( select  level_name, count(*) as count from t_member_level tml left join t_member tm on tm.level=tml.member_level where tm.region=1 group by level_name) yiji where level_name ='vip会员' ";
		   $vip=M('member')->query($vipsql);
		  
		  $goldsql=" select count from( select  level_name, count(*) as count from t_member_level tml left join t_member tm on tm.level=tml.member_level where tm.region=1 group by level_name) yiji where level_name ='黄金会员' ";
			$gold=M('member')->query($goldsql);
			
			
			$f_data['normal']=$normal;
			$f_data['vip']=$vip;
			$f_data['gold']=$gold;
		  
			 $fdata=array();
			foreach ($f_data as $key => $value) {
			 $fdata['normal']=$f_data['normal'][0]['count'];
			 $fdata['vip']=$f_data['vip'][0]['count'];
			 $fdata['gold']=$f_data['gold'][0]['count'];
			}
							  
	  //二级会员
			 $s_data=array();
		   $snorsql=" select count from( select  level_name, count(*) as count from t_member_level tml left join t_member tm on tm.level=tml.member_level where tm.region=2 group by level_name) erji where level_name ='普通会员' ";
		   $snormal=M('member')->query($snorsql);

		   $svipsql=" select count from( select  level_name, count(*) as count from t_member_level tml left join t_member tm on tm.level=tml.member_level where tm.region=2 group by level_name) erji where level_name ='vip会员' ";
		   $svip=M('member')->query($svipsql);
		  
		  $sgoldsql=" select count from( select  level_name, count(*) as count from t_member_level tml left join t_member tm on tm.level=tml.member_level where tm.region=2 group by level_name) erji where level_name ='黄金会员' ";
			 
		  
		     $sgold=M('member')->query($sgoldsql); 
		     $s_data['normal']=$snormal;
			 $s_data['vip']=$svip;
			 $s_data['gold']=$sgold;
			 
			 $sdata=array();
			  foreach ($s_data as $key => $value) {
			 $sdata['normal']=$s_data['normal'][0]['count'];
			 $sdata['vip']=$s_data['vip'][0]['count'];
			 $sdata['gold']=$s_data['gold'][0]['count'];
			}
			 $this->assign('fdata',$fdata);
			 $this->assign('sdata',$sdata);
			 $this->display();
  
 
 }


	//钱包---提现
	public function wallet()
	{
		$data=M("member")->where(array('mobile'=>session('mobile')))->find();
	    $a=$data['day_money'];//日任务收益
	    $count=$data['money'];//总收益 = 每日推荐任务+每日上级推荐完成任务+推荐奖
		$User=M("withdrawals") ;//统计已提现的金额
		$d= $User->where(array('email='.$data['mobile']))->sum('tixian');//拼接上
		// $d='97.00';
		$this->assign([
		  'data'=>$data,
		  'd'=>$d,
		  'count'=>$count			  
		]);  		 
		// $this->assign('data',$data);
		$this->display();

	}

//显示提现 记录
public function withdraw()
{
 $mobile=session('mobile');	
 $list=M("withdrawals")->where(array('email'=>$mobile))->select();
 $this->assign('list',$list);	
 $this->display();

}	
//提现
/***
 * id session
 * 验证余额
 * 余额减少
 * 扣除手术费
 * 写入记录表中
 */
public function putforward(){
if(IS_POST)
{        
     if(I("post.money")<=0){$this->error("请输入正确的提现金额");}
	 $da=I("post.money");
	 $member=M("member"); 
	 $user=$member->where(array('mobile'=>session('mobile')))->find();
	 if($user['bank']==0 && $user['bank_account']==0)
	 {

		$this->error("请您先绑定银行卡!",U('bank'));
		// $this->ajaxReturn(array('status'=>3,'message'=>'请您先绑定银行卡!'));
	 } 
	 if($user['money']<$da)
	 {
		   $this->error("您的余额不足!请重新输入提现金额");
		// $this->ajaxReturn(array('status'=>2,'message'=>'您的余额不足!请重新输入提现金额!'));
	 }

	 $member->where(array('mobile'=>session('mobile')))->setDec('money',$da);
	 $user=$member->where(array('mobile'=>session('mobile')))->find();
	 $this->recordinfo($user['id'],$da,"余额","提现操作","减少");
		  
	 $put=M('jiangli')->where('id=1')->getField('tixian');
	 
	 $money = $da * ((100 - $put)/100);
	 $data['money'] = $money;//金额
	 $data['info'] = '提现';//操作提示
	 $data['mode']=$user['bank'];//银行卡类型
	 $data['khhxx']= $user['open_bank'];//开户行
	 $data['accounts']= $user['bank_account'];//银行卡
	 $data['email']= $user['mobile'];//手机号
	 $data['time'] = date("Y-m-d H:i:s", time());
	 $data['name'] =$user['username'];//姓名
	 $data['shouxu']=$da*$put/100;//手续费
	 
	 $add = M("withdrawals")->add($data);

	 if($add){
		 
	 
		M("systembonus")->where(array('id'=>1))->setInc('tixian',$data['money']);

		// $user=M("member")->where(array('mobile'=>session('mobile')))->find();
	
		  $this->success("提现信息提交成功，请等待客服人员审核",U('info'));
 
		//  $this->ajaxReturn(array('status'=>0,'message'=>'提现信息提交成功，请等待客服人员审核!'));

	 }else{
		 $this->error("提现信息提交失败");

		//  $this->ajaxReturn(array('status'=>1,'message'=>'提现信息提交失败!'));
	 }

}else{

	$data=M("member")->where(array('mobile'=>session('mobile')))->find();
	$a=$data['day_money'];//日任务收益
	$count=$data['money'];//总收益 = 每日推荐任务+每日上级推荐完成任务+推荐奖
    $this->assign('count',$count); 
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


	
}