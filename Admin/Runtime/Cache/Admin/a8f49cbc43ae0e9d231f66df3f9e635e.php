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

 <form method="post" class="form-x" action="/admin.php/Admin/Bonus/Bonus.html">  

<div class="panel-head" id="add"><strong><span class="iconfont icon-icon-xiugai"></span>会员注册金额设置</strong></div>
	<br/>
	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
		<div class="label">
			<label>普通会员金额：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($model['pucard']); ?>" name="pucard"/>元
			<div class="tips"></div>
		</div>
	</div>

	<br/>
	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
		<div class="label">
			<label>vip会员金额：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($model['vipcard']); ?>" name="vipcard"/>元
			<div class="tips"></div>
		</div>
	</div>
	
	<br/>
	 
	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
		<div class="label">
			<label>黄金会员人数:</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($model['goldcard']); ?>" name="goldcard"/><span>&nbsp&nbsp人</span>
			<div class="tips"></div>
		</div>
	</div>
	<br/>


<div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>分享朋友圈金额设置</strong></div>
	<br/>
	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
		<div class="label">
			<label>每天普通会员金额:</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($model['pumoney']); ?>" name="pumoney"/>元
			<div class="tips"></div>
		</div>
	</div>
	<br/>

	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
		<div class="label">
			<label>每天黄金(vip)会员金额:</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($model['vipmoney']); ?>" name="vipmoney"/><span>元</span>
			<div class="tips"></div>
		</div>
	</div>
	
<!-- 
<div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>动态奖励税收百分比设置</strong></div>
	<br/>
	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
		<div class="label">
			<label>税收百分比：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($model['expenses']); ?>" name="expenses"/>%
			<div class="tips"></div>
		</div>
	</div> -->

<div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>黄金会员直推任务奖金设置</strong></div>
	<br/>
	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
		<div class="label">
			<label>一代普通会员自身金额：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($model['goldmemberone']); ?>" name="goldmemberone"/>元
			<div class="tips"></div>
		</div>
	</div>
<br/>

<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
		<div class="label">
			<label>一代黄金会员上级金额：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($model['goldmemberones']); ?>" name="goldmemberones"/>元
			<div class="tips"></div>
		</div>
	</div>
	<br/>


	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
			<div class="label">
				<label>二代vip会员自身金额：</label>
			</div>
			<div class="field">
				<input type="text" class="input w50" value="<?php echo ($model['vipmembertwo']); ?>" name="vipmembertwo"/>元
				<div class="tips"></div>
			</div>
		</div>
		<br/>
		<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
				<div class="label">
					<label>二代黄金会员上级金额：</label>
				</div>
				<div class="field">
					<input type="text" class="input w50" value="<?php echo ($model['vipmembertwos']); ?>" name="vipmembertwos"/>元
					<div class="tips"></div>
				</div>
			</div>
 
<!-- <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>会员升级次数设置</strong></div>
	<br/>
	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
		<div class="label">
			<label>会员升级次数：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($model['grade_num']); ?>" name="grade_num"/>
			<div class="tips"></div>
		</div>
	</div> -->

<div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>提现手续费百分比设置</strong></div>
	<br/>
	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
		<div class="label">
			<label>提现手续费：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($model['tixian']); ?>" name="tixian"/>%
			<div class="tips"></div>
		</div>
	</div>

	<div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>推荐会员做任务奖金设置</strong></div>
	<br/>
	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
		<div class="label">
			<label>推荐普通会员金额：</label>
		</div>
		<div class="field">
			<input type="text" class="input w50" value="<?php echo ($model['recommendpcard']); ?>" name="recommendpcard"/>元
			<div class="tips"></div>
		</div>
	</div>
	<br/>
	<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
			<div class="label">
				<label>推荐普通会员任务金额：</label>
			</div>
			<div class="field">
				<input type="text" class="input w50" value="<?php echo ($model['recommendptask']); ?>" name="recommendptask"/>元
				<div class="tips"></div>
			</div>
		</div>
		<br/>

		<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
				<div class="label">
					<label>二代普通会员发圈：</label>
				</div>
				<div class="field">
					<input type="text" class="input w50" value="<?php echo ($model['twogeneration']); ?>" name="twogeneration"/>元
					<div class="tips"></div>
				</div>
			</div> 
			<br/>
			<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
					<div class="label">
						<label>二代vip会员发圈：</label>
					</div>
					<div class="field">
						<input type="text" class="input w50" value="<?php echo ($model['twogenerations']); ?>" name="twogenerations"/>元
						<div class="tips"></div>
					</div>
				</div>     
                   <br/>
		<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
				<div class="label">
					<label>推荐vip会员金额：</label>
				</div>
				<div class="field">
					<input type="text" class="input w50" value="<?php echo ($model['recommendvip']); ?>" name="recommendvip"/>元
					<div class="tips"></div>
				</div>
			</div>
		 <br/>
		 <div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
				<div class="label">
					<label>推荐vip会员任务金额：</label>
				</div>
				<div class="field">
					<input type="text" class="input w50" value="<?php echo ($model['recommendvtask']); ?>" name="recommendvtask"/>元
					<div class="tips"></div>
				</div>
			</div>		
			<br/>
			<div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
					<div class="label">
						<label>二代普通会员发圈：</label>
					</div>
					<div class="field">
						<input type="text" class="input w50" value="<?php echo ($model['twogenerp']); ?>" name="twogenerp"/>元
						<div class="tips"></div>
					</div>
				</div> 
			   <br/>
			   <div class="form-group" style="margin-bottom: 0px; padding-bottom: 5px;">
					<div class="label">
						<label>二代vip会员发圈：</label>
					</div>
					<div class="field">
						<input type="text" class="input w50" value="<?php echo ($model['twogenerv']); ?>" name="twogenerv"/>元
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