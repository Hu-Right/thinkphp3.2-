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

      <div class="panel-head" id="add">

        <strong>

          <span class="iconfont icon-icon-xiugai"></span>参数修改</strong>

      </div>

      <div class="body-content">

        <form method="post" class="form-x" action="/admin.php/Admin/Member/tsave/id/3" enctype="multipart/form-data">

          <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">

          <div class="form-group">

            <div class="label">

              <label>任务名称：</label></div>

            <div class="field">

              <input type="text" class="input w50" value="<?php echo ($data["cname"]); ?>"  name="cname"/>

              <div class="tips"></div>

            </div>

          </div>

          <div class="form-group">

            <div class="label">

              <label>文案内容：</label></div>

            <div class="field">

              <input type="text" class="input w50" value="<?php echo ($data["content"]); ?>" name="content"  />

              <div class="tips"></div>

            </div>

          </div>

        
          
          <img style="margin-left: 160px; width: 300px;" src="<?php echo ($data["logo"]); ?>" />

          <div class="form-group">

            <div class="label">

              <label>附件图片：</label></div>

            <div class="field">

			  <input type="file"  value="<?php echo ($data["logo"]); ?>" class="input w50" name="logo"/>

              <div class="tips"></div>

            </div>

			  

          </div>
		
          <div class="form-group">

            <div class="label">

              <label>是否禁用:</label></div>
              
              <div class="field">
                  <input type="radio" name="status" value="0" <?php if(($data["status"] != 1)): ?>checked<?php endif; ?> >否  
			       	<input type="radio" name="status" value="1" <?php if(($data["status"] == 1)): ?>checked<?php endif; ?> >是
          <div class="tips"></div>
                  
            </div>
          </div>
            <div class="field">
              &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
              <button class="button bg-main iconfont icon-icon--" type="submit">确认修改</button></div>
        </form>

      </div>

    </div>

  </body>



</html>