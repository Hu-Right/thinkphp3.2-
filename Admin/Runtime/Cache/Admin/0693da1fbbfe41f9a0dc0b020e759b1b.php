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

<script type="text/javascript" src="/Public/Admin/js/date_js/jedate.js"></script>

</head>

<body>

<div class="panel admin-panel">

  <div class="panel-head" id="add"><strong><span class="iconfont icon-icon-xiugai"></span>修改</strong></div>

  <div class="body-content">

    <form method="post" class="form-x" action="/admin.php/Admin/Member/save/id/1">



	<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">



		<div class="form-group">

			<div class="label">

				<label>用户名：</label>

			</div>

			<div class="field">

				<input type="text" class="input w50" value="<?php echo ($data["username"]); ?>" name="username" data-validate="required:请输入用户名" />

				<div class="tips"></div>

			</div>

      </div>



		<div class="form-group">

			<div class="label">

				<label>会员唯一登陆ID：</label>

			</div>

			<div class="field">

				<input type="text" class="input w50" readonly="readonly"  value="<?php echo ($data["mobile"]); ?>" name="mobile" data-validate="required:会员唯一登陆手机号：" />

				<div class="tips"></div>

			</div>

      </div>


<!-- 
	    <div class="form-group">

									<div class="label">

										<label>手机号码：</label>

									</div>

									<div class="field">

										<input type="text" class="input w50" value="<?php echo ($data["mobile"]); ?>"  name="mobile" data-validate="required:请输入手机号码" />

										<div class="tips"></div>

									</div>

						</div> -->

<!-- 
                     <div class="form-group">

									<div class="label">

										<label>身份证号：</label>

									</div>

									<div class="field">

										<input type="text" class="input w50" value="<?php echo ($data["card"]); ?>"  name="card" data-validate="required:请输入省份证号码" />

										  <div class="tips"></div>

									</div>

						</div> -->






	  <div class="form-group">

			<div class="label">

				<label>用户级别：</label>

			</div>

			<div class="field">

			<select  name="level"  class="input w50">
				<option value="0" <?php if($data['level']==0):?>selected="selected"<?php endif;?>>免费会员</option>
				<option value="1" <?php if($data['level']==1):?>selected="selected"<?php endif;?>>普通会员</option>
				<option value="2" <?php if($data['level']==2):?>selected="selected"<?php endif;?>>vip会员</option>
				<option value="3" <?php if($data['level']==3):?>selected="selected"<?php endif;?>>黄金会员</option>
				<!-- <option value="5" <?php if($data['level']==5):?>selected="selected"<?php endif;?>>五星会员</option> -->
			</select>

				<div class="tips"></div>

			</div>

      </div>



      		<div class="form-group">

      			<div class="label">

      				<label>修改密码：</label>

      			</div>

      			<div class="field">

      				<input type="text" class="input w50" value="" name="password"  placeholder="请输入修改密码" />

      				<div class="tips"></div>

      			</div>

            </div>




	 <!--<div class="form-group">

									<div class="label">

										<label>余额：</label>

									</div>

									<div class="field">

										<input type="text" class="input w50" value="<?php echo ($data["money"]); ?>" name="money" data-validate="required:请输入初始余额" />

										<div class="tips"></div>

									</div>

		 </div>-->



		<div class="form-group">

			<div class="label">

				<label>注册时间：</label>

			</div>

			<div class="field">

		<input class="input w50"  id="dateinfo" name="addtime" type="text" placeholder="请选择" value="<?php echo ($data["addtime"]); ?>" readonly>



		<div class="tips"></div>

			</div>

      </div>



<div class="form-group">

<div class="label">

<label>性别：</label>

</div>

<div class="field">

<input <?php if($data['gender'] == "保密") echo 'checked="checked"'; ?> type="radio" name="gender" maxlength="60" value="保密" />保密					<input <?php if($data['gender'] == "男") echo 'checked="checked"'; ?> type="radio" name="gender" maxlength="60" value="男" />男							<input <?php if($data['gender'] == "女") echo 'checked="checked"'; ?> type="radio" name="gender" maxlength="60" value="女" />女							<div class="tips"></div>

</div>

</div>

		 <div class="form-group">

									<div class="label">

										<label>上级用户ID：</label>

									</div>

									<div class="field">

										<input type="text" class="input w50" value="<?php echo ($data['parent_id']); ?>" name="parent_id" readonly />

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





<script type="text/javascript">

    jeDate({

		dateCell:"#dateinfo",

		format:"YYYY-MM-DD hh:mm:ss",

		isinitVal:true,

		isTime:true, //isClear:false,

		okfun:function(val){

		}

	})

</script>



</body></html>