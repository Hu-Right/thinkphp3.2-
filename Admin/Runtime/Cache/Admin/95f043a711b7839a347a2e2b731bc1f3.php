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

  <div class="panel-head" id="add"><strong><span class="iconfont icon-icon-xiugai"></span>修改会员是否为报单中心</strong></div>

  <div class="body-content">

    <form method="post" class="form-x" action="/admin.php/Admin/Member/editdecenter">  

	

      <div class="form-group">

        <div class="label">

          <label>会员ID：</label>

        </div>

        <div class="field">

          <input type="text" class="input w50"  name="email" data-validate="required:请输入会员ID" />

          <div class="tips"></div>

        </div>

      </div>

         

      <div class="form-group">

        <div class="label">

          <label>报单中心：</label>

        </div>

        <div class="field">

          <span><input type="radio" class="" value="0" name="is_decenter"/>否</span>

          <span><input type="radio" class="" value="1" name="is_decenter"/>是</span>

         

        </div>

	</div>

	  

      <div class="form-group">

        <div class="label">

          <label></label>

        </div>

        <div class="field">

          <button class="button bg-main icon-check-square-o" type="submit"> 确认</button>

          <button class="button bg-main icon-check-square-o" type="reset"> 重置</button>

        </div>

      </div>

    </form>

  </div>

</div>



</body></html>