<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>绑定银行卡</title>
  <link rel="stylesheet" href="/Public/Login/css/centre.css">
  <link rel="stylesheet" href="/Public/Login/css/bank.css">
    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
      <!--其他插件-->
  <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
  <script src="/Public/Admin/js/jquery.js"></script>
  <!--layer弹窗插件-->
  <link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/> 
  <script src="/Public/Login/layui/layui.js"></script>

</head>
<body>
    <div class="bank">
        <div class="centre">
            <a href="<?php echo U('Perinfo/info');?>"> 
                <i class="iconfont icon-xiaoyu">返回</i>
            </a>
            <p>绑定银行卡</p>
        </div>
       <div class="bank-te"> 
            <div class="bank-list">
                <span>真实姓名</span>
                <input type="text" id="username" value="<?php echo ($data["username"]); ?>">
            </div>
            <div class="bank-list sep">
                <span>选择银行</span>
                <select name="bank" id="bank"  e="">请选择</option>
                    <option value="农行" <?php if(($data["bank"] == '农行')): ?>selected="selected"<?php endif; ?>>农业银行</option>
                    <option value="工行" <?php if(($data["bank"] == '工行')): ?>selected="selected"<?php endif; ?>>工商银行</option>
                    <option value="建行" <?php if(($data["bank"] == '建行')): ?>selected="selected"<?php endif; ?>>建设银行</option>
                    <option value="中行" <?php if(($data["bank"] == '中行')): ?>selected="selected"<?php endif; ?>>中国银行</option>
                </select>
            

            </div>
            <div class="bank-list">
                <span>开户支行</span>
                <input type="text" id="open_bank"  value="<?php echo ($data["open_bank"]); ?>">
            </div>
            <div class="bank-list ban">
                <span>银行账号</span>
                <input type="text" id="bank_account"  value="<?php echo ($data["bank_account"]); ?>">
            </div>
      </div> 
      <div class="btn">
          <button id="btn">确定</button>
      </div>
    </div>
</body>
</html>
<script type="text/javascript">
  layui.use(['layer', 'form'], function(){
  var layer = layui.layer
  ,form = layui.form;   
});
   $('#btn').click(function(){
        var username=$('#username').val();
        var bank=$('#bank').val();
        var open_bank=$('#open_bank').val();
        var bank_account=$('#bank_account').val();

       
       $.ajax({
         url:"<?php echo U('Perinfo/bank');?>",
         type:'post',
         datatype:'json',
         data:{username:username,bank:bank,open_bank:open_bank,bank_account:bank_account},
            success:function(msg){
             if(msg.status==1){
               layer.msg(msg.msg);
               window.location.href="<?php echo U('Perinfo/info');?>";
             }else{
               layer.msg(msg.msg);
             }
         }
       });
       
   });

</script>