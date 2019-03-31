<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller {

	

	public function __construct(){

		//调用父类的构造函数

		parent::__construct();

		

		if(!session('id')){

			$this->error('必须先登录！',U('Admin/Login/login'));

		}

		if(MODULE_NAME == 'Admin' && CONTROLLER_NAME == 'Index')

			return TRUE;

		// 验证权限

		$privilege = session('privilege');

		if($privilege != '*' && !in_array(MODULE_NAME .'/'. CONTROLLER_NAME .'/'. ACTION_NAME, $privilege)){

			

			$this->error('无权访问！');

		

		}

			

	}

	

    public function index(){

		

	   $this->display();

    }

	public function mainin(){

		$data = M("systembonus")->where(array('id'=>1))->find();

		$ztime=date('Y-m-d',time());
		$kzhi = M("kzhi")->where(array("time"=>$ztime))->find();
		if(!$kzhi){
			$kzhi['percentage']=0;
		}

		$this->zongzhichu = $data['cengpeng'] + $data['liangpeng'] + $data['jiandian'] + $data['ganen'] + $data['lingdao'];

		$this->lirun = $data['chonzhi']-$data['tixian'];

		$this->kzhi = $kzhi['percentage'];

		$this->shouru= $data['chonzhi']-($data['cengpeng'] + $data['liangpeng'] + $data['jiandian'] + $data['ganen'] + $data['lingdao']);

		$this->data = $data;

	    $this->display();

    }

	

	public function cleardb(){

		// $tables = array('goods','layer','member','order','transaction','usergive','userrecord','userregion','userstatistics','withdrawals','userpair');

		// foreach($tables as $val){

		// 	$total = M("{$val}")->count();

		// 	if($total > 0){

		// 		M()->execute("truncate table t_{$val}");

		// 	}

		// }

		$data['cengpeng'] = 0;

		$data['liangpeng'] = 0;

		$data['jiandian'] = 0;

		$data['ganen'] = 0;

		$data['lingdao'] = 0;

		$data['baodan'] = 0;

		$data['chonzhi'] = 0;

		$data['tixian'] = 0;

		M('systembonus')->where("id = 1")->save($data);
		 
		
		$stars=M("jiangli")->where(array("id"=>1))->find();
		M("member")->where("id > 1")->delete();
		M("liangpeng")->where("id > 1")->delete();
		M("liangpeng")->where("id = 1")->save(array("l_money"=>0,"r_money"=>0));
		M("star")->where("id = 1")->save(array("totalstar"=>$stars["totalstar"],"havestar"=>0));
		M("member")->where("id = 1")->save(array("money"=>0,"currency"=>0,"reserve_currency"=>0,"bonus"=>0,"fuxiao_credit"=>0,"day_money"=>0,"activate_money"=>0,"chongxiao_credit"=>0,"enter_credit"=>0));
		M()->execute("truncate table t_userrecord");
		M()->execute("truncate table t_userregion");
		M()->execute("truncate table t_order");
		M()->execute("truncate table t_withdrawals");
		$this->error('清空成功');

	}

	

	public function zengsong(){

		$User = M('userrecord');

		$count      = $User->where("type='赠送'")->count();// 查询满足要求的总记录数

		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)

		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性

		$list = $User->where("type='赠送'")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('list',$list);// 赋值数据集

		$this->assign('page',$show);// 赋值分页输出

		$this->email= $email;

		$this->money= $money;

		$this->display();

	}



	public function addzengsong(){

		

		$money = I("get.money");

		if(IS_POST){

			$userlist = M('member')->select();

			if(!empty($userlist)){

				foreach($userlist as $val){

					$recha = $user = M("member")->where(array('email'=>$val['email']))->setInc('money',I("post.money"));

			        $this->recordinfo($val['email'],I("post.money"),"赠送","管理员充值","增加");

					

				}

			}

			

			if($recha){

				$this->success("充值成功");

			}else{

				$this->error("充值失败");

			}

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

	

	public function addzeng(){

		

		$id = I('id');

		$map['id'] = $id;

		$info = M('member')->where($map)->find();

		$userdata['currency'] = $info["currency"] + C("zuankabaodan");

		$userdata['zhengsong'] = $info["zhengsong"] + C("zuankabaodan");

		$userdata['iszeng'] = 2;

		

		$query = M('member')->where($map)->save($userdata);

		

		if($query){

			    $this->recordinfo($info['email'],C("zuankabaodan"),"电子币","报单送电子币","增加");

				$this->success("赠送成功");

			}else{

				$this->error("赠送失败");

			}

	}

}

