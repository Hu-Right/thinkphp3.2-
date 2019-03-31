<?php
namespace Mobile\Controller;
use Mobile\Controller\IndexController;
class FenHongController extends IndexController {
    public function index(){
    	$user=session('email');
        $count = M('userrecord')->where("info='拆分奖' and email='{$user}'")->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,500);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
    	$gain_list=M('userrecord')->where("info='拆分奖' and email='{$user}'")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('page',$show);// 赋值分页输出
    	$this->assign('gain_list',$gain_list);
    	$this->display();
    }

    //推荐奖记录
    public function tj_log(){
    	$user=session('email');
    	$count = M('userrecord')->where("info like '%推荐奖' and email='{$user}'")->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,500);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
    	$gain_list=M('userrecord')->where("info like '%推荐奖' and email='{$user}'")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

    	$this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
    	$this->display();
    }
    //转账（兑充提现）记录
    public function yu_log(){
    	$user=session('email');
    	$count = M('userrecord')->where("(info ='余额兑充提现' or info='激活币转账') and email='{$user}'")->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,500);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
    	$gain_list=M('userrecord')->where("(info ='余额兑充提现' or info='激活币转账') and email='{$user}'")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	foreach ($gain_list as $k => $v) {
    			$user=M("member")->where(array('email'=>$v['xiaemail']))->getField('username');
    			$gain_list[$k]['username']=$user;
    	}
    	$this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
    	$this->display();
    }

    //消费积分
    public function xiaofei_credit(){
        $user=session('email');
        $count = M('order')->where("payment='重销积分支付' and email='{$user}'")->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,500);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('order')->where("payment='重销积分支付' and email='{$user}'")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        
        foreach ($gain_list as $k => $v) {
                $goods=M('goods')->where(array('id'=>$v['goods_id']))->find();
                $gain_list[$k]['goods_name']=$goods['goods_name'];
                $gain_list[$k]['goods_price']=$goods['shop_price'];
        }
        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    //购物币
    public function gou_log(){
        $user=session('email');
        $count = M('userrecord')->where("type ='购物币' and email='{$user}'")->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,500);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('userrecord')->where("type ='购物币' and email='{$user}'")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    //管理奖记录
    public function manage(){
        $data['email'] = session('email');
        $data['info'] = ['like',"%".'管理奖'."%"];
        $count = M('userrecord')->where($data)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,500);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('userrecord')->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
     //量碰奖记录
    public function liangpeng(){
        $data['email'] = session('email');
        $data['info'] = ['like',"%".'量碰奖'."%"];
        $count = M('userrecord')->where($data)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,500);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('userrecord')->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    //消费积分
    public function day_money(){

        $email=session('email');


        $zonggong=M('daymoney_log')->where(array('email'=>$email))->select();
        $yahuo=array();
        foreach($zonggong as $v){
            $yahuo["liang_money"]+=$v["liang_money"];
            $yahuo["tui_money"]+=$v["tui_money"];
            $yahuo["ling_money"]+=$v["ling_money"];
            $yahuo["fen_money"]+=$v["fen_money"];
            $yahuo["credit"]+=$v["credit"];
            $yahuo["expenses"]+=$v["expenses"];
            $yahuo["manage"]+=$v["manage"];
            $yahuo["totalmoney"]+=$v["totalmoney"];
            $yahuo["center_money"]+=$v["center_money"];
        }

       


        $is_center=M('member')->where(array('email'=>$email))->getField('is_decenter');
        $count =M('daymoney_log')->where(array('email'=>$email))->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,500);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('daymoney_log')->where(array('email'=>$email))->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign("yahuo",$yahuo);
        $this->assign('is_center',$is_center);
        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    //量碰奖记录
    public function baodantc(){
        $data['email'] = session('email');
        $data['info'] = ['like',"报单激活会员提成"];
        $count = M('userrecord')->where($data)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,500);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gain_list=M('userrecord')->where($data)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('gain_list',$gain_list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
}
