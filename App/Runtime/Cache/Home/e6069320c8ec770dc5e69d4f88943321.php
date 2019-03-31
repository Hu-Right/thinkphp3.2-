<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>绑定支付宝</title>
    <link rel="stylesheet" href="/Public/Login/css/centre.css">
    <link rel="stylesheet" href="/Public/Login/css/alipay.css">
    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
      <!--其他插件-->
  <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
  <script src="/Public/Admin/js/jquery.js"></script>
  <!--layer弹窗插件-->
  <link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/> 
  <script src="/Public/Login/layui/layui.js"></script>
</head>
<body>
    <div class="alipay">
        <div class="centre">
            <a href="<?php echo U('Perinfo/info');?>"> 
                <i class="iconfont   icon-xiaoyu">返回</i>
            </a>
            <p>绑定支付宝</p>
        </div>
       
        <div class="bank-te"> 
            <div class="bank-list csta">
                <span>真实姓名</span>
                <input type="text" name="username" id="username" value="<?php echo ($data["username"]); ?>"/>
              
            </div>
          
            <div class="bank-list  ban">
                <span>支付宝账号</span>
                <input type="text" name="zhifubao" id="zhifubao" value="<?php echo ($data["zhifubao"]); ?>"/>
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
     var zhifubao=$('#zhifubao').val();
  if(username == '') {
            layer.msg('请输入用户名');
            return false;
        }
        if(zhifubao == '') {
            layer.msg('请输入支付宝');
            return false;
        }
        
        
    $.ajax({
       type:'post',
       url:"<?php echo U('Perinfo/alipay');?>",
       datatype:'json',
       data:{username:username,zhifubao:zhifubao},
       success:function(msg){
          if(msg.stauts==1){
             layer.msg(msg.msg);
            window.location.href="<?php echo U('Index/index');?>";
          }else{
              layer.msg(msg.msg);
          }
       }


    });

});
</script>