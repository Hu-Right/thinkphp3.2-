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
  <div class="panel-head" id="add"><strong><span class="iconfont icon-icon-xiugai"></span>修改</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="/admin.php/Admin/Withdrawals/save/id/22">  
	
	<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
	
												<div class="form-group">
		<div class="label">
			<label>用户邮箱：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($data["email"]); ?>" name="email" data-validate="required:请输入用户邮箱" disabled/>
			<div class="tips"></div>
		</div>
	</div>
 									<div class="form-group">
		<div class="label">
			<label>银行名称：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($data["mode"]); ?>" name="mode" data-validate="required:请输入提现方式" disabled />
			<div class="tips"></div>
		</div>
	</div>

	<div class="form-group">
		<div class="label">
			<label>开户行信息：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($data["khhxx"]); ?>" name="khhxx" data-validate="required:请输入提现方式" disabled />
			<div class="tips"></div>
		</div>
	</div>

	
 									<div class="form-group">
		<div class="label">
			<label>提现帐号：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($data["accounts"]); ?>" name="accounts" data-validate="required:请输入提现帐号"  disabled/>
			<div class="tips"></div>
		</div>
	</div>
 									<div class="form-group">
		<div class="label">
			<label>姓名：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($data["name"]); ?>" name="name" data-validate="required:请输入姓名" disabled />
			<div class="tips"></div>
		</div>
	</div>
 									<div class="form-group">
		<div class="label">
			<label>金额：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($data["money"]); ?>" name="money" data-validate="required:请输入金额"  disabled/>
			<div class="tips"></div>
		</div>
	</div>
 									<div class="form-group">
		<div class="label">
			<label>状态：</label>
		</div>
		 <div class="field">
			  <input type="radio" name="type" maxlength="60" value="0" <?php if($data['type']==0):?>checked="checked"<?php endif;?>>审核中
			  <input type="radio" name="type" maxlength="60" value="1"<?php if($data['type']==1):?>checked="checked"<?php endif;?>>充值成功
			  <input type="radio" name="type" maxlength="60" value="2"<?php if($data['type']==2):?>checked="checked"<?php endif;?>>充值失败
              <div class="tips"></div>
            </div>
	</div>
 									<div class="form-group">
		<div class="label">
			<label>留言：</label>
		</div>
		<div class="field">
			<textarea  class="input w50"class="form-control" ><?php echo ($data["info"]); ?> </textarea>
			<div class="tips"></div>
		</div>
	</div>
 	
 	      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main iconfont icon-icon--" type="submit">确认修改</button>
        </div>
      </div>
    </form>
  </div>
</div>

</body></html>