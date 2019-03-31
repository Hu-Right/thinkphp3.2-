<?php

namespace Home\Controller;

use Home\Controller\IndexController;

class GoodsController extends IndexController {

	

	//商品列表

	public function goodslist(){

		$User = M('goods');

		$data['is_on_sale'] = "是";

		$count      = $User->where($data)->count();// 查询满足要求的总记录数

		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)

		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性

		$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('list',$list);// 赋值数据集

		$this->assign('page',$show);// 赋值分页输出

		$this->display();

	}

	



	public function show(){

		if(IS_POST){

			if(!I("post.address")){$this->error("收货人地址不能为空");}

			if(!I("post.mobile")){$this->error("收货人手机号码不能为空");}

			if(!I("post.name")){$this->error("收货人姓名不能为空");}

			if(!I("post.payment")){$this->error("支付类型不能为空");}

			if(!I("post.goods_id")){$this->error("订单出错！");}
			$size=I("post.size");
			$color=I("post.color");

			if($size&&$color){
				$re=M('goods_spec')->where("size='{$size}' and color='{$color}'")->find();
				if(!$re){
					$this->error('您选择的商品没有这个规格、颜色');
				}
			}
			$goods = M("goods")->where(array("id"=>I("post.goods_id")))->find();

			if(!$goods){

				$this->error("订单出错1");

			}

			

			$member = M("member");

			$user = $member->where(array('email'=>session('email')))->find();

			if(I("post.payment")==1){

				if(I('post.goods_money')){
					if(I('post.goods_money')>$user['money']){
						$this->error("您的账户购物币不足，无法购买！");
					}
					$member->where(array('email'=>session('email')))->setDec('money',I('post.goods_money'));

					$this->recordinfo(session('email'),I('post.goods_money'),"购物币","购买商品","减少");
				}else{
					if($goods['shop_price']>$user['money']){

						$this->error("您的账户购物币不足，无法购买！");

					}
					$member->where(array('email'=>session('email')))->setDec('money',$goods['shop_price']);

					$this->recordinfo(session('email'),$goods['shop_price'],"购物币","购买商品","减少");
				}
				$data['payment'] = "购物币支付";

			}elseif(I("post.payment")==2){

				if(I('post.goods_money')){
					if(I('post.goods_money')>$user['currency']){
						$this->error("您的账户余额不足，无法购买！");
					}
					$member->where(array('email'=>session('email')))->setDec('currency',I('post.goods_money'));

					$this->recordinfo(session('email'),I('post.goods_money'),"余额","购买商品","减少");
				}else{
					if($goods['shop_price']>$user['currency']){

						$this->error("您的账户购物币不足，无法购买！");

					}
					$member->where(array('email'=>session('email')))->setDec('currency',$goods['shop_price']);

					$this->recordinfo(session('email'),$goods['shop_price'],"购物币","购买商品","减少");
				}
				$data['payment'] = "余额支付";

			}elseif(I("post.payment")==3){

				if(I('post.goods_money')){
					if(I('post.goods_money')>$user['fuxiao_credit']){
						$this->error("您的重销积分不足，无法购买！");
					}
					$member->where(array('email'=>session('email')))->setDec('fuxiao_credit',I('post.goods_money'));

					$this->recordinfo(session('email'),I('post.goods_money'),"重销积分","购买商品","减少");
				}else{
					if($goods['shop_price']>$user['fuxiao_credit']){

						$this->error("您的账户重销积分不足，无法购买！");

					}
					$member->where(array('email'=>session('email')))->setDec('fuxiao_credit',$goods['shop_price']);

					$this->recordinfo(session('email'),$goods['shop_price'],"重销积分","购买商品","减少");
				}
				$data['payment'] = "重销积分支付";

			}else{
				$this->error("错误操作！");
			}

			$data['goods_id'] = I("post.goods_id");

			$data['mobile'] = I("post.mobile");

			$data['address'] = I("post.address");

			$data['name'] = I("post.name");

			if(I('post.goods_money')){
				$data['shop_price'] = I('post.goods_money');
			}else{
				$data['shop_price'] = $goods['shop_price'];
			}

			$data['email'] = session("email");

			$data['time'] = date("Y-m-d H:i:s", time());

			$data['size']=I("post.size");
			
			$data['color']=I("post.color");

			$add = M("order")->add($data);

			if($add){
				if($data['payment']=='购物币支付' || $data['payment']=='余额支付'){
					$member->where(array('email'=>session('email')))->setInc('fuxiao_credit',$goods['integral']);
					$this->recordinfo(session('email'),$goods['integral'],"重销积分","购买商品赠送积分","增加");
				}
				M('systembonus')->where('id=1')->setInc('baodan',$data['shop_price']);
				$this->success("购买成功",U('orderlist'));

			}else{

				$this->error("购买失败");

			}

		}else{

			$id = I("get.id");

			if(!$id){

				$this->error("未找到此商品");

			}

			$goods = M("goods")->where(array("id"=>$id))->find();

			if(!$goods){

				$this->error("未找到此商品");

			}

			$spec = M("goods_spec")->where(array("goodsid"=>$id))->select();

			$user_address=M('order')->where(array('email'=>session('email')))->order('time desc')->limit(1)->find();

			$this->assign('user_address',$user_address);

			$this->assign('spec',$spec);
			$this->assign('goods',$goods);
			
			

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

		$User = M('order');

		$data['email'] = session('email');

		$count      = $User->where($data)->count();// 查询满足要求的总记录数

		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)

		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性

		$list = $User->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('list',$list);// 赋值数据集

		$this->assign('page',$show);// 赋值分页输出

		$this->display();

	}

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

}