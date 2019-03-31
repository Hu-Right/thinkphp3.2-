<?php
namespace Home\Controller;
use Home\Controller\IndexController;
class UpgradeController extends IndexController {
	
		
	//测试使用
	public function c(){
		print_r($this-> duojisheng("15653232319@qq.com"));
	}
	
	
	//一级升级补偿
	public function yijisheng($email){
		$member = M("member");
		$user = $member->where(array('email'=>$email))->find();//当前会员
		//一级层碰
		$chengmoney = 5000;
		$liangmoney = 100;
		//查询本节点会员
		$nodeuserS = $member->where(array('layer'=>$user['layer'],'email'=>array("neq",$email),'type'=>2,'node_id'=>$user['node_id']))->find();//查询同节点的单个会员
		if($nodeuserS){
			$niuniu = $member->where(array('id'=>$nodeuserS['node_id']))->find();
			//层碰
			$member->where(array('email'=>$niuniu['email']))->setInc('bonus',$chengmoney);
			$this->recordinfo($niuniu['email'],$chengmoney,"奖金","会员升级层碰补差奖","增加");
			M("systembonus")->where(array('id'=>1))->setInc('cengpeng',$chengmoney);//后台数据添加统计
			//量碰
			$member->where(array('email'=>$niuniu['email']))->setInc('bonus',$liangmoney);
			$this->recordinfo($niuniu['email'],$liangmoney,"奖金","会员升级量碰补差奖","增加");
			M("systembonus")->where(array('id'=>1))->setInc('liangpeng',$liangmoney);//后台数据添加统计
		}
	}	
		
	public function duojisheng($email){
		$member = M("member");
		$user = $member->where(array('email'=>$email))->find();//当前会员
		//查询本会员的所以上级ID(数组)
		while($user['node_id']){
			$usertop[] = $user['node_id'];
			$user['node_id'] = $this->__nodetop($user['node_id']);
		}
		unset($usertop[$user['node_id']]);
		$chengmoney = 5000*0.5;
		$liangmoney = 100;
		foreach($usertop as $v){
			$topuser = $member->where(array('id'=>$v['id']))->find();
			$member->where(array('email'=>$topuser['email']))->setInc('bonus',$chengmoney);
			$this->recordinfo($topuser['email'],$chengmoney,"奖金","会员". $user['layer'] . "层会员升级层碰补差奖","增加");
			M("systembonus")->where(array('id'=>1))->setInc('cengpeng',$chengmoney);//后台数据添加统计
			//量碰
			$member->where(array('email'=>$topuser['email']))->setInc('bonus',$liangmoney);
			$this->recordinfo($topuser['email'],$liangmoney,"奖金","会员". $user['layer'] . "层会员升级量碰补差奖","增加");
			M("systembonus")->where(array('id'=>1))->setInc('cengpeng',$liangmoney);//后台数据添加统计
			
		}
	}
	
	

	//系统框架
    public function index(){
		$member = M("member");
		$user = $member->where(array('email'=>session('email')))->find();
		if(IS_POST){
			if($user['type']==2){$this->error("您已是钻卡会员无需再进行升级操作");}
			if($user['currency']>=7500){
				$member->where(array('email'=>$user['email']))->setDec('currency',7500);
				$member->where(array('email'=>$user['email']))->save(array('iszeng'=>2));
				$this->recordinfo($user['email'],7500,"健康币","会员升级消费","减少");
				$save = M("member")->where(array('email'=>$user['email']))->save(array('type'=>2));
				$layershu = $member->where(array('layer'=>$user['layer'],'type'=>2))->count();
				if($layershu == pow(2,$user['layer']-1)){
					$layeruser = $member->where(array('layer'=>$user['layer'],'type'=>2))->select();
					$this->duojisheng($user['email']);
				}
				
				$this->yijisheng($user['email']);
				if($save){
					echo "<script type='text/javascript'>alert('升级成功');top.location.href='/Home/Index/index';</script>";
				}else{
					$this->error("升级失败。");
				}
				
			}else{
				$this->error("健康币不足请充值后操作。");
			}
			
			
		}else{
			if($user['type']==2){
				$this->error("您已是钻卡会员无需再进行升级操作");
			}
			$this->display();
		}
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	//查询上级并返回
	public function __nodetop($node_id){
		$member = M("member");
		$user = $member->where(array('id'=>$node_id))->find();
		if($user){
			return $user['node_id'];
		}else{
			return false;
		}
	}

	//添加资金记录
	public function recordinfo($email,$money,$type,$info,$income){
		$data['email'] = $email;
		$data['money'] = $money;
		$data['type'] = $type;
		$data['info'] = $info;
		$data['income'] = $income;
		$data['time'] = date("Y-m-d H:i:s", time());
		M("userrecord")->add($data);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}