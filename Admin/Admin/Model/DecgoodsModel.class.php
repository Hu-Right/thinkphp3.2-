<?php 
namespace Admin\Model;
use Think\Model;

class DecgoodsModel extends Model{
	protected $_validate = array(
		array('goods_name','require','商品名称不能为空','1'),
		array('market_price','require','市场价不能为空','1'),
		array('shop_price','require','本店价不能为空','1'),
		array('is_on_sale','require','是否上架不能为空','1'),
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
		if($_FILES['logo']['name']){
		$uploads = $this->upload();
		$data['logo'] = '/Public/Upload/logo' . $uploads['logo']['savepath'].$uploads['logo']['savename'];
		}else{
			unset($data['logo']);
		}
		
	}

	protected function _before_update(&$data){

		if($_FILES['logo']['name']){
		$uploads = $this->upload();
		$data['logo'] = '/Public/Upload/logo' . $uploads['logo']['savepath'].$uploads['logo']['savename'];
		}else{
			unset($data['logo']);
		}

	}
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

	
}
