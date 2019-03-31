<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no"> 
<title>沙舟红管理系统</title>
<link rel="stylesheet" type="text/css" href="/Public/Login/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="/Public/Login/css/demo.css" />
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="/Public/Login/css/component.css" />
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
		<div class="container demo-1">
			<div class="content">
				<div id="large-header" class="large-header">
					<canvas id="demo-canvas"></canvas>
					<div class="logo_box">
						<h3 style="font-size:30px;width:100%">沙舟红会员管理系统</h3>
						<form action="#" name="f" method="post">
							<div class="input_outer">
								<span class="u_user"></span>
								<input name="email" class="text" value="请输入会员ID号" style="color: #FFFFFF !important" type="text" placeholder="请输入会员ID号" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = '请输入会员ID';}">
							</div>
							<div class="input_outer">
								<span class="us_uer"></span>
								<input name="password" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;" value="" type="password" placeholder="请输入密码">
							</div>
							<div class="input_outer">
								<span class="us_uer"></span>
								<input name="chk_code" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;" value="" type="password" placeholder="请输入验证码">
							</div>
							<div>
                           		<img src="/index.php/Mobile/Login/code" alt="" width="100" height="32" class="text"  onclick="this.src= '/index.php/Mobile/Login/code/'+Math.random();"> 
							</div>
							<div class="mb2"><input  class="act-but submit" style="width:100%;border:0;color:#fff;font-family:Microsoft YaHei;" type="submit" onClick="myFunction()" value="确认登录" ></div>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /container -->
		<script src="/Public/Login/js/TweenLite.min.js"></script>
		<script src="/Public/Login/js/EasePack.min.js"></script>
		<script src="/Public/Login/js/rAF.js"></script>
		<script src="/Public/Login/js/demo-1.js"></script>
	</body>
</html>