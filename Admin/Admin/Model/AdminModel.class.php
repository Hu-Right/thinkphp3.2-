<?php
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{
	protected $_validate = array(
	array('username','require','用户名必须填写！','1'),  // 验证用户名 
	array('password','require','密码必须填写！','1','regex','1'),  // 验证密码
	array('password','require','密码必须填写！','1','regex','4'),  // 验证密码
	//用户名是唯一的
	array('username','','用户名已经存在不能重复！请重新操作','','unique','1'),
	array('username','','用户名已经存在不能重复！请重新操作','','unique','2'),
	array('chk_code','_chkcode','验证码不正确','','callback','4'),
	);
	
	//理员登录验证码检测
	protected function _chkcode($data){
		$verify = new \Think\Verify();
		return $verify->check($data,'');
	}

	// 取出一个管理员所有的权限并放到session中
	private function _putPriToSession($role_id)
	{
		// 根据角色ID取出这个角色的权限id
		$roleModel = M('Role');
		$roleModel->field('pri_id_list')->find($role_id);
		$priModel = M('Privilege');
		if($roleModel->pri_id_list == '*')
		{
			session('privilege', '*');
			/****************** 取出所有的前两级的权限 ***********************************/
			// 取出所有顶级的权限
			$menu = $priModel->where('parent_id=0')->select();
			// 循环每一个顶级权限再取出二级权限
			foreach ($menu as $k => $v)
			{
				$menu[$k]['sub'] = $priModel->where('parent_id='.$v['id'])->select();
			}
			session('menu', $menu);
		}
		else 
		{
			// 根据权限的ID取出这些权限对应的方法名称
			$_priData = $priModel->field('id,parent_id,pri_name,module_name,controller_name,action_name,CONCAT(module_name,"/",controller_name,"/",action_name) url')->where("id IN({$roleModel->pri_id_list})")->select();
			$menu = array();
			// 把这个数组处理成一个一维数组
			$priData = array();
			foreach ($_priData as $k => $v)
			{
				// 挑出顶级权限
				if($v['parent_id'] == 0)
					$menu[] = $v;
				$priData[] = $v['url'];
			}
			// $menu中保存的是从$_priData这个数组中挑出来的所有的顶级权限
			session('privilege', $priData);
			// 循环每一个顶级的权限取出二级权限
			foreach ($menu as $k => $v)
			{
				// 再从$_priData里挑出每个顶级分类的子分类
				foreach ($_priData as $k1 => $v1)
				{
					if($v1['parent_id'] == $v['id'])
						$menu[$k]['sub'][] = $v1;
				}
			}
			session('menu', $menu);
		}
	}
	


	
	//验证管理员登录
	public function login(){
		$password = $this->password;
		$info = $this->where("username='$this->username'")->find();
		if($info){
			if($info['password'] != md5($password)){
				return 2;
			}else{
				session('id',$info['id']);
				session('username',$info['username']);
				$this->_putPriToSession($info['role_id']);
				return true;
			}
		}else{
			return 1;
		}
	}
	//退出登录
	public function logout(){
		session(null);
	}
	
	//对password字段在新增的时候使md5函数处理
	//钩子函数:_before_insert 添加数据
	protected function _before_insert(&$data,$option){
		$data['password'] = md5($data['password']);
		$data['time'] = date("Y-m-d H:i:s");
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
		
		$pe = 10;
		$count = $this->where($where)->count();
		$Page  = new \Think\Page($count,$pe);
		return array(
			'data' =>$this->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select(),
			'page' =>$Page->show(),// 分页显示输出
		);
	}
	//清理缓存
	public function cache(){
		
		$dirs = array('Admin/Runtime/');
		@mkdir('Runtime',0777,true);
		foreach($dirs as $value) {
			$this->rmdirr($value);
		}
	}
	
	//清理缓存
	public function rmdirr($dirname) {
		if (!file_exists($dirname)) {
			return false;
		}
		if (is_file($dirname) || is_link($dirname)) {
			return unlink($dirname);
		}
		$dir = dir($dirname);
		if($dir){
			while (false !== $entry = $dir->read()) {
	    if ($entry == '.' || $entry == '..') {
		continue;
	   }
	   //递归
	   $this->rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
			}
		}
		$dir->close();
		return rmdir($dirname);
	}
	
	
}







?> 