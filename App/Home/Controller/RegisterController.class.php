<?php
namespace Home\Controller;

use Think\Controller;

class RegisterController extends CommonController
{
    //注册首页方法
    public function registe()
    {
        if (IS_POST) {
            $parent_id = I('parent_id');//从隐藏域中获取到  
            $mobile = I('mobile');//手机号
            $password = md5(I('password'));//密码
            $exist = M("member")->where(array('mobile' => $mobile))->select();
            
            if ($exist) {
                $this->ajaxReturn(array('status' => 1, 'message' => '注册手机号已存在'));
            }   
            
            if(!$parent_id){
                
                $this->ajaxReturn(array('status'=>1,'message'=>'请扫码注册'));
              }


            $pdata=M('member')->where('id='.$parent_id)->find();// id--pid
             
           
            $sonLev=$pdata['region']+1;//被推人层级

            $sda=M('member')->where(array('region'=>$sonLev),array('parent_id'=>$parent_id))->select();  
             
            $counts=count($sda);//统计
            
            $counts=0?1:$counts+1; //三元

            $data['level']=0;//会员级别 

            $data['region']=$pdata['region']+1;//层级 差数 直推代数

            $data['class_id']=$pdata['class_id']."/".$counts;//直推代数 --[calss_id]    
           
            $data['parent_id']=$parent_id; 
            
            $data['mobile'] = $mobile;//存手机号 

            $data['password'] = $password;//存密码
            
            $data['addtime'] = date("Y-m-d H:i:s", time());//注册时间  
                    
            $result = $this->userAdd($data);
    
            
            if ($result !== false) {

                $gold=M("member")->where(array('parent_id'=>$parent_id))->count();

            if($gold>=50 && $gold['parent_id']!==0)
                { 
                    M("member")->where(array('id'=>$gold['id']))->save(array('level'=>3));             
                }  
                $this->ajaxReturn(array('status' => 0, 'message' => '注册成功'));
            } else {
                $this->ajaxReturn(array('status' => 1, 'messages' => '注册失败'));
            }
        } else {
            $this->display();//渲染模板
        }
    }

    public function userAdd($data)
    {
        if (isset($data["parent_id"])) {
            
            $member=M("member")->where(array('id'=>$data['parent_id']))->select();
            
            $result = $member = M("member")->add($data);
       
             
        } else {
            $data['parent_id'] = 0;//存父级id 为零 
            $result = $member = M("member")->adds($data);
        }
        return $result;
    }

// 推荐奖
/**
 * 推荐人 id 
 * 
 * 推荐人 父级
 * 
 * SELECT COUNT(parent_id) FROM t_member ;
 * 
 * 会员记录 
 * */
// 黄金会员 直推50人 改变级别
 
 public function read($result)
 {

  //会员id-pid
  $member=M("member")->where(array("id"=>$result))->find();
       
  //推荐奖励  
  $award=M("jiangli")->where(array('id'=>1))->find();
    
//   $user=$this->suoyou($member["id"]);
  
 if($user)
  {    
     foreach($user as $k=>$v)
     {
       //一代
       if($k==1)
        {
         $level=M("member_level")->where(array("member_level"=>$v["level"]))->find();     
         if($level['member_level']==1)//推荐 一代普通会员 level 为 1
         {
          $one=M("member")->where(array("id"=>$v["parent_id"]))->find();//id ==pid
                
          $totalmoney=$award['recommendpcard'];//取出一代奖励的金额 //14元    

          $fenpei=$this->fenpei($one["id"],$totalmoney,"一代推荐普通会员奖","动态奖励",$member["id"]);//存放记录中
    }
        
      elseif($v['level']==2)//推荐 一代vip 会员 等级2    
         {
          $one=M("member")->where(array("id"=>$v["parent_id"]))->find();//id ==pid
                
          $totalmoney=$award['recommendvip'];//取出一代奖励的金额    

          $fenpei=$this->fenpei($one["id"],$totalmoney,"一代推荐vip会员奖","动态奖励",$member["id"]);//存放记录中
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

public function fenpei($email,$totalmoney,$type,$info,$son_email=0){//分配金额,添加记录   参数  用户的email   总钱数   奖励类型   奖励描述   触发的下级用户的email
		
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
    // $date["fuxiao_credit"]=$fuxiao_credit;
    // $date["manage"]=$manage;
    $adds=M("userrecord")->add($date);
    if($adds){
        return true;
    }else{
        return false;
    }
}


 
}


?>




