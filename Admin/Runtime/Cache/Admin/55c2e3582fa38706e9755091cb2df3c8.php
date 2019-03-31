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

  <div class="panel-head" id="add"><strong><span class="iconfont icon-icon-xiugai"></span>管理员修改</strong></div>

  <div class="body-content">

    <form method="post" class="form-x" action="/admin.php/Admin/Admin/save/id/25">  

	

	<input type="hidden" name="id" value="<?php echo $data['id'];?>">

	

	<div class="form-group">

		<div class="label">

			<label>管理员权限：</label>

		</div>

		<div class="field">

				

			<select name="role_id" class="input w50">

					<?php foreach($datas as $v):?>

					<option  <?php if($data['role_id']==$v['id']):;?>selected<?php endif;?>  value="<?php echo $v['id']?>" ><?php echo $v['role_name']?></option>

					<?php endforeach;?>

			</select>



			<div class="tips"></div>

		</div>

	</div>

      <div class="form-group">

        <div class="label">

          <label>管理员名称：</label>

        </div>

        <div class="field">

          <input type="text" class="input w50" value="<?php echo $data['username'];?>" name="username" data-validate="required:请输入管理员名称" />

          <div class="tips"></div>

        </div>

      </div>

         

      <div class="form-group">

        <div class="label">

          <label>管理员密码：</label>

        </div>

        <div class="field">

          <input type="password" class="input w50" value="" name="password"/>

          <div class="tips">为空为不修改</div>

        </div>

      </div>

	  

	  

      <div class="form-group">

        <div class="label">

          <label></label>

        </div>

        <div class="field">

          <button class="button bg-main icon-icon--" type="submit"> 确认添加</button>

        </div>

      </div>

    </form>

  </div>

</div>



</body></html>