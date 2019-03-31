<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首页</title>
    


    <link rel="stylesheet" href="/Public/Login/css/index.css">
    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
  <!--其他插件样式-->


  <link rel="stylesheet" href="/Public/Login/css/index.css">
  <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">

   <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
	<!-- <script src="/Public/Admin/js/jquery.js"></script> -->
	<!--layer弹窗插件-->
	<link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/>
	<script src="/Public/Login/layui/layui.js"></script>	

  

</head>
 <body>

  <div class="header">
    <p>微转达人</p>
</div>
<div class="index">
    
    <div class="banner">
        <ul>
            <li>
                <img src="/Public/Login/img/banner1.png" alt="" style="width:100%;">
            </li>
        </ul>
    </div>
   <div class="nav">
        <a href="<?php echo U('what');?>">
            <div class="list">
                <i class="iconfont icon-zhuanyongjin" style="color:#D94543;"></i>
                <p style="color:rgb(51, 32, 33);">如何赚佣</p>
                <span>&gt;</span>
            </div>
        </a>
  </div>
  <div class="nav">
  <a href="codes.html">
    <div class="list">
            <i class="iconfont icon-tuiguang" style="color:#2A8ABF;"></i>
            <a href="<?php echo U('Code/index');?>">
            <p style="color:#39B4DE;">推广二维码</p>
            </a>
            <span>&gt;</span>
    </div>
  </a>
</div>
<div class="nav">
  <a href="<?php echo U('Goodes/index');?>">
    <div class="list">
            <i class="iconfont icon-chanpin"  style="color:#6C6C6C;"></i>
            <p style="color:#878787;">产品秀</p>
            <span>&gt;</span>
    </div>
  </a>
</div>
<div class="nav">
  <a href="<?php echo U('card');?>">
    <div class="list">
            <i class="iconfont icon-mingpian"  style="color:#9E3B30;"></i>
            <p style="color:#DC483A">名片引流</p>
            <span>&gt;</span>
    </div>
  </a>
</div>
<div class="nav">
  <a href="<?php echo U('src');?>">
    <div class="list">
            <i class="iconfont icon-GroupCopy"  style="color:#E64E00;"></i>
            <p style="color:#E9650E;">微群资源</p>
            <span>&gt;</span>
    </div>
  </a>
</div>
<div class="nav">
  <a href="college.html">
    <div class="list">
            <i class="iconfont icon-xueyuan"  style="color:#0C8ED4;"></i>
            <a href="<?php echo U('College/index');?>">
            <p style="color:#3F7CB2;">微商学院</p>
            </a><span>&gt;</span>
    </div>
  </a>
</div>
<div class="nav">
  <a href="activity.html">
    <div class="list">
            <i class="iconfont icon-xianxing_huodong"  style="color:#D72001;"></i>
            <a href="<?php echo U('Activity/index');?>">
            <p style="color:#A6312A;">活动中心</p>
            </a><span>&gt;</span>
    </div>
  </a>
</div>
<div class="nav">
  <a href="<?php echo U('about');?>">
    <div class="list">
            <i class="iconfont icon-guanyu"  style="color:#1394DB;"></i>
            <p style="color:#4DA6E0;">关于微转</p>
            <span>&gt;</span>
    </div>
  </a>
</div>
<div class="nav">
  <a href="service.html">
    <div class="list">
            <i class="iconfont icon-service"  style="color:#EA9AC1;"></i>
            <p style="color:#E6ACC5;">客服中心</p>
            <span>&gt;</span>
    </div>
  </a>
</div>
<!--fonter底部-->
<div class="fonter">
    <ul>
        <li> 
            <a href="#">
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
          <a href="<?php echo U('Perinfo/info');?>">
            <i class="iconfont icon-geren"></i>
            <p>个人中心</p>
            </a>
        </li>
    </ul>
</div>
</div>
</body>

 </body>
</html>
<script type="text/javascript" >

layui.use(['layer', 'form'], function(){
  var layer = layui.layer
  ,form = layui.form;   
});

     $('#dj').click(function(){
          if($('#erweima').hasClass('src')){
            $('#erweima').removeClass('src');
            $('#erweima').removeAttr('src');
          }else{
               $.ajax({
                   type:'post',
                   url:"<?php echo U('Index/phpqrcode');?>",
                   datatype:'json',
                   success:function(msg){
                        if(msg.status==1){
                            var src = 'data:image/png;base64,'+msg.data;//解码
                            $('#erweima').addClass('src');                
                            $('#erweima').attr('src',src);                        
                        }else{
                            layer.msg(msg.msg);
                        }
                   }

               });
        }
    });
    
</script>