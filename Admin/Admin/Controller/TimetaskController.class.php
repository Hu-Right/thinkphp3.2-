<?php 
namespace Admin\Controller;
use Admin\Controller\IndexController;
class TimetaskController extends IndexController {
	//电子币利息
    public function lst(){
		$userrecord = M('userrecord');
		$count      = $userrecord->where()->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $userrecord->where(array('info'=>'收益'))->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
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

	public function currency_interest(){
		$userrecord = M('userrecord');
		$currency_user = $userrecord->where(array('info'=>'收益'))->order('id desc')->limit(1)->find();
		$currency_user_day = date("d", strtotime($currency_user['time']));
		$system_time_day = date("d", time());
		if($system_time_day > $currency_user_day){
			$member = M('member');
			$currency_list = $member->select();
			foreach($currency_list as $v){
				$interest = $v['currency']*C('interest')/100;
				$member->where(array('email'=>$v['email']))->setInc('currency_interest',$interest);
				$this->recordinfo($v['email'],$interest,"电子币","收益","增加");
			}
		
			$data['admin_user'] = 'admin';
			$data['info'] = '电子币利息';
			$data['time'] = date("Y-m-d H:i:s", time());
			M('adminlog')->add($data);
			$this->success("任务成功",U("lst"));
		}else{
			$this->error('今日任务已完成',U("lst"));
		
		}
		
	}
	//回报奖
	public function return_list(){
		$userrecord = M('userrecord');
		$count      = $userrecord->where()->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $userrecord->where(array('info'=>'回报奖励'))->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
    }
	
	public function return_award(){
		$return_award = I('post.return_award');
		if(empty($return_award)){
			$this->error('请输入回报奖金额',U("return_list"));
		}
		$member = M('member');
		//绿宝石、蓝宝石、红宝石、钻石级别会员
		$user['level']  = array('in','1,2,3,4');
		$count = $member->where($user)->count();
		$average_return_award =  $return_award / $count;
		
		$llhzuser = $member->where($user)->select();
		
		$userrecord = M('userrecord');
		$currency_user = $userrecord->where(array('info'=>'回报奖励'))->order('id desc')->limit(1)->find();
		$currency_user_day = date("d", strtotime($currency_user['time']));
		$system_time_day = date("d", time());
		if($system_time_day > $currency_user_day){
			foreach($llhzuser as $v){
			
				if($v['level'] == 1){
				
					if($v['return_award'] + $average_return_award <= C('lubaoshimoney')){
					
						$member->where(array('email'=>$v['email']))->setInc('return_award',$average_return_award);
						$member->where(array('email'=>$v['email']))->setInc('bonus',$average_return_award);
						$this->recordinfo($v['email'],$average_return_award,"奖金","回报奖励","增加");
					}else{
					
						$lubaoshi = C('lubaoshimoney') - $v['return_award'];
						$member->where(array('email'=>$v['email']))->setInc('return_award',$lubaoshi);
						$member->where(array('email'=>$v['email']))->setInc('bonus',$lubaoshi);
						$this->recordinfo($v['email'],$lubaoshi,"奖金","回报奖励","增加");
					}	
				}elseif($v['level'] == 2){
				
					if($v['return_award'] + $average_return_award <= C('lanbaoshimoney')){
						
						$member->where(array('email'=>$v['email']))->setInc('return_award',$average_return_award);
						$member->where(array('email'=>$v['email']))->setInc('bonus',$average_return_award);
						$this->recordinfo($v['email'],$average_return_award,"奖金","回报奖励","增加");
					
					}else{
						$lanbaoshi = C('lanbaoshimoney') - $v['return_award'];
						$member->where(array('email'=>$v['email']))->setInc('return_award',$lanbaoshi);
						$member->where(array('email'=>$v['email']))->setInc('bonus',$lanbaoshi);
						$this->recordinfo($v['email'],$lanbaoshi,"奖金","回报奖励","增加");
					}
				}elseif($v['level'] == 3){
				
					if($v['return_award'] + $average_return_award <= C('hongbaoshimoney')){
						$member->where(array('email'=>$v['email']))->setInc('return_award',$average_return_award);
						$member->where(array('email'=>$v['email']))->setInc('bonus',$average_return_award);
						$this->recordinfo($v['email'],$average_return_award,"奖金","回报奖励","增加");
					
					}else{
						$hongbaoshi = C('hongbaoshimoney') - $v['return_award'];
						$member->where(array('email'=>$v['email']))->setInc('return_award',$hongbaoshi);
						$member->where(array('email'=>$v['email']))->setInc('bonus',$hongbaoshi);
						$this->recordinfo($v['email'],$hongbaoshi,"奖金","回报奖励","增加");
					}
					
				}elseif($v['level'] == 4){
				
					if($v['return_award'] + $average_return_award <= C('zuanshimoney')){
						$member->where(array('email'=>$v['email']))->setInc('return_award',$average_return_award);
						$member->where(array('email'=>$v['email']))->setInc('bonus',$average_return_award);
						$this->recordinfo($v['email'],$average_return_award,"奖金","回报奖励","增加");
					
					}else{
						$zuanshi = C('zuanshimoney') - $v['return_award'];
						$member->where(array('email'=>$v['email']))->setInc('return_award',$zuanshi);
						$member->where(array('email'=>$v['email']))->setInc('bonus',$zuanshi);
						$this->recordinfo($v['email'],$zuanshi,"奖金","回报奖励","增加");
					}
					
				}
			}
			$data['admin_user'] = 'admin';
			$data['info'] = '回报奖';
			$data['time'] = date("Y-m-d H:i:s", time());
			M('adminlog')->add($data);
			$this->success("任务成功",U("return_list"));
		}else{
			$this->error('今日任务已完成',U("return_list"));
		
		}
	
	}
	//公司分红
	public function dividends_list(){
		$userrecord = M('userrecord');
		$count      = $userrecord->where()->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $userrecord->where(array('info'=>'业绩分红'))->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
    }
	
	public function company_dividends(){
		
		$dividends_award = I('post.dividends_award');
		if(empty($dividends_award)){
			$this->error('请输入分红金额',U("dividends_list"));
		}
		$member = M('member');
		
		$currency_list = $member->order('id asc')->select();
		
		foreach($currency_list as $user){
			
			$time = explode(' ',$user['addtime']);

			$startdate=strtotime(date("Y-m-d", time()));

			$enddate=strtotime($time[0]);
			
			$days=round(($startdate-$enddate)/3600/24) ;
			
			if($days >= 30){
				
				$data[] = $user;
				
			}
		}
		$count = count($data);

		$average_dividends_award =  $dividends_award / $count;
		
		$userrecord = M('userrecord');

		$currency_user = $userrecord->where(array('info'=>'业绩分红'))->order('id desc')->limit(1)->find();
		
		$currency_user_day = date("d", strtotime($currency_user['time']));
		
		$system_time_day = date("d", time());
		
		if($system_time_day > $currency_user_day){

			foreach($data as $v){
				$where['email'] = $v['email'];
				$where['type'] = '奖金';
				
				$summoney = $userrecord->where($where)->sum('money');
				
				if($summoney + $average_dividends_award < C('jinkabaodan')){
					
					$member->where(array('email'=>$v['email']))->setInc('bonus',$average_dividends_award);
					
					$this->recordinfo($v['email'],$average_dividends_award,"奖金","业绩分红","增加");
				
				}else{
					
					$dividends = C('jinkabaodan') - $summoney;
					
					if($dividends > 0 ){
						
						$member->where(array('email'=>$v['email']))->setInc('bonus',$dividends);
						
						$this->recordinfo($v['email'],$dividends,"奖金","业绩分红","增加");
					}	
				}
			}
			
			$data['admin_user'] = 'admin';
			$data['info'] = '业绩分红';
			$data['time'] = date("Y-m-d H:i:s", time());
			M('adminlog')->add($data);
			$this->success("任务成功",U("dividends_list"));
		}else{
			$this->error('今日任务已完成',U("dividends_list"));
		
		}
	
			
	
	}
	
	
}
	
?>