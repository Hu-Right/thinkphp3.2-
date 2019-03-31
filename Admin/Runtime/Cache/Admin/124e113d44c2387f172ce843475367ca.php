<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加会员</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="/Public/Index/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/Index/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/Index/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/Public/Index/css/animate.min.css" rel="stylesheet">
    <link href="/Public/Index/css/style.min.css?v=4.1.0" rel="stylesheet">
</head>
<style type="text/css">
input[type="button"], input[type="submit"], input[type="reset"] {
-webkit-appearance: none;
}
</style>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="margin-left: -920px;">
                        <h5 style="color:#333;">添加会员
                        </h5>
                        <div class="ibox-tools">

                        </div>
                    </div>
                    <div class="ibox-content" style="margin-left: -550px;">
                        <form method="post" action="<?php echo U('add');?>" class="form-horizontal" id="form-admin-add" >
                                <div class="form-group">
                                <label class="col-sm-5 control-label">真实姓名</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="username" id="username" placeholder="请输入真实姓名" class="form-control">
                                    </div>
                                 </div>

                                 <div class="form-group">
                                <label class="col-sm-5 control-label">登录手机号码</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="mobile" id="mobile" placeholder="请输入手机号码" class="form-control">
                                    </div>
                                 </div>

                                 <!-- <div class="form-group">
                                <label class="col-sm-5 control-label">登录ID(请牢记)</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="email" onblur="checkUser()" id="email" value="" placeholder="请输入登录ID" class="form-control">
                                    </div>
                                 </div> -->

                                <!-- <div class="form-group">
                                <label class="col-sm-5 control-label">身份证号码</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="card" maxlength="18" id="card" placeholder="请输入身份证号码" class="form-control">
                                    </div>
                                 </div> -->

                               <!--  <div class="form-group">
                                <label class="col-sm-5 control-label">微信号码</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="weixin" id="weixin" placeholder="请输入微信号码" class="form-control">
                                    </div>
                                 </div>

                                 <div class="form-group">
                                <label class="col-sm-5 control-label">支付宝账户</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="zhifubao" id="zhifubao" placeholder="请输入支付宝账户" class="form-control">
                                    </div>
                                 </div>
                                     -->


                                 <!-- <div class="form-group">
                                <label class="col-sm-5 control-label">二级密码</label>
                                    <div class="col-sm-3">
                                        <input type="password" name="erpsd"   placeholder="请输入二级密码"  class="form-control">
                                    </div>
                                 </div>

                            <div class="form-group">
                                <label class="col-sm-5 control-label">确认二级密码</label>
                                    <div class="col-sm-3">
                                        <input type="password" name="rerpsd"   placeholder="请输入确认二级密码"  class="form-control">
                                    </div>
                                 </div> -->



                                 <div class="form-group">
                                <label class="col-sm-5 control-label">登录密码</label>
                                    <div class="col-sm-3">
                                        <input type="password" name="password" id="password" placeholder="请输入登录密码" value="666666" class="form-control">
                                    </div>
                                 </div>

                            <div class="form-group">
                                <label class="col-sm-5 control-label">确认登录密码</label>
                                    <div class="col-sm-3">
                                        <input type="password" name="rpassword" id="rpassword" placeholder="请输入确认登录密码" value="666666" class="form-control">
                                    </div>
                                 </div>

                                <div class="form-group">
                                <label class="col-sm-5 control-label">会员级别</label>
                                    <div class="col-sm-3">
                                    <select class="form-control edited" id="type" name="level">
                                      <?php if(is_array($levels)): $i = 0; $__LIST__ = $levels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v['id']); ?>" <?php if($v['id']==2): ?>selected<?php endif; ?> ><?php echo ($v['level_name']); ?>--（￥<?php echo ($v['money']); ?>）</option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                    </div>
                                 </div>
                                 <!-- <div class="form-group">
                                <label class="col-sm-5 control-label">区域</label>

                                    <div class="col-sm-3">

                                        <label class="checkbox-inline">
                                            <input type="radio" value="0" name="region" checked> 左区</label>
                                        <label class="checkbox-inline">
                                            <input type="radio" value="1" name="region" > 右区
                                        </label>

                                    </div>
                                </div> -->


                                <div class="form-group">
                                <label class="col-sm-5 control-label">推荐人ID</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="tuijian" id="tuijian"  placeholder="请输入推荐人ID" value="<?php echo ($user["parent_id"]); ?>" class="form-control">
                                    </div>
                                 </div>
                                <!-- <div class="form-group">
                                <label class="col-sm-5 control-label">节点会员ID</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="jiedian" id="jiedian"  placeholder="请输入节点会员ID" value="<?php echo ($jiedianemail); ?>" class="form-control">
                                    </div>
                                 </div> -->

                                <div class="form-group">
                                <label class="col-sm-5 control-label">性别</label>

                                    <div class="col-sm-4">

                                        <label class="checkbox-inline">
                                            <input type="radio" value="男" name="gender" checked> 男</label>
                                        <label class="checkbox-inline">
                                            <input type="radio" value="女" name="gender" > 女
                                            </label>
                                             <label class="checkbox-inline">
                                            <input type="radio" value="保密" name="gender" > 保密
                                            </label>

                                    </div>
                                </div>

                            <div class="hr-line-dashed"></div>
                            <!--
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">注册下级会员</button>
                                </div>
                            </div>
                            -->

                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2" style="text-align: center;">
                                    <input class="btn btn-primary" type="submit" value="注册会员">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/Public/Default/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Public/Default/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/Public/Default/js/content.min.js?v=1.0.0"></script>
    <script src="/Public/Default/js/plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript" src="/Public/Default/check/js/jquery.validate.min.js"></script>

