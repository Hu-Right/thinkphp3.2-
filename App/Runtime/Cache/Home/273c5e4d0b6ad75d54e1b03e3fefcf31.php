<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>个人中心</title> 
    <link rel="stylesheet" href="/Public/Login/css/centre.css"> 
   
    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
   
    <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
    <script src="/Public/Admin/js/jquery.js"></script>
	<!--layer弹窗插件-->
	<link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/>
	<script src="/Public/Login/layui/layui.js"></script>
    <style>
        /*弹出退出框*/
        .ddd{
            width:100%;
            height:12rem;
            margin-top: 6rem;
            position: fixed;
            top:8rem;left:0;
            display: none;
        }
        .ddd .nnn{
            width:14rem;
            height:9rem;
            margin: auto;
            color:#343434;
            font-size:1.1rem;
            text-align: center;
            background:#FFFFFF;
            border-radius: 5px;
        }
        .ddd .nnn span{
        margin-top: 5rem;
        line-height: 3.5rem;
        }
        .ddd .nnn button{
            width:7rem;
            height:2.5rem;
            float: left;
            color:#D76344;
            border:none;
            outline: none;
            font-size:1rem;
            background:#FFFFFF; 
            border-top:1px solid #F5F5F5;
            margin-top:2rem;
        }
        .ddd .nnn .quxiao{
            border-right: 1px solid #F5F5F5;
        }
    </style>
</head>
<body>
        <div class="head">
           <!-- <a href="javascript:history.back(-1)"> 
             <i class="iconfont icon-xiaoyu">返回</i>
           </a> -->
           <p>个人中心</p>
        </div>
    <div class="user">
               <div class="herda">
                    
                   <img src="/Public/Login/img/loog.png" alt="">
               </div>
               <div class="hui">
                   <!-- <button>普通会员</button> -->
               </div>
                
            <form action="<?php echo U('apliy');?>" method="POST">          
                       <?php if($list['level'] < 1): ?><div class="text" style="height:3.5rem;">
                                <!-- <p>大大</p> -->
                                <span>会员ID:<?php echo ($list["id"]); ?></span>
                                <p class="psp" style="font-size:1rem;">选择会员类型:         
                                </p>
                        </div>   

                    <div class="left" style="width:10rem; border: none;  font-size:0.9rem; text-align: center;">                         
                        <input  name="levels" type="radio" checked="checked" value="1"<?php if($data['level']==1):?>checked="checked"<?php endif;?>>普通会员
                        <input name="levels" type="radio" value="2"<?php if($data['level']==2):?>checked="checked"<?php endif;?>>VIP会员                      
                   </div>

            <div class="btn">                  
                <button type="submit" id="btn">确认</button>
            </div> 
                 
            
                <?php elseif($list['level'] == 1): ?> 
                <div class="text">
                    <span>会员ID:<?php echo ($list["id"]); ?></span>
                        <p class="psp" style="font-size:1rem;">会员类型:
                        <?php echo ($list['level']==1?'普通会员':''); ?>                     
                        <?php echo ($list['level']==2?'vip会员':''); ?>
                        <?php echo ($list['level']==3?'黄金会员':''); ?>
                        <?php echo ($list['level']==0?'免费会员':''); ?> 
                        <div class="btn">    
                                <input name="levels" type="radio" value="2"<?php if($data['level']==2):?>checked="checked"<?php endif;?>>VIP会员              
                            <button type="submit" id="btn">升级</button>
                        </div> 
                    </div>
              
                <?php else: ?> 

            <div class="text">
            <span>会员ID:<?php echo ($list["id"]); ?></span>
                <p class="psp" style="font-size:1rem;">会员类型:
                <?php echo ($list['level']==1?'普通会员':''); ?>                     
                <?php echo ($list['level']==2?'vip会员':''); ?>
                <?php echo ($list['level']==3?'黄金会员':''); ?>
                <?php echo ($list['level']==0?'免费会员':''); ?> 
            </div><?php endif; ?>  
    </form>           
</div>

        <div class="list">
            <ul>
                <li style="font-size:1rem;">
                    <p>总收入</p>
                    <span><?php echo ($count); ?>元</span>
                </li>
                 <li style="font-size:1rem;">
                    <p>今日收入</p>
                    <span><?php echo ($list["day_money"]); ?>元</span>
                </li>
                 <li style="font-size:1rem;"> 
                    <p>已提现</p>
                    <span><?php echo ($d); ?>元</span>
                </li>
            </ul>
        </div>
        
        <div class="listbox">
            <div class="box-bi">
               <a href="<?php echo U('team');?>">
                    <i class="iconfont icon-tuandui1" style="color:#E35500"></i>
                    <p>我的团队</p>
               </a>
            </div>
            <div class="box-bi">
               <a href="<?php echo U('wallet');?>">
                    <i class="iconfont icon-qianbao" style="color:#1295D9"></i>
                    <p>我的钱包</p>
               </a>
            </div>
            <div class="box-bi">
               <a href="alipay.html">
                    <i class="iconfont icon-zhifubao" style="color:#1295D9"></i>
                    <p>绑定支付宝</p>
               </a>
            </div>
            <div class="box-bi">
               <a href="bank.html">
                    <i class="iconfont icon-card" style="color:#D81E05"></i>
                    <p>绑定银行卡</p>
               </a>
            </div>
            <div class="box-bi">
               <a href="<?php echo U('Code/index');?>">
                    <i class="iconfont icon-qiyeguquan" style="color:#FB4714"></i>
                    <p>推广分享</p>
               </a>
            </div>
            <div class="box-bi">
               <!-- <a href="<?php echo U('Login/logout');?>"> -->
                
                <a href="#" id="onk">
                    <i class="iconfont icon-tuichu" style="color:#989898"></i>
                    <p>退出登录</p>
               </a>
            </div>
            
        </div>

    <div class="ddd">
            <div class="nnn">
                <span>提示</span>
                <p>确定要退出登录吗</p>
                <button class="quxiao">取消</button>
                <button><a href="<?php echo U('Login/Logout');?>">确定</a></button>
            </div>
        </div>

        <!--fonter底部-->
        <div class="fonter">
            <ul>
                <li> 
                    <a href="<?php echo U('Index/index');?>">
                    <i class="iconfont icon-index"></i>
                    <p>首页</p>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Task/task');?>">
                    <i class="iconfont icon-renwu"></i>
                    <p>任务中心</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="iconfont icon-geren"></i>
                    <p>个人中心</p>
                    </a>
                </li>
            </ul>
        </div>
    </body>
  <script>
  //显示
   $("#onk").click(function (){
        $(".ddd").show();          
    //   confirm("您确定要退出");
   });
   //取消
   $('.quxiao').click(function(){
    $(".ddd").hide();
   });
  
 </script>

    </html>