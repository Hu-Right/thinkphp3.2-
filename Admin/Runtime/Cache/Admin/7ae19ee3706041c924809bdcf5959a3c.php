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

		<script src="/Public/Admin/js/jquery-1.4.2.min.js"></script>

	</head>

<body>

<div class="panel admin-panel">

  <div class="panel-head" id="add"><strong><span class="iconfont icon-tianjia"></span>增加</strong></div>

  <div class="body-content">

    <form method="post" class="form-x" action="/admin.php/Admin/Role/add">  

	

	<div class="form-group">

		<div class="label">

			<label>角色名称：</label>

		</div>

		<div class="field">

			<input type="text" class="input w50" value="" name="role_name" data-validate="required:请输入角色名称" />

			<div class="tips"></div>

		</div>

	</div>

	<div class="form-group">

		<div class="label">

			<label>权限列表</label>

		</div>

		<div class="field">

		

			<?php foreach($data as $v):?>

			<li leve="<?php echo $v['leve']; ?>">

			<?php echo str_repeat('-',8*$v['leve']); print_r($v['pri_name']);?>

			<input name="pri_id_list[]" type="checkbox" value="<?php echo $v['id']?>"><br />

			</li>

			<?php endforeach;?>

		

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

<script>



$(":checkbox").click(function(){

	

	var cur_li = $(this).parent();



	var checked = $(this).attr("checked");



	var cur_leve = cur_li.attr("leve");



	cur_li.prevAll("li").each(function(){



		if($(this).attr("leve") < cur_leve && checked)

		{

			

			$(this).find(":checkbox").attr("checked","checked");

			if($(this).attr("leve") == '0')

				return false;

		}

	});



	if(!checked)

	{

	

		cur_li.nextAll("li").each(function(){

		

			if($(this).attr("leve") > cur_leve)

				$(this).find(":checkbox").removeAttr("checked");

			else

				return false;

		});

	}

});

</script>











</body></html>