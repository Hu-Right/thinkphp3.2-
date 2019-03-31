<?php

namespace Admin\Controller;

use Admin\Controller\IndexController;

class BakController extends IndexController {



    public function index() {

        $DataDir = "databak/";

        mkdir($DataDir);

	

        if (!empty($_GET['Action'])) {

            import("Common.Org.MySQLReback");

		

            $config = array(

                'host' => C('DB_HOST'),

                'port' => C('DB_PORT'),

                'userName' => C('DB_USER'),

                'userPassword' => C('DB_PWD'),

                'dbprefix' => C('DB_PREFIX'),

                'charset' => 'UTF8',

                'path' => $DataDir,

                'isCompress' => 0, //是否开启gzip压缩

                'isDownload' => 0

            );

            $mr = new MySQLReback($config);

            $mr->setDBName(C('DB_NAME'));

            if ($_GET['Action'] == 'backup') {

               $mr->backup();

				 $this->success( '数据库备份成功！');

				exit;

            } elseif ($_GET['Action'] == 'RL') {

                $mr->recover($_GET['File']);

				$this->success( '数据库还原成功！');

				exit;

            } elseif ($_GET['Action'] == 'Del') {

                if (@unlink($DataDir . $_GET['File'])) {

                 $this->success('删除成功！');

                  exit;

                } else {

                    $this->error('删除失败！');

					exit;

                }

            }	

            if ($_GET['Action'] == 'download') {



                function DownloadFile($fileName) {

                    ob_end_clean();

                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

                    header('Content-Description: File Transfer');

                    header('Content-Type: application/octet-stream');

                    header('Content-Length: ' . filesize($fileName));

                    header('Content-Disposition: attachment; filename=' . basename($fileName));

                    readfile($fileName);

                }

                DownloadFile($DataDir . $_GET['file']);

                exit();

            }

        }

        $lists = $this->MyScandir('databak/');

        $this->assign("datadir",$DataDir);

        $this->assign("lists", $lists);

        $this->display();

    }

    public function delss($id){
    
            $model = M('gonggao');
            $model->delete($id);

        $this->success('删除成功');
    }

    public function gonggaogl(){
       $cg=M("gonggao")->where(array("is_out"=>1))->select();
       $this->assign("cg",$cg);
       $this->display(); 
    }

    public function gonggao() {
        if(IS_GET){
            $data=D('gonggao_cate')->select();
            $this->assign('cate',$data);
            $this->display();
        }else{
            $model=D('gonggao');
            $data=$model->create();
          
            if(!$data){
               $this->ajaxReturn(array('status'=>0,'msg'=>$model->getError()));
            }
            $res=$model->addgonggao($data);
            if($res===false){
                $this->ajaxReturn(array('status'=>0,'msg'=>'添加公告失败'));
            }else{
                $this->ajaxReturn(array('status'=>1,'msg'=>'添加公告成功'));
            }         
        }       
    }

    private function MyScandir($FilePath = './', $Order = 0) {
        $FilePath = opendir($FilePath);
        while (false !== ($filename = readdir($FilePath))) {
            $FileAndFolderAyy[] = $filename;
        }
        $Order == 0 ? sort($FileAndFolderAyy) : rsort($FileAndFolderAyy);
        return $FileAndFolderAyy;
    }



}



?>
