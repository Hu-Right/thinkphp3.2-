<?php
namespace Home\Controller;
use Think\Controller;
class CodeController extends IndexController{
	public function index(){

      $this->display();
	}
	public function code(){
		//$uid=session('uid');
		  $mobile=session('mobile'); 
	
		  $member=M("member")->where(array('mobile'=>$mobile))->find();
		  $uid=$member['id'];
		 
	    $url="http://192.168.31.235:8906/index.php/home/register/registe/id/".$uid;
	    //  $url="http://www.weizhuanwangzhuan.com/index.php/Home/Register/registe/id/".$uid;
          $level = 'L';	  
	      $size = 3;     
		  $margin=2; 
		  
		   
		//  include_once "ThinkPHP/Library/Vendor/phpqrcode/phpqrcode.php";
		// vendor('phpqrcode.phpqrcode');
		require_once ("ThinkPHP/Library/Vendor/phpqrcode/phpqrcode.php");
			// \QRcode::png($url,false,$level,$size,$margin);
			 \QRcode::png($url,false,$level,$size,$margin);		
			$this->display();
		 
	}
}