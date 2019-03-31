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

  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>公司帐号</strong></div>

  <div class="body-content">

    <form method="post" class="form-x" action="/admin.php/Admin/transaction/accounts.html">  

	

	<div class="form-group">

		<div class="label">

			<label>银行名称：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="<?php echo ($Bankname); ?>" name="Bankname" />

			<div class="tips"></div>

		</div>

	</div>

	<div class="form-group">

		<div class="label">

			<label>银行帐号：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="<?php echo ($Bankaccount); ?>" name="Bankaccount"/>

			<div class="tips"></div>

		</div>

	</div>

	<div class="form-group">

		<div class="label">

			<label>开户行：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="<?php echo ($bankdeposit); ?>" name="bankdeposit"/>

			<div class="tips"></div>

		</div>

	</div>

		<div class="form-group">

		<div class="label">

			<label>开户姓名：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="<?php echo ($bankuser); ?>" name="bankuser"/>

			<div class="tips"></div>

		</div>

	</div>

	<div class="form-group">

		<div class="label">

			<label>支付宝帐号：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="<?php echo ($zhifubao); ?>" name="zhifubao"/>

			<div class="tips"></div>

		</div>

	</div>

	<div class="form-group">

		<div class="label">

			<label>微信帐号：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="<?php echo ($weixin); ?>" name="weixin"/>

			<div class="tips"></div>

		</div>

	</div>

	

      <div class="form-group">

        <div class="label">

          <label></label>

        </div>

        <div class="field">

          <button class="button bg-main iconfont icon-icon--" type="submit"> 确认修改</button>

        </div>

      </div>

    </form>

  </div>

</div>

</body></html>