<script type="text/javascript" src="/Public/Default/check/js/messages_zh.min.js"></script>



<script type="text/javascript" src="/Public/Default/check/js/validate-methods.js"></script>

<script type="text/javascript" src="/Public/Index/css/js/jquery-1.8.2.min.js"></script>



    <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    </script>

    <script type="text/javascript">
    $(function(){
    $("#form-admin-add").validate({
        rules:{
            uUser:{
                required:true,
                minlength:2,
                maxlength:20
            },
            uPwd:{
                minlength:6,
                maxlength:16

            },
            uPwd2:{
                equalTo: "#uPwd"
            },
            uZfPwd:{
                minlength:6,
                maxlength:6,
                isNumber:true,

            },
            uZfPwd2:{
                equalTo: "#uZfPwd"

            },
            uName:{
                required:true,
                minlength:2,
                maxlength:8

            },
            uSfId:{
                required:true,
                minlength:15,
                maxlength:18

            },
            uTel:{
                required:true,
                isPhone:true,

            },
            uWeixin:{
                required:true,

            },
            uZhifubao:{
                required:true,

            },
            uTuiUser:{
                required:true,

            },

        },
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        submitHandler:function(form){
            $(form).ajaxSubmit();
            var index = parent.layer.getFrameIndex(window.name);
            parent.$('.btn-refresh').click();
            parent.layer.close(index);
        }
    });
});

    function checkUser(){
        var email=document.getElementById("email").value;
        $.ajax({
            type:'post',
            url:"<?php echo U('Member/checkuser');?>",
            data:{email:email},
            success:function(ret){
                if(ret==1){
                    alert('账户已存在，请重新输入！');
                    document.getElementById("email").value='';
                }
            }
        })
    }

</script>


</body>

</html>



<!-- <!DOCTYPE html>

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

  <div class="panel-head" id="add"><strong><span class="iconfont icon-icon-tianjia"></span>管理员增加</strong></div>

  <div class="body-content">

    <form method="post" class="form-x" action="/admin.php/Admin/Member/add">  

	

						 <div class="form-group">

									<div class="label">

										<label>上级用户ID：</label>

									</div>

									<div class="field">

										<input type="text" class="input w50" value="" name="parent_id" />

										<div class="tips"></div>

									</div>

						</div>	

		

	  

					   <div class="form-group">

									<div class="label">

										<label>用户名：</label>

									</div>

									<div class="field">

										<input type="text" class="input w50" value="" name="username" data-validate="required:请输入用户名" />

										<div class="tips"></div>

									</div>

						</div>

						  <div class="form-group">

									<div class="label">

										<label>手机号码：</label>

									</div>

									<div class="field">

										<input type="text" class="input w50" value="" name="mobile" data-validate="required:请输入手机号码" />

										<div class="tips"></div>

									</div>

						</div>

	  

						

		

	  

					    <div class="form-group">

									<div class="label">

										<label>登录ID(请牢记)：</label>

									</div>

									<div class="field">

										<input type="text" class="input w50" readonly="readonly" value="<?php echo rand(1,9) . (time()-1486700000); ?>" name="email" data-validate="请输入登录ID" />

										<div class="tips"></div>

								</div>

						</div>

       	  



						  <div class="form-group">

								<div class="label">

									<label>用户级别：</label>

								</div>

								<div class="field">



								<select  name="type" class="input w50">

									<option value="0" >普通会员</option>

									<option value="1" >金卡会员</option>

									<option value="2" >钻石会员</option>

								</select>



									<div class="tips"></div>

								</div>

						  </div>







	  

						<div class="form-group">

									<div class="label">

										<label>密码：</label>

									</div>

									<div class="field">

										<input type="text" class="input w50" value="" name="password" data-validate="required:请输入密码" />

										<div class="tips"></div>

									</div>

							 </div>



       	  					<div class="form-group">

									<div class="label">

										<label>余额：</label>

									</div>

									<div class="field">

										<input type="text" class="input w50" value="" name="money" data-validate="required:请输入初始余额" />

										<div class="tips"></div>

									</div>

							 </div>

	  

	  

					               <div class="form-group">

									<div class="label">

										<label>注册时间：</label>

									</div>

									<div class="field">

										<input class="input w50"  id="dateinfo" name="addtime" type="text" placeholder="请选择" value="" readonly>

								

										<div class="tips"></div>

									</div>

							 </div>

       	  

										

<div class="form-group">

<div class="label">

<label>性别：</label>

</div>

<div class="field">

<input checked="checked" type="radio" name="gender" maxlength="60" value="保密" />保密														

<input  type="radio" name="gender" maxlength="60" value="男" />男														

<input  type="radio" name="gender" maxlength="60" value="女" />女

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

</body></html> -->