<?php
namespace Admin\Model;
use Think\Model;
class GonggaoModel extends Model{
       public $pk="id";
       protected $fields=array('id','is_out','content','catename','biaoti','addtime','g_img');
       protected $_validate=array(
           array('content','require','公告内容不能为空',1),
           array('catename','require','请选择公告分类',1),
           array('biaoti','require','请填写标题',1)
       );
        public function addgonggao($data){
        	 $data['addtime']=time();
           include_once "/ThinkPHP/Library/Think/Upload.class.php";
           $upload = new \Think\Upload();
           $upload->config['subName']='Gonggao';
           $info = $upload->uploadOne($_FILES['g_img']);
           $img='Uploads/'.$info['savepath'].$info['savename'];
           if(!$info){
               $this->error=$upload->getError(); 
           }
           $data['g_img']=$img;
           $data['is_out']=1;
           return $this->add($data);
        }


}







