<?php 
namespace Admin\Model;
use Think\Model;

class MemberModel extends Model{
	protected $_validate = array(
		array('username','require','用户名不能为空','1'),
		array('email','require','登录ID不能为空','1'),
		array('password','require','密码必须填写！','1','regex','1'),  // 验证密码
		array('password','require','密码必须填写！','1','regex','4'),  // 验证密码
		array('addtime','require','注册时间不能为空','1'),
		array('gender','require','性别不能为空','1'),
	);
	
	//分页显示
	public function search(){
		$where = 1;
		if($key = I('get.keywords')){
			$where.= ' AND username LIKE "%' . $key . '%"';
		}
		//is_numeric:判断只能为数字
		if($userid = I('get.id')){
			$where.= ' AND id=' . $userid;
		}

		$pe = 20;
		$count = $this->where($where)->count();
		$Page  = new \Think\Page($count,$pe);
		return array(
			'data' =>$this->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select(),
			'page' =>$Page->show(),// 分页显示输出
		);
	}
	

	protected function _before_insert(&$data,$option){
		$data['password'] = md5($data['password']);
		
		$data['ip'] = get_client_ip();
	}
	
	//钩子函数 更改数据
	protected function _before_update(&$data,$option){
		if($data['password']){
			$data['password'] = md5($data['password']);
		}else{
			unset($data['password']);
		}
	}


		//查询分类方法
	public function catelist(){
		$data = $this->order("id ASC")->select();//用 DESC 表示按倒序排序(即：从大到小排序) ---降序排列---	用 ACS   表示按正序排序(即：从小到大排序)---升序排列
		return $this->_Cadigui($data);
	}
	
	
	//整理分类递归
	private function _Cadigui($data,$parent_id = 0 ,$leve = 0){
		static $var = array();
		foreach($data as $v){
			if($v['parent_id'] == $parent_id){
				$v['leve'] = $leve;
				$var[] = $v;
				$this->_Cadigui($data,$v['id'],$leve+1);
			}
		}
		return $var;
	}




}
