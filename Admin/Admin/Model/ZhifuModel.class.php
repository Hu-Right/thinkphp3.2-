<?php 
namespace Admin\Model;
use Think\Model;

class ZhifuModel extends Model{
	
	
	//分页显示
	public function search(){
		$where = 1;
		$pe = 10;
		$count = $this->where($where)->count();
		$Page  = new \Think\Page($count,$pe);
		return array(
			'data' =>$this->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select(),
			'page' =>$Page->show(),// 分页显示输出
		);
	}

	
	
	
	
}
