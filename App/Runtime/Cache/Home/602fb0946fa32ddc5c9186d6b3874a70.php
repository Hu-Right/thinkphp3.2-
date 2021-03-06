<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册</title>
    <link rel="stylesheet" href="/Public/Login/css/register.css">
    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
    <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
    <script src="/Public/Admin/js/jquery.js"></script>
	<!--layer弹窗插件-->
	<link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/>
	<script src="/Public/Login/layui/layui.js"></script>	
</head>
<body>
    <div class="register">
     <div class="enroll">
         <a href="<?php echo U('Login/index');?>">登录</a>
     </div>
     <div class="img">
         <img src="/Public/Login/img/loog.png" alt="微转">
     </div>
     <div class="form">
        <div class="input">
            <input type="hidden" name="parent_id" value="<?php echo ($_GET['id']); ?>">
            <i class="iconfont icon-yonghu1"style="font-size:0.7rem; margin-left:0.2rem ;"></i>
            <input type="text" placeholder="请输入手机号" name="mobile">
        </div>
        <div class="input pasword">
            <i class="iconfont icon-mima"></i>
            <input type="password" placeholder="请输入密码" name="password">
        </div>
        <div class="input pasword">
            <i class="iconfont icon-mima"></i>
            <input type="password" placeholder="请再次确认密码" name="passwords">
        </div>
        <div class="btn">
            <button type="submit" id="regist">注册</button>
        </div>
     </div>
     <div class="sign">
         <a href="<?php echo U('Login/index');?>">已注册，立即登录</a>
     </div>
  </div>  
</body>
<script>
layui.use(['layer', 'form'], function(){
  var layer = layui.layer
  ,form = layui.form

});
        $('#regist').click(function rs() {
        var parent_id = $('input[name=parent_id]').val();
       var mobile = $("input[name='mobile']").val();
        var password  = $("input[name='password']").val();
        var passwords =$("input[name='passwords']").val();
        //js验证用户名和密码
        if(mobile == ''){
            layer.msg('请输入手机号');
            return false;
        }
    

if(mobile && /^1[3|6|4|7|5|8]\d{9}$/.test(mobile)){
    
}else{
	layer.msg('请输入正确的手机号码');  
    return false;
}

        if(password == '') {
            layer.msg('请输入密码');
            return false;
        }
        if(passwords == '') {
            layer.msg('请输入确认密码');
            return false;
        }
        if(password!==passwords) { 
            layer.msg('密码与确认密码不一致');
            return false;

        }
       
//异步处理
 $.post("<?php echo U('registe');?>",{parent_id: parent_id, mobile:mobile, password:password},function(data){
    if(data.status)
    {
      layer.msg(data.message,{time:1000});
          return false;  
   }if(data.status==0)
    {
		 
			layer.msg(data.message,{time:1000},function(){
			 window.location.href = "<?php echo U('Register/xiazai');?>";
		});
        return false;
	 }else{
       
        layer.msg(data.message,{time:1000});
     } 
    
 });
 return false;

});


</script>
</html>