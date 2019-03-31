<?php 
namespace Admin\Model;
use Think\Model;

class RoleModel extends Model{
	protected $_validate = array(
		array('role_name','require','角色名称不能为空','1'),
		array('role_name','','角色名称不能重复','1','unique'),
		);
	
	
	//分页显示
	public function search(){
		$where = 1;
		$pe = 10;
		$count = $this->where($where)->count();
		$Page  = new \Think\Page($count,$pe);
		return array(
			'data' =>$this->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id ASC')->select(),
			'page' =>$Page->show(),// 分页显示输出
		);
	}

	

	protected function _before_insert(&$data){
	
		$data['pri_id_list'] = implode(',',$data['pri_id_list']);
		//var_dump($data['pri_id_list']);die();
	}
	

	protected function _before_update(&$data){
		$data['pri_id_list'] = implode(',',$data['pri_id_list']);
	}
	
}
