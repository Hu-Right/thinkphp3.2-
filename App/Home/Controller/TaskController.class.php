<?php
namespace Home\Controller;
use Home\Controller\IndexController;
class TaskController extends IndexController {
	
//首页--方法
    public function task(){
		 
		$this->display();
	}
//公告--方法
public function look()
{
	$data=M("gonggao")->where(array("is_out"=>1))->find();
	
	$this->assign("data",$data);
	$this->display(); 
}


//领取任务--方法
	public function gettask(){
		$list=M('center')->select();	 		
		$this->assign('list',$list); 
		$this->display();
	}
//领取方法详情页方法;任务一
	public function getones()
    {    $id=I('get.id');  
	     $lists=M('center')->where(array('id'=>$id))->select();		
		 $this->assign('lists',$lists); 
		 $this->display();
	}



// public function getones()
//     {    $id=I('get.id');  
           
// 	     $lists=M('center')->where(array('id'=>$id))->select();	
// 	      foreach ($lists as $key => $value) {
// 	       $lists[$key]['logo']=explode("*", $value['logo']);
// 	    }
	   
// 		 $this->assign('lists',$lists); 
// 		 $this->display();
// 	}
//提交任务 主要是向数据库里写入数据
/*任务表与会员表与提交任务表   
 *会员有三种 1.2.升级
 */
	public function type()
	{  
		 $member=M('member')->where(array('mobile'=>session('mobile')))->find();//通过session会话取出会员id及会员名称
         $level=M('member_level')->where(array('member_level'=>$member['level']));//取出会员等级
		 $money=M('jiangli')->where(array('id'=>1))->find();//	
		 $level=M('center')->select();//将任务表中的名称显示出来 最后需要 写入 提交 任务审核表中 taskname
	      if(!empty($member)){ 
          if(IS_POST){
		  if($_FILES['logo']['name']){//内置函数

			$uploads = $this->upload();//调用上传图片方法 //路径拼接上传 图片名字
		
			$data['logo'] = '/Public/Upload/logo' . $uploads['logo']['savepath'].$uploads['logo']['savename'];
			}else{
		
				unset($data['logo']);
			}     
			if(!$data['logo']){
				$this->error('请提交上传图片'); 
			   }
		 $date=I();
		 $levels=M('center')->where(array('id'=>$date['type']))->find();
		 $date['type']=$levels['cname'];
		 $times=time();//当前时间戳
         $data['taskstatus']=1;//默认审核中       
         $data['taskname']=$date['type']; //任务名称 
		 $data['userid']=$member['id'];//提交人id
		 $data['stime']=$times;//提交时间
	     $add=M('statk')->add($data);//任务名称写入任务类型中	 
		 if($add){        
		   $this->success('提交成功,请等待审核!',U('task'));	
		 }		 		 
		 else{          	
  	     $this->error('提交失败');
	
		}	
	}		 
        $this->assign('level',$level);  
        $this->display();
	}
}
//上传图片方法
public function upload(){

	$upload = new \Think\Upload();
	$upload->maxSize   =   3048576;
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





//提交任务模板
 public function template()
 {
 $this->display();
 } 
/**
 
 * 
 */
//提交任务生成记录 
public function record()
{ 
  $member=M('member')->where(array('mobile'=>session('mobile')))->find();//通过session会话取出会员id及会员名称 
  $stlist=M('statk')->where(array('userid'=>$member['id']))->select();
 foreach($stlist as $key=>$v){
	 $stlist[$key]['time']=strtotime($stlist[$key]['time']);
 }

//   $date=M('userrecord')->select();
//   $this->assign('$date',$date); 
  $this->assign('stlist',$stlist);
  $this->display();
}


}