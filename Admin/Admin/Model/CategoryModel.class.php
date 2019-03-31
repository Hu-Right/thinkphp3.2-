<?php 
namespace Admin\Model;
use Think\Model;

class CategoryModel extends Model{
	protected $_validate = array(
		array('cat_name','require','商品分类名称不能为空','1'),
		
		array('parent_id','require','上级分类ID不能为空','1'),
			
	);
	


	//查询分类方法
	public function catelist(){
		$data = $this->select();
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





	protected function _before_delete(&$data){
		$id = $data['where'];
		if(is_array($data['where'])){
			$catdata = $this->select();
		
		// 循环每一个要删除的分类，找出每个分类的子分类
			$_arr = explode(',', $id['id'][1]);
			$children = array();
			foreach ($_arr as $k => $v){
				$_children = $this->_Cadzis($catdata,$v);
				$children = array_merge($children, $_children);
			}
			// 去重
			$children = array_unique($children);
			$dates = implode(',',$children);
			if($dates){
				$this->execute("delete from t_category where id in(".$dates.")");
			}
		}else{
			$catdata = $this->select();
			$dates = $this->_Cadzis($catdata,$id['id']);
			$dates = implode(',',$dates);
			if($dates){
				$this->execute("delete from t_category where id in(".$dates.")");
			}
		}


	}
	
	 
	//取出分类下的所以子分类 递归
	private function _Cadzis($data,$parent_id){
		static $var = array();//必须要用静态的方法
		foreach($data as $k=>$v){
	
			if($v['parent_id'] == $parent_id){
				$var[] = $v['id'];
				$this->_Cadzis($data,$v['id']);
			}
		}
		return $var;
	}
}