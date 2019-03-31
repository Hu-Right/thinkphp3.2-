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

          <span class="iconfont icon-icon-xiugai"></span>审核</strong>

      </div>

      <div class="body-content">

        <form method="post" class="form-x" action="/admin.php/Admin/Member/tosave/id/36" enctype="multipart/form-data">

          <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
           
          <div class="form-group">

            <div class="label">

              <label>会员id：</label></div>

            <div class="field">

              <input type="text" class="input w50" value="<?php echo ($data["userid"]); ?>"  name="userid" readonly="readonly"/>

              <div class="tips"></div>

            </div>

          </div>    

          <div class="form-group">

            <div class="label">

              <label>任务名称：</label></div>

            <div class="field">

              <input type="text" class="input w50" value="<?php echo ($data["taskname"]); ?>"  name="taskname" readonly="readonly"/>

              <div class="tips"></div>

            </div>

          </div>
       

          <div class="form-group">

            <div class="label">

              <label>提交上传图片：</label></div>

            <div class="field">

                <img style="margin-left: 160px; width: 300px;" src="<?php echo ($data["logo"]); ?>" />

              <div class="tips"></div>

            </div>

          </div>

        
          <div class="form-group">

            <div class="label">

              <label>提交时间：</label></div>

            <div class="field">
                   
			  <input type="text"  value="<?php echo (date("Y-m-d H:i:s",$data["stime"])); ?>" class="input w50" name="stime" disabled="disabled"/>

              <div class="tips"></div>

            </div>

 
          </div>
		
          <div class="form-group">

            <div class="label">

              <label>任务状态:</label></div>
              
              <div class="field">
                  
              <input <?php if($data['taskstatus']=='1') echo 'checked="checked"'; ?>type="radio" name="taskstatus" maxlength="60" value="1" />审核中 
              <input <?php if($data['taskstatus']=='2') echo 'checked="checked"'; ?> type="radio" name="taskstatus" maxlength="60" value="2" />未通过   
              <input <?php if($data['taskstatus']=='3') echo 'checked="checked"'; ?> type="radio" name="taskstatus" maxlength="60" value="3" />通过      
          <div class="tips"></div>
            </div>
          </div>

          <div class="form-group">

            <div class="label">

              <label>备注说明：</label></div>

            <div class="field">

			  <input type="text"  value="<?php echo ($data["remarks"]); ?>" class="input w50" name="remarks"/>

              <div class="tips"></div>

            </div>

   
          </div>

            <div class="field">
              &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
              <button class="button bg-main iconfont icon-icon--" type="submit">确认</button></div>
        </form>

      </div>

    </div>

 

  </body>



</html>