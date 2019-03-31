<?php
namespace Home\Controller;
use Home\Controller\IndexController;
class DecgoodsController extends IndexController {
	
	//商品列表
	public function goodslist(){
		
		$member = M("member")->where(array('email'=>session('email')))->find();
		if($member['is_decenter'] == 1){
			$User = M('decgoods');
			$data['is_on_sale'] = "是";
			$count      = $User->where($data)->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
			$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->display();
		}else{
			$this->error("对不起您不是报单中心资格，暂时无法在报单中心购物");
		
		}
		
	}
	

	public function show(){
		if(IS_POST){
			if(!I("post.address")){$this->error("收货人地址不能为空");}
			if(!I("post.mobile")){$this->error("收货人手机号码不能为空");}
			if(!I("post.name")){$this->error("收货人姓名不能为空");}
			if(!I("post.num")){$this->error("购买数量不能为空");}
			if(!I("post.payment")){$this->error("支付类型不能为空");}
			if(!I("post.goods_id")){$this->error("订单出错！");}
			$goods = M("decgoods")->where(array("id"=>I("post.goods_id")))->find();
			
			if(!$goods){
				$this->error("订单出错1");
			}
			
			$member = M("member");
			$user = $member->where(array('email'=>session('email')))->find();
			$buymoney = I("post.num")*$goods['shop_price'];
			if(I("post.payment")==2){
			
				if($buymoney > $user['reserve_currency']){
					$this->error("您的账户太极研学币不足，无法购买！请充值后操作。");
				}
				
				$member->where(array('email'=>session('email')))->setDec('reserve_currency',$buymoney);
				$this->recordinfo(session('email'),$buymoney,"太极研学币","购买商品","减少");
			}else{
				$this->error("错误操作！");
			}	
			
			
			
			$data['goods_id'] = I("post.goods_id");
			$data['mobile'] = I("post.mobile");
			$data['address'] = I("post.address");
			$data['name'] = I("post.name");
			$data['shop_price'] = $goods['shop_price'];
			$data['num'] = I("post.num");
			$data['payment'] = "太极研学币支付";
			$data['email'] = session("email");
			$data['time'] = date("Y-m-d H:i:s", time());
			
			$add = M("decorder")->add($data);
			if($add){
				//推荐订货奖励
				// $tuijianuser = $member->where(array('id'=>$user['parent_id']))->find();
				// if(empty($tuijianuser)){
				 	$this->success("购买成功",U('orderlist'));
				// }else{
				// 	$bonusmoney = $buymoney*C('referee')/100;
				// 	$bonus = $tuijianuser['bonus'] + $bonusmoney;
				// 	$member-> where(array('id'=>$user['parent_id']))->setField('bonus',$bonus);
				// 	$this->recordinfo($tuijianuser['email'],$bonusmoney,"奖金","推荐订货","增加");
				// 	$this->success("购买成功",U('orderlist'));
				// }
				
			}else{
				$this->error("购买失败");
			}
			
		}else{
			$id = I("get.id");
			if(!$id){
				$this->error("未找到此商品");
			}
			$goods = M("decgoods")->where(array("id"=>$id))->find();
			if(!$goods){
				$this->error("未找到此商品");
			}
			$this->goods = $goods;
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
	
	
	
	
	public function orderlist(){
		$member = M("member")->where(array('email'=>session('email')))->find();
		if($member['is_decenter'] == 1){
			$User = M('decorder');
			$data['email'] = session('email');
			$count      = $User->where($data)->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
			$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->display();
		}else{
			$this->error("对不起您不是报单中心资格，暂时无法浏览报单订单");
		
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}