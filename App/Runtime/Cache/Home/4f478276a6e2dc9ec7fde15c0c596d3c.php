<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>任务中心</title>
    <link rel="stylesheet" href="/Public/Login/css/task.css"/>   
    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
    <!--其他插件-->
  <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
  <script src="/Public/Admin/js/jquery.js"></script>
  <!--layer弹窗插件-->
  <link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/> 
  <script src="/Public/Login/layui/layui.js"></script>	
  <link rel="stylesheet" href="/Public/Login/css/swiper-4.4.1.min.css">
  <script src="/Public/Login/css/swiper-4.4.1.min.js"></script>
</head>
<body>
    <div class="header">
        <p>微转达人</p>
    </div>
    <div class="task">
       
        <!-- <div class="banner">
            <ul>
                <li>
                    
                    <img src="/Public/Login/img/banner1.png" alt="">
                </li>
            </ul>
        </div> -->

        <div class="swiper-container">
            <div class="swiper-wrapper">
                
                 
                <div class="swiper-slide"><img src="/Public/Login/img/t-banner2.jpg" alt=""></div>
                <div class="swiper-slide"><img src="/Public/Login/img/t-banner1.jpg" alt=""></div>

            </div>  
            <!-- 如果需要导航按钮 -->
           <div class="swiper-pagination"></div>
     </div>

        <div class="notice">
                <i class="iconfont icon-tuiguang"></i>
           
            <p>
              微转会员[紧急通知，<a href="<?php echo U('look');?>">公告</a>]
            </p>
        </div>
        <div class="btn">
            <i class="iconfont icon-big-WeChat"></i>
            <p>中国第一家朋友圈租赁平台</p>
            <span class="left">开启躺赢人生</span>
            <span>做朋友圈的房东</span>      
            <button>登录</button>
        </div>
        <div class="list-text">
           <ul>
               <li>
                  
        
                 <a href="<?php echo U('gettask');?>">
                    <i class="iconfont icon-renwu"></i>
                    <p>领取任务</p>
                 </a>
               </li>
               <li class="border-left">
                  <a href="<?php echo U('type');?>">
                    <i class="iconfont icon-tijiaorenwu"></i>
                    <p>提交任务</p>
                  </a>
               </li>
               <li>
                  <a href="<?php echo U('record');?>">
                    <i class="iconfont icon-chanpin"></i>
                    <p>任务记录</p>
                  </a>
               </li>
               
           </ul>
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
                <a href="#">
                <i class="iconfont icon-renwu"></i>
                <p>任务中心</p>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Perinfo/info');?>">
                <i class="iconfont icon-geren"></i>
                <p>个人中心</p>
                </a>
            </li>
        </ul>
    </div>
    </div>
</body>

<script>
  var mySwiper = new Swiper ('.swiper-container', {
    direction: 'horizontal', // 横向切换选项
    loop: true,// 循环模式选项//
    autoplay: true, 
    
    // 如果需要分页器
    pagination: {
      el: '.swiper-pagination',
    },
    
    // 如果需要前进后退按钮
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    
    // 如果需要滚动条
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  })

</script>
</html>