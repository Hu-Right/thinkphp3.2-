<?php 
namespace Admin\Controller;
use Admin\Controller\IndexController;
class BonusController extends IndexController {
	//设置
//制度方法
	public function Bonus(){
		
		if(IS_POST){
			 
			//报单--金额--设置 修改值
			$dataso["money"]=$_POST["pucard"];//普通会员金额
			$datast["money"]=$_POST["vipcard"];// vip会员金额
	
			$datasth["goldpe"]=$_POST["goldcard"];// 黄金会员人数
			   
             //更新-会员等级--数据库 数据
			M("member_level")->where("id=1")->save($dataso);
			M("member_level")->where("id=2")->save($datast);
			M("member_level")->where("id=3")->save($datasth);
			 
		   
			$data["pucard"]=$_POST["pucard"];
			$data["vipcard"]=$_POST["vipcard"];
			$data["goldcard"]=$_POST["goldcard"];
			
			//分享朋友圈金额设置
			$data["pumoney"]=$_POST["pumoney"];//普通会员分享金额
			$data["vipmoney"]=$_POST["vipmoney"];//vip
	

		
			//黄金会员直推任务奖金设置 50人以上的奖励
			$data["goldmemberone"]=$_POST["goldmemberone"];//一代普通会员自身金额
			$data["goldmemberones"]=$_POST["goldmemberones"];//一代普通会员上级金额

			$data["vipmembertwo"]=$_POST["vipmembertwo"];//二代vip会员自身金额
			$data["vipmembertwos"]=$_POST["vipmembertwos"];//二代vip会员上级金额


		 
			// 推荐会员做任务奖金设置
			$data["recommendpcard"]=$_POST["recommendpcard"];//推荐普通会员金额		 
     		$data["recommendptask"]=$_POST["recommendptask"];//推荐普通会员完成 ，任务金额
			
		
			$data["twogeneration"]=$_POST["twogeneration"];	//二代普通会员发圈
            $data["twogenerations"]=$_POST["twogenerations"];//二代vip会员发圈
			
	
			
			$data["recommendvip"]=$_POST["recommendvip"];//推荐vip会员金额	
			$data["recommendvtask"]=$_POST["recommendvtask"];//推荐vip会员完成 ，任务金额
			
			$data["twogenerp"]=$_POST["twogenerp"];//二代普通会员发圈   
			$data["twogenerv"]=$_POST["twogenerv"];//二代vip会员发圈
			
			 
			//会员提现手术费
			$data["tixian"]=$_POST["tixian"];

			//会员升级次数
			// $data["grade_num"]=$_POST["grade_num"];
			
			//动态奖励税收百分比设置
			// $data["expenses"]=$_POST["expenses"];
			
			//管理费
 
			//更新数据奖励表
			M("jiangli")->where("id=1")->save($data);
			
			$this->success('编辑成功！');
		
		}else {
			
			//保单金额
			$model=M("jiangli")->where("id=1")->find();
			
			$this->assign("model",$model);
			
			$this->display();
		}
	}
	
	
	
}
	
?>