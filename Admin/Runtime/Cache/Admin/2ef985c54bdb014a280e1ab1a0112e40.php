<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="zh-cn">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<meta name="renderer" content="webkit">

		<title></title>

		<link rel="stylesheet" href="/Public/Admin/css/pintuer.css">

		<link rel="stylesheet" href="/Public/Admin/css/admin.css">

		<script src="/Public/Admin/js/jquery.js"></script>

		<script src="/Public/Admin/js/pintuer.js"></script>

	</head>

<body>

<div class="panel admin-panel">

  <div class="panel-head" id="add"><strong><span class="iconfont icon-icon-tianjia"></span>增加</strong></div>

  <div class="body-content">

    <form method="post" class="form-x" action="/admin.php/Admin/Order/add">  

	

	<div class="form-group">

		<div class="label">

			<label>支付方式：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="" name="zname" data-validate="required:请输入支付方式" />

			<div class="tips"></div>

		</div>

	</div>



	
	<div class="form-group">

			<div class="label">
	
				<label>支付账户：</label>
	
			</div>
	
			<div class="field">
	
				<input type="text" class="input w50" value="" name="zh" data-validate="required:请输入支付账户" />
	
				<div class="tips"></div>
	
			</div>
	
		</div>

	<div class="form-group">

		<div class="label">

			<label>AppID：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="" name="aid" data-validate="required:请输入会APPID" />

			<div class="tips"></div>

		</div>

	</div>

	<div class="form-group">

		<div class="label">

			<label>商户私钥:</label>

		</div>

		<div class="field">
			<textarea rows="6" cols="42" class="input w50"  name="skey" style="width:354px;padding-top:1px;font-size:14px;" data-validate="required:请输入商户私钥"></textarea>
			<!-- <input type="" class="input w50" value="" name="skey" data-validate="required:请输入商户私钥" /> -->
			<div class="tips"></div>

		</div>

	</div>

	<div class="form-group">

		<div class="label">

			<label>支付公钥：</label>

		</div>

		<div class="field">
			<textarea rows="6" cols="42" class="input w50"  name="zkey" style="width:354px;padding-top:1px;font-size:14px;" data-validate="required:请输支付公钥"></textarea>
			<!-- <input type="text" class="input w50" value="" name="zkey" data-validate="required:请输支付公钥" /> -->

			<div class="tips"></div>

		</div>

	</div>

	 

	<!-- <div class="form-group">

		<div class="label">

			<label>状态：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="" name="state" data-validate="required:请输入状态" />

			<div class="tips"></div>

		</div>

	</div> -->

      <div class="form-group">

        <div class="label">

          <label></label>

        </div>

        <div class="field">

          <button class="button bg-main iconfont icon-icon--" type="submit"> 确认添加</button>

        </div>

      </div>

    </form>

  </div>

</div>

</body></html>