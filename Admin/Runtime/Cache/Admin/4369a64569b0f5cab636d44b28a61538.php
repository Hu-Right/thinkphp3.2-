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

  <div class="panel-head" id="add"><strong><span class="iconfont icon-tianjia"></span>增加</strong></div>

  <div class="body-content">

    <form method="post" class="form-x" action="/admin.php/Admin/Privilege/add">  

	<div class="form-group">

		<div class="label">

			<label>上级权限：</label>

		</div>

		<div class="field">

				

			<select name="parent_id" class="input w50">

				<option value="0" selected>超级管理员</option>

					<?php foreach($data as $v):?>

					<option value="<?php echo $v['id']?>" ><?php echo str_repeat("-",$v['leve']*5); echo $v['pri_name']?></option>

					<?php endforeach;?>

			</select>









			<div class="tips"></div>

		</div>

	</div>

	<div class="form-group">

		<div class="label">

			<label>权限名称：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="" name="pri_name" data-validate="required:请输入权限名称" />

			<div class="tips"></div>

		</div>

	</div>

	<div class="form-group">

		<div class="label">

			<label>模块名称：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="" name="module_name" data-validate="required:请输入模块名称" />

			<div class="tips"></div>

		</div>

	</div>

	<div class="form-group">

		<div class="label">

			<label>控制器名称：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="" name="controller_name" data-validate="required:请输入控制器名称" />

			<div class="tips"></div>

		</div>

	</div>

	<div class="form-group">

		<div class="label">

			<label>方法名称：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="" name="action_name" data-validate="required:请输入方法名称" />

			<div class="tips"></div>

		</div>

	</div>



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