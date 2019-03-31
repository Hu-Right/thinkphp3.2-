<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, 
       maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>微转</title>
    <link rel="stylesheet" type="text/css" href="/Public/Login/css/login.css">
	<link rel="stylesheet" type="text/css" href="/Public/Login/css/font/iconfont.css">
	<link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
	
    <script src="/wz/Public/Admin/js/jquery.js"></script>
    
    <script src="/Public/Admin/js/jquery.js"></script>
	<!--layer弹窗插件-->
	<link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/>
	
	<script src="/Public/Login/layui/layui.js"></script>	

</head>
<body>
    <div class="login">
        <div class="enroll">
			<!-- <a href="<?php echo U('register/registe');?>">注册</a> -->
        </div>
        <div class="img">
            <img src="/Public/Login/img/loog.png" >
        </div>
        <div class="form">
            <div class="input">
                <i class="iconfont icon-yonghu1"style="font-size:0.7rem; margin-left:0.2rem ;"></i>
                <input type="text" placeholder="请输入手机号" name="mobile">
            </div>
            <div class="input pasword">
                <i class="iconfont icon-mima"></i>
                <input type="password" placeholder="请输入密码" name="password">
            </div>
            <div class="btn">
                <button type="submit" id="login">登录</button>
            </div>
        </div>
        <div class="enroll">
            <a href="#">忘记密码?</a>
        </div>
        <!-- <div class="sign">
            <a href="<?php echo U('register/registe');?>">
             <p style="margin-left: 2rem;">
                没有账号?立即注册
             </p>
            </a>
        </div> -->
  </div>
</body>
<script>
layui.use(['layer', 'form'], function(){
  var layer = layui.layer
  ,form = layui.form;   
});

$('#login').click(function onk(){
var mobile=$("input[name='mobile']").val(); 
var password=$("input[name='password']").val();
 
if(mobile.length==0)
{
    layer.msg('手机号不能为空');
	return false;

}

if(mobile && /^1[3|6|4|7|5|8]\d{9}$/.test(mobile)){
    
}else{

	layer.msg('请输入正确的手机号码');  
    return false;
}

if(password.length==0)
{
    layer.msg('密码不能为空');
   return false;
}



//异步处理
$.post("<?php echo U('ajaxlogin');?>",{mobile:mobile,password:password},function(data){	
	
	 if(data.status)
	 {    
		  layer.msg(data.message,{time:1000});
          return false;    
	 }

    if(data.status)
	 {    
		  layer.msg(data.message,{time:1000});
          return false;    
	 }

	 else
	 {   
			layer.msg(data.message,{time:1000},function(){
			 window.location.href = "<?php echo U('Index/index');?>";
		});

	 }
	
});

 return false;
});
</script>

</html